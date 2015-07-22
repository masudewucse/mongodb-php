<!DOCTYPE html>
<html lang="en">
<?php include 'top.php'?>
<body>
<?php 
include 'header.php';
$collection = $db->artists;
$artists = $collection->find()->count();
$collection = $db->releases;
$releases = $collection->find()->count();
$collection = $db->labels;
$labels = $collection->find()->count();
$typ  = isset($_GET['type']) ? (int) $_GET['type'] : "";
$limit = 36;
?>

<!-- column content -->
<div class="container-fluid">
  <div class="row">
    <div class="panel with-nav-tabs panel-primary">
      <div class="panel-heading">
        <ul class="nav nav-tabs" id="main-tab-bar">
          <li id="artist" class="active"><a href="#tab1primary" data-toggle="tab">Artists (<?php echo $artists;?>)</a></li>
          <li id="release"><a href="#tab2primary" data-toggle="tab">Releases (<?php echo $releases;?>)</a></li>
          <li id="label"><a href="#tab3primary" data-toggle="tab">Labels (<?php echo $labels;?>)</a></li>
        </ul>
      </div>
      <div class="panel-body">
        <div class="tab-content">
          <div class="tab-pane fade in active sub-artist" id="tab1primary">
            <?php
		  		$page  = isset($_GET['a_page']) ? (int) $_GET['a_page'] : 1;
				$skip  = ($page - 1) * $limit;
				$next  = ($page + 1);
				$prev  = ($page - 1);
				$sort  = array('artist.id' => -1);	
				$collection = $db->artists;
				$result = $collection->find()->skip($skip)->limit($limit)->sort($sort);
		  ?>
            <div class="row">
              <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                  <ul class="pagination pagination-lg">
                    <?php 
			$total= $result->count();
			
				echo '<li><a id="no-color" href="javascript:void(0);">'.(1+$prev*$limit)."-".$page*$limit." of ".$total.'</a></li>';			
					if($page > 1){				
							echo '<li><a href="?type=artist&a_page=' . $prev . '">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type=artist&a_page=' . $next . '">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type=artist&a_page=' . $next . '">Next&raquo;</a></li>';
    				}
				}
			?>
                  </ul>
                </div>
                <div class="col-lg-4"></div>
              </div>
              <div class="col-lg-12">
                <?php
				foreach ($result as $key =>$value) {
			?>
                <div class="col-xs-2">
                  <div ng-repeat="s in Results"> <a href="artist.php?type=artist&id=<?php echo $value["_id"];?>" class="thumbnail" ng-if="$index%3==0">
                    <div> <img src="img/artist.png" height="150" class="img-responsive" /> </div>
                    <div class="text-center"><?php echo $value["artist"]["name"];?></div>
                    <div class="text-center dif-color">Artist</div>
                    </a>
                    <div class="clearfix visible-xs-block"></div>
                  </div>
                </div>
                <?php }?>
              </div>
              <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                  <ul class="pagination pagination-lg">
                    <?php 
			$total= $result->count();
			
				echo '<li><a id="no-color" href="javascript:void(0);">'.(1+$prev*$limit)."-".$page*$limit." of ".$total.'</a></li>';			
				if($page > 1){				
							echo '<li><a href="?type=artist&a_page=' . $prev . '">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type=artist&a_page=' . $next . '">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type=artist&a_page=' . $next . '">Next&raquo;</a></li>';
    				}
				}
			?>
                  </ul>
                </div>
                <div class="col-lg-4"></div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade  sub-release" id="tab2primary">
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-4 text-center">
                <ul class="pagination pagination-lg">
                  <?php 
		   		$page  = isset($_GET['r_page']) ? (int) $_GET['r_page'] : 1;
				$skip  = ($page - 1) * $limit;
				$next  = ($page + 1);
				$prev  = ($page - 1);			
				$sort  = array('release.id' => -1);	
				$collection = $db->releases;
				$result = $collection->find()->skip($skip)->limit($limit)->sort($sort);
				$total= $result->count();
				//$result = $collection->find()->limit(54);
			echo '<li><a id="no-color" href="javascript:void(0);">'.(1+$prev*$limit)."-".$page*$limit." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?type=release&r_page=' . $prev . '">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type=release&r_page=' . $next . '">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type=release&r_page=' . $next . '">Next&raquo;</a></li>';
    				}
				}
			?>
                </ul>
              </div>
              <div class="col-lg-4"></div>
            </div>
            <?php          
				foreach ($result as $key =>$value) {
			?>
            <div class="col-xs-2">
              <div ng-repeat="s in Results"> <a href="release.php?type=release&id=<?php echo $value["_id"]?>" class="thumbnail" ng-if="$index%3==0">
                <div> <img src="img/release.png" height="150" class="img-responsive" /> </div>
                <div class="text-center"><?php echo $value["release"]["title"];?></div>
                <div class="text-center dif-color">Release</div>
                </a>
                <div class="clearfix visible-xs-block"></div>
              </div>
            </div>
            <?php }?>
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-4 text-center">
                <ul class="pagination pagination-lg">
                  <?php 
			$total= $result->count();
			
			echo '<li><a id="no-color" href="javascript:void(0);">'.(1+$prev*$limit)."-".$page*$limit." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?type=release&r_page=' . $prev . '">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type=release&r_page=' . $next . '">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type=release&r_page=' . $next . '">Next&raquo;</a></li>';
    				}
				}
			?>
                </ul>
              </div>
              <div class="col-lg-4"></div>
            </div>
          </div>
          <div class="tab-pane fade  sub-label" id="tab3primary">
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-4 text-center">
                <ul class="pagination pagination-lg">
                  <?php 		
		   		$page  = isset($_GET['l_page']) ? (int) $_GET['l_page'] : 1;
				$skip  = ($page - 1) * $limit;
				$next  = ($page + 1);
				$prev  = ($page - 1);	
				$sort  = array('label.id' => -1);	
				$collection = $db->labels;
				$result = $collection->find()->skip($skip)->limit($limit)->sort($sort);
				$total= $result->count();
				//$result = $collection->find()->limit(54);
			echo '<li><a id="no-color" href="javascript:void(0);">'.(1+$prev*$limit)."-".$page*$limit." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?type=label&l_page=' . $prev . '">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type=label&l_page=' . $next . '">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type=label&l_page=' . $next . '">Next&raquo;</a></li>';
    				}
				}
			?>
                </ul>
              </div>
              <div class="col-lg-4"></div>
            </div>
            <?php          
				foreach ($result as $key =>$value) {
			?>
            <div class="col-xs-2">
              <div ng-repeat="s in Results"> <a href="label.php?type=label&id=<?php echo $value["_id"]?>" class="thumbnail" ng-if="$index%3==0">
                <div> <img src="img/label.png" height="150" class="img-responsive" /> </div>
                <div class="text-center"><?php echo $value["label"]["name"];?></div>
                <div class="text-center dif-color">Label</div>
                </a>
                <div class="clearfix visible-xs-block"></div>
              </div>
            </div>
            <?php }?>
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-4 text-center">
                <ul class="pagination pagination-lg">
                  <?php 
			$total= $result->count();
			
			echo '<li><a id="no-color" href="javascript:void(0);">'.(1+$prev*$limit)."-".$page*$limit." of ".$total.'</a></li>';			
			if($page > 1){				
							echo '<li><a href="?type=label&l_page=' . $prev . '">&laquo;Prev</a></li>';
							if($page * $limit < $total) {
								echo '<li><a href="?type=label&l_page=' . $next . '">Next&raquo;</a></li>';
							}
			         } else {
  							  if($page * $limit < $total) {
       						  echo '<li><a href="javascript:void(0);" id="no-color">&laquo;Prev&nbsp; <a href="?type=label&l_page=' . $next . '">Next&raquo;</a></li>';
    				}
				}
			?>
                </ul>
              </div>
              <div class="col-lg-4"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end column content -->
<?php include 'footer.php';?>
</body>
</html>