<?php 
function GetSQLValueString($theValue, $theType) {
  switch ($theType) {
    case "string":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_MAGIC_QUOTES) : "";
      break;
    case "int":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
      break;
    case "email":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
      break;
    case "url":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
      break;      
  }
  return $theValue;
}

if(isset($_POST["action"])&&($_POST["action"]=="add")){
	require_once("boardMysql.php");	
	$query_insert = "INSERT INTO board (boardname ,boardsex ,boardsubject ,boardtime ,boardmail ,boardweb ,boardcontent) VALUES (?, ?, ?, NOW(), ?, ?, ?)";
	$stmt = $db_link->prepare($query_insert);
	$stmt->bind_param("ssssss",
		GetSQLValueString($_POST["boardname"], "string"),
		GetSQLValueString($_POST["boardsex"], "string"),
		GetSQLValueString($_POST["boardsubject"], "string"),
		GetSQLValueString($_POST["boardmail"], "email"),
		GetSQLValueString($_POST["boardweb"], "url"),
		GetSQLValueString($_POST["boardcontent"], "string"));
	$stmt->execute();
	$stmt->close();
	$db_link->close();
	//重新導向回到主畫面
	header("Location: board.php");
}	
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
<title>訪客留言版</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function checkForm(){
	if(document.formPost.boardsubject.value==""){
		alert("請填寫標題!");
		document.formPost.boardsubject.focus();
		return false;
	}
	if(document.formPost.boardname.value==""){
		alert("請填寫姓名!");
		document.formPost.boardname.focus();
		return false;
	}	
	if(document.formPost.boardmail.value!=""){
		if(!checkmail(document.formPost.boardmail)){
			document.formPost.boardmail.focus();
			return false;
		}
	} 
	if(document.formPost.boardcontent.value==""){
		alert("請填寫留言內容!");
		document.formPost.boardcontent.focus();
		return false;
	}
		return confirm('確定送出嗎？');
}

function checkmail(myEmail) {
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(filter.test(myEmail.value)){
		return true;
	}
	alert("電子郵件格式不正確");
	return false;
}
</script>
</head>
<body bgcolor="#ffffff" >
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
        <a class="nav-link mb-0 h3" href="board.php">message <span class="sr-only">(current)</span></a>
      </li>
    </ul>
<form class=" form-horizontal form-inline my-2 my-lg-0" method="post" action="">

<div class="nav-item active">
<a class="nav-link" href="board.php">瀏覽留言</a>
</div>

<div class="nav-item active">
<a type="submit"  href="post.php">我要留言</a>
</div>
</form>



    </nav>

    <div class="container register custom-gutters" id="hmbg" >
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <h2>*為必填項目</>
                    </div>
                    <div class="col-md-9 register-right">
                        <!-- <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hirer</a>
                            </li>
                        </ul> -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">
                              留下意見
                                </h3>

                            <form class="form-horizontal" action="" method="post" name="formPost" id="formPost" onSubmit="return checkForm();">

                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="boardsubject" id="boardsubject"placeholder="標題*">
                                        </div>
                                        <div class="form-group">
                                        <input class="form-control" type="text" name="boardname" id="boardname"placeholder="暱稱*">
                                        </div>

                                        <div class="form-group">
                                            <div class="maxl">
                                            <p>
                                               <input name="boardsex" type="radio" id="radio" value="男" checked>男
                                                <input type="radio" name="boardsex" id="radio2" value="女">女
                                             </p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <p><textarea name="boardcontent" id="boardcontent" cols="40" rows="10"></textarea></p>

                                        </div>
                                        <input name="action" type="hidden" id="action" value="add">

                                        <!-- <input type="submit" name="Submit2" class="btnRegister"  value="送出"/> -->
                                        <input type="submit" name="button" class="btnRegister" id="button" value="送出留言">
                                        <input type="reset" name="button2" class="btnRegister" id="button2" value="重設資料">

                                    </div>
                                </div>
                            </form>
                            </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2020 Copyright:
  <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
</div>
<!-- Copyright -->

</footer>
            </div>

<!-- <table class="table"> -->
  <!-- <tr>
    <td><table align="left" border="0" cellpadding="0" cellspacing="0" width="700">
        <tr>
          <td><img name="board_r1_c1" src="images/board_r1_c1.jpg" width="465" height="36" border="0" alt=""></td>
          <td><a href="board.php"><img name="board_r1_c5" src="images/read.jpg" width="110" height="36" border="0" alt="瀏覽留言"></a></td>
          <td><a href="post.php"><img name="board_r1_c7" src="images/post.jpg" width="110" height="36" border="0" alt="我要留言"></a></td>
          <td width="15"><img name="board_r1_c8" src="images/board_r1_c8.jpg" width="15" height="36" border="0" alt=""></td>
        </tr>
      </table></td>
  </tr> -->
  <!-- <tr>
    <td><img name="board_r2_c1" src="images/board_r2_c1.jpg" width="700" height="28" border="0" alt=""></td>
  </tr> -->
  <!-- <tr>
    <td ><div id="mainRegion">
        <form action="" method="post" name="formPost" id="formPost" onSubmit="return checkForm();">
          <table >
            <tr > -->
              <!-- <td>
                <p>郵件<input type="text" name="boa
                rdmail" id="boardmail"></p>
                <p>網站<input type="text" name="boardweb" id="boardweb"></p>
              </td> -->
              <!-- <td >
                <p><textarea name="boardcontent" id="boardcontent" cols="40" rows="10"></textarea></p>
              </td>
            </tr>
            <tr>
              <td >
    			<input name="action" type="hidden" id="action" value="add">
                <input type="submit" name="button" id="button" value="送出留言">
                <input type="reset" name="button2" id="button2" value="重設資料">
                <input type="button" name="button3" id="button3" value="回上一頁" onClick="window.history.back();"></td>
            </tr>
          </table>
        </form>
      </div></td>
  </tr> -->
  <!-- <tr>
    <td><table align="left" border="0" cellpadding="0" cellspacing="0" width="700">
        <tr>
          <td width="15"><img name="board_r4_c1" src="images/board_r4_c1.jpg" width="15" height="31" border="0" alt=""></td>
          <td background="images/botbg.jpg"><a href="login.php"><img name="board_r4_c2" src="images/login.jpg" width="77" height="31" border="0" alt="登入管理"></a></td>
          <td align="right" valign="top" background="images/botbg.jpg" class="trademark">© 2016 eHappy Studio All Rights Reserved. </td>
          <td width="15"><img name="board_r4_c8" src="images/board_r4_c8.jpg" width="15" height="31" border="0" alt=""></td>
        </tr>
      </table></td>
  </tr> -->
<!-- </table> -->

</body>
</html>