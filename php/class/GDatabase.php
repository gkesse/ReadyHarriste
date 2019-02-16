<?php   
    class GDatabase {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GDatabase();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function listDatabase($file) {
			$lRootPath = $_SERVER["DOCUMENT_ROOT"];
			$lRootPath = realpath($lRootPath);
            $lJsonPath = "data/json/";
            $lDirPath = $lRootPath."/".$lJsonPath;
			$lDirPath = realpath($lDirPath);
			$lDirNameArr = array();
            
            if($file == "") {
                $lIcon = "database";
                $lDirPtr = opendir($lDirPath);
                while(1) {
                    $lDirName = readdir($lDirPtr);
                    if(!$lDirName) break;
                    if($lDirName == "." || $lDirName == "..") continue;
                    $lExt = pathinfo($lDirName, PATHINFO_EXTENSION);
                    if($lExt != "json") continue;
                    $lDirNameArr[] = array($lDirName, $lIcon);
                }
                closedir($lDirPtr);
            }
            else {
                $lIcon = "file";
                $lFilePath = $lDirPath."/".$file;
                $lFilePath = realpath($lFilePath);
                $lData = file_get_contents($lFilePath);
                $lJson = json_decode($lData, true);
                $lKeyMap = array_keys($lJson);
                for($i = 0; $i < count($lKeyMap); $i++) {
                    $lKey = $lKeyMap[$i];
                    $lDirNameArr[] = array($lKey, $lIcon);
                }
            }
            
			return $lDirNameArr;
        }
        //===============================================
        public function getPath($file) {
            return $file;
        }
        //===============================================
        public function getDatabase($file) {
			$lFileMap = explode("/", $file);
            $lDatabaseName = "";
			for($i = 0; $i < count($lFileMap); $i++) {
                $lFile = $lFileMap[$i];
                if($lFile != "") {$lDatabaseName = $lFile; break;}
            }
            return $lDatabaseName;
        }
        //===============================================
    }
?>        