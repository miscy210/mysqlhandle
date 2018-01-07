var xmlHttp

function showInboard(url,showid)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	}
	xmlHttp.onreadystatechange=function(){stateChanged(showid)}
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}

function showDatabase()
{
	var url="showdatabase.php"
	url=url+"?sid="+Math.random()
	showInboard(url,"showboard")
}

function showTables()
{
	var url="showtables.php"
	var database=document.getElementById("database").value
	url=url+"?database="+database
	url=url+"&sid="+Math.random()
	showInboard(url,"showboard")
}

function showFields()
{
	var database=document.getElementById("database").value;
	var table=document.getElementById("table").value;
	var url="showfields.php"
	url=url+"?database="+database+"&table="+table
	url=url+"&sid="+Math.random()
	showInboard(url,"showboard")
}

function getTables(str)
{
	var url="gettables.php"
	url=url+"?database="+str
	url=url+"&sid="+Math.random()
	showInboard(url,"table")
}

function stateChanged(str)
{
	 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	 {
	 	document.getElementById(str).innerHTML=xmlHttp.responseText
	 }
}

function GetXmlHttpObject()
{
	var xmlHttp=null;

	try
	 {
		 // Firefox, Opera 8.0+, Safari
		 xmlHttp=new XMLHttpRequest();
	 }
	catch (e)
	 {
		 // Internet Explorer
		 try
		  {
		  	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		  }
		 catch (e)
		  {
		  	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
	 }
	return xmlHttp;
}

function uploadopt()
{
	dom=document.getElementById("download")
	dom.style.background = "white";
	dom=document.getElementById("upload")
	dom.style.background = "yellow";
	fm1 = document.forms[0]
	fm1.setAttribute("action","upload.php")
	fm1.setAttribute("enctype","multipart/form-data")
	var url="uploadfile.php"
	url=url+"?sid="+Math.random()
	showInboard(url,"options")
}

function downloadopt()
{
	dom=document.getElementById("download")
	dom.style.background = "yellow";
	dom=document.getElementById("upload")
	dom.style.background = "white";
	fm1 = document.forms[0]
	fm1.setAttribute("action","upload.php")
	fm1.setAttribute("enctype","multipart/form-data")
	var url="uploadfile.php"
	url=url+"?sid="+Math.random()
	showInboard(url,"options")
}
