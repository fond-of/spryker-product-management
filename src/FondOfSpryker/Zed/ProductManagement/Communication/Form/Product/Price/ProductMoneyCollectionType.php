<?php

namespace FondOfSpryker\Zed\ProductManagement\Communication\Form\Product\Price;

use Spryker\Zed\ProductManagement\Communication\Form\Product\Price\ProductMoneyCollectionType as SprykerProductMoneyCollectionType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class ProductMoneyCollectionType extends SprykerProductMoneyCollectionType
{
    /**
     * @param \Symfony\Component\Form\FormView $formViewCollection
     * @param \Symfony\Component\Form\FormInterface $form
     * @param array $options
     *
     * @return void
     */
    public function finishView(FormView $formViewCollection, FormInterface $form, array $options): void
    {
        parent::finishView($formViewCollection, $form, $options);

        $this->sortTable($formViewCollection->vars['priceTypes']);
    }
}
