<?php
class ingredients extends Resource{
 
  function __construct($method, $id, $idLev2, $data, $resourceLev2){
    $this->entity = "ingredients_view";
    $this->idLev2 = "ingredient_id";
    $this->fields['get'] = "ingredient_id,ingredient,amount,unit";
    
    parent::__construct($method, $id, $idLev2, $data, $resourceLev2);
  }
 
}
?>