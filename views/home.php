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
<link rel="icon" href="../images/favicon.png" />
<link rel="stylesheet" href="../styles/cssW3.css" />
<link rel="stylesheet" href="../styles/cssTemplate.css" />
</head>
<body>
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/jsHc.js"></script>
<script src="../scripts/jsHcMo.js"></script>
<script src="../scripts/jsHc3d.js"></script>
<script src="../scripts/jsHcEx.js"></script>
<script src="../scripts/jsResources.js"></script>
<script src="../scripts/jsGraphs.js"></script>
<script src="../scripts/jsFa.min.js"></script>
<script>
    var objResources = null;
    var objGraph = null;

    $(document).ready(function(){
            objGraph = new jsGraphs();
            objGraph.grpMol1(getJson1());
            objGraph.grpMol2(getJson2());
            objGraph.grpMol3(getJson3());
            objResources = new jsResources();
            //alert('EFSGDFG: '+'<?php echo($_SESSION['spr']); ?>');
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'}]));
        });

    function getJson1(){
        return [{
                data: [
                    { name: 'Educación', y: 3 },
                    { name: 'Salud', y: 6 },
                    { name: 'Medio ambiente sano', y: 8},
                    { name: 'Vida libre de violencia', y: 5 }
                ]
                }];
    }

    function getJson2(){
        return [{
                    name: 'Niños',
                    data: [3, 4, 4, 2],
                    stack: 'kids'
                },{
                    name: 'Niñas',
                    data: [5, 3, 4, 7],
                    stack: 'kids'
                },  {
                    name: 'Adolescentes Mujeres',
                    data: [2, 5, 6, 2],
                    stack: 'youngs'
                }, {
                    name: 'Adolescentes Hombres',
                    data: [3, 0, 4, 4],
                    stack: 'youngs'
                },{
                    name: 'Adultos Mujeres',
                    data: [5, 3, 4, 7],
                    stack: 'adults'
                },{
                    name: 'Adultos Hombres',
                    data: [5, 3, 4, 7],
                    stack: 'adults'
                }];
    }

    function getJson3(){
        return [{
                name: 'Niños',
                data: [17, 22, 28, 25, 15, 19],
                pointPlacement: 'on'
            }, {
                name: 'Niñas',
                data: [43, 31, 17, 25, 29, 39],
                pointPlacement: 'on'
            },
            {
                name: 'Adolescentes Mujeres',
                data: [22, 17, 33, 27, 20, 13],
                pointPlacement: 'on'
            },
            {
                name: 'Adolescentes Hombres',
                data: [18, 30, 22, 23, 36, 29],
                pointPlacement: 'on'
            }];
    }
</script>
<header class="w3-top">
    <div id="divHeader"></div>

</header>
<section class="w3-container" style="height: 100px;"></section>
<section id="desc" class="w3-container">
  <div class="w3-content">
    <div  class="w3-twothird" style="text-align: justify;text-justify: inter-word;">
      <p class="w3-xlarge">PLEV - Plataforma para la Evaluación</p>
      <p class="w3-padding-32 w3-large">Herramienta para la gestión de proyectos sociales que permiten la implementación, seguimiento y evaluación del desempeño facilitando la generación de datos abiertos.</p>
      <!--<p class="w3-padding-32 w3-large">La PLEX es una herramienta que facilitara reportar las actividades a desarrollar por los extensionistas en campo, representara un incremento en competencias, ayudara a diagnosticar y establecer objetivos que reflejaran indicadores de resultados y servirá como carta evaluativa para los extensionistas con forme al rango de evaluación de CIMMYT</p>-->
      <p class="w3-text-grey">Grupo CARAN Soluciones Estratégicas S.C. Servicios de consultoría integral. Enfocados en analizar, resolver e implementar soluciones, para mejorar y maximizar servicios y productos de nuestros clientes con visión social.</p>
    </div>
    <div class="w3-third w3-center">
      <img src="../images/favicon.png" alt="CARAN" />
    </div>
  </div>
</section>
<br>
<section class="caran-verde w3-center w3-padding">
    <p class="w3-xxlarge">Información relevante</p>
</section>
<br>
<section>
    <div class="w3-row">
        <div class="w3-third w3-container">
            <div id="grpMol1" style="min-width: 310px; height: 400px;"></div>
            <p>Reprecentación porcentual de proyectos gestionados por línea de acción de CARAN</p>
        </div>
        <div class="w3-third w3-container">
            <div id="grpMol2" style="min-width: 310px; height: 400px;"></div>
            <p>Promedio de asistencia trimestral de grupos ciudadanos divididos en mujeres y hombres</p>
        </div>
        <div class="w3-third w3-container">
            <div id="grpMol3" style="min-width: 310px; height: 400px;"></div>
            <p>Porcentaje de habilidades desarrolladas en los talleres</p>
        </div>
    </div>
</section>
<section class="w3-container" style="height: 100px;"></section>
<footer class="w3-container w3-padding-16 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
    <div id="divFooter"></div>
</footer>
</body>
</html>
