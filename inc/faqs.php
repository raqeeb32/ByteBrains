<style>
      h2 {
        margin-bottom: 10px;
    }
</style>
<section>
    <div id="faqContainer">
        <h2>Frequently asked Questions</h2>
    <?php include ("inc/db_con.php");
    $get_faqs = $conn->prepare("SELECT * FROM faqs");
    $get_faqs->setFetchMode(PDO::FETCH_ASSOC);
    $get_faqs->execute();
    while ($row = $get_faqs->fetch()) {
    echo "
    <button class='accordion'>".$row['qsn']."</button>
    <div class='panel'>
        <p>".$row['ans']."</p>
    </div>
    ";
     } 
    ?>
    </div>

</section>
<script>
var acc = document.getElementsByClassName("accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>
