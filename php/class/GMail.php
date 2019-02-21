<?php   
    class GMail {
        //===============================================
        private static $m_instance = null;
        //===============================================
        private function __construct() {
            
        }
        //===============================================
        public static function Instance() {
            if(is_null(self::$m_instance)) {
                self::$m_instance = new GMail();  
            }
            return self::$m_instance;
        }
        //===============================================
        public function receiveMail($data) {
            date_default_timezone_set("Etc/UTC");
            require_once $_SERVER["DOCUMENT_ROOT"]."/lib/phpmailer/PHPMailerAutoload.php";
            
            $lFile = $_SERVER["DOCUMENT_ROOT"]."/data/email/contacts/email.php";
            $lContent = GFile::Instance()->getInclude($lFile, $data);
            
            $lMail = new PHPMailer;
            $lMail->isSMTP();
            $lMail->SMTPDebug = 0;
            $lMail->Debugoutput = "html";
            $lMail->Host = "smtp.gmail.com";
            $lMail->Port = 587;
            $lMail->SMTPSecure = "tls";
            $lMail->SMTPAuth = true;
            $lMail->CharSet = "UTF-8";
            $lMail->Username = "readydevz@gmail.com";
            $lMail->Password = "gma25@RDv";
            $lMail->setFrom("readydevz@gmail.com", "ReadyDev");
            $lMail->addReplyTo($data["emailValue"], $data["nameValue"]);
            $lMail->addAddress("readydevz@gmail.com", "ReadyDev");
            $lMail->Subject = $data["subjectValue"]." (".$data["nameValue"].")";
            $lMail->msgHTML($lContent);
            $lMail->AltBody = "This is a plain-text message body";
            $lMail->send();
        }
        //===============================================
        public function sendMail($data) {
            date_default_timezone_set("Etc/UTC");
            require_once $_SERVER["DOCUMENT_ROOT"]."/lib/phpmailer/PHPMailerAutoload.php";
            
            $lFile = $_SERVER["DOCUMENT_ROOT"]."/data/email/contacts/email.php";
            $lContent = GFile::Instance()->getInclude($lFile, $data);
            
            $lMail = new PHPMailer;
            $lMail->isSMTP();
            $lMail->SMTPDebug = 0;
            $lMail->Debugoutput = "html";
            $lMail->Host = "smtp.gmail.com";
            $lMail->Port = 587;
            $lMail->SMTPSecure = "tls";
            $lMail->SMTPAuth = true;
            $lMail->CharSet = "UTF-8";
            $lMail->Username = "readydevz@gmail.com";
            $lMail->Password = "gma25@RDv";
            $lMail->setFrom("readydevz@gmail.com", "ReadyDev");
            $lMail->addAddress($data["emailValue"], $data["nameValue"]);
            $lMail->addReplyTo("readydevz@gmail.com", "ReadyDev");
            $lMail->Subject = $data["subjectValue"]." (".$data["nameValue"].")";
            $lMail->msgHTML($lContent);
            $lMail->AltBody = "This is a plain-text message body";
            $lMail->send();
        }
        //===============================================
    }
?>