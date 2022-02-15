<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>錯誤回報標語管理 | 管理後台</title>

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
            <h2><b>錯誤回報標語管理</b><h1>
        </div>
    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">
                <form name="form4"  method="post" action=" ">
                <?php
/*資料庫連結*/

$sqlslo2 = "SELECT * FROM slogan where `sloganid`= '2'";
$resultslo2 = mysqli_query($db_link, $sqlslo2);

while ($rowsl2 = mysqli_fetch_assoc($resultslo2)) {
    echo "目前標語:";
    echo "$rowsl2[slogantext]<p>";
}
echo "編輯標語為:";
echo "<input id=slogant2 name=slogant2 type=text   style=width:525px; height:30px; color:#000000; background-color:transparent>";
echo "<input type=submit class='btn btn-sm btn-danger'  style='width:100px;height:30px;' name=slogans2 id=slogans2 value=確定編輯>";

?>
                </form>
                <?php
if (isset($_POST["slogans2"])) {
    if ($_POST["slogant2"] == null) {
        echo "<script>alert('更改內容不能為空值');location.href='AdminErrorSloganEdit.php'</script>";
    } else {
        $sqliit = "UPDATE `slogan` set `slogantext`='$_POST[slogant2]' where `sloganid` = '2'";
        mysqli_query($db_link, $sqliit);
        echo "<script>alert('更改成功');location.href='AdminErrorSloganEdit.php'</script>";
    }

}
mysqli_close($db_link);
?>
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