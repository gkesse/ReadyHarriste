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

        $lDataArr = array();
        $lDataArr["file_map"] = $lDataFile;
        $lDataArr["file_menu"] = $lDataMenu;
        $lDataArr["file_path"] = $lFile;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
	}
	//===============================================
	else if($lReq == "READ_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->readFile($lFile);
        
        $lDataArr = array();
        $lDataArr["data"] = $lData;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "UPDATE_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->updateFile($lFile);
        
        $lDataArr = array();
        $lDataArr["data"] = $lData;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "CREATE_FILE") {
		$lPath = $_REQUEST["path"];
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->createFile($lPath, $lFile);
        
        $lDataArr = array();
        $lDataArr["data"] = $lData;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "PREVIEW_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->previewFile($lFile);
        
        $lDataArr = array();
        $lDataArr["data"] = $lData;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "VISUALIZE_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->visualizeFile($lFile);
        
        $lDataArr = array();
        $lDataArr["data"] = $lData;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "DELETE_FILE") {
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->deleteFile($lFile);
        
        $lDataArr = array();
        $lDataArr["data"] = $lData;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "UPDATE_DATABASE") {
		$lFile = $_REQUEST["file"];
		$lData = $_REQUEST["data"];
        
		$lMessage = GDatabase::Instance()->updateDatabase($lFile, $lData);
        
        $lDataArr = array();
        $lDataArr["data"] = $lMessage;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "CREATE_DATABASE") {
		$lFile = $_REQUEST["file"];
		$lData = $_REQUEST["data"];
        
		$lMessage = GDatabase::Instance()->createDatabase($lFile, $lData);
        
        $lDataArr = array();
        $lDataArr["data"] = $lMessage;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
?>
