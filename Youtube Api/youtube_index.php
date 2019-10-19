<html>
<form method="POST">
	<input type="text" name="text_search" />
	<input type="submit" name="search" value="SEARCH" />
</form>
</html>
<?php
if(isset($_REQUEST["search"])) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//FACEBOOK API URL
	// $url = "https://graph.facebook.com/harshvardhan.ojha.1?access_token=990e59ae15a89194388093fb2b2b0086";


	//GOOGLE API KEY
	$apikey = "AIzaSyCQvqCTHb40cL5tcjRhS8C6I01V97ogPqQ";

	//KEYWORD TO SEARCH
	$keyword = $_REQUEST["text_search"];
	$keyword = str_replace(" ", "%20", $keyword);
	// echo $keyword;

	//YOUTUBE API
	$url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=50&q='. $keyword .'&key='. $apikey;


	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);


	// echo $result;

	$arr = json_decode($result, true);

	// echo "<pre>";
	// print_r($arr);
	// echo "</pre>";

	// foreach ($arr["items"] as $val) {
	// 	echo $val["title"]."\n";
	// }
	echo "<pre>";
	$search_results = $arr["items"];
	foreach ($search_results as $val) {
		// echo $val["id"]["videoId"]."<br>";
		if(isset($val['id']['videoId'])) {
			$v = "youtube_video.php?v=".$val['id']['videoId'];
			echo $val["snippet"]["title"]." ";
			echo "<a href=".$v.">Link</a><br/>";
		}
	}
	echo "</pre>";
}
?>