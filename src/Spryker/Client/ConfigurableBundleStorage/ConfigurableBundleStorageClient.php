<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleStorage;

use Generated\Shared\Transfer\ConfigurableBundleTemplateStorageFilterTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Spryker\Client\ConfigurableBundleStorage\ConfigurableBundleStorageFactory getFactory()
 */
class ConfigurableBundleStorageClient extends AbstractClient implements ConfigurableBundleStorageClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idConfigurableBundleTemplate
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer|null
     */
    public function findConfigurableBundleTemplateStorage(int $idConfigurableBundleTemplate, string $localeName): ?ConfigurableBundleTemplateStorageTransfer
    {
        return $this->getFactory()
            ->createConfigurableBundleStorageReader()
            ->findConfigurableBundleTemplateStorage($idConfigurableBundleTemplate, $localeName);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConfigurableBundleTemplateStorageFilterTransfer $configurableBundleTemplateStorageFilterTransfer
     *
     * @return array<\Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer>
     */
    public function getConfigurableBundleTemplateStorageCollection(
        ConfigurableBundleTemplateStorageFilterTransfer $configurableBundleTemplateStorageFilterTransfer
    ): array {
        return $this->getFactory()
            ->createConfigurableBundleStorageReader()
            ->getConfigurableBundleTemplateStorageCollection($configurableBundleTemplateStorageFilterTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $configurableBundleTemplateUuid
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer|null
     */
    public function findConfigurableBundleTemplateStorageByUuid(
        string $configurableBundleTemplateUuid,
        string $localeName
    ): ?ConfigurableBundleTemplateStorageTransfer {
        return $this->getFactory()
            ->createConfigurableBundleStorageReader()
            ->findConfigurableBundleTemplateStorageByUuid($configurableBundleTemplateUuid, $localeName);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<string> $skus
     * @param string $localeName
     *
     * @return array<\Generated\Shared\Transfer\ProductViewTransfer>
     */
    public function getProductConcretesBySkusAndLocale(array $skus, string $localeName): array
    {
        return $this->getFactory()
            ->createProductConcreteStorageReader()
            ->getProductConcretesBySkusAndLocale($skus, $localeName);
    }
}
