<?php
class ingredients extends Resource{
 
  function __construct($method, $id, $data){
  	$this->entity = "ingredients_view";
  	$this->id = "recipe_id";
  	$this->fields['get'] = "id,recipe_id,ingredient_id,ingredient,amount,unit_id,unit";
    parent::__construct($method, $id, $data);
  }
 
}
?>