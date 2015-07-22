<footer>
  <section id="footer" class="section footer">
    <div class="container">
      <div class="row align-center copyright">
        <div class="col-sm-12">
          <p>Copyright &copy; 2015 Database Benchmarking</p>
        </div>
      </div>
    </div>
  </section>
  <!--<a href="#" class="scrollup"><i class="fa fa-chevron-up"> </i></a>--> 
</footer>



  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
    <script src="js/jquery-1.11.0.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.isotope.min.js"></script> 
<script src="js/fancybox/jquery.fancybox.pack.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/functions.js"></script> 
<script src="js/custom.js"></script> 
<script>
	
	
	function searchBoxArtists(){
		//var val = "artists";
		searchAction()		
		}
	function searchArtists(){
		//var val = "artists";
		$("#type").attr("value", "artists"); searchAction()		
		}
	function searchReleases(){
		$("#type").attr("value", "releases"); searchAction()		
		}
	function searchLabels(){
		$("#type").attr("value", "labels"); searchAction()		
		}
	
	
	
	function searchAction(){
			var type = $("#type").val();
		//alert(type);
		var value = $("#search-panel").val();
		if(value.length>=2){
			$("#search-tab").show();
			 $("#artists, #releases,#labels").html("<img src='img/ajax-loader.gif' alt='loading..' />");
			 
		$.ajax({
		  method: "POST",
		  url: "ajax-search.php",
		  data: { string: value,type:type }
		})
		  .done(function( msg ) {
			 
			//alert( "Data Saved: " + msg );
			//alert(type);
			 //$("#artists").html(msg);
			if(type =='artists'){				
				 $("#artists").html(msg);
				 }else if(type =='releases'){
					  $("#releases").html(msg);
					 }else if(type =='labels'){
						  $("#labels").html(msg);
						 } 
		  });
			
			}else $("#search-tab").hide();
		}
		
		
	function checkSearchText(value){
			$("#search-tab").hide();
		}	
		
		



(function($){
  $.fn.outside = function(ename, cb){
      return this.each(function(){
          var $this = $(this),
              self = this;

          $(document).bind(ename, function tempo(e){
              if(e.target !== self && !$.contains(self, e.target)){
                  cb.apply(self, [e]);
                  if(!self.parentNode) $(document.body).unbind(ename, tempo);
              }
          });
      });
  };
}(jQuery));

$(function() {
    $('#search-panel').outside('click', function(e) {
        $("#search-tab").hide();
    });
});


$("#search-tab").hover(function(){
	 $("#search-tab").show();
	});
	
$("#search-tab").click(function(){
	 $("#search-tab").show();
	});	

		
	</script>
    
    
<?php
$t  = isset($_GET['type']) ?$_GET['type'] : "";
?>
    <script type="text/javascript">
	<?php
	//echo $t;
	if($t=="artist" || $t==""){?>
	//alert("artist");		
	$("li#release, li#label, .sub-release, .sub-label").removeClass("active in");	
	$("li#artist, .sub-artist").addClass("active in");

		<?php }elseif($t=="release"){?>
		//alert("releases");	
	$("li#artist, li#label, .sub-artist, .sub-label").removeClass("active in");		
	$("li#release, .sub-release").addClass("active in");
	
			<?php }elseif($t=="label"){?>
			//alert("label");	
		$("li#artist, li#release, .sub-artist, .sub-release").removeClass("active in");		
		$("li#label, .sub-label").addClass("active in");
	
		
	<?php }?>
    </script>
    
    
<script type="text/javascript">
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>    
    
    