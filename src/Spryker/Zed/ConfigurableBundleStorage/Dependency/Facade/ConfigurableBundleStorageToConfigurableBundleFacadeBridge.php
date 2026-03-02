<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Dependency\Facade;

use Generated\Shared\Transfer\ConfigurableBundleTemplateCollectionTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateFilterTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateSlotCollectionTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateSlotFilterTransfer;

class ConfigurableBundleStorageToConfigurableBundleFacadeBridge implements ConfigurableBundleStorageToConfigurableBundleFacadeInterface
{
    /**
     * @var \Spryker\Zed\ConfigurableBundle\Business\ConfigurableBundleFacadeInterface
     */
    protected $configurableBundleFacade;

    /**
     * @param \Spryker\Zed\ConfigurableBundle\Business\ConfigurableBundleFacadeInterface $configurableBundleFacade
     */
    public function __construct($configurableBundleFacade)
    {
        $this->configurableBundleFacade = $configurableBundleFacade;
    }

    public function getConfigurableBundleTemplateCollection(
        ConfigurableBundleTemplateFilterTransfer $configurableBundleTemplateFilterTransfer
    ): ConfigurableBundleTemplateCollectionTransfer {
        return $this->configurableBundleFacade->getConfigurableBundleTemplateCollection($configurableBundleTemplateFilterTransfer);
    }

    public function getConfigurableBundleTemplateSlotCollection(
        ConfigurableBundleTemplateSlotFilterTransfer $configurableBundleTemplateSlotFilterTransfer
    ): ConfigurableBundleTemplateSlotCollectionTransfer {
        return $this->configurableBundleFacade->getConfigurableBundleTemplateSlotCollection($configurableBundleTemplateSlotFilterTransfer);
    }
}
