
<div id="chart2" style="width: 25%; margin: 50px auto;"></div>
<div id="chart1" style="width: auto; margin: auto 50px"></div>
<div id="chart3" style="width: 50%; margin: 50px auto;"></div>

<div><span>You Clicked: </span><span id="info1">Nothing yet</span></div>
<script type="text/javascript">
//graf porovnavajici prijmy a vydaje podle kategorii
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
          var CelkoveVydaje = [<?php echo $celkoveVydaje;?>];
          var Kategorie = [<?php echo $kategorie;?>];
         
          plot1 = $.jqplot('chart1', [CelkoveVydaje], {//        
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {  fillToZero: true,
                                    varyBarColor: true//,
                                    //barWidth: 30
                                 },
                pointLabels: { show: true }
            },

            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: Kategorie
                }
            },
            highlighter: { show: false },
            title: 'Celkové příjmy a výdaje za jednotlivé kategorie'
        });
     
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
</script>

<script type="text/javascript">
//graf porovnavajici prijmy a vydaje celkem
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
          var CelkoveVydaje = [<?php echo $sumPrijmy .", " . $sumVydaje;?>];
          var vydaje_prijmy = [<?php echo $vydaje_prijmy;?>];
         
          plot1 = $.jqplot('chart2', [CelkoveVydaje], {//        
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesColors:['green', 'red'],
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {  fillToZero: true, 
                                    varyBarColor: true//,
                                    //barWidth: 30
                                 },
                pointLabels: { show: true }
            },
            
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: vydaje_prijmy
                }
            },
            highlighter: { show: false },
            title: 'Porovnání příjmů a výdajů'
        });
     
        $('#chart2').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
    
</script>

<script type="text/javascript">
//graf porovnavajici obalky s limitama
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
          var vydajeZaObalky = [<?php echo $vydajeZaObalky;?>];
          var obalky = [<?php echo $obalky;?>];
          var limity = [<?php echo $limity;?>];
          
         
          plot1 = $.jqplot('chart3', [vydajeZaObalky,limity], {//        
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {  fillToZero: true,
                                    varyBarColor: true//,
                                    //barWidth: 30
                                 },
                pointLabels: { show: true }
            },
            //tady musis jeste udelat v seriesColors php echo a red tam bude tolikrat, kolik mam obalek - spachat v controleru
            //series: [{seriesColors: []},{seriesColors: ['red', 'red', 'red']}],
            series: [{seriesColors: []},{seriesColors: [<?php echo $red; ?>]}],
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: obalky
                }
            },
            highlighter: { show: false },
            title: 'Výdaje za obálku vs. limit obálky'
        });
     
        $('#chart3').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
    
</script>


<br><br>
admin@admin.com 
<br>
12345678