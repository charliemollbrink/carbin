<?php
class LastFM{
	private $artist;
	private $result;
	private $tag_list;
	
	public function __construct($artist){
		$this->artist = strtolower($artist);
		$this->result = $this->fetchLastFmTags();
		//$this->tag_list = $this->generateTagList();
	}

	/* function to fetch tags from last fm api */
	private function fetchLastFmTags(){
		$artist = urlencode($this->artist);
		$url = "http://ws.audioscrobbler.com/2.0/?method=artist.gettoptags&artist={$artist}&api_key=b25b959554ed76058ac220b7b2e0a026";
		$result = file_get_contents($url);
		return $result;
	}
	
	/* function to generate a comma separated list */
	public function generateCommaTagList($limit){
		$tag_list = '';
		$tags = new SimpleXMLElement($this->result);
		for ($i= 0; $i <= $limit; ++$i){
			$tag = (string)$tags->toptags[0]->tag[$i]->name;
			$tag_list .= $tag.", ";
		}
	return $tag_list;
	}
	/* function to generate an array with tags an percentage */
	public function generateArrayTagList($limit){
		$tags = new SimpleXMLElement($this->result);
		for ($i= 0; $i <= $limit; ++$i){
			$name = (string)$tags->toptags[0]->tag[$i]->name;
			$count = (string)$tags->toptags[0]->tag[$i]->count;
			$tag_list[$name] = $count;
			//$tag_list[] = array('name' => $name, 'count' => $count);
		}
	return $tag_list;
	}
	
	
	/* getter for taglist */
	public function getTagList(){
	return $this->tag_list;
	}
}
?>