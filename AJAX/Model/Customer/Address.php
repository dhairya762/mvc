<?php

namespace Model\Customer;

class Address extends \Model\Core\Table
{

    const ADDRESS_TYPE_BILLING = 'Billing';
    const ADDRESS_TYPE_SHIPPING = 'Shipping';
    
    public function __construct()
    {
        parent::__construct();
        $this->setTableName("customer_address");
        $this->setPrimaryKey("addressId");
    }
}
