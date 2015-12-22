
function getXMLHttp() {
    "use strict";
    var XMLHttp = null;
    if (window.XMLHttpRequest) {
        try {
            XMLHttp = new XMLHttpRequest(); //utworzenie obiektu XMLHttpRequest (Gecko, IE>6, itd.)
        } catch (e) { }
    } else if (window.ActiveXObject) {
        try {
            XMLHttp = new ActiveXObject("Msxml2.XMLHTTP"); //utworzenie obiektu ActiveXObject
        } catch (e) {
            try {
                XMLHttp = new ActiveXObject("Microsoft.XMLHTTP"); //dla pozostałych wersji IE
            } catch (e) { }
        }
        }
        return XMLHttp;
    }
