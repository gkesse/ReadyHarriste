//===============================================
var GDatabase = (function() {
    //===============================================
    var m_instance;
    //===============================================
    var Container = function() {
        return {
            //===============================================
            init: function() {
                var lTabCtn = document.getElementsByClassName("DatabaseTab");
				var lObj = lTabCtn[1];
				this.openDatabaseTab(lObj, "DatabaseTab1");
				var lDatabasePath = GConfig.Instance().getData("DatabasePath");
				this.listDatabase(lDatabasePath);
                this.readFile();
                this.updateFile();
                this.createFile();
                this.previewFile();
            },
            //===============================================
            openDatabaseTab: function(obj, name) {
				var lTab = document.getElementsByClassName("DatabaseTab");
				for(var i = 0; i < lTab.length; i++) {
					var lTabId = lTab[i];
					lTabId.className = lTabId.className.replace(" Active", "");
				}
				obj.className += " Active";
				var lTabCtn = document.getElementsByClassName("DatabaseTabCtn");
				for(var i = 0; i < lTabCtn.length; i++) {
					var lTabCtnId = lTabCtn[i];
					lTabCtnId.style.display = "none";
				}
				var lTabId = document.getElementById(name);
				lTabId.style.display = "block";
            },
            //===============================================
            listDatabase: function(path="") {
                var lFilePath = document.getElementById("DatabaseFilePath");
                var lFileMenu = document.getElementById("DatabaseFileMenu");
                var lFileMap = document.getElementById("DatabaseFileMap");
				var lFile = GConfig.Instance().getData("DatabaseFile");
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
						lFileMap.innerHTML = lDataMap["file_map"];
						lFileMenu.innerHTML = lDataMap["file_menu"];
						lFilePath.innerHTML = lDataMap["file_path"];
                        GConfig.Instance().setData("DatabasePath", path);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
                    "req=" + "LIST_DATABASE" +
                    "&path=" + path +
                    "&file=" + lFile
				);
            },
            //===============================================
            openDatabaseFile: function(obj, type) {
                var lFileList = document.getElementsByClassName("DatabaseFileList");
                var lFilePath = document.getElementById("DatabaseFilePath");
                var lFile = obj.innerText;
                var lDatabasePath = GConfig.Instance().getData("DatabasePath");
				var lDatabaseFile = lDatabasePath + "/" + lFile;
                if(type == "FILE") {
					var lRes = confirm("Êtes-vous sûr de vouloir sélectionner ce fichier ?");
					if(!lRes) return;
                    for(var i = 0; i < lFileList.length; i++) {
                        var lNode = lFileList[i];
                        lNode.className = lNode.className.replace(" Active", "");
                    }
                    var lObjParent = obj.parentNode;
					lObjParent.className += " Active";
					lDatabaseFile = lDatabaseFile.replace(/\\/gi, "/");
					GConfig.Instance().setData("DatabaseFile", lDatabaseFile);
                    lFilePath.innerHTML = lDatabaseFile;
                    this.readFile();
                    this.updateFile();
                    this.createFile();
                    var lTabCtn = document.getElementsByClassName("DatabaseTab");
                    var lObj = lTabCtn[2];
                    this.openDatabaseTab(lObj, "DatabaseTab2");
                    return;
                }
                this.listDatabase(lDatabaseFile);
            },
            //===============================================
            openDatabaseLink: function(obj) {
				var lFileLinkMap = document.getElementsByClassName("DatabaseFileLink");
				var lFilePath = "";
				for(var i = 0; i < lFileLinkMap.length; i++) {
					var lFileLink = lFileLinkMap[i];
					var lFileName = lFileLink.innerText;
                    if(lFileName != "") lFilePath += "/" + lFileName;
					if(lFileLink.isEqualNode(obj)) break;
				}
                this.listDatabase(lFilePath);
            },
            //===============================================
            updateDatabase: function(obj) {
                var lRes = confirm("Êtes vous sûr de vouloir enregistrer les modifications ?");
                if(!lRes) return;

				var lFile = GConfig.Instance().getData("DatabaseFile");
				if(lFile == "") {alert("Aucun fichier n'a été sélectionné !!!"); return;}
                
                var lDataMap = {};
				lDataMap["lastname"] = document.getElementsByName("lastname")[0].value;
				lDataMap["firstname"] = document.getElementsByName("firstname")[0].value;
				lDataMap["usualname"] = document.getElementsByName("usualname")[0].value;
				lDataMap["function"] = document.getElementsByName("function")[0].value;
				lDataMap["registration"] = document.getElementsByName("registration")[0].value;
				lDataMap["gender"] = document.getElementsByName("gender")[0].value;
				lDataMap["email"] = document.getElementsByName("email")[0].value;
				lDataMap["phone"] = document.getElementsByName("phone")[0].value;
				lDataMap["address1"] = document.getElementsByName("address1")[0].value;
				lDataMap["address2"] = document.getElementsByName("address2")[0].value;
				lDataMap["zip_code"] = document.getElementsByName("zip_code")[0].value;
				lDataMap["city"] = document.getElementsByName("city")[0].value;
				lDataMap["country"] = document.getElementsByName("country")[0].value;
				lDataMap["group"] = document.getElementsByName("group")[0].value;
				lDataMap["active"] = document.getElementsByName("active")[0].value;
                
                var lDataJson = JSON.stringify(lDataMap);
                                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        GConfig.Instance().setData("DatabaseFile", lDataMap["data"]);
                        GDatabase.Instance().init();
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "UPDATE_DATABASE" +
				"&file=" + lFile +
				"&data=" + lDataJson
				);
            },
            //===============================================
            updateDatabaseNews: function(obj) {
                var lRes = confirm("Êtes vous sûr de vouloir enregistrer les modifications ?");
                if(!lRes) return;

				var lFile = GConfig.Instance().getData("DatabaseFile");
				if(lFile == "") {alert("Aucun fichier n'a été sélectionné !!!"); return;}
                
                var lDataMap = {};
				lDataMap["author"] = document.getElementsByName("authorNews")[0].value;
				lDataMap["category"] = document.getElementsByName("categoryNews")[0].value;
				lDataMap["title"] = document.getElementsByName("titleNews")[0].value;
				lDataMap["date"] = document.getElementsByName("dateNews")[0].value;
				lDataMap["time"] = document.getElementsByName("timeNews")[0].value;
				lDataMap["place"] = document.getElementsByName("placeNews")[0].value;
				lDataMap["address"] = document.getElementsByName("addressNews")[0].value;
				lDataMap["icon"] = document.getElementsByName("iconNews")[0].value;
				lDataMap["message"] = document.getElementsByName("messageNews")[0].value;
                
                var lDataJson = JSON.stringify(lDataMap);

                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        GConfig.Instance().setData("DatabaseFile", lDataMap["data"]);
                        GDatabase.Instance().init();
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "UPDATE_DATABASE" +
				"&file=" + lFile +
				"&data=" + lDataJson
				);
            },
            //===============================================
            createDatabase: function(obj) {
                var lRes = confirm("Êtes vous sûr de vouloir ajouter cette nouvelle donnée ?");
                if(!lRes) return;

				var lPath = GConfig.Instance().getData("DatabasePath");
				if(lPath == "") {alert("Aucune base de données n'a été sélectionnée !!!"); return;}
                
                var lDataMap = {};
				lDataMap["lastname"] = document.getElementsByName("lastnameAdd")[0].value;
				lDataMap["firstname"] = document.getElementsByName("firstnameAdd")[0].value;
				lDataMap["usualname"] = document.getElementsByName("usualnameAdd")[0].value;
				lDataMap["function"] = document.getElementsByName("functionAdd")[0].value;
				lDataMap["registration"] = document.getElementsByName("registrationAdd")[0].value;
				lDataMap["gender"] = document.getElementsByName("genderAdd")[0].value;
				lDataMap["email"] = document.getElementsByName("emailAdd")[0].value;
				lDataMap["phone"] = document.getElementsByName("phoneAdd")[0].value;
				lDataMap["address1"] = document.getElementsByName("address1Add")[0].value;
				lDataMap["address2"] = document.getElementsByName("address2Add")[0].value;
				lDataMap["zip_code"] = document.getElementsByName("zip_codeAdd")[0].value;
				lDataMap["city"] = document.getElementsByName("cityAdd")[0].value;
				lDataMap["country"] = document.getElementsByName("countryAdd")[0].value;
				lDataMap["group"] = document.getElementsByName("groupAdd")[0].value;
				lDataMap["active"] = document.getElementsByName("activeAdd")[0].value;
                
                var lDataJson = JSON.stringify(lDataMap);
                                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        GDatabase.Instance().init();
                        alert(lDataMap["data"]);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "CREATE_DATABASE" +
				"&file=" + lPath +
				"&data=" + lDataJson
				);
            },
            //===============================================
            createDatabaseNews: function(obj) {
                var lRes = confirm("Êtes vous sûr de vouloir ajouter cette nouvelle donnée ?");
                if(!lRes) return;

				var lPath = GConfig.Instance().getData("DatabasePath");
				if(lPath == "") {alert("Aucune base de données n'a été sélectionnée !!!"); return;}
                
                var lDataMap = {};
				lDataMap["author"] = document.getElementsByName("authorNews")[0].value;
				lDataMap["category"] = document.getElementsByName("categoryNews")[0].value;
				lDataMap["title"] = document.getElementsByName("titleNews")[0].value;
				lDataMap["date"] = document.getElementsByName("dateNews")[0].value;
				lDataMap["time"] = document.getElementsByName("timeNews")[0].value;
				lDataMap["place"] = document.getElementsByName("placeNews")[0].value;
				lDataMap["address"] = document.getElementsByName("addressNews")[0].value;
				lDataMap["icon"] = document.getElementsByName("iconNews")[0].value;
				lDataMap["message"] = document.getElementsByName("messageNews")[0].value;
                
                var lDataJson = JSON.stringify(lDataMap);
                                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        GDatabase.Instance().init();
                        alert(lDataMap["data"]);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "CREATE_DATABASE" +
				"&file=" + lPath +
				"&data=" + lDataJson
				);
            },
            //===============================================
            readFile: function() {
                var lFileRead = document.getElementById("DatabaseFileRead");
				var lFile = GConfig.Instance().getData("DatabaseFile");
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        lFileRead.innerHTML = lDataMap["data"];
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "READ_FILE" +
				"&file=" + lFile
				);
            },
            //===============================================
            updateFile: function() {
                var lFileUpdate = document.getElementById("DatabaseFileUpdate");
				var lFile = GConfig.Instance().getData("DatabaseFile");
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        lFileUpdate.innerHTML = lDataMap["data"];
                        GComboBox.Instance().fillBox("DatabaseComboBoxUpdate", true);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "UPDATE_FILE" +
				"&file=" + lFile
				);
            },
            //===============================================
            createFile: function() {
                var lFileCreate = document.getElementById("DatabaseFileCreate");
				var lFile = GConfig.Instance().getData("DatabaseFile");
				var lPath = GConfig.Instance().getData("DatabasePath");
                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        lFileCreate.innerHTML = lDataMap["data"];
                        GComboBox.Instance().fillBox("DatabaseComboBoxCreate", true);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "CREATE_FILE" +
				"&path=" + lPath +
				"&file=" + lFile
				);
            },
            //===============================================
            previewFile: function() {
                var lFilePreview = document.getElementById("DatabaseFilePreview");
				var lFile = GConfig.Instance().getData("DatabaseFile");
                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        lFilePreview.innerHTML = lDataMap["data"];
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "PREVIEW_FILE" +
				"&file=" + lFile
				);
            },
            //===============================================
            deleteFile: function() {
				var lFile = GConfig.Instance().getData("DatabaseFile");
				if(lFile == "") {alert("Aucun fichier n'a été sélectionné !!!"); return;}

                var lTabCtn = document.getElementsByClassName("DatabaseTab");
                var lObj = lTabCtn[1];
                this.openDatabaseTab(lObj, "DatabaseTab1");
                    
                var lRes = confirm("Êtes vous sûr de vouloir supprimer cette donnée ?");
                if(!lRes) return;

                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        GConfig.Instance().setData("DatabaseFile", "");
                        GDatabase.Instance().init();
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "DELETE_FILE" +
				"&file=" + lFile
				);
            }
            //===============================================
        };
    }
    //===============================================
    return {
        Instance: function() {
            if(!m_instance) {
                m_instance = Container();
            }
            return m_instance;
        }
    };
    //===============================================
})();
//===============================================
GDatabase.Instance().init();
//===============================================
