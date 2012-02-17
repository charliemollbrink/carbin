<?php
	class Api {
		function __construct(){
			/* URI and Method handler */
		    $keys = array_keys($_GET);
		    $URI  = $keys[0];
		     
		    $URI_parts = explode('/',$URI);
		     
		    foreach($URI_parts as $part){
		      if($part !== ''){
		        $parts[] = $part;
		      }
		    }
		     
		    $resource   = $parts[0];
		    $id = '';
		    if(isset($parts[1])){
		      $id   = $parts[1];
		    }
		    $method   = $_SERVER['REQUEST_METHOD'];
		     
		    switch ($method){
		            case 'GET':
		                $data = $_GET;
		                break;
		            case 'POST':
		                $data = $_POST;
		                break;
		            case 'PUT':
		                parse_str(file_get_contents('php://input'), $put_vars);
		                $data = $put_vars;
		                break;
		            default: $data = array();
		        }  
		     
		    require_once($resource.'.resource.php');
		    $obj = new $resource($method, $id, $data);
		    echo json_encode($obj->data);
		}
	}
?>