<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

declare(strict_types = 1);

namespace SprykerTest\Zed\ConfigurableBundleStorage\Helper;

use Codeception\Module;
use Generated\Shared\Transfer\ConfigurableBundleTemplateSlotTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateSlotTranslationTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateTranslationTransfer;
use Generated\Shared\Transfer\ProductImageSetTransfer;
use Generated\Shared\Transfer\ProductImageTransfer;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery;
use Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Subscriber\ConfigurableBundleStorageEventSubscriber;
use Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Subscriber\ConfigurableBundleTemplateImageStorageEventSubscriber;
use SprykerTest\Shared\ConfigurableBundle\Helper\ConfigurableBundleDataHelper;
use SprykerTest\Shared\ProductImage\Helper\ProductImageDataHelper;
use SprykerTest\Zed\Locale\Helper\LocaleDataHelper;
use SprykerTest\Zed\Publisher\Helper\PublishHelper;

/**
 * The Arrange step the configurable-bundle-template resources share: an active template, optionally
 * with slots, published into `spy_configurable_bundle_template_storage` along with the glossary the
 * reader translates its names through.
 */
class ConfigurableBundleStorageDataHelper extends Module
{
    public const string IMAGE_URL_LARGE = 'https://images.example.org/large/configurable-bundle-template.jpg';

    public const string IMAGE_URL_SMALL = 'https://images.example.org/small/configurable-bundle-template.jpg';

    /**
     * An active template with the given slots and image sets, published and readable.
     *
     * @param array<string> $slotNames Display name per slot; the returned `slots` map is keyed by them.
     * @param array<string> $imageSetNames Name per image set; it is also the resource's JSON:API identifier.
     *
     * @return array{uuid: string, id: int, name: string, slots: array<string, string>}
     */
    public function arrangePublishedConfigurableBundleTemplate(array $slotNames = [], array $imageSetNames = []): array
    {
        // ConfigurableBundleStorage still publishes through legacy event subscribers, which
        // EventHelper drops when it rebuilds the collection around the publisher subscriber. The
        // image sets are published by a second subscriber into a storage table of their own.
        $this->getPublishHelper()->registerEventSubscribers([
            new ConfigurableBundleStorageEventSubscriber(),
            new ConfigurableBundleTemplateImageStorageEventSubscriber(),
        ]);

        $templateName = uniqid('Configurable bundle template ', false);

        $configurableBundleTemplateTransfer = $this->getConfigurableBundleDataHelper()->haveConfigurableBundleTemplate([
            ConfigurableBundleTemplateTransfer::IS_ACTIVE => true,
            ConfigurableBundleTemplateTransfer::TRANSLATIONS => [
                [
                    ConfigurableBundleTemplateTranslationTransfer::NAME => $templateName,
                    ConfigurableBundleTemplateTranslationTransfer::LOCALE => $this->getLocaleDataHelper()->getCurrentLocale()->toArray(),
                ],
            ],
        ]);

        $idConfigurableBundleTemplate = $configurableBundleTemplateTransfer->getIdConfigurableBundleTemplateOrFail();

        // Slots have to exist before the publish: the publisher folds them into the template's
        // storage payload rather than writing a row of their own.
        $slotUuids = [];

        foreach ($slotNames as $slotName) {
            $slotUuids[$slotName] = $this->arrangeConfigurableBundleTemplateSlot(
                $idConfigurableBundleTemplate,
                $slotName,
            );
        }

        foreach ($imageSetNames as $imageSetName) {
            $this->arrangeConfigurableBundleTemplateImageSet($idConfigurableBundleTemplate, $imageSetName);
        }

        $this->getPublishHelper()->publishPendingEvents();

        return [
            // The uuid is written by the Propel behavior on save and never handed back on the
            // transfer, so it is read from the row the creator persisted.
            'uuid' => $this->findConfigurableBundleTemplateUuid($idConfigurableBundleTemplate),
            'id' => $idConfigurableBundleTemplate,
            'name' => $templateName,
            'slots' => $slotUuids,
        ];
    }

    public function arrangeConfigurableBundleTemplateSlot(int $idConfigurableBundleTemplate, string $slotName): string
    {
        $configurableBundleTemplateSlotTransfer = $this->getConfigurableBundleDataHelper()->haveConfigurableBundleTemplateSlot([
            ConfigurableBundleTemplateSlotTransfer::FK_CONFIGURABLE_BUNDLE_TEMPLATE => $idConfigurableBundleTemplate,
            ConfigurableBundleTemplateSlotTransfer::TRANSLATIONS => [
                [
                    ConfigurableBundleTemplateSlotTranslationTransfer::NAME => $slotName,
                    ConfigurableBundleTemplateSlotTranslationTransfer::LOCALE => $this->getLocaleDataHelper()->getCurrentLocale()->toArray(),
                ],
            ],
        ]);

        return $this->findConfigurableBundleTemplateSlotUuid(
            $configurableBundleTemplateSlotTransfer->getIdConfigurableBundleTemplateSlotOrFail(),
        );
    }

    /**
     * An image set belongs to a template through `spy_product_image_set`'s own foreign key, which
     * only the data importer ever writes — so the row the image helper created is repointed here.
     */
    public function arrangeConfigurableBundleTemplateImageSet(int $idConfigurableBundleTemplate, string $imageSetName): void
    {
        $productImageSetTransfer = $this->getProductImageDataHelper()->haveProductImageSet([
            ProductImageSetTransfer::NAME => $imageSetName,
            ProductImageSetTransfer::LOCALE => $this->getLocaleDataHelper()->getCurrentLocale(),
        ], [
            ProductImageTransfer::EXTERNAL_URL_LARGE => static::IMAGE_URL_LARGE,
            ProductImageTransfer::EXTERNAL_URL_SMALL => static::IMAGE_URL_SMALL,
        ]);

        SpyProductImageSetQuery::create()
            ->filterByIdProductImageSet($productImageSetTransfer->getIdProductImageSetOrFail())
            ->findOne()
            ->setFkResourceConfigurableBundleTemplate($idConfigurableBundleTemplate)
            ->save();
    }

    protected function findConfigurableBundleTemplateUuid(int $idConfigurableBundleTemplate): string
    {
        return SpyConfigurableBundleTemplateQuery::create()
            ->filterByIdConfigurableBundleTemplate($idConfigurableBundleTemplate)
            ->findOne()
            ->getUuid();
    }

    protected function findConfigurableBundleTemplateSlotUuid(int $idConfigurableBundleTemplateSlot): string
    {
        return SpyConfigurableBundleTemplateSlotQuery::create()
            ->filterByIdConfigurableBundleTemplateSlot($idConfigurableBundleTemplateSlot)
            ->findOne()
            ->getUuid();
    }

    protected function getConfigurableBundleDataHelper(): ConfigurableBundleDataHelper
    {
        /** @var \SprykerTest\Shared\ConfigurableBundle\Helper\ConfigurableBundleDataHelper $configurableBundleDataHelper */
        $configurableBundleDataHelper = $this->getModule('\\' . ConfigurableBundleDataHelper::class);

        return $configurableBundleDataHelper;
    }

    protected function getProductImageDataHelper(): ProductImageDataHelper
    {
        /** @var \SprykerTest\Shared\ProductImage\Helper\ProductImageDataHelper $productImageDataHelper */
        $productImageDataHelper = $this->getModule('\\' . ProductImageDataHelper::class);

        return $productImageDataHelper;
    }

    protected function getLocaleDataHelper(): LocaleDataHelper
    {
        /** @var \SprykerTest\Zed\Locale\Helper\LocaleDataHelper $localeDataHelper */
        $localeDataHelper = $this->getModule('\\' . LocaleDataHelper::class);

        return $localeDataHelper;
    }

    protected function getPublishHelper(): PublishHelper
    {
        /** @var \SprykerTest\Zed\Publisher\Helper\PublishHelper $publishHelper */
        $publishHelper = $this->getModule('\\' . PublishHelper::class);

        return $publishHelper;
    }
}
