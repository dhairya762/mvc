<?php

namespace Model;

class Product extends \Model\Core\Table
{

    const STATUS_ENABLED = 'Enable';
    const  STATUS_DISABLED = 'Disable';

    public function __construct()
    {
        $this->setTableName("product");
        $this->setPrimaryKey("productId");
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }
}
