<?php

namespace Block\Admin\Category;


class Edit extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/core/edit.php');
    }
}
