<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Persistence;

use Orm\Zed\ConfigurableBundleStorage\Persistence\SpyConfigurableBundleTemplateImageStorage;
use Orm\Zed\ConfigurableBundleStorage\Persistence\SpyConfigurableBundleTemplateStorage;

interface ConfigurableBundleStorageEntityManagerInterface
{
    public function saveConfigurableBundleTemplateStorageEntity(SpyConfigurableBundleTemplateStorage $configurableBundleTemplateStorageEntity): void;

    public function deleteConfigurableBundleTemplateStorageEntity(SpyConfigurableBundleTemplateStorage $configurableBundleTemplateStorageEntity): void;

    public function saveConfigurableBundleTemplateImageStorageEntity(
        SpyConfigurableBundleTemplateImageStorage $configurableBundleTemplateImageStorageEntity
    ): void;

    public function deleteConfigurableBundleTemplateImageStorageEntity(
        SpyConfigurableBundleTemplateImageStorage $configurableBundleTemplateImageStorageEntity
    ): void;
}
