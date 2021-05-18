<?php

namespace Block\Admin\Product\Edit\Tabs;

class Media extends \Block\Core\Template
{
    protected $media = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/product/edit/tabs/media.php');
    }

    public function setMedia($media = null)
    {
        $id = $this->getRequest()->getGet('productId');
        $product = \Mage::getModel('Model\Product');
        if ($media) {
            $this->media = $media;
            return $this;
        }

        $media = \Mage::getModel('Model\Product\Media');
        if ($id) {
            $query = "SELECT * FROM `{$media->getTableName()}` WHERE `{$product->getPrimaryKey()}`={$id}";
            $array = $media->fetchAll($query);
            if ($array) {
                $this->media = $array->getData();
            }
        }
        return $this;
    }
    
    public function getMedia()
    {
        if (!$this->media) {
            $this->setMedia();
        }
        return $this->media;
    }
}
