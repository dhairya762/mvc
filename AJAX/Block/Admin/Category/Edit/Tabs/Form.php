<?php

namespace Block\Admin\Category\Edit\Tabs;

class Form extends \Block\Core\Template
{
    protected $category = NULL;
    protected $categories = NULL;
    protected $categoryOptions = [];
    protected $categoryPath = [];

    public function __construct()
    {
        $this->setTemplate('./View/admin/category/edit/tabs/form.php');
    }
    public function setCategory($category = NULL)
    {
        if (!$category) {
            $category = \Mage::getModel('Model\category');
            if ($id = $this->getRequest()->getGet('id')) {
                $category = $category->load($id);
            }
        }
        $this->category = $category;
        return $this;
    }

    public function getcategory()
    {
        if (!$this->category) {
            $this->setcategory();
        }
        return $this->category;
    }

    public function setCategories($categories = NULL)
    {
        if (!$categories) {
            $categories = \Mage::getModel('Model\Category');
            $categories = $categories->fetchAll();
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

    public function getCategoryOptions()
    {
        if (!$this->categoryOptions) {
            $query = "SELECT `categoryId`,`name` FROM `{$this->getCategory()->getTableName()}` WHERE `categoryId` != '{$this->getCategory()->categoryId}' AND `pathId` NOT LIKE '{$this->getCategory()->pathId}/%' ORDER BY `pathId`";
            // $query = "SELECT `categoryId`,`name` FROM `{$this->getCategory()->getTableName()}`;";
            $options = $this->getCategory()->getAdapter()->fetchPairs($query);

            $pathId = " ";
            if ($this->getCategory()->pathId) {
                $pathId = $this->getCategory()->pathId . '=%';
            }
            $query = "SELECT `categoryId`,`pathId` FROM `{$this->getCategory()->getTableName()}`;";

            $this->categoryOptions = $this->getCategory()->getAdapter()->fetchPairs($query);

            if (!$this->categoryOptions) {
                $this->categoryOptions = [];
            }

            if ($this->categoryOptions) {
                foreach ($this->categoryOptions as $categoryId => &$pathId) {
                    $pathIds = explode("=", $pathId);
                    foreach ($pathIds as $key => &$id) {
                        if (array_key_exists($id, $options)) {
                            $pathIds[$key] = $options[$id];
                        }
                    }
                    $this->categoryOptions[$categoryId] = implode("/", $pathIds);
                }
            }
            $this->categoryOptions = ["0" => "Root Category"] + $this->categoryOptions;
        }
        return $this->categoryOptions;
    }

    public function getName()
    {
        $categoryOptions = $this->getCategoryOptions();
    }

    public function getTitle()
    {
        $id = $this->getRequest()->getGet('id');
        if ($id) {
            return "Update Category";
        }
        return "Add Category";
    }
}
