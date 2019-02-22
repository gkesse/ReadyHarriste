<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";	
	//===============================================
	$lReq = $_REQUEST["req"];
	//===============================================
	if($lReq == "LIST_DATABASE") {
		$lPath = $_REQUEST["path"];        
		$lFile = $_REQUEST["file"];        
        
		$lDirNameArr = GDatabase::Instance()->openDatabase($lPath);

        $lDataFile = "";
		$lDataFile .= "<div class='Body12'>";
		for($i = 0; $i < count($lDirNameArr); $i++) {
            $lDirName = $lDirNameArr[$i];
			$lFilePath = $lPath."/".$lDirName[0];
			if($lFilePath == $lFile) {$lDataFile .= "<div class='Row20 DatabaseFileList Active'>";}
			else {$lDataFile .= "<div class='Row20 DatabaseFileList'>";}
			$lDataFile .= "<i class='fa fa-".$lDirName[1]."'></i> ";
			$lDataFile .= "<div class='Text9'";
			$lDataFile .= "onclick='openDatabaseFile(this, \"".$lDirName[2]."\");'>";
			$lDataFile .= $lDirName[0];
			$lDataFile .= "</div>";
			$lDataFile .= "</div>";
		}
		$lDataFile .= "</div>";

        $lDataMenu = '';
		$lDataMenu .= '<div class="Col3 DatabaseFileLink" onclick="openDatabaseLink(this);">';
		$lDataMenu .= '<i class="Icon2 fa fa-folder"></i></div> ';
		if($lPath != "") {
			$lDirPathArr = explode("/", $lPath);
			for($i = 0; $i < count($lDirPathArr); $i++) {
				$lDirPathItem = $lDirPathArr[$i];
				if($lDirPathItem == "") continue;
				$lDataMenu .= '<div class="Col2"><i class="Icon2 fa fa-chevron-right"></i></div> ';
				$lDataMenu .= '<div class="Col3 DatabaseFileLink" onclick="openDatabaseLink(this);">';
				$lDataMenu .= $lDirPathItem.'</div> ';
			}
		}

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
		$lFile = $_REQUEST["file"];
        
		$lData = GDatabase::Instance()->createFile($lFile);
        
        $lDataArr = array();
        $lDataArr["data"] = $lData;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
    }
	//===============================================
	else if($lReq == "UPDATE_DATABASE") {
		$lFile = $_REQUEST["file"];
		$lData = $_REQUEST["data"];
        
		GDatabase::Instance()->updateDatabase($lFile, $lData);
        
        $lDataArr = array();
        $lDataArr["data"] = "Les modifications ont été enregistrées avec succès.";
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
