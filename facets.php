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

				//$type = isset($_REQUEST["type"])?$_REQUEST["type"]:"";
				$name =  isset($_REQUEST["name"])?$_REQUEST["name"]:"";
				//$flag = "";$message="";		
				$limit = 36;
				
		  		$page  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
				
					
				$skip  = ($page - 1) * $limit;
				$next  = ($page + 1);
				$prev  = ($page - 1);




//$sort  = array('artist.id' => -1);
//$result = $collection->find(array("release.title" => $regexObj))->skip(1)->limit(30)->sort(array('artist.id' => -1));
//$result = $collection->find($where)->skip($skip)->limit($limit)->sort($sort);
$sort  = array('release.id' => -1);
$img = "img/release.png";
$collection = $db->releases;
$where = array("release.genres.genre" => $name);
$result = $collection->find($where)->skip($skip)->limit($limit)->sort($sort);
//print_r($result);
$total= $result->count();

?>
<?php
if($name){
?>
<div class="row">
<div class="col-lg-12 text-center"><h3>Search by <?php echo "&quot;".$name."&quot;"?> for <span class="text-capitalize"><?php echo "Genres";?></span></h3></div>
</div>
<?php }?>
<div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4 text-center">
        <ul class="pagination pagination-lg">
          <?php 
			$to1 = 1+$prev*$limit;
			$to2 = $page*$limit;

			
			echo '<li><a id="no-color" href="javascript:void(0);">'.$to1."-".$to2." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?page=' . $prev . '&name='.$name.'">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?page=' . $next . '&name='.$name.'">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?page=' . $next . '&name='.$name.'">Next&raquo;</a></li>';
    				}
				}
			?>
        </ul>
      </div>
      <div class="col-lg-4"></div>
    </div>
<?php
foreach ($result as $key =>$value) {
		$title = $value["release"]["title"]; //release		
	
?>
    <div class="col-xs-2 product-list">
      <div ng-repeat="s in Results"> <a href="<?php echo $page_name;?>?type=<?php echo $t?>&id=<?php echo $value["_id"];?>" class="thumbnail" ng-if="$index%3==0">
        <div> <img src="<?php echo $img?>" height="150" class="img-responsive" /> </div>
        <div class="title text-center"><?php echo $ob->truncate($title,50); ?></div>
        <div class="text-center dif-color">Release</div>
        </a>
        <div class="clearfix visible-xs-block"></div>
      </div>
    </div>
    <?php }
  ?>
    <center>
      <?php //echo $message; ?>
    </center>
    
    
   
    
  </div>
  <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4 text-center">
        <ul class="pagination pagination-lg">
          <?php 			
			if($total<$limit){$to1 = "1";$to2 = $total;}
			
			echo '<li><a id="no-color" href="javascript:void(0);">'.$to1."-".$to2." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?page=' . $prev . '&name='.$name.'">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?page=' . $next . '&name='.$name.'">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?page='.$next . '&name='.$name.'">Next&raquo;</a></li>';
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