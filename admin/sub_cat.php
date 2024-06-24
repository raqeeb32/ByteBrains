
<div id="bodyRight">

<?php if(isset($_GET['edit_sub_cat'])){
echo edit_sub_category();
} else{ ?>
<h3> view all Sub categories</h3>
    <div class="add">
    <details>
        <summary>Add sub Category</summary>
        <form class="addCatForm" method="post" enctype="multipart/form-data">
            <select name="cat_id">
                <!-- <option value="">Select category</option> -->
                <?php echo select_cat() ?>
            </select>
            <input type="text" name="sub_cat_name" placeholder="Enter sub category name">
            <center><button id="addCatBtn" name="addsubcat">Add Category </button></center>
        </form>
    </details>
    <div>
    <table class="cat_display_table" cellspacing="0">
        <thead>
            <th>Sl No.</th>
            <th>Sub category name</td>
            <th>Master Category</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php view_sub_categories(); ?>
        </tbody>
    </table>
</div>
</div>
<?php } ?>

</div>
<?php
echo add_sub_category();
?>

