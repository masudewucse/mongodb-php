<!DOCTYPE html>
<html lang="en">
<?php 
include 'top.php'?>
<body>
<?php include 'header.php'?>

<!-- column content -->
<div class="container">
<div class="row" style="min-height:500px">
<?php

$obj = new Artist();


$type = isset($_REQUEST["type"])?$_REQUEST["type"]:"";
$id   = isset($_REQUEST["id"])?$_REQUEST["id"]:"";
$flag = "";$message="";

switch ($type) {
    case "release":
    $collection = $db->releases;
	$str = array('_id' => new MongoId($id));
	$img = "img/release.png";
        break;
	default:
       $message= "Nothing found!";
	  $flag = 1;
}
//print_r($str);

if($flag!=1):

//print_r($str);
$result = $collection->findOne(array('_id' => new MongoId($id)));
//print_r($result);
//exit;

$videos = $result["release"]["videos"]["video"];
//print_r($videos);
//exit;
$vid_size=sizeof($videos);

$member = $result["artist"]["members"]["name"];
$sizeofmembers=sizeof($member);



?>



<div class="col-lg-2 align-center">
<img src="<?php echo $img?>" class="img-responsive" alt="" width="100">
</div>
<div class="col-lg-10">
<table class="table">
<tr>
<td colspan="2"><h3 class="text-uppercase"><?php echo $result["release"]["title"];?></h3></td>
</tr>
<?php if($result["release"]["country"]):?>
<tr>
<td width="85">Country:</td>
<td><?php echo nl2br($result["release"]["country"]);?></td>
</tr>
<?php endif;
if($result["release"]["released"]):
?>
<tr>
<td width="85">Released:</td>
<td><?php echo nl2br($result["release"]["released"]);?></td>
</tr>
<?php endif;
if($result["release"]["data_quality"]):
?>
<tr>
<td width="85">Quality:</td>
<td><?php echo nl2br($result["release"]["data_quality"]);?></td>
</tr>
<?php endif;
if($result["release"]["notes"]):
?>
<tr>
<td width="85">Notes:</td>
<td><?php echo nl2br($result["release"]["notes"]);?></td>
</tr>
<?php endif;?>
<?php /*?>
<?php if($vid_size>0):?>
<tr>
<td>Videos:</td>
<td>

<?php
if($vid_size>1){
for($i=0;$i<$videos;$i++){ 
	echo "<a href='".$videos[$i][""]."'>".$videos[$i]."</a>&nbsp;&nbsp;";
	}} else echo "<a href='".$url."'>".$obj->get_domain($url)."</a>";
?>
</tr>
<?php endif;?>

<?php if($sizeofmembers>0):?>
<tr>
<td>Members:</td>
<td>

<?php
if($sizeofmembers>1){
for($i=0;$i<$sizeofmembers;$i++){ 
	echo "<a href='details.php?type=artist&name=".$member[$i]."'>".$member[$i]."</a>&nbsp;&nbsp;";
	}}else echo "<a href='details.php?type=artist&name=".$member."'>".$member."</a>";
?>
</tr>
<?php endif;?>
<?php */?>


</table>






</div>

<?php
endif;
?>
<center><?php echo $message;?></center>
</div>

</div>	
</div>

<!-- end column content -->
<?php include 'footer.php';?>
</body>
</html>