<?php

namespace Block\Admin\Question\Edit\Tabs;

class Form extends \Block\Core\Template
{

    protected $question = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/question/edit/tabs/form.php');
    }

    public function setQuestion($question = NULL)
    {
        if ($question) {
            $this->question = $question;
            return $this;
        }
        $question = \Mage::getModel('Model\Question');
        $id = $this->getRequest()->getGet('id');
        if ($id) {
            $question = $question->load($id);
            if (!$question) {
                throw new \Exception("Invalid Question selected.");
            }
        }
        $this->question = $question;
        return $this;
    }
    
    public function getQuestion()
    {
        if (!$this->question) {
            $this->setQuestion();
        }
        return $this->question;
    }

    public function getTitle()
    {
        $id = $this->getRequest()->getGet('id');
        if ($id) {
            return "Update Question";
        }
        return "Add Question";
    }
}
