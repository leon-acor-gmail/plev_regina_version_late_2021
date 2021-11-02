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
<script src="../scripts/jsImageGallery.js"></script>
<script src="../scripts/jsFa.min.js"></script>
<script>
    var objResources = null;
    var objImageGallery = null;
    $(document).ready(function(){
            objResources = new jsResources();
            objImageGallery = new jsImageGallery();
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'},{'s':'#', 'n': 'análisis de datos'},{'s':'#', 'n': 'ficha de avance'}]));
            getProjects();
            
        });
    
    function getProjects()
    {
        $.post('../business/bsnsTrees.php',{iC:1},function(f){
                objResources.ComboPopulate($('#cobProj'),f);
            });
                
    }
    
    function getInd(id)
    {
        $.post('../business/bsnsKardex.php',{iC:1, arg1:id},function(f){
                objResources.ComboPopulate($('#cobInd'),f);
            });
                
    }
    
    function getDataKardex(id)
    {
        $('#idProj').val(id);
        getInd(id);
    }
    
    function getFiles(id, ind)
    {
        $.post('../business/bsnsKardex.php',{iC:2, arg1:id, arg2: ind}, function(f){
            if(f.split('|')[0].length > 0)
            {
                objResources.LinkListPopulate($('#linkList'),f.split('|')[0]);
            }
            if(f.split('|')[1].length > 0)
            {
                objResources.ImageGallerySliderPopulate($('#imageGalleryList'),f.split('|')[1], objImageGallery);
            }
        });
    }
</script>
<header class="w3-top">
    <div id="divHeader"></div>
    
</header>
</section>
<section class="w3-container" style="height: 100px;"></section>
<section class="w3-center">
    <select id="cobProj" class="w3-select" style="width: 60%;" onchange="getDataKardex(this.value);" name="option"></select> 
    <br>
    <br>
    <label id="lblProj" class="w3-large">Ficha técnica</label>
</section>
<br>
<section class="divMiddle">
    <div class="w3-row">
        <div class="w3-quarter w3-container"></div>
        <div class="w3-half w3-container">
    <form action="../business/UploadFile.php" method="post" enctype="multipart/form-data" >
            
            <input type="hidden" name="arg5" value="1" />
            <input type="hidden" name="arg0" id="idProj" />
            <input type="hidden" name="arg4" value="Que tal estimado asesor, por favor verifica dentro de PLEV, ya que ha habido mucha actividad los ultimos minutos por parte de <?php echo($_SESSION['nme']); ?>. " />
            <!--<input type="hidden" name="arg4" id="idInd" />-->
            <p class="w3-text-red"><span><strong>&#9873;</strong></span> Campos obligatorios</p>
            <br>
            <div class="w3-pading-32 w3-panel">
            <select id="cobInd" name="arg1" class="w3-select" onchange="getFiles($('#idProj').val(), this.value);" ></select>
            <br>
            <label >Indicador <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
             <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="number" name="arg3" id="arg3" required />
            <label for="arg3">Avance <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
            <div class="w3-pading-32 w3-panel">
            <input class="w3-input w3-large" type="text" name="arg2" id="arg2" maxlength="1000" required />
            <label for="arg2">Describe tu actividad <span class="w3-text-red"><strong>&#9873;</strong></span></label>
            </div>
           
            
            <div class="w3-pading-32 w3-panel">
           
            <!--<input class="w3-input w3-large" type="file" multiple name="fileToUpload[]" accept=".png,.jpeg,.jpg,.PNG,.JPEG,.JPG,.pdf,.PDF" />-->
            <div class="w3-section">
                <!--<label>Solo evidencias gráficas (.png y .jpg) o documentos portables (.pdf) de hasta 5MB</label>-->
                <label>La evidencias se entregan bajo las especificaciones indicadas por tu asesor de proyecto.</label>
                <div class="tooltip">
                    <i class="fas fa-info fa-2x w3-margin-left w3-text-red w3-hover-opacity"></i>
                    <span class="tooltiptext">puedes elegir mas de un archivo a la vez... </span>
                </div>
            </div>
            <input class="w3-input w3-large" type="file" multiple name="fileToUpload[]" />
            </div>
            <div class="w3-pading-32 w3-panel">
            <div class="w3-section">
                <input type="submit" formtarget="_blank" id="btnSubmit" class="w3-button w3-large w3-green" value="registrar" />
                <input type="reset" class="w3-button w3-large w3-teal" value="limpiar campos" />
            </div>
            </div>
            <br>
            <div id="linkList" class="w3-container w3-section"></div><br>
            <div id="imageGalleryList" class="w3-container w3-section"></div>
    </form>
        </div>
<div class="w3-quarter w3-container"></div>
    </div>
</section>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
    <div id="divFooter"></div>
</footer>
</body>
</html>
