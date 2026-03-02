<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Persistence;

use Orm\Zed\ConfigurableBundleStorage\Persistence\SpyConfigurableBundleTemplateImageStorage;
use Orm\Zed\ConfigurableBundleStorage\Persistence\SpyConfigurableBundleTemplateStorage;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Spryker\Zed\ConfigurableBundleStorage\Persistence\ConfigurableBundleStoragePersistenceFactory getFactory()
 */
class ConfigurableBundleStorageEntityManager extends AbstractEntityManager implements ConfigurableBundleStorageEntityManagerInterface
{
    public function saveConfigurableBundleTemplateStorageEntity(SpyConfigurableBundleTemplateStorage $configurableBundleTemplateStorageEntity): void
    {
        $configurableBundleTemplateStorageEntity->save();
    }

    public function deleteConfigurableBundleTemplateStorageEntity(SpyConfigurableBundleTemplateStorage $configurableBundleTemplateStorageEntity): void
    {
        $configurableBundleTemplateStorageEntity->delete();
    }

    public function saveConfigurableBundleTemplateImageStorageEntity(
        SpyConfigurableBundleTemplateImageStorage $configurableBundleTemplateImageStorageEntity
    ): void {
        $configurableBundleTemplateImageStorageEntity->save();
    }

    public function deleteConfigurableBundleTemplateImageStorageEntity(
        SpyConfigurableBundleTemplateImageStorage $configurableBundleTemplateImageStorageEntity
    ): void {
        $configurableBundleTemplateImageStorageEntity->delete();
    }
}
