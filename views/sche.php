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
<script src="../scripts/dhtmlxscheduler.js"></script>
<link href="../styles/dhtmlxscheduler.css" rel="stylesheet" />
</head>
<body>
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/jsResources.js"></script>
<script src="../scripts/jsFa.min.js"></script>

<script>
    var objResources = null;
   var sch = null;
    $(document).ready(function(){
            objResources = new jsResources();
            objResources.setHTML('<?php echo($_SESSION['spr']); ?>','<?php echo($_GET['token']); ?>','<?php echo($_SESSION['nme']); ?>',$('#divHeader'),$('#divFooter'), $('#divBreadcrumbs'), JSON.stringify([{'s':'home.php', 'n': 'inicio'},{'s':'#', 'n': 'planeación y programación'},{'s':'#', 'n': 'calendario'}]));
            getProjects();


			$.post('../business/bsnsSche.php',{iC:6},function(f){

				$('#idCat').val(f);
				 sch = setSchedule(scheduler,f);
				});


			$('#cobProj').change(function(){
					getDataSche(this.value, sch, $('#idCat').val());
            });


        });

    function setSchedule(scheduler, mml_cat){
		//alert(mml_cat+' setSche');
        scheduler.locale={
                date:{
                    month_full:["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
                    "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre"],
                    month_short:["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep",
                    "Oct", "Nov", "Dic"],
                    day_full:["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes",
                    "Sabado"],
                    day_short:["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"]
                },
                labels:{
                    dhx_cal_today_button:"Hoy",
                    day_tab:"Dia",
                    week_tab:"Semana",
                    month_tab:"Mes",
                    new_event:"Programar entrega de reporte",
                    icon_save:"Guardar",
                    icon_cancel:"Cancelar",
                    icon_details:"Detalles",
                    icon_edit:"Editar",
                    icon_delete:"Borrar",
                    confirm_closing:"", //Your changes will be lost, are you sure?
                    confirm_deleting:"Se borrará el siguiente evento",
                    section_description:"Descripción",
					section_select_1:"Indicador",
					section_select_2:"¿reporte o recurso?",
                    section_time:"Periodo"
                }
            };
            scheduler.config.multi_day = true;
			scheduler.config.auto_end_date = true;
			scheduler.config.details_on_create=true;
			scheduler.config.details_on_dblclick=true;
			scheduler.config.max_month_events = 3;

			scheduler.attachEvent("onTemplatesReady", function(){
					scheduler.templates.event_bar_date = function(start,end,ev){
						return "";
					};
				});

            scheduler.attachEvent("onEventAdded", function(id,ev){
                    var sr =  JSON.stringify(ev);
                    $.post('../business/bsnsSche.php', {iC:1, arg1:sr, arg2: $('#idProj').val()}, function(){});
                });

			scheduler.templates.event_bar_text = function(start,end,event){
					return event.arg1;
			  };

			scheduler.attachEvent("onEventChanged", function(id,ev){
					var sr =  JSON.stringify(ev);
					$.post('../business/bsnsSche.php', {iC:3, arg1:sr}, function(){});
                });

			scheduler.attachEvent("onEventDeleted", function(id){
				$.post('../business/bsnsSche.php', {iC:4, arg1:id}, function(){});
                });



			scheduler.attachEvent("onBeforeLightbox", function (/*id*/){
				//any custom logic here

				if($('#idProj').val() > 0)
				{
					return true;
				}
				else
				{
					alert('Elige un proyecto...');
					return false;
				}
			});


			var mml_ind = [{key:0, label: 'Elige un proyecto'}];
					scheduler.config.lightbox.sections=[
						{ name:"description", height:50, map_to:"arg1", type:"textarea", focus:true},
						{ name:"select_1", height:30, map_to:"arg2", type:"select", options:mml_ind},
						{ name:"select_2", height:40, map_to:"arg3", type:"select", options:JSON.parse(mml_cat)}
					];

            scheduler.init('scheduler_here', new Date(),"month");

            return scheduler;
    }

    function getDataSche(id, scheduler, mml_cat)
    {
        $('#idProj').val(id);
		$.post('../business/bsnsSche.php',{iC:5, arg1: id},function(g){
			 scheduler.config.lightbox.sections=[
				{ name:"description", height:50, map_to:"arg1", type:"textarea", focus:true},
				{ name:"select_1", height:30, map_to:"arg2", type:"select", options:JSON.parse(g)},
				{ name:"select_2", height:40, map_to:"arg3", type:"select", options:JSON.parse(mml_cat)}
			];
            scheduler.init('scheduler_here', new Date(),"month");
			$.post('../business/bsnsSche.php', {iC:2, arg1: id}, function(f){
				scheduler.parse(JSON.parse(f), "json");
			});
		});
    }

    function getProjects()
    {
        $.post('../business/bsnsTrees.php',{iC:1},function(f){
                objResources.ComboPopulate($('#cobProj'),f);
            });

    }
</script>
<header class="w3-top">
    <div id="divHeader"></div>

</header>
<section class="w3-container" style="height: 100px;"></section>
<section class="w3-center">
    <select id="cobProj" class="w3-select" style="width: 60%;"  name="option"></select>
    <br>
    <input type="hidden" id="idProj" />
	<input type="hidden" id="idCat" />
    <!--<input type="hidden" id="idSche" />-->
    <br>
    <label id="lblProj" class="w3-large">Programación de reportes</label>
</section>
<section class="w3-center w3-container divMiddle ">
	<div class="tooltip w3-left">
		<i class="fas fa-info fa-3x w3-text-blue w3-margin w3-hover-opacity"></i>
		<span class="tooltiptext">Ayuda - elige un indicador, y si vas a ejercer recursos o vas a reportar resultados</span>
	</div>
    <br>
    <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:500px; z-index: 0'>
        <div class="dhx_cal_navline">
            <div class="dhx_cal_prev_button">&nbsp;</div>
            <div class="dhx_cal_next_button">&nbsp;</div>
            <div class="dhx_cal_today_button"></div>
            <div class="dhx_cal_date"></div>
            <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
            <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
            <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
        </div>
        <div class="dhx_cal_header"></div>
        <div class="dhx_cal_data"></div>
    </div>
</section>

<footer class="w3-container w3-padding-64 w3-center w3-opacity">
    <div id="divBreadcrumbs"></div>
    <div id="divFooter"></div>
</footer>
</body>
</html>
