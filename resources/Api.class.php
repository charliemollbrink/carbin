<?php
class Api {
	function __construct(){
		require_once('resources.conf.php');
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
	    if(in_array($resource, array_keys($_RESOURCES))){
	    	require_once($resource.'.resource.php');
		    $obj = new $resource($method, $id, $data);
		    // echo '<pre>';
		    // print_r($obj->data);
		    // echo '</pre>';
		    echo json_encode($obj->data);
	    } else {
	    	echo 'The resource is not allowed!';
	    }
	}
}
?>