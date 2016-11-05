<div class="err">
    <div class="msg">
        <?php echo $err['message']; ?>
    </div>
    <button onclick="goBack()" class="back">
        Zpět
    </button>
</div>
<script>
function goBack() {
    window.history.back();
}
</script>