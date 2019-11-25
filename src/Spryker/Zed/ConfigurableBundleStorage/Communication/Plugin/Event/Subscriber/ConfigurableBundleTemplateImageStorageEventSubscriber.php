<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Subscriber;

use Spryker\Zed\ConfigurableBundle\Dependency\ConfigurableBundleEvents;
use Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Listener\ConfigurableBundleTemplateImageProductImageSetStoragePublishListener;
use Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Listener\ConfigurableBundleTemplateImageStoragePublishListener;
use Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Listener\ConfigurableBundleTemplateImageStorageUnpublishListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductImage\Dependency\ProductImageEvents;

/**
 * @method \Spryker\Zed\ConfigurableBundleStorage\Communication\ConfigurableBundleStorageCommunicationFactory getFactory()
 * @method \Spryker\Zed\ConfigurableBundleStorage\Business\ConfigurableBundleStorageFacadeInterface getFacade()
 * @method \Spryker\Zed\ConfigurableBundleStorage\ConfigurableBundleStorageConfig getConfig()
 */
class ConfigurableBundleTemplateImageStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $this->addConfigurableBundleTemplateImagePublishListener($eventCollection)
            ->addConfigurableBundleTemplateImageUnPublishListener($eventCollection)
            ->addConfigurableBundleTemplateImageProductImageSetCreateListener($eventCollection)
            ->addConfigurableBundleTemplateImageProductImageSetUpdateListener($eventCollection)
            ->addConfigurableBundleTemplateImageProductImageSetDeleteListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateImagePublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::CONFIGURABLE_BUNDLE_TEMPLATE_IMAGE_PUBLISH, new ConfigurableBundleTemplateImageStoragePublishListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateImageUnPublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::CONFIGURABLE_BUNDLE_TEMPLATE_IMAGE_UNPUBLISH, new ConfigurableBundleTemplateImageStorageUnpublishListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateImageProductImageSetCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ProductImageEvents::ENTITY_SPY_PRODUCT_IMAGE_SET_CREATE, new ConfigurableBundleTemplateImageProductImageSetStoragePublishListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateImageProductImageSetUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ProductImageEvents::ENTITY_SPY_PRODUCT_IMAGE_SET_UPDATE, new ConfigurableBundleTemplateImageProductImageSetStoragePublishListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateImageProductImageSetDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ProductImageEvents::ENTITY_SPY_PRODUCT_IMAGE_SET_DELETE, new ConfigurableBundleTemplateImageProductImageSetStoragePublishListener());

        return $this;
    }
}
