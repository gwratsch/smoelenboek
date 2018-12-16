<?php
include_once 'modules/functions.php';
$requestname = "";
$displayMainPage = "yes";
if(array_key_exists ('name', $_POST)){
    $requestname=$_POST['name'];
    switch ($requestname) {
        case "home":
            $displayMainPage = "no";
            break;
        case "user":
            $displayMainPage = "no";
            break;
        default:
            break;
    }
    returnsection($requestname);
}
if($displayMainPage == "yes"){
?>
<!DOCHTML html>
<html lang="nl">
    <?php
    include 'head.php';
    ?>
    <body class="background-size">
        <?php
        include 'header.php';
        include 'nav.php';
        echo '<div class="container">';
        include 'section.php';
        include 'aside.php';
        echo '</div>';
        include 'footer.php';
        ?>
    </body>
</html>
<?php
}
?>