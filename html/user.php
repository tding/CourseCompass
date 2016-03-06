<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		<!-- BASICS -->
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Amoeba free one page responsive bootstrap site template</title>
        <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/isotope.css" media="screen" />	
		<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
        <link rel="stylesheet" href="css/style.css">
		<!-- skin -->
		<link rel="stylesheet" href="skin/default.css">
    </head>
    <body>
		<section id="header" class="appear"></section>
		<div class="navbar navbar-fixed-top" role="navigation" data-0="line-height:100px; height:100px; background-color:rgba(0,0,0,0.3);" data-300="line-height:60px; height:60px; background-color:rgba(0,0,0,1);">
			 <div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="fa fa-bars color-white"></span>
					</button>
					<h1><a class="navbar-brand" href="index.html" data-0="line-height:90px;" data-300="line-height:50px;">Course Compas
					</a></h1>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav" data-0="margin-top:20px;" data-300="margin-top:5px;">
						<li class="active">
						   
							<a href="index.html"> login
							</a>
							
							</li>
					</ul>
				</div><!--/.navbar-collapse -->
			</div>
		</div>

		<section class="featured">
			<div class="container"> 
				<div class="row mar-bot40">
					<div class="col-md-6 col-md-offset-3">
						
						<div class="align-center" >
							<i class="fa fa-compass fa-5x mar-bot20"></i>
							<h2 class="slogan">Welcome to<h2>
							<h2 class="slogan">Course ComPass</h2>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
		<!-- section works -->
		<section id="section-works" class="section appear clearfix">
			<div class="container">
				
				<div class="row mar-bot40">
					<div class="col-md-offset-3 col-md-6">
						<div class="section-header">
							<h2 class="section-heading animated" data-animation="bounceInUp">Our Recommendation</h2>
							<p>According to your interests, we highly recommend these courses for YOU!!</p>
						</div>
					</div>
				</div>
					
                        <div class="row">
                          <nav id="filter" class="col-md-12 text-center">
                            <ul>
                              <li><a href="#" class="current btn-theme btn-small" data-filter="*">All</a></li>
                              <li><a href="#"  class="btn-theme btn-small" data-filter=".current" >Current Semester</a></li>
                              <li><a href="#"  class="btn-theme btn-small" data-filter=".future">Future Semester</a></li>
                            </ul>
                          </nav>
                          <div class="col-md-12">
                            <div class="row">
                              <div class="portfolio-items isotopeWrapper clearfix" id="3">
<?php
        session_start();
	
	require("../src/connection/db.php");
        $obj = new db(); 
	require("../src/CollaborativeFiltering.php");
	$recommender_courses = array();
	$cf = new CollaborativeFiltering($obj);
        require("../src/recommender.php");
	
	if(isset($_SESSION)){
		$recommender_courses = $cf->generateSimilarities($_SESSION['username']);
 	}
	else{
		
		
	}
?>

<?php
	  
	foreach($recommender_courses["next"] as $course){
	$next = getClassInformation($course,$obj);
	
     	echo "<article class='col-md-4 isotopeItem current'>";
	 echo "<div class='portfolio-item'>";
	 echo "<div class='portfolio-item txt'>";
	 echo "<h5>".$course."</h5>";
	 echo "<p>".$next['name']."</p>";
	 echo "</div>";
	 echo "<div class='portfolio-desc align-center'>";
	 echo "<div class='folio-info'>";
	 echo "<h5><a href='#'>".$course."</a></h5>";
	 echo "<a href='#popup".$course."'  class='fancybox'><i class='fa fa-plus fa-2x'></i></a>";
	 echo "</div>";
     	echo "<div id=popup".$course." class='portfolio-item overlay'>";
     	echo "<div class='portfolio-item popup'>";
	echo "<h2>".$course."</h2>";
	echo "<h3>fundametoal of Information system</h3>";
	echo "<a class='close' href='#'></a>";
	echo "<div class='content'>".$next['description']."</div>";
	echo "<a href='../src/line2.php'> link</a>";
	echo "</div>";
	echo "</div>";
    echo "</article>";
	}

	
	
	foreach($recommender_courses["current"] as $course){
	 $current = getClassInformation($course,$obj);
	 
         echo "<article class='col-md-4 isotopeItem current'>";
	 echo "<div class='portfolio-item'>";
	 echo "<div class='portfolio-item txt'>";
	 echo "<h5>".$course."</h5>";
	 echo "<p>".$current['name']."</p>";
	 echo "</div>";
	 echo "<div class='portfolio-desc align-center'>";
	 echo "<div class='folio-info'>";
	 echo "<h5><a href='#'>".$course."</a></h5>";
	 echo "<a href='#popup".$course."'  class='fancybox'><i class='fa fa-plus fa-2x'></i></a>";
	 echo "</div>";
         echo "<div id=popup".$course." class='portfolio-item overlay'>";
        echo "<div class='portfolio-item popup'>";
	echo "<h2>".$course."</h2>";
	echo "<h3>".$current['name']."</h3>";
	echo "<a class='close' href='#'></a>";
	echo "<div class='content'>".$current['description']."</div>";
	echo "<a href='../src/line2.php'> link</a>";
	echo "</div>";
	echo "</div>";
    echo "</article>";
	}
?>
                                </div>
                                        
							</div>
                                     

							</div>
                        </div>
				
			</div>
		</section>
		<section id="parallax2" class="section parallax" data-stellar-background-ratio="0.5">	
            <div class="align-center pad-top40 pad-bot40">
                <blockquote class="bigquote color-white">Anyone who has never made a mistake has never tried anything new</blockquote>
				<p class="color-white">Albert Einstein</p>
            </div>
		</section>

		<!-- map -->
		<section id="section-map" class="clearfix">
			<div id="map"></div>
		</section>
		
	<section id="footer" class="section footer">
		<div class="container">
			<div class="row animated opacity mar-bot20" data-andown="fadeIn" data-animation="animation">
				<div class="col-sm-12 align-center">
                    <ul class="social-network social-circle">
                        <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                    </ul>				
				</div>
			</div>

			<div class="row align-center copyright">
					<div class="col-sm-12"><p>Copyright &copy; 2014 Amoeba - by <a href="http://bootstraptaste.com">Bootstrap Themes</a></p></div>
                    <!-- 
                        All links in the footer should remain intact. 
                        Licenseing information is available at: http://bootstraptaste.com/license/
                        You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Amoeba
                    -->
			</div>
		</div>

	</section>
	<a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	

	<script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
        <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.isotope.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/fancybox/jquery.fancybox.pack.js"></script>
	<script src="js/skrollr.min.js"></script>		
	<script src="js/jquery.scrollTo-1.4.3.1-min.js"></script>
	<script src="js/jquery.localscroll-1.2.7-min.js"></script>
	<script src="js/stellar.js"></script>
	<script src="js/jquery.appear.js"></script>
	<script src="js/validate.js"></script>
        <script src="js/main.js"></script>
	</body>
</html>
