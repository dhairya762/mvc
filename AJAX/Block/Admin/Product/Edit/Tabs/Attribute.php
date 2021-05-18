<?php 
namespace Block\Admin\Product\Edit\Tabs;
class Attribute extends \Block\Core\Template
{
	protected $attributes;
	protected $product = null;
	public function __construct(){
		$this->setTemplate('View/admin/product/edit/tabs/attribute.php');
	}

	public function setAttribute($attributes = null){
		if(!$attributes){
			$productId = $this->getRequest()->getGet('productId');
			$attributeModel = \Mage::getModel('Model\Attribute');
			$query = "SELECT * FROM `attribute` WHERE `entityTypeId` = 'product' ORDER BY `sortOrder`";
			$attributes = $attributeModel->fetchAll($query);
		}
		$this->attributes = $attributes;
		return $this;
	}

	public function getAttribute(){
		if(!$this->attributes){
			$this->setAttribute();
		}
		return $this->attributes;
	}

	public function getAttributeOption($attributeId) {
		$attributeOption = \Mage::getModel('Model\Attribute\Option');
		$query = "SELECT attribute_options.* , attribute.`code` FROM `attribute_options` LEFT JOIN `attribute` ON attribute_options.`attributeId` = attribute.`attributeId` WHERE attribute.`attributeId` = '{$attributeId}' ORDER BY `sortOrder` ASC";
		$attributeOption = $attributeOption->fetchAll($query);
		if ($attributeOption) {
			return $attributeOption->getData();
		}
		return null;
	}

	public function setProduct($product = null){
		try {
			if($product){
				$this->product = $product;
				return $this;
			}
			$product = \Mage::getModel('Model\Product');
			$productId = $this->getRequest()->getGet('productId');
			if($productId){
				$product->load($productId);
			}
			$this->product = $product;
			return $this;
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function getProduct(){
		if(!$this->product){
			$this->setProduct();
		}
		return $this->product;
	}
}