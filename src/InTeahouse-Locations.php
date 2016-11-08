<?php
//Include Simple HTML DOM php
include_once 'simple_html_dom.php';

//Ignore SSL, to enter any HTTPS website
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

//variable url contains the url of the website 
$url = "https://www.inteahouse.com/contact/";
//variable html contains the html of the website
$html = file_get_html($url, false, stream_context_create($arrContextOptions));

//variable location is an array containing the html of every location
$location = $html->find('article[class=location]');

//variable open2016 will hold all the locations that will open in 2016
$open2016 = [];
//variable open2017 will hold all the locations that will open in 2016
$open2017 = [];
//prints 'LOCATIONS OPEN:' into the console
echo "LOCATIONS OPEN: ", "\n\n";

//for evey location, a variable loc represents it inside the for
//in other words, locaiton[i] = loc
foreach ($location as $loc){
    
    //get the city with the function getElementByTagName
    $city = $loc->getElementByTagName('h2')->plaintext;
    //get the date, for when the location will open, or if it is already open
    $opening = $loc->getElementByTagName('p')->plaintext;
    //if the string opening contains 2016, it mean it will open in 2016. The object (html) loc is placed in array open2016 
    if (strpos($opening, '2016') !== false){
        array_push($open2016, $loc);   
        
    //if the string opening contains 2017, it mean it will open in 2017. The object (html) loc is placed in array open2017
    } elseif (strpos($opening, '2017') !== false){
        array_push($open2017, $loc);
        
    //else it will print the ones that are already open
    } else {
        echo $city," ", $opening, "\n";
    }
}

//prints "\nLOCATIONS OPENING IN 2016: "
echo "\nLOCATIONS OPENING IN 2016: ", "\n\n";
//create a for loop, starting at 0 until it get to the size of open2016
for ($i = 0; $i < (count($open2016)-1); $i++){
    //check that open2016[$i] is not empty, to not get error of using functions with null objects
    if (!empty($open2016[$i])){
        //get the city with the function getElementByTagName
        $city = $open2016[$i]->getElementByTagName('h2')->plaintext;
        //print the city
        echo $city," ", "\n";
    }
}
//prints "\nLOCATIONS OPENING IN 2017: "
echo "\nLOCATION OPENING IN 2017: ", "\n\n";
//create a for loop, starting at 0 until it get to the size of open2017
for ($i = 0; $i < (count($open2017)-1); $i++){
    //check that open2017[$i] is not empty, to not get error of using functions with null objects
    if (!empty($open2017[$i])){
        //get the city with the function getElementByTagName
        $city = $open2017[$i]->getElementByTagName('h2')->plaintext;
        //print the city
        echo $city, "\n";
    }
}
?>
