<section class="category home-cat">
    <h2>Top categories</h2>
    <p>Explore our popular courses</p>
    <div class="cards-container">
      <?php 
        include("db_con.php");
        $get_cat=$conn->prepare("SELECT * FROM categories LIMIT 10");
        $get_cat->execute();
        while($cat=$get_cat->fetch(PDO::FETCH_ASSOC)){
         echo' <a href="#"> <div class="card"> <span>'.$cat["cat_icon"].'</span>
          <span>'.$cat["categoryName"].'</span>
        </div> </a>';
        }
      ?>
      
    </div>
  </section>
