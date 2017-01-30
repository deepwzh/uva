var page = 1;
var field='field=',value=2+'uts',data;

function sort_table(elem){
    // alert(document.getElementById(id).getElementsByTagName('span')[0].innerHTML);
    var flag=elem.getElementsByTagName('span')[0];
    if(flag.innerHTML == "-"){                    
        var t = document.getElementById("ths").getElementsByTagName('th');
        for(var i=2;i<t.length;i++){
            t[i].getElementsByTagName('span')[0].innerHTML = "";
        }
        flag.innerHTML="↑";
        query(1,"field=",1 + elem.id,'&'+window.data);
    }
    else{
        if(flag.innerHTML=="↑"){
            flag.innerHTML="↓";
            query(1,"field=",2 + elem.id,'&'+window.data);
        }
        else if(flag.innerHTML=='↓'){
            flag.innerHTML="";
            query(1,"field=",0 + elem.id,'&'+window.data);

        }
    }

}
function query(page,title,x,str){
    window.page =page;
    window.field=title;
    window.value=x;
    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }
    else{
        xmlhttp =new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status == 200){
            document.getElementById("tablecontent").innerHTML= xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","showtable1.php?page="+ page+"&"+title + x+str,true);
    //alert("showtable1.php?page="+ page+"&"+title + x+str);
    xmlhttp.send();
}
function onload(){
    query(1,window.field,window.value,'&'+window.data);
    var ul = document.getElementById("page");
    var lis=ul.getElementsByTagName('li');

    for(var i=0;i<lis.length;i++){
        lis[i].className="";
        lis[i].onclick = function(){
            var liss=document.getElementById("page").getElementsByTagName('li');
            for(var i=0;i<liss.length;i++){
                liss[i].className = "";
            }
            this.className ='active';
            query(this.getElementsByTagName("a")[0].innerHTML,window.field,window.value,'&'+window.data);                    ;
        }
    }
    lis[1].className='active';
}
function mysubmit(){
    var form = $("form");
    var data = form.serialize();
    //alert(data);
    window.data=data;
    query(1,'field=',2+'uts'+'&',data);
    onload();
    return false;
}