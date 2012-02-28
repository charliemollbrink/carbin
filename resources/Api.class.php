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

		    $numParts = count($parts);
		    if($numParts % 2){
		    	$resource = array_pop($parts);
		    	$id = array_pop($parts);
		    } else {
		    	$id = array_pop($parts);
		    	$resource = array_pop($parts);
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