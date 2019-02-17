<?php   
    class GDatabaseNormal extends GDatabase {
        //===============================================
        private static $m_instance = null;
        private $m_databaseName = "";
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GDatabaseNormal();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function openDatabase($file) {
            $lJsonMap = GJson::Instance()->getData("data/json/database.json");
            $lJsonData = $lJsonMap["database"];
			$lDirNameArr = array();
            $this->getDatabaseName($file);
            
            if($this->m_databaseName == "") {
                $lIcon = "database";
                
                for($i = 0; $i < count($lJsonData); $i++) {
                    $lData = $lJsonData[$i];
                    $lName = $lData["name"];
                    $lDirNameArr[] = array($lName, $lIcon, "DIR");
                }
            }
            else {
                $lIcon = "file";
                $lDatabaseFile = "";
                $lDatabaseName = "";
                
                for($i = 0; $i < count($lJsonData); $i++) {
                    $lData = $lJsonData[$i];
                    $lDatabaseName = $lData["name"];
                    if($lDatabaseName == $this->m_databaseName) {
                        $lDatabaseFile = $lData["file"];
                        break;
                    }
                }
                
                $lDatabaseMap = GJson::Instance()->getData($lDatabaseFile);

                if($lDatabaseName == "Chorale") {
                    $lDataMap = $lDatabaseMap["members"];
                    
                    for($i = 0; $i < count($lDataMap); $i++) {
                        $lData = $lDataMap[$i];
                        $lFullName = "";
                        $lFullName .= $lData["lastname"]." ";
                        $lFullName .= $lData["usualname"]." | ";
                        $lFullName .= $lData["group"];
                        $lDirNameArr[] = array($lFullName, $lIcon, "FILE");
                    }
                }
                else if($lDatabaseName == "Vues") {                    
                    foreach($lDatabaseMap as $key => $value) {
                        $lFullName = "";
                        $lFullName .= $key." | ";
                        $lFullName .= $value;
                        $lDirNameArr[] = array($lFullName, $lIcon, "FILE");
                    }
                }
            }
            
			return $lDirNameArr;
        }
        //===============================================
        public function getDatabaseName($file) {
			$lFileMap = explode("/", $file);
            $this->m_databaseName = "";
            
			for($i = 0; $i < count($lFileMap); $i++) {
                $lFile = $lFileMap[$i];
                if($lFile != "") {$this->m_databaseName = $lFile;break;}
            }
        }
        //===============================================
    }
?>        