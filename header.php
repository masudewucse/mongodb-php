<?php 
$val = isset($_REQUEST["q"])?$_REQUEST["q"]:"";
?>

<header>
  <div class="main-menu">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h1><a class="navbar-brand" href="index.php" data-0="line-height:90px;" data-300="line-height:50px;"> <img width="40" src="img/discogs-white.png" alt="logo"> </a></h1>
        </div>
        <div class="col-md-4">
          <div class="row">
            <div id="custom-search-input">
              <div class="input-group col-md-12">
                <form target="_self" action="search.php">
                  <input type="text" class="search-query form-control" name="q" value="<?php echo $val;?>" id="search-panel" onfocus="searchBoxArtists()" onkeyup="searchBoxArtists()" placeholder="Search artists, albums and more..." />
                  <span class="input-group-btn">
                  <input type="hidden" name="type" id="type" value="artists" />
                  <button class="btn btn-danger" type="submit"> <span class=" glyphicon glyphicon-search"></span> </button>
                  </span>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12" id="search-tab">
            <div class="panel with-nav-tabs panel-default">
              <div class="panel-heading">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab1default" data-toggle="tab" onclick="searchArtists()">Artists</a></li>
                  <li><a href="#tab2default" data-toggle="tab" onclick="searchReleases()">Releases</a></li>
                  <li><a href="#tab3default" data-toggle="tab"  onclick="searchLabels()">Labels</a></li>
                </ul>
              </div>
              <div class="panel-body">
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1default">
                    <ul class="list-group" id="artists">
                    </ul>
                  </div>
                  <div class="tab-pane fade" id="tab2default">
                    <ul class="list-group" id="releases">
                    </ul>
                  </div>
                  <div class="tab-pane fade" id="tab3default">
                    <ul class="list-group" id="labels">
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="dropdown collapse navbar-collapse" id="bs-slide-dropdown">
            <ul class="nav nav-pills navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Marketplace(Genre) <span class="caret"></span></a>				
			  <ul class="dropdown-menu" role="menu">
                 <li><a href="facets.php?name=Electronic">Electronic &nbsp;(2,080,705)</a></li>
                 <li><a href="facets.php?name=Rock">Rock &nbsp;(2,005,530)</a></li>
                 <li><a href="facets.php?name=Pop">Pop &nbsp;(9,285,10)</a></li>
                 <li><a href="facets.php?name=Funk / Soul">Funk / Soul &nbsp;(4,384,12)</a></li>
                 <li><a href="facets.php?name=Hip Hop">Hip Hop &nbsp;(3,338,63)</a></li>
              </ul>                
            </li>
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
