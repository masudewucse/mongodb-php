<!DOCTYPE html>
<html lang="en">
<?php include 'top.php'?>
<body>
<style>
.col-lg-3{ border:1px solid #CCC}
</style>
<?php include 'header.php';
$ob = new GetAll();
?>

<!-- column content -->
<div class="container-fluid">
  <div class="row" style="min-height:500px">
    <?php

				$type = isset($_REQUEST["type"])?$_REQUEST["type"]:"";
				$name =  isset($_REQUEST["q"])?$_REQUEST["q"]:"";
				$flag = "";$message="";		
				$limit = 102;
				
				if($type == "artists"){
		  		$page  = isset($_GET['a_page']) ? (int) $_GET['a_page'] : 1;
				$ty = "a_page";				
				}else if($type == "releases"){
				$page  = isset($_GET['r_page']) ? (int) $_GET['r_page'] : 1;
				$ty = "r_page";	
					}else if($type == "labels"){
				$page  = isset($_GET['l_page']) ? (int) $_GET['l_page'] : 1;
				$ty = "l_page";	
					}
					
				$skip  = ($page - 1) * $limit;
				$next  = ($page + 1);
				$prev  = ($page - 1);



switch ($type) {
    case "artists":
    $collection = $db->artists;
	$regexObj = new MongoRegex("/^$name/i"); 
	$where = array("artist.name" => $regexObj); 
	$img = "img/artist.png";
	$page_name = "artist.php"; $t="artist";
	//$sort  = array('artist.id' => -1);
	$sort  = array('artist.name' => -1);
	
        break;
    case "releases":
	$collection = $db->releases;
	$regexObj = new MongoRegex("/^$name/i"); 
	$where = array("release.title" => $regexObj); 
	$img = "img/release.png";
	$page_name = "release.php";$t="release";
	//$sort  = array('release.id' => -1);
	$sort  = array('release.title' => -1);
        break;
    case "labels":
    $collection = $db->labels;
	$regexObj = new MongoRegex("/^$name/i"); 
	$where = array("label.name" => $regexObj); 
	$img = "img/label.png";
	$page_name = "label.php";$t="label";
	//$sort  = array('label.id' => -1);
	$sort  = array('label.name' => -1);
        break;
	default:
      $message= "Nothing found!";
	  $flag = 1;
}

if($flag!=1):
//$sort  = array('artist.id' => -1);
//$result = $collection->find(array("release.title" => $regexObj))->skip(1)->limit(30)->sort(array('artist.id' => -1));
//$result = $collection->find($where)->skip($skip)->limit($limit)->sort($sort);
$result = $collection->find($where)->sort($sort)->limit($limit);
//echo $total= $result->count();
?>
<?php
if($name){
?>
<div class="row">
<div class="col-lg-12 text-center"><h3>Search by <?php echo "&quot;".$name."&quot;"?> for <span class="text-capitalize"><?php echo $type?></span></h3></div>
</div>
<?php }?>
<div class="row" style="display:none">
      <div class="col-lg-4"></div>
      <div class="col-lg-4 text-center">
        <ul class="pagination pagination-lg" style="display:none">
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
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type='.$type.'&'.$ty.'=' . $next . '&q='.$name.'">Next&raquo;</a></li>';
    				}
				}
			?>
        </ul>
      </div>
      <div class="col-lg-4"></div>
    </div>
<?php
foreach ($result as $key =>$value) {
if($type=="artists"){
	$title = $value["artist"]["name"];   //artist
	}else if($type=="releases"){
		$title = $value["release"]["title"]; //release		
		}else if($type=="labels"){
			$title = $value["label"]["name"];  //label		
			 }	
?>
    <div class="col-xs-2 product-list">
      <div ng-repeat="s in Results"> <a href="<?php echo $page_name;?>?type=<?php echo $t?>&id=<?php echo $value["_id"];?>" class="thumbnail" ng-if="$index%3==0">
        <div> <img src="<?php echo $img?>" height="150" class="img-responsive" /> </div>
        <div class="title text-center"><?php echo $ob->truncate($title,50); ?></div>
        <div class="text-center dif-color"><?php echo $t;?></div>
        </a>
        <div class="clearfix visible-xs-block"></div>
      </div>
    </div>
    <?php }
  endif;
  ?>
    <center>
      <?php echo $message; ?>
    </center>
    
    
   
    
  </div>
  <div class="row" style="display:none">
      <div class="col-lg-4"></div>
      <div class="col-lg-4 text-center">
        <ul class="pagination pagination-lg">
          <?php 			
			if($total<$limit){$to1 = "1";$to2 = $total;}
			
			echo '<li><a id="no-color" href="javascript:void(0);">'.$to1."-".$to2." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?type='.$type.'&'.$ty.'=' . $prev . '&q='.$name.'">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type='.$type.'&'.$ty.'=' . $next . '&q='.$name.'">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type='.$type.'&'.$ty.'=' . $next . '&q='.$name.'">Next&raquo;</a></li>';
    				}
				}
			?>
        </ul>
      </div>
      <div class="col-lg-4"></div>
    </div>
</div>

<!-- end column content -->
<?php include 'footer.php';?>
</body>
</html>