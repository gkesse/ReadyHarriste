<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";
    
    $lData = GJson::Instance()->getData("data/json/Fiche_News.json");

    GConfig::Instance()->setData("title", "Fiche");
    GConfig::Instance()->setData("menu", "News");
    GConfig::Instance()->setData("view", "Fiche_News");
    GConfig::Instance()->setData("link", $lData["links"]);
    
    require $_SERVER["DOCUMENT_ROOT"]."/php/header.php";
    
    $_SESSION["file"] = "";
    if(isset($_REQUEST["file"])) $_SESSION["file"] = $_REQUEST["file"];
?>
<!-- ============================================ -->
<div class="MainBody">
    <!-- ============================================ -->
    <?php require "page/main.php"; ?>
    <!-- ============================================ -->
</div>
<!-- ============================================ -->
<?php require $_SERVER["DOCUMENT_ROOT"]."/php/footer.php"; ?>
<!-- ============================================ -->
