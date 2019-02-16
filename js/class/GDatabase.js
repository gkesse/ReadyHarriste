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
				this.listDatabase();
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
            listDatabase: function(file="") {
                var lDatabaseFile = document.getElementById("DatabaseFile");
                var lDatabaseMenu = document.getElementById("DatabaseMenu");
                GConfig.Instance().setData("DatabasePath", file);
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
						var lData = this.responseText;
						var lDataArr = JSON.parse(lData);
						lDatabaseFile.innerHTML = lDataArr["file"];
						lDatabaseMenu.innerHTML = lDataArr["menu"];
                    }
                }
                lXmlhttp.open("POST", "/php/req/database.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
                    "req=" + "LIST_DATABASE" +
                    "&file=" + file
				);
            },
            //===============================================
            openDatabaseFile: function(obj, name) {
                var lFile = obj.innerHTML;
				var lDatabasePath = GConfig.Instance().getData("DatabasePath");
				var lDatabaseFile = lDatabasePath + "/" + lFile;
                this.listDatabase(lFile);
            },
            //===============================================
            openDatabaseLink: function(obj) {
				var lFileLink = document.getElementsByClassName("DatabaseFileLink");
				var lFilePath = "";
				for(var i = 0; i < lFileLink.length; i ++) {
					var lLinkItem = lFileLink[i];
					var lLinkName = lLinkItem.innerText;
					lFilePath += "/" + lLinkName;
					if(lLinkItem.isEqualNode(obj)) break;
				}
                this.listDatabase(lFilePath);
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
