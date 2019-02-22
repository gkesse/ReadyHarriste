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
            if($lKey == "Chorale") return GDatabaseViewChorale::Instance();
            if($lKey == "Vues") return GDatabaseViewVues::Instance();
            return GDatabaseViewChorale::Instance();
        }
        //===============================================
        abstract public function openDatabase($dataMap);
        abstract public function readFile($dataMap, $fileName);
        abstract public function updateFile($dataMap, $fileName);
        abstract public function createFile($dataMap, $fileName);
        abstract public function updateDatabase($filePath, $fileName, $data);
        abstract public function createDatabase($filePath, $data);
        //===============================================
    }
?>        