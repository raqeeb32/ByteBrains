
<div id="bodyRight">
    <?php
    if (isset($_GET['edit_term'])) {
        echo edit_term();
       } else {
        ?>
        <h3> view all T&C</h3>
        <div class="add" style="width:90%">
            <details>
                <summary>Add new T&C </summary>
                <form class="addCatForm" method="post" enctype="multipart/form-data">
                    <select name="for_whome" required>
                        <option value="">Select Term for</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                    <input type="text" name="term" placeholder="Enter Term">
                    <center><button id="addCatBtn" name="add_term">Add T&C </button></center>
                </form>
            </details>
            <div>
                <table class="cat_display_table" cellspacing="0">
                    <thead>
                        <th>Sl No.</th>
                        <th>Terms</td>
                        <th>For</td>
                        <th>Action</td>
                    </thead>
                    <tbody>
                        <?php view_terms(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php echo add_term();
    } ?>