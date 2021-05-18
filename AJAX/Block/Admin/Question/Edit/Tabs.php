<?php

namespace Block\Admin\Question\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        $this->addTab('question',[
                'label' => 'Question Information',
                'block' => 'Block\Admin\Question\Edit\Tabs\Form'
            ]
        );
        if ($this->getRequest()->getGet('id')) {

            $this->addTab('option', [
                'label' => 'Option Information',
                'block' => 'Block\Admin\Question\Edit\Tabs\Option'
            ]);
        }
        $this->setDefaultTab('question');
        return $this;
    }
}
