<style type="text/css">
.tab-content ul li#view-all {
	font-weight: bold;
	list-style: outside none none;
	margin: 11px 0 0;
	text-align: center;
}
</style>
<?php include_once 'db-config.php'; 
MongoCursor::$timeout = -1;
$string = $type = "";
$string = isset($_POST["string"])?$_POST["string"]:"";
$type = isset($_POST["type"])?$_POST["type"]:"";


$k="";

switch ($type) {
    case "artists":
$collection = $db->artists;
$regexObj = new MongoRegex("/^".$string."/i"); 
$where = array("artist.name" => $regexObj); 
$result = $collection->find($where)->sort(array("artist.name"=>-1))->limit(10);
$img = "img/artist.png";
//->sort(array("artist.name"=>-1))
//$cou = $result->count();
//->sort(array('artist.id' => 1))
//echo $size = $collection->find($where)->count(2);
//if($size>0){

foreach ($result as $key =>$value) {
$k = $value["artist"]["name"];
echo '<li class="list-group-item">
<a href="artist.php?type=artist&id='.$value["_id"].'"><div class="row">
<div class="col-lg-3"><img src="'.$img.'" height="50" /></div>
<div class="col-lg-9">'.$value["artist"]["name"].'
<div class="dif-color">Artist</div>
</div></a>
</div>
</li>';
}
if($k!=""){echo '<li id="view-all"><a href="search.php?type=artists&q='.$string.'">View All Artists</a></li>';}else{echo "<li class='list-group-item'>No Results Found</li>";}
       
        break;
    case "releases":
$collection = $db->releases;
$regexObj = new MongoRegex("/^".$string."/i"); 
$where = array("release.title" => $regexObj); 
$result = $collection->find($where)->sort(array("release.title"=>-1))->limit(10);
$img = "img/release.png";
foreach ($result as $key =>$value) {
	$k = $value["release"]["title"];
echo '<li class="list-group-item">
<a href="release.php?type=release&id='.$value["_id"].'"><div class="row">
<div class="col-lg-3"><img src="'.$img.'" height="50" /></div>
<div class="col-lg-9">'.$value["release"]["title"].'
<div class="dif-color">Release</div>
</div></a>
</div>
</li>';


}
if($k!=""){echo '<li id="view-all"><a href="search.php?type=releases&q='.$string.'">View All Releases</a></li>';}else{echo "<li class='list-group-item'>No Results Found</li>";}
//if($result->count()==0) echo "No release found"; 
        break;
    case "labels":
$collection = $db->labels;
$regexObj = new MongoRegex("/^".$string."/i"); 
$where = array("label.name" => $regexObj); 
$result = $collection->find($where)->sort(array("label.name"=>-1))->limit(10);
$img = "img/label.png";
foreach ($result as $key =>$value) {
	$k = $value["label"]["name"];
echo '<li class="list-group-item">
<a href="label.php?type=label&id='.$value["_id"].'"><div class="row">
<div class="col-lg-3"><img src="'.$img.'" height="50" /></div>
<div class="col-lg-9">'.$value["label"]["name"].'
<div class="dif-color">label</div>
</div></a>
</div>
</li>';


}
if($k!=""){echo '<li id="view-all"><a href="search.php?type=labels&q='.$string.'">View All Labels</a></li>';}else{echo "<li class='list-group-item'>No Results Found</li>";}
//if($result->count()==0) echo "No release found"; 
        break;
}

?>
