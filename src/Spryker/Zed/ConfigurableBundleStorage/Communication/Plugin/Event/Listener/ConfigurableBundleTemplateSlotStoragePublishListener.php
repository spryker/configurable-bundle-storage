<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Communication\Plugin\Event\Listener;

use Orm\Zed\ConfigurableBundle\Persistence\Map\SpyConfigurableBundleTemplateSlotTableMap;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\ConfigurableBundleStorage\Business\ConfigurableBundleStorageFacadeInterface getFacade()
 * @method \Spryker\Zed\ConfigurableBundleStorage\Communication\ConfigurableBundleStorageCommunicationFactory getFactory()
 * @method \Spryker\Zed\ConfigurableBundleStorage\ConfigurableBundleStorageConfig getConfig()
 */
class ConfigurableBundleTemplateSlotStoragePublishListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * {@inheritDoc}
     * - Publishes slot's active configurable bundle template changes to Store.
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $configurableBundleTemplateIds = $this->getFactory()
            ->getEventBehaviorFacade()
            ->getEventTransferForeignKeys($eventEntityTransfers, SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE);

        $this->getFacade()->publishConfigurableBundleTemplate($configurableBundleTemplateIds);
    }
}
