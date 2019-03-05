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
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
			$lDirNameMap = array();
            $this->getDatabaseName($file);
            
            if($this->m_databaseName == "") {
                $lIcon = "database";
                
                for($i = 0; $i < count($lJsonData); $i++) {
                    $lData = $lJsonData[$i];
                    $lName = $lData["name"];
                    $lDirNameMap[] = array($lName, $lIcon, "DIR");
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
                GConfig::Instance()->setData("DATABASE", $lDatabaseName);
                $lDirNameMap = GDatabaseView::Instance()->openDatabase($lDatabaseMap);
            }
            
			return $lDirNameMap;
        }
        //===============================================
        public function getDataMenu($path) {
            $lDataMenu = '';
            $lDataMenu .= '<div class="Col3 DatabaseFileLink" onclick="openDatabaseLink(this);">';
            $lDataMenu .= '<i class="Icon2 fa fa-folder"></i></div> ';
            if($path != "") {
                $lDirPathMap = explode("/", $path);
                for($i = 0; $i < count($lDirPathMap); $i++) {
                    $lDirPath = $lDirPathMap[$i];
                    if($lDirPath == "") continue;
                    $lDataMenu .= '<div class="Col2"><i class="Icon2 fa fa-chevron-right"></i></div> ';
                    $lDataMenu .= '<div class="Col3 DatabaseFileLink" onclick="openDatabaseLink(this);">';
                    $lDataMenu .= $lDirPath.'</div> ';
                }
            }
            return $lDataMenu;
        }
        //===============================================
        public function getDataFile($dirNameMap, $path, $file) {
            $lDataFile = "";
            $lDataFile .= "<div class='Body12'>";
            for($i = 0; $i < count($dirNameMap); $i++) {
                $lDirName = $dirNameMap[$i];
                $lFilePath = $path."/".$lDirName[0];
                if($lFilePath == $file) {$lDataFile .= "<div class='Row20 DatabaseFileList Active'>";}
                else {$lDataFile .= "<div class='Row20 DatabaseFileList'>";}
                $lDataFile .= "<i class='fa fa-".$lDirName[1]."'></i> ";
                $lDataFile .= "<div class='Text9'";
                $lDataFile .= "onclick='openDatabaseFile(this, \"".$lDirName[2]."\");'>";
                $lDataFile .= $lDirName[0];
                $lDataFile .= "</div>";
                $lDataFile .= "</div>";
            }
            $lDataFile .= "</div>";
            return $lDataFile;
        }
        //===============================================
        public function readFile($file) {
            if($file == "") return "";
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
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
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            $lFileData = GDatabaseView::Instance()->readFile($lDatabaseMap, $this->m_fileName);
			return $lFileData;
        }
        //===============================================
        public function updateFile($file) {
            if($file == "") return "";
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
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
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            $lFileData = GDatabaseView::Instance()->updateFile($lDatabaseMap, $this->m_fileName);
			return $lFileData;
        }
        //===============================================
        public function createFile($path, $file) {
            if($path == "") return "";
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
            $this->getDatabaseName($path);
            
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
              
            $this->getDatabaseName($file);
            
            $lDatabaseMap = GJson::Instance()->getData($lDatabaseFile);
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            $lFileData = GDatabaseView::Instance()->createFile($lDatabaseMap, $this->m_fileName);
			return $lFileData;
        }
        //===============================================
        public function previewFile($file) {
            if($file == "") return "";
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
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
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            $lFileData = GDatabaseView::Instance()->previewFile($lDatabaseMap, $this->m_fileName);
			return $lFileData;
        }
        //===============================================
        public function visualizeFile($file) {
            if($file == "") return "";
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
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
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            $lFileData = GDatabaseView::Instance()->visualizeFile($lDatabaseMap, $this->m_fileName);
			return $lFileData;
        }
        //===============================================
        public function deleteFile($file) {
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
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
                
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            return GDatabaseView::Instance()->deleteFile($lDatabaseFile, $this->m_fileName);
        }
        //===============================================
        public function updateDatabase($file, $data) {
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
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
                
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            return GDatabaseView::Instance()->updateDatabase($lDatabaseFile, $this->m_fileName, $data);
        }
        //===============================================
        public function createDatabase($file, $data) {
            $lJsonMap = GJson::Instance()->getData("data/json/Admin.json");
            $lJsonData = $lJsonMap["database"];
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
                
            GConfig::Instance()->setData("DATABASE", $lDatabaseName);
            return GDatabaseView::Instance()->createDatabase($lDatabaseFile, $data);
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
        public function loadDatabase($file, $key) {
            $lFilename = "data/json/".$file.".json";
            $lDatabaseMap = GJson::Instance()->getData($lFilename);
            $lDataMap = $lDatabaseMap[$key];
            
            $lFileData = "";
            for($i = 0; $i < count($lDataMap); $i++) {
                $lData = $lDataMap[$i];
                $lFullName = "";
                $lFullName .= $lData["category"]." | ";
                $lFullName .= $lData["title"]." | ";
                $lFullName .= $lData["date"]." à ";
                $lFullName .= $lData["time"]." | ";
                $lFullName .= $lData["place"];
                $lFullName = str_replace("/", "-", $lFullName);
                ob_start();?>
                <a href="File/<?php echo $lFullName; ?>" style="
                background-color: #2d1c35;
                border: 1px solid gray;
                display: inline-block;
                text-align: left;
                overflow:hidden;
                padding: 10px;
                min-width: 350px;
                font-size: 18px;
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
                </a>
                <?php
                $lFileData = ob_get_contents();
                ob_end_clean();
            }
                
            return $lFileData;
        }
       //===============================================
    }
?>        