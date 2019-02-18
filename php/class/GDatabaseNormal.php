<?php   
    class GDatabaseNormal extends GDatabase {
        //===============================================
        private static $m_instance = null;
        private $m_databaseName = "";
        private $m_fileName = "";
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
        public function readFile($file) {
            $lJsonMap = GJson::Instance()->getData("data/json/database.json");
            $lJsonData = $lJsonMap["database"];
			$lDirNameArr = array();
            $this->getDatabaseName($file);
            
            if($this->m_databaseName == "") return;
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
            $lFileRead = "";

            if($lDatabaseName == "Chorale") {
                $lDataMap = $lDatabaseMap["members"];
                $lData = array();
                
                for($i = 0; $i < count($lDataMap); $i++) {
                    $lData = $lDataMap[$i];
                    $lFullName = "";
                    $lFullName .= $lData["lastname"]." ";
                    $lFullName .= $lData["usualname"]." | ";
                    $lFullName .= $lData["group"];
                    if($lFullName == $this->m_fileName) break;
                }
                
                $lFileRead .= "<div class='Row9'>"; 
                $lFileRead .= "<span class='Label4'>Nom:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["lastname"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Prénom(s):</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["firstname"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Nom Usuel:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["usualname"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Fonction:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["function"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Matricule:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["registration"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Sexe:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["gender"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Email:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["email"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Téléphone:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["phone"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Adresse:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["address1"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Complément:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["address2"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Code Postal:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["zip_code"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Ville:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["city"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Pays:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["country"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Groupe:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["group"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Actif:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["active"]."</span>";
                $lFileRead .= "</div>";
                $lFileRead .= "<div class='Row9'>";
                $lFileRead .= "<span class='Label4'>Avatar:</span> ";
                $lFileRead .= "<span class='Field5'>".$lData["avatar"]."</span>";
                $lFileRead .= "</div>";                
            }

			return $lFileRead;
        }
        //===============================================
        public function getDatabaseName($file) {
			$lFileMap = explode("/", $file);
            $this->m_databaseName = "";
            $this->m_fileName = "";
            $lCount = 0;
            
			for($i = 0; $i < count($lFileMap); $i++) {
                $lFile = $lFileMap[$i];
                if($lFile != "") {
                    if($lCount == 0) $this->m_databaseName = $lFile;
                    if($lCount == 1) $this->m_fileName = $lFile;
                    $lCount++;
                }
            }
        }
        //===============================================
    }
?>        