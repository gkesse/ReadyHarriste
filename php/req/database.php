<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";	
	//===============================================
	$lReq = $_REQUEST["req"];
	//===============================================
	if($lReq == "LIST_DATABASE") {
		$lPath = $_REQUEST["path"];        
		$lFile = $_REQUEST["file"];        
        
		$lDirNameMap = GDatabase::Instance()->openDatabase($lPath);
		$lDataMenu = GDatabase::Instance()->getDataMenu($lPath);
		$lDataFile = GDatabase::Instance()->getDataFile($lDirNameMap, $lPath, $lFile);

        $lDataMap = array();
        $lDataMap["file_map"] = $lDataFile;
        $lDataMap["file_menu"] = $lDataMenu;
        $lDataMap["file_path"] = $lFile;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
	}
	//===============================================
	else if($lReq == "READ_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->readFile($lFile);
        
        $lDataMap = array();
        $lDataMap["data"] = $lData;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "UPDATE_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->updateFile($lFile);
        
        $lDataMap = array();
        $lDataMap["data"] = $lData;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "CREATE_FILE") {
		$lPath = $_REQUEST["path"];
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->createFile($lPath, $lFile);
        
        $lDataMap = array();
        $lDataMap["data"] = $lData;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "PREVIEW_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->previewFile($lFile);
        
        $lDataMap = array();
        $lDataMap["data"] = $lData;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "VISUALIZE_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->visualizeFile($lFile);
        
        $lDataMap = array();
        $lDataMap["data"] = $lData;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "DELETE_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->deleteFile($lFile);
        
        $lDataMap = array();
        $lDataMap["data"] = $lData;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "UPDATE_DATABASE") {
		$lFile = $_REQUEST["file"];
		$lData = $_REQUEST["data"];
        
		$lMessage = GDatabase::Instance()->updateDatabase($lFile, $lData);
        
        $lDataMap = array();
        $lDataMap["data"] = $lMessage;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "CREATE_DATABASE") {
		$lFile = $_REQUEST["file"];
		$lData = $_REQUEST["data"];
        
		$lMessage = GDatabase::Instance()->createDatabase($lFile, $lData);
        
        $lDataMap = array();
        $lDataMap["data"] = $lMessage;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "CREATE_DATABASE_V2") {
        GSQLite::Instance()->openDatabase();
    }
	//===============================================
	else if($lReq == "COPY_MESSAGE") {
		$lData = $_REQUEST["data"];
        $lFile = "/News/page/message.php";
        
		GFile::Instance()->saveData($lFile, $lData);
        $lMessage = "Le message a été enregistré avec succès.";
        
        $lDataMap = array();
        $lDataMap["data"] = $lMessage;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "PASTE_MESSAGE") {
        $lFile = "/News/page/message.php";
		$lMessage = GFile::Instance()->getData($lFile);
        
        $lDataMap = array();
        $lDataMap["data"] = $lMessage;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
    }
	//===============================================
?>
