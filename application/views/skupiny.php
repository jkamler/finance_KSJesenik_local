        <!--removing value from input form-->        
        <script>
            function changeValue(value, myid) {
                document.getElementById(myid).value = value;
            }
        </script>

        <div class="table">
            <div class="tr" id="head">
                <span class="td">Název obálky</span>
                <span class="td">Limit</span>
                <span class="td">Popis</span>
                <span class="td">Edit</span>
            </div>
            <!--vypis polozek-->
            <?php foreach ($res as $item) { ?>
            <div class="tr">
                <span class="td"> <?php echo $item['skupina'];?></span>
                <span class="td"> <?php echo $item['limit_skup'];?></span>
                <span class="td"> <?php echo $item['popis'];?></span>
                <span class="td"> <?php echo "<a onClick=\"javascript: return confirm('Opravdu smazat?');\" href='delete_skupina?id=" . $item['id_skup'] . "'>X </a><a href='update_obalka_load_form?id=" . $item['id_skup'] . "&skupina=".$item['skupina']. "&limit_skup=".$item['limit_skup']. "&popis=".$item['popis']."'>E</a>"; ?></span>
            </div>
            <?php } ?>
            <!--formular pro vlozeni novych dat-->
            <form class="tr" action="/code/edit/insert_skupina" method="get">
                    <span class="td"><input type="text" onclick="changeValue('', 'skupinaid')" id="skupinaid" data-validation="length" data-validation-length="1-50" name="skupina" value="Nový název obálky"></span>
                    <span class="td"><input type="text" onclick="changeValue('', 'limit_skupid')" id="limit_skupid" data-validation="number" data-validation-allowing="negative" data-validation-decimal-separator="." name="limit_skup" value="0"></span>
                    <span class="td"><input type="text" onclick="changeValue('', 'popisid')" id="popisid" data-validation="length" data-validation-length="1-50" name="popis" value="Popis obálky"></span>
                    <span class="td"><input type="submit" value="Vlož"></span>
            </form>          
        </div>