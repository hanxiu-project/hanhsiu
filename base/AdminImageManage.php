<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>照片總覽 | 管理後台</title>

    <?php
include 'head.php';
?>
</head>

<body>
<?php
session_start();
include 'verification.php';
?>

<form name="forms" method="post" action="">

    <div id="wrapper">
        <?php include 'nav.php';?>
        <?php include '../database.php';?>

        <div class="col-lg-12">
            <h2><b>照片總覽</b><h1>
        </div>

        <!--Body-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                    <?php
mysqli_query($db_link, 'SET CHARACTER SET UTF-8');

$sql = "SELECT * FROM carousel";
$result = mysqli_query($db_link, $sql);

echo "<form name='form1' method='POST' action=''>";
echo "<table border rules=rows cellspacing=0  width=100% style=font-size:24px;line-height:50px; >";
echo "<tr align=center>";
echo "<td>照片圖示</td>";
echo "<td>照片名稱</td>";
echo "<td>上傳日期</td>";
echo "<td></td>";
echo "</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr align=center>";
    echo "<td><img src='images/$row[imgname] '  width='100px' height='100px' alt=''>";
    echo "$row[imgname]</td>";
    echo "<td>$row[uploadtime]</td>";
    ?>
                        <td><input type='submit' class="btn btn-sm btn-danger " name="<?php echo "$row[id]+2"; ?>" value='刪除' onclick="return confirm('是否確認刪除這張照片?')"></td>
                        <?php
echo "</tr>";
}
echo "</table>";

$sql2 = "SELECT * FROM carousel";
$result2 = mysqli_query($db_link, $sql2);

while ($row2 = $result2->fetch_assoc()) {

    if (isset($_POST["$row2[id]+2"])) {
        $_SESSION["delete_id"] = $row2["id"];
        $sql_delete = "DELETE FROM carousel WHERE id = $_SESSION[delete_id]";
        mysqli_query($db_link, $sql_delete);
        unlink($row2["path2"]);
        echo "<script>alert('成功刪除!');location.href='AdminImageManage.php'</script>";
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