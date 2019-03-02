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
            $lDirNameMap = array();
            $lIcon = "newspaper-o";
            
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lDirNameMap[] = array($lFullName, $lIcon, "FILE");
            }
            
            return $lDirNameMap;
        }
        //===============================================
        public function readFile($dataMap, $fileName) {
            $lDataMap = $dataMap["news"];
            $lData = array();
            
            $fileName = mb_strtolower($fileName, "UTF-8");

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lFullName = mb_strtolower($lFullName, "UTF-8");

                if($lFullName == $fileName) break;
            }

            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Auteur:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["author"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Catégorie:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["category"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Titre:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["title"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Création:</span> ";
            $lFileData .= "<span class='Field11'>".$lData["create"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Modification:</span> ";
            $lFileData .= "<span class='Field11'>".$lData["update"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Date:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["date"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Heure:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["time"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Lieu:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["place"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Adresse:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["address"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Icône:</span> ";
            $lFileData .= "<span class='Field5'>".$lData["icon"]."</span>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<span class='Label4'>Message:</span> ";
            $lFileData .= "<div class='Field9'><div>".$lData["message"]."</div></div>";
            $lFileData .= "</div>";
            $lFileData .= "<i class='Img7 fa fa-".$lData["icon"]."'></i>";
            
            return $lFileData;
        }
        //===============================================
        public function updateFile($dataMap, $fileName) {
            $lDataMap = $dataMap["news"];
            $lData = array();
            
            $fileName = mb_strtolower($fileName, "UTF-8");

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lFullName = mb_strtolower($lFullName, "UTF-8");

                if($lFullName == $fileName) break;
            }
            
            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='authorNewsUpdate'>Auteur:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='authorNewsUpdate' id='authorNewsUpdate' value=\"".$lData["author"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='categoryNewsUpdate'>Catégorie:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='categoryNewsUpdate' id='categoryNewsUpdate' value=\"".$lData["category"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='titleNewsUpdate'>Titre:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='titleNewsUpdate' id='titleNewsUpdate' value=\"".$lData["title"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='dateNewsUpdate'>Date:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='dateNewsUpdate' id='dateNewsUpdate' value=\"".$lData["date"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='timeNewsUpdate'>Heure:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='timeNewsUpdate' id='timeNewsUpdate' value=\"".$lData["time"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='placeNewsUpdate'>Lieu:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='placeNewsUpdate' id='placeNewsUpdate' value=\"".$lData["place"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='addressNewsUpdate'>Adresse:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='addressNewsUpdate' id='addressNewsUpdate' value=\"".$lData["address"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='iconNewsUpdate'>Icône:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='iconNewsUpdate' id='iconNewsUpdate' value=\"".$lData["icon"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row33'>"; 
            $lFileData .= "<label class='Label4' for='messageNewsUpdate'>Message:</label>";
            $lFileData .= "<div class='Field9'><div id='messageNewsUpdate'>".$lData["message"]."</div></div>";
            $lFileData .= "<i class='fa fa-copy Icon12' onclick='copyMessageNewsUpdate();' title='Copier vers la mémoire'></i>";
            $lFileData .= "<i class='fa fa-paste Icon13' onclick='pasteMessageNewsUpdate();' title='Coller de la mémoire'></i>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row32'>";
            $lFileData .= "<button class='Button' type='submit' name='save'";
            $lFileData .= "value='Mettre à jour' onclick='updateDatabaseNews(this);'>";
            $lFileData .= "<i class='fa fa-refresh'></i> Mettre à jour";
            $lFileData .= "</button>";
            $lFileData .= "</div>";
            $lFileData .= "<i class='Img7 fa fa-".$lData["icon"]."'></i>";
            
            return $lFileData;
        }
        //===============================================
        public function createFile($dataMap, $fileName) {
            $lDataMap = $dataMap["news"];
            $lData = array(
            "author" => "",
            "category" => "",
            "title" => "",
            "date" => "",
            "time" => "",
            "place" => "",
            "address" => "",
            "icon" => "users",
            "message" => ""
            );
            
            if($fileName != "") {
                $fileName = mb_strtolower($fileName, "UTF-8");

                for($i = 0; $i < count($lDataMap); $i++) {
                    $lData = $lDataMap[$i];
                    $lFullName = "";
                    $lFullName .= $lData["category"]." | ";
                    $lFullName .= $lData["title"]." | ";
                    $lFullName .= $lData["date"]." à ";
                    $lFullName .= $lData["time"]." | ";
                    $lFullName .= $lData["place"];
                    $lFullName = str_replace("/", "-", $lFullName);
                    $lFullName = mb_strtolower($lFullName, "UTF-8");

                    if($lFullName == $fileName) break;
                }
            }

            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='authorNews'>Auteur:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='authorNewsCreate' id='authorNewsCreate' value=\"".$lData["author"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='categoryNewsCreate'>Catégorie:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='categoryNewsCreate' id='categoryNewsCreate' value=\"".$lData["category"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='titleNewsCreate'>Titre:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='titleNewsCreate' id='titleNewsCreate' value=\"".$lData["title"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='dateNewsCreate'>Date:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='dateNewsCreate' id='dateNewsCreate' value=\"".$lData["date"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='timeNewsCreate'>Heure:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='timeNewsCreate' id='timeNewsCreate' value=\"".$lData["time"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='placeNewsCreate'>Lieu:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='placeNewsCreate' id='placeNewsCreate' value=\"".$lData["place"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='addressNewsCreate'>Adresse:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='addressNewsCreate' id='addressNewsCreate' value=\"".$lData["address"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='iconNewsCreate'>Icône:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='iconNewsCreate' id='iconNewsCreate' value=\"".$lData["icon"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row33'>"; 
            $lFileData .= "<label class='Label4' for='messageNewsCreate'>Message:</label>";
            $lFileData .= "<div class='Field9'><div id='messageNewsCreate'>".$lData["message"]."</div></div>";
            $lFileData .= "<i class='fa fa-copy Icon12' onclick='copyMessageNewsCreate();' title='Copier vers la mémoire'></i>";
            $lFileData .= "<i class='fa fa-paste Icon13' onclick='pasteMessageNewsCreate();' title='Coller de la mémoire'></i>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row32'>";
            $lFileData .= "<button class='Button' type='submit' name='save'";
            $lFileData .= "value='Créer' onclick='createDatabaseNews(this);'>";
            $lFileData .= "<i class='fa fa-cog'></i> Créer";
            $lFileData .= "</button>";
            $lFileData .= "</div>";
            $lFileData .= "<i class='Img7 fa fa-".$lData["icon"]."'></i>";

            return $lFileData;
        }
        //===============================================
        public function previewFile($dataMap, $fileName) {
            $lDataMap = $dataMap["news"];
            $lData = array();
            
            $fileName = mb_strtolower($fileName, "UTF-8");

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lFullName = mb_strtolower($lFullName, "UTF-8");

                if($lFullName == $fileName) break;
            }

            ob_start();?>
            <a href="#" style="
            background-color: #2d1c35;
            border: 1px solid gray;
            display: inline-block;
            text-align: left;
            overflow:hidden;
            padding: 10px;
            min-width: 350px;
            font-size: 16px;
            ">

            <div style="
            float: left;
            padding-right: 10px;
            "><i class="fa fa-<?php echo $lData["icon"]; ?>" style="
            background-color: rgba(255,255,255,0.2);
            width: 60px;
            height: 60px;
            line-height: 60px;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            "></i></div>

            <div style="
            color: cyan;
            font-weight: bold;
            font-size: 18px;
            "><?php echo $lData["title"]; ?></div>

            <div style="
            color: gray;
            "><?php echo $lData["date"]; ?> à <?php echo $lData["time"]; ?></div>
            <div style="
            color: gray;
            "><?php echo $lData["place"]; ?></div>
            </a>
            <?php
            $lFileData = ob_get_contents();
            ob_end_clean();
    
            return $lFileData;
        }
        //===============================================
        public function visualizeFile($dataMap, $fileName) {
            $lDataMap = $dataMap["news"];
            $lData = array();
            
            $fileName = mb_strtolower($fileName, "UTF-8");

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lFullName = mb_strtolower($lFullName, "UTF-8");

                if($lFullName == $fileName) break;
            }

            ob_start();?>
            <div style="
            background-color: #2d1c35;
            border: 1px solid gray;
            max-width: 600px;
            margin: auto;
            text-align: left;
            padding: 10px;
            overflow: hidden;
            font-size: 16px;
            ">

            <div style="
            float: left;
            padding-right: 10px;
            "><i class="fa fa-<?php echo $lData["icon"]; ?>" style="
            background-color: rgba(255,255,255,0.2);
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            text-align: center;
            font-size: 40px;
            "></i></div>

            <div style="
            color: cyan;
            font-weight: bold;
            font-size: 20px;
            "><?php echo $lData["title"]; ?></div>

            <div style="
            color: gray;
            "><?php echo $lData["date"]; ?> à <?php echo $lData["time"]; ?></div>

            <div style="
            color: gray;
            "><?php echo $lData["place"]; ?></div>

            <div style="
            color: gray;
            margin: 0px 0px 10px 0px;
            "><?php echo $lData["address"]; ?></div>

            <div><?php echo $lData["message"]; ?></div>

            </div>
            <?php
            $lFileData = ob_get_contents();
            ob_end_clean();
    
            return $lFileData;
        }
        //===============================================
        public function deleteFile($filePath, $fileName) {
            $lDatabaseMap = GJson::Instance()->getData($filePath);
            $lDataMap = $lDatabaseMap["news"];
            
            $fileName = mb_strtolower($fileName, "UTF-8");
                        
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lFullName = mb_strtolower($lFullName, "UTF-8");
                
                if($lFullName == $fileName) {
                    array_splice($lDatabaseMap["news"], $i, 1);
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
            $lDataMap = $lDatabaseMap["news"];

            $fileName = mb_strtolower($fileName, "UTF-8");
                        
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lFullName = mb_strtolower($lFullName, "UTF-8");

                if($lFullName == $fileName) {
                    $lDataNew = array_merge($lData, $lDataNew);
                    $lDatabaseMap["news"][$i] = $lDataNew;
                    break;
                }
            }

            $lFullPath = "";
            $lFullPath .= $lDataNew["category"]." | ";
            $lFullPath .= $lDataNew["title"]." | ";
            $lFullPath .= $lDataNew["date"]." à ";
            $lFullPath .= $lDataNew["time"]." | ";
            $lFullPath .= $lDataNew["place"];
            $lFullPath = str_replace("/", "-", $lFullPath);
            $lFullPath = "/News/".$lFullPath;

            GJson::Instance()->saveData($filePath, $lDatabaseMap);
            return $lFullPath;
        }
        //===============================================
        public function createDatabase($filePath, $data) {
            $lDatabaseMap = GJson::Instance()->getData($filePath);
            $lDataNew = json_decode($data, true);
            $lDataMap = $lDatabaseMap["news"];
            
            $lMessage = "La donnée a été ajoutée avec succès.";
            $lAdd = true;
            
            if($lDataNew["author"] == "") {
                $lMessage = "Le champ (Auteur) est obligatoire.";
                $lAdd = false;
            }
            else if($lDataNew["category"] == "") {
                $lMessage = "Le champ (Catégorie) est obligatoire.";
                $lAdd = false;
            }
            else if($lDataNew["title"] == "") {
                $lMessage = "Le champ (Titre) est obligatoire.";
                $lAdd = false;
            }
            else if($lDataNew["date"] == "") {
                $lMessage = "Le champ (Date) est obligatoire.";
                $lAdd = false;
            }
            else if($lDataNew["time"] == "") {
                $lMessage = "Le champ (Heure) est obligatoire.";
                $lAdd = false;
            }
            else if($lDataNew["place"] == "") {
                $lMessage = "Le champ (Lieu) est obligatoire.";
                $lAdd = false;
            }
            else {
                $lFileName = "";
                $lFileName .= $lDataNew["category"]." | ";
                $lFileName .= $lDataNew["title"]." | ";
                $lFileName .= $lDataNew["date"]." à ";
                $lFileName .= $lDataNew["time"]." | ";
                $lFileName .= $lDataNew["place"];
                $lFileName = str_replace("/", "-", $lFileName);
                $lFileName = mb_strtolower($lFileName, "UTF-8");
                
                for($i = 0; $i < count($lDataMap); $i++) {
                    $lData = $lDataMap[$i];
                    $lFullName = "";
                    $lFullName .= $lData["category"]." | ";
                    $lFullName .= $lData["title"]." | ";
                    $lFullName .= $lData["date"]." à ";
                    $lFullName .= $lData["time"]." | ";
                    $lFullName .= $lData["place"];
                    $lFullName = str_replace("/", "-", $lFullName);
                    $lFullName = mb_strtolower($lFullName, "UTF-8");
                    
                    if($lFullName == $lFileName) {
                        $lMessage = "";
                        $lMessage .= "Impossible d'ajouter la nouvelle donnée.\n";
                        $lMessage .= "Les champs (Titre) et (Date) existent déjà.";
                        $lAdd = false;
                        break;
                    }
                }
            }
            
            if($lAdd) {
                $lDatabaseMap["news"][] = $lDataNew;
                GJson::Instance()->saveData($filePath, $lDatabaseMap);
            }
            return $lMessage;            
        }
        //===============================================
    }
?>        