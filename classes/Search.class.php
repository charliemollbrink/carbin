<?php

class search{
	private $query;
	private $spotify_links;
	private $drink_recipes;
	private $best_fit_drink;
	private $best_fit_drink_name;
	private $lastfm_tags;

	public function __construct($query, $type){
		$this->query = strToLower($query);
		/* here we will get spotify links:
		$Spotify = new Spotify($this->query, $type);
		$this->spotify_links = $Spotify->getHref();
		*/
		$LastFM = new LastFM($this->query);
		$this->lastfm_tags = $LastFM->generateArrayTagList(5);
		
		/* Im to lazy to "hårdkoda" in arrays and the database havent been built but the structure is
			basically the same as the tag list generated from lastfms api som im using that one and adding
			the extra drink info needed. so basicaly ignore all the code from here...*/
		$LastFM2 = new LastFM('cher');
		$LastFM3 = new LastFM('beatles');
		$LastFM4 = new LastFM('abba');
		$recipe1 = $LastFM2->generateArrayTagList(5);
		$recipe2 = $LastFM3->generateArrayTagList(5);
		$recipe3 = $LastFM4->generateArrayTagList(5);
		$recipes = array (array('name' =>'p2', $recipe1), array('name' =>'rum&coke', $recipe2), array('name' =>'cuba libra',$recipe3));
		
		/*...to here */
		
		$this->drink_recipes = $recipes; // this is where the result from the database should be
		$this->analyseBestFit();
		var_dump($this->best_fit_drink_name);
		
	}
	/* function which searches for the best match by calling analyseTags() for every recipe found*/
	private function analyseBestFit(){
		$this->best_fit_drink = 600;
		foreach ($this->drink_recipes as $recipe){
			$result = $this->analyseTags($this->lastfm_tags, $recipe);
			/* $result varies from 0 to 100. 0 is best fit and 100 is worst fit. */
			if ($result < $this->best_fit_drink){
				$this->best_fit_drink = $result;
				
				$this->best_fit_drink_name = $recipe['name'];
			}
		
		}
	}
	private function analyseTags($artist, $recipe){
		$keys = array_intersect_key($artist, $recipe[0]);
		$matches = 6 - count($keys);
		$total = '';
		foreach (array_keys($keys) as $key){
			$diff = $artist[$key] - $recipe[0][$key];
			if ($diff<0){
				$diff = $diff * -1;
			}
			$total += $diff;
		}
	return  ($total + $matches * 100)/6;
	}

}



?>