<?php

namespace Controller\Admin;

class Category extends \Controller\Core\Admin {

   public function gridAction()
    {
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
    
    public function saveAction()
    { 
        try {
            $category = \Mage::getModel('Model\Category');
            $id = $this->getRequest()->getGet('id');
            if ($id) {
                $category = $category->load($id);
                $pathId = $category->pathId;
                if (!$category){
                    throw new \Exception ("Records not found.");
                }
                $categoryData = $this->getRequest()->getPost('category'); 
                $category = $category->setData($categoryData);
                $pathId = $category->pathId;
                if ($category->updatePathId()) {
                    $this->getMessage()->setSuccess('Category successfully Updated.');
                }else{
                    $this->getMessage()->setFailure('Unable to Update category.');
                }
                $category->updateChildrenPathIds($pathId);
            }
            else {
                $categoryData = $this->getRequest()->getPost('category'); 
                $category = $category->setData($categoryData);
                if ($category->save()) {
                    $this->getMessage()->setSuccess('Category Successfully Inserted');
                }
                else{
                    $this->getMessage()->setFailure('Unable to Insert Category');
                }
                $query = "SELECT * FROM `{$category->getTableName()}` WHERE `parentId` = '{$category->parentId}' ORDER BY `categoryId` DESC";
                $category = $category->fetchRow($query);
                $id = $category->categoryId;
                $category = $category->load($id);
                $category->updatePathId();
            }
        } 
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridBlock = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function editFormAction()
    {
        $editBlock = \Mage::getBlock('Block\Admin\Category\Edit');
        $leftBlock=\Mage::getBlock('Block\Admin\Category\Edit\Tabs');
        $category = \Mage::getModel('Model\Category');
        if ($id = $this->getRequest()->getGet('id')) {
            $category = $category->load($id);
            if (!$category) {
                throw new \Exception("No Product Data Found");
            }
        }
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($category)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function deleteAction()
    { 
        try {
            $category=\Mage::getModel("Model\Category");

            if ($id = $this->getRequest()->getGet('id')) {
                $category = $category->load($id);
                if (!$category) {
                    throw new \Exception("Id is Invalid");
                }
            }
            $pathId = $category->pathId;
            $parentId = $category->parentId;
            $category->updateChildrenPathIds($pathId, $parentId, $id);
            
            $category->delete();
        }  
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }  
        $gridBlock = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function statusAction()
    {
        $category = \Mage::getModel('Model\Category');
        $id = $this->getRequest()->getGet('id');
        if ($id) {
            $category = $category->load($id);
            if (!$category) {
                throw new \Exception("Invalid Id is given");
            }
        }
        else {
            throw new \Exception("Id is invalid");
        }
        if ($category->status == 'Enable') {
            $category->status = 'Disable';
        }
        else {
            $category->status = 'Enable';
        }
        if ($category->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        }
        else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}

?>