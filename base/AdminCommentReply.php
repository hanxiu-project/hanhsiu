<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="ckeditor/ckeditor.js?ver=<?php echo time; ?>"></script>

    <title>回覆留言 | 管理後台</title>

    <?php
include 'head.php';
?>
</head>

<body>
<?php
session_start();
include 'verification.php';
?>


<div id="wrapper">
    <!--sidebar-->
    <!-- Navigation -->
    <?php include 'nav.php';?>
    <?php include '../database.php';?>

    <div class="row" style="margin-bottom: 20px; text-align: left">
        <div class="col-lg-12">
            <h2><b style= "background:white">回覆留言區</b><h1>
        </div>
    </div>



    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
/*資料庫連結*/

session_start();
$sql = "SELECT `c_id`,`members`.`m_id`,`members`.`account`,`members`.`name`,`msg_datetime`,`message`,`reply`,`rpy_datetime`,`status` FROM `comments`,`members` where `comments`.`c_id` = '$_SESSION[reply_c_id]' and  `members`.`m_id` = '$_SESSION[reply_m_id]'";
//$sql="SELECT `c_id`,`members`.`m_id`,`members`.`account`,`members`.`name`,`msg_datetime`,`message`,`reply`,`rpy_datetime` FROM `comments`,`members` where `comments`.`c_id` = '$_SESSION[reply_c_id]' and `comments`.`status`='0' and `members`.`m_id` = '$_SESSION[reply_m_id]'";
$result = mysqli_query($db_link, $sql);
$row = mysqli_fetch_assoc($result);

//$status = $row['status'];

?>

                <div id="con2">
                    <div class="main">
                        <div class="newstitle" >

                            <div class="contentlist">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <form name="forms" method="POST" action="">

                                            <div class="form-group">
                                                <label for="title">會員編號:</label>
                                                <font style="width:525px; height:30px; color:#000000; background-color:transparent" ><?php echo $row['m_id'] ?></font>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">會員帳號:</label>
                                                <font style="width:525px; height:30px; color:#000000; background-color:transparent" ><?php echo $row['account'] ?></font>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">會員姓名:</label>
                                                <font style="width:525px; height:30px; color:#000000; background-color:transparent" ><?php echo $row['name'] ?></font>
                                            </div>

                                            <div class="form-group">
                                                <label for="date">留言日期:</label>
                                                <font style="width:525px; height:30px; color:#000000; background-color:transparent" ><?php echo $row['msg_datetime'] ?></font>
                                            </div>


                                            <div class="form-group">
                                                <label for="content">留言內容:</label>
                                                <font style="width:525px; height:30px; color:#000000; background-color:transparent" ><?php echo $row['message'] ?></font>
                                            </div>

                                            <div class="form-group">
                                                <label for="">回覆區：</label>
                                            </div>

                                            <div class="form-group">
                                                <textarea id="rpy" name="rpy" rows="5" cols="80"></textarea>

                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-warning" name="reply" value="回覆" >
                                            </div>


                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

$reply = $_POST["rpy"];

if (isset($_POST["reply"])) {
    $nowdate = date("Y-m-d H:i:s", mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));

    if ($reply == null) {
        echo "<script>alert('尚未輸入回覆內容!');location.href='AdminCommentsReply.php'</script>";
    } else {

        if ($row[status] == 1) {
            $sql_insert_reply = "INSERT INTO `comments` (m_id,message,msg_datetime,replyman,reply,rpy_datetime,status) VALUES('$_SESSION[reply_m_id]','$row[message]','$row[msg_datetime]','$_SESSION[name]','$reply','$nowdate',1)";
            mysqli_query($db_link, $sql_insert_reply);
        } else {
            $sql_update_reply = "UPDATE `comments` SET `reply` = '$reply',`replyman`='$_SESSION[name]',`rpy_datetime`= '$nowdate' ,`status`= '1' where `comments`.`c_id` = $_SESSION[reply_c_id]";
            mysqli_query($db_link, $sql_update_reply);
        }

        echo "<script>alert('回覆成功!');location.href='AdminCommentManagefor0.php'</script>";
    }
}
mysqli_close($db_link);
?>
                </form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
