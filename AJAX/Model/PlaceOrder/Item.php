<?php

namespace Model\PlaceOrder;

class Item extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName("placeorderitem");
        $this->setPrimaryKey("placeOrderItemId");
    }
}
