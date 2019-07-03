<?php

namespace FondOfSpryker\Zed\ProductManagement\Communication;

use FondOfSpryker\Zed\ProductManagement\Communication\Tabs\ProductFormAddTabs;
use FondOfSpryker\Zed\ProductManagement\Communication\Tabs\ProductFormEditTabs;
use FondOfSpryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapper;
use FondOfSpryker\Zed\ProductManagement\ProductManagementDependencyProvider;
use Spryker\Zed\Gui\Communication\Tabs\TabsInterface;
use Spryker\Zed\ProductManagement\Communication\ProductManagementCommunicationFactory as BaseProductManagementCommunicationFactory;

class ProductManagementCommunicationFactory extends BaseProductManagementCommunicationFactory
{
    public const PLUGINS_PRODUCT_ABSTRACT_FORM_TABS_EXPANDER = 'PLUGINS_PRODUCT_ABSTRACT_FORM_TABS_EXPANDER';

    /**
     * @return \Spryker\Zed\Gui\Communication\Tabs\TabsInterface
     */
    public function createProductFormAddTabs(): TabsInterface
    {
        return new ProductFormAddTabs(
            $this->getProductAbstractFormTabsExpanderPlugins()
        );
    }

    /**
     * @return \Spryker\Zed\Gui\Communication\Tabs\TabsInterface
     */
    public function createProductFormEditTabs(): TabsInterface
    {
        return new ProductFormEditTabs(
            $this->getProductAbstractFormTabsExpanderPlugins(),
            $this->getProductAbstractFormEditTabsExpanderPlugins()
        );
    }

    /**
     * @return \Spryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapper
     */
    public function createProductFormTransferGenerator()
    {
        return new ProductFormTransferMapper(
            $this->getProductQueryContainer(),
            $this->getQueryContainer(),
            $this->getLocaleFacade(),
            $this->createLocaleProvider(),
            $this->getProductFormTransferMapperExpanderPlugins(),
            $this->getProductAbstractFormTransferMapperExpanderPlugins(),
            $this->createProductConcreteSuperAttributeFilterHelper()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\ProductManagement\Dependency\Plugin\ProductAbstractFormTabsExpanderPluginInterface[]
     */
    public function getProductAbstractFormTabsExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ProductManagementDependencyProvider::PLUGINS_PRODUCT_ABSTRACT_FORM_TABS_EXPANDER);
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\ProductManagement\Dependency\Plugin\ProductAbstractFormTabsExpanderPluginInterface[]
     */
    public function getProductAbstractFormTransferMapperExpanderPlugins(): array
    {
        return $this->getProvidedDependency(ProductManagementDependencyProvider::PLUGINS_PRODUCT_ABSTRACT_FORM_TRANSFER_MAPPER_EXPANDER);
    }
}
