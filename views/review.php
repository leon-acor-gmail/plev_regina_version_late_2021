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
<link href="../styles/cssImageGallery.css" rel="stylesheet" />
</head>
<body>
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/jsResources.js"></script>
<script src="../scripts/jsFa.min.js"></script>
<script src="../scripts/jsHc.js"></script>
<script src="../scripts/jsHcMo.js"></script>
<script src="../scripts/jsHc3d.js"></script>
<script src="../scripts/jsHcEx.js"></script>
<script src="../scripts/jsGraphs.js"></script>
<script src="../scripts/jsImageGallery.js"></script>
<script>
    var objResources = null;
    var objGraph = null;
    var objImageGallery = null;
    $(document).ready(function(){
            objGraph = new jsGraphs();
            
            
            objResources = new jsResources();
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'},{'s':'#', 'n': 'análisis de datos'},{'s':'#', 'n': 'revisión de información'}]));
            getProjects();
            objImageGallery = new jsImageGallery();
            var span1 = document.getElementsByClassName("close")[0];
            var modal1 = document.getElementById('myModal1');
            span1.onclick = function() {
                
                modal1.style.display = "none";
            };
            window.onclick = function(event) {
                
                if (event.target == modal1) {
                    modal1.style.display = "none";
                }
            };
            
            var span2 = document.getElementsByClassName("close")[1];
            var modal2 = document.getElementById('myModal2');
            span2.onclick = function() {
                
                modal2.style.display = "none";
            };
            window.onclick = function(event) {
                
                if (event.target == modal2) {
                    modal2.style.display = "none";
                }
            };
            
            $('#cobProj').change(function(){
                
                $.post('../business/bsnsReview.php',{iC:1, arg1:$('#cobProj').val()},function(f){
                        setDataUpload(f);
                    });
            });
        });
    
    function getProjects()
    {
        $.post('../business/bsnsTrees.php',{iC:1},function(f){
                objResources.ComboPopulate($('#cobProj'),f);
            });
    }
    
    function setDataUpload(json)
    {
        //alert(json);
        //objResources.ImageGalleryPopulate($('#divImage'),json);
        if(JSON.parse(json).length > 0)
        {
            objResources.ImageGalleryPopulate($('#divImage'),json);
        }
        else
        {
            alert('Aun no tienes evidencias que revisar ...');
        }
    }
    
    function SaveModule(hash, data)
    {
        
        $.post('../business/bsnsReview.php',{iC:2, arg1: hash, arg2: data},function(){
                $('#lbl_'+hash).text(data);
                var modal = document.getElementById('myModal1');
                modal.style.display = "none";
                
                $.post('../business/bsnsReview.php',{iC:1, arg1:$('#cobProj').val()},function(f){
                        setDataUpload(f);
                    });
                
        });
        
    }
    function myModalCall2(x, y, z, a, b)
    {
  
        if($('#cobProj').val() !== '0' && $('#cobProj').val() !== null)
        {
            var modal = document.getElementById('myModal2');
            modal.style.display = "block";
             $.post('../business/bsnsReview.php',{iC:3, arg1:$('#cobProj').val(),arg2:x},function(f){
                        var arr = JSON.parse(f);
                        objGraph.grpMol4(f, y, z, a);
                        for(var i =0 ; i<Object.keys(arr).length; i++)
                        {
                            if(arr[i].L4 == b)
                            {
                                $('#lbl1').text(arr[0].L15);
                                $('#lbl2').text(arr[0].L16);
                                $('#lbl3').text(arr[0].L12);
                                $('#lbl4').text(arr[0].L14);
                                $('#lbl5').text(arr[0].L10);
                                $('#lbl6').text(arr[0].L9);
                                $('#lbl7').text(arr[0].L11);
                                $('#lbl8').text(arr[0].L13);
                            }
                        }
                        
                    });
        }
        else
        {
            alert('Elige un proyecto...');
        }
        
    }
    
    function myModalCall1(x)
    {
        if($('#cobProj').val() !== '0' && $('#cobProj').val() !== null && '<?php echo($_SESSION['pfl']); ?>' == '2')
        {
            $('#txtHash').text(x);
            $('#txtData').val('');
            var modal = document.getElementById('myModal1');
            modal.style.display = "block";
            
            $('#txtData').focus();
        }
        else
        {
            alert('Solo es que tu asesor puede hacer comentarios ...');
        }
        
    }
    
</script>
<header class="w3-top">
    <div id="divHeader"></div>
</header>
<section>
    <div id="myModal1" class="modal">
    <div class="modal-content">
       
        <div class="modal-header">
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <p>Escribe algun comentario</p>
            <div class="w3-container w3-">
                <h4 class="w3-hide" id="txtHash"></h4>
                <input id="txtData" class="w3-input"  maxlength="20000" type="text" />
            </div>
        </div>
        <br>
        <div class="modal-footer">
          <button onclick="SaveModule($('#txtHash').text(), $('#txtData').val());"  class="w3-button w3-indigo">Guardar...</button>
          <p class="w3-text-red"><span><strong>&#9873;</strong></span> Información obligatoria</p>
        </div>
        
    </div>
    </div>
</section>

<section>
    <div id="myModal2" class="modal">
    <div class="modal-content">
       
        <div class="modal-header">
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <hr>
            <div class="w3-row ">
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="mujeres" src="../images/_mujeres.png" /></p>
                    <p><span id="lbl1" class="w3-text-indigo w3-large"></span></p>
                    <p>Mujeres</p>
                </div>
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="hombres" src="../images/_hombres.png" /></p>
                    <p><span id="lbl2" class="w3-text-indigo w3-large"></span></p>
                    <p>Hombres</p>
                </div>
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="presupuesto" src="../images/_presupuesto.png" /></p>
                    <p>$ <span id="lbl3" class="w3-text-indigo w3-large"></span> MXN</p>
                    <p>Presupuesto por actividad</p>
                </div>
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="periodo" src="../images/_periodo.png" /></p>
                    <p><span id="lbl4" class="w3-text-indigo w3-large"></span></p>
                    <p>Periodo de evaluación</p>
                </div>
            </div>
            <hr>
            <div class="w3-row">
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="fuentes de verificación" src="../images/_fuentes_verificacion.png" /></p>
                    <p><span id="lbl5" class="w3-text-indigo w3-large"></span></p>
                    <p>Fuentes de verificación</p>
                </div>
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="cadena de resultados" src="../images/_cadena_resultados.png" /></p>
                    <p><span id="lbl6" class="w3-text-indigo w3-large"></span></p>
                    <p>Cadena de resultados</p>
                </div>
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="supuestos" src="../images/_supuestos.png" /></p>
                    <p><span id="lbl7" class="w3-text-indigo w3-large"></span></p>
                    <p>Supuestos</p>
                </div>
                <div class="w3-quarter w3-container w3-center w3-hover-opacity">
                    <p><img alt="dimension" src="../images/_dimension.png" /></p>
                    <p><span id="lbl8" class="w3-text-indigo w3-large"></span></p>
                    <p>Dimensión</p>
                </div>
                
            </div>
            <hr>
            <div class="w3-row w3-container">
                <div id="grpMol4" style="min-width: 310px; height: 400px;"></div>
            </div>
        <br>
        <div class="modal-footer">
          <!--<button onclick="SaveModule($('#txtHash').text(), $('#txtData').val());"  class="w3-button w3-indigo">Guardar...</button>-->
        </div>
        
    </div>
    </div>
</section>
<section class="w3-container" style="height: 100px;"></section>
<section class="w3-center">
    <select id="cobProj" class="w3-select" style="width: 60%;"  name="option"></select> 
    <br>
    <label id="lblProj" class="w3-large">Revisión de información</label>
</section>
<section class="w3-center">
    <div id="divImage"></div>
</section>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
    <div id="divFooter"></div>
</footer>
</body>
</html>
