<?php

namespace Block\Admin\Product\Edit\Tabs;

class GroupPrice extends \Block\Core\Template
{
    protected $groupPrice = [];

    public function __construct()
    {
        $this->setTemplate('./View/admin/product/edit/tabs/groupPrice.php');
    }

    public function setGroupPrice($groupPrice = null)
    {
        if (!$groupPrice) {
            $product = \Mage::getModel('Model\Product');
            $productGroup = \Mage::getModel('Model\Product\Group\Price');
            $id = $this->getRequest()->getGet('productId');
            if ($id) {
                $query = " SELECT cg.`groupId` , cg.`name` AS `groupName`, pgp.`customerGroupId` , pgp.`groupPrice`
                    FROM `customer_group` AS `cg` 
                    LEFT JOIN `{$productGroup->getTableName()}` AS `pgp` 
                        ON cg.`groupId` = pgp.`customerGroupId` 
                        AND pgp.`productId` = {$id}
                    LEFT JOIN `{$product->getTableName()}` AS `p` 
                        ON pgp.`productId` = p.`productId`";
                $groupPrice = $product->fetchAll($query)->getdata();
            }
        }
        $this->groupPrice = $groupPrice;
        return $this;
    }

    public function getGroupPrice()
    {
        if (!$this->groupPrice) {
            $this->setGroupPrice();
        }
        return $this->groupPrice;
    }
}
