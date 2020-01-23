<?php

namespace FondOfSpryker\Zed\ProductManagement\Communication;

use FondOfSpryker\Zed\ProductManagement\Communication\Form\ProductConcreteFormAdd;
use FondOfSpryker\Zed\ProductManagement\Communication\Form\ProductConcreteFormEdit;
use FondOfSpryker\Zed\ProductManagement\Communication\Form\ProductFormAdd;
use FondOfSpryker\Zed\ProductManagement\Communication\Form\ProductFormEdit;
use FondOfSpryker\Zed\ProductManagement\Communication\Tabs\ProductFormAddTabs;
use FondOfSpryker\Zed\ProductManagement\Communication\Tabs\ProductFormEditTabs;
use FondOfSpryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapper;
use FondOfSpryker\Zed\ProductManagement\ProductManagementDependencyProvider;
use Spryker\Zed\Gui\Communication\Tabs\TabsInterface;
use Spryker\Zed\ProductManagement\Communication\ProductManagementCommunicationFactory as SprykerProductManagementCommunicationFactory;
use Spryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapperInterface;
use Symfony\Component\Form\FormInterface;

class ProductManagementCommunicationFactory extends SprykerProductManagementCommunicationFactory
{
    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createProductFormAdd(array $formData, array $formOptions = []): FormInterface
    {
        return $this->getFormFactory()->create(ProductFormAdd::class, $formData, $formOptions);
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createProductFormEdit(array $formData, array $formOptions = []): FormInterface
    {
        return $this->getFormFactory()->create(ProductFormEdit::class, $formData, $formOptions);
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getProductVariantFormAdd(array $formData, array $formOptions = []): FormInterface
    {
        return $this->getFormFactory()->create(ProductConcreteFormAdd::class, $formData, $formOptions);
    }

    /**
     * @param array $formData
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createProductVariantFormEdit(array $formData, array $formOptions = []): FormInterface
    {
        return $this->getFormFactory()->create(ProductConcreteFormEdit::class, $formData, $formOptions);
    }

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
     * @return \Spryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapperInterface
     */
    public function createProductFormTransferGenerator(): ProductFormTransferMapperInterface
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
