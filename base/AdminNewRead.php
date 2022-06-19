<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增讀誦類別 | 管理後台</title>
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

        <!--建立新讀誦類別-->
        <div class="row" style="margin-bottom: 20px; text-align: left">
            <div class="col-lg-12">
                <label for="type" style="color:#ffffff" ><b >讀誦類別:</b></label>
                <input id="type" name="type" type="text" style="width:300px; height:30px; color:#000000; ">
                <input type="submit" class="btn btn-sm btn-warning" name="go" value="新增">
            </div>
        </div>

        <?php
        $sql_type = "SELECT * FROM repeataftermetypes ";
        $result_type = mysqli_query($db_link, $sql_type);
        ?>

        <div class="col-lg-12">
            <h2><b>新增讀誦類別</b><h2>
        </div>
        <!--Body-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
                    <?php
                    mysqli_query($db_link, 'SET CHARACTER SET UTF-8');

                    $sql = "SELECT * FROM repeataftermetypes ";
                    $result = mysqli_query($db_link, $sql);

                    echo "<form name='form1' method='POST' action=''>";
                    echo "<table  border rules=rows cellspacing=0 width=100% style=font-size:20px;line-height:50px;>";
                    echo "<tr align=center>";
                    echo "<td><b>類別名稱</b></td>";
                    echo "<td></td>";
                    echo "</tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr align=center>";
                        echo "<td>$row[repeatype]</td>";
                        echo "<td>";
                        ?>
                        <input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;'
                               name="<?php echo "$row[t_id]+2"; ?>" value='刪除'
                               onclick="return confirm('是否確認刪除此類別?')"></td>
                        <?php
                        echo "</tr>";
                    }
                    echo "</table>";


                    $sql2 = "SELECT * FROM repeataftermetypes ";
                    $result2 = mysqli_query($db_link, $sql2);
                    while ($row2 = $result2->fetch_assoc()) {
                        if (isset($_POST["$row2[t_id]+2"])) {
                            $sql_t_id = "SELECT * FROM `repeatafterme` WHERE `repeatafterme`.`t_id` = '$row2[t_id]'";
                            $result_t_id = mysqli_query($db_link, $sql_t_id);
                            if (mysqli_num_rows($result_t_id) == 0) {
                                $_SESSION["delete_t_id"] = $row2["t_id"];
                                $sql_t_delete = "DELETE FROM repeataftermetypes WHERE repeataftermetypes.t_id = $_SESSION[delete_t_id]";
                                mysqli_query($db_link, $sql_t_delete);
                                echo "<script>alert('成功刪除讀誦類別!');location.href='AdminNewRead.php'</script>";
                            } else {
                                echo "<script>alert('讀誦類別內含有內容無法刪除!');location.href='AdminNewRead.php'</script>";
                            }
                        }
                    }

                    if (isset($_POST["go"])) {
                        if ($_POST["type"] == null) {
                            echo "<script>alert('請輸入欲新增的讀誦類別!');location.href='AdminNewRead.php'</script>";
                        }
                        else {
                            $sqltype = "INSERT INTO repeataftermetypes (repeatype) VALUES ('$_POST[type]')";
                            mysqli_query($db_link, $sqltype);
                            echo "<script>alert('讀誦類別建立成功!');location.href='AdminNewRead.php'</script>";
                        }
                    }
                    ?>


                    <?php
                    mysqli_close($db_link);
                    ?>
                </div>
                <!-- /#page-wrapper -->
            </div>
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
