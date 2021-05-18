<?php

namespace Block\Admin\Shipping\Edit\Tabs;

class Form extends \Block\Core\Template
{
    protected $shipping = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/shipping/edit/tabs/form.php');
    }

    public function setShipping($shipping = NULL)
    {
        if (!$shipping) {
            $shipping = \Mage::getModel('Model\Shipping');
            if ($id = $this->getRequest()->getGet('methodId')) {
                $shipping = $shipping->load($id);
            }
        }
        $this->shipping = $shipping;
        return $this;
    }
    
    public function getShipping()
    {
        if (!$this->shipping) {
            $this->setShipping();
        }
        return $this->shipping;
    }

    public function getTitle()
    {
        $id = $this->getRequest()->getGet('methodId');
        if ($id) {
            return "Update Shipping";
        }
        return "Add Shipping";
    }
}
