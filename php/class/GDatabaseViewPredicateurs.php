<?php   
    class GDatabaseViewPredicateurs extends GDatabaseView {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GDatabaseViewPredicateurs();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function openDatabase($dataMap) {
            $lDataMap = $dataMap["members"];
            $lDirNameMap = array();
            $lIcon = "user";
            
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["lastname"]." ";
                $lFullName .= $lData["usualname"];
                $lDirNameMap[] = array($lFullName, $lIcon, "FILE");
            }
            
            return $lDirNameMap;
        }
        //===============================================
        public function readFile($dataMap, $fileName) {
            $lDataMap = $dataMap["members"];
            $lData = array();
            
            $fileName = trim(mb_strtolower($fileName, "UTF-8"));

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= trim($lData["lastname"])." ";
                $lFullName .= trim($lData["usualname"]);
                $lFullName = trim(mb_strtolower($lFullName, "UTF-8"));

                if($lFullName == $fileName) break;
            }
            
            $lAvatar = "male_avatar.png";
            if($lData["gender"] == "Féminin") {
                $lAvatar = "female_avatar.png";
            }
        
            $lLastname = strtolower(GString::Instance()->noAccent($lData["lastname"]));
            $lUsualname = strtolower(GString::Instance()->noAccent($lData["usualname"]));
            $lAvatarFile = $lLastname.'_'.$lUsualname.'.png';
            $lAvatarRoot = "/Predicateurs/Membres/img/";
            $lAvatarPath = $lAvatarRoot.$lAvatarFile;
            
            if(GFile::Instance()->exists($lAvatarPath) == false) {
                $lAvatarPath = $lAvatarRoot.$lAvatar;
            }

            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Nom:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["lastname"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Prénom(s):</span> ";
            $lFileData .= "<span class='Field5'>".$lData["firstname"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Nom Usuel:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["usualname"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Fonction:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["function"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Matricule:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["registration"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Sexe:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["gender"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Email:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["email"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Téléphone:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["phone"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Adresse:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["address1"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Complément:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["address2"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Code Postal:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["zip_code"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Ville:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["city"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Pays:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["country"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Groupe:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["group"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<span class='Label4'>Actif:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["active"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<img class='Img6' src='".$lAvatarPath."' alt='Avatar.png' width='80' height='80'>";

            return $lFileData;
        }
        //===============================================
        public function updateFile($dataMap, $fileName) {
            $lDataMap = $dataMap["members"];
            $lData = array();
            
            $fileName = trim(mb_strtolower($fileName, "UTF-8"));

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= trim($lData["lastname"])." ";
                $lFullName .= trim($lData["usualname"]);
                $lFullName = mb_strtolower($lFullName, "UTF-8");

                if($lFullName == $fileName) break;
            }
            
            $lAvatar = "male_avatar.png";
            if($lData["gender"] == "Féminin") {
                $lAvatar = "female_avatar.png";
            }
        
            $lGenderMap = array("Masculin", "Féminin");
            $lGroupMap = array("Prédicateur");
            $lActiveMap = array("Oui", "Non");
        
            $lLastname = strtolower(GString::Instance()->noAccent($lData["lastname"]));
            $lUsualname = strtolower(GString::Instance()->noAccent($lData["usualname"]));
            $lAvatarFile = $lLastname.'_'.$lUsualname.'.png';
            $lAvatarRoot = "/Predicateurs/Membres/img/";
            $lAvatarPath = $lAvatarRoot.$lAvatarFile;
            
            if(GFile::Instance()->exists($lAvatarPath) == false) {
                $lAvatarPath = $lAvatarRoot.$lAvatar;
            }

            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='lastname'>Nom:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='lastname' id='lastname' value=\"".$lData["lastname"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='firstname'>Prénom(s):</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='firstname' id='firstname' value=\"".$lData["firstname"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='usualname'>Nom Usuel:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='usualname' id='usualname' value=\"".$lData["usualname"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='function'>Fonction:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='function' id='function' value=\"".$lData["function"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='registration'>Matricule:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='registration' id='registration' value=\"".$lData["registration"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='gender'>Sexe:</label>";
            $lFileData .= "<div class='Field8 ComboBox DatabaseComboBoxUpdate'>";
            $lFileData .= "<select name='gender' id='gender'>";
            for($i = 0; $i < count($lGenderMap); $i++) {
                $lValue = $lGenderMap[$i];
                if($lValue == $lData["gender"]) $lFileData .= "<option value=\"".$lValue."\" selected>".$lValue."</option>";
                else $lFileData .= "<option value=\"".$lValue."\">".$lValue."</option>";
            }
            $lFileData .= "</select>";
            $lFileData .= "</div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='email'>Email:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='email' id='email' value=\"".$lData["email"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='phone'>Téléphone:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='phone' id='phone' value=\"".$lData["phone"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='address1'>Adresse:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='address1' id='address1' value=\"".$lData["address1"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='address2'>Complément:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='address2' id='address2' value=\"".$lData["address2"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='zip_code'>Code Postal:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='zip_code' id='zip_code' value=\"".$lData["zip_code"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='city'>Ville:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='city' id='city' value=\"".$lData["city"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='country'>Pays:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='country' id='country' value=\"".$lData["country"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='group'>Groupe:</label>";
            $lFileData .= "<div class='Field8 ComboBox DatabaseComboBoxUpdate'>";
            $lFileData .= "<select name='group' id='group'>";
            for($i = 0; $i < count($lGroupMap); $i++) {
                $lValue = $lGroupMap[$i];
                if($lValue == $lData["group"]) $lFileData .= "<option value=\"".$lValue."\" selected>".$lValue."</option>";
                else $lFileData .= "<option value=\"".$lValue."\">".$lValue."</option>";
            }
            $lFileData .= "</select>";
            $lFileData .= "</div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='active'>Actif:</label>";
            $lFileData .= "<div class='Field8 ComboBox DatabaseComboBoxUpdate'>";
            $lFileData .= "<select name='active' id='active'>";
            for($i = 0; $i < count($lActiveMap); $i++) {
                $lValue = $lActiveMap[$i];
                if($lValue == $lData["active"]) $lFileData .= "<option value=\"".$lValue."\" selected>".$lValue."</option>";
                else $lFileData .= "<option value=\"".$lValue."\">".$lValue."</option>";
            }
            $lFileData .= "</select>";
            $lFileData .= "</div>";
            $lFileData .= "</div>";
            $lFileData .= "<img class='Img6' src='".$lAvatarPath."' alt='Avatar.png' width='80' height='80'>";
            $lFileData .= "<div class='Row32'>";
            $lFileData .= "<button class='Button' type='submit' name='save'";
            $lFileData .= "value='Mettre à jour' onclick='updateDatabase(this);'>";
            $lFileData .= "<i class='fa fa-refresh'></i> Mettre à jour";
            $lFileData .= "</button>";
            $lFileData .= "</div>";

            return $lFileData;
        }
        //===============================================
        public function createFile($dataMap, $fileName) {
            $lDataMap = $dataMap["members"];
            $lData = array(
            "lastname" => "",
            "firstname" => "",
            "usualname" => "",
            "function" => "",
            "registration" => "",
            "gender" => "Masculin",
            "email" => "",
            "phone" => "",
            "address1" => "",
            "address2" => "",
            "zip_code" => "",
            "city" => "",
            "country" => "",
            "group" => "Membre",
            "active" => "Oui"
            );
            
            if($fileName != "") {
                $fileName = trim(mb_strtolower($fileName, "UTF-8"));

                for($i = 0; $i < count($lDataMap); $i++) {
                    $lData = $lDataMap[$i];
                    $lFullName = "";
                    $lFullName .= trim($lData["lastname"])." ";
                    $lFullName .= trim($lData["usualname"]);
                    $lFullName = mb_strtolower($lFullName, "UTF-8");

                    if($lFullName == $fileName) break;
                }
            }
            
            $lAvatar = "male_avatar.png";
            if($lData["gender"] == "Féminin") {
                $lAvatar = "female_avatar.png";
            }
        
            $lGenderMap = array("Masculin", "Féminin");
            $lGroupMap = array("Prédicateur");
            $lActiveMap = array("Oui", "Non");
        
            $lAvatarRoot = "/Predicateurs/Membres/img/";
            $lAvatarPath = $lAvatarRoot.$lAvatar;

            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='lastnameAdd'>Nom:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='lastnameAdd' id='lastnameAdd' value=\"".$lData["lastname"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='firstnameAdd'>Prénom(s):</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='firstnameAdd' id='firstnameAdd' value=\"".$lData["firstname"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='usualnameAdd'>Nom Usuel:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='usualnameAdd' id='usualnameAdd' value=\"".$lData["usualname"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='functionAdd'>Fonction:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='functionAdd' id='functionAdd' value=\"".$lData["function"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='registrationAdd'>Matricule:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='registrationAdd' id='registrationAdd' value=\"".$lData["registration"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='genderAdd'>Sexe:</label>";
            $lFileData .= "<div class='Field8 ComboBox DatabaseComboBoxCreate'>";
            $lFileData .= "<select name='genderAdd' id='genderAdd'>";
            for($i = 0; $i < count($lGenderMap); $i++) {
                $lValue = $lGenderMap[$i];
                if($lValue == $lData["gender"]) $lFileData .= "<option value=\"".$lValue."\" selected>".$lValue."</option>";
                else $lFileData .= "<option value=\"".$lValue."\">".$lValue."</option>";
            }
            $lFileData .= "</select>";
            $lFileData .= "</div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='emailAdd'>Email:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='emailAdd' id='emailAdd' value=\"".$lData["email"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='phoneAdd'>Téléphone:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='phoneAdd' id='phoneAdd' value=\"".$lData["phone"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='address1Add'>Adresse:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='address1Add' id='address1Add' value=\"".$lData["address1"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='address2Add'>Complément:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='address2Add' id='address2Add' value=\"".$lData["address2"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='zip_codeAdd'>Code Postal:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='zip_codeAdd' id='zip_codeAdd' value=\"".$lData["zip_code"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='cityAdd'>Ville:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='cityAdd' id='cityAdd' value=\"".$lData["city"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='countryAdd'>Pays:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='countryAdd' id='countryAdd' value=\"".$lData["country"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='groupAdd'>Groupe:</label>";
            $lFileData .= "<div class='Field8 ComboBox DatabaseComboBoxCreate'>";
            $lFileData .= "<select name='groupAdd' id='groupAdd'>";
            for($i = 0; $i < count($lGroupMap); $i++) {
                $lValue = $lGroupMap[$i];
                if($lValue == $lData["group"]) $lFileData .= "<option value=\"".$lValue."\" selected>".$lValue."</option>";
                else $lFileData .= "<option value=\"".$lValue."\">".$lValue."</option>";
            }
            $lFileData .= "</select>";
            $lFileData .= "</div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>";
            $lFileData .= "<label class='Label4' for='activeAdd'>Actif:</label>";
            $lFileData .= "<div class='Field8 ComboBox DatabaseComboBoxCreate'>";
            $lFileData .= "<select name='activeAdd' id='activeAdd'>";
            for($i = 0; $i < count($lActiveMap); $i++) {
                $lValue = $lActiveMap[$i];
                if($lValue == $lData["active"]) $lFileData .= "<option value=\"".$lValue."\" selected>".$lValue."</option>";
                else $lFileData .= "<option value=\"".$lValue."\">".$lValue."</option>";
            }
            $lFileData .= "</select>";
            $lFileData .= "</div>";
            $lFileData .= "</div>";
            $lFileData .= "<img class='Img6' src='".$lAvatarPath."' alt='Avatar.png' width='80' height='80'>";
            $lFileData .= "<div class='Row32'>";
            $lFileData .= "<button class='Button' type='submit' name='save'";
            $lFileData .= "value='Créer' onclick='createDatabase(this);'>";
            $lFileData .= "<i class='fa fa-cog'></i> Créer";
            $lFileData .= "</button>";
            $lFileData .= "</div>";

            return $lFileData;
        }
        //===============================================
        public function previewFile($dataMap, $fileName) {            
            return "";
        }
        //===============================================
        public function visualizeFile($dataMap, $fileName) {            
            return "";
        }
        //===============================================
        public function deleteFile($filePath, $fileName) {
            $lDatabaseMap = GJson::Instance()->getData($filePath);
            $lDataMap = $lDatabaseMap["members"];
            
            $fileName = trim(mb_strtolower($fileName, "UTF-8"));
                        
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= trim($lData["lastname"])." ";
                $lFullName .= trim($lData["usualname"]);
                $lFullName = mb_strtolower($lFullName, "UTF-8");
                
                if($lFullName == $fileName) {
                    array_splice($lDatabaseMap["members"], $i, 1);
                    break;
                }
            }
            
            GJson::Instance()->saveData($filePath, $lDatabaseMap);
            $lMessage = "La donnée a été supprimée avec succès.";
            return $lMessage;
        }
        //===============================================
        public function updateDatabase($filePath, $fileName, $data) {
            $lDatabaseMap = GJson::Instance()->getData($filePath);
            $lDataNew = json_decode($data, true);
            $lDataMap = $lDatabaseMap["members"];
            
            $fileName = trim(mb_strtolower($fileName, "UTF-8"));
                        
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= trim($lData["lastname"])." ";
                $lFullName .= trim($lData["usualname"]);
                $lFullName = mb_strtolower($lFullName, "UTF-8");
                
                if($lFullName == $fileName) {
                    $lDatabaseMap["members"][$i] = $lDataNew;
                    break;
                }
            }
            
            $lFullPath = "/Prédicateurs/";
            $lFullPath .= $lDataNew["lastname"]." ";
            $lFullPath .= $lDataNew["usualname"];

            GJson::Instance()->saveData($filePath, $lDatabaseMap);
            return $lFullPath;
        }
        //===============================================
        public function createDatabase($filePath, $data) {
            $lDatabaseMap = GJson::Instance()->getData($filePath);
            $lDataNew = json_decode($data, true);
            $lDataMap = $lDatabaseMap["members"];
            
            $lMessage = "La donnée a été ajoutée avec succès.";
            $lAdd = true;
            
            if($lDataNew["lastname"] == "") {
                $lMessage = "Le champ (Nom) est obligatoire.";
                $lAdd = false;
            }
            else if($lDataNew["usualname"] == "") {
                $lMessage = "Le champ (Nom Usuel) est obligatoire.";
                $lAdd = false;
            }
            else if($lDataNew["function"] == "") {
                $lMessage = "Le champ (Fonction) est obligatoire.";
                $lAdd = false;
            }
            else {
                $lFileName = "";
                $lFileName .= trim($lDataNew["lastname"])." ";
                $lFileName .= trim($lDataNew["usualname"]);
                $lFileName = mb_strtolower($lFileName, "UTF-8");
                
                for($i = 0; $i < count($lDataMap); $i++) {
                    $lData = $lDataMap[$i];
                    $lFullName = "";
                    $lFullName .= trim($lData["lastname"])." ";
                    $lFullName .= trim($lData["usualname"]);
                    $lFullName = mb_strtolower($lFullName, "UTF-8");
                    
                    if($lFullName == $lFileName) {
                        $lMessage = "";
                        $lMessage .= "Impossible d'ajouter la nouvelle donnée.\n";
                        $lMessage .= "Les champs (Nom) et (Nom Usuel) existent déjà.";
                        $lAdd = false;
                        break;
                    }
                }
            }
            
            if($lAdd) {
                $lDatabaseMap["members"][] = $lDataNew;
                GJson::Instance()->saveData($filePath, $lDatabaseMap);
            }
            return $lMessage;            
        }
        //===============================================
    }
?>        