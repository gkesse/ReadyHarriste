//===============================================
var GDate = (function() {
    //===============================================
    var m_instance;
    //===============================================
    var Container = function() {
        return {
            //===============================================
            init: function() {

            },
            //===============================================
            getDate: function() {
                var lDate = new Date();
                var lDay = lDate.getDate();
                var lMonth = lDate.getMonth() + 1;
                var lYear = lDate.getFullYear();
                var lHour = lDate.getHours();
                var lMinute = lDate.getMinutes();
                
                lDay = (lDay < 10) ? "0" + lDay : lDay;
                lMonth = (lMonth < 10) ? "0" + lMonth : lMonth;
                lHour = (lHour < 10) ? "0" + lHour : lHour;
                lMinute = (lMinute < 10) ? "0" + lMinute : lMinute;                
                
                var lFormat = "";
                lFormat += lDay + "/";
                lFormat += lMonth + "/";
                lFormat += lYear + " - ";
                lFormat += lHour + "h";
                lFormat += lMinute;
                
                return lFormat;
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
GDate.Instance().init();
//===============================================
