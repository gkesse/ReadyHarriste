<?php   
    class GFile {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {
        
        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GFile();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function exist($file) {
            $lFile = $this->getPath($file);
            $lExist = file_exists($lFile);
            return $lExist;
        }
        //===============================================
        public function remove($file) {
            $lFile = $this->getPath($file);
            unlink($lFile);
        }
        //===============================================
        public function getPath($file) {
            $lFile = $_SERVER["DOCUMENT_ROOT"];
			$lFile = realpath($lFile);
			$lFile .= "/".$file;
			$lFile = realpath($lFile);
            return $lFile;
        }
        //===============================================
        public function getData($file) {
            $lFile = $this->getPath($file);
            $lData = file_get_contents($lFile);
            return $lData;
        }
        //===============================================
        public function getData2($file) {
            $lData = file_get_contents($file);
            return $lData;
        }
        //===============================================
        public function getData3($root, $file) {
            $lFile = $_SERVER["DOCUMENT_ROOT"];
			$lFile = realpath($lFile);
			$lFile .= "/".$root;
			$lFile = realpath($lFile);
			$lFile .= "/".$file;
			$lFile = realpath($lFile);
            $lData = file_get_contents($lFile);
            return $lData;
        }
        //===============================================
        public function saveData($file, $data) {
            $lFile = $this->getPath($file);
            file_put_contents($lFile, $data);
        }
        //===============================================
        public function getInclude($file, $data) {
            ob_start();                    
            include($file);  
            $lContent = ob_get_contents();
            ob_end_clean();
            return $lContent;
        }
        //===============================================
        public function getDateTime($file) {
            $lFile = $_SERVER["DOCUMENT_ROOT"];
			$lFile = realpath($lFile);
            $lFile .= "/".$file;
			$lFile = realpath($lFile);
            $lFile .= "/"."index.php";
            $lDate = filemtime($lFile);
            $lDate = date ("Y-m-d", $lDate);
            return $lDate;
        }
        //===============================================
    }
?>