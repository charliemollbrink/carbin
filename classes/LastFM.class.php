<?php
class LastFM{
	private $artist;
	private $result;
	private $tag_list;
	
	public function __construct($artist){
		$this->artist = strtolower($artist);
		$this->result = $this->fetchLastFmTags();
		$this->tag_list = $this->generateTagList();
	}

	/* function to fetch tags from last fm api */
	private function fetchLastFmTags(){
		$artist = urlencode($this->artist);
		$url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettoptags&artist={$artist}&api_key=b25b959554ed76058ac220b7b2e0a026";
		$result = file_get_contents($url);
		return $result;
	}
	
	/* function to generate a comma separated list */
	private function generateTagList(){
		$tag_list = '';
		$tags = new SimpleXMLElement($this->result);
		foreach ($tags->toptags[0]->tag as $tag){

		$tag_list .= (string)$tag->name.", ";
		}
		echo $tag_list;
	//return $tags;
	}
	
	
	/* getter for taglist */
	public function getTagList(){
	return $this->tag_list;
	}
}
?>