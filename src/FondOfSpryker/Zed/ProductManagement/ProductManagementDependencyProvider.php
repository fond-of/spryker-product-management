<?php

namespace FondOfSpryker\Zed\ProductManagement;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductManagement\ProductManagementDependencyProvider as SprykerProductManagementDependencyProviderAlias;

class ProductManagementDependencyProvider extends SprykerProductManagementDependencyProviderAlias
{
    public const PLUGINS_PRODUCT_ABSTRACT_FORM_TABS_EXPANDER = 'PLUGINS_PRODUCT_ABSTRACT_FORM_TABS_EXPANDER';
    public const PLUGINS_PRODUCT_ABSTRACT_FORM_TRANSFER_MAPPER_EXPANDER = 'PLUGINS_PRODUCT_ABSTRACT_FORM_TRANSFER_MAPPER_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addProductAbstractFormTabsExpanderPlugins($container);
        $container = $this->addProductAbstractFormTransferMapperExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractFormTabsExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRODUCT_ABSTRACT_FORM_TABS_EXPANDER] = function () {
            return $this->getProductAbstractFormTabsExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ProductManagement\Dependency\Plugin\ProductAbstractFormTabsExpanderPluginInterface[]
     */
    protected function getProductAbstractFormTabsExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractFormTransferMapperExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_PRODUCT_ABSTRACT_FORM_TRANSFER_MAPPER_EXPANDER] = function () {
            return $this->getProductAbstractFormTransferMapperExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\ProductManagement\Dependency\Plugin\ProductAbstractFormTransferMapperExpanderPluginInterface[]
     */
    protected function getProductAbstractFormTransferMapperExpanderPlugins(): array
    {
        return [];
    }
}
