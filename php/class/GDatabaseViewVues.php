<?php   
    class GDatabaseViewVues extends GDatabaseView {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GDatabaseViewVues();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function openDatabase($dataMap) {
            $lDirNameArr = array();
            $lIcon = "file";
            
            foreach($dataMap as $key => $value) {
                $lFullName = "";
                $lFullName .= $key." | ";
                $lFullName .= $value;
                $lDirNameArr[] = array($lFullName, $lIcon, "FILE");
            }
            
            return $lDirNameArr;
        }
        //===============================================
        public function readFile($dataMap, $fileName) {
            return "";
        }
        //===============================================
        public function updateFile($dataMap, $fileName) {
            return "";
        }
        //===============================================
    }
?>        