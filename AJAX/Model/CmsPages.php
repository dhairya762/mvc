<?php

namespace Model;

class CmsPages extends \Model\Core\Table
{

    const STATUS_ENABLED = 'Enable';
    const  STATUS_DISABLED = 'Disable';

    public function __construct()
    {
        $this->setTableName("cms_page");
        $this->setPrimaryKey("pageId");
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }
}
