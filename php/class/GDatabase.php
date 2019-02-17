<?php   
    class GDatabase {
        //===============================================
        private static $m_instance = null;
        private $m_databaseName = "";
        private $m_keyPath = array();
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
            $this->getDatabaseName($file);
            
            if($this->m_databaseName == "") {
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
                $lFilePath = $lDirPath."/".$this->m_databaseName;
                $lFilePath = realpath($lFilePath);
                $lData = file_get_contents($lFilePath);
                $lJson = json_decode($lData, true);
                
                for($i = 0; $i < count($this->m_keyPath); $i++) {
                    $lKey = $this->m_keyPath[$i];
                    $lJson = $lJson[$lKey];
                }
                
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
        public function getDatabaseName($file) {
			$lFileMap = explode("/", $file);
            $lOneOnly = true;
            $this->m_databaseName = "";
            $this->m_keyPath = array();
            
			for($i = 0; $i < count($lFileMap); $i++) {
                $lFile = $lFileMap[$i];
                if($lFile != "") {
                    if(!$lOneOnly) {
                        $this->m_keyPath[] = $lFile;
                    }
                    if($lOneOnly) {
                        $lOneOnly = false;
                        $this->m_databaseName = $lFile;
                    }
                }
            }
        }
        //===============================================
    }
?>        