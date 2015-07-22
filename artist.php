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
    case "artist":
    $collection = $db->artists;
	$str = array('_id' => new MongoId($id));
	//$str = array('artist.name' => $name);
	$img = "img/artist.png";
        break;
	default:
       $message= "Nothing found!";
	  $flag = 1;
}
//print_r($str);

if($flag!=1):
$result = $collection->findOne($str);
//print_r($result);
$url = $result["artist"]["urls"]["url"];
$sizeofurl=sizeof($url);

$member = $result["artist"]["members"]["name"];
$sizeofmembers=sizeof($member);
$name = $result["artist"]["name"];


?>



<div class="col-lg-2 align-center">
<img src="<?php echo $img?>" class="img-responsive" alt="" width="100">
</div>
<div class="col-lg-10">
<table class="table">
<tr>
<td colspan="2"><h3 class="text-uppercase"><?php echo $name;?></h3></td>
</tr>


<tr>
<td width="110">Data Quality:</td>
<td><?php echo nl2br($result["artist"]["data_quality"]);?></td>
</tr>

<?php if($result["artist"]["profile"]):?>
<tr>
<td width="85">Profile:</td>
<td><?php echo nl2br($result["artist"]["profile"]);?></td>
</tr>
<?php endif;?>


<?php if($sizeofurl>0):?>
<tr>
<td>Sites:</td>
<td>

<?php
if($sizeofurl>1){
for($i=0;$i<$sizeofurl;$i++){ 
	echo "<a href='".$url[$i]."'>".$obj->get_domain($url[$i])."</a>&nbsp;&nbsp;";
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
	echo "<a href='#'>".$member[$i]."</a>&nbsp;&nbsp;";
	}}else echo "<a href='details.php?type=artist&name=".$member."'>".$member."</a>";
?>
</tr>
<?php endif;?>



</table>






</div>

<?php
endif;
?>
<center><?php echo $message;?></center>

</div>


<?php
	$collection = $db->releases;
	//$fruitQuery = array('Type' => 'Fruit');
	$where = array("release.artists.artist.name" => $result["artist"]["name"],"release.formats.format.descriptions.description"=>"Album"); 
	$img = "img/release.png";
	$page_name = "artist.php"; $t="artist";
	$result = $collection->find($where)->limit(20);
	$total_album =  $collection->find($where)->count();
	?>

<?php if($total_album>0):?>
<div class="container-fluid" style="background-color:#e8e8e8">
        <div class="container container-pad" id="property-listings">
            
            <div class="row">
              <div class="col-md-12">
                <h1><?php echo $name."'s"?> Albums</h1>
              </div>
            </div>
            
            <div class="row">
                <div class="col-sm-10"> 
<?php 

foreach ($result as $key =>$value) {
	$notes = isset($value["release"]["notes"])?$value["release"]["notes"]:"";
	$quality = isset($value["release"]["data_quality"])?$value["release"]["data_quality"]:"";
?>
                    <!-- Begin Listing: 609 W GRAVERS LN-->
                    <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
                        <div class="media">
                            <a class="pull-left" href="#" target="_parent">
                            <img alt="image" class="img-responsive" src="<?php echo $img;?>"></a>

                            <div class="clearfix visible-sm"></div>

                            <div class="media-body fnt-smaller">
                                <a href="#" target="_parent"></a>

                                <h4 class="media-heading">
                                  <a href="release.php?type=release&id=<?php echo $value["_id"]?>" target="_parent"><?php echo $value["release"]["title"];?></a></h4>


                                <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
                                    <li>Released: <?php echo $value["release"]["released"];?></li>
                                    <?php if($notes){?><li>Notes: <?php echo $notes;?></li><?php }?>
                                    <?php if($quality){?><li>Data Quality: <?php echo $quality;?></li><?php }?>
                                </ul>

                            </div>
                        </div>
                    </div><!-- End Listing-->

<?php }?>

                </div>

                <!-- End Col -->
            </div><!-- End row -->
        </div><!-- End container -->
    </div>
<?php endif;?>





</div>	

<!-- end column content -->
<?php include 'footer.php';?>
</body>
</html>