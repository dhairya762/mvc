<?php

namespace Block\Admin\Attribute\Edit\Tabs;

class Option extends \Block\Core\Template
{
    protected $option = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/attribute/edit/tabs/option.php');
    }

    public function getoption()
    {
        if (!$this->option) {
            $this->setOption();
        }
        return $this->option;
    }

    public function setOption($option = null)
    {
        if ($option) {
            $this->option = $option;
            return $this;
        }
        $option = \Mage::getModel('Model\Attribute\Option');
        $id = $this->getRequest()->getGet('optionId');
        if ($id) {
            $option = $option->load($id);
        }
        $this->option = $option;
        return $this;
    }
}
