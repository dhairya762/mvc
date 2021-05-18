<?php

namespace Block\Admin\Question;

class Grid extends \Block\Core\Template
{
    protected $questions = null;

    public function __construct()
    {
        $this->setTemplate('View\admin\question\grid.php');
    }

    public function getQuestion()
    {
        if (!$this->questions) {
            $this->setQuestion();
        }
        return $this->questions;
    }

    public function setQuestion($questions = null)
    {
        if ($questions) {
            $this->questions = $questions;
            return $this;
        }
        $id = $this->getRequest()->getGet('id');
        $question = \Mage::getModel('Model\Question');
        $questions = $question->fetchAll();
        $this->questions = $questions;
        return $this;
    }

    public function getTitle()
    {
        return "Manage Question";
    }
}
