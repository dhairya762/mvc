<?php

namespace Model\Product\Group;

class Price extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setPrimaryKey('entityId');
        $this->setTableName('product_group_price');
    }
}
