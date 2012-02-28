<?php
// array 0 => array
// 	'id' => string 'p2' (length=2)
// 	'tags' => 
// 		array
// 			'female vocalists' => string '72' (length=2)
// 			'80s' => string '53' (length=2)
// 			'dance' => string '47' (length=2)
// 			'rock' => string '34' (length=2)
// 			'cher' => string '16' (length=2)
// 1 => 
// array
// 	'id' => string 'rum&coke' (length=8)
// 		'tags' => 
// 			array
// 				'british' => string '80' (length=2)
// 				'The Beatles' => string '46' (length=2)
// 				'60's' => string '43' (length=2)
// 				'60s' => string '40' (length=2)
// 				'rock' => string '32' (length=2)
// 2 => 
// array
// 'id' => string 'cuba libra' (length=10)
// 'tags' => 
// array
// 'Disco' => string '73' (length=2)
// '70s' => string '59' (length=2)
// 'swedish' => string '53' (length=2)
// '80s' => string '42' (length=2)
// 'abba' => string '16' (length=2)


$test = array(
	'id' => 'p2',
	'tags' => array(
		'female vocalists' => '72',
		'80s' => '53',
		'dance' => '47',
		'rock' => '34',
		'cher' => '16'
		)
	);
echo '<pre>';
print_r($test);
echo '</pre>';
?>