
<div id="bodyRight">
    <?php
    if (isset($_GET['edit_lang'])) {
        echo edit_lang();;
       } else {
        ?>
        <h3> view all languages</h3>
        <div class="add">
            <details>
                <summary>Add language</summary>
                <form class="addlangForm" method="post" enctype="multipart/form-data">
                    <input type="text" name="lang_name" placeholder="Enter language name">
                    <center><button id="addlangBtn" name="addlang">Add language </button></center>
                </form>
            </details>
            <div>
                <table class="cat_display_table" cellspacing="0">
                    <thead>
                        <th>Sl No.</th>
                        <th>Language</td>
                        <th>Edit</td>
                        <th>Delete</td>
                    </thead>
                    <tbody>
                        <?php view_lang(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php echo add_lang();
    } ?>