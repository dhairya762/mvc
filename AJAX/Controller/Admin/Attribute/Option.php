<?php 
namespace Controller\Admin\Attribute;
class Option extends \Controller\Core\Admin 
{
    public function updateAction()
    {
        $attributeOption = \Mage::getModel('Model\Attribute\Option');
        $attribute = \Mage::getModel('Model\Attribute');
        $attributeId = $this->getRequest()->getGet('attributeId');
        $query =  "SELECT `{$attributeOption->getPrimaryKey()}` FROM `{$attributeOption->getTableName()}` WHERE `{$attribute->getPrimaryKey()}` = '{$attributeId}';";
        $data = $attributeOption->fetchAll($query);
        if($data){
            foreach($data->getData() as $key=>$value){
                $ids[] = $value->optionId;
            }
        }
        if($exist = $this->getRequest()->getPost('exist')){
            foreach ($exist as $key => $value) {
                unset($ids[array_search($key,$ids)]);
                $query = "UPDATE `{$attributeOption->getTableName()}` 
                    SET `name` = '{$value['name']}',`attributeId`= '{$attributeId}',`sortOrder`= '{$value['sortOrder']}' 
                    WHERE `optionId` = '{$key}';";
                $attributeOption->save($query);
            }
        }
        if(isset($ids) && $ids){
            if (empty($_POST)) {
                $ids = [];
            }
            $query = "DELETE FROM `{$attributeOption->getTableName()}` WHERE `{$attributeOption->getPrimaryKey()}` IN (".implode(",",$ids).");";
            $attributeOption->delete($query);
        }
        if($new = $this->getRequest()->getPost('new')){
            foreach ($new as $key => $value) {
                foreach($value as $key2=>$value2){
                    $newArray[$key2][$key] = $value2;
                }
            }
            foreach($newArray as $key=>$value){
                $query = "INSERT INTO `{$attributeOption->getTableName()}`(`name`, `attributeId`, `sortOrder`) 
                    VALUES ('{$value['name']}',{$attributeId},{$value['sortOrder']})";
                $attributeOption->save($query);
            }
        }
        $this->redirect('grid', 'attribute');
    }
}


?>