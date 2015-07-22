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
    case "label":
    $collection = $db->labels;
	$str = array('_id' => new MongoId($id));
	$img = "img/label.png";
        break;
	default:
       $message= "Nothing found!";
	  $flag = 1;
}
//print_r($str);

if($flag!=1):
$result = $collection->findOne($str);
//print_r($result);

$sublebel = $result["label"]["sublabels"]["label"];
//print_r($sublebel);
//exit;
$sublebel_size=sizeof($sublebel);

//$member = $result["artist"]["members"]["name"];
//$sizeofmembers=sizeof($member);



?>



<div class="col-lg-2 align-center">
<img src="<?php echo $img?>" class="img-responsive" alt="" width="100">
</div>
<div class="col-lg-10">
<table class="table">
<tr>
<td colspan="2"><h3 class="text-uppercase"><?php echo $result["label"]["name"];?></h3></td>
</tr>
<?php if($result["label"]["profile"]):?>
<tr>
<td width="85">Profile:</td>
<td><?php echo nl2br($result["label"]["profile"]);?></td>
</tr>
<?php endif; if($result["label"]["contactinfo"]):?>
<tr>
<td width="85">Contact info:</td>
<td><?php echo nl2br($result["label"]["contactinfo"]);?></td>
</tr>
<?php endif;
if($result["label"]["data_quality"]):
?>
<tr>
<td width="85">Quality:</td>
<td><?php echo nl2br($result["label"]["data_quality"]);?></td>
</tr>
<?php endif;?>
<?php /*?><tr>
<td width="85">Notes:</td>
<td><?php echo nl2br($result["label"]["notes"]);?></td>
</tr><?php */?>


<?php if($sublebel_size>0):?>
<tr>
<td>sublebel:</td>
<td>

<?php
if($sublebel_size>1){
for($i=0;$i<$sublebel_size;$i++){ 
	echo "<a href='#'>".$sublebel[$i]."</a>&nbsp;&nbsp;";
	}} else echo "<a href='#'>".$sublebel."</a>";
?>
</tr>
<?php endif;?>
<?php /*?>
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