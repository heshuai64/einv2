<?php

for($i = 3826; $i > 0; $i--){
    $content = file_get_contents('http://www.artyh.com/ArticleShow.asp?ArticleID='.$i);
    if($content == false){
        exit;
    }
    preg_match('/img src=Uploadfiles\/\d{10,18}\.jpg/', $content, $matches);
    preg_match('/<font color=\'#FF6600\'>(.{1,30})<\/font><\/a>/', $content, $category);
    $category_name = $category[1];
    if(!file_exists("/export/artyh/".$category_name)){
        mkdir("/export/artyh/".$category_name, 0777);
    }
    
    if(!empty($category_name)){
        echo $category_name."\n";
        
        if(!empty($matches[0])){
            //print_r($matches);
            $picture_address = explode("=", $matches[0]);
            $picture_address = $picture_address[1];
            //echo $picture_address;
            //echo "\n";
            
            $picture_name = explode("/", $picture_address);
            $picture_name = $picture_name[1];
            echo $picture_name;
            echo "\n";
            
            $picture_content = file_get_contents("http://www.artyh.com/".$picture_address);
            if($picture_content == false){
                exit;
            }
            file_put_contents("/export/artyh/".$category_name."/".$picture_name, $picture_content);
            file_put_contents("/export/artyh/download.log", $i);
        }else{
            echo 'no product: http://www.artyh.com/ArticleShow.asp?ArticleID='.$i;
            echo "\n";
        }
    }else{
        echo 'no category: http://www.artyh.com/ArticleShow.asp?ArticleID='.$i;
        echo "\n";
        //exit;
    }
    echo "\n";
    //exit;
    //sleep(1);
}

?>