<?php 
require_once("boardMysql.php");
//預設每頁筆數
$pageRow_records = 5;
//預設頁數
$num_pages = 1;
//將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//記錄筆數 =
$startRow_records = ($num_pages -1) * $pageRow_records;
//未加限制顯示筆數的
$query_RecBoard = "SELECT * FROM board ORDER BY boardtime DESC";
//加上限制顯示筆數
$query_limit_RecBoard = $query_RecBoard." LIMIT {$startRow_records}, {$pageRow_records}";
//以加上限制顯示筆數
$RecBoard = $db_link->query($query_limit_RecBoard);
$all_RecBoard = $db_link->query($query_RecBoard);
//計算總筆數
$total_records = $all_RecBoard->num_rows;
//計算總頁數
$total_pages = ceil($total_records/$pageRow_records);
?>
<!DOCTYPE html>
<html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../_css/bootstrap.min.css">
    <link rel="stylesheet" href="../_css/Full Course Dinner.css">
    <link rel="stylesheet" href="../_css/UEO.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


    <script src="../_js/jquery.min.js"></script>
    <script src="../_js/popper.min.js"></script>
    <script src="../_js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body style="padding-top:200px;">
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand mb-0 h3" href="#">
  <h1 style="font-family: 'Metal Mania', cursive;">
                <img src="../img/RNZTXHK4OQS11555957772004.png" width="35" height="35" class="d-inline-block align-top " alt="">
                EatStrap
            </h1>

  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText" >
    <ul class="navbar-nav mr-auto"style="font-family: 'Metal Mania', cursive;">
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="../eHome.php" >Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="../page1.php">popular <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link mb-0 h3" href="board.php">Opinion  <span class="sr-only">(current)</span></a>
      </li>
    </ul>
<form class=" form-horizontal form-inline my-2 my-lg-0" method="post" action="">

<div class="nav-item active">
<a class="nav-link mb-0 h5" href="board.php">留言主頁</a>
</div>

<div class="nav-item active">
<a class="nav-link mb-0 h5" type="submit"  href="post.php">留下意見</a>
</div>
</form>



    </nav>

<table class="table">
  <!-- <thead class="thead-dark"> -->
    <!-- <tr>
     <td> -->
    <!-- <table align="left" border="0" cellpadding="0" cellspacing="0" width="700"> -->
          <!-- <td><img name="board_r1_c1" src="images/board_r1_c1.jpg" width="465" height="36" border="0" alt=""></td> -->
          <!-- <td><a href="board.php">瀏覽留言</a>||<td><a href="post.php">我要留言</a></td> -->
          <!-- <td width="15"><img name="board_r1_c8" src="images/board_r1_c8.jpg" width="15" height="36" border="0" alt=""></td> -->
      <!-- </table> -->
      <!-- </td>
    </tr>
  </thead> -->
  <!-- <tr>
    <td><img name="board_r2_c1" src="images/board_r2_c1.jpg" width="700" height="28" border="0" alt=""></td>
  </tr> -->
<today>
  <tr>
    <td ><div id="mainRegion">
        <?php	while($row_RecBoard=$RecBoard->fetch_assoc()){ ?>
        <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr valign="top">
            <td width="60" align="center" class="underline">
              <?php if($row_RecBoard["boardsex"]=="男"){;?>
              <img src="images/male.gif" alt="男生" width="49" height="49">
              <?php }else{?>
              <img src="images/female.gif" alt="女生" width="49" height="49">
              <?php }?>
              <br>
              <span class="postname"><?php echo $row_RecBoard["boardname"];?></span>
            </td>
            <td class="underline">
            	  <span class="smalltext">[<?php echo $row_RecBoard["boardid"];?>]</span>
            	  <span class="heading"> <?php echo $row_RecBoard["boardsubject"];?></span>
            	  <p><?php echo nl2br($row_RecBoard["boardcontent"]);?></p>
            	  <p align="right" class="smalltext">
            	  <?php echo $row_RecBoard["boardtime"];?>
            	  </p>
              </td>
          </tr>          
        </table>
        <?php }?>
        <table width="90%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td valign="middle"><p>資料筆數：<?php echo $total_records;?></p></td>
            <td align="right"><p>
                <?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
                <a href="?page=1">第一頁</a> | <a href="?page=<?php echo $num_pages-1;?>">上一頁</a> |
                <?php }?>
                <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
                <a href="?page=<?php echo $num_pages+1;?>">下一頁</a> | <a href="?page=<?php echo $total_pages;?>">最末頁</a>
                <?php }?>
              </p></td>
          </tr>
        </table>
      </div>
      </td>
  </tr>
  </today>
  <tr>
</table>
</body>
</html>
<?php
$db_link->close();
?>