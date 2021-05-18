<?php

namespace Controller\Admin\Product;

class Media extends \Controller\Core\Admin
{
    public function addImageAction()
    {
        $media = \Mage::getModel('Model\Product\Media');
        $id = $this->getRequest()->getGet('productId');
        $name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = 'Upload/';

        if (move_uploaded_file($tmp_name, $location . $name)) {
            $media->image = $location . $name;
            $media->label = $name;
            $media->productId = $id;
            if ($media->save()) {
                $this->getMessage()->setSuccess('Successfully Inserted.');
            }
            else {
                $this->getMessage()->setFailure('Unable to Insert.');
            }
        }

        $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($media)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function updateImageAction()
    {
        $radio = [];
        $media = \Mage::getModel('Model\Product\Media');
        $id = $this->getRequest()->getGet('productId');
        if (!$id) {
            throw new \Exception("Product is not available");
        }
        $data = $this->getRequest()->getPost();

        if (array_key_exists('small', $data)) {
            $radio['small'] = $data['small'];
        }
        if (array_key_exists('thumb', $data)) {
            $radio['thumb'] = $data['thumb'];
        }
        if (array_key_exists('base', $data)) {
            $radio['base'] = $data['base'];
        }
        foreach ($data['label'] as $key => $value) {
            $query = "UPDATE `{$media->getTableName()}` SET `label` = '{$data['label'][$key]}',";
            foreach ($radio as $key2 => $value2) {
                if ($value2 == $key) {
                    $query .= "`{$key2}` = 1,";
                } else {
                    $query .= "`{$key2}` = 0,";
                }
            }
            $query .= "`gallery` = ";
            if (array_key_exists('gallery', $data) && array_key_exists($key, $data['gallery'])) {
                $query .= "1";
            } else {
                $query .= "0";
            }
            $query .= " WHERE `{$media->getPrimaryKey()}` = '{$key}'";
            if ($media->save($query)) { 
                $this->getMessage()->setSuccess('Successfully Updated.');
            }
            else {
                $this->getMessage()->setFailure('Unable to Update.');
            }

        }
        $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($media)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function removeImageAction()
    {
        $media = \Mage::getModel('Model\Product\Media');
        if ($this->getRequest()->getPost('delete')) {
            $ids = $this->getRequest()->getPost('delete');

            if ($ids) {
                foreach ($ids as $key => $value) {
                    $media = $media->load($key);
                    $id = $media->imageId;
                    $query = "Delete FROM `{$media->getTableName()}` WHERE `{$media->getPrimaryKey()}` = '{$id}'";
                    if (unlink($media->image)) {
                        if ($media->delete($query)) {
                            $this->getMessage()->setSuccess('Delete Successfully.');
                        }
                        else {
                            $this->getMessage()->setFailure('Unable to Delete.');
                        }
                    }
                }
            }
        }
        $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($media)->toHtml();
        $this->makeResponse($editBlock);
    }
}
