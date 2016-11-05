        <!--selecting date-->
        <script>
            $( function() {
              $( "#datepicker" ).datepicker();
              $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd");
              $( "#datepicker" ).datepicker( "setDate", "0");
            } );
        </script>

        <!--removing value from input form-->        
        <script>
            function changeValue(value, myid) {
                document.getElementById(myid).value = value;
            }
        </script>
        
        <div class="table">
            <div class="tr" id="head">
                <span class="td">Suma</span>
                <span class="td">Datum vzniku</span>
                <span class="td">Popis</span>
                <span class="td">Datum vložení</span>
                <span class="td">Kategorie</span>
                <span class="td">Edit</span>
            </div>
            <?php foreach ($res as $item) { ?>
            <div class="tr">
                <span class="td"><?php echo $item['polozka'];?></span>
                <span class="td"><?php echo $item['datum_vz'];?></span>
                <span class="td"><?php echo $item['popis'];?></span>
                <span class="td"><?php echo $item['datum_vl'];?></span>
                <span class="td"><?php echo $item['kategorie'];?></span>
                <span class="td"><?php echo "<a onClick=\"javascript: return confirm('Opravdu smazat?');\" href='/code/edit/delete_polozka?id=" . $item['id_pol'] . "'>X </a><a href='/code/edit/update_polozka_load_form?id_pol=" . $item['id_pol'] . "&polozka=".$item['polozka']."&datum_vz=".$item['datum_vz']."&popis=".$item['popis']."&id_kat=".$item['id_kat']."'>E</a>"; ?></span>
            </div>
            <?php } ?>
            <form class="tr" id="formular" action="/code/edit/insert_polozka" method="get">
                <span class="td"><input onclick="changeValue('', 'polozkaid')" id="polozkaid" data-validation="number" data-validation-allowing="float,negative" data-validation-decimal-separator="." type="text" name="polozka" value="0"></span>
                <span class="td"><input id="datepicker" type="text" name="datum_vz" data-validation="date" data-validation-require-leading-zero="false"></span>
                <span class="td"><input onclick="changeValue('', 'popisid')" id="popisid" type="text" name="popis" data-validation="length" data-validation-length="1-50" value="Popis operace"></span>
                <span class="td"><input type="text" name="datum_vl" value="Nyní" disabled></span>
                <!--span class="td"><input type="text" name="id_kat" value="kategorie-cislo/dropdown menu"></span-->
                <span class="td"><select name="id_kat">
                    <?php foreach ($kate as $k) { ?>
                            <option value="<?php echo $k['id_kat']?>"><?php echo $k['kategorie']?></option>
                    <?php } ?>
                </select>
                </span>
                <span class="td"><input type="submit" value="Ulož"></span>
            </form>          
            <a href="/code/edit/export_xlsx">Export do XLSX</a>
            
        </div>

