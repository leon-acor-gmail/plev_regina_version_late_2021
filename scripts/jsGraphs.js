var jsGraphs = function () {

jsGraphs.prototype.grpMol1 = function(obj)
	{
        var pieColors = (function () {
            var colors = [];
            var base = Highcharts.getOptions().colors[4];
            
            for (var i = 0; i < 10; i += 1) {
                colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
            }
            return colors;
        }());

        Highcharts.chart('grpMol1', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                backgroundColor: null,
                type: 'pie'
            },
            title: {
                text: 'Proyectos de CARAN en el 2017'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    colors: pieColors,
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                        distance: -50,
                        filter: {
                            property: 'percentage',
                            operator: '>',
                            value: 4
                        }
                    }
                }
            },
            series: obj
        });
        
        };
        
jsGraphs.prototype.grpMol4 = function(obj, _title, _units, _date)
{
    var color1 = '#7CB342';
    var color2 = '#0D47A1';//'#FF3D00';
    var color3 = '#76FF03';
    var color4 = '#b71c1c';//'#4DB6AC';
    var arr1 = JSON.parse(obj);
    var arr3 = new Array(Object.keys(arr1).length);
    var arr2 = new Array(Object.keys(arr1).length);
    for(var i =0 ; i<Object.keys(arr1).length; i++)
    {
         var arr = {};
         
        arr.y = parseInt(arr1[i].y);
        arr.name = arr1[i].name;
        arr.color = color2;
        arr.borderColor = color2;
        if(arr.name == _date)
        {
            arr.color = color4;
            arr.borderColor = color4;
        }
        if(arr.y >= arr.meta)
        {
            arr.color = color1;
            arr.borderColor = color1;
        }
        arr3[i] = parseInt(arr1[i].meta);
        arr2[i] = arr;
    
    }
    Highcharts.chart('grpMol4', {
    title: {
        text: _title
    },

    xAxis: {
        type: 'category'
    },

    yAxis: {
        title: {
            text: _units
        }
    },

    legend: {
        enabled: false
    },

    tooltip: {
        pointFormat: '<b>{point.y}</b> ' + _units
    },

    series: [{
        type: 'waterfall',
        data:arr2,
        dataLabels: {
                enabled: true,
                formatter: function () {
                return /*Highcharts.numberFormat(this.y / 1, 0, ',')*/this.y + ' ' + _units;
                }
            }
        },
        {
        type:'line',
        name:'meta',
        data: arr3,
        lineColor: color3,
        marker: {
            lineWidth: 2,
            lineColor: color3,
            fillColor: 'white'
        }
        }
    ]
});
    
};
    
jsGraphs.prototype.grpMol2 = function(obj)
	{
       
       Highcharts.chart('grpMol2', {
            chart: {
                type: 'column',
                backgroundColor: null,
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15,
                    viewDistance: 25,
                    depth: 40
                }
            },
        
            title: {
                text: 'Participanción ciudadana por trimestre'
            },
        
            xAxis: {
                categories: ['ene-17', 'abr-17', 'jul-17', 'oct-17'],
                labels: {
                    skew3d: true,
                    style: {
                        fontSize: '16px'
                    }
                }
            },
        
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'participantes',
                    skew3d: true
                }
            },
        
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
            },
        
            plotOptions: {
                column: {
                    stacking: 'normal',
                    depth: 40
                }
            },
        
            series: obj
        });
       
        };
    
jsGraphs.prototype.grpMol3 = function(obj)
	{
        Highcharts.chart('grpMol3', {
        
            chart: {
                polar: true,
                type: 'line',
                backgroundColor: null
            },        
            title: {
                text: 'Desarrollo de habilidades de ciudadanas',
               
            },
            xAxis: {
                categories: ['Liderazgo', 'Responsabilidad', 'Trabajo en equipo', 'Atención en clases','Comprención de los talleres', 'Difusión'],
                tickmarkPlacement: 'on',
                lineWidth: 0
            },
            yAxis: {
                gridLineInterpolation: 'polygon',
                lineWidth: 0,
                min: 0,
                max: 45
            },
            tooltip: {
                shared: true,
                pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:.0f}%</b><br/>'
            },
            series: obj
        
        });
        
    };
};