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
<script>
    var objResources = null;
    $(document).ready(function(){
            objResources = new jsResources();
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'},{'s':'#', 'n': 'planeación y programación'},{'s':'#', 'n': 'matríz de indicadores'}]));
            getProjects();
            var span = document.getElementsByClassName("close")[0];
            var modal = document.getElementById('myModal');
            span.onclick = function() {

                modal.style.display = "none";
            };
            /*window.onclick = function(event) {

                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };*/

            $('#SaveModule').click(function(a){

                 var b = document.getElementsByTagName('form')[0];
                if(b.checkValidity())
                {
                var jsonObject = {};
                    jsonObject.proj = $('#cobProj').val();
                    jsonObject.code = $('#txtCode').text();
                    jsonObject.indicador = $('#arg1').val();
                    jsonObject.resumen = $('#arg2').val();
                    jsonObject.calculo = $('#arg3').val();
                    jsonObject.cadena = $('#arg4').val();
                    jsonObject.evidencias = $('#arg5').val();
                    jsonObject.supuestos = $('#arg6').val();
                    jsonObject.presupuesto = ($('#arg7').val().length > 0) ? $('#arg7').val() : '0';
                    jsonObject.dimension = $('#arg8').val();
                    jsonObject.base = $('#arg9').val();
                    jsonObject.meta = $('#arg10').val();
                    jsonObject.frecuencia = $('#arg12').val();
                    jsonObject.capitulo = $('#arg13').val()+':'+$('#arg14').val()+':'+$('#arg15').val();
                    jsonObject.unidad = $('#arg11').val();
                    //alert(JSON.stringify(jsonObject));
                    $.post('../business/bsnsMML.php',{iC:1, arg1: JSON.stringify(jsonObject)},function(){
                        //alert(f);
                        modal.style.display = "none";
                        $('p[data-code='+$('#txtCode').text()+'ind'+']').text($('#arg1').val());
                        $('p[data-code='+$('#txtCode').text()+'res'+']').text($('#arg2').val());
                        $('p[data-code='+$('#txtCode').text()+'evi'+']').text($('#arg5').val());
                        $('p[data-code='+$('#txtCode').text()+'sup'+']').text($('#arg6').val());
                        });
                    a.preventDefault();
                }

                });
        });

    function cleanFieldsInd()
    {
        $('#arg1').val(' ');
        $('#arg2').val(' ');
        $('#arg3').val(' ');
                       $('#arg4').val(0);
                       $('#arg5').val(' ');
                       $('#arg6').val(' ');
                       $('#arg7').val(' ');
                       $('#arg8').val(0);
                       $('#arg9').val(0);
                       $('#arg10').val(0);
                       $('#arg12').val(0);
                       $('#arg13').val(0);
                       $('#arg14').val(0);
                       $('#arg15').val(0);
                       $('#arg11').val(' ');
    }

    function cleanFields()
    {
        var v = document.querySelectorAll('.boxWrapper');
        var w = '';
        for(i=0; i< v.length; i++)
        {
            w = v[i].querySelector('[data-code]');
            $(w).text('');
        }
    }

    function getDataInd(code)
    {
        cleanFields();
        $.post('../business/bsnsMML.php',{iC: 2, arg1: code}, function(f){
            //alert(f);
            var y = JSON.parse(f);
            var v = document.querySelectorAll('.boxWrapper');
            var w = '';
                for(i=0; i< v.length; i++)
                {
                    w = v[i].querySelector('[data-code]');

                    for(j=0; j<y.length; j++)
                    {
                        if($(w).data('code') == y[j].code+'ind')
                        {

                            $(w).text(y[j].indicador);
                        }
                        else if($(w).data('code') == y[j].code+'res')
                        {
                             $(w).text(y[j].resumen);
                        }
                        else if($(w).data('code') == y[j].code+'evi')
                        {
                             $(w).text(y[j].evidencias);
                        }
                        else if($(w).data('code') == y[j].code+'sup')
                        {
                             $(w).text(y[j].supuestos);
                        }
                    }
                }
            });
    }

    function getProjects()
    {
        $.post('../business/bsnsTrees.php',{iC:1},function(f){
                objResources.ComboPopulate($('#cobProj'),f);
            });

    }

    function getBudget(){
      var iBudget1 = $('#iBudget1').val();
      var iBudget2 = $('#iBudget2').val();
      var iBudget3 = $('#iBudget3').val();
      var iBudgetTotal = parseInt(iBudget1) + parseInt(iBudget2) + parseInt(iBudget3);
      $('#arg7').val(iBudgetTotal);
    }

    function getInd(code)
    {
        if($('#cobProj').val() > 0)
        {
            //var iBudget = 0;
            if(code.indexOf('a') > 0)
            {
                $('#divBudget').removeClass('w3-hide');
                $('#divBudget').addClass('w3-show');
                //alert('act');

            }
            else
            {
                $('#divBudget').addClass('w3-hide');
                $('#divBudget').removeClass('w3-show');
                //alert('comp');
            }

            cleanFieldsInd();
            $.post('../business/bsnsMML.php',{iC:3, arg1: $('#cobProj').val(), arg2: code},function(f){
                    var us = JSON.parse(f);
                    if(us.length > 0)
                    {

                    $('#arg1').val(us[0].indicador);
                    $('#arg2').val(us[0].resumen);
                    $('#arg3').val(us[0].calculo);
                    $('#arg4').val(us[0].cadena);
                    $('#arg5').val(us[0].evidencias);
                    $('#arg6').val(us[0].supuestos);
                    $('#arg7').val(us[0].presupuesto);
                    $('#arg8').val(us[0].dimension);
                    $('#arg9').val(us[0].base);
                    $('#arg10').val(us[0].meta);
                    $('#arg12').val(us[0].frecuencia);
                    $('#arg11').val(us[0].unidad);
                    var chap = us[0].capitulo.split(':');
                    $('#arg13').val(chap[0]);
                    $('#arg14').val(chap[1]);
                    $('#arg15').val(chap[2]);

                    }
                    var modal = document.getElementById('myModal');
                    modal.style.display = "block";
                    $('#txtCode').text(code);
                    $('#txtShowCode').text(code.toUpperCase());
                });


        }
        else{
            alert('debes elegir un proyecto antes ...');
        }
    }
</script>
<header class="w3-top">
    <div id="divHeader"></div>
</header>
<section class="w3-container" style="height: 100px;">
    <div id="myModal" class="modal">
    <div class="modal-content">

        <div class="modal-header w3-center">
            <span class="close">&times;</span>
            <label>Construcción del indicador</label>
            <h4 id="txtCode" class="w3-hide"></h4>
            <h4 id="txtShowCode"></h4>


        </div>
        <div class="modal-body">
           <p class="w3-text-red"><span><strong>&#9873;</strong></span> Campos obligatorios</p>
           <form>
             <div class="w3-row">
                <div class="w3-third w3-container">
                <textarea id="arg2" class="w3-input" cols="12" rows="2" maxlength="1000" required></textarea>
                  <label for="arg2">Resumen narrativo <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                  <br>
                  <br>
                  <textarea id="arg1" class="w3-input" cols="12" rows="2" maxlength="1000" required ></textarea>
                  <label for="arg1">Nombre del indicador <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                  <br>
                  <br>

                  <textarea id="arg3" class="w3-input" cols="12" rows="2" maxlength="1000" required></textarea>
                  <label for="arg3">Método de cálculo <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                  <br>
                  <br>
                  <br>
                  <select id="arg4" required class="w3-select">
                            <option value="0" disabled selected>Elige una cadena de resultados <span class="w3-text-red"><strong>&#9873;</strong></span></option>
                            <option value="Actividad">Actividad</option>
                            <option value="Impacto">Impacto</option>
                            <option value="Insumo">Insumo</option>
                            <option value="Producto">Producto</option>
                            <option value="Resultado">Resultado</option>
                        </select>
                </div>
                <div class="w3-third w3-container">
                  <textarea id="arg5" class="w3-input" cols="12" rows="2" maxlength="1000" required></textarea>
                  <label for="arg5">Fuentes de verificación <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                  <br>
                  <br>
                  <textarea id="arg6" class="w3-input" cols="12" rows="2" maxlength="1000" required></textarea>
                  <label for="arg6">Supuestos <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                  <br>
                  <br>

                        <select id="arg8" required class="w3-select">
                            <option value="0" disabled selected>Elige una dimensión <span class="w3-text-red"><strong>&#9873;</strong></span></option>
                            <option value="Eficiencia">Eficiencia</option>
                            <option value="Calidad">Calidad</option>
                            <option value="Economía">Economía</option>
                            <option value="Eficacia">Eficacia</option>
                        </select>
                        <br>
                        <br>
                        <br>
                  <div id="divBudget">
                    <input disabled class="w3-input w3-large" type="number" id="arg7" />
                    <label for="arg7">Presupuesto de la actividad <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                    <br>
                    <br>
                    <!--

                      <p>I am a panel.</p>


                  -->
                  <div class="w3-panel">
                    <p>Ingresa el presupuesto cada uno de los capítulos</p>
                    <input id="iBudget1" onchange="getBudget();" type="number" value="0" style="width:100%;">
                        <select id="arg13" class="w3-select">
                            <option value="0" disabled selected>Elige un capítulo de presupuesto <span class="w3-text-red"><strong>&#9873;</strong></span></option>
                            <option value="1000">1000 Servicios Personales</option>
                            <option value="2000">2000 Materiales y Suministros</option>
                            <option value="3000">3000 Servicios Generales</option>
                            <option value="4000">4000 Subsidios y Transferencias</option>
                            <option value="5000">5000 Bienes Muebles e Inmuebles</option>
                            <!--<option value="6000">6000 Obras Públicas Servicios Personales</option>
                            <option value="7000">7000 Inversión  financiera,  provisiones  económicas,  ayudas,  otras  erogaciones y pensiones, jubilaciones y otras</option>
                            <option value="8000">8000 Participaciones de ingreso, aportaciones federales, aportaciones y gasto reasignado</option>
                            <option value="9000">9000 Deuda pública, pasivo circulante y otros</option>-->
                        </select>
                  </div>
                        <br>
                        <br>
                        <div class="w3-panel">
                          <input id="iBudget2" onchange="getBudget();" type="number" value="0" style="width:100%;" >
                        <select id="arg14" class="w3-select">
                            <option value="0" disabled selected>Elige un capítulo de presupuesto <!--<span class="w3-text-red"><strong>&#9873;</strong></span>--></option>
                            <option value="1000">1000 Servicios Personales</option>
                            <option value="2000">2000 Materiales y Suminìstros</option>
                            <option value="3000">3000 Servicios Generales</option>
                            <option value="4000">4000 Subsidios y Transferencias</option>
                            <option value="5000">5000 Bienes Muebles e Inmuebles</option>
                            <!--<option value="6000">6000 Obras Públicas Servicios Personales</option>
                            <option value="7000">7000 Inversión  financiera,  provisiones  económicas,  ayudas,  otras  erogaciones y pensiones, jubilaciones y otras</option>
                            <option value="8000">8000 Participaciones de ingreso, aportaciones federales, aportaciones y gasto reasignado</option>
                            <option value="9000">9000 Deuda pública, pasivo circulante y otros</option>-->
                        </select>
                        </div>
                        <br>
                        <br>
                        <div class="w3-panel">
                          <input id="iBudget3" onchange="getBudget();" type="number" value="0" style="width:100%;" >
                        <select id="arg15" class="w3-select">
                            <option value="0" disabled selected>Elige un capítulo de presupuesto <!--<span class="w3-text-red"><strong>&#9873;</strong></span>--></option>
                            <option value="1000">1000 Servicios Personales</option>
                            <option value="2000">2000 Materiales y Suministros</option>
                            <option value="3000">3000 Servicios Generales</option>
                            <option value="4000">4000 Subsidios y Transferencias</option>
                            <option value="5000">5000 Bienes Muebles e Inmuebles</option>
                            <!--<option value="6000">6000 Obras Públicas Servicios Personales</option>
                            <option value="7000">7000 Inversión  financiera,  provisiones  económicas,  ayudas,  otras  erogaciones y pensiones, jubilaciones y otras</option>
                            <option value="8000">8000 Participaciones de ingreso, aportaciones federales, aportaciones y gasto reasignado</option>
                            <option value="9000">9000 Deuda pública, pasivo circulante y otros</option>-->
                        </select>
                        </div>
                        <br>
                        <br>
                        <a class="linkList" href="http://www.diputados.gob.mx/sedia/sia/se/SE-ISS-03-08_Intro.pdf" target="_blank">Capitulos de gasto en México</a>
                        <!--<br>
                        <br>
                        <a class="linkList" href="http://www.pef.hacienda.gob.mx/es/PEF2017/tomoI-III" target="_blank">Gasto Público por Ramo</a>
                        <br>
                        <br>
                        <a class="linkList" href="http://www.pef.hacienda.gob.mx/" target="_blank">Estructura de los Tomos</a>-->
                        <br>
                        <br>
                        <a class="linkList" href="http://www.transparenciapresupuestaria.gob.mx/es/PTP/datos_presupuestarios_abiertos" target="_blank">Datos presupuestarios abiertos</a>
                  </div>

                </div>
                <div class="w3-third w3-container">
                        <input class="w3-input w3-large" type="number" id="arg9" required />
                        <label for="arg9">Línea base <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                        <br>
                        <input class="w3-input w3-large" type="number" id="arg10" required />
                        <label for="arg10">Línea meta <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                        <br>
                        <br>
                        <input class="w3-input w3-large" type="text" id="arg11" maxlength="1000" required />
                        <label for="arg11">Unidad de medida <span class="w3-text-red"><strong>&#9873;</strong></span></label>
                        <br>
                        <br>
                        <select id="arg12" required class="w3-select">

                            <option value="0" disabled selected>Elige una frec. de medición <span class="w3-text-red"><strong>&#9873;</strong></span></option>
                            <option value="Anual">Anual</option>
                            <option value="Semestre">Semestre</option>
                            <option value="Trimestre">Cuatrimestre</option>
                            <option value="Trimestre">Trimestre</option>
                            <option value="Bimestre">Bimestre</option>
                            <option value="Mensual">Mensual</option>
                            <option value="Quincenal">Quincenal</option>
                            <option value="Semanal">Semanal</option>
                        </select>
                </div>
            </div>
             <br>
             <br>
                   <button id="SaveModule"  class="w3-button w3-indigo">Guardar...</button>

                   </form>
        </div>
        <br>
        <div class="modal-footer">
          <!--<button type="submit" onclick="SaveModule($('#txtCode').text());"  class="w3-button w3-indigo">Guardar...</button>-->

        </div>

    </div>
    </div>
</section>
<section class="w3-center">
    <select id="cobProj" class="w3-select" style="width: 60%;" onchange="getDataInd(this.value);" name="option"></select>
    <br>
    <br>
    <label id="lblProj" class="w3-large">Matríz de indicadores</label>
    <br>
    <br>
</section>
<section class="divMiddle w3-container">
    <div class="w3-cell-row w3-center">
        <div  class="w3-container caran-azul-light-xxh w3-cell w3-cell-middle w3-mobile boxIndLightLevel">
            <!--<p>Nivel</p>-->
        </div>
        <div class="w3-container w3-hover-opacity caran-azul-light-xh w3-cell w3-cell-middle w3-mobile boxIndLight">

            <p>Resumen</p>
        </div>
        <div class="w3-container w3-hover-opacity caran-azul-light-h w3-cell w3-cell-middle w3-mobile boxIndLight">
            <p>Indicador</p>
        </div>
        <div class="w3-container w3-hover-opacity caran-azul-light-m w3-cell w3-cell-middle w3-mobile boxIndLight">
            <p>Fuentes de verificación</p>
        </div>
        <div class="w3-container w3-hover-opacity caran-azul-light-l w3-cell w3-cell-middle w3-mobile boxIndLight">
            <p>Supuestos</p>
        </div>

    </div>
    <div onclick="getInd('f1i1');" class="w3-cell-row">
        <div class="w3-container caran-verde-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>Fin</p>
        </div>
        <div class="w3-container caran-verde-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="f1i1res"></p>
        </div>
        <div class="w3-container caran-verde-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
             <p data-code="f1i1ind"></p>
        </div>
        <div class="w3-container caran-verde-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="f1i1evi"></p>
        </div>
        <div class="w3-container caran-verde-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="f1i1sup"></p>
        </div>

    </div>
    <div onclick="getInd('p1i1');" class="w3-cell-row">
        <div class="w3-container caran-azul-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>Propósito del proyecto</p>
        </div>
        <div class="w3-container caran-azul-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="p1i1res"></p>
        </div>
        <div class="w3-container caran-azul-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="p1i1ind"></p>
        </div>
        <div class="w3-container caran-azul-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="p1i1evi"></p>
        </div>
        <div class="w3-container caran-azul-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="p1i1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c1i1');" class="w3-cell-row">
        <div class="w3-container caran-rojo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>Bienes o Servicios</p>
        </div>
        <div class="w3-container caran-rojo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">

            <p data-code="c1i1res"></p>
        </div>
        <div class="w3-container caran-rojo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1i1ind"></p>
        </div>
        <div class="w3-container caran-rojo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1i1evi"></p>
        </div>
        <div class="w3-container caran-rojo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1i1sup"></p>
        </div>


    </div>
    <div onclick="getInd('c2i1');" class="w3-cell-row">
        <div class="w3-container caran-rojo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>Bienes o Servicios</p>
        </div>
        <div class="w3-container caran-rojo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2i1res"></p>
        </div>
        <div class="w3-container caran-rojo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2i1ind"></p>
        </div>
        <div class="w3-container caran-rojo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2i1evi"></p>
        </div>
        <div class="w3-container caran-rojo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2i1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c3i1');" class="w3-cell-row">
        <div class="w3-container caran-rojo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>Bienes o Servicios</p>
        </div>
        <div class="w3-container caran-rojo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3i1res"></p>
        </div>
        <div class="w3-container caran-rojo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3i1ind"></p>
        </div>
        <div class="w3-container caran-rojo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3i1evi"></p>
        </div>
        <div class="w3-container caran-rojo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3i1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c4i1');" class="w3-cell-row">
        <div class="w3-container caran-rojo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>Bienes o Servicios</p>
        </div>
        <div class="w3-container caran-rojo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c4i1res"></p>
        </div>
        <div class="w3-container caran-rojo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c4i1ind"></p>
        </div>
        <div class="w3-container caran-rojo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="w3-hover-opacity" data-code="c4i1evi"></p>
        </div>
        <div class="w3-container caran-rojo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="w3-hover-opacity" data-code="c4i1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c1a1');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C1A1</p><br>
            <p data-code="c1a1res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a1ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a1evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c1a2');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>C1 Actividades</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C1A2</p><br>
            <p data-code="c1a2res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a2ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a2evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a2sup"></p>
        </div>

    </div>
    <div onclick="getInd('c1a3');" class="w3-cell-row">
        <div class="w3-container  caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C1A3</p><br>
            <p data-code="c1a3res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a3ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a3evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c1a3sup"></p>
        </div>

    </div>


    <div onclick="getInd('c2a1');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C2A1</p><br>
            <p data-code="c2a1res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2a1ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2a1evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2a1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c2a2');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>C2 Actividades</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C2A2</p><br>
            <p data-code="c2a2res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c2a2ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c2a2evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c2a2sup"></p>
        </div>

    </div>
    <div onclick="getInd('c2a3');" class="w3-cell-row">
        <div class="w3-container  caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C2A3</p><br>
            <p data-code="c2a3res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2a3ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2a3evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c2a3sup"></p>
        </div>

    </div>


    <div onclick="getInd('c3a1');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C3A1</p><br>
            <p data-code="c3a1res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3a1ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3a1evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3a1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c3a2');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>C3 Actividades</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C3A2</p><br>
            <p data-code="c3a2res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3a2ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3a2evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p data-code="c3a2sup"></p>
        </div>

    </div>
    <div onclick="getInd('c3a3');" class="w3-cell-row">
        <div class="w3-container  caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C3A3</p><br>
            <p data-code="c3a3res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c3a3ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c3a3evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c3a3sup"></p>
        </div>

    </div>




     <div onclick="getInd('c4a1');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C4A1</p><br>
            <p data-code="c4a1res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c4a1ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c4a1evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c4a1sup"></p>
        </div>

    </div>
    <div onclick="getInd('c4a2');" class="w3-cell-row">
        <div class="w3-container caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p>C4 Actividades</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C4A2</p><br>
            <p data-code="c4a2res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c4a2ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c4a2evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c4a2sup"></p>
        </div>

    </div>
    <div onclick="getInd('c4a3');" class="w3-cell-row">
        <div class="w3-container  caran-amarillo-xxh w3-cell w3-cell-middle w3-mobile boxIndLevel">
            <p class="caran-text-amarillo-xxh">CARAN</p>
        </div>
        <div class="w3-container caran-amarillo-xh w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
            <p class="caran-text-naranja">C4A3</p><br>
            <p data-code="c4a3res"></p>
        </div>
        <div class="w3-container caran-amarillo-h w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                <p data-code="c4a3ind"></p>
        </div>
        <div class="w3-container caran-amarillo-m w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
                 <p data-code="c4a3evi"></p>
        </div>
        <div class="w3-container caran-amarillo-l w3-cell w3-mobile boxInd boxWrapper w3-hover-opacity">
               <p data-code="c4a3sup"></p>
        </div>

    </div>


</section>
<!--<section class="divMiddle w3-container w3-large">
    <div class="w3-cell-row w3-orange">
        <div class="w3-container w3-cell w3-cell-middle w3-mobile">
            <p class="w3-hover-text-grey">Primer nivel</p>
        </div>
        <div class="w3-container w3-cell w3-cell-middle w3-mobile">
            <div class="w3-cell-row">
                <div class="w3-container w3-red w3-cell w3-cell-middle w3-mobile">
                    <p class="w3-hover-text-grey">Fin</p>
                </div>
                <div class="w3-container w3-blue w3-cell w3-mobile">
                    <p class="w3-hover-text-grey">Indicador fin</p>
                </div>
            </div>
            <div class="w3-cell-row">
                <div class="w3-container w3-red w3-cell w3-cell-middle w3-mobile">
                    <p class="w3-hover-text-grey">Problema</p>
                </div>
                <div class="w3-container w3-blue w3-cell w3-mobile">
                    <p class="w3-hover-text-grey">Indicador problema</p>
                </div>
            </div>
            <div class="w3-cell-row">
                <div class="w3-container w3-red w3-cell w3-cell-middle w3-mobile">
                    <p class="w3-hover-text-grey">Bienes o Servicios</p>
                </div>
                <div class="w3-container w3-blue w3-cell w3-mobile">
                    <p class="w3-hover-text-grey">C1I1</p>
                    <p class="w3-hover-text-grey">C1I2</p>
                    <p class="w3-hover-text-grey">C1I3</p>
                </div>
            </div>
            <div class="w3-cell-row">
                <div class="w3-container w3-red w3-cell w3-cell-middle w3-mobile">
                    <p class="w3-hover-text-grey">Bienes o Servicios</p>
                </div>
                <div class="w3-container w3-blue w3-cell w3-mobile">
                    <p class="w3-hover-text-grey">C2I1</p>
                    <p class="w3-hover-text-grey">C2I2</p>
                    <p class="w3-hover-text-grey">C2I3</p>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!--<section class="w3-container" style="height: 200px;"></section>-->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
    <div id="divFooter"></div>
</footer>
</body>
</html>
