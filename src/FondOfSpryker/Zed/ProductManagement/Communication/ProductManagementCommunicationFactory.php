<?php

namespace FondOfSpryker\Zed\ProductManagement\Communication;

use  FondOfSpryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapper;
use  Spryker\Zed\ProductManagement\Communication\ProductManagementCommunicationFactory as BaseProductManagementCommunicationFactory;

class ProductManagementCommunicationFactory extends BaseProductManagementCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapper
     */
    public function createProductFormTransferGenerator()
    {
        return new ProductFormTransferMapper(
            $this->getProductQueryContainer(),
            $this->getQueryContainer(),
            $this->getLocaleFacade(),
            $this->createLocaleProvider(),
            $this->getProductFormTransferMapperExpanderPlugins(),
            $this->createProductConcreteSuperAttributeFilterHelper()
        );
    }
}
