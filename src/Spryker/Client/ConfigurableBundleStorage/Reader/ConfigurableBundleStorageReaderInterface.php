<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleStorage\Reader;

use Generated\Shared\Transfer\ConfigurableBundleTemplateStorageFilterTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer;

interface ConfigurableBundleStorageReaderInterface
{
    /**
     * @param int $idConfigurableBundleTemplate
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer|null
     */
    public function findConfigurableBundleTemplateStorage(int $idConfigurableBundleTemplate, string $localeName): ?ConfigurableBundleTemplateStorageTransfer;

    /**
     * @param string $configurableBundleTemplateUuid
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer|null
     */
    public function findConfigurableBundleTemplateStorageByUuid(
        string $configurableBundleTemplateUuid,
        string $localeName
    ): ?ConfigurableBundleTemplateStorageTransfer;

    /**
     * @param \Generated\Shared\Transfer\ConfigurableBundleTemplateStorageFilterTransfer $configurableBundleTemplateStorageFilterTransfer
     *
     * @return array<\Generated\Shared\Transfer\ConfigurableBundleTemplateStorageTransfer>
     */
    public function getConfigurableBundleTemplateStorageCollection(
        ConfigurableBundleTemplateStorageFilterTransfer $configurableBundleTemplateStorageFilterTransfer
    ): array;
}
