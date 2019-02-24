<?php   
    class GDatabaseViewNews extends GDatabaseView {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GDatabaseViewNews();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function openDatabase($dataMap) {
            $lDataMap = $dataMap["news"];
            $lDirNameArr = array();
            $lIcon = "newspaper-o";
            
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
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
        public function createFile($dataMap, $fileName) {
            return "";
        }
        //===============================================
        public function deleteFile($filePath, $fileName) {
            return "";
        }
        //===============================================
        public function updateDatabase($filePath, $fileName, $data) {
            return "";
        }
        //===============================================
        public function createDatabase($filePath, $data) {
            return "";
        }
        //===============================================
    }
?>        