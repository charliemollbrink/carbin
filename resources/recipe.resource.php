<?php
class recipe extends Resource{
 
  function __construct($method, $id, $data){
    $this->entity = "recipe";
    $this->fields['get'] = "id,title,description,instructions";
    
    parent::__construct($method, $id, $data);
  }
 
}
?>