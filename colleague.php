<?php
if(count($_POST)>0){
    include_once 'modules/functions.php';
    returnsection($_POST['name']);
}else{
?>
<!DOCHTML html>
<html lang="nl">
    <?php
    include 'head.php';
    ?>
    <body>
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