<?php
 
abstract class Resource{
 
  protected $entity;
  protected $fields;
  public $data;
 
  function __construct($method, $id, $data){
 
    switch($method){
      case 'GET':
          if($id){
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
      WHERE {$this->id}='$id'
    ";
    $resource = false;
    $result = mysql_query($query);
    if($result){
      while($row = mysql_fetch_assoc($result)){
        $resource[] = $row;
      }
    } else {
      $resource = false;
    }
    $this->data = $resource;
  }
 
  function post($data){
    $fields = explode(',',$this->fields['post']);
    $post_fields = array();
    $field_keys = array();

    foreach($fields as $field){
      if(isset($data[$field])){
        $value = $data[$field];
        $post_fields[] = "'$value'";
        $field_keys[] = $field;
      }
    }
    $fields_sql = implode(',',$post_fields);
    $keys_sql = implode(',',$field_keys);

    if($fields_sql && $keys_sql){
      $query = "INSERT INTO {$this->entity} ($keys_sql)
      VALUES ($fields_sql)";  
 
      $result = mysql_query($query);
      $id = mysql_insert_id();
      $this->get($id);
    }
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
        WHERE {$this->id}='$id'
      ";
      $result = mysql_query($query);
    }
    $this->get($id);
  }
 
  function delete($id){
    $id = mysql_real_escape_string($id); 
    $query = "DELETE FROM {$this->entity}
              WHERE {$this->id}='{$id}'";
    mysql_query($query) or die();
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
