<?php
/**
 * FondOfSpryker Product Management Module Extends Spryker Product Management Module
 *
 * @author Jozsef Geng <gengjozsef86@gmail.com>
 */
namespace FondOfSpryker\Zed\ProductManagement\Communication\Transfer;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\ProductManagement\Communication\Form\ProductFormAdd;
use Spryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapper as BaseProductFormTransferMapper;


class ProductFormTransferMapper extends BaseProductFormTransferMapper
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected function createProductAbstractTransfer(array $data)
    {
        $productAbstractTransfer = (new ProductAbstractTransfer())
            ->fromArray($data, true)
            ->setIdProductAbstract($data[ProductFormAdd::FIELD_ID_PRODUCT_ABSTRACT])
            ->setSku($data[ProductFormAdd::FIELD_SKU])
            ->setIdTaxSet($data[ProductFormAdd::FIELD_TAX_RATE]);

        return $productAbstractTransfer;
    }

}