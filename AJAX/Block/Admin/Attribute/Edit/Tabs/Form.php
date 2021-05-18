<?php

namespace Block\Admin\Attribute\Edit\Tabs;

class Form extends \Block\Core\Template
{
    protected $attribute = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/attribute/edit/tabs/form.php');
    }

    public function setAttribute($attribute = NULL)
    {
        if ($attribute) {
            $this->attribute = $attribute;
            return $this;
        }
        $attribute = \Mage::getModel('Model\Attribute');

        if ($id = $this->getRequest()->getGet('attributeId')) {
            $attribute = $attribute->load($id);
        }
        $this->attribute = $attribute;
        return $this;
    }
    
    public function getAttribute()
    {
        if (!$this->attribute) {
            $this->setAttribute();
        }
        return $this->attribute;
    }

    public function getTitle()
    {
        $id = $this->getRequest()->getGet('attributeId');
        if ($id) {
            return "Update Attributr";
        }
        return "Add Attribute";
    }
}
