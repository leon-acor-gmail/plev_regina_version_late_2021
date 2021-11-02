<?php
session_start();
if(!isset($_SESSION['lgn']))
{
    header('Location: https://caran.com.mx/');
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
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBbP1LlENLvOCk1g_BF15l1zDLtc5XroEE"></script>-->
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCU0BhN2yaIz1NkVBaIa7SLP5crBo1G_6Q&callback=initMap"></script>
<script>
    var objResources = null;
    var arrPos = [];
    var arrMarkers = [];

    $(document).ready(function(){
            objResources = new jsResources();
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'},{'s':'#', 'n': 'proyectos'},{'s':'#', 'n': 'editar proyecto'}]));
            getSupervisors();

            $.post('../business/bsnsProj.php',{i:2,arg1:'<?php echo($_GET['uid']); ?>'},function(f){

                    var sr = JSON.parse(f);
                    $('#lblName').text(sr[0].L2);
                    $('#arg2').val(sr[0].L6);
                    $('#arg3').val(sr[0].L3);
                    $('#arg4').val(sr[0].L4);
                    $('#arg5').val(sr[0].L5);
                    $('#arg6').val(sr[0].L7);
                    $('#arg7').val(sr[0].L8);
                    $('#txtAddr').val(sr[0].L9);
                    $('#lblSuper').text(sr[0].L10);
                    objResources.ListAvatarPopulate($('#cobLoc'), $('#txtAddr').val());
                    //alert($('#lblAddr').text());

                    setAddr(initMap(), $('#txtAddr').val());
                });

            $('#btnSubmit').click(function(a){
                var b = document.getElementsByTagName('form')[0];
                if(b.checkValidity())
                {
                    var s  = setJSON($('#arg2').val(),$('#arg3').val(),$('#arg4').val(),$('#arg5').val(),$('#arg6').val(),$('#arg7').val());
                    $.post('../business/bsnsReg.php',{iC:4, arg1: s},function(){

                        location.href="../views/bank.php?token=<?php echo($_GET['token']); ?>";
                                    //alert(f + ' actualización exitosa...');
                        });
                    a.preventDefault();
                }
            });
        });

    function getSupervisors()
    {
        $.post('../business/bsnsReg.php',{iC:2},function(f){
                objResources.ComboPopulate($('#cobSupervisors'),f);
            });

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

    function setJSON( arg1, arg2, arg3, arg4, arg5, arg6)
        {

            var jsonObject = {};
            jsonObject.id = '<?php echo($_GET['uid']); ?>';
            jsonObject.nameOrg = arg1;
            jsonObject.problem = arg2;
            jsonObject.justy = arg3;
            jsonObject.goal = arg4;
            jsonObject.female = arg6;
            jsonObject.male = arg5;
            jsonObject.addr = arrPos;
            return JSON.stringify(jsonObject);

        }

        function initMap() {
            var jsonPos = {lat: 17.551269, lng: -99.503304};
            var map = new google.maps.Map(document.getElementById('arg9'), {
              zoom: 18,
              center: jsonPos,
              disableDoubleClickZoom: true
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

            map.addListener('dblclick', function(e) {
                var pos = (e.latLng).toString().replace('(','').replace(')','');
                geocodeLatLng(map, pos);
            });
            return map;
      }

      function geocodeLatLng(map, input) {
        var objResources = new jsResources();
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
                marker.addListener('dblclick',function(){
                    var objResources = new jsResources();
                    arrPos.splice(arrPos.indexOf(marker.getPosition().toString()),1);
                    marker.setMap(null);
                    objResources.ListAvatarPopulate($('#cobLoc'),JSON.stringify(arrPos));
                });
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
                objResources.ListAvatarPopulate($('#cobLoc'),JSON.stringify(arrPos));
                //alert(results[0].types);
            } else {
              window.alert('No hay resultados');
            }
          } else {
            window.alert('Falla de conexión:: ' + status);
          }
        });

      }

      function unsetMarker(mkr, mp)
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
     }
</script>

<header class="w3-top">
    <div id="divHeader"></div>
</header>
<section class="w3-container" style="height: 100px;"></section>
<section>

    <div class="w3-row">
        <div class="w3-quarter w3-container"></div>
        <div class="w3-half w3-container">

            <form>
                <div class="w3-pading-32 w3-panel">
                <label class="w3-large">Gerente <span class="w3-tag w3-large caran-azul" id="lblName"></span></label>
                <br>
                <br>
                <label class="w3-large">Asesor <span class="w3-tag w3-large caran-azul" id="lblSuper"></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg2" maxlength="1000" required />
            <label for="arg2">Dependencia, organización o unidad académica de adscripción<span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg3" maxlength="1000" required />
            <label for="arg3">Problemática detectada <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg4" maxlength="1000" required />
            <label for="arg4">Justificación de la intervención <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg5" maxlength="1000" required />
            <label for="arg5">Objetivo de Proyecto <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>

            <div class="w3-pading-16 w3-panel">
             <div class="w3-section">
                <input class="w3-input" type="number" id="arg6" placeholder="Mujeres" />
                <input class="w3-input" type="number" id="arg7" placeholder="Hombres" />
            </div>
             </div>
            <div class="w3-pading-32 w3-panel">
            <label for="arg8">Distribución de población <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            <p><label for="arg9">Locación <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            <br>Posiciona las localidades en la que participes con un marcador con doble clic.</p>
            <div class="w3-section">
                <div class="tooltip">
                <i class="fas fa-map-marker-alt fa-3x w3-text-red w3-margin w3-hover-opacity"></i>
                <span class="tooltiptext">Con doble clic marcas sobre el mapa una ubicación y también la quitas</span>
                </div>
                <div class="tooltip">
                    <i class="fas fa-info fa-3x w3-text-indigo w3-margin w3-hover-opacity"></i>
                    <span class="tooltiptext">Usa el control de zoom de la esquina para acercarte o alejarte.</span>
                </div>
            </div>
            <div style="width: 610px; height: 560px;" id="arg9"></div>
            <br>
            <div class="w3-container">
                <ul id="cobLoc" class="w3-ul w3-card-4"></ul>
            </div>
            <!--<div class="w3-pading-32 w3-panel">
                <select id="cobSupervisors" class="w3-select" style="width: 100%" name="option" ></select>
                <label for="cobSupervisors">Elige un asesor para la plataforma <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>-->
            <div class="w3-pading-32 w3-panel">
            <div class="w3-section">
                <button type="submit" id="btnSubmit" class="w3-button w3-large w3-green" >guardar cambios</button>
                <input type="reset" class="w3-button w3-large w3-teal" value="limpiar campos" />
            </div>
            </div>
            </form>
        </div>
        <br>

    <div class="w3-quarter w3-container"></div>
    </div>
</section>
<input style="display: none;"  id="txtAddr" ></input>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
    <div id="divFooter"></div>
</footer>
</body>
</html>
