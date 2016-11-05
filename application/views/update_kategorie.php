    <div class="table">
        <div class="tr" id="head">
            <span class="td">Kategorie</span>
        </div>

        <form  class="tr" action="/code/edit/update_kategorie" method="get">
            <span class="td"><input type="text" data-validation="length" data-validation-length="1-50" name="kategorie" value="<?php echo $kategorie;?>"></span>
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="submit" value="Ulož">
        </form>                  
    </div>
