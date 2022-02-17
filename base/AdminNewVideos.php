<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增法音類別 | 管理後台</title>

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

        <!--建立新經文-->
        <div class="row" style="margin-bottom: 20px; text-align: left">
            <div class="col-lg-12">
                <label for="content" style="color:#ffffff" ><b >影音類別:</b></label>
                <input id="type" name="type" type="text" style="width:525px; height:30px; color:#000000; "><br>
                <label for="content" style="color:#ffffff" ><b >類別地點:</b></label>
                <input id="local" name="local" type="text" style=" height:30px; ">


                <input type="submit" class="btn btn-sm btn-warning" name="go"
                       value="發佈">


            </div>

        </div>

        <div class="col-lg-12">
            <h2><b>新增影音類別</b><h1>
        </div>
        <!--Body-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                    <?php

mysqli_query($db_link, 'SET CHARACTER SET UTF-8');

$sql = "SELECT * FROM videotypes ";
$result = mysqli_query($db_link, $sql);
$sql_listorder = " SELECT MAX(listorder) as max FROM  `videotypes` ";
$listresult = mysqli_query($db_link, $sql_listorder);
$listcheck = mysqli_fetch_assoc($listresult);
$max_listorder = $listcheck['max'];

echo "<form name='form1' method='POST' action=''>";
echo "<table  border rules=rows cellspacing=0 width=100% style=font-size:20px;line-height:50px;>";
echo "<tr align=center>";
echo "<td><b>影音類別</b></td>";
echo "<td><b>地點</b></td>";
echo "<td></td>";
echo "</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr align=center>";
    echo "<td>$row[typename]</td>";
    echo "<td>$row[local]</td>";

    echo "<td>";

    ?>
                        <input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;'
                               name="<?php echo "$row[t_id]+2"; ?>" value='刪除'
                               onclick="return confirm('是否確認刪除此類別?')"></td>

                        <?php

    echo "</tr>";
}
echo "</table>";

$sql2 = "SELECT * FROM videotypes ";
$result2 = mysqli_query($db_link, $sql2);

while ($row2 = $result2->fetch_assoc()) {
    if (isset($_POST["$row2[t_id]+2"])) {
        $sqltid = "SELECT * FROM `videos` WHERE `videos`.`t_id` = '$row2[t_id]'";
        $resulttid = mysqli_query($db_link, $sqltid);
        if (mysqli_num_rows($resulttid) == 0) {
            $_SESSION["delete_t_id"] = $row2["t_id"];

            $sql_delete = "DELETE FROM videotypes WHERE videotypes.t_id = $_SESSION[delete_t_id]";
            mysqli_query($db_link, $sql_delete);
            echo "<script>alert('成功刪除法音類別!');location.href='AdminNewVideos.php'</script>";
        } else {
            echo "<script>alert('影音類別內含有影音連結無法刪除!');location.href='AdminNewVideos.php'</script>";
        }

    }

}

$type = $_POST["type"];
$local = $_POST["local"]; //新增講記類別
$sql2 = "SELECT * FROM videotypes where `local` = '$local' ";
$result2 = mysqli_query($db_link, $sql2);
$resultnum = mysqli_num_rows($result2);

if (isset($_POST["go"])) {
    if ($type == null) {
        echo "<script>alert('請輸入欲新增的法音類別!');location.href='AdminNewVideos.php'</script>";
    } else if ($local == null) {
        echo "<script>alert('請輸入欲新增的地點!');location.href='AdminNewVideos.php'</script>";
    } else if ($resultnum == null) {
        $sqltype = "INSERT INTO videotypes (typename,listorder,local) VALUES ('$type',' $max_listorder'+1,'$local')";
        mysqli_query($db_link, $sqltype);
        echo "<script>alert('法音類別建立成功!');location.href='AdminNewVideos.php'</script>";
    } else {
        echo "<script>alert('同類別有重複地點，請重新輸入!');location.href='AdminNewVideos.php'</script>";
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
</form>
</body>

</html>