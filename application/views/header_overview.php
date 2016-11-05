<!doctype html>
<html>
    <head>
        <title>
            <?php echo $title;?>
        </title>
        <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="jqplot/excanvas.js"></script><![endif]-->
        <script language="javascript" type="text/javascript" src="jqplot/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="jqplot/jquery.jqplot.min.js"></script>
        <link rel="stylesheet" type="text/css" href="jqplot/jquery.jqplot.css" />
        <script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.categoryAxisRenderer.js"></script>
        <script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.barRenderer.js"></script>
        <script language="javascript" type="text/javascript" src="jqplot/plugins/jqplot.pointLabels.js"></script>
        
    </head>
    <body>
        <div class="prihlaseni">
            <ul>
                <li>
                    <a href="/code/auth/login/">Přihlásit</a>
                </li>
            </ul>
        </div>
        <div class="rozsahy">        
            <ul>
                <li>
                    <a href="/code/">3 měsíce</a>
                </li>
                <li>
                    <a href="/code/overview/sestmesicu/">6 měsíců</a>
                </li>
                <li>
                    <a href="/code/overview/jedenrok/">1 rok</a>
                </li>
                <li>
                    <a href="/code/overview/dvaroky/">2 roky</a>
                </li>
            </ul>
        </div>
