<?php
//        echo count($kat_skup);
//        var_dump($kat_skup); 
//        echo "<br>";
//        echo $kat_skup[0]['id_kat'];
        
?>
        <div class="table">
            <div class="tr" id="head">
                <span class="td">Kategorie</span>
                <span class="td">Obálka</span>
            </div>
            <?php foreach ($kat as $item) { ?>
            <form class="tr" action="/code/edit/update_prirazeni" method="get">
                <span class="td"> <?php if ($item['id_kat'] == NULL) { echo "Bez kategorie - chyba";} else {echo $item['kategorie'];}; ?></span>
                <input type="hidden" name="id_kat" value="<?php echo $item['id_kat'] ?>">
                <span class="td">
                    <select name="id_skup">
                    <?php foreach ($skup as $s) { ?>
                        <?php 
                        $selected = 0;
                        for ($i = 0; $i < count($kat_skup); $i++) { 
                            //pokud mam shodu v ciselnicich a vazebni tabulce, tak musim vybrat danou polozku
                            if ($kat_skup[$i]['id_skup'] === $s['id_skup'] && $kat_skup[$i]['id_kat'] === $item['id_kat']) {
                                $selected = 1;
                                break;
                            }
                        }    
                        ?>
                        <option value="<?php echo $s['id_skup']; ?>"<?php if ($selected) {echo " selected";} ?> > <?php echo $s['skupina'];?></option>
                        <?php //} ?>
                            
                    <?php } ?>
                    </select>
                </span>
                <span class="td"><input type="submit" value="Ulož"></span>
            </form>          
            <?php } ?>
        </div>