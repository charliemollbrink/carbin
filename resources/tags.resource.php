<?php
class tags extends Resource{
 
  function __construct($method, $id, $data){
  	$this->entity = "tags_view";
  	$this->id = "recipe_id";
  	$this->fields['get'] = "recipe_id,tag_id,tag,percent";
    parent::__construct($method, $id, $data);
  }
 
}
?>