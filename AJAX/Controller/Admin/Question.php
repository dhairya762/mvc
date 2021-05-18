<?php

namespace Controller\Admin;

class Question extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock('Block\Admin\Question\Grid')->toHtml();
            $this->makeResponse($grid);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editFormAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
            $question = \Mage::getModel('Model\Question');
            if ($id) {
                $question = $question->load($id);
                if (!$question) {
                    throw new \Exception("Error Question Request");
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $leftBlock = \Mage::getBlock('Block\Admin\Question\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Question\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($question)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            $question = \Mage::getModel('Model\Question');
            $id = $this->getRequest()->getGet('id');
            $data = $this->getRequest()->getPost('question');
            if ($id) {
                $question = $question->load($id);
                if (!$question) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $question = $question->setData($data);
            if ($question->save()) {
                if ($id) {
                    $this->getMessage()->setSuccess('Successfully Updated.');
                } else {
                    $this->getMessage()->setSuccess('Successfully Inserted');
                }
            } else {
                if ($id) {
                    $this->getMessage()->setFailure('Unable to Update');
                } else {
                    $this->getMessage()->setFailure('Unable to Insert.');
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Question\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function deleteAction()
    {
        try {
            $question = \Mage::getModel("Model\Question");
            $option = \Mage::getModel('Model\Question\Option');
            $id = $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Question not found in database.");
            }
            $question = $question->load($id);
            if (!$question) {
                throw new \Exception('Id is Invalid');
            }
            $query = "DELETE FROM `{$option->getTableName()}` WHERE `{$question->getPrimaryKey()}` = '{$id}'";
            if ($question->delete()) {
                if ($option->delete($query)) {
                    $this->getMessage()->setSuccess("Delete Successfully");
                }
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Question\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function statusAction()
    {
        $question = \Mage::getModel('Model\Question');
        $id = $this->getRequest()->getGet('id');
        if ($id) {
            $question = $question->load($id);
            if (!$question) {
                throw new \Exception("Invalid Id is given");
            }
        } else {
            throw new \Exception("Id is invalid");
        }
        if ($question->status == 'Enable') {
            $question->status = 'Disable';
        } else {
            $question->status = 'Enable';
        }
        if ($question->save()) {
            $this->getMessage()->setSuccess("Status changed Successfully");
        } else {
            $this->getMessage()->setFailure('Unable to change status');
        }
        $grid = \Mage::getBlock('Block\Admin\Question\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}
