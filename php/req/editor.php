<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";	
	//===============================================
	$lReq = $_REQUEST["req"];
	//===============================================
	if($lReq == "SAVE_FILE") {
		$lFile = $_REQUEST["file"];
		$lData = $_REQUEST["data"];
		GFile::Instance()->saveData($lFile, $lData);
		print_r($lData);
	}
	//===============================================
	else if($lReq == "READ_FILE") {
		$lFile = $_REQUEST["file"];
		$lData = GFile::Instance()->getData($lFile);
		print_r($lData);
	}
	//===============================================
	else if($lReq == "GET_FILE") {
		$lDir = $_REQUEST["dir"];
		$lFile = $_REQUEST["file"];
		$lDirNameArr = GFilesystem::Instance()->getFile($lDir);
		if(empty($lDirNameArr)) return;
		$lDirPath = GFilesystem::Instance()->getPath($lDir);
        
		$lDataFile = "";
		$lDataFile .= "<div class='Body12'>";
		for($i = 0; $i < count($lDirNameArr); $i++) {
			$lDirName = $lDirNameArr[$i];
			$lFilePath = $lDirPath."/".$lDirName[1];
			if($lFilePath == $lFile) {$lDataFile .= "<div class='Row20 FileList Active'>";}
			else {$lDataFile .= "<div class='Row20 FileList'>";}
			$lDataFile .= "<i class='fa fa-".$lDirName[2]."'></i> ";
			$lDataFile .= "<div class='Text9'";
			$lDataFile .= "onclick='openFile(this, ".$lDirName[0].");'>";
			$lDataFile .= $lDirName[1];
			$lDataFile .= "</div>";
			$lDataFile .= "</div>";
		}
		$lDataFile .= "</div>";
		
		$lDataMenu = '';
		$lDataMenu .= '<div class="Col3 FileLink" onclick="openLink(this);">';
		$lDataMenu .= '<i class="Icon2 fa fa-folder"></i></div> ';
		if($lDirPath != "") {
			$lDirPathArr = explode("/", $lDirPath);
			for($i = 0; $i < count($lDirPathArr); $i++) {
				$lDirPathItem = $lDirPathArr[$i];
				if($lDirPathItem == "") continue;
				$lDataMenu .= '<div class="Col2"><i class="Icon2 fa fa-chevron-right"></i></div> ';
				$lDataMenu .= '<div class="Col3 FileLink" onclick="openLink(this);">';
				$lDataMenu .= $lDirPathItem.'</div> ';
			}
		}
        
		$lDataMap = array();
		$lDataMap["menu"] = $lDataMenu;
		$lDataMap["file"] = $lDataFile;
		$lDataMap["dir"] = $lDirPath;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
	}
	//===============================================
	else if($lReq == "LIST_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lID = $_REQUEST["id"];
		$lDataSum = '';
		$lDataSum .= '<div class="Content0 GList1">';
		$lDataSum .= '<div class="Body0" id="'.$lID.'">';
		$lDataSum .= '<div class="Row26">';
		$lDataSum .= 'List 1 > '.$lFile.' > '.$lKey;
		$lDataSum .= '</div>';
		$lDataSum .= '</div>';
		$lDataSum .= '<script>';
		$lDataSum .= 'loadList1("'.$lID.'","'.$lFile.'","'.$lKey.'");';
		$lDataSum .= '</script>';
		$lDataSum .= '</div>';
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "LIST_2") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lID = $_REQUEST["id"];
		$lDataSum = '';
		$lDataSum .= '<div class="Content0 Center GList2">';
		$lDataSum .= '<div class="Body0" id="'.$lID.'">';
		$lDataSum .= '<div class="Row26">';
		$lDataSum .= 'List 2 > '.$lFile.' > '.$lKey;
		$lDataSum .= '</div>';
		$lDataSum .= '</div>';
		$lDataSum .= '<script>';
		$lDataSum .= 'loadList2("'.$lID.'","'.$lFile.'","'.$lKey.'");';
		$lDataSum .= '</script>';
		$lDataSum .= '</div>';
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "MEMBER_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lGroup = $_REQUEST["group"];
		$lID = $_REQUEST["id"];
		$lDataSum = '';
		$lDataSum .= '<div class="Content0 Center GMember1">';
		$lDataSum .= '<div class="Body0" id="'.$lID.'">';
		$lDataSum .= '<div class="Row26">';
		$lDataSum .= 'Member 1 > '.$lFile.' > '.$lKey.' > '.$lGroup;
		$lDataSum .= '</div>';
		$lDataSum .= '</div>';
		$lDataSum .= '<script>';
		$lDataSum .= 'loadMember1("'.$lID.'","'.$lFile.'","'.$lKey.'","'.$lGroup.'");';
		$lDataSum .= '</script>';
		$lDataSum .= '</div>';
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "DATA_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lID = $_REQUEST["id"];
		$lDataSum = '';
		$lDataSum .= '<div class="Content0 GData1">';
		$lDataSum .= '<div class="Body0" id="'.$lID.'">';
		$lDataSum .= '<div class="Row26">';
		$lDataSum .= 'Data 1 > '.$lFile.' > '.$lKey;
		$lDataSum .= '</div>';
		$lDataSum .= '</div>';
		$lDataSum .= '<script>';
		$lDataSum .= 'loadData1("'.$lID.'","'.$lFile.'","'.$lKey.'");';
		$lDataSum .= '</script>';
		$lDataSum .= '</div>';
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "DATABASE_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lID = $_REQUEST["id"];
		$lDataSum = '';
		$lDataSum .= '<div class="Content0 GDatabase1">';
		$lDataSum .= '<div class="Body0" id="'.$lID.'">';
		$lDataSum .= '<div class="Row26">';
		$lDataSum .= 'Database 1 > '.$lFile.' > '.$lKey;
		$lDataSum .= '</div>';
		$lDataSum .= '</div>';
		$lDataSum .= '<script>';
		$lDataSum .= 'loadDatabase1("'.$lID.'","'.$lFile.'","'.$lKey.'");';
		$lDataSum .= '</script>';
		$lDataSum .= '</div>';
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "FICHE_1") {
		$lDB = $_REQUEST["db"];
		$lID = $_REQUEST["id"];
        
		$lDataSum = '';
		$lDataSum .= '<div class="Content0 GDatabase1">';
		$lDataSum .= '<div class="Body0" id="'.$lID.'">';
		$lDataSum .= '<div class="Row26">';
		$lDataSum .= 'Fiche 1 > '.$lDB;
		$lDataSum .= '</div>';
		$lDataSum .= '</div>';
		$lDataSum .= '<script>';
		$lDataSum .= 'loadFiche1("'.$lID.'","'.$lDB.'");';
		$lDataSum .= '</script>';
		$lDataSum .= '</div>';
        
		$lDataMap = array();
		$lDataMap["data"] = $lDataSum;
		$lDataJson = json_encode($lDataMap);
		print_r($lDataJson);
	}
	//===============================================
?>
