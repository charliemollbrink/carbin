<?php
class recipes extends Resource{
 
  function __construct($method, $id, $data){
    $this->entity = "recipes";
    $this->id = "id";
    $this->fields['get'] = "id,title,description,instructions";
    $this->fields['post'] = "title,description,instructions";
    $this->fields['put'] = "title,description,instructions";
    
    parent::__construct($method, $id, $data);
  }
 
}

?>


