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
            include 'user.php';
            break;
        default:
            break;
    }
}
function coleagueList(){
require_once 'settings.php';
/**$colleagues = '[
{
"firstName":"Jarrett",
"lastName":"Mejia",
"gender":"Male",
"streetAddress":"546 East Vine Lane",
"cityName":"Corona",
"stateName":"AK",
"zipCode":"02203",
"userName":"jarrettmejia"
},
{
"firstName":"Casey",
"lastName":"Cox",
"gender":"Male",
"streetAddress":"549 Pineapple Terrace",
"cityName":"Oakland",
"stateName":"MS",
"zipCode":"99331",
"userName":"caseycox"
},
{
"firstName":"Tiana",
"lastName":"Benson",
"gender":"Female",
"streetAddress":"604 Washington Loop",
"cityName":"Long Beach",
"stateName":"WY",
"zipCode":"96123",
"userName":"tianabenson"
},
{
"firstName":"Alexis",
"lastName":"Campbell",
"gender":"Male",
"streetAddress":"319 Birch Garden",
"cityName":"Indianapolis",
"stateName":"SD",
"zipCode":"92876",
"userName":"alexiscampbell"
},
{
"firstName":"Gabriel",
"lastName":"Walton",
"gender":"Male",
"streetAddress":"580 Springhill Boulevard",
"cityName":"Worcester ",
"stateName":"AZ",
"zipCode":"76654",
"userName":"gabrielwalton"
},
{
"firstName":"Colin",
"lastName":"Cross",
"gender":"Male",
"streetAddress":"756 Tyler Loop",
"cityName":"Naperville",
"stateName":"CO",
"zipCode":"90880",
"userName":"colincross"
},
{
"firstName":"Meaghan",
"lastName":"Murray",
"gender":"Female",
"streetAddress":"130 Pecan Highway",
"cityName":"Cary",
"stateName":"WI",
"zipCode":"26042",
"userName":"meaghanmurray"
},
{
"firstName":"Randall",
"lastName":"Adkins",
"gender":"Male",
"streetAddress":"824 Birch Avenue",
"cityName":"Wichita",
"stateName":"OK",
"zipCode":"82161",
"userName":"randalladkins"
},
{
"firstName":"Asia",
"lastName":"Hawkins",
"gender":"Female",
"streetAddress":"669 North Blackberry Expressway",
"cityName":"Denver",
"stateName":"DE",
"zipCode":"29945",
"userName":"asiahawkins"
},
{
"firstName":"Ty",
"lastName":"Jimenez",
"gender":"Male",
"streetAddress":"293 South Taylor Avenue",
"cityName":"Richardson",
"stateName":"AR",
"zipCode":"36618",
"userName":"tyjimenez"
},
{
"firstName":"Robyn",
"lastName":"Cunningham",
"gender":"Female",
"streetAddress":"214 Peach Circle",
"cityName":"Ashland",
"stateName":"NM",
"zipCode":"56154",
"userName":"robyncunningham"
},
{
"firstName":"Janet",
"lastName":"Benson",
"gender":"Female",
"streetAddress":"316 Ford Road",
"cityName":"Burlington",
"stateName":"IN",
"zipCode":"78046",
"userName":"janetbenson"
},
{
"firstName":"Preston",
"lastName":"Vaughn",
"gender":"Male",
"streetAddress":"615 Arthur Drive",
"cityName":"Peoria",
"stateName":"AL",
"zipCode":"44861",
"userName":"prestonvaughn"
},
{
"firstName":"Holly",
"lastName":"Daniel",
"gender":"Female",
"streetAddress":"738 Blackberry Turnpike",
"cityName":"El Paso",
"stateName":"ID",
"zipCode":"95611",
"userName":"hollydaniel"
},
{
"firstName":"Makayla",
"lastName":"Nunez",
"gender":"Female",
"streetAddress":"551 Harrison Turnpike",
"cityName":"Waco",
"stateName":"ME",
"zipCode":"23237",
"userName":"makaylanunez"
},
{
"firstName":"Iris",
"lastName":"George",
"gender":"Female",
"streetAddress":"579 9th Way",
"cityName":"Thousand Oaks",
"stateName":"VT",
"zipCode":"75318",
"userName":"irisgeorge"
},
{
"firstName":"Isaac",
"lastName":"Miles",
"gender":"Male",
"streetAddress":"95 Pineapple Avenue",
"cityName":"Fairview",
"stateName":"WV",
"zipCode":"60505",
"userName":"isaacmiles"
},
{
"firstName":"Carly",
"lastName":"Roberts",
"gender":"Female",
"streetAddress":"802 West Hoover Drive",
"cityName":"Corona",
"stateName":"LA",
"zipCode":"36283",
"userName":"carlyroberts"
},
{
"firstName":"Danielle",
"lastName":"Fernandez",
"gender":"Female",
"streetAddress":"356 Blackberry Street",
"cityName":"Salem",
"stateName":"ME",
"zipCode":"00493",
"userName":"daniellefernandez"
},
{
"firstName":"Jocelyn",
"lastName":"Barber",
"gender":"Female",
"streetAddress":"538 East Cranberry Place",
"cityName":"Garden Grove",
"stateName":"VA",
"zipCode":"17638",
"userName":"jocelynbarber"
}
]';
 * *
 */
if(file_exists($filename)){
    $result = readProjectFormResult($filename);
    return $result;
}else{
    //$templist = json_decode($colleagues, true);
    //foreach ($templist as $key => $value) {
    //    saveProjectFormResult($filename, $templist);
    //}
    //$result = readProjectFormResult($filename);
    //return $result;
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
            $contenttext = fread($projectfile, filesize($path));
            $result = json_decode($contenttext);
        }
    }
    return $result;
}
function getUserList(){
    require_once 'settings.php';
    $result = readProjectFormResult($filename);
    return $result;
}
function checkUserExists(){
    $result = getUserList();
    $userName = $_POST["userName"];
    $action="insert";
    foreach ($result as $key => $value) {
        if($value['userName'] == $userName){
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
    $result = getUserList();
    $result[]=array(
        "firstname"=>$_POST["firstname"],
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
    $result = getUserList();
    $userName = $_POST["userName"];
    $newUserList = array();
    foreach ($result as $key => $value) {
        if($value['userName'] == $userName){
            $value["firstname"]=$_POST["firstname"];
            $value["lastName"]=$_POST["lastName"];
            $value["gender"]=$_POST["gender"];
            $value["streetAddress"]=$_POST["streetAddress"];
            $value["cityName"]=$_POST["cityName"];
            $value["stateName"]=$_POST["stateName"];
            $value["zipCode"]=$_POST["zipCode"];
            $value["userName"]=$_POST["userName"];
        }
        $newUserList[]=$value;
    }
    saveProjectFormResult($filename, $newUserList); 
}