<?php   
    class GDatabaseViewChorale extends GDatabaseView {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GDatabaseViewChorale();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function openDatabase($dataMap) {
            $lDataMap = $dataMap["members"];
            $lDirNameArr = array();
            $lIcon = "file";
            
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["lastname"]." ";
                $lFullName .= $lData["usualname"]." | ";
                $lFullName .= $lData["group"];
                $lDirNameArr[] = array($lFullName, $lIcon, "FILE");
            }
            
            return $lDirNameArr;
        }
        //===============================================
        public function readFile($dataMap, $fileName) {
            $lDataMap = $dataMap["members"];
            $lData = array();
            
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["lastname"]." ";
                $lFullName .= $lData["usualname"]." | ";
                $lFullName .= $lData["group"];
                if($lFullName == $fileName) break;
            }
            
            $lAvatar = "male_avatar.png";
            if($lData["gender"] == "Féminin") {
                $lAvatar = "female_avatar.png";
            }
        
            $lLastname = strtolower(GString::Instance()->noAccent($lData["lastname"]));
            $lUsualname = strtolower(GString::Instance()->noAccent($lData["usualname"]));
            $lAvatarFile = $lLastname.'_'.$lUsualname.'.png';
            $lAvatarRoot = "/Chorale/Membres/img/";
            $lAvatarPath = $lAvatarRoot.$lAvatarFile;
            
            if(GFile::Instance()->exists($lAvatarPath) == false) {
                $lAvatarPath = $lAvatarRoot.$lAvatar;
            }

            $lFileRead = "";
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
            $lFileRead .= "<img class='Img6' src='".$lAvatarPath."' alt='Avatar.png' width='80' height='80'>";

            return $lFileRead;
        }
        //===============================================
        public function updateFile($dataMap, $fileName) {
            $lDataMap = $dataMap["members"];
            $lData = array();
            
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["lastname"]." ";
                $lFullName .= $lData["usualname"]." | ";
                $lFullName .= $lData["group"];
                if($lFullName == $fileName) break;
            }
            
            $lAvatar = "male_avatar.png";
            if($lData["gender"] == "Féminin") {
                $lAvatar = "female_avatar.png";
            }
        
            $lLastname = strtolower(GString::Instance()->noAccent($lData["lastname"]));
            $lUsualname = strtolower(GString::Instance()->noAccent($lData["usualname"]));
            $lAvatarFile = $lLastname.'_'.$lUsualname.'.png';
            $lAvatarRoot = "/Chorale/Membres/img/";
            $lAvatarPath = $lAvatarRoot.$lAvatarFile;
            
            if(GFile::Instance()->exists($lAvatarPath) == false) {
                $lAvatarPath = $lAvatarRoot.$lAvatar;
            }

            $lFileUpdate = "";
            $lFileUpdate .= "<div class='Row9'>"; 
            $lFileUpdate .= "<label class='Label4' for='lastname'>Nom:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='lastname' id='lastname' value='".$lData["lastname"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='firstname'>Prénom(s):</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='firstname' id='firstname' value='".$lData["firstname"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='usualname'>Nom Usuel:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='usualname' id='usualname' value='".$lData["usualname"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='function'>Fonction:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='function' id='function' value='".$lData["function"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='registration'>Matricule:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='registration' id='registration' value='".$lData["registration"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='gender'>Sexe:</label>";
            $lFileUpdate .= "<div class='Field8 ComboBox DatabaseComboBox'>";
            $lFileUpdate .= "<select name='gender' id='gender'>";
            $lFileUpdate .= "<option value='Masculin'>Masculin</option>";
            $lFileUpdate .= "<option value='Féminin'>Féminin</option>";
            $lFileUpdate .= "</select>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='email'>Email:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='email' id='email' value='".$lData["email"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='phone'>Téléphone:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='phone' id='phone' value='".$lData["phone"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='address1'>Adresse:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='address1' id='address1' value='".$lData["address1"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='address2'>Complément:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='address2' id='address2' value='".$lData["address2"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='zip_code'>Code Postal:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='zip_code' id='zip_code' value='".$lData["zip_code"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='city'>Ville:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='city' id='city' value='".$lData["city"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='country'>Pays:</label>";
            $lFileUpdate .= "<div class='Field8'><input type='text' name='country' id='country' value='".$lData["country"]."'/></div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='group'>Groupe:</label>";
            $lFileUpdate .= "<div class='Field8 ComboBox DatabaseComboBox'>";
            $lFileUpdate .= "<select name='group' id='group'>";
            $lFileUpdate .= "<option value='Bureau'>Bureau</option>";
            $lFileUpdate .= "<option value='Maître'>Maître</option>";
            $lFileUpdate .= "<option value='Membre'>Membre</option>";
            $lFileUpdate .= "</select>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<div class='Row9'>";
            $lFileUpdate .= "<label class='Label4' for='active'>Actif:</label>";
            $lFileUpdate .= "<div class='Field8 ComboBox DatabaseComboBox'>";
            $lFileUpdate .= "<select name='active' id='active'>";
            $lFileUpdate .= "<option value='Oui'>Oui</option>";
            $lFileUpdate .= "<option value='Non'>Non</option>";
            $lFileUpdate .= "</select>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "</div>";
            $lFileUpdate .= "<img class='Img6' src='".$lAvatarPath."' alt='Avatar.png' width='80' height='80'>";
            $lFileUpdate .= "<script src='/js/class/GComboBox.js'></script>";

            return $lFileUpdate;
        }
        //===============================================
    }
?>        