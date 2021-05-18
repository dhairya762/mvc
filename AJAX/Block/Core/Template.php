<?php

namespace Block\Core;

class Template
{
    protected $template = null;
    protected $controller = null;
    protected $children = [];
    protected $message = null;
    protected $filter = null;
    protected $request = null;
    protected $url = null;
    protected $tabs = [];
    protected $defaultTab = null;

    public function createBlock($className)
    {
        return \Mage::getBlock($className);
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setController(\Controller\Core\Admin $controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function toHtml()
    {
        ob_start();
        require_once $this->getTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren(array $children)
    {
        $this->children = $children;
        return $this;
    }

    public function addChild($child, $key = null)
    {
        if (!$key) {
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }

    public function getChild($key)
    {
        if (!array_key_exists($key, $this->children)) {
            return null;
        }
        return $this->children[$key];
    }

    public function removeChildren($key)
    {
        if (array_key_exists($key, $this->children)) {
            unset($this->childern[$key]);
        }
        return $this;
    }

    public function setRequest(\Model\Core\Request $request = NULL)
    {
        if (!$request) {
            $request = \Mage::getModel('Model\Core\Request');
        }
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        if (!$this->request) {
            $this->setRequest();
        }
        return $this->request;
    }

    public function setMessage(\Model\Core\Message $message = null)
    {
        if (!$message) {
            $message =  \Mage::getModel('Model\Admin\Message');
        }
        $this->message = $message;
        return $this;
    }

    public function getMessage()
    {
        if (!$this->message) {
            $this->setMessage();
        }
        return $this->message;
    }

    public function setFilter(\Model\Core\Filter $filter = null)
    {
        if (!$filter) {
            $filter = \Mage::getModel('Model\Admin\Filter');
        }
        $this->filter = $filter;
        return $this;
    }

    public function getFilter()
    {
        if (!$this->filter) {
            $this->setFilter();
        }
        return $this->filter;
    }

    public function setUrl(\Model\Core\Url $url = null)
    {
        if (!$url) {
            $url = \Mage::getModel('Model\Core\Url');
        }
        $this->url = $url;
        return $this;
    }

    public function getUrl()
    {
        if (!$this->url) {
            $this->setUrl();
        }
        return $this->url;
    }

    public function baseUrl($subUrl)
    {
        return $this->getUrl()->baseUrl($subUrl);
    }

    public function setDefaultTab($defaultTab = null)
    {
        $this->defaultTab = $defaultTab;
        return $this;
    }

    public function getDefaultTab()
    {
        if (!$this->defaultTab) {
            $this->setDefaultTab();
        }
        return $this->defaultTab;
    }

    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs($key = null)
    {
        if ($key) {
            if (array_key_exists($key, $this->tabs)) {
                return $this->tabs[$key];
            }
        } else {
            return $this->tabs;
        }
    }

    public function addTab($key, array $tab)
    {
        $this->tabs[$key] = $tab;
        return $this;
    }

    public function removeTab($key)
    {
        if (array_key_exists($key, $this->tabs)) {
            unset($tabs[$key]);
        }
        return $this;
    }
}
