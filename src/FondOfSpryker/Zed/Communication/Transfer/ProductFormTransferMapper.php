<?php

namespace FondOfSpryker\Zed\ProductManagement\Communication\Transfer;

use ArrayObject;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\ProductManagement\Communication\Form\ProductFormAdd;
use Spryker\Zed\ProductManagement\Communication\Transfer\ProductFormTransferMapper as BaseProductFormTransferMapper;
use Symfony\Component\Form\FormInterface;

class ProductFormTransferMapper extends BaseProductFormTransferMapper
{

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function buildProductAbstractTransfer(FormInterface $form, $idProductAbstract)
    {
        $formData = $form->getData();
        $localeCollection = $this->localeProvider->getLocaleCollection();

        $productAbstractTransfer = $this->createProductAbstractTransfer($formData);


        $attributes = $this->getAbstractAttributes($idProductAbstract);
        $productAbstractTransfer->setAttributes($attributes);

        $localizedData = $this->generateLocalizedData($localeCollection, $formData);

        foreach ($localizedData as $localeCode => $data) {
            $localeTransfer = $this->localeFacade->getLocale($localeCode);

            $localizedAttributesTransfer = $this->createAbstractLocalizedAttributesTransfer($form, $localeTransfer, $idProductAbstract);

            $productAbstractTransfer->addLocalizedAttributes($localizedAttributesTransfer);
        }

        $imageSetCollection = $this->buildProductImageSetCollection($form);
        $productAbstractTransfer->setImageSets(new ArrayObject($imageSetCollection));
        $productAbstractTransfer->setStoreRelation($formData[ProductFormAdd::FORM_STORE_RELATION]);
        $productAbstractTransfer->setPrices($formData[ProductFormAdd::FIELD_PRICES]);

        return $productAbstractTransfer;
    }

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