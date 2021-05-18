<?php

namespace Block\Admin\Product;

class Grid extends \Block\Core\Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollection('Model\Product');
    }

    public function prepareColumn()
    {
        $this->addColumn('productId', [
            'field' => 'productId',
            'label' => 'Product Id',
            'type' => 'int'
        ]);

        $this->addColumn('sku', [
            'field' => 'sku',
            'label' => 'Sku',
            'type' => 'varchar'
        ]);

        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Name',
            'type' => 'varchar'
        ]);

        $this->addColumn('price', [
            'field' => 'price',
            'label' => 'Price',
            'type' => 'int'
        ]);

        $this->addColumn('discount', [
            'field' => 'discount',
            'label' => 'Discount',
            'type' => 'int'
        ]);

        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Status',
            'type' => 'varchar'
        ]);
        
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'Created Date',
            'type' => 'datetime'
        ]);
    }

    public function getTitle()
    {
        return "Manage Product";
    }
}
