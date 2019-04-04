<?php   
    abstract class GDatabaseView {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            $lKey = GConfig::Instance()->getData("DATABASE");
            if($lKey == "Prédicateurs") return GDatabaseViewPredicateurs::Instance();
            if($lKey == "Doyens") return GDatabaseViewDoyens::Instance();
            if($lKey == "Apôtres") return GDatabaseViewApotres::Instance();
            if($lKey == "Chorale") return GDatabaseViewChorale::Instance();
            if($lKey == "Femmes d'Honneur") return GDatabaseViewFemmesHonneur::Instance();
            if($lKey == "Gardes") return GDatabaseViewGardes::Instance();
            if($lKey == "UFHAF") return GDatabaseViewUFHAF::Instance();
            if($lKey == "Jeunesse") return GDatabaseViewJeunesse::Instance();
            if($lKey == "News") return GDatabaseViewNews::Instance();
            return GDatabaseViewChorale::Instance();
        }
        //===============================================
        abstract public function openDatabase($dataMap);
        abstract public function readFile($dataMap, $fileName);
        abstract public function updateFile($dataMap, $fileName);
        abstract public function createFile($dataMap, $fileName);
        abstract public function previewFile($dataMap, $fileName);
        abstract public function visualizeFile($dataMap, $fileName);
        abstract public function deleteFile($filePath, $fileName);
        abstract public function updateDatabase($filePath, $fileName, $data);
        abstract public function createDatabase($filePath, $data);
        //===============================================
    }
?>        