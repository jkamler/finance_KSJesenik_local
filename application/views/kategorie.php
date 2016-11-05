        <!--removing value from input form-->        
        <script>
            function changeValue(value, myid) {
                document.getElementById(myid).value = value;
            }
        </script>
        

        <div class="table">
            <div class="tr" id="head">
                <span class="td">Kategorie výdajů</span>
                <span class="td">Edit</span>
            </div>
            <?php foreach ($res as $item) { ?>
            <div class="tr">
                <span class="td"> <?php echo $item['kategorie'];?></span>
                <span class="td"> <?php echo "<a onClick=\"javascript: return confirm('Opravdu smazat?');\" href='delete_kategorie?id=" . $item['id_kat'] . "'>X </a><a href='update_kategorie_load_form?id=" . $item['id_kat'] . "&kategorie=".$item['kategorie']."'>E</a>"; ?></span>
            </div>
            <?php } ?>
            <form class="tr" action="/code/edit/insert_kategorie" method="get">
                <span class="td"> 
                    <input type="text" onclick="changeValue('', 'kategorieid')" id="kategorieid" data-validation="length" data-validation-length="1-50" name="kategorie" value="Nový název kategorie">
                </span>
                <span class="td"> 
                    <input type="submit" value="Vlož">
                </span>
            </form>          
        </div>