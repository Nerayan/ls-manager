function ajaxGet(targId, out){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById(targId).innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", out, true);
    xmlhttp.send();
    return false;
}
function ajaxGet2(targ, out){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            targ.innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", out, true);
    xmlhttp.send();
    return false;
}