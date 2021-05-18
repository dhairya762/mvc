<?php

namespace Block\Admin\Category;

class Grid extends \Block\Core\Template
{
    protected $categoriesOptions = [];
    protected $categories = [];

    public function __construct()
    {
        $this->setTemplate('./View/admin/category/grid.php');
    }

    public function setCategories($categories = null)
    {
        if (!$categories) {
            $categoriesModel = \Mage::getModel('Model\category');
            $categories = $categoriesModel->fetchAll();
        }
        $this->categories = $categories;
        return $this;
    }

    public function getCategories()
    {
        if (!$this->categories) {
            $this->setCategories();
        }
        return $this->categories;
    }

    public function getName($category)
    {
        $categoryModel = \Mage::getModel('Model\Category');
        if (!$this->categoriesOptions) {
            $query = "SELECT `categoryId`,`name` FROM `{$categoryModel->getTableName()}`;";
            $this->categoriesOptions = $categoryModel->getAdapter()->fetchPairs($query);
        }
        $pathIds = explode('=', $category->pathId);
        foreach ($pathIds as $key => &$id) {
            if (array_key_exists($id, $this->categoriesOptions)) {
                $pathIds[$key] = $this->categoriesOptions[$id];
            }
        }
        $name = implode("/", $pathIds);
        return $name;
    }

    public function getTitle()
    {
        return "Manage Category";
    }
}
