var jsResources = function () {

jsResources.prototype.setHTML = function(pfl, token, user, domHeader, domFooter, domBreadcrumbs, json)
	{
		//alert('dsa:'+pfl);
		var sr = '<div class="w3-bar w3-indigo w3-card w3-left-align w3-small">'+
		'<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right caran-hover-azul w3-large w3-indigo" href="javascript:void(0);" onclick="objResources.ShowDOM(getElementById(\'navDemo\'));" title="Toggle Navigation Menu">'+
		'<i class="fa fa-bars"></i>'+
		'</a>'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul" onclick="location.href = \'../views/home.php?token='+token+'\';">'+
		'<i class="fas fa-home fa-lg"></i> Inicio'+
		'</div>'+
		'<!--<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul" onclick="location.href = \'../views/bank.php?token='+token+'\';">'+
		'<i class="fas fa-tasks fa-lg"></i> Proyectos'+
		'</div>-->'+
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-archive fa-lg"></i> Banco de proyectos'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/bank.php?token='+token+'" class="w3-bar-item w3-button">Mis proyectos</a>'+
		'<a href="../views/new.php?token='+token+'" class="w3-bar-item w3-button">Nuevo</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-users fa-lg"></i> Involucrados'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/people.php?token='+token+'" class="w3-bar-item w3-button">Análisis</a>'+
		'</div>'+
		'</div>'+
		/*'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-tree fa-lg"></i> AP / AO'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/pt.php?token='+token+'" class="w3-bar-item w3-button">Árbol de problemas</a>'+
		'<a href="../views/ot.php?token='+token+'" class="w3-bar-item w3-button">Árbol de objetivos</a>'+
		'</div>'+
		'</div>'+*/
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-calendar-alt fa-lg"></i> Planeación y programación'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/mml.php?token='+token+'" class="w3-bar-item w3-button">Matríz de indicadores</a>'+
		'<a href="../views/sche.php?token='+token+'"  class="w3-bar-item w3-button">Calendario</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-dollar-sign fa-lg"></i> Presupuesto'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/budget.php?token='+token+'" class="w3-bar-item w3-button">Cuenta del proyecto</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-chart-line fa-lg"></i> Seguimiento'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/kardex.php?token='+token+'"  class="w3-bar-item w3-button">Ficha de avance</a>'+
		'<a href="../views/review.php?token='+token+'"  class="w3-bar-item w3-button">Revisión de información</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-chart-pie fa-lg"></i> Reportes'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/complete.php?token='+token+'" class="w3-bar-item w3-button">Extenso</a>'+
		'<a href="../views/report.php?token='+token+'" class="w3-bar-item w3-button">Ejecutivo</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-star fa-lg"></i> Evaluación'+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a href="../views/evaluate.php?token='+token+'" class="w3-bar-item w3-button">Cumplimiento</a>'+
		'</div>'+
		'</div>'+
		'<!--<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul" onclick="location.href = \'../business/bsnsLogout.php\';">'+
		'<i class="fas fa-sign-out-alt fa-lg"></i> Salir'+
		'</div>-->'+
		'<div class="w3-dropdown-hover w3-hide-small">'+
		'<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+
		'<i class="fas fa-sign-out-alt fa-lg"></i> '+user+''+
		'</div>'+
		'<div class="w3-dropdown-content w3-bar-block caran-azul w3-card-4">'+
		'<a class="w3-bar-item w3-button">'+pfl+'</a>'+
		'<a href="../business/bsnsLogout.php" class="w3-bar-item w3-button">Salir</a>'+
		'</div>'+
		'</div>'+
		'<!--<div class="w3-section w3-bar-item w3-hide-small w3-button caran-hover-azul">'+user+' - <span>'+pfl+'</span></div>-->'+
		'</div>'+


		'<div id="navDemo" class="w3-bar-block w3-hide w3-indigo w3-hide-large w3-hide-medium w3-large">'+
		'<a href="../views/home.php" class="w3-bar-item w3-button caran-hover-azul w3-indigo">Inicio</a>'+
		'<!--<a href="../views/proj.php" class="w3-bar-item w3-button caran-hover-azul w3-indigo">Proyectos</a>-->'+
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">Banco de proyectos</button>'+
		'<div class="w3-dropdown-content w3-bar-block w3-card-4">'+
		'<a href="../views/bank.php?token='+token+'" class="w3-bar-item w3-button">Mis proyectos</a>'+
		'<a href="../views/new.php?token='+token+'" class="w3-bar-item w3-button">Nuevo</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">Involucrados</button>'+
		'<div class="w3-dropdown-content w3-bar-block w3-card-4">'+
		'<a href="../views/people.php?token='+token+'" class="w3-bar-item w3-button">Análisis</a>'+
		'</div>'+
		'</div>'+
		/*'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">AP /AO</button>'+
		'<div class="w3-dropdown-content w3-bar-block w3-card-4">'+
		'<a href="../views/pt.php?token='+token+'" class="w3-bar-item w3-button">Árbol de problemas</a>'+
		'<a href="../views/ot.php?token='+token+'" class="w3-bar-item w3-button">Árbol de objetivos</a>'+
		'</div>'+
		'</div>'+*/
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">Planeación y programación</button>'+
		'<div class="w3-dropdown-content w3-bar-block w3-card-4">'+
		'<a href="../views/mml.php?token='+token+'" class="w3-bar-item w3-button">Matríz de indicadores</a>'+
		'<a href="../views/sche.php?token='+token+'" class="w3-bar-item w3-button">Calendario</a>'+
		'<!--<a class="w3-bar-item w3-button">Entregables</a>-->'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">Presupuesto</button>'+
		'<div class="w3-dropdown-content w3-bar-block w3-card-4">'+
		'<a href="../views/budget.php?token='+token+'" class="w3-bar-item w3-button">Cuenta del proyecto</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">Seguimiento</button>'+
		'<div class="w3-dropdown-content w3-bar-block w3-card-4">'+
		'<a href="../views/kardex.php?token='+token+'" class="w3-bar-item w3-button">Ficha de avance</a>'+
		'<a href="../views/review.php?token='+token+'" class="w3-bar-item w3-button">Revisión de información</a>'+
		'<!--<a class="w3-bar-item w3-button">Indicadores de actividad</a>-->'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">Reportes</button>'+
		'<div class="w3-dropdown-content w3-bar-block caran-hover-azul w3-card-4">'+
		'<a href="../views/complete.php?token='+token+'" class="w3-bar-item w3-button">Extenso</a>'+
		'<a href="../views/report.php?token='+token+'" class="w3-bar-item w3-button">Ejecutivo</a>'+
		'<!--<a class="w3-bar-item w3-button">Indicadores</a>-->'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">Evaluación</button>'+
		'<div class="w3-dropdown-content w3-bar-block caran-hover-azul w3-card-4">'+
		'<a href="../views/evaluate.php?token='+token+'" class="w3-bar-item w3-button">Cumplimiento</a>'+
		'</div>'+
		'</div>'+
		'<div class="w3-dropdown-hover">'+
		'<button class="w3-button caran-hover-azul">'+user+'</button>'+
		'<div class="w3-dropdown-content w3-bar-block caran-hover-azul w3-card-4">'+
		'<a class="w3-bar-item w3-button">'+pfl+'</a>'+
		'<a class="w3-bar-item w3-button">Salir</a>'+
		'</div>'+
		'</div>'+
		'<!--<a href="../business/bsnsLogout.php" class="w3-bar-item w3-button caran-hover-azul w3-indigo">Salir</a>'+
		'<a href="#" class="w3-bar-item w3-button caran-hover-azul w3-indigo">'+user+' - <span>'+pfl+'</span></a>-->'+
		'</div>';
		domHeader.empty();
        var items = [];
		items.push(sr);
		domHeader.append( items.join('') );

		domFooter.empty();
        items = [];
        items.push('<div class="w3-xxlarge w3-padding-8" ><a href="https://es-la.facebook.com/CaranSolucionesEstrategicasSc/" target="_blank"><i class="fab fa-facebook w3-hover-opacity"></i></a><a href="https://www.youtube.com/channel/UCKtSk4s3jXwqnUZ3M0lhwhA" target="_blank"> <i class="fab fa-youtube w3-hover-opacity"></i> </a><a href="https://caran.com.mx/" target="_blank"><i class="fab fa-internet-explorer w3-hover-opacity""></i></a></div><p><a href="https://caran.com.mx/" target="_blank">CARAN Soluciones Estratégicas S.C.</a></p>');
		domFooter.append( items.join('') );

		domBreadcrumbs.empty();
        items = [];
		items.push('<ul class="breadcrumb">');
		$.each(JSON.parse(json), function() {
        items.push('<li><a href="#">'+this.n+'</a></li>');
		});
		items.push('</ul>');
		domBreadcrumbs.append( items.join('') );
	};

jsResources.prototype.ShowDOM = function(document)
	{
		 var x = document;
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
	};

jsResources.prototype.UListPopulate = function(domComponent, strJson)
	{
		domComponent.empty();
		var items = [];
		$.each(jQuery.parseJSON(strJson), function() {
			items.push('<li value="' + this.Code + '" class="list-group-item ui-widget-content">' + this.Name + '</li>');
		});
		domComponent.append( items.join('') );

	};

jsResources.prototype.ImageGalleryPopulate = function(domComponent, strJson)
	{
		domComponent.empty();
		var items = [];
		var sr = '';
		var json = jQuery.parseJSON(strJson);
		items.push('<div>');
		$.each(json, function(i,v) {
				if(sr != v.L7)
				{
					items.push('</div>');
					items.push('<hr>');
					//items.push('<div class="w3-row"><div class="w3-half w3-container">');

					items.push('<div class="w3-section"><label>Evidencia digital: <span class="w3-text-indigo">'+v.L7+'</span></label><label class="w3-text-white">DEES</label><button onclick="myModalCall2(\''+v.L6+'\',\''+v.L4+'\',\''+v.L9+'\',\''+v.L8+'\',\''+v.L7+'\');" class="w3-button caran-verde">Ver más ...</button>');
					items.push('<label class="w3-text-white">DEES</label><button onclick="myModalCall1(\''+v.L7+'\');" class="w3-button caran-rojo-h">Agregar comentario</button></div>');
					items.push('<div class="w3-section"><label>Indicador a evaluar: <span class="w3-text-indigo">'+v.L4+' - '+v.L6+'</span></label></div>');
					items.push('<div class="w3-section"><label class="w3-text-white">DEES</label><label>Fecha de entrega: <span class="w3-text-indigo">'+v.L8+'</span></label>');
					items.push('<label class="w3-text-white">DEES</label><label>Avance: <span class="w3-text-indigo">'+v.L3+' de '+v.L5+' ['+v.L9+']</span></label></div>');
					items.push('<div class="w3-section"><label>Descripción: <span class="w3-text-indigo">'+v.L2+'</span></label></div>');
					//items.push('<div class="w3-section"><label>Asesor: <span id="lbl_'+v.L7+'" class="w3-text-indigo">'+v.L10+'</span></label></div>');
					sr = v.L7;


					//items.push('</div><div class="w3-half w3-container">');
					//items.push('<div id="div'+v.L7+'" style="min-width: 150px; height: 100px;"></div>');
					//items.push(' </div></div>');

					items.push('<div class="w3-section">');
				}
				if(v.L12 == 'jpg' || v.L12 == 'JPG' || v.L12 == 'png' || v.L12 == 'PNG')
				{
					items.push('<img src="'+v.L0+'" alt="'+v.L1+'" style="width:10%;height:auto;" />');
				}
				else
				{
					items.push('<a class="linkList" href="'+v.L0+'" target="_blank">'+v.L1+'</a><label class="w3-text-white">DEES</label>');
				}
			});
		domComponent.append( items.join('') );
	};


jsResources.prototype.LinkListPopulate = function(domComponent, strJson)
	{
		domComponent.empty();
		var items = [];
		$.each(jQuery.parseJSON(strJson), function() {
			items.push('<a class="linkList" href="' + this.L1 + '" target="_blank">' + this.L2 + '</a><br><br>');
		});
		domComponent.append( items.join('') );

	};


jsResources.prototype.ImageGallerySliderPopulate = function(domComponent, strJson, objImageGallery)
	{

		domComponent.empty();
		var items = [];
		items.push('<div class="container">');
		var json = jQuery.parseJSON(strJson);
		$.each(json, function(k) {
			k++;
			items.push('<div class="mySlides">');
			items.push('<div class="numbertext">'+k+' / '+json.length+'</div>');
			items.push('<img src="' + this.L1 + '" style="width:100%"  alt="'+this.L2+'"/>');
			items.push('</div>');
		});

		items.push('<a class="prev w3-indigo" onclick="objImageGallery.plusSlides(-1);">&#10094;</a><a class="next w3-indigo" onclick="objImageGallery.plusSlides(1);">&#10095;</a><br>');

		items.push('<div class="row w3-light-grey">');
		$.each(jQuery.parseJSON(strJson), function(k) {
			k++;
			items.push('<div class="column">');
			items.push('<img class="demoImage cursor" src="' + this.L1 + '" style="width:100%" onclick="objImageGallery.currentSlide('+k+')" alt="' + this.L2 + '">');
			items.push('</div>');
		});
		items.push('</div>');

		items.push('</div>');
		domComponent.append( items.join('') );
		objImageGallery.showSlides(1);
	};
jsResources.prototype.ComboPopulate = function(domComponent, strJson)
	{
		domComponent.empty();
		var items = [];
		items.push('<option value="0" disabled selected>Elige una opción</option>');
		$.each(jQuery.parseJSON(strJson), function() {
			items.push('<option value="' + this.code +'">' + this.data + ' - ' + this.b6 + '</option>');
			//items.push('<option value="' + this.code +'">' + this.data + ' - ' + this.b6 + ' - '+ this.code + '</option>');
		});
		domComponent.append( items.join('') );
	};

jsResources.prototype.ListAvatarPopulate = function(domComponent, strJson)
	{
		domComponent.empty();
		var items = [];
		//
		$.each(jQuery.parseJSON(strJson), function() {
			/*items.push('<li>'+this.key+' , '+this.value+'</li>');*/
			items.push('<li class="w3-bar">'+
                    '<span onclick="this.parentElement.style.display=\'none\';unsetMarker(\''+this.mkr+'\', \''+this.id+'\');" class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×</span>'+
					'<i class="fas fa-map-marker-alt fa-3x w3-text-red w3-margin w3-bar-item w3-hide-small"></i>'+
                    '<div class="w3-bar-item">'+
					'<span>'+this.addr+'</span><br>'+
					'<!--<span>'+this.lat+','+this.lng+'</span></div>-->'+
                   '</li>');
		});
		domComponent.append( items.join('') );
	};

jsResources.prototype.ListProjectPopulate = function(domComponent, strJson, token)
	{
		domComponent.empty();
		var items = [];
		var json = jQuery.parseJSON(strJson);
		var sr = '';
		$.each(json,function(i,v){
			if(sr != json[i].b6)
			{
				console.log('inicio: ' + json[i].b6 +','+ i);
				items.push('<ul class="w3-ul w3-card-4">');
				items.push('<li class="w3-bar caran-verde"><p class="w3-large">Gerente de proyecto: '+this.b6+'</p></i>');
				sr = json[i].b6;
			}
				items.push('<li class="w3-bar">'
                    +'<!--<span onclick="this.parentElement.style.display=\'none\';" class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×</span>-->'
					+'<div class="w3-section w3-right">'
					+'<div class="tooltipBottom">'
                +'<i class="fas fa-unlock-alt fa-3x caran-text-rojo-full w3-margin w3-hover-opacity"></i>'
                +'<span class="tooltiptextBottom">Proyecto en curso</span>'
                +'</div>'
				 +'<div class="tooltipBottom">'
                +'<i class="fab fa-product-hunt fa-3x caran-text-azul-full w3-margin w3-hover-opacity"></i>'
                +'<span class="tooltiptextBottom">'+this.b4+' participa en este proyecto</span>'
                +'</div>'
				+'<div class="tooltipBottom">'
                +'<i class="far fa-calendar-alt fa-3x w3-text-orange w3-margin w3-hover-opacity"></i>'
                +'<span class="tooltiptextBottom">Proyecto calendarizado</span>'
                +'</div>'
				+'<div class="tooltipBottom">'
                +'<i class="fas fa-crosshairs fa-3x caran-text-deep w3-margin w3-hover-opacity"></i>'
                +'<span class="tooltiptextBottom">Proyecto supervisado por '+this.b7+'</span>'
                +'</div>'
					+'</div>'
                    +'<div class="w3-bar-item">'
					+'<!--<p class="w3-large">Gerente: <span>'+this.b6+'</span></p>-->'
					+'<p class="w3-large">Proyecto: <span>'+this.data+'</span></p>'
					+'<p class="w3-large">Justificación: <span>'+this.b1+'</span></p>'
					+'<p class="w3-large">Problematica: <span>'+this.b2+'</span></p>'
					+'<p class="w3-large">Objetivo: <span>'+this.b3+'</span></p>'
					+'<div class="w3-section">'
					+'<button class="w3-button w3-flat-turquoise w3-margin" onclick="location.href=\'edit.php?token='+token+'&uid='+this.code+'\';">Editar</button>'
					+'<!--<button class="w3-button w3-flat-nephritis w3-margin">Reportes</button>-->'
					+'</div>'
					+'</div>'
                   +'</li>');

			if(i < json.length)
			{
				if(json[i+1])
				{
					var next = json[i+1].b6;
					if(next != sr)
					{
						items.push('</ul><br>');
						//console.log('fin: ' + json[i].b6 +', next: '+ next  +'-------'+ i);
					}
					else
					{
						//console.log('son iguales next y sr');
					}
				}
				else
				{
					items.push('</ul>');
					//console.log('ultimo: ' + json[i].b6 +'-------'+ i);
					//console.log('no existe next');
				}
			}
			else
			{
				//console.log('false: '+ i + '----' + json.length);
			}
		});
		domComponent.append( items.join('') );
	};

jsResources.prototype.ListEviCompletePopulate = function(domComponent, strJson)
	{
		domComponent.empty();
		var items = [];
		var arr1 = JSON.parse(strJson);
		var arr2 = new Array(Object.keys(arr1).length);
		var arr3 = [];
		var iIndex = 0;
		//var arr4 = new Array(Object.keys(arr1).length);
		for(var i =0 ; i<Object.keys(arr1).length; i++)
		{
			arr2[i]= arr1[i].L17;
		}
		var uniqueNames = [];
		var uniqueRN = [];
		$.each(arr2, function(j, v){
			if($.inArray(v, uniqueNames) === -1)
			{
				var arr = {};
				uniqueNames.push(v);
				uniqueRN.push(arr1[j].L5);
				arr.L6 = arr1[j].L6;
				arr.L7 = arr1[j].L7;
				arr.L8 = arr1[j].L8;
				arr.L9 = arr1[j].L9;
				arr.L10 = arr1[j].L10;
				arr.L11 = arr1[j].L11;
				arr.L12 = arr1[j].L12;
				arr.L13 = arr1[j].L13;
				arr.L14 = arr1[j].L14;
				arr.L15 = arr1[j].L15;

				arr.L16 = arr1[j].L16;
				arr.L17 = arr1[j].L17;

				arr.L18 = arr1[j].L18;
				arr.L19 = arr1[j].L19;
				arr.L20 = arr1[j].L20;
				arr.L21 = arr1[j].L21;
				arr.L22 = arr1[j].L22;
				arr.L23 = arr1[j].L23;
				arr.L24 = arr1[j].L24;
				arr.L25 = arr1[j].L25;
				arr.L27 = arr1[j].L27;
				arr.L28 = arr1[j].L28;
				arr3.push(arr);
			}
		});
		//alert(JSON.stringify(arr3));
		//datos del proyecto
		items.push('<div class="w3-container">');
		items.push('<div class="w3-card-2">');
		items.push('<header class="w3-container w3-center" style="color:#0288D1"><h2>'+arr3[0].L18.toUpperCase()+'</h2><label>por</label><h3>'+arr3[0].L28.toUpperCase()+'</h3></header>');
		items.push('<div class="w3-container w3-left w3-large">');
		items.push('<p>Problema detectado: <span class="w3-text-indigo">'+arr3[0].L19+'</span></p>');
		items.push('<p>Justificación de la intervención: <span class="w3-text-indigo">'+arr3[0].L20+'</span></p>');
		items.push('<p>Objectivo del proyecto: <span class="w3-text-indigo">'+arr3[0].L21+'</span></p>');
		items.push('</div>');
		items.push('<div class="w3-row w3-center">');
		items.push('<div class="w3-container w3-quarter">');
		items.push('<p><img alt="mujeres" src="../images/_venus.png" /></p>');
		items.push('<p><span class="w3-text-indigo w3-large">'+arr3[0].L24+'</span></p>');
		items.push('</div>');
		items.push('<div class="w3-container w3-quarter">');
		items.push('<p><img alt="hombres" src="../images/_mars.png" /></p>');
		items.push('<p><span class="w3-text-indigo w3-large">'+arr3[0].L23+'</span></p>');
		items.push('</div>');
		items.push('<div class="w3-container w3-quarter">');
		items.push('<p><img alt="mas info" src="../images/_3d.png" /></p>');
		items.push('<p><span class="w3-text-indigo w3-large">'+arr3[0].L22+'</span></p>');
		items.push('</div>');
		items.push('<div class="w3-container w3-quarter">');
		items.push('<p><img alt="supervisor" src="../images/_hand_1.png" /></p>');
		items.push('<p><span class="w3-text-indigo w3-large">'+arr3[0].L27+'</span></p>');
		items.push('</div>');
		items.push('</div>');
		items.push('<div class="w3-row">');
		items.push('<div style="width: 100%; height: 400px;" id="arg9"></div>');
		items.push('</div>');
		items.push('<footer class="w3-container"></footer>');
		items.push('</div><hr>');

		for(var k=0; k<uniqueNames.length; k++)//nombre del indicador
		{
			iIndex = 0;
			items.push('<div class="w3-card-4">');
			items.push('<header class="w3-container w3-light-gray"><br>');
			items.push('<img src="../images/_cube_5.png" alt="descripción del indicador" class="w3-left  w3-margin-right" /><br>');
			items.push('<h3>'+uniqueNames[k].toUpperCase()+' - '+uniqueRN[k].toUpperCase()+'</h3>');
			items.push('<p>Resumen narrativo: <span class="w3-text-indigo">'+arr3[k].L6+'</span></p>');
			items.push('<p>Metodo de cálculo: <span class="w3-text-indigo">'+arr3[k].L7+'</span></p>');
			items.push('<p>Unidad de medición: <span class="w3-text-indigo">'+arr3[k].L16+'</span></p>');
			items.push('<div class="w3-section"><label>Cadena de resultados: <span class="w3-text-indigo">'+arr3[k].L8+'</span></label><label class="w3-text-light-gray">DEES</label>');
			items.push('<label>Dimensión: <span class="w3-text-indigo">'+arr3[k].L12+'</span></label><label class="w3-text-light-gray">DEES</label>');
			items.push('<label>Frecuencia de medición: <span class="w3-text-indigo">'+arr3[k].L15+'</span></label></div>');
			items.push('<p>Fuentes de verificación: <span class="w3-text-indigo">'+arr3[k].L9+'</span></p>');
			items.push('<p>Supuestos: <span class="w3-text-indigo">'+arr3[k].L10+'</span></p>');

			items.push('</header>');

			for(var l=0; l<Object.keys(arr1).length; l++)//evidencias
			{
				if(uniqueNames[k] == arr1[l].L17){

						items.push('<div class="w3-row">');
						items.push('<div class="w3-container w3-half">');
						items.push('<h4>Fecha de reporte: <span class="w3-text-indigo">'+arr1[l].L26+'</span></h4>');
						items.push('<img src="../images/_cube_2.png" alt="descripción de las evidencias" class="w3-left w3-margin-right" /><br>');
						items.push('<p>Descripción de las evidencias: <span class="w3-text-indigo">'+arr1[l].L2+'</span></p>');
						items.push('<img src="../images/_cube_3.png" alt="comentario del asesor" class="w3-left w3-margin-right" /><br>');
						items.push('<p>Comentario del asesor: <span class="w3-text-indigo">'+arr1[l].L3+'</span></p>');
						items.push('</div>');
						items.push('<div class="w3-container w3-half">');
						items.push('<h5>Evidencia no: <span class="w3-text-indigo">'+iIndex+'</span></h5>');

						//if(iIndex <Object.keys(arr1).length){

						//items.push('<a href="'+arr1[l].L29+'">'+arr1[l].L30+'</a>');
						//items.push('<img alt="'+arr1[l].L30+'" src="'+arr1[l].L29+'" style="width:80%;height:auto;"   /><br>');
						//items.push('<p>Fecha de reporte: <span class="w3-text-indigo">'+arr1[l].L26+'</span></p>');
						/*items.push('<img alt="ver evindencias" src="../images/_cube_4.png" class="w3-left  w3-margin-right"  /><br>');
						items.push('<p>Periodo: <span class="w3-text-indigo">'+arr1[l].L15+'</span></p>');*/
						//}

						if(arr1[l].L31 == 'jpg' || arr1[l].L31 == 'JPG' || arr1[l].L31 == 'png' || arr1[l].L31 == 'PNG'){
							items.push('<img alt="'+arr1[l].L30+'" src="'+arr1[l].L29+'" style="width:80%;height:auto;"   /><br>');
						}
						else
						{
							items.push('<a class="linkList" href="' + arr1[l].L29 + '" target="_blank">'+arr1[l].L30+'</a>');
						}
						items.push('</div>');
						items.push('</div>');
						items.push('<hr>');
						iIndex++;
				}
			}
			items.push('<button class="w3-button w3-block w3-indigo w3-large">Reporte revisado por '+arr3[0].L27+' &#10004</button>');
			items.push('</div>');
			items.push('<br>');
		}
		items.push('</div>');
		domComponent.append( items.join('') );
		var map = initMap();
		setAddr(map, arr3[0].L25);
	};
};
