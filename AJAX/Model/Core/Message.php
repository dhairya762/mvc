<?php

namespace Model\Core;

class Message extends \Model\Core\Session
{

    public function setSuccess($message)
    {
        $this->success = $message;
        return $this;
    }

    public function getSuccess()
    {
        if (empty($_SESSION)) {
            return null;
        }
        return $this->success;
    }

    public function setFailure($message)
    {
        $this->failuer = $message;
        return $this;
    }

    public function getFailure()
    {
        if (empty($_SESSION)) {
            return null;
        }
        return $this->failure;
    }

    public function clearSuccess()
    {
        unset($this->success);
        return $this;
    }

    public function clearFailure()
    {
        unset($this->failure);
        return $this;
    }
}
