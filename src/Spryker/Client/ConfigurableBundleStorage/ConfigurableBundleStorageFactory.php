<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleStorage;

use Spryker\Client\ConfigurableBundleStorage\Dependency\Client\ConfigurableBundleStorageToProductStorageClientInterface;
use Spryker\Client\ConfigurableBundleStorage\Dependency\Client\ConfigurableBundleStorageToStorageClientInterface;
use Spryker\Client\ConfigurableBundleStorage\Dependency\Service\ConfigurableBundleStorageToSynchronizationServiceInterface;
use Spryker\Client\ConfigurableBundleStorage\Dependency\Service\ConfigurableBundleStorageToUtilEncodingServiceInterface;
use Spryker\Client\ConfigurableBundleStorage\Expander\ConfigurableBundleTemplateImageStorageExpander;
use Spryker\Client\ConfigurableBundleStorage\Expander\ConfigurableBundleTemplateImageStorageExpanderInterface;
use Spryker\Client\ConfigurableBundleStorage\Reader\ConfigurableBundleStorageReader;
use Spryker\Client\ConfigurableBundleStorage\Reader\ConfigurableBundleStorageReaderInterface;
use Spryker\Client\ConfigurableBundleStorage\Reader\ConfigurableBundleTemplateImageStorageReader;
use Spryker\Client\ConfigurableBundleStorage\Reader\ConfigurableBundleTemplateImageStorageReaderInterface;
use Spryker\Client\ConfigurableBundleStorage\Reader\ProductConcreteStorageReader;
use Spryker\Client\ConfigurableBundleStorage\Reader\ProductConcreteStorageReaderInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ConfigurableBundleStorageFactory extends AbstractFactory
{
    public function createConfigurableBundleStorageReader(): ConfigurableBundleStorageReaderInterface
    {
        return new ConfigurableBundleStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
            $this->createConfigurableBundleTemplateImageStorageExpander(),
            $this->getUtilEncodingService(),
        );
    }

    public function createConfigurableBundleTemplateImageStorageReader(): ConfigurableBundleTemplateImageStorageReaderInterface
    {
        return new ConfigurableBundleTemplateImageStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
            $this->getUtilEncodingService(),
        );
    }

    public function createConfigurableBundleTemplateImageStorageExpander(): ConfigurableBundleTemplateImageStorageExpanderInterface
    {
        return new ConfigurableBundleTemplateImageStorageExpander(
            $this->createConfigurableBundleTemplateImageStorageReader(),
        );
    }

    public function createProductConcreteStorageReader(): ProductConcreteStorageReaderInterface
    {
        return new ProductConcreteStorageReader($this->getProductStorageClient());
    }

    public function getStorageClient(): ConfigurableBundleStorageToStorageClientInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleStorageDependencyProvider::CLIENT_STORAGE);
    }

    public function getProductStorageClient(): ConfigurableBundleStorageToProductStorageClientInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleStorageDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }

    public function getSynchronizationService(): ConfigurableBundleStorageToSynchronizationServiceInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }

    public function getUtilEncodingService(): ConfigurableBundleStorageToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleStorageDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
