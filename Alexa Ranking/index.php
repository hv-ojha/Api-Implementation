<?php
//Import alexa class to use alexa api
require_once("alexa.php");
if(isset($_REQUEST["search"])) {
	$website = $_REQUEST["text_search"];
	
	//Create object of alexa class to get rank
	$al=new alexa;

	//get rank function called and url passed as a parameter
	$a=$al->get_rank($website);
}
?>
<html>
<html>
<head>
	<title>ALexa Ranking implementation</title>
	
<link href="https://fonts.googleapis.com/css?family=Nunito|Yeon+Sung&display=swap" rel="stylesheet">

</head>
<body>
	<h1 style="font-family: Nunito;text-align: center">Alexa Ranking</h1>
	<form method="POST" action="">
	    <input type="text" name="text_search" placeholder="Enter full website e.g. api.com" style="width:50%; height:5%; padding-left: 10px;" />
	    <input type="submit" name="search" value="submit" style="width:10%; height:5%; padding-left: 10px;" />
  	</form>
  	<p>
<?php
	if(isset($a)){
		//Printed whole result array so you can use index according to your choice.
		echo "<pre style='padding:1%;font-family: Yeon Sung; font-size: 200%;'>";
		print_r($a);
		echo "</pre>";
	}
?>
	</p>
</body>
</html>