<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";	
	//===============================================
	$lReq = $_REQUEST["req"];
	//===============================================
	if($lReq == "LIST_DATABASE") {
		$lDirNameArr = GDatabase::Instance()->listDatabase();
        
        $lDataFile = "";
		$lDataFile .= "<div class='Body12'>";
		for($i = 0; $i < count($lDirNameArr); $i++) {
            $lDirName = $lDirNameArr[$i];
			//$lDataFile .= "<div class='Row19 FileList'>";
			$lDataFile .= "<div class='Row20 FileList'>";
			$lDataFile .= "<i class='fa fa-database'></i> ";
			$lDataFile .= "<div class='Text9'";
			$lDataFile .= "onclick='openDatabaseFile(this, \"DATABASE\");'>";
			$lDataFile .= $lDirName[0];
			$lDataFile .= "</div>";
			$lDataFile .= "</div>";
		}
		$lDataFile .= "</div>";

        $lDataMenu = '';
		$lDataMenu .= '<div class="Col3 FileLink" onclick="openDatabaseLink(this);">';
		$lDataMenu .= '<i class="Icon2 fa fa-folder"></i></div> ';
        //$lDirPathArr = explode("/", $lDirPath);
        for($i = 0; $i < 3; $i++) {
            //$lDirPathItem = $lDirPathArr[$i];
            //if($lDirPathItem == "") continue;
            $lDataMenu .= '<div class="Col2"><i class="Icon2 fa fa-chevron-right"></i></div> ';
            $lDataMenu .= '<div class="Col3 FileLink" onclick="openLink(this);">';
            $lDataMenu .= 'FILE'.'</div> ';
        }

        $lDataArr = array();
        $lDataArr["file"] = $lDataFile;
        $lDataArr["menu"] = $lDataMenu;
		$lDataJson = json_encode($lDataArr);
		print_r($lDataJson);
	}
	//===============================================
	else if($lReq == "OPEN_DATABASE") {
		$lDirNameArr = GDatabase::Instance()->listDatabase();
    }
	//===============================================
?>
