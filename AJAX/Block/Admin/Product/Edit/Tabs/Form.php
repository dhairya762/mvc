<?php

namespace Block\Admin\Product\Edit\Tabs;

class Form extends \Block\Core\Template
{

    protected $product = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/product/edit/tabs/form.php');
    }

    public function setProduct($product = NULL)
    {
        if ($product) {
            $this->product = $product;
            return $this;
        }
        $product = \Mage::getModel('Model\Product');
        $id = $this->getRequest()->getGet('productId');
        if ($id) {
            $product = $product->load($id);
            if (!$product) {
                throw new \Exception("Invalid Product selected.");
            }
        }
        $this->product = $product;
        return $this;
    }
    
    public function getProduct()
    {
        if (!$this->product) {
            $this->setProduct();
        }
        return $this->product;
    }

    public function getTitle()
    {
        $id = $this->getRequest()->getGet('productId');
        if ($id) {
            return "Update Product";
        }
        return "Add Product";
    }
}
