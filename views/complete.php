<?php
session_start();
if(!isset($_SESSION['lgn']))
{
    header('Location: https://www.caransoluciones.com.mx/');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>CARAN PLEV</title>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="../images/favicon.png" rel="icon" />
<link href="../styles/cssW3.css" rel="stylesheet" />
<link href="../styles/cssTemplate.css" rel="stylesheet" />
</head>
<body>
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/jsResources.js"></script>
<script src="../scripts/jsFa.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBbP1LlENLvOCk1g_BF15l1zDLtc5XroEE"></script>
<script>
    var objResources = null;
    var arrPos = [];
    var arrMarkers = [];
    $(document).ready(function(){
            objResources = new jsResources();
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'},{'s':'#', 'n': 'reportes'},{'s':'#', 'n': 'extenso'}]));
            getProjects();
            
       
    
    $('#cobProj').change(function(){
                $.post('../business/bsnsComplete.php',{iC:2, arg1:$('#cobProj').val()},function(f){
                    objResources.ListEviCompletePopulate($('#divEviComplete'),f);
                });
            });
    
     });
    
    function getProjects()
    {
        $.post('../business/bsnsTrees.php',{iC:1},function(f){
                objResources.ComboPopulate($('#cobProj'),f);
                
            });
    }
    function initMap() {
            var jsonPos = {lat: 17.551269, lng: -99.503304};
            var map = new google.maps.Map(document.getElementById('arg9'), {
              zoom: 18,
              center: jsonPos
            });
            var icon = {
                url: '../images/favicon.png',
                scaledSize: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(0, 0)
            };
            new google.maps.Marker({
              position: jsonPos,
              map: map,
              icon: icon
            });

            /*map.addListener('dblclick', function(e) {
                var pos = (e.latLng).toString().replace('(','').replace(')','');
                geocodeLatLng(map, pos);
            });*/
            return map;
      }
      
    function setAddr(map, addr)
    {
        var js = JSON.parse(addr);
        for(i=0;i<js.length; i++)
        {
            var pos = js[i].mkr.toString().replace('(','').replace(')','');
            geocodeLatLng(map, pos);
        }
        
        var latlngStr = js[0].mkr.toString().replace('(','').replace(')','').split(',', 2);
        map.setCenter({lat:parseFloat(latlngStr[0]),lng:parseFloat(latlngStr[1])});
    }

      function geocodeLatLng(map, input) {
        //var objResources = new jsResources();
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
           
                var marker = new google.maps.Marker({
                  position: latlng,
                  map: map,
                  id: '_id'+input
                });
            
                arrMarkers.push({ml: marker});
                arrPos.push({id: '_id'+input, mkr: marker.getPosition().toString(), lat:marker.getPosition().lat().toString(),lng:marker.getPosition().lng().toString(),addr:results[0].formatted_address});
                /*marker.addListener('dblclick',function(){
                    var objResources = new jsResources();
                    arrPos.splice(arrPos.indexOf(marker.getPosition().toString()),1);
                    marker.setMap(null);
                    objResources.ListAvatarPopulate($('#cobLoc'),JSON.stringify(arrPos));
                });*/
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
                //objResources.ListAvatarPopulate($('#cobLoc'),JSON.stringify(arrPos));
                //alert(results[0].types);
            } else {
              window.alert('No hay resultados');
            }
          } else {
            window.alert('Falla de conexión:: ' + status);
          }
        });
       
      }
      
      /*function unsetMarker(mkr, mp)
      {
       var d = ((mkr).toString().replace('(','').replace(')','')).split(',');
       var h = {lat: parseFloat(d[0]), lng: parseFloat(d[1])};
        for(i=0;i<arrMarkers.length; i++)
        {
            var marker = arrMarkers[i].ml;
            if(marker.id == mp)
            {
                marker.setMap(null);
                arrMarkers.splice(i,1);
                arrPos.splice(arrPos.indexOf(h.toString()),1);
            }  
        }
     }*/
</script>
<header class="w3-top">
    <div id="divHeader"></div>
</header>
</section>
<section class="w3-container" style="height: 100px;"></section>
<section class="w3-center">
    <select id="cobProj" class="w3-select" style="width: 60%;"  name="option"></select> 
    <br><br><br>
</section>
<section>
    <div id="divEviComplete"></div>
</section>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
    <div id="divFooter"></div>
</footer>
</body>
</html>
