<section>
   
<h2 style="margin-top:100px;">Students feedback</h2>
    <p>What Students Say About <b>ByteBrains</b></p>
    <div class="feeds_container">
        <?php
        include_once("db_con.php");
        $get_feed=$conn->prepare("SELECT stu_name,stu_occ,f_content FROM student as S join feedback AS F ON S.stu_id=F.stu_id");
        $get_feed->execute();
        if($get_feed->rowCount()> 0){
        while($feed=$get_feed->fetch(PDO::FETCH_ASSOC)){
            $f_content=$feed["f_content"];
            $stu_name=$feed["stu_name"];
            $stu_occ=$feed["stu_occ"];

       echo'
        <div class="feed">
            <img style="width:20px;" src="./images/slash.png">
            <div><span class="feed_content">'.$f_content.'</span></div>
            <div class="feed_stu_details"><span style="font-weight:bold;">'.$stu_name.'</span><br>
            <span>'.$stu_occ.'</span></div>
        </div>';
        }}?>
    </div>
</section>