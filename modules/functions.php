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
        case "remove":
            removeResult();
            break;
        default:
            break;
    }
}
function coleagueList(){
    $filename = "colleagueInfo.txt";
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
    $filename = "colleagueInfo.txt";
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
function removeResult(){
    $filename = "colleagueInfo.txt";
    $result = getUserList();
    $userName = $_POST["userName"];
    $newList= array();
    
    foreach ($result as $key => $value) {
        if($value->userName == $userName){
            if(array_key_exists('userImage', $value)){
                $userImage = $value->userImage;
                if(file_exists($userImage)){unlink($userImage);}
                $userImage='';
            }
        }else{
            $newList[] = $value;
        }
    }
    saveProjectFormResult($filename, $newList);
}
function saveNewUser(){
    require_once 'settings.php';
    $result = getUserList();
    $result[]=array(
        "firstName"=>$_POST["firstName"],
        "lastName"=>$_POST["lastName"],
        "gender"=>$_POST["gender"],
        "streetAddress"=>$_POST["streetAddress"],
        "cityName"=>$_POST["cityName"],
        "stateName"=>$_POST["stateName"],
        "zipCode"=>$_POST["zipCode"],
        "userName"=>$_POST["userName"],
        "userImage"=>fileAction()
    );
    saveProjectFormResult($filename, $result);
}
function changeUser(){
    $filename = "colleagueInfo.txt";
    $result = getUserList();
    $userName = $_POST["userName"];
    $newUserList = array();
    foreach ($result as $key => $value) {
        if($value->userName == $userName){
            $nameFile = fileAction();
            if($nameFile == ''){$nameFile = $value->userImage;}
            $value= array(
                "firstName"=>$_POST["firstName"],
                "lastName"=>$_POST["lastName"],
                "gender"=>$_POST["gender"],
                "streetAddress"=>$_POST["streetAddress"],
                "cityName"=>$_POST["cityName"],
                "stateName"=>$_POST["stateName"],
                "zipCode"=>$_POST["zipCode"],
                "userName"=>$_POST["userName"],
                "userImage"=>$nameFile
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
    $logpath = "logfile.txt";
    $active="no";
    if($active == 'yes'){
    $projectfile = fopen($logpath,'a');
    if(is_array($data)){$data = json_encode($data);};
    $content = $data. PHP_EOL;
    fwrite($projectfile,$content);
    fclose($projectfile);
    }
}
function fileAction(){
    $target_dir = "foto/";
    $className = "userImage";
try{if(isset($_FILES) && $_FILES[$className]["name"] !=''){
    $filename = $_FILES[$className]["name"];
    $filename = str_replace(" ", "_", $filename);
    $target_file = $target_dir . basename($filename);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"]) && $_FILES[$className]["tmp_name"] != '') {
        $check = getimagesize($_FILES[$className]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $new_filename = $target_file;
        $filefound = true;
        $counter=1;
        while($filefound){
            $new_filename= str_replace('.'.$imageFileType, $counter.'.'.$imageFileType, $target_file);
            if(!file_exists($new_filename)){
                $target_file = $new_filename;
                $filefound = false;
            }
            $counter +=1;
        }
    }
    // Check file size
    if ($_FILES[$className]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    $imageFileType = array("jpg", "png", "jpeg","gif" );
    if(in_array($imageFileType , $imageFileType)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES[$className]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
} catch (Exception $e) {

}
}