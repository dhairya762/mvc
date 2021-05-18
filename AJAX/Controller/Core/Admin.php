<?php

namespace Controller\Core;

class Admin
{
	protected $request = null;
	protected $layout = null;
	protected $message = null;
	protected $filter = null;

	public function __construct()
	{
		$this->setRequest();
		$this->setLayout();
	}

	public function setRequest()
	{
		$request = \Mage::getModel('Model\Core\Request');
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if (!$this->request) {
			$this->setRequest();
		}
		return $this->request;
	}

	public function setLayout(\Block\Core\Layout $layout = null)
	{
		if (!$layout) {
			$layout = \Mage::getBlock('Block\Core\Layout');
		}
		$this->layout = $layout;
		return $this;
	}

	public function getlayout()
	{
		return $this->layout;
	}

	public function renderLayout()
	{
		$this->getLayout()->toHtml();
	}

	public function getUrl($actionName = NULL, $controllerName = NULL, $params = [], $resetParams = False)
	{
		$final = $this->getRequest()->getGet();

		if ($resetParams) {
			$final = [];
		}
		if ($actionName == NULL) {
			$actionName = $this->getRequest()->getGet('a');
		}
		if ($controllerName == NULL) {
			$controllerName = $this->getRequest()->getGet('c');
		}
		$final['c'] = $controllerName;
		$final['a'] = $actionName;

		$final = array_merge($final, $params);
		$queryString = http_build_query($final);
		unset($final);

		return "http://localhost/AJAX/index.php?{$queryString}";
	}

	public function redirect($actionName = NULL, $controllerName = NULL, $params = [], $resetParams = False)
	{
		header("location:" . $this->getUrl($actionName, $controllerName, $params, $resetParams));
	}

	public function setMessage($message = null)
	{
		$message =  \Mage::getModel('Model\Admin\Message');
		$this->message = $message;
		return $this;
	}

	public function getMessage()
	{
		if (!$this->message) {
			$this->setMessage();
		}
		return $this->message;
	}

	public function setFilter($filter = null)
	{
		if ($filter) {
			$this->filter = $filter;
			return $this;
		}
		$filter =  \Mage::getModel('Model\Admin\Filter');
		$this->filter =  $filter;
		return $this;
	}

	public function getFilter()
	{
		if (!$this->filter) {
			$this->setFilter();
		}
		return $this->filter;
	}

	public function makeResponse($block)
	{
		$response = [
			'status' => 'success',
			'message' => 'I can do it.',
			'element' => [
				'selector' => '#contentHtml',
				'html' => $block
			]
		];
		header("Content-Type: application/json");
		echo json_encode($response);
	}
}
