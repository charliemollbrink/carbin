<?php
class recipes extends Resource{
 
  function __construct($method, $id, $idLev2, $data, $resourceLev2){
    $this->entity = "recipe";
    $this->fields['get'] = "id,title,description,instructions";
    
    parent::__construct($method, $id, $idLev2, $data, $resourceLev2);
  }
 
}

?>


