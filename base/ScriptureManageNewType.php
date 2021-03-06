<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增講記類別總覽 | 管理後台</title>

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
        <?php include '../database.php'; ?>

        <?php
        /*資料庫連結*/

        $sqltype = "SELECT * FROM types ";
        $resulttype = mysqli_query($db_link, $sqltype);
        $sql_listorder =" SELECT MAX(listorder) as max FROM  `types` ";
        $listresult=mysqli_query($db_link,  $sql_listorder);
        $listcheck=mysqli_fetch_assoc($listresult);
        $max_listorder=$listcheck['max'];
       
        ?>
        <!--建立新經文-->
        <div class="row" style="margin-bottom: 20px; text-align: left">
            <div class="col-lg-12">
                <label for="content" style="color:#ffffff" ><b >新增講記類別:</b></label>
                <input id="type" name="type" type="text" style="width:525px; height:30px; color:#000000; ">
                <input type="submit" class="btn btn-sm btn-warning" name="go" value="發佈">
            </div>
        </div>

        <div class="col-lg-12">
            <h2><b>新增講記類別</b><h1>
        </div>

        <!--Body-->
        <div id="page-wrapper">

            <div class="container-fluid">

                <table class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                    <?php
                    $sql = "SELECT * FROM types ";
                    $result = mysqli_query($db_link, $sql);

                    echo "<form name='form1' method='POST' action=''>";
                    echo "<table border rules=rows cellspacing=0 width=100% style=font-size:20px;line-height:50px;>";
                    echo "<tr align=center>";
                    echo "<td><b>講記類別</b></td>";
                    echo "<td></td>";
                    echo "</tr>";

                    while ($row = $result->fetch_array()) {
                        echo "<tr align=center>";
                        echo "<td>$row[typename]</td>";
                        echo "<td>";
                        ?>

                        <input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;'
                               name="<?php echo "$row[t_id]+2"; ?>" value='刪除'
                               onclick="return confirm('是否確認刪除此類別?')"></td>
						
                        <?php
                        echo "</tr>";
						
                    }
                    echo "</table>";
                    ?>
                    <?php
                    //$sql2="SELECT s_id,typename,number,title,date FROM scripture,types WHERE scripture.t_id = types.t_id";
                    $sql2 = "SELECT * FROM types ";
                    $result2 = mysqli_query($db_link, $sql2);

                    while ($row2 = $result2->fetch_assoc()) {
                        if (isset($_POST["$row2[t_id]+2"])) {
                            $file_path = "ScriptureFile/$row2[typename]";
                            if (is_dir($file_path)) {//先判斷是不是資料夾
                                if (rmdir($file_path)) {//判斷是否能刪除成功
//                                    echo “刪除資料夾成功”;
                                    $_SESSION["delete_t_id"] = $row2["t_id"];
                                    $sql_delete = "DELETE FROM types WHERE types.t_id = $_SESSION[delete_t_id]";
                                    mysqli_query($db_link, $sql_delete);
                                    echo "<script>alert('成功刪除!');location.href='ScriptureManageNewType.php'</script>";
                                }
                                else
                                {
                                    echo "<script>alert('此類別含有講記無法刪除!');location.href='ScriptureManageNewType.php'</script>";
                                    //echo "此類別含有講記無法刪除！";//如果資料夾不為空，是無法刪除的
                                }
                            } else {
                                echo "<script>alert('講記類別不存在!');location.href='ScriptureManageNewType.php'</script>";
                                //echo "講記類別不存在！";        資料夾不存在
                            }


                        }
                    }

                    $type = $_POST["type"];                     //新增講記類別

                    if (isset($_POST["go"])) {
                        if ($type == null) {
                            echo "<script>alert('請輸入欲新增的類別!');location.href='ScriptureManageNewType.php'</script>";
                        } else {
                            //資料夾的建立
                            $file_path = "ScriptureFile/$type";
                            if (!file_exists($file_path)) {
                                mkdir($file_path);
                                //echo “建立資料夾成功”;
                                $sqltype = "INSERT INTO types (typename,listorder) VALUES ('$type','$max_listorder'+1)";
                                mysqli_query($db_link, $sqltype);
                                echo "<script>alert('講記類別建立成功! ');location.href='ScriptureManageNewType.php'</script>";
                            } else {
//                            echo “資料夾已存在”;
                                echo "<script>alert('講記類別已存在!');location.href='ScriptureManageNewType.php'</script>";
                            }

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
