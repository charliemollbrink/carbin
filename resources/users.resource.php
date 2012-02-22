<?php
class users extends Resource{
 
  function __construct($method, $id, $data){
    $this->entity = "people";
    $this->fields['get'] = "id,name,phone";
    $this->fields['put'] = "name,phone";
    parent::__construct($method, $id, $data);
  }
 
}
?>