<?php

class search{
	private $query;
	private $spotify_links;
	private $drink_recipes;
	private $best_fit_drink;
	private $best_fit_drink_name;
	private $lastfm_tags;
	private $recId;

	public function __construct($query, $type){
		$this->query = strToLower($query);
		/* here we will get spotify links:
		$Spotify = new Spotify($this->query, $type);
		$this->spotify_links = $Spotify->getHref();
		*/
		$LastFM = new LastFM($this->query);
		$this->lastfm_tags = $LastFM->generateArrayTagList(5);		
		$this->drink_recipes = $this->fetchRecipies();
		$this->analyseBestFit();

	}
	private function fetchRecipies(){
		$url = "http://localhost/carbin/resources/?tags";
		$result = file_get_contents($url);
		$data = json_decode($result);
		
		$recipe_tag_list = "";
		foreach($data as $key => $value){
			$recipe_tag_list[$value->recipe_id]['tags'][$value->tag] = $value->percent;
		}
		
		return $recipe_tag_list;
	}
	/* function which searches for the best match by calling analyseTags() for every recipe found*/
	private function analyseBestFit(){
		$this->best_fit_drink = 500;
		foreach ($this->drink_recipes as $id => $recipe){
	
			$result = $this->analyseTags($this->lastfm_tags, $recipe);
			/* $result varies from 0 to 100. 0 is best fit and 100 is worst fit. */
			if ($result < $this->best_fit_drink){
				$this->best_fit_drink = $result;
				$this->recId = $id;
			}
		}
	}
	private function analyseTags($artist, $recipe){
		$keys = array_intersect_key($artist, $recipe['tags']);
		$matches = 5 - count($keys);
		$total = '';
		foreach (array_keys($keys) as $key){
			$diff = $artist[$key] - $recipe['tags'][$key];
			if ($diff<0){
				$diff = $diff * -1;
			}
			$total += $diff;
		}
	return  ($total + $matches * 100)/5;
	}
	
	public function getRecId(){
	
	return $this->recId;
	
	}

}



?>