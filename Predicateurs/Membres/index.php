<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";
    
    $lData = GJson::Instance()->getData("data/json/Predicateurs_Membres.json");

    GConfig::Instance()->setData("title", "Membres");
    GConfig::Instance()->setData("menu", "Prédicateurs");
    GConfig::Instance()->setData("view", "Predicateurs_Membres");
    GConfig::Instance()->setData("link", $lData["links"]);

    require $_SERVER["DOCUMENT_ROOT"]."/php/header.php";
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
