<?php include_once 'db-config.php';

$db = $connection->discogs;
$collection = $db->artists;



$page  = isset($_GET['a_page']) ? (int) $_GET['a_page'] : 1;
			
				$limit = 36;
				$skip  = ($page - 1) * $limit;
				$next  = ($page + 1);
				$prev  = ($page - 1);


$ty = "a_page";	$type = "artist";
$sort  = array('artist.id' => -1);
$string = $_REQUEST["string"];
$regexObj = new MongoRegex("/$string/i"); 
$where = array("artist.name" => $regexObj);

$result = $collection->find($where)->skip($skip)->limit($limit)->sort($sort);
echo $total= $collection->find($where)->count();
//print_r($results);
foreach ($result as $key =>$doc) {
    echo $doc["artist"]["name"]."<br>";
}

?>

<ul class="pagination pagination-lg">
          <?php 
			$to1 = 1+$prev*$limit;
			$to2 = $page*$limit;

			
			echo '<li><a id="no-color" href="javascript:void(0);">'.$to1."-".$to2." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?type='.$type.'&'.$ty.'=' . $prev . '&q='.$name.'">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type='.$type.'&'.$ty.'=' . $next . '&q='.$name.'">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type='.$type.'&'.$ty.'=' . $next . '&q='.$string.'">Next&raquo;</a></li>';
    				}
				}
			?>
        </ul>