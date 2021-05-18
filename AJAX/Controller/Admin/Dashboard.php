<?php

namespace Controller\Admin;

class Dashboard extends \Controller\Core\Admin
{

    public function gridAction()
    {
        $layout = $this->getLayout();
        echo $layout->toHtml();
    }
}
