<?php   
    class GDatabaseV2 {
        //===============================================
        private static $m_instance = null;
        private $m_file;
        private $m_dataMap;
        //===============================================
        private function __construct() {
            $this->m_file = "data/sqlite/database.dat";
            $this->m_dataMap = array();
        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GDatabaseV2();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function checkFile() {
            $lExist = GFile::Instance()->exist($this->m_file);
            if($lExist == true) {
                $this->removeDatabase();
            }
        }
        //===============================================
        public function checkDatabase() {
            $lExist = GFile::Instance()->exist($this->m_file);
            if($lExist == false) {
                $this->saveDatabase();
            }
            $this->loadDatabase();
            $lExist = array_key_exists("database", $this->m_dataMap);
            if($lExist == false) {
                $this->m_dataMap["database"] = array();
            }
        }
        //===============================================
        public function checkTable() {
            $this->loadDatabase();
            $lKey = $this->checkTableIn();
            if($lKey == false) {
                $lTable = array();
                $lTable["index"] = 
                $this->m_dataMap["database"] = array();
            }
            $this->saveDatabase();        
        }
        //===============================================
        public function checkTableIn() {
            $this->loadDatabase();
            $lName = $_REQUEST["name"];
            $lKey = array_search($lName, $this->m_dataMap["database"]);
            return $lKey;
        }
        //===============================================
        public function checkTableV2() {
            $this->m_dataMap = GJson::Instance()->getData($this->m_file);        
            
            $lExist = array_key_exists("database", $this->m_dataMap);
            
            if($lExist == false) {
                $this->m_dataMap["database"] = array();
            }
            $this->m_dataMap["index"] += 1;
            $this->saveDatabase();        
        }
        //===============================================
        public function createDatabase() {
            $lName = $_REQUEST["name"];
                

        }
        //===============================================
        public function removeDatabase() {
            GFile::Instance()->remove($this->m_file);
        }
        //===============================================
        public function loadDatabase() {
            $this->m_dataMap = GJson::Instance()->getData($this->m_file);        
        }
        //===============================================
        public function saveDatabase() {
            GJson::Instance()->saveData($this->m_file, $this->m_dataMap);        
        }
        //===============================================
        public function printDatabase() {
            $lDataJson = json_encode($this->m_dataMap);
            print_r($lDataJson);
        }
        //===============================================
    }
?>        