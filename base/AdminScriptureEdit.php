<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../ckeditor/ckeditor.js?ver=<?php echo time(); ?>"></script>

    <title>新增講記 | 管理後台</title>
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

    <!--Body-->
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class='wrapper'>
                <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                <?php
/*資料庫連結*/

$sql = "SELECT * FROM scripture WHERE scripture.s_id = $_SESSION[edit_s_id]";
$result = mysqli_query($db_link, $sql);
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT typename FROM scripture,types WHERE scripture.t_id = types.t_id AND scripture.s_id = $_SESSION[edit_s_id]";
$result2 = mysqli_query($db_link, $sql2);
$row2 = mysqli_fetch_assoc($result2);
# 設定時區
date_default_timezone_set('Asia/Taipei');
$getDate = date("Y-m-d");

//讀取檔案
$oldfilename = $row["filename"];
$typename = $row["typename"]; //原本的
$str = "";

//判斷是否有該檔案
if (file_exists("../ScriptureFile/$typename/$oldfilename")) {
    $filee = fopen("../ScriptureFile/$typename/$oldfilename", "r");
    if ($filee != null)
    //當檔案未執行到最後一筆，迴圈繼續執行(fgets一次抓一行)
    {
        while (!feof($filee)) {
            $str .= fgets($filee);
        }
        fclose($filee);
    }
}
?>

                <div id="con2">
                    <div class="main">
                        <div class="newstitle" >

                            <div class="contentlist">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <form name="forms" method="POST" action="">

											<?php
$sqltype = "SELECT * FROM types ";
$resulttype = mysqli_query($db_link, $sqltype);
?>
											<div class="form-group">
											<label for="type">類別編號:</label>
											<select id="type" name="type"  style="width:525px; height:30px; color:#000000; background-color:white">
											<?php

while ($rowtype = $resulttype->fetch_assoc()) {
    if ($row['typename'] == $rowtype['typename']) //先前的與現在抓資料庫的相同
    {
        echo "<option name=typeid value=$rowtype[t_id] selected>$rowtype[typename]</option>";
    } else {
        echo "<option name=typeid value=$rowtype[t_id]>$rowtype[typename]</option>";
    }
    $sqltypeinput = "SELECT * FROM `types` where `t_id`='$_POST[type]'";
    $resulttypeinput = mysqli_query($db_link, $sqltypeinput);
    $rowinput = mysqli_fetch_assoc($resulttypeinput);
    $inputtype = $rowinput['typename']; //選項中的
}
?>

											</select>
                                            </div>


                                        <div class="form-group">
                                            <label for="number">卷號:</label>
                                            <input id="number" name="number" type="text" value="<?php echo $row['number'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent">
                                        </div>


                                        <div class="form-group">
                                            <label for="title">講記標題:</label>
                                            <input id="title" name="title" type="text"  value="<?php echo $row['title'] ?>" style="width:525px; height:30px; color:#000000; background-color:transparent" >
                                        </div>

                                        <div class="form-group">
                                            <label for="content">講記內容:</label>
                                            <textarea id="content" name="content" rows="10" cols="80"><?php echo $str ?></textarea>
                                            <script>
                                                CKEDITOR.replace('content',{
                                                    width:1000,height:500,
                                                });
                                            </script>
                                        </div>

                                        <div class="form-group">
                                            <label for="date">發佈日期:</label>
                                            <input id="date" name="date" type="date" value="<?php echo $getDate ?>" style="width:525px; height:30px; color:#000000; background-color:transparent" >
                                        </div>

                                        <div class="form-group">
										<?php
if ($row["save"] = '1') {
    ?>
                                            <input type="submit" class="btn btn-sm btn-warning" name="save" value="暫存" >
                                            <?php
}
?>
                                            <input type="submit" class="btn btn-sm btn-warning" name="edit" value="發佈" >
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

$sqlmodify = "SELECT * FROM scripture WHERE scripture.s_id = $_SESSION[edit_s_id]";
$resultmodify = mysqli_query($db_link, $sqlmodify);
$rowmodify = mysqli_fetch_assoc($resultmodify);
$secupdate = $rowmodify["newupdate"];
$thrupdate = $rowmodify["secupdate"];
$number = $_POST["number"];
$title = $_POST["title"];
$filename = $_POST["number"] . ".txt";
$content = $_POST["content"];
$date = $_POST["date"];
$nnewupdate = $_SESSION["updatename"];

$sql_update_all = "UPDATE scripture SET `t_id` = '$_POST[type]',`typename` = '$inputtype',`number` = '$number',`title` = '$title',`filename` = '$filename',`content` = '$content',`date` = '$date',`save` = '0' WHERE scripture.s_id = $_SESSION[edit_s_id]";
$sql_update_all_save = "UPDATE scripture SET `t_id` = '$_POST[type]',`typename` = '$inputtype',`number` = '$number',`title` = '$title',`filename` = '$filename',`content` = '$content',`date` = '$date',`save` = '1' WHERE scripture.s_id = $_SESSION[edit_s_id]";
$sql_update_newupdate = "UPDATE scripture SET `newupdate` = '$nnewupdate',`secupdate` = '$secupdate',`thrupdate` = '$thrupdate' WHERE scripture.s_id = $_SESSION[edit_s_id]";

if (isset($_POST["edit"])) //發佈
{

    if ($_POST["type"] != null && $_POST["number"] != null && $_POST["title"] != null && $_POST["content"] != null && $_POST["date"] != null) {

        if ($_POST["number"] . ".txt" != $oldfilename) //若檔名與之前的不同  單改檔名
        {
            $sql3 = "SELECT * FROM scripture ";
            $result3 = mysqli_query($db_link, $sql3);

            while ($row3 = $result3->fetch_assoc()) {

                if ($_POST["number"] . ".txt" == $row3["filename"]) { //檢查新檔名有沒有在資料庫，有就會重複，沒有就下一個

                    echo "<script>alert('講記卷號重複，請重新輸入！');location.href='AdminScriptureEdit.php'</script>";
                } elseif ($typename != $inputtype) //類別有改過的話，原本的 != 現在選的
                {
                    unlink("../ScriptureFile/" . $typename . "/" . $filename);

                    //寫入檔案
                    $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
                    $txt = $content;
                    fwrite($myfile, $txt);
                    fclose($myfile);

                    mysqli_query($db_link, $sql_update_all);
                    mysqli_query($db_link, $sql_update_newupdate);
                    echo "<script>alert('經文發佈完成!');location.href='AdminScriptureManage.php'</script>";
                } else //檔名沒重複且類別沒改
                {
                    unlink("../ScriptureFile/" . $typename . "/" . $oldfilename);

                    $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
                    $txt = $content;
                    fwrite($myfile, $txt);
                    fclose($myfile);

                    mysqli_query($db_link, $sql_update_all);
                    mysqli_query($db_link, $sql_update_newupdate);
                    echo "<script>alert('經文發佈完成!');location.href='AdminScriptureManage.php'</script>";
                }
            }
        } else if ($typename != $inputtype) //類別有改過的話(原本的 != 現在選的)  單改類別
        {
            unlink("../ScriptureFile/" . $typename . "/" . $oldfilename);

            //寫入檔案
            $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
            $txt = $content;
            fwrite($myfile, $txt);
            fclose($myfile);

            mysqli_query($db_link, $sql_update_all);
            mysqli_query($db_link, $sql_update_newupdate);
            echo "<script>alert('經文發佈完成!');location.href='AdminScriptureManage.php'</script>";
        } else //檔名相同             沒改類別沒改檔名
        {
            $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
            $txt = $content;
            fwrite($myfile, $txt);
            fclose($myfile);

            mysqli_query($db_link, $sql_update_all);
            mysqli_query($db_link, $sql_update_newupdate);
            echo "<script>alert('經文發佈完成!');location.href='AdminScriptureManage.php'</script>";
        }
    } else if ($_POST["type"] == null || $_POST["number"] == null || $_POST["title"] == null || $_POST["content"] == null || $_POST["date"] == null) {
        echo "<script>alert('尚有欄位未填入資料，請輸入後再發佈！');location.href='AdminScriptureEdit.php'</script>";
    }
}

if (isset($_POST["save"])) {
    //寫入檔案
    $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
    $txt = $content;
    fwrite($myfile, $txt);
    fclose($myfile);

    if ($_POST["type"] != null && $_POST["number"] != null && $_POST["title"] != null && $_POST["content"] != null && $_POST["date"] != null) {
        if ($_POST["number"] . ".txt" != $oldfilename) //若檔名與之前的不同
        {
            $sql3 = "SELECT * FROM scripture ";
            $result3 = mysqli_query($db_link, $sql3);

            while ($row3 = $result3->fetch_assoc()) {
                if ($_POST["number"] . ".txt" == $row3["filename"]) {
                    echo "<script>alert('講記卷號重複，請重新輸入！');location.href='AdminScriptureEdit.php'</script>";
                } else if ($typename != $inputtype) //類別有改過的話(原本的 != 現在選的)
                {
                    unlink("../ScriptureFile/" . $typename . "/" . $filename);

                    //寫入檔案
                    $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
                    $txt = $content;
                    fwrite($myfile, $txt);
                    fclose($myfile);

                    mysqli_query($db_link, $sql_update_all_save);
                    mysqli_query($db_link, $sql_update_newupdate);
                    echo "<script>alert('經文暫存完成!');location.href='AdminScriptureSave.php'</script>";
                } else {
                    unlink("../ScriptureFile/" . $typename . "/" . $oldfilename);

                    $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
                    $txt = $content;
                    fwrite($myfile, $txt);
                    fclose($myfile);

                    mysqli_query($db_link, $sql_update_all_save);
                    mysqli_query($db_link, $sql_update_newupdate);
                    echo "<script>alert('經文暫存完成!');location.href='AdminScriptureSave.php'</script>";
                }
            }
        } else if ($typename != $inputtype) //類別有改過的話(原本的 != 現在選的)
        {
            unlink("../ScriptureFile/" . $typename . "/" . $filename);

            //寫入檔案
            $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
            $txt = $content;
            fwrite($myfile, $txt);
            fclose($myfile);

            mysqli_query($db_link, $sql_update_all_save);
            mysqli_query($db_link, $sql_update_newupdate);
            echo "<script>alert('經文暫存完成!');location.href='AdminScriptureSave.php'</script>";
        } else //檔名相同
        {

            $myfile = fopen("../ScriptureFile/$inputtype/$filename", "w+") or die("Unable to open file!");
            $txt = $content;
            fwrite($myfile, $txt);
            fclose($myfile);

            mysqli_query($db_link, $sql_update_all_save);
            mysqli_query($db_link, $sql_update_newupdate);
            echo "<script>alert('經文暫存完成!');location.href='AdminScriptureSave.php'</script>";
        }
    }
}
?>

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
