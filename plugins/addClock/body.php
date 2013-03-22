<script type="text/javascript">
var uhr = new Date();
var minuten;
var stunden;
var sekunden;
var interval=500;

function datum(id){
   uhr.setTime(uhr.getTime()+interval);
   window.setTimeout(function(){datum(id)}, interval);
   minuten = uhr.getMinutes();
   stunden = uhr.getHours();
   sekunden = uhr.getSeconds();
   if(minuten < 10){minuten = '0'+minuten;} 
   if(sekunden < 10){sekunden = '0'+sekunden;} 
   if(stunden < 10){stunden = '0'+stunden;}
   document.getElementById(id).innerHTML="<center onclick='pluginInfo()'>Jetzt ist: "+stunden+":"+minuten+":"+sekunden+"</center>";
}

function pluginInfo(){
	alert("Ein Plugin von Felix Deil");
}

datum("banner");
</script>
<style>
#uhrBox{
	position: absolute;
	top: 0px;
	right: 10px;
}

#banner{
	top: 37px !important;
	left: -40px !important;
	width: 175px !important;
}

#banner:hover{
	background: red!important;
}
</style>