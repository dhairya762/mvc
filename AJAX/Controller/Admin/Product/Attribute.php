<?php

namespace Controller\Admin\Product;

class Attribute extends \Controller\Core\Admin 
{
    public function saveAction()
    {
        $productId = $this->getRequest()->getGet('productId');
        $attributeData = $this->getRequest()->getPost('attribute');
        $product = \Mage::getModel('Model\Product')->load($productId);
        $product->setData($attributeData);
        if ($product->save()) {
            $this->getMessage()->setSuccess('Attribute successfully updated');
        }else {
            $this->getMessage()->setFailure('Unable to update attribute');
        }
        $this->redirect('grid', 'product');
    }
}
