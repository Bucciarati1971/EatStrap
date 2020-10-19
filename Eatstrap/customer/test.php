<?php
// session_start();

require_once("dbConnect.php");

// $result=mysqli_query($link,"select * from e_user ");
// $B= mysqli_fetch_assoc($result);
// var_dump($B);


// echo  $_SESSION["loginMember"]; echo "<hr>";
// echo  $_SESSION["loginMember"]; echo "<hr>";

//  if (isset($_SESSION["loginMember"])&&($_SESSION["loginMember"] != "")) {
//      if ($_SESSION["memberLevel"] == "member") {
//          header("Location: Registered.php");
//      } else {
//          header("Location:userRegistered.php");
//      }
//      exit();
//  }



 
if (isset($_POST["myLog"])) {
    // //執行登入
    
        // $query_RecLogin="SELECT * FROM E_user WHERE E_Name ='{$_POST["myAccount"]}'and
        //  E_password = '{$_POST["myPassword"]}' ";
        // $query_RecLogin="SELECT E_Name, E_password, E_level FROM e_user WHERE E_Name =?";
        // $query_RecLogin=mysqli_query($link,"SELECT E_Name, E_password, E_level FROM e_user WHERE E_Name =?");
        $query_RecLogin = mysqli_query($link,"SELECT * FROM e_user WHERE E_Name = 
        '{$_POST["myAccount"]}' AND  E_password = '{$_POST["myPassword"]}'");
        $A = mysqli_fetch_assoc($query_RecLogin); //提出物件中的陣列
        $sess = $A["E_Name"];    //顯示名字

        var_dump($sess);

        if($sess!=""){
            setcookie("eatstrap",$sess,time()+600);
        }else{
            setcookie("eatstrap","guest",time()-60*60*24*7);
            header("Location:https://www.youtube.com/watch?v=_Z1VzsE1GVg");
        }
        // $stmt=$db_link->prepare($query_RecLogin);
        // $stmt->bind_param("s", $_POST["myAccount"]);
        // $stmt->execute();
        // $stmt->bind_result($usernmae, $password, $level);
        // $stmt->fetch();
        // $stmt->close();

        // //  $result=mysqli_query($link,$query_RecLogin);
        // //  $row = mysqli_fetch_assoc($result);
        // if(password_verify($_POST["myPassword"],$password)){
        // $query_RecLoginUpdat="UPDATE memberdata SET E_login = E_login+1, E_logintime=NOW() WHERE E_username?";


    //     $stmt=$db_link->prepare($query_RecLoginUpdate);
    //     $stmt->bind_param("s", $usernmae);
    //     $stmt->execute();
    //     $stmt->close();
       
    //     $_SESSION["loginMember"]=$username;
    //     $_SESSION["memberLevel"]=$level;
       
    //     //記住登入
    //     if (isset($_POST["stayLogin"]) && ($_POST["stayLogin"] == "true")) {
    //         setcookie("remUser", $_POST["myAccount"], time()+365*24*60);
    //         setcookie("remPass", $_POST["myPassword"], time()+365*24*60);
    //     } else {
    //         if (isset($_COOKIE["remUser"])) {
    //             setcookie("remUser", $_POST["myAccount"], time()-100);
    //             setcookie("remPass", $_POST["myPassword"], time()-100);
    //         }
    //     }


    //     if ($_SESSION["memberLevel"]=="member") {
    //         header("Location:portal.php");
    //     } 
        
    //   }  else {
    //         header("Location:portal.php");
    //     }
      
    
}


// if (isset($_POST["button1id"])) {
//     $sql=<<<sqlCommamd
//         update e_user set
//          E_Name="{$_POST["E_Name"]}",
//          E_password="{$_POST["E_password"]}",
//          Email="{$_POST["Email"]}",
//         where Employee={$_POST["Employee"]}
//      sqlCommamd;
//     mysqli_query($link, $sql);
//      header("Location:index.php");
//     exit();
// }

// $id = $_GET["empid"];
//  $sql = "select * from e_user where E_ID = $id";
// $result = mysqli_query($link, $sql);
// $row = mysqli_fetch_assoc($result);





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">會員登入</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" method="post" >
                        <fieldset>

                            <!-- Form Name -->
                            <legend></legend>

                            <!-- Password input-->
                            <div class="form-group" action="">
                                <label class="col-md-4 control-label" for="myAccount"></label>
                                <input id="myAccount" name="myAccount" 
                                value="<?php if (isset($_COOKIE["remUser"])&& ($_COOKIE["remUser"]!="")) {echo $_COOKIE["remUser"];}?>" type="text" placeholder="用戶名或電子郵件"
                                    class="form-control input-md">

                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="myPassword"></label>
                                <input id="myPassword" name="myPassword" type="password" placeholder="密碼"
                                    class="form-control input-md"value="<?php if (isset($_COOKIE["remPass"])
                                 && ($_COOKIE["remPass"]!="")) {
     echo $_COOKIE["remPass"];
 }?>">

                            </div>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="stayLogin"></label>
                                <div class="col">
                                    <input type="checkbox" name="stayLogin" id="stayLogin" value="true">
                                    Remember
                                    <button id="myLog" type="submit" name="myLog" class="btn btn-primary">登入</button>
                                    <button id=" registered" name=" registered" class="btn btn-warning" >註冊</button>


                                </div>
                            </div>


                        </fieldset>
                    </form>
                </div>



            </div>
        </div>
    </div>
    <div class="demo-description">
        <h1 class="demo-description__title">Full Course Dinner</h1>
        <p class="demo-description__p">Resize the browser to see the <picture> effect.</p>
    </div>

    <div class="demo coursemeal">

        <!-- APPETIZERS-->
        <div class="coursemeal__div ">

            <picture class="responsive-img">
                <source media="(min-width: 990px)" srcset="https://i.postimg.cc/jSTZmp8H/appetizer-img-1.jpg">
                <source media="(min-width: 765px)" srcset="https://i.postimg.cc/1RTdCYhB/appetizer-img-2.jpg">
                <source srcset="https://i.postimg.cc/TwnctQr7/appetizer-img-3.jpg">
                <img src="https://i.postimg.cc/jSTZmp8H/appetizer-img-1.jpg" alt="Appetizer">
            </picture>

            <div class="coursemeal-info">
                <a href="#" class="coursemeal-info__link">Appetizer</a>
            </div>
        </div>

        <!-- MAIN COURSE-->
        <div class="coursemeal__div">

            <picture class="responsive-img">
                <source media="(min-width: 990px)" srcset="https://i.postimg.cc/V6NCCRK0/maindish-img-1.jpg">
                <source media="(min-width: 765px)" srcset="https://i.postimg.cc/9XYj186s/maindish-img-2.jpg">
                <source srcset="https://i.postimg.cc/pLY8dt4q/maindish-img-3.jpg">
                <img src="https://i.postimg.cc/V6NCCRK0/maindish-img-1.jpg" alt="Main Course">
            </picture>

            <div class="coursemeal-info">
                <a href="http://127.0.0.1:5500/%E5%B0%8F%E5%B0%88/test.html" class="coursemeal-info__link">Main
                    Course</a>
            </div>
        </div>

        <!-- DESSERTS-->
        <div class="coursemeal__div">

            <picture class="responsive-img">
                <source media="(min-width: 990px)" srcset="https://i.postimg.cc/9FfLh6ZZ/dessert-img-1.jpg">
                <source media="(min-width: 765px)" srcset="https://i.postimg.cc/FsRXBnKn/dessert-img-2.jpg">
                <source srcset="https://i.postimg.cc/ZKcFCVFZ/dessert-img-3.jpg">
                <img src="https://i.postimg.cc/ZKcFCVFZ/dessert-img-1.jpg" alt="Desserts">
            </picture>

            <div class="coursemeal-info">
                <a href="#" class="coursemeal-info__link">Dessert</a>
            </div>
        </div>



    </div>


<form class="form-horizontal" method="post" action="" >
                        <fieldset>

                            <!-- Form Name -->
                            <legend></legend>

                            <!-- Password input-->
                            <div class="form-group" action="">
                                <label class="col-md-4 control-label" for="myAccount"></label>
                                <input id="myAccount" name="myAccount" value="" type="text" placeholder="用戶名或電子郵件"
                                    class="form-control input-md">

                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="myPassword"></label>
                                <input id="myPassword" name="myPassword" type="password" placeholder="密碼"
                                    class="form-control input-md"value="">

                            </div>

                            <!-- Multiple Checkboxes -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="stayLogin"></label>
                                <div class="col">
                                    <input type="checkbox" name="stayLogin" id="stayLogin" value="true">
                                    保持登入
                                    <button id="myLog" type="submit" name="myLog" class="btn btn-primary">登入</button>
                                    <button id=" registered" name=" registered" class="btn btn-warning">註冊</button>


                                </div>
                            </div>


                        </fieldset>
                    </form>


</body>
</html>