<?php
    require $_SERVER["DOCUMENT_ROOT"]."/php/class/GAutoloadRegister.php";	
	//===============================================
	$lReq = $_REQUEST["req"];
	//===============================================
	if($lReq == "LIST_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lFilename = "data/json/".$lFile.".json";
		$lData = GJson::Instance()->getData($lFilename);
        $lDataMap = $lData[$lKey];
        $lDataSum = '';
        foreach($lDataMap as $lItem) {
			$lDataSum .= '<div class="Item4">';
			$lDataSum .= '<span class="Icon10 fa fa-book"></span>';
			$lDataSum .= '<a class="Link4" href="'.$lItem["link"].'">';
			$lDataSum .= $lItem["name"];
			$lDataSum .= '</a>';
			$lDataSum .= '</div>';
        }
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "LIST_2") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lFilename = "data/json/".$lFile.".json";
		$lData = GJson::Instance()->getData($lFilename);
        $lDataMap = $lData[$lKey];
        $lDataSum = '';
        foreach($lDataMap as $lItem) {
            $lDataSum .= '<div class="RWD2 RwdC06">';
            $lDataSum .= '<a class="Link6" href="'.$lItem["link"].'">';
            $lDataSum .= '<div class="Content5">';
            $lDataSum .= '<div class="Row6">';
            $lDataSum .= '<div class="Content6">';
            $lDataSum .= '<i class="Icon6 fa '.$lItem["icon"].'"></i>';
            $lDataSum .= '</div>';
            $lDataSum .= '</div>';
            $lDataSum .= '<div class="Row7">';
            $lDataSum .= '<div class="Content6">';
            $lDataSum .= '<div class="Text7">'.$lItem["theme"].'</div>';
            $lDataSum .= '</div>';
            $lDataSum .= '</div>';
            $lDataSum .= '</div>';
            $lDataSum .= '<div class="Text8">'.$lItem["description"].'</div>';
            $lDataSum .= '</a>';
            $lDataSum .= '</div>';
        }
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "MEMBER_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lGroup = $_REQUEST["group"];
		$lFilename = "data/json/".$lFile.".json";
		$lData = GJson::Instance()->getData($lFilename);
        $lDataMap = $lData[$lKey];
        $lDataSum = '';
        foreach($lDataMap as $lItem) {
            if($lItem["active"] == "Non") continue; 
            if($lItem["group"] != $lGroup) continue; 
            
            $lAvatar = "male_avatar.png";
            if($lItem["gender"] == "Féminin") {
                $lAvatar = "female_avatar.png";
            }
            
            $lLastname = strtolower(GString::Instance()->noAccent($lItem["lastname"]));
            $lUsualname = strtolower(GString::Instance()->noAccent($lItem["usualname"]));
            $lAvatarFile = $lLastname.'_'.$lUsualname.'.png';
            $lAvatarRoot = "/Chorale/Membres/img/";
            $lAvatarPath = $lAvatarRoot.$lAvatarFile;
            
            if(GFile::Instance()->exists($lAvatarPath) == false) {
                $lAvatarPath = $lAvatarRoot.$lAvatar;
            }

            $lDataSum .= '<div class="Block">';
            $lDataSum .= '<img class="Img5" src="'.$lAvatarPath.'" alt="Avatar.png" width="80" height="80">';
            $lDataSum .= '<div class="Text11">';
            $lDataSum .= mb_strtoupper($lItem["lastname"], "UTF-8").' ';
            $lDataSum .= $lItem["usualname"].'<br>';
            $lDataSum .= '<span style="color:lime;">'.$lItem["function"].'</span>';
            $lDataSum .= '</div>';
            $lDataSum .= '</div>';
        }
		print_r($lDataSum);
	}
	//===============================================
	else if($lReq == "DATA_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
		$lFilename = "data/json/".$lFile.".json";
		$lData = GJson::Instance()->getData($lFilename);
        $lDataMap = array();
		$lDataMap["data"] = join(" ", $lData[$lKey]);
		print_r(json_encode($lDataMap));
	}
	//===============================================
	else if($lReq == "DATABASE_1") {
		$lFile = $_REQUEST["file"];
		$lKey = $_REQUEST["key"];
        
        $lData = GDatabase::Instance()->loadDatabase($lFile, $lKey);
        
        $lDataMap = array();
		$lDataMap["data"] = $lData;
		print_r(json_encode($lDataMap));
	}
	//===============================================
	else if($lReq == "FICHE_1") {
		$lFile = $_SESSION["file"]; 
        
        $lData = GDatabase::Instance()->visualizeFile($lFile);
        
        $lDataMap = array();
		$lDataMap["data"] = $lData;
		print_r(json_encode($lDataMap));
	}
	//===============================================
?>
