<?php
function add_lang()
{
    include ("inc/db_con.php");

    if (isset($_POST["addlang"])) {
        $lang_name = $_POST["lang_name"];

        // Using prepared statement to avoid SQL injection
        $check = $conn->prepare("SELECT * FROM lang WHERE lang_name=?");
        $check->execute([$lang_name]);
        $count = $check->rowCount();

        if ($count > 0) {
            // Display error message
            echo "<script>alert('language already exists');</script>";
        } else {
            // Insert the new category
            $addlang = $conn->prepare("INSERT INTO lang (lang_name) VALUES (?)");
            if ($addlang->execute([$lang_name])) {
                // Display success message
                echo "<script>alert('Language added successfully');</script>";
            } else {
                // Display error message
                echo "<script>alert('Language could not added');</script>";
            }
        }
        // Redirect back to index.php
        echo "<script>window.open('index.php?lang','_self')</script>";
    }
}
function edit_lang()
{
    include ("inc/db_con.php");

    if (isset($_GET["edit_lang"])) {
        $id = $_GET["edit_lang"];

        $get_lang = $conn->prepare("SELECT * FROM lang WHERE lang_id=?");
        $get_lang->execute([$id]);
        $row = $get_lang->fetch(PDO::FETCH_ASSOC);

        echo "<h3>Edit language</h3>
        <form class='editLangForm' method='post' enctype='multipart/form-data'>
            <input type='text' name='l_name' value='" . htmlspecialchars($row['lang_name']) . "' placeholder='Enter language name'>
            <center><button id='addlangBtn' name='edit_lang'>Edit Language</button></center>
        </form>";

        if (isset($_POST["edit_lang"])) {
            $langname = $_POST["l_name"];

            $check = $conn->prepare("SELECT * FROM lang WHERE lang_name=? AND lang_id <> ?");
            $check->execute([$langname, $id]);
            $count = $check->rowCount();

            if ($count > 0) {
                echo "<script>alert('Language already exists');</script>";
            } else {
                $uplang = $conn->prepare("UPDATE lang SET lang_name=? WHERE lang_id=?");
                if ($uplang->execute([$langname, $id])) {
                    echo "<script>alert('Language updated successfully');</script>";
                } else {
                    echo "<script>alert('Language could not be updated');</script>";
                }
            }
            echo "<script>window.open('index.php?lang','_self')</script>";
        }
    }
}
function view_lang()
{
    include ("inc/db_con.php");
    $get_lang = $conn->prepare("SELECT * FROM lang");
    $get_lang->setFetchMode(PDO::FETCH_ASSOC);
    $get_lang->execute();
    $i = 1;
    while ($row = $get_lang->fetch()) {
        echo "<tr>
                    <td>" . $i++ . "</td>
                    <td>" . $row['lang_name'] . "</td>
                    <td><a href='index.php?lang&edit_lang=" . $row['lang_id'] . "' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a style='color:red' href='index.php?lang&del_lang=" . $row['lang_id'] . "'title='Delete'><i class='fa-solid fa-trash'></i></a></td>
             </tr>";
    }
    if (isset($_GET['del_lang'])) {
        $id = $_GET['del_lang'];
        $del = $conn->prepare("DELETE FROM lang WHERE lang_id=?");
        if ($del->execute([$id])) {
            echo "<script>alert('Language deleted successfully');</script>";
        } else {
            echo "<script>alert('Language could not be deleted');</script>";
        }
        echo "<script>window.open('index.php?lang','_self')</script>";
    }
}

function add_category()
{
    include ("inc/db_con.php");

    if (isset($_POST["addcat"])) {
        $catname = $_POST["cat_name"];
        $caticon = $_POST["cat_icon"];
        // Using prepared statement to avoid SQL injection
        $check = $conn->prepare("SELECT * FROM categories WHERE categoryName=?");
        $check->execute([$catname]);
        $count = $check->rowCount();

        if ($count > 0) {
            // Display error message
            echo "<script>alert('Category already exists');</script>";
        } else {
            // Insert the new category
            $addcategory = $conn->prepare("INSERT INTO categories (categoryName,cat_icon) VALUES (?,?)");
            if ($addcategory->execute([$catname, $caticon])) {
                // Display success message
                echo "<script>alert('Category added successfully');</script>";
            } else {
                // Display error message
                echo "<script>alert('Category not added');</script>";
            }
        }
        // Redirect back to index.php
        echo "<script>window.open('index.php?vcat','_self')</script>";
    }
}
function edit_category()
{
    include ("inc/db_con.php");

    if (isset($_GET["edit_cat"])) {
        $id = $_GET["edit_cat"];

        $get_cat = $conn->prepare("SELECT * FROM categories WHERE category_ID=?");
        $get_cat->execute([$id]);
        $row = $get_cat->fetch(PDO::FETCH_ASSOC);

        echo "<h3>Edit category</h3>
        <form class='editCatForm' method='post' enctype='multipart/form-data'>
            <input type='text' name='cat_name' value='" . htmlspecialchars($row['categoryName']) . "' placeholder='Enter category name'>
            <input type='text' name='cat_icon' value='" . htmlspecialchars($row['cat_icon']) . "'>

            <center><button id='addCatBtn' name='editcatbtn'>Edit Category</button></center>
        </form>";

        if (isset($_POST["editcatbtn"])) {
            $catname = $_POST["cat_name"];
            $cat_icon = $_POST["cat_icon"];
            $upcategory = $conn->prepare("UPDATE categories SET categoryName=?, cat_icon=? WHERE category_ID=? ");
            if ($upcategory->execute([$catname, $cat_icon, $id])) {
                echo "<script>alert('Category updated successfully');</script>";
            } else {
                echo "<script>alert('Category could not be updated');</script>";
            }
            echo "<script>window.open('index.php?vcat','_self')</script>";
        }
    }
}


function view_categories()
{
    include ("inc/db_con.php");
    $get_cat = $conn->prepare("SELECT * FROM categories");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    $i = 1;
    while ($row = $get_cat->fetch()) {
        echo "<tr>
                    <td>" . $i++ . "</td>
                    <td>" . $row['cat_icon'] . " " . $row['categoryName'] . "</td>
                    <td><a href='index.php?vcat&edit_cat=" . $row['category_ID'] . "' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
                        <a style='color:red;' href='index.php?vcat&del_cat=" . $row['category_ID'] . "' title='Delete'><i class='fa-solid fa-trash'></i></a></td>
             </tr>";
    }
    if (isset($_GET['del_cat'])) {
        $id = $_GET['del_cat'];
        $del = $conn->prepare("DELETE FROM categories WHERE category_ID=?");
        if ($del->execute([$id])) {
            echo "<script>alert('Category deleted successfully');</script>";
        } else {
            echo "<script>alert('Category could not be deleted');</script>";
        }
        echo "<script>window.open('index.php?vcat','_self')</script>";
    }
}
function view_sub_categories()
{
    include ("inc/db_con.php");
    $get_cat = $conn->prepare("SELECT * FROM subcategory");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    $i = 1;
    while ($row = $get_cat->fetch()) {
        $id = $row['category_ID'];
        $get_c = $conn->prepare("SELECT * FROM categories WHERE category_ID=?");
        $get_c->execute([$id]);
        $row_cat = $get_c->fetch(PDO::FETCH_ASSOC); // Fetch as associative array
        if ($row_cat) {
            echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $row['subcategory_name'] . "</td>
                <td>" . $row_cat['categoryName'] . "</td>
                <td><a href='index.php?sub_cat&edit_sub_cat=" . $row['subcategory_ID'] . "' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
                    <a style='color:red' href='index.php?sub_cat&del_sub_cat=" . $row['subcategory_ID'] . "' title='Delete'><i class='fa-solid fa-trash'></i></a></td>
             </tr>";
        }
    }
    if (isset($_GET['del_sub_cat'])) {
        $id = $_GET['del_sub_cat'];
        $del = $conn->prepare("DELETE FROM subcategory WHERE subcategory_ID=?");
        $success = $del->execute([$id]); // Check if execution was successful
        if ($success) {
            echo "<script>alert('Sub category deleted successfully');</script>";
        } else {
            echo "<script>alert('Sub category could not be deleted');</script>";
            // Print any error message or handle the error appropriately
            $errorInfo = $del->errorInfo();
            if (isset($errorInfo[2])) {
                echo "<script>alert('Error: " . $errorInfo[2] . "');</script>";
            }
        }
        echo "<script>window.open('index.php?sub_cat','_self')</script>";
    }
}

// function view_sub_categories() {
//     include ("inc/db_con.php");
//     $get_cat = $conn->prepare("SELECT * FROM subcategory");
//     $get_cat->setFetchMode(PDO::FETCH_ASSOC);
//     $get_cat->execute();
//     $i = 1;
//     while ($row = $get_cat->fetch()) {
//         $id = $row['category_ID'];
//         $get_c = $conn->prepare("SELECT * FROM categories WHERE category_ID=?");
//         $get_c->execute([$id]);
//         $row_cat = $get_c->fetch(PDO::FETCH_ASSOC); // Fetch as associative array
//         if ($row_cat) {
//             echo "<tr>
//                 <td>" . $i++ . "</td>
//                 <td>" . $row['subcategory_name'] . "</td>
//                 <td>" . $row_cat['categoryName'] . "</td>
//                 <td><a href='index.php?sub_cat&edit_sub_cat=" . $row['subcategory_ID'] . "' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
//                     <a style='color:red' href='index.php?sub_cat&del_sub_cat=".$row['subcategory_ID']."' title='Delete'><i class='fa-solid fa-trash'></i></a></td>
//              </tr>";
//         }
//     }
//     if(isset($_GET['del_sub_cat'])){
//         $id = $_GET['del_sub_cat'];
//         $del = $conn->prepare("DELETE FROM subcategory WHERE subcategory_ID=?");
//         $success = $del->execute([$id]); // Check if execution was successful
//         if ($success) {
//             echo "<script>alert('Sub category deleted successfully');</script>";
//         } else {
//             echo "<script>alert('Sub category could not be deleted');</script>";
//         }
//         echo "<script>window.open('index.php?sub_cat','_self')</script>";
//     }
// }

function add_sub_category()
{
    //     error_reporting(E_ALL);
// ini_set('display_errors', 1);

    include ("inc/db_con.php");
    if (isset($_POST["addsubcat"])) {
        $subcatname = $_POST["sub_cat_name"];
        $catid = $_POST["cat_id"];

        // Prepare the SQL statement with placeholders
        $check = $conn->prepare("SELECT * FROM subcategory WHERE subcategory_name=:subcatname");
        // Bind the parameter
        $check->bindParam(':subcatname', $subcatname);
        // Execute the query
        $check->execute();
        // Fetch the results
        $count = $check->rowCount();

        if ($count > 0) {
            echo "<script>alert('Sub Category already exists');</script>";
            echo "<script>window.open('index.php?sub_cat','_self')</script>";
        } else {
            // Prepare the SQL statement with placeholders
            $addcategory = $conn->prepare("INSERT INTO subcategory (subcategory_name, category_ID) VALUES (:subcatname, :catid)");
            // Bind the parameters
            $addcategory->bindParam(':subcatname', $subcatname);
            $addcategory->bindParam(':catid', $catid);
            // Execute the query
            if ($addcategory->execute()) {
                echo "<script>alert('Sub category added successfully');</script>";
                echo "<script>window.open('index.php?sub_cat','_self')</script>";
            } else {
                echo "<script>alert('Sub category not added');</script>";
                // print_r($addcategory->errorInfo());
                echo "<script>window.open('index.php?sub_cat','_self')</script>";
            }
        }
    }
}

function edit_sub_category()
{
    include ("inc/db_con.php");
    if (isset($_GET["edit_sub_cat"])) {
        $id = $_GET["edit_sub_cat"];
        $get_cat = $conn->prepare("SELECT * FROM subcategory where subcategory_ID='$id'");
        $get_cat->setFetchMode(PDO::FETCH_ASSOC);
        $get_cat->execute();
        $row = $get_cat->fetch();

        $cat_id = $row['category_ID'];
        $get_c = $conn->prepare("SELECT * FROM categories WHERE category_ID='$cat_id'");
        $get_c->setFetchMode(PDO::FETCH_ASSOC);
        $get_c->execute();
        $row_cat = $get_c->fetch();
        echo " <h3> Edit sub category</h3>
        <form class='editsubCatForm' method='post' enctype='multipart/form-data'>
        <select name='c_id'>
         <option value='" . $row_cat['category_ID'] . "'>" . $row_cat['categoryName'] . "</option>";
        echo select_cat();
        echo "</select>
        <input type='text' name='sub_cat_name' value='" . $row['subcategory_name'] . "' placeholder='Enter sub category name'>
        <center><button id='addCatBtn' name='editsubcatbtn'>Edit Category </button></center>
        </form>";

        if (isset($_POST["editsubcatbtn"])) {
            $catname = $_POST["sub_cat_name"];
            $cat_id = $_POST['c_id'];
            // $check = $conn->prepare("SELECT * FROM subcategory WHERE subcategory_name='$catname'");
            // $check->setFetchMode(PDO::FETCH_ASSOC);
            // $check->execute();
            // $count = $check->rowCount();
            // if ($count > 0) {
            //     echo "<script>alert('Category already exist');</script>";
            //     echo "<script> window.open('index.php?sub_cat','_self')</script>";
            // } else {
            $upcategory = $conn->prepare("UPDATE subcategory SET subcategory_name='$catname',category_ID=$cat_id WHERE subcategory_ID='$id'");
            if ($upcategory->execute()) {
                echo "<script> alert('sub Category updated successfully'); </script>";
                // header("Location: ".$_SERVER['REQUEST_URI']);// to redirect to the same page
                echo "<script> window.open('index.php?sub_cat','_self')</script>";
                // exit();
            } else {
                echo "<script>alert('Category could not updated');</script>";
                echo "<script> window.open('index.php?sub_cat','_self')</script>";
                // exit();
            }
            // }
        }
    }
}
function select_cat()
{
    include ("inc/db_con.php");
    $get_cat = $conn->prepare("SELECT * FROM categories");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    while ($row = $get_cat->fetch()) {
        echo "<option value='" . $row['category_ID'] . "'>" . $row['categoryName'] . "</option>";
    }
}
function add_term()
{
    include ("inc/db_con.php");
    if (isset($_POST["add_term"])) {
        $term = $_POST["term"];//subcatname
        $for_whome = $_POST["for_whome"];//catID

        $check = $conn->prepare("SELECT * FROM term WHERE term=:term");
        $check->bindParam(':term', $term);
        $check->setFetchMode(PDO::FETCH_ASSOC);
        $check->execute();
        $count = $check->rowCount();

        if ($count > 0) {
            echo "<script>alert('Term already exists');</script>";
            echo "<script>window.open('index.php?terms','_self')</script>";
        } else {
            $addterm = $conn->prepare("INSERT INTO term (term, for_whome) VALUES (:term,:for_whome)");
            $addterm->bindParam(':term', $term);
            $addterm->bindParam(':for_whome', $for_whome);
            if ($addterm->execute()) {
                echo "<script>alert('Term added successfully');</script>";
                echo "<script>window.open('index.php?terms','_self')</script>";
            } else {
                echo "<script>alert('Term could not be added');</script>";
                echo "<script>window.open('index.php?terms','_self')</script>";
            }
        }
    }
}


function view_terms()
{
    include ("inc/db_con.php");
    $get_c = $conn->prepare("SELECT * FROM term");
    $get_c->setFetchMode(PDO::FETCH_ASSOC);
    $get_c->execute();
    $i = 1;
    while ($row = $get_c->fetch()) {
        echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $row['term'] . "</td>
                <td>" . $row['for_whome'] . "</td>
                <td><a href='index.php?terms&edit_term=" . $row['t_id'] . "' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
                    <a style='color:red' href='index.php?terms&del_term=" . $row['t_id'] . "' title='Delete'><i class='fa-solid fa-trash'></i></a>
                </td>
             </tr>";
    }
    if (isset($_GET['del_term'])) {
        $id = $_GET['del_term'];
        $del = $conn->prepare("DELETE FROM term WHERE t_id=?");
        $success = $del->execute([$id]); // Check if execution was successful
        if ($success) {
            echo "<script>alert('Term deleted successfully');</script>";
        } else {
            echo "<script>alert('Term could not be deleted');</script>";
        }
        echo "<script>window.open('index.php?terms','_self')</script>";
    }
}
function edit_term()
{
    include ("inc/db_con.php");
    if (isset($_GET["edit_term"])) {
        $id = $_GET["edit_term"];
        $get_cat = $conn->prepare("SELECT * FROM term where t_id='$id'");
        $get_cat->setFetchMode(PDO::FETCH_ASSOC);
        $get_cat->execute();
        $row = $get_cat->fetch();


        echo " <h3> Edit T&C</h3>
        <form class='editsubCatForm' method='post' enctype='multipart/form-data'>
        <select name='for_whome'>
         <option value='" . $row['for_whome'] . "'>" . $row['for_whome'] . "</option>
         <option value='student'>Student</option>
                        <option value='teacher'>Teacher</option>";
        echo "</select>
        <input type='text' name='term' value='" . $row['term'] . "' placeholder='Enter Term'>
        <center><button id='addCatBtn' name='edit_t'>Edit T&C </button></center>
        </form>";

        if (isset($_POST["edit_t"])) {
            $catname = $_POST["term"];
            $cat_id = $_POST['for_whome'];
            $upcategory = $conn->prepare("UPDATE term SET term=:catname, for_whome=:cat_id WHERE t_id=:id");
            $upcategory->bindParam(':catname', $catname);
            $upcategory->bindParam(':cat_id', $cat_id);
            $upcategory->bindParam(':id', $id);

            if ($upcategory->execute()) {
                echo "<script> alert('Term updated successfully'); </script>";
                echo "<script> window.open('index.php?terms','_self')</script>";
            } else {
                echo "<script>alert('Term could not be updated');</script>";
                echo "<script> window.open('index.php?terms','_self')</script>";
            }

        }
    }
}
function contact()
{
    include ("inc/db_con.php");
    $get_conn = $conn->prepare("SELECT * FROM contact");
    $get_conn->setFetchMode(PDO::FETCH_ASSOC);
    $get_conn->execute();
    $row = $get_conn->fetch();

    echo "<form  method='post' enctype='multipart/form-data'>
    <table class='con_table'>
        <tr>
            <td>Contact no.</td>
            <td> <input type='tel' value='" . $row['phn'] . "' name='phn'> </td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type='email' value='" . $row['email'] . "' name='email'></td>
        </tr>
        <tr>
            <td>address 1</td>
            <td><input type='text' value='" . $row['address1'] . "' name='address1'></td>
        </tr>
        <tr>
            <td>Address 2</td>
            <td><input type='text' value='" . $row['address2'] . "' name='address2'></td>
        </tr>
        <tr>
            <td>Youtube</td>
            <td><input type='text' value='" . $row['yt'] . "' name='yt'></td>
        </tr>
        <tr>
            <td>Facebook</td>
            <td><input type='text' value='" . $row['fb'] . "' name='fb'></td>
        </tr>
        <tr>
            <td>Google plus</td>
            <td><input type='text' value='" . $row['gp'] . "' name='gp'></td>
        </tr>
        <tr>
            <td>Twitter</td>
            <td><input type='text' value='" . $row['tw'] . "' name='tw'></td>
        </tr>
        <tr>
            <td>Linked in</td>
            <td><input type='text' value='" . $row['link'] . "' name='link'></td>
        </tr>

    </table>
   
    <center><button class='con_save'  name='up_con'>Save </button></center>
</form>";
    if (isset($_POST["up_con"])) {
        $phn = $_POST['phn'];
        $email = $_POST['email'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $yt = $_POST['yt'];
        $fb = $_POST['fb'];
        $gp = $_POST['gp'];
        $tw = $_POST['tw'];
        $link = $_POST['link'];
        $up = $conn->prepare("UPDATE contact SET phn='$phn',email='$email',address1='$address1',address2='$address2',yt='$yt',gp='$gp',fb='$fb',tw='$tw',link='$link'");
        if ($up->execute()) {
            echo "<script> alert('Updated sucessfully'); </script>";

        } else {
            echo "<script> alert('Could not be updated'); </script>";
        }
        echo "<script> window.open('index.php?contact','_self'); </script>";
    }
}
function add_faqs()
{
    include ("inc/db_con.php");

    if (isset($_POST["add_faqs"])) {
        $qsn = $_POST["qsn"];
        $ans = $_POST["ans"];
        // Using prepared statement to avoid SQL injection
        $check = $conn->prepare("SELECT * FROM faqs WHERE qsn=?");
        $check->execute([$qsn]);
        $count = $check->rowCount();

        if ($count > 0) {
            // Display error message
            echo "<script>alert('Question already exists');</script>";
        } else {
            // Insert the new category
            $add = $conn->prepare("INSERT INTO faqs (qsn,ans) VALUES ('$qsn','$ans')");
            if ($add->execute()) {
                // Display success message
                echo "<script>alert('FAQs added successfully');</script>";
            } else {
                // Display error message
                echo "<script>alert('FAQs not added');</script>";
            }
        }
        // Redirect back to index.php
        echo "<script>window.open('index.php?faqs','_self')</script>";
    }
}
function view_faqs()
{
    include ("inc/db_con.php");
    $get_faqs = $conn->prepare("SELECT * FROM faqs");
    $get_faqs->setFetchMode(PDO::FETCH_ASSOC);
    $get_faqs->execute();
    while ($row = $get_faqs->fetch()) {
        echo " 
        <div class='add detail-container'>
        <details class='details'>
        <summary>" . $row['qsn'] . "</summary>
        <form class='addCatForm' method='post' enctype='multipart/form-data'>
        <input type='text' name='up_qsn'value='" . $row['qsn'] . "' placeholder='Enter Question'>
        <input type='hidden'name='id'value='" . $row['q_id'] . "'>
        <textarea name='up_ans'class='textarea'placeholder='Enter the answer'>" . $row['ans'] . "</textarea>
        <center><button id='addCatBtn' name='up_faqs'>Update FAQs </button></center>
    </form>
    </details>
        </div>";
    }
    if (isset($_POST["up_faqs"])) {
        $qsn = $_POST["up_qsn"];
        $ans = $_POST["up_ans"];
        $id = $_POST["id"];
        $up_faq = $conn->prepare("UPDATE  faqs SET qsn='$qsn', ans='$ans' WHERE q_id='$id'");
        if ($up_faq->execute()) {
            echo "<script>alert('FAQs updated successfully');</script>";
        } else {
            echo "<script>alert('FAQs not updated');</script>";
        }
        echo "<script>window.open('index.php?faqs','_self')</script>";
    }
}

function about()
{
    include ("inc/db_con.php");
    $about = $conn->prepare("SELECT * FROM about");
    $about->setFetchMode(PDO::FETCH_ASSOC);
    $about->execute();
    $row = $about->fetch();
    echo "<form method='post'>
    <textarea name='about'>" . $row['about'] . "</textarea>
    <button id='addCatBtn' class='aboutBtn' name='up_about'>Save</button>
    </form>";
    if (isset($_POST['up_about'])) {
        $info = $_POST['about'];
        $up_about = $conn->prepare("UPDATE about set about='$info'");
        if (!$up_about->execute()) {
            echo "<script>alert('Could not be updated');</script>";
        }
        echo "<script>window.open('index.php?about','_self')</script>";

    }
}
function numStudents(){
    include ("inc/db_con.php");
    $num_students = $conn->prepare("SELECT * FROM student");
    $num_students->execute();
    $nums= $num_students->rowCount();
    echo "". $nums ."";
}
function numInstructors(){
    include ("inc/db_con.php");
    $num_instructors = $conn->prepare("SELECT * FROM instructor");
    $num_instructors->execute();
    $nums= $num_instructors->rowCount();
    echo "". $nums ."";
}
function showCourses(){
    include ("inc/db_con.php");

?>
    <h3>courses</h3>
        <div class="course_table">
            <table>
                <tr>
                    <th>Sl.no</th>
                    <th>Course id</th>
                    <th>Course Name</th>
                </tr>
                <?php
                $i=1;
                $getCourse=$conn->prepare("SELECT * FROM course");     
                $getCourse->setFetchMode(PDO::FETCH_ASSOC);
                $getCourse->execute();
                while($row=$getCourse->fetch()){
                    echo "
                    <tr>
                        <td>".$i++."</td>              
                        <td>".$row['course_id']."</td>
                        <td>".$row['course_name']."</td>
                    </tr>";
                }
                ?>
            </table>
        </div>
<?php
}
?>