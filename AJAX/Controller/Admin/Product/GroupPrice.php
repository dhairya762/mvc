<?php

namespace Controller\Admin\Product;

class GroupPrice extends \Controller\Core\Admin
{
    public function groupPriceAction()
    {
        $product = \Mage::getModel('Model\Product');
        $id = $this->getRequest()->getGet('productId');
        $productGroup = \Mage::getModel('Model\Product\Group\Price');
        $data = $this->getRequest()->getPost();
        if ($data) {

            if (array_key_exists('old', $data['price'])) {
                $old = $data['price']['old'];
                foreach ($old as $key => $value) {
                    $query = "UPDATE `{$productGroup->getTableName()}` 
                    SET `groupPrice`='{$value}' 
                    WHERE `{$product->getPrimaryKey()}` = '{$id}' && `customerGroupId`='{$key}';";
                    if ($productGroup->save($query)) {
                        $this->getMessage()->setSuccess('Successfully Updated.');
                    } else {
                        $this->getMessage()->setFailure('Unable to Update.');
                    }
                }
            }
            if (array_key_exists('new', $data['price'])) {
                $new = $data['price']['new'];
                foreach ($new as $key => $value) {
                    if (!$value) {
                        continue;
                    }
                    $query = "INSERT INTO `{$productGroup->getTableName()}` (`{$product->getPrimaryKey()}`, `customerGroupId`, `groupPrice`)
                    VALUES({$id}, {$key}, '{$value}');";
                    if ($productGroup->save($query)) {
                        $this->getMessage()->setSuccess('Successfully Inserted.');
                    } else {
                        $this->getMessage()->setFailure('Unable to Insert.');
                    }
                }
            }
        }
        $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($productGroup)->toHtml();
        $this->makeResponse($editBlock);
    }
}
