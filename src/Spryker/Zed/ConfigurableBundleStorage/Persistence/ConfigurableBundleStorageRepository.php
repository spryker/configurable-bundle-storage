<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleStorage\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Spryker\Zed\ConfigurableBundleStorage\Persistence\ConfigurableBundleStoragePersistenceFactory getFactory()
 */
class ConfigurableBundleStorageRepository extends AbstractRepository implements ConfigurableBundleStorageRepositoryInterface
{
    /**
     * @param int[] $configurableBundleTemplateIds
     *
     * @return \Orm\Zed\ConfigurableBundleStorage\Persistence\SpyConfigurableBundleTemplateStorage[]
     */
    public function getConfigurableBundleTemplateStorageEntityMap(array $configurableBundleTemplateIds): array
    {
        $configurableBundleTemplateStorageEntities = $this->getFactory()
            ->getConfigurableBundleTemplateStoragePropelQuery()
            ->filterByFkConfigurableBundleTemplate_In($configurableBundleTemplateIds)
            ->find();

        $configurableBundleTemplateStorageEntityMap = [];

        foreach ($configurableBundleTemplateStorageEntities as $configurableBundleTemplateStorageEntity) {
            $configurableBundleTemplateStorageEntityMap[$configurableBundleTemplateStorageEntity->getFkConfigurableBundleTemplate()]
                = $configurableBundleTemplateStorageEntity;
        }

        return $configurableBundleTemplateStorageEntityMap;
    }

    /**
     * @param int[] $configurableBundleTemplateIds
     *
     * @return \Orm\Zed\ConfigurableBundleStorage\Persistence\SpyConfigurableBundleTemplateImageStorage[][]
     */
    public function getConfigurableBundleTemplateImageStorageEntityMap(array $configurableBundleTemplateIds): array
    {
        $configurableBundleTemplateImageStorageEntities = $this->getFactory()
            ->getConfigurableBundleTemplateImageStoragePropelQuery()
            ->filterByFkConfigurableBundleTemplate_In($configurableBundleTemplateIds)
            ->find();

        $localizedConfigurableBundleTemplateImageStorageEntityMap = [];

        foreach ($configurableBundleTemplateImageStorageEntities as $configurableBundleTemplateImageStorageEntity) {
            $localizedConfigurableBundleTemplateImageStorageEntityMap[$configurableBundleTemplateImageStorageEntity->getFkConfigurableBundleTemplate()][$configurableBundleTemplateImageStorageEntity->getLocale()] = $configurableBundleTemplateImageStorageEntity;
        }

        return $localizedConfigurableBundleTemplateImageStorageEntityMap;
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param int[] $configurableBundleTemplateIds
     *
     * @return \Generated\Shared\Transfer\SpyConfigurableBundleTemplateStorageEntityTransfer[]
     */
    public function getFilteredConfigurableBundleTemplateStorageEntities(FilterTransfer $filterTransfer, array $configurableBundleTemplateIds): array
    {
        $configurableBundleTemplateStoragePropelQuery = $this->getFactory()
            ->getConfigurableBundleTemplateStoragePropelQuery();

        if ($configurableBundleTemplateIds) {
            $configurableBundleTemplateStoragePropelQuery->filterByFkConfigurableBundleTemplate_In($configurableBundleTemplateIds);
        }

        return $this->buildQueryFromCriteria($configurableBundleTemplateStoragePropelQuery, $filterTransfer)
            ->find();
    }
}
