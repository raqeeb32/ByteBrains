

<div id="bodyRight">
    <?php
    if (isset($_GET['edit_cat'])) {
        echo edit_category();
       } else {
        ?>
        <h3> view all FAQ's</h3>
        <div class="add">
            <details>
                <summary style="width:20%">Add FAQs</summary>
                <form class="addCatForm" method="post" enctype="multipart/form-data">
                    <input type="text" name="qsn" placeholder="Enter Question">
                    <textarea name="ans"class="textarea" placeholder="Enter the answer"></textarea>
                    <center><button id="addCatBtn" name="add_faqs">Add FAQs </button></center>
                </form>
            </details>
        </div><br/>
       <?php echo view_faqs();?>
    </div>

    <?php echo add_faqs();
    } ?>