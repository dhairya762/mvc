<?php

namespace Model\Attribute;

class Option extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setTableName('attribute_options');
        $this->setPrimaryKey('optionId');
    }

    public function getOptions()
    {
        $id = $_GET['attributeId'];
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `attributeId` = '{$id}' ORDER BY `sortOrder` ASC";
        $attributeOption = $this->fetchAll($query);
        if ($attributeOption) {
            $attributeOption = $attributeOption->getData();
        }
        return $attributeOption;
    }
}
