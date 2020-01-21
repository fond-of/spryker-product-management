<?php

namespace FondOfSpryker\Zed\ProductManagement\Communication\Form;

use FondOfSpryker\Zed\ProductManagement\Communication\Form\Product\Price\ProductMoneyCollectionType;
use Generated\Shared\Transfer\PriceProductTransfer;
use Spryker\Zed\ProductManagement\Communication\Form\Product\Price\ProductMoneyType;
use Spryker\Zed\ProductManagement\Communication\Form\ProductFormAdd as SprykerProductFormAdd;
use Spryker\Zed\ProductManagement\Communication\Form\Validator\Constraints\ProductPriceNotBlank;
use Symfony\Component\Form\FormBuilderInterface;

class ProductFormAdd extends SprykerProductFormAdd
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return \Spryker\Zed\ProductManagement\Communication\Form\ProductFormAdd
     */
    protected function addPriceForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder->add(
            static::FIELD_PRICES,
            ProductMoneyCollectionType::class,
            [
                'entry_options' => [
                    'data_class' => PriceProductTransfer::class,
                ],
                'entry_type' => ProductMoneyType::class,
                'constraints' => [
                    new ProductPriceNotBlank([
                        'groups' => [static::VALIDATION_GROUP_PRICE_SOURCE],
                    ]),
                ],
            ]
        );

        return $this;
    }
}
