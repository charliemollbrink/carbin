<?php
class tags extends Resource{
 
  function __construct($method, $id, $data){
  	if($method === 'GET'){
  		$this->entity = "tags_view";
  	} else {
  		$this->entity = "recipe_tags";
  	}
  	$this->id = "recipe_id";
  	$this->fields['get'] = "recipe_id,tag_id,tag,percent";
  	$this->fields['post'] = "recipe_id,tag_id";
    parent::__construct($method, $id, $data);
  }
 
}
?>