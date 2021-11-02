<?php
session_start();
if(!isset($_SESSION['lgn']))
{
    header('Location: '.'https://www.caransoluciones.com.mx/');
}
?>
<!DOCTYPE html>
<html>
<title>CARAN PLEX</title>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" href="../images/favicon.png">
<link rel="stylesheet" href="../styles/w3.css" />
<link rel="stylesheet" href="../styles/cssTemplate.css" />
<body>
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/jsResources.js"></script>
<script>
    var objResources = null;
    $(document).ready(function(){
        objResources = new jsResources();
        objResources.setHTML($('#divHeader'),$('#divFooter'));
    
        });   
</script>
<header>
    <div id="divHeader" class="w3-top"></div>
</header>


<section class="w3-container caran-verde w3-center" style="padding:128px 16px">
  <p class="w3-margin w3-jumbo">PLEX</p>
  <p class="w3-xlarge">Plataforma para el Extensionismo</p>
  <a href="#desc"><button class="w3-button caran-azul w3-padding-large w3-large w3-margin-top">¿Qué es?</button></a>
</section>
<section>
<div  id="desc" class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div  class="w3-twothird" style="text-align: justify;text-justify: inter-word;">
      <p class="w3-xlarge">PLEX</p>
      <p class="w3-padding-32 w3-large">La PLEX es una herramienta que facilitara reportar las actividades a desarrollar por los extensionistas en campo, representara un incremento en competencias, ayudara a diagnosticar y establecer objetivos que reflejaran indicadores de resultados y servirá como carta evaluativa para los extensionistas con forme al rango de evaluación de CIMMYT</p>

      <p class="w3-text-grey">CARAN SOLUCIONES ESTRATEGICAS S.C. a trabajado esta plataforma con Legalidad por México que es una iniciativa de Enseña por México, que busca formar líderes-ciudadanos que fomenten la Cultura de la Legalidad en nuestro país a través de diversas actividades relacionadas con: Derechos Humanos, Participación Ciudadana, Prevención del Delito y de la Violencia. Esta plataforma es utilizada por los (PEM) Profesional de enseña por México los cuales están distribuidos en la república mexicana en pueblos marginados desde baja california y hasta Chiapas, los cuales son monitoreados por sus formadores desde la ciudad de México. Este monitoreo sirve para observar el proceso evolutivo de sus actividades calendarizadas y evaluación del PEM para subir de rango.</p>
    </div>

    <div class="w3-third w3-center">
      <img src="../images/favicon.png" alt="CARAN" />
    </div>
  </div>
</div>
</section>
<footer>  
  <div id="divFooter" class="w3-container w3-padding-64 w3-center w3-opacity"></div>
</footer>
</body>
</html>
