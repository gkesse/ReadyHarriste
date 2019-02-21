//===============================================
var GComboBox = (function() {
    //===============================================
    var m_instance;
    var m_count = 0;
    //===============================================
    var Container = function() {
        return {
            //===============================================
            init: function() {
                this.fillBox("ComboBox");
			},
            //===============================================
            fillBox: function(id, showSelect=false, bgSelect=false) {
                var lComboBoxMap = document.getElementsByClassName(id);
                
                for(var i = 0; i < lComboBoxMap.length; i++) {
                    var lComboBox = lComboBoxMap[i];
                    var lSelect = lComboBox.getElementsByTagName("select")[0];
                    var lHtml = lSelect.options[lSelect.selectedIndex].innerHTML;
                    
                    var lBoxView = document.createElement("DIV");
                    lBoxView.setAttribute("class", "BoxView");
                    lBoxView.innerHTML = lHtml;
                    lComboBox.appendChild(lBoxView);
                    var lBoxSelect = document.createElement("DIV");
                    lBoxSelect.setAttribute("class", "BoxSelect BoxHide");
                    
                    for(var j = 0; j < lSelect.length; j++) {
                        var lHtml2 = lSelect.options[j].innerHTML;
                        var lBoxOption = document.createElement("DIV");
                        lBoxOption.innerHTML = lHtml2;
                        
                        lBoxOption.addEventListener("click", function(e){
                            var lBoxSelect = this.parentNode.parentNode.getElementsByTagName("select")[0];
                            var lBoxView = this.parentNode.previousSibling;
                            
                            for(var i = 0; i < lBoxSelect.length; i++) {
                                var lHtml = lBoxSelect.options[i].innerHTML;
                                var lHtml2 = this.innerHTML;
                                if(lHtml == lHtml2) {
                                    lBoxSelect.selectedIndex = i;
                                    var lEvent = document.createEvent("HTMLEvents");
                                    lEvent.initEvent("change", false, true);
                                    lBoxSelect.dispatchEvent(lEvent);

                                    if(showSelect == true) lBoxView.innerHTML = this.innerHTML;
                                    var lBoxSelectAsMap = this.parentNode.getElementsByClassName("BoxSelectAs");
                                    
                                    for(var j = 0; j < lBoxSelectAsMap.length; j++) {
                                        var lBoxSelectAs = lBoxSelectAsMap[j];
                                        lBoxSelectAs.removeAttribute("class");
                                    }
                                    
                                    if(bgSelect == true) this.setAttribute("class", "BoxSelectAs");
                                    break;
                                }
                            }
                            
                            lBoxView.click();
                        });
                        
                        lBoxSelect.appendChild(lBoxOption);
                    }
                    
                    lComboBox.appendChild(lBoxSelect);
                    
                    lBoxView.addEventListener("click", function(e){
                        e.stopPropagation();
                        GComboBox.Instance().closeBox(this);
                        this.nextSibling.classList.toggle("BoxHide");
                        this.classList.toggle("BoxActive");
                    });
                    
                    lBoxView.addEventListener("mouseover", function(e){
                        GSelection.Instance().save();        
                    });
                }
                
                document.addEventListener("click", this.closeBox);
            },
            //===============================================
            closeBox: function(obj) {
                var lBoxViewMap = document.getElementsByClassName("BoxView");
                var lBoxSelectMap = document.getElementsByClassName("BoxSelect");
                var lIndexMap = [];
                
                for(var i = 0; i < lBoxViewMap.length; i++) {
                    var lBoxView = lBoxViewMap[i];
                    if(obj == lBoxView) {
                        lIndexMap.push(i);
                    }
                    else {
                        lBoxView.classList.remove("BoxActive");
                    }
                }
                                
                for(var i = 0; i < lBoxSelectMap.length; i++) {
                    var lBoxSelect = lBoxSelectMap[i];
                    var lIndexOf = lIndexMap.indexOf(i);
                    if(lIndexOf) {
                        lBoxSelect.classList.add("BoxHide");
                    }
                }
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
GComboBox.Instance().init();
//===============================================
