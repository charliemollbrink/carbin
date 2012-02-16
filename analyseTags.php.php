<?php
function analyseTags($artist, $recipe){
	$keys = array_intersect_key($artist, $recipe);
	$matches = 5 - count($keys);
	$total = '';
	foreach (array_keys($keys) as $key){
		$diff = $artist[$key] - $recipe[$key];
		if ($diff<0){
			$diff = $diff * -1;
		}
		$total += $diff;
	}
	return  ($total + $matches * 100)/5;
}

?>