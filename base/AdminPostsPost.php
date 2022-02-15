<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="ckeditor/ckeditor.js?ver=<?php echo time; ?>"></script>

    <title>新增公告 | 管理後台</title>
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
    <?php include 'nav.php';?>
    <?php include '../database.php';?>

		<div class="col-lg-12">
            <h2><b>新增公告</b><h1>
        </div>
    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
/*資料庫連結*/

date_default_timezone_set('Asia/Taipei');
$getDate = date("Y-m-d");
$getDate2 = date("Y-m-d", strtotime($getDate . "+1 day"));

?>

                <div id="con2">
                    <div class="main">
                        <div class="newstitle" >

                            <div class="contentlist">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <form name="forms" method="POST" action="">

                                            <div class="form-group">
                                                <label for="title">公告標題:</label>
                                                <input id="title" name="title" type="text"   style="width:525px; height:30px; color:#000000; background-color:transparent" >

                                            </div>


                                            <div class="form-group">
                                                <label for="content">公告內容:</label>
                                                <textarea id="content" name="content" rows="10" cols="80"></textarea>
                                                <script>
                                                    CKEDITOR.replace('content',{
                                                        width:1650,height:500,
                                                    });
                                                </script>
                                            </div>

                                            <div class="form-group">
                                                <label for="date">發佈日期:</label>
                                                <input id="date" name="date" type="date" value="<?php echo $getDate ?>"  style="width:525px; height:30px; color:#000000; background-color:transparent" >
												<label for="day">下架日期:</label>
												 <input id="newday" name="newday" type="date" value="<?php echo $getDate2 ?>"  style="width:525px; height:30px; color:#000000; background-color:transparent" >
												 <input type='checkbox' name='top' value='1'><label>置頂</label>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-warning" name="save" value="暫存" >
                                                <input type="submit" class="btn btn-sm btn-warning" name="post" value="發佈" >
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                        <?php

# 設定時區

if ($_POST["date"] == null) {
    $date = $getDate;
} else {
    $date = $_POST["date"];
}

$title = $_POST["title"];
$content = $_POST["content"];

if (isset($_POST["post"])) {
    if ($_POST["date"] > $getDate) {
        $keep = 1;
    } else {
        $keep = 0;
    }

    if ($title == null || $content == null || $date == null) {
        echo "<script>alert('請輸入資料!');location.href='AdminPostsPost.php'</script>";
    } else if ($_POST["date"] >= $_POST["newday"]) {
        echo "<script>alert('發佈日期不得大於等於首頁下架日期!');location.href='AdminPostsPost.php'</script>";
    } else if ($_POST["date"] < $getDate) {
        echo "<script>alert('發佈日期不得小於今天日期!');location.href='AdminPostsPost.php'</script>";
    } else if ($_POST["date"] > $getDate) {
        $sql = "INSERT INTO `posts` (p_id,mname,m_id,title,content,date,newday,keep,top) VALUES('NULL','$_SESSION[name]','$_SESSION[m_id]','$title','$content','$date','$_POST[newday]','$keep','$_POST[top]')";
        mysqli_query($db_link, $sql);
        echo "<script>alert('公告已經上傳待發佈專區!');location.href='AdminPostsKeep.php'</script>";
    } else {
        $sql = "INSERT INTO `posts` (p_id,mname,m_id,title,content,date,newday,keep,top) VALUES('NULL','$_SESSION[name]','$_SESSION[m_id]','$title','$content','$date','$_POST[newday]','$keep','$_POST[top]')";
        mysqli_query($db_link, $sql);
        if ($_POST['top'] == '1') {
            echo "<script>alert('公告已經上傳!');location.href='AdminPostsTop.php'</script>";
        } else {
            echo "<script>alert('公告已經上傳!');location.href='AdminPostsManage.php'</script>";
        }
    }
}

if (isset($_POST["save"])) {
    if ($_POST["date"] > $getDate) {
        $keep = 1;
    } else {
        $keep = 0;
    }

    if ($title == null || $content == null || $date == null) {
        echo "<script>alert('請輸入資料!');location.href='AdminPostsPost.php'</script>";
    } else if ($_POST["date"] >= $_POST["newday"]) {
        echo "<script>alert('發佈日期不得大於等於首頁下架日期!');location.href='AdminPostsPost.php'</script>";
    } else if ($_POST["date"] < $getDate) {
        echo "<script>alert('發佈日期不得小於今天日期!');location.href='AdminPostsPost.php'</script>";
    } else {
        $sql = "INSERT INTO `posts` (p_id,mname,m_id,title,content,date,newday,save,keep,top) VALUES('NULL','$_SESSION[name]','$_SESSION[m_id]','$title','$content','$date','$_POST[newday]','1','$keep','$_POST[top]')";
        mysqli_query($db_link, $sql);
        echo "<script>alert('公告已經上傳至暫存區!');location.href='AdminPostsSave.php'</script>";
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
