<?php

namespace Model;

class Attribute extends \Model\Core\Table
{

    const STATUS_ENABLED = 'Enable';
    const  STATUS_DISABLED = 'Disable';

    public function __construct()
    {
        $this->setTableName("attribute");
        $this->setPrimaryKey("attributeId");
    }

    public function getBackendTypeOption()
    {
        return [
            'varchar(255)' => 'Varchar',
            'int' => 'Int',
            'decimal' => 'Decimal',
            'text' => 'Text'
        ];
    }

    public function getInputTypeOption()
    {
        return [
            'text' => 'Text Box',
            'textarea' => 'Text Area',
            'select' => 'Select',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio'
        ];
    }

    public function getEntityTypeOptions()
    {
        return [
            'product' => 'Product',
            'category' => 'Category'
        ];
    }

}
