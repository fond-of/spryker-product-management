<?php

namespace FondOfSpryker\Zed\ProductManagement\Communication\Tabs;

use Generated\Shared\Transfer\TabsViewTransfer;
use Spryker\Zed\ProductManagement\Communication\Tabs\ProductFormEditTabs as SprykerProductFormEditTabs;

class ProductFormEditTabs extends SprykerProductFormEditTabs
{
    /**
     * @var \FondOfSpryker\Zed\ProductManagement\Dependency\Plugin\ProductAbstractFormTabsExpanderPluginInterface[]
     */
    protected $productAbstractFormTabsExpanderPlugins;

    /**
     * @param \FondOfSpryker\Zed\ProductManagement\Dependency\Plugin\ProductAbstractFormTabsExpanderPluginInterface[] $productAbstractFormTabsExpanderPlugins
     * @param \Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductAbstractFormEditTabsExpanderPluginInterface[] $productAbstractFormEditTabsExpanderPlugins
     */
    public function __construct(
        array $productAbstractFormTabsExpanderPlugins = [],
        array $productAbstractFormEditTabsExpanderPlugins = []
    ) {
        parent::__construct($productAbstractFormEditTabsExpanderPlugins);
        $this->productAbstractFormTabsExpanderPlugins = $productAbstractFormTabsExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return \Generated\Shared\Transfer\TabsViewTransfer
     */
    protected function executeExpanderPlugins(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        $tabsViewTransfer = parent::executeExpanderPlugins($tabsViewTransfer);

        foreach ($this->productAbstractFormTabsExpanderPlugins as $productAbstractFormTabsExpanderPlugin) {
            $tabsViewTransfer = $productAbstractFormTabsExpanderPlugin->expand($tabsViewTransfer);
        }

        return $tabsViewTransfer;
    }
}
