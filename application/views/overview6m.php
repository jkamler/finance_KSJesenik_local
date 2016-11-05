<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="http://localhost/code/jqplot/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/code/jqplot/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/code/jqplot/jquery.jqplot.css" />
<script language="javascript" type="text/javascript" src="http://localhost/code/jqplot/plugins/jqplot.categoryAxisRenderer.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/code/jqplot/plugins/jqplot.barRenderer.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/code/jqplot/plugins/jqplot.pointLabels.js"></script>

<div id="chart2" style="width: 25%; margin: 50px auto;"></div>
<div id="chart1" style="width: auto; margin: auto 50px"></div>
jeste neni
<!--div><span>You Clicked: </span><span id="info1">Nothing yet</span></div-->
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
                                    varyBarColor: true },
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: Kategorie
                }
            },
            highlighter: { show: false },
            title: 'Cekové příjmy a výdaje za jednotlivé kategorie'
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
                                    varyBarColor: true },
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


<br>
admin@admin.com 
<br>
12345678