<?php

namespace Model\Cart\Address;

class Collection extends \Model\Core\Table\Collection
{
    public function __construct()
    {
        \Mage::getModel('Model\Core\Table\Collection');
    }
}
