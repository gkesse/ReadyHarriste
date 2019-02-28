<?php   
    abstract class GDatabase {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {

        }
        //===============================================
        public static function Instance() {
            $lKey = "NORMAL";
            if($lKey == "NORMAL") return GDatabaseNormal::Instance();
            return GDatabaseNormal::Instance();
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
        abstract public function openDatabase($file);
        abstract public function readFile($file);
        abstract public function updateFile($file);
        abstract public function createFile($path, $file);
        abstract public function previewFile($file);
        abstract public function deleteFile($file);
        abstract public function updateDatabase($file, $data);
        abstract public function createDatabase($file, $data);
        //===============================================
    }
?>        