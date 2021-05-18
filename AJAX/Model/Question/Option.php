<?php

namespace Model\Question;

class Option extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setTableName('questionoption');
        $this->setPrimaryKey('optionId');
    }

    public function getOptions()
    {
        $id = $_GET['questionId'];
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `questionId` = '{$id}' ORDER BY `optionId` ASC";
        $option = $this->fetchAll($query);
        if ($option) {
            $option = $option->getData();
        }
        return $option;
    }
}
