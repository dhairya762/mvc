<?php
namespace Block\Admin\Question\Edit\Tabs;

class Option extends \Block\Core\Edit
{
    protected $question = null;
    protected $options = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/question/edit/tabs/option.php');
    }

    public function setQuestion($question = NULL)
    {
        if ($question) {
            $this->question = $question;
            return $this;
        }
        $question = \Mage::getModel('Model\Question');

        if ($id = $this->getRequest()->getGet('id')) {
            $question = $question->load($id);
        }
        $this->question = $question;
        return $this;
    }

    public function getQuestion()
    {
        if(!$this->question)
        {
            $this->setQuestion();
        }
        return $this->question;
    }

    public function getOptions()
    {
        if (!$this->options) {
            $this->setOptions();
        }
        return $this->options;
    }

    public function setOptions($options = null)
    {
        if ($options) {
            $this->options = $options;
            return $this;
        }
        $id = $this->getRequest()->getGet('id');
        $option = \Mage::getModel('Model\Question\Option');
        $query = "SELECT * FROM `{$option->getTableName()}` WHERE `questionId` = '{$id}'";
        $option = $option->fetChAll($query);
        if ($option) {
            $this->options = $option->getData();
        }
        return $this;
    }

}