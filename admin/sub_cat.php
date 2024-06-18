
<!-- <style>
    h3{
        background-color:black;
        color:white;
        margin-bottom: 1rem;
    }
    select{
        width: 100%;
        height:30px;
         padding:0.3rem;
        outline: none;
        margin-bottom: 3px;
    }
    .add{
        width: 70%;
        margin: auto;
        padding:5px;
        border:1px solid black;    
    }
    .add details summary{
        cursor:pointer;
        text-align: center;
        width: 100%;
        height: 30px;
        outline: none;
    }
    .add details form{
        background-color:black;
        padding:1rem;
    }
    .add details form input{
        width: 100%;
        height:30px;
        padding:1rem;
        outline: none;
    }
    #addCatBtn{
        align:center;
        background-color: #ABABAB ;
        padding: 0.3rem;
        margin-top: 5px;
        font-family:'inter','poppins','roboto';
        border-radius: 7px;
        font-weight: normal;
        color:white;
        cursor: pointer;
    }
    #addCatBtn:hover{
        background-color: #3162DF;
    }
    .editsubCatForm{
        width:60%;
        margin: auto;
        padding:5px;
        border:1px solid black;
        background-color: black;
    }
    .editsubCatForm input{
        width:100%;
        margin:auto;
        outline: none;
       
        padding-bottom: 0.5rem;
        margin-top: 10px;
        margin-bottom: 10px;
        
    }

</style> -->
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

