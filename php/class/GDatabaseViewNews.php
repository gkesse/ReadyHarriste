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
            
            $fileName = mb_strtolower($fileName);

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = mb_strtolower($lFullName);

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
            $lFileData .= "<div class='Field9'><textarea class='message' rows='11' cols='100' readonly>".$lData["message"]."</textarea></div>";
            $lFileData .= "</div>";
            $lFileData .= "<i class='Img7 fa fa-".$lData["icon"]."'></i>";
            
            return $lFileData;
        }
        //===============================================
        public function updateFile($dataMap, $fileName) {
            $lDataMap = $dataMap["news"];
            $lData = array();
            
            $fileName = mb_strtolower($fileName);

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = mb_strtolower($lFullName);

                if($lFullName == $fileName) break;
            }
            
            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='authorNews'>Auteur:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='authorNews' id='authorNews' value=\"".$lData["author"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='categoryNews'>Catégorie:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='categoryNews' id='categoryNews' value=\"".$lData["category"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='titleNews'>Titre:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='titleNews' id='titleNews' value=\"".$lData["title"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='dateNews'>Date:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='dateNews' id='dateNews' value=\"".$lData["date"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='timeNews'>Heure:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='timeNews' id='timeNews' value=\"".$lData["time"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='placeNews'>Lieu:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='placeNews' id='placeNews' value=\"".$lData["place"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='addressNews'>Adresse:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='addressNews' id='addressNews' value=\"".$lData["address"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='iconNews'>Icône:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='iconNews' id='iconNews' value=\"".$lData["icon"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='messageNews'>Message:</label>";
            $lFileData .= "<div class='Field9'><textarea rows='11' cols='100' name='messageNews' id='messageNews' oninput='messageChangeNews();'>".$lData["message"]."</textarea></div>";
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
            "place" => "Masculin",
            "address" => "",
            "icon" => "users"
            );
            
            if($fileName != "") {
                $fileName = mb_strtolower($fileName);

                for($i = 0; $i < count($lDataMap); $i++) {
                    $lData = $lDataMap[$i];
                    $lFullName = "";
                    $lFullName .= $lData["category"]." | ";
                    $lFullName .= $lData["title"]." | ";
                    $lFullName .= $lData["date"]." à ";
                    $lFullName .= $lData["time"]." | ";
                    $lFullName .= $lData["place"];
                    $lFullName = mb_strtolower($lFullName);

                    if($lFullName == $fileName) break;
                }
            }

            $lFileData = "";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='author'>Auteur:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='author' id='author' value=\"".$lData["author"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='category'>Catégorie:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='category' id='category' value=\"".$lData["category"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='title'>Titre:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='title' id='title' value=\"".$lData["title"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='date'>Date:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='date' id='date' value=\"".$lData["date"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='time'>Heure:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='time' id='time' value=\"".$lData["time"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='place'>Lieu:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='place' id='place' value=\"".$lData["place"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='address'>Adresse:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='address' id='address' value=\"".$lData["address"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='icon'>Icône:</label>";
            $lFileData .= "<div class='Field8'><input type='text' name='icon' id='icon' value=\"".$lData["icon"]."\"/></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row9'>"; 
            $lFileData .= "<label class='Label4' for='messageNews'>Message:</label>";
            $lFileData .= "<div class='Field9'><textarea rows='11' cols='100' name='messageNews' id='messageNews' oninput='messageChangeNews();'>".$lData["message"]."</textarea></div>";
            $lFileData .= "</div>";
            $lFileData .= "<div class='Row32'>";
            $lFileData .= "<button class='Button' type='submit' name='save'";
            $lFileData .= "value='Créer' onclick='createDatabase(this);'>";
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
            
            $fileName = mb_strtolower($fileName);

            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = mb_strtolower($lFullName);

                if($lFullName == $fileName) break;
            }

            ob_start();?>
            <a href="#" style="
            background-color: #051039;
            border: 1px solid gray;
            display: inline-block;
            text-align: left;
            overflow:hidden;
            padding: 10px;
            min-width: 300px;
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
            color: #555555;
            "><?php echo $lData["date"]; ?> à <?php echo $lData["time"]; ?></div>
            <div><?php echo $lData["place"]; ?></div>
            </a>
            <?php
            $lFileData = ob_get_contents();
            ob_end_clean();
    
            return $lFileData;
        }
        //===============================================
        public function deleteFile($filePath, $fileName) {
            return "";
        }
        //===============================================
        public function updateDatabase($filePath, $fileName, $data) {
            $lDatabaseMap = GJson::Instance()->getData($filePath);
            $lDataNew = json_decode($data, true);
            $lDataMap = $lDatabaseMap["news"];
            
            $fileName = mb_strtolower($fileName);
                        
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                $lFullName = mb_strtolower($lFullName);

                if($lFullName == $fileName) {
                    $lDatabaseMap["news"][$i] = $lDataNew;
                    break;
                }
            }

            $lFullPath = "";
            $lFullPath .= $lData["category"]." | ";
            $lFullPath .= $lData["title"]." | ";
            $lFullPath .= $lData["date"]." à ";
            $lFullPath .= $lData["time"]." | ";
            $lFullPath .= $lData["place"];
            
            $lFullPath = str_replace("/", "-", $lFullPath);
            $lFullPath = "/News/".$lFullPath;

            GJson::Instance()->saveData($filePath, $lDatabaseMap);
            return $lFullPath;
        }
        //===============================================
        public function createDatabase($filePath, $data) {
            return "";
        }
        //===============================================
    }
?>        