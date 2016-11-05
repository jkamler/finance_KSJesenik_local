    <script>
        $( function() {
          $( "#datepicker" ).datepicker();
          $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd");
          $( "#datepicker" ).val("<?php echo $this->input->get("datum_vz");?>")
        } );
    </script>
    <div class="table">
        <div class="tr" id="head">
            <span class="td">Suma</span>
            <span class="td">Datum vzniku</span>
            <span class="td">Popis</span>
            <span class="td">Kategorie</span>
            <span class="td"></span>
        </div>

        <form class="tr" action="/code/edit/update_polozka" method="get">
            <span class="td"><input type="text" name="polozka" data-validation="number" data-validation-allowing="float,negative" data-validation-decimal-separator="." value="<?php echo $this->input->get("polozka");?>"></span>
            <span class="td"><input id="datepicker" type="text" name="datum_vz" data-validation="date" data-validation-require-leading-zero="false" value="<?php echo $this->input->get("datum_vz");?>"></span>
            <span class="td"><input type="text" name="popis" data-validation="length" data-validation-length="1-50" value="<?php echo $this->input->get("popis");?>"></span>
            <span class="td">
            <select name="id_kat">
                <?php foreach ($kate as $k) { ?>
                <option value="<?php echo $k['id_kat']; echo '"';if ($this->input->get("id_kat") == $k['id_kat']) {echo ' selected';};?>> <?php echo $k['kategorie']?> </option>
                <?php } ?>
            </select>
            </span>
            <input type="hidden" name="id_pol" value="<?php echo $this->input->get("id_pol");?>">
            <span class="td"><input type="submit" value="Ulož"></span>
        </form>                  
    </div>
