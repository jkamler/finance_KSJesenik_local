<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>      
        <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
        
        <!--musi to byt zkomentovany - pak ti nejede datepicker-->
        <!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script--> 
         
        <!--proc ti to nejede z localhostu?-->
        <!--link rel="stylesheet" href="jquery/jquery-ui.css">
        <script src="jquery/jquery-1.12.4.js"></script>
        <script src="jquery/jquery-ui.js"></script>
        <script src="form-validator/jquery.form-validator.min.js"></script>
        <link href="form-validator/theme-default.min.css" rel="stylesheet" type="text/css" /-->
 
        <!--TO DO-->
                <!--zbavit se prasackeho stylovani v dokumentu a pouzivat jako ostatni civilizovany lidi css-->
                <!--zprovoznit tahani scriptu z lokalu a nebyt zavisly na tretich stranach-->
                <!--nejak solidne nastylovat cely ten bordel-->
                <!--udelat opravdicke dotazy v prehledech - grafech pro dana obdobi + manualni vyber obdobi-->
                <!--udelat strankovani v ucetnictvi-->                
                <!--export ucetnictvi do XLSX-->
                <!--logovat zmeny - kdo co-->
                
        
        
        <style>
            DIV.table 
            {
                display:table;
            }
            DIV#head
            {
                font-weight: bold;
            }
            FORM.tr, DIV.tr
            {
                display:table-row;
            }
            SPAN.td
            {
                display:table-cell;
                padding-left: 10px;
            }
            DIV.tr:hover{
                text-decoration: underline;
            }
        </style>        
        <title>
            <?php echo $title;?>
        </title>
    </head>
    <body>
        <div class="wrapper">
            <div class="user">   
                <div>
                    <?php echo $user; ?>
                </div>
                <a href='/code/auth'>Administrace uživatelů</a>
                <a href='/code/auth/logout'>Odhlásit se</a>
            </div>

            <div class="menu">
                <ul>
                    <li>
                        <a href='/code/edit/index'>Účetnictví</a>
                    </li>
                    <li>
                        <a href='/code/edit/kategorie'>Editovat kategorie</a>
                    </li>
                    <li>
                        <a href='/code/edit/obalky'>Editovat obálky</a>
                    </li>
                    <li>
                        <a href='/code/edit/prirazeni'>Editovat přiřazení kategorií k obálkám</a>
                    </li>
                </ul>
            </div>

            <div class="heading">
                <h3>
                    <?php echo $title; ?>
                </h3>
            </div>

