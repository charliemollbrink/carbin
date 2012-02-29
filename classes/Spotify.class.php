<?php
class Spotify {
	private $searchStr;
	private $data;
	private $numResult;
	private $popularestResult;

	function __construct($searchStr, $type){
		$this->searchStr = urlencode($searchStr);
		$type = strtolower($type);
		$url = "http://ws.spotify.com/search/1/{$type}.json?q={$this->searchStr}";
		//CURL
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output = curl_exec($ch);
		// curl_close($ch);
		$output = file_get_contents($url);
		$this->data = json_decode($output);


		$this->numResult = $this->data->info->num_results;
		if($this->numResult > 0){
			$types = $this->data->info->type. 's';
			$this->popularestResult = $this->data->{$types}[0];
		}
	}

	//Return the href from the result
	public function getHref(){
		if($this->numResult > 0){
			return $this->popularestResult->href;
		}
	}

	//Return the name from the result
	public function getName(){
		if($this->numResult > 0){
			return $this->popularestResult->name;
		}
	}
}
?>