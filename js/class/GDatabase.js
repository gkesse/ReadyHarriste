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
                    this.previewFile();
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
				lDataMap["author"] = document.getElementsByName("authorNewsUpdate")[0].value;
				lDataMap["category"] = document.getElementsByName("categoryNewsUpdate")[0].value;
				lDataMap["title"] = document.getElementsByName("titleNewsUpdate")[0].value;
				lDataMap["date"] = document.getElementsByName("dateNewsUpdate")[0].value;
				lDataMap["time"] = document.getElementsByName("timeNewsUpdate")[0].value;
				lDataMap["place"] = document.getElementsByName("placeNewsUpdate")[0].value;
				lDataMap["address"] = document.getElementsByName("addressNewsUpdate")[0].value;
				lDataMap["icon"] = document.getElementsByName("iconNewsUpdate")[0].value;
				lDataMap["message"] = this.encodeHtml(document.getElementById("messageNewsUpdate").innerHTML, "json");               
                lDataMap["update"] = GDate.Instance().getDate();
                                
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
            createDatabaseV2: function(obj) {
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						alert(lData);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "CREATE_DATABASE_V2" +
				"&name=" + "lName"
				);
            },
            //===============================================
            createDatabaseNews: function(obj) {
               var lRes = confirm("Êtes vous sûr de vouloir ajouter cette nouvelle donnée ?");
                if(!lRes) return;

				var lPath = GConfig.Instance().getData("DatabasePath");
				if(lPath == "") {alert("Aucune base de données n'a été sélectionnée !!!"); return;}
                
                var lDataMap = {};
				lDataMap["author"] = document.getElementsByName("authorNewsCreate")[0].value;
				lDataMap["category"] = document.getElementsByName("categoryNewsCreate")[0].value;
				lDataMap["title"] = document.getElementsByName("titleNewsCreate")[0].value;
				lDataMap["date"] = document.getElementsByName("dateNewsCreate")[0].value;
				lDataMap["time"] = document.getElementsByName("timeNewsCreate")[0].value;
				lDataMap["place"] = document.getElementsByName("placeNewsCreate")[0].value;
				lDataMap["address"] = document.getElementsByName("addressNewsCreate")[0].value;
				lDataMap["icon"] = document.getElementsByName("iconNewsCreate")[0].value;
				lDataMap["message"] = this.encodeHtml(document.getElementById("messageNewsCreate").innerHTML, "json");               
                lDataMap["create"] = GDate.Instance().getDate();
                lDataMap["update"] = lDataMap["create"];
                 
                var lDataJson = JSON.stringify(lDataMap);

                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        GDatabase.Instance().init();
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
            visualizeFile: function() {
                var lFileVisualize = document.getElementById("DatabaseFileVisualize");
				var lFile = GConfig.Instance().getData("DatabaseFile");
                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        lFileVisualize.innerHTML = lDataMap["data"];
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "VISUALIZE_FILE" +
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
            },
            //===============================================
            copyMessageNewsUpdate: function(obj) {                
                var lFileMessage = document.getElementById("messageNewsUpdate");
                var lMessage = lFileMessage.innerHTML;
                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        alert(lDataMap["data"]);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "COPY_MESSAGE" + 
                "&data=" + lMessage
				);
            },
            //===============================================
            pasteMessageNewsUpdate: function(obj) {                
                var lFileMessage = document.getElementById("messageNewsUpdate");

                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        lFileMessage.innerHTML = lDataMap["data"];
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "PASTE_MESSAGE"
				);
            },
            //===============================================
            copyMessageNewsCreate: function(obj) {                
                var lFileMessage = document.getElementById("messageNewsCreate");
                var lMessage = lFileMessage.innerHTML;
                
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        alert(lDataMap["data"]);
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "COPY_MESSAGE" + 
                "&data=" + lMessage
				);
            },
            //===============================================
            pasteMessageNewsCreate: function(obj) {                
                var lFileMessage = document.getElementById("messageNewsCreate");

                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataMap = JSON.parse(lData);
                        lFileMessage.innerHTML = lDataMap["data"];
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
				"req=" + "PASTE_MESSAGE"
				);
            },
            //===============================================
            encodeHtml: function(data, lang) {
                var lEntityMap = {
                    '&nbsp;': ' |json',
                    '<': '&lt;|html',
                    '>': '&gt;|html',
                    '\n': '<br>|html',
                    '&lt;': '<|txt',
                    '&gt;': '>|txt',
                    '&amp;': '&|tex;txt',
                    '<br>': '\n|txt'
                };
                for(key in lEntityMap) {
                    var lVal = lEntityMap[key];
                    var lSplit = lVal.split("|");
                    var lVal2 = lSplit[0];
                    if(lSplit.length > 1) {
                        var lVal3 = lSplit[1];
                        var lSplit2 = lVal3.split(";");
                        var lIncludes = lSplit2.includes(lang);
                        if(!lIncludes) continue;
                    }
                    var lReg = new RegExp(key, 'g');
                    data = data.replace(lReg, lVal2);
                }
                return data;
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
