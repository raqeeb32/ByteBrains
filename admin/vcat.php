<div id="bodyRight">
    <?php
    if (isset($_GET['edit_cat'])) {
        echo edit_category();
       } else {
        ?>
        <h3> view all categories</h3>
        <div class="add">
            <details>
                <summary>Add Category</summary>
                <form class="addCatForm" method="post" enctype="multipart/form-data">
                    <input type="text" name="cat_name" placeholder="Enter category name">
                    <input type="text" name="cat_icon" placeholder="Enter category icon link ">
                    <center><button id="addCatBtn" name="addcat">Add Category </button></center>
                </form>
            </details>
            <div>
                <table class="cat_display_table" cellspacing="0">
                    <thead>
                        <th>Sl No.</th>
                        <th>Category name</th>
                        <th>Action</td>
                    </thead>
                    <tbody>
                        <?php view_categories(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php echo add_category();
    } ?>