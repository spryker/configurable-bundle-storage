<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Spryker\Zed\ConfigurableBundleStorage\Business\ConfigurableBundleStorageBusinessFactory getFactory()
 * @method \Spryker\Zed\ConfigurableBundleStorage\Persistence\ConfigurableBundleStorageEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\ConfigurableBundleStorage\Persistence\ConfigurableBundleStorageRepositoryInterface getRepository()
 */
class ConfigurableBundleStorageFacade extends AbstractFacade implements ConfigurableBundleStorageFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $configurableBundleTemplateIds
     *
     * @return void
     */
    public function publishConfigurableBundleTemplate(array $configurableBundleTemplateIds): void
    {
        $this->getFactory()
            ->createConfigurableBundleStoragePublisher()
            ->publishConfigurableBundleTemplates($configurableBundleTemplateIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $configurableBundleTemplateIds
     *
     * @return void
     */
    public function unpublishConfigurableBundleTemplate(array $configurableBundleTemplateIds): void
    {
        $this->getFactory()
            ->createConfigurableBundleStorageUnpublisher()
            ->unpublishConfigurableBundleTemplates($configurableBundleTemplateIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $configurableBundleTemplateIds
     *
     * @return void
     */
    public function publishConfigurableBundleTemplateImage(array $configurableBundleTemplateIds): void
    {
        $this->getFactory()
            ->createConfigurableBundleTemplateImageStoragePublisher()
            ->publish($configurableBundleTemplateIds);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $configurableBundleTemplateIds
     *
     * @return void
     */
    public function unpublishConfigurableBundleTemplateImage(array $configurableBundleTemplateIds): void
    {
        $this->getFactory()
            ->createConfigurableBundleTemplateImageStorageUnpublisher()
            ->unpublish($configurableBundleTemplateIds);
    }
}
