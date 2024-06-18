<div class="right">
    <h3>My profile</h3>
    <div class="profile-img"><img style="width:100px;height:100px; border-radius:100%;    border:1px solid blue;
" src="<?php if(isset($stu_img)) echo $stu_img;?>" alt="<?php if(isset($stu_name)) echo $stu_name?>"></div>
    <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <label>Student Name</label>
                <input type="text" name="stud_name">
            </div>
            <div class="row">
                <label>Email</label>
                <input type="email" name="stud_email">
            </div>
            <div class="row">
                <label>Password</label>
                <input type="password" name="stud_pass">
            </div>
            <div class="row">
                <label>Profile photo</label>
                <input type="file" name="stud_Img">
            </div>
            <div class="btns">
                <button name="addStuBtn" id="addCourse">Update</button>

            </div>
         </form>
</div>