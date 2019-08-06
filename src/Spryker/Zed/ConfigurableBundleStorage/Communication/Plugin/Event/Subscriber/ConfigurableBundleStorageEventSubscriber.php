<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Subscriber;

use Spryker\Zed\ConfigurableBundle\Dependency\ConfigurableBundleEvents;
use Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Listener\ConfigurableBundleTemplateSlotStorageListener;
use Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Listener\ConfigurableBundleTemplateStorageListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\ConfigurableBundleStorage\Communication\ConfigurableBundleStorageCommunicationFactory getFactory()
 * @method \Spryker\Zed\ConfigurableBundleStorage\Business\ConfigurableBundleStorageFacadeInterface getFacade()
 * @method \Spryker\Zed\ConfigurableBundleStorage\ConfigurableBundleStorageConfig getConfig()
 */
class ConfigurableBundleStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
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
        $this->addConfigurableBundleTemplatePublishListener($eventCollection)
            ->addConfigurableBundleTemplateCreateListener($eventCollection)
            ->addConfigurableBundleTemplateUpdateListener($eventCollection)
            ->addConfigurableBundleTemplateDeleteListener($eventCollection)
            ->addConfigurableBundleTemplateSlotCreateListener($eventCollection)
            ->addConfigurableBundleTemplateSlotUpdateListener($eventCollection)
            ->addConfigurableBundleTemplateSlotDeleteListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplatePublishListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::CONFIGURABLE_BUNDLE_TEMPLATE_PUBLISH, new ConfigurableBundleTemplateStorageListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::ENTITY_SPY_CONFIGURABLE_BUNDLE_TEMPLATE_CREATE, new ConfigurableBundleTemplateStorageListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::ENTITY_SPY_CONFIGURABLE_BUNDLE_TEMPLATE_UPDATE, new ConfigurableBundleTemplateStorageListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::ENTITY_SPY_CONFIGURABLE_BUNDLE_TEMPLATE_DELETE, new ConfigurableBundleTemplateStorageListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateSlotCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::ENTITY_SPY_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_CREATE, new ConfigurableBundleTemplateSlotStorageListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateSlotUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::ENTITY_SPY_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UPDATE, new ConfigurableBundleTemplateSlotStorageListener());

        return $this;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return $this
     */
    protected function addConfigurableBundleTemplateSlotDeleteListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection
            ->addListenerQueued(ConfigurableBundleEvents::ENTITY_SPY_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_DELETE, new ConfigurableBundleTemplateSlotStorageListener());

        return $this;
    }
}
