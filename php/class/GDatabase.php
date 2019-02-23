<?php   
    abstract class GDatabase {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            $lKey = "NORMAL";
            if($lKey == "NORMAL") return GDatabaseNormal::Instance();
            return GDatabaseNormal::Instance();
        }
        //===============================================
        abstract public function openDatabase($file);
        abstract public function readFile($file);
        abstract public function updateFile($file);
        abstract public function createFile($path, $file);
        abstract public function deleteFile($file);
        abstract public function updateDatabase($file, $data);
        abstract public function createDatabase($file, $data);
        //===============================================
    }
?>        