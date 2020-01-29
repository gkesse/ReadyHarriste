<?php   
    class GSQLite {
        //===============================================
        private static $m_instance = null;
        private $m_file;
        private $m_pdo;
        private $m_stmt;
        private $m_result;
        //===============================================
        private function __construct() {
            $this->m_file = "data/sqlite/database.dat";
            $this->m_file = GFile::Instance()->getPath($this->m_file);
            $this->m_pdo = null;
            $this->m_stmt = null;
            $this->m_result = null;
        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GSQLite();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function openDatabase() {
            try{
                $this->m_pdo = new PDO("sqlite:".$this->m_file);
                $this->m_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->m_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
            } catch(Exception $e) {
                die("[GSQLite] Erreur openDatabase : ".$e->getMessage());
            }
        }
        //===============================================
        public function query($sql) {
            $this->m_pdo->query($sql);
        }
        //===============================================
        public function prepare($sql) {
            $this->m_stmt = $this->m_pdo->prepare($sql);
        }
        //===============================================
        public function bindValue($key, $value) {
            $this->m_stmt->bindValue($key, $value);
        }
        //===============================================
        public function execute($sql) {
            $this->m_stmt->execute($sql);
        }
        //===============================================
        public function fetchAll() {
            $this->m_result = $this->m_stmt->fetchAll();
        }
        //===============================================
    }
?>        