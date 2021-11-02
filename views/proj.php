<?php
session_start();
if(!isset($_SESSION['lgn']))
{
    header('Location: https://caran.com.mx/');
}
?>
<!DOCTYPE html>
<html>
<title>CARAN PLEV</title>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" href="../images/favicon.png">
<link rel="stylesheet" href="../styles/w3.css" />
<link rel="stylesheet" href="../styles/cssTemplate.css" />
<body>
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/jsResources.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbP1LlENLvOCk1g_BF15l1zDLtc5XroEE"></script>

<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbP1LlENLvOCk1g_BF15l1zDLtc5XroEE&callback=initMap"></script>-->
    <script>
    var objResources = null;
    var arrPos = [];
    $(document).ready(function(){
        objResources = new jsResources();
        objResources.setHTML($('#divHeader'),$('#divFooter'));
        initMap();

            $('#btnSubmit').click(function(a){
                var b = document.getElementsByTagName('form')[0];
                if(b.checkValidity())
                {
                    setJSON($('#arg1').val(),$('#arg2').val(),$('#arg3').val(),$('#arg4').val(),$('#arg5').val(),$('#arg6').val(),$('#arg7').val(),$('#arg8').val(),$('#arg10').val());
                    a.preventDefault();
                }
            });
        });

    function setJSON(arg1, arg2, arg3, arg4, arg5, arg6, arg7, arg8, arg10)
        {

            var jsonObject = {};
            jsonObject.arg1 = arg1;
            jsonObject.arg2 = arg2;
            jsonObject.arg3 = arg3;
            jsonObject.arg4 = arg4;
            jsonObject.arg5 = arg5;
            jsonObject.arg6 = arg6;
            jsonObject.arg7 = arg7;
            jsonObject.arg8 = arg8;
            jsonObject.arg9 = JSON.stringify(arrPos);
            jsonObject.arg10 = arg10;
            return jsonObject;

        }

        function initMap() {
            var jsonPos = {lat: 17.558423, lng: -99.512682};
            var map = new google.maps.Map(document.getElementById('arg9'), {
              zoom: 8,
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
                var pos = (e.latLng).toString().replace('(',' ').replace(')',' ');
                geocodeLatLng(map, pos);
            });
            return map;
      }

      function geocodeLatLng(map, input) {
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};

        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {

                var marker = new google.maps.Marker({
                  position: latlng,
                  map: map
                });
                arrPos.push({lat:marker.getPosition().lat().toString(),lng:marker.getPosition().lng().toString(),addr:results[0].formatted_address});
                marker.addListener('dblclick',function(){
                    arrPos.splice(arrPos.indexOf(marker.position),1);
                    marker.setMap(null);
                });
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            } else {
              window.alert('No hay resultados');
            }
          } else {
            window.alert('Falla de conexión:: ' + status);
          }
        });

      }

</script>
<header class="w3-top">
    <div id="divHeader"></div>
</header>
<section class="divMiddle">
    <div class="w3-row">
        <div class="w3-quarter w3-container"></div>
        <div class="w3-half w3-container">
            <form>
            <div class="w3-pading-32 w3-panel">
            <p class="w3-text-red"><span><strong>&#9873;</strong></span> Campos obligatorios</p>
            <input class="w3-input w3-large" type="text" id="arg1" maxlength="25" required />
            <label for="arg1">Nombre del Extensionista <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg2" required />
            <label for="arg2">Nombre del Formador <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg3" required />
            <label for="arg3">Nombre del Proyecto <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg4" required />
            <label for="arg10">Cadena Productiva <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg5" required />
            <label for="arg4">Problemática detecteda <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" id="arg6" required />
            <label for="arg5">Objetivo de Proyecto <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
             <div class="w3-section">
                <input class="w3-input w3-large" type="number" id="arg7" placeholder="Mujeres" &#9873; />
                <input class="w3-input w3-large" type="number" id="arg8" placeholder="Hombres" &#9873; />
            </div>
             </div>
            <div class="w3-pading-32 w3-panel">
            <label for="arg7">Distribución de población <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            <p><label for="arg9">Locación <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            <br>Posiciona las localidades en la que participes con un marcador con doble clic.</p>
            <img alg="marcador" src="../images/marker.png" />
            <div style="width: 610px; height: 560px;" id="arg9"></div>
            <!--<input type="button" id="lblLatLng" value="getJSON"/>-->
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="email" id="arg10" maxlength="25" required />
            <label for="arg10">Correo Electrónico <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <div class="w3-section">
                <button type="submit" id="btnSubmit" class="w3-button w3-large w3-green" >Guardar</button>
                <input type="reset" class="w3-button w3-large w3-teal" value="Nuevo" />
            </div>
            </div>
            </form>
        </div>
    <div class="w3-quarter w3-container"></div>
    </div>

<footer>
  <div id="divFooter" class=" w3-row w3-container w3-padding-64 w3-center w3-opacity"></div>
</footer>
</section>
</body>
</html>
