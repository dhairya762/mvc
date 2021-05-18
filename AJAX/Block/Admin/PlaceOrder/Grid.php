<?php

namespace Block\Admin\PlaceOrder;
class Grid extends \Block\Core\Template{
    protected $placeOrder = null;

    public function __construct(){
        $this->setTemplate('./View/admin/placeOrder/grid.php');
    }

    public function setPlaceOrder(\Model\PlaceOrder $placeOrder = null){
        $this->placeOrder = $placeOrder;
        return $this;
    }
    public function getPlaceOrder(){
        if(!$this->placeOrder){
            throw new \Exception("PlaceOrder Is Not Set");
        }
        return $this->placeOrder;
    }
}