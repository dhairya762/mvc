<?php

namespace Block\Admin\CustomerGroup;

class Grid extends \Block\Core\Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollection('Model\CustomerGroup');
    }

    public function prepareColumn()
    {
        $this->addColumn('groupId', [
            'field' => 'groupId',
            'label' => 'Group Id',
            'type' => 'int'
        ]);
        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Name',
            'type' => 'text'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Status',
            'type' => 'text'
        ]);
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'Created Date',
            'type' => 'datetime'
        ]);
    }

    public function getTitle()
    {
        return "Manage Customer Group";
    }
}
