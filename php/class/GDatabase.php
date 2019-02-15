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
        public function listDatabase() {
			$lRootPath = $_SERVER["DOCUMENT_ROOT"];
			$lRootPath = realpath($lRootPath);
            $lJsonPath = "data/json/";
            $lDirPath = $lRootPath."/".$lJsonPath;
			$lDirPath = realpath($lDirPath);
			$lDirPtr = opendir($lDirPath);
			$lDirNameArr = array();
			while(1) {
				$lDirName = readdir($lDirPtr);
				if(!$lDirName) break;
				if($lDirName == "." || $lDirName == "..") continue;
                $lExt = pathinfo($lDirName, PATHINFO_EXTENSION);
                if($lExt != "json") continue;
				$lDirNameArr[] = array($lDirName);
            }
			closedir($lDirPtr);
			return $lDirNameArr;
        }
        //===============================================
    }
?>        