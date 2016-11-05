        <div class="table">
            <div class="tr" id="head">
                <span class="td">Název</span>
                <span class="td">Limit</span>
                <span class="td">Popis</span>
            </div>
        
            <form class="tr" action="/code/edit/update_skupina" method="get">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <span class="td"><input type="text" data-validation="length" data-validation-length="1-50" name="skupina" value="<?php echo $skupina;?>"></span>
                <span class="td"><input type="text" data-validation="number" data-validation-allowing="negative" data-validation-decimal-separator="." name="limit_skup" value="<?php echo $limit_skup;?>"></span>
                <span class="td"><input type="text" data-validation="length" data-validation-length="1-50" name="popis" value="<?php echo $popis;?>"></span>
                <span class="td"><input type="submit" value="Ulož"></span>
            </form>                  
        </div>
