<?php

for($i = 5574; $i > 0; $i--){
    $content = file_get_contents('http://www.artyh.com/ArticleShow.asp?ArticleID='.$i);
    if($content == false){
        exit;
    }
    preg_match('/img src=Uploadfiles\/\d{10,18}\.jpg/', $content, $matches);
    //print_r($matches);
    $picture_address = explode("=", $matches[0]);
    $picture_address = $picture_address[1];
    //echo $picture_address;
    
    $picture_name = explode("/", $picture_address);
    $picture_name = $picture_name[1];
    //echo $picture_name;
    
    $picture_content = file_get_contents("http://www.artyh.com/".$picture_address);
    if($picture_content == false){
        exit;
    }
    file_put_contents("/export/images/".$picture_name, $picture_content);
    file_put_contents("download.log", $i);
    //exit;
    //sleep(1);
}

?>