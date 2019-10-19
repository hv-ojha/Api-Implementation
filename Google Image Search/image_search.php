<!--
- Please change Link for pagination..
-->
<?php
require_once("google_api.php");
?>
<html>
<head>
</head>
<body>
  <form method="POST" action="">
    <input type="text" name="text_search" placeholder="Enter keyword to search" style="width:50%; height:5%; padding-left: 10px;" />
    <input type="submit" name="search" value="SEARCH" style="width:10%; height:5%; padding-left: 10px;" />
  </form>
</body>
</html>
<?php
if(isset($_REQUEST["search"])) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  //KEYWORD TO SEARCH
  $keyword = $_REQUEST["text_search"];

  echo "Showing results for ".$keyword."<br><br>";
  
  //CONVERTED SPACES TO + SIGN for URL
  $keyword = str_replace(" ", "+", $keyword);

  //Custom Search API
  $url = $search_url.'&searchType=image&q='. $keyword .'&key='. $apikey;

  //Executed CURL and stored result in $result
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);

  //Converted JSON response to Array
  $arr = json_decode($result, true);

  //Loop to display Images
  foreach ($arr["items"] as $val) {
    //Images
    echo "<img src=".$val["link"]." width='33%' height='33%'>\n";
  }

  //Pagination
  echo "<br> <br> <div align='center'>";
  for($i = 1; $i <= 5; $i++)
  {
?>
    <a href="http://localhost/image_search.php?start=<?php echo $i; ?>&q=<?php echo $keyword; ?>" style="border:1px solid black; padding:5px; text-decoration: none; font-size: 20px; margin-right: 10px; background: black; color: white"><?php echo $i ?></a>
<?php
  }
  echo "</div>";
}

//SIMPLE PAGINATION MAINTAINENCE
if(isset($_GET["start"])) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  //GOOGLE API KEY
  $apikey = "AIzaSyCQvqCTHb40cL5tcjRhS8C6I01V97ogPqQ";

  //KEYWORD TO SEARCH
  $keyword = $_GET["q"];
  
  //number variable to maintain the start record number in pagination
  $start = $_GET["start"];
  $number = (10 * $start) + 1;
  
  //CONVERTED SPACES TO + SIGN for URL
  $keyword = str_replace(" ", "+", $keyword);

  //CUSTOM SEARCH API
  $url = $search_url.'&searchType=image&start='.$number.'&q='. $keyword .'&key='. $apikey;

  //CURL EXECUETION AND STORING RESULT IN $result
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);

  //Converting JSON response into array
  $arr = json_decode($result, true);

  //LOOP TO DISPLAY
  foreach ($arr["items"] as $val) {
   echo "<img src=".$val["link"]." width='33%' height='33%'>\n";
  }
  echo "<br> <br> <div align='center'>";
  for($i = $start; $i <= $start + 5; $i++)
  {
?>
    <a href="http://localhost/image_search.php?start=<?php echo $i; ?>&q=<?php echo $keyword; ?>" style="border:1px solid black; padding:5px; text-decoration: none; font-size: 20px; margin-right: 10px; background: black; color: white"><?php echo $i ?></a>
<?php
  }
  echo "</div>";
}
?>