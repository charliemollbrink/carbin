<?php
class tags extends Resource{
 
  function __construct($method, $id, $data){
  	$this->entity = "tags_view";
  	$this->id = "recipe_id";
  	$this->fields['get'] = "id,recipe_id,tag_id,tag";
    parent::__construct($method, $id, $data);
  }
 
}
?>