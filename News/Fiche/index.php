<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";
    
    $lData = GJson::Instance()->getData("data/json/Fiche_News.json");

    GConfig::Instance()->setData("title", "Fiche");
    GConfig::Instance()->setData("menu", "News");
    GConfig::Instance()->setData("view", "Fiche_News");
    GConfig::Instance()->setData("link", $lData["links"]);
    
    require $_SERVER["DOCUMENT_ROOT"]."/php/header.php";
    
    $lNewsFile = "news_none.php";
    if(isset($_REQUEST["file"])) {
        $lNewsFile = $_REQUEST["file"];
        $lNewsFile .= ".php";
    }
?>
<!-- ============================================ -->
<div class="MainBody">
    <!-- ============================================ -->
    <?php require "page/$lNewsFile"; ?>
    <!-- ============================================ -->
</div>
<!-- ============================================ -->
<?php require $_SERVER["DOCUMENT_ROOT"]."/php/footer.php"; ?>
<!-- ============================================ -->
