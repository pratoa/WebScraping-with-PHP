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
$url = "https://www.inteahouse.com";
//variable html contains the html of the website
$html = file_get_html($url, false, stream_context_create($arrContextOptions));

//variable posts is an array containing the html for all div where class=module
$posts = $html->find('div[class=module]');

//for evey posts, a variable post represents it inside the for
//in other words, posts[i] = post
foreach($posts as $post){
    
    //get element h2, to obtain the title of the post
    $title = $post->getElementByTagName('h2')->plaintext;
    //get element div with class=subtitle to obtain the subtitle
    $subtitle = $post->getElementByTagName('div[class=subtitle]')->innertext;
    //get element p to obtain the paragraph
    $paragraph = $post->getElementByTagName('p')->plaintext;
    //get the attribute 'href' of the element a
    $url1 = $post->getElementByTagName('a')->getAttribute('href');
    //print the post
    echo $title, "\n", $subtitle, "\n\n", $paragraph, "\n", $url1, "\n\n";  
}
?>