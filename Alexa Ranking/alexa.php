<?php
/**
 * PHP Class to get a website Alexa Ranking
 * @author http://www.paulund.co.uk
 *
 */
class alexa{
  /**
  * Get the rank from alexa for the given domain
  *
  * @param $domain
  * The domain to search on

  */
  //$domain="www.google.com";
  public function get_rank($domain){
    $url = "http://data.alexa.com/data?cli=10&url=".$domain;
    //Initialize the Curl
    $ch = curl_init();  
    //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2); 
    //Set the URL
    curl_setopt($ch, CURLOPT_URL, $url);  
    //Execute the fetch
    $data = curl_exec($ch);  
    //Close the connection
    curl_close($ch);  
    $xml = new SimpleXMLElement($data);  
    //Get popularity node
    $popularity = $xml->xpath("//POPULARITY");
/*    $reviews    = $xml->xpath('//REVIEWS');
    $speed      = $xml->xpath('//SPEED');
    $links      = $xml->xpath('//LINKSIN');
    $category   = $xml->xpath('//CATS/CAT');
    $name       = $xml->xpath('//DMOZ/SITE'); */
	$reach = $xml->xpath("//REACH");
	$country = $xml->xpath("//COUNTRY");

    
//	print_r($popularity);
    // Get the Rank attribute
    $rank = (string)$popularity[0]['TEXT']; 
    echo $xml->saveXML();

    
    return array(
      'name'          => (string)$popularity[0]['URL'],
//      'category'      => (string)$category[0]['TITLE'],
	  'reach' => number_format((int)$reach[0]['RANK'],0),
      'rank'          => number_format((int)$popularity[0]['TEXT'],0),
	  'country' => (string)$country[0]['NAME'],
	  'con_rank' => (string)$country[0]['RANK']
//      'links'         => number_format((int)$links[0]['NUM'],0),
//      'reviews_stars' => (string)$reviews[0]['AVG'],
//      'reviews_num'   => (string)$reviews[0]['NUM'],      
//      'speed_time'    => (int)$speed[0]['TEXT'] / 1000,
//      'speed_percent' => (100 - (int)$speed[0]['PCT']).'% of sites are faster.'
    );
  }
}
/*$aa = new alexa;
$a=$aa->get_rank();
echo "NAME: ".$a['name']."<br>";
echo "GLOBAL RANK: ".$a['rank']."<br>";
echo "GLOBAL REACH: ".$a['reach']."<br>";
echo $a['country'].":".$a['con_rank']."<br>"; */
?>