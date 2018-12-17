<?php

function returnsection($sectionName){
    switch ($sectionName) {
        case "home":
            include 'section.php';
            break;
        case "user":
            include 'user.php';
            break;
        case "new":
            checkUserExists();
            break;
        case "read":
            include 'jsonResult.php';
            break;
        default:
            break;
    }
}
function coleagueList(){
    $filename="D:/wamp/www/cg/sites/face_book/colleagueInfo.txt";
    include_once 'settings.php';
if(file_exists($filename)){
    $result = readProjectFormResult($filename);
    return $result;
}
}
function saveProjectFormResult($path, $data){
    $projectfile = fopen($path,'w');
    $content = json_encode($data);
    fwrite($projectfile,$content);
    fclose($projectfile);
}
function readProjectFormResult($path){
    $result=array();
    if(file_exists($path)){
        $projectfile= fopen($path,"r");
        if(filesize($path)>0){
            // fstat is used because it gives the correct filesize after updating the file.
            $filesStatus = fstat($projectfile);
            $filesize = $filesStatus[7];
            $contenttext = fread($projectfile, $filesize);
            $result = json_decode($contenttext);
        }
        fclose($projectfile);
    }
    
    return $result;
}
function getUserList(){
    $filename="D:/wamp/www/cg/sites/face_book/colleagueInfo.txt";
    include_once 'settings.php';
    $result = readProjectFormResult($filename);
    return $result;
}
function checkUserExists(){
    $result = getUserList();
    $userName = $_POST["userName"];
    $action="insert";
    foreach ($result as $key => $value) {
        if($value->userName == $userName){
            $action="update"; 
            break;
        }
    }
    switch ($action) {
        case "insert":
            saveNewUser();
            break;
        case "update":
            changeUser();
            break;
        default:
            break;
    }
}
function saveNewUser(){
    $filename="D:/wamp/www/cg/sites/face_book/colleagueInfo.txt";
    include_once 'settings.php';
    $result = getUserList();
    $result[]=array(
        "firstName"=>$_POST["firstName"],
        "lastName"=>$_POST["lastName"],
        "gender"=>$_POST["gender"],
        "streetAddress"=>$_POST["streetAddress"],
        "cityName"=>$_POST["cityName"],
        "stateName"=>$_POST["stateName"],
        "zipCode"=>$_POST["zipCode"],
        "userName"=>$_POST["userName"]
    );
    saveProjectFormResult($filename, $result);
}
function changeUser(){
    $filename="D:/wamp/www/cg/sites/face_book/colleagueInfo.txt";
    include_once 'settings.php';
    $result = getUserList();
    $userName = $_POST["userName"];
    $newUserList = array();
    foreach ($result as $key => $value) {
        if($value->userName == $userName){
            $value= array(
                "firstName"=>$_POST["firstName"],
                "lastName"=>$_POST["lastName"],
                "gender"=>$_POST["gender"],
                "streetAddress"=>$_POST["streetAddress"],
                "cityName"=>$_POST["cityName"],
                "stateName"=>$_POST["stateName"],
                "zipCode"=>$_POST["zipCode"],
                "userName"=>$_POST["userName"]
            );
        }
        $newUserList[]=$value;
    }
    saveProjectFormResult($filename, $newUserList); 
}
function readUserInfo(){
    $result = getUserList();
    $userName = $_POST["userName"];
    foreach ($result as $key => $value) {
        if($value->userName == $userName){
            $userInfo = json_encode($value);
            return $userInfo;
            break;
        }
    }
}

function logfile($data){
    $active="no";
    if($active == 'yes'){
    $path = "D:/wamp/www/cg/sites/face_book/logfile.txt";
    $projectfile = fopen($path,'a');
    if(is_array($data)){$data = json_encode($data);};
    $content = $data. PHP_EOL;
    fwrite($projectfile,$content);
    fclose($projectfile);
    }
}