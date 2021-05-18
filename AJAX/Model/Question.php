<?php

namespace Model;

class Question extends \Model\Core\Table
{

    const STATUS_ENABLED = 'Enable';
    const  STATUS_DISABLED = 'Disable';

    public function __construct()
    {
        $this->setTableName("question");
        $this->setPrimaryKey("questionId");
    }

    public function getStatusOption()
    {
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }

    public function getOptions($id)
    {
        $primary = ['option1', 'option2', 'option3', 'option4'];
        $newOptions = [];
        $option = \Mage::getModel('Model\Question\Option');
        $query = "SELECT optionName FROM `{$option->gettableName()}` WHERE `questionId` = '{$id}'";
        $options = $option->fetchAll($query);
        if ($options) 
        {
            foreach ($options->getData() as $key => $option) 
            {
                array_push($newOptions, $option->optionName);
            }
            if (sizeof($newOptions)) 
            {
                for ($i=sizeof(($newOptions)); $i < 4; $i++) { 
                    array_push($newOptions, Null);
                }
            }
            $originalOption = array_combine($primary, $newOptions);
            return $originalOption;
        }
        return null;
    }

    public function getCorrectAns($id)
    {
        $question = \Mage::getModel('Model\Question');
        $option = \Mage::getModel('Model\Question\Option');
        $query = "SELECT `optionName` FROM `{$option->getTableName()}` WHERE `is_right_choice` = '1' AND `questionId` = '{$id}'";
        $option = $option->fetchRow($query);
        if ($option) {
            return $option->optionName;
        }
        return null;
    }
}
