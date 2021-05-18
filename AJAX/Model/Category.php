<?php

namespace Model;

class Category extends \Model\Core\Table
{
    const STATUS_ENABLED = 'Enable';
    const  STATUS_DISABLED = 'Disable';

    public function __construct()
    {

        $this->tableName = 'new_category';
        $this->primaryKey = 'categoryId';
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }

    public function updatePathId()
    {
        if (!$this->parentId) {
            $pathId = $this->categoryId;
        } else {
            $parent = \Mage::getBlock('Block\Admin\Category\Edit\Tabs\Form')->getCategory()->load($this->parentId);
            $pathId = $parent->pathId . "=" . $this->categoryId;
        }
        $this->pathId = $pathId;
        return $this->save();
    }

    public function updateChildrenPathIds($categoryPathId, $parentId = null, $categoryId = null)
    {
        $category = \Mage::getModel("Model\Category");

        $categoryPathId = $categoryPathId . "=";
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `pathId` LIKE '{$categoryPathId}%' ORDER BY `pathId` ASC";
        $categories = $category->getAdapter()->fetchAll($query);

        if ($categories) {
            foreach ($categories as $key => $row) {
                $row = \Mage::getModel("Model\Category")->load($row['categoryId']);
                if ($parentId != null) {
                    if ($row->parentId == $categoryId) {
                        $row->parentId = $parentId;
                    }
                }
                $row->updatePathId();
            }
        }
    }
}
