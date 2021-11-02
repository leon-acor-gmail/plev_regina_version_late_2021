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
<script src="../scripts/jsResources.js"></script>
<script src="../scripts/jsFa.min.js"></script>
<script>
    var objResources = null;
    $(document).ready(function(){
            objResources = new jsResources();
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'},{'s':'#', 'n': 'banco de proyectos'},{'s':'#', 'n': 'mis proyectos'}]));
            getProjects();
    });
    function getProjects()
    {
        $.post('../business/bsnsTrees.php',{iC:1},function(f){
                objResources.ListProjectPopulate($('#cobLoc'), f, '<?php echo($_GET['token']); ?>');
            });
    }
</script>
<header class="w3-top">
    <div id="divHeader"></div>
</header>
<section class="divMiddle">
    <label>Banco de proyectos</label>
</section>
<section class="w3-container" style="height: 200px;"></section>
<div class="w3-container">
    <div id="cobLoc" ></div>
</div>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
  <div id="divFooter"></div>
</footer>
</body>
</html>
