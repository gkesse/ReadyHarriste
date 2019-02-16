<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";	
	//===============================================
	$lReq = $_REQUEST["req"];
	//===============================================
	if($lReq == "LIST_DATABASE") {
		$lFile = $_REQUEST["file"];        
        
		$lDatabaseName = GDatabase::Instance()->getDatabase($lFile);
		$lDirNameArr = GDatabase::Instance()->listDatabase($lDatabaseName);
		$lDirPath = GDatabase::Instance()->getPath($lFile);

        $lDataFile = "";
		$lDataFile .= "<div class='Body12'>";
		for($i = 0; $i < count($lDirNameArr); $i++) {
            $lDirName = $lDirNameArr[$i];
			//$lDataFile .= "<div class='Row19 DatabaseFileList'>";
			$lDataFile .= "<div class='Row20 DatabaseFileList'>";
			$lDataFile .= "<i class='fa fa-".$lDirName[1]."'></i> ";
			$lDataFile .= "<div class='Text9'";
			$lDataFile .= "onclick='openDatabaseFile(this, \"DATABASE\");'>";
			$lDataFile .= $lDirName[0];
			$lDataFile .= "</div>";
			$lDataFile .= "</div>";
		}
		$lDataFile .= "</div>";

        $lDataMenu = '';
		$lDataMenu .= '<div class="Col3 DatabaseFileLink" onclick="openDatabaseLink(this);">';
		$lDataMenu .= '<i class="Icon2 fa fa-folder"></i></div> ';
		if($lDirPath != "") {
			$lDirPathArr = explode("/", $lDirPath);
			for($i = 0; $i < count($lDirPathArr); $i++) {
				$lDirPathItem = $lDirPathArr[$i];
				if($lDirPathItem == "") continue;
				$lDataMenu .= '<div class="Col2"><i class="Icon2 fa fa-chevron-right"></i></div> ';
				$lDataMenu .= '<div class="Col3 DatabaseFileLink" onclick="openDatabaseLink(this);">';
				$lDataMenu .= $lDirPathItem.'</div> ';
			}
		}

        $lDataArr = array();
        $lDataArr["file"] = $lDataFile;
        $lDataArr["menu"] = $lDataMenu;
        $lDataArr["count"] = $lDatabaseName;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
	}
	//===============================================
?>
