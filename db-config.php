<?php
ini_set("display_errors", 0);
//MongoDB
MongoCursor::$timeout = -1;
$connection = new MongoClient();
//$db = $connection->discog_test;
$db = $connection->discogs;


class Artist{
	
	function get_domain($url)
		{
		  $pieces = parse_url($url);
		  $domain = isset($pieces['host']) ? $pieces['host'] : '';
		  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
			return $regs['domain'];
		  }
		  return false;
		}
	function memberNameToLink($name){
		
		$str = array('artist.name' => $name);
		return "masud";
		
		
		}

	



	
	}
	
	
	
class GetAll{
	
private $db;

  
	function get_artists(){
		    $collection = $this->$db->artists;
			return $collection->find().count();
		
		
		}


	function get_releases(){
		    $collection = $this->$db->releases;
return $collection->find().count();
		
		
		}



	function get_labels(){
		    $collection = $this->$db->labels;
return $collection->find().count();
		
		
		}
		
		
function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
		
	
	}	

?>
