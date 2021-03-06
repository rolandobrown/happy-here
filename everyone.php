<?php
$scriptName = $_SERVER['PHP_SELF'];
$pageTitle = "Happy Here";

# Make sure we display errors to the browser
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);


# Get our DB info
require "info.php";
require "info_session.php";


//$scriptName = curPageURL();
$submit_check='';

#########################################################
# Initialize a new session or obtain old one if possible
#########################################################
session_name($mySessionName); # $mySessionName is defined in info_session.php
session_start();


/*
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';





if(isset($_SESSION['user_id'])){
 echo ($_SESSION["user_id"]);
}
if(isset($_SESSION['twitter_name'])){
 echo ($_SESSION["twitter_name"]);
}
*/

?>


<!doctype html>

<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Happy Here</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Computertron" />
	<meta name="geo.country" content="US" />
	<meta name="dc.language" content="en" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" href="css/thirdparty/responsivemobilemenu.css" type="text/css"/>
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	
</head>

<body>
	<div class="rmm">
        <ul>
            <li><a href='map.html'>Explore</a></li>
            <li><a href='submit.html'>Submit</a></li>
            <li><a href='timeline.html'>Timeline</a></li>
            <li><a href='about.html'>About</a></li>
        </ul>
    </div>

	<div id="wrapper">
		<div class="content-container">
			<div class="content"> 
				<h4>Happy places around you</h4>
				<br>
				<!-- MAP + PLACE DETAILS -->
				    <!-- <article>
				      <p>We're finding your location: <span id="status">checking...</span></p>
				    </article> -->
				    <iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://www.google.com/fusiontables/embedviz?q=select+col3+from+1Ji5guWc9jmaMHELcr1kFhmn1189AeENBZZrBs8fI&amp;viz=MAP&amp;h=false&amp;lat=40.7374590020349&amp;lng=-73.95819977011718&amp;t=1&amp;z=11&amp;l=col3&amp;y=2&amp;tmplt=2&amp;hml=TWO_COL_LAT_LNG"></iframe>

				<!-- LIST OF STORIES -->
				<h4>Explore by description</h4>
				<br>
		
<?php

/*
$SqlStatement = "SELECT *
FROM user_post 
WHERE f.id = x.flash_id
AND x.badge_id = b.badge_id
AND b.proof_id = $media
LIMIT 0 , 1";
		
*/
$SqlStatement = "SELECT *
FROM user_post
ORDER BY id DESC";

		# Run the query on the database through the connection
		$result = mysql_query($SqlStatement,$connection);
		if (!$result)
		die("Error " . mysql_errno() . " : " . mysql_error());
		while ($row = mysql_fetch_array($result)) {
/*
$user_name = $_SESSION["twitter_name"];
$user_id= $_SESSION["user_id"];
$emotion=$_POST['emotion'];
$placeName=$_POST['place'];
$bodyText=$_POST['body_text'];
$links=$_POST['links'];
$lat=$_POST['lat'];
$lon=$_POST['lon'];


$row['badgeName'];
*/

$user_name = $row['user_name'];
$user_id= $row['id'];
$emotion=$row['emotion'];
$placeName=$row['place_name'];
$bodyText=$row['body_text'];
$links=$row['link'];
$lat=$row['lat'];
$lon=$row['lon'];
$emotion_text = "";

if ( $emotion == 1 ){
	$emotion_text = "Serene";
}
if ( $emotion == 2 ){
	$emotion_text = "Inspired";
}
if ( $emotion == 3 ){
	$emotion_text = "Joyful";
}
if ( $emotion == 4 ){
	$emotion_text = "Excited";
}

echo <<<END


<div class="place-box">
User: $user_name <br>
Emotion: $emotion_text <br>
$placeName<br>
<a href="$links"><h3>link to media</h3></a>
<p>$bodyText </p>
					
</div>
				

END;


	}



/*
				<div >	
				User: $user_name <br>
				Id: $user_id<br>
				Emotion: $emotion $emotion_text <br>
				Place: $placeName<br>
				Story: $bodyText<br>
				Link: $links<br>
				Lat: $lat<br>
				Long: $lon	<br>					
				</div>
<br><br>
	
	
*/
?>

			</div>
		</div>
	</div>


 	
<?php

#########################################################
# Disconnect from the database.
#########################################################
session_write_close();

mysql_close($connection);


?>


 <!-- ----------------------------- -->
	
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="js/map.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript" src="js/thirdparty/responsivemobilemenu.js"></script>
</body>
</html>
