<?php

namespace Block\Admin\CmsPages\Edit\Tabs;

class Form extends \Block\Core\Template
{
    protected $cmsPages = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/cmsPages/edit/tabs/form.php');
    }

    public function setCmsPages($cmsPages = NULL)
    {
        if (!$cmsPages) {
            $cmsPages = \Mage::getModel('Model\CmsPages');
            if ($id = $this->getRequest()->getGet('pageId')) {
                $cmsPages = $cmsPages->load($id);
            }
        }
        $this->cmsPages = $cmsPages;
        return $this;
    }

    public function getCmsPages()
    {
        if (!$this->cmsPages) {
            $this->setCmsPages();
        }
        return $this->cmsPages;
    }

    public function getTitle()
    {
        $id = $this->getRequest()->getGet('pageId');
        if ($id) {
            return "Update CmsPage";
        }
        return "Add CmsPage";
    }
}
