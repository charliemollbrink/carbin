<?php
 
abstract class Resource{
 
  protected $entity;
  protected $fields;
  public $data;
 
  function __construct($method, $id, $idLev2, $data, $resourceLev2){
 
    switch($method){
      case 'GET':
        if($resourceLev2 && $idLev2){
          $this->getLev2($id, $idLev2);
        } else if($resourceLev2){
          $this->get($id);
        } else if($id){
          $this->get($id);
        } else {
          $this->collection();
        }
        break;
      case 'POST':
          $this->post($data);
        break;
      case 'PUT':
          $this->put($id, $data);
        break;
      case 'DELETE':
          $this->delete($id);
        break;
    }
 
  }
  function get($id){
    $query = "
      SELECT {$this->fields['get']}
      FROM {$this->entity}
      WHERE id='$id'
    ";

    $result = mysql_query($query);
    while($row = mysql_fetch_assoc($result)){
      $resource[] = $row;
    }
    $this->data = $resource;
  }
  function getLev2($id, $idLev2){
    $id = mysql_real_escape_string($id);
    $idLev2 = mysql_real_escape_string($idLev2);
    $query = "
      SELECT {$this->fields['get']}
      FROM {$this->entity}
      WHERE id='$id'
      AND {$this->idLev2}=$idLev2
    ";

    $result = mysql_query($query);
    while($row = mysql_fetch_assoc($result)){
      $resource[] = $row;
    }
    $this->data = $resource;
  }
 
  function post(){
 
  }
 
  function put($id,$data){
    $id = mysql_real_escape_string($id);
 
    $fields = explode(',',$this->fields['put']);
 
    $update_fields = array();
 
    foreach($fields as $field){
      if(isset($data[$field])){
        $value = $data[$field];
        $update_fields[] = "$field='$value'";
      }
    }
 
    $fields_sql = implode(',',$update_fields);
    if($fields_sql){
      $query = "
        UPDATE {$this->entity}
        SET $fields_sql
        WHERE id='$id'
      ";
      $result = mysql_query($query);
    }
    $this->get($id);
  }
 
  function delete($id){
 
  }
 
  function collection(){
    $query = "
      SELECT {$this->fields['get']}
      FROM {$this->entity}
    ";

    $result = mysql_query($query);
    while($row = mysql_fetch_assoc($result)){
      $resource[] = $row;
    }
    $this->data = $resource;
  } 
}
 
?>
