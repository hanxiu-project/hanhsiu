<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>講記總覽 | 管理後台</title>

    <?php include 'head.php';

?>
              
        

</head>

<body>

<?php
session_start();
include 'verification.php';
?>

<form name="forms" method="get" action="">
    <div id="wrapper">
    <?php include 'nav.php'; ?>
        <?php include '../database.php'; ?>
    
        <?php
/*資料庫連結*/

$sqltype = "SELECT * FROM types order by listorder";
$resulttype = mysqli_query($db_link, $sqltype);

?>
        <!--建立新講記-->
        <div class="row" style="margin-bottom: 20px; text-align: left">
            <div class="col-lg-12">
                <a href="ScriptureManageNewType.php" class="btn btn-success " >建立新講記類別</a>
				<a href="AdminScripturePost.php" class="btn btn-success  " >建立新講記</a>

                <select id="type" name="type" style="width:525px; height:30px; color:#000000; background-color:white">
                    <option>請選擇類別</option>
                    <option value="all">全選</option>
                    <?php

while ($rowtype = $resulttype->fetch_assoc()) {
    echo "<option name=typeid value=$rowtype[typename]>$rowtype[typename]</option>";

}?>
                </select>

                <input type="submit" class="btn btn-sm btn-warning" name="gotype" value="查看講記類別">


            </div>

        </div>
</form>
        <div class="col-lg-12">
            <h2><b>講記總覽</b><h1>
        </div>
        <!--Body-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class='wrapper'>
                    <meta http-equiv="content-type" content="text/html;charset=UTF-8">

                    <?php
mysqli_query($db_link, 'SET CHARACTER SET UTF-8');
echo "<form name='form1' method='POST' action=''>";
echo "<table BORDER=1   width=100% style=font-size:20px;line-height:50px;>";
echo "<tr align=center>";
echo "<td>類別名稱</td>";
echo "<td>卷號</td>";

echo "<td>經文標題</td>";
echo "<td>發佈日期</td>";
echo "<td>最新修改管理員</td>";
echo "<td>前二位修改管理員</td>";

echo "<td></td>";
echo "<td></td>";
echo "</tr>";

if (!($_GET["type"]) || $_GET["type"] == "all") {
    $sql_tid="SELECT s.*, t.* FROM scripture s, types t WHERE save = '0' and s.t_id = t.t_id order by t.listorder";
    /*$sql_tid = "SELECT * FROM scripture  where save='0' order by t_id";*/
    $resultpage = mysqli_query($db_link, $sql_tid);
    $date_nums = mysqli_num_rows($resultpage); //講記數量
    $per = 10; //10筆換頁
    $pages = ceil($date_nums / $per); //共幾頁
    if (!isset($_GET["page"])) {
        $page = 1;
    } else {
        $page = intval($_GET["page"]); //確認頁數只能是數值資料
    }

    $start = ($page - 1) * $per;
   
    $sqlresult = "SELECT  s.*, t.* FROM scripture s, types t  where save='0' and s.t_id = t.t_id order by t.listorder ASC, CAST(`number` AS UNSIGNED) ASC Limit $start , $per";
    $scriptureresult[$start] = mysqli_query($db_link, $sqlresult);
    $scriptureresult[$page] = mysqli_query($db_link, $sqlresult);

    while ($row = mysqli_fetch_assoc($scriptureresult[$start])) {
        echo "<tr align=center>";
        echo "<td>$row[typename]</td>";
        echo "<td>$row[number]</td>";
        echo "<td>$row[title]</td>";
        echo "<td>$row[date]</td>";
        echo "<td>$row[newupdate]</td>";
        echo "<td>$row[secupdate]/$row[thrupdate]</td>";
        echo "<td><input type='submit' class='btn btn-sm btn-primary' style='width:100px;height:30px;' name='$row[s_id]+1' value='編輯'></td>";
        ?>
                            <td><input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;'
                                       name="<?php echo "$row[s_id]+2"; ?>" value='刪除'
                                       onclick="return confirm('是否確認刪除這篇講記?')"></td>
                            <?php

        echo "</tr>";
    }
    echo "</form>";
    echo "</table>";
    echo "<center>";
    echo '共 ' . $date_nums . ' 筆-在 ' . $page . ' 頁-共 ' . $pages . ' 頁';
    echo "<br/><a href=?page=1>首頁</a> ";
    echo "第 ";
    for ($i = 1; $i <= $pages; $i++) {
        if ($page - 10 < $i && $i < $page + 10) {
            echo "<a href=?page=$i>" . $i . "</a> ";
        }
    }
    echo " 頁 <a href=?page=$pages>末頁</a>";
    echo "</center>";
} else if (isset($_GET["type"])) {
    $sqltype = "SELECT * FROM scripture WHERE typename ='$_GET[type]' && save='0' order by t_id ASC,CAST(`number` AS UNSIGNED) ASC   ";
    $resulttype = mysqli_query($db_link, $sqltype);
    $date_nums = mysqli_num_rows($resulttype); //講記數量
    $per = 10; //10筆換頁
    $pages = ceil($date_nums / $per); //共幾頁
    if (!isset($_GET["page"])) {
        $page = 1;
    } else {
        $page = intval($_GET["page"]); //確認頁數只能是數值資料
    }

    $start = ($page - 1) * $per;

    $sqlresultsrc = "SELECT * FROM scripture WHERE typename ='$_GET[type]' && save='0' order by t_id ASC, CAST(`number` AS UNSIGNED)  ASC Limit $start , $per";
    $scriptureresult['src'] = mysqli_query($db_link, $sqlresultsrc);

    while ($row = mysqli_fetch_assoc($scriptureresult['src'])) {
        echo "<tr align=center>";
        echo "<td>$row[typename]</td>";
        echo "<td>$row[number]</td>";
        echo "<td>$row[title]</td>";
        echo "<td>$row[date]</td>";

        echo "<td>$row[newupdate]</td>";
        echo "<td>$row[secupdate]/$row[thrupdate]</td>";

        echo "<td><input type='submit' class='btn btn-sm btn-primary' style='width:100px;height:30px;' name='$row[s_id]+1' value='編輯'></td>";

        ?>
                            <td><input type='submit' class="btn btn-sm btn-danger " style='width:100px;height:30px;'
                                       name="<?php echo "$row[s_id]+2"; ?>" value='刪除'
                                       onclick="return confirm('是否確認刪除這篇講記?')"></td>
                            <?php
echo "</tr>";
    }

    echo "</form>";
    echo "</table>";
    echo "<center>";
    echo '共 ' . $date_nums . ' 筆-在 ' . $page . ' 頁-共 ' . $pages . ' 頁';
    echo "<br/><a href=?type=$_GET[type]&page=1>首頁</a> ";
    echo "第 ";
    for ($i = 1; $i <= $pages; $i++) {
        if ($page - 10 < $i && $i < $page + 10) {
            echo "<a href=?type=$_GET[type]&page=$i>" . $i . "</a> ";
        }
    }
    echo " 頁 <a href=?type=$_GET[type]&page=$pages>末頁</a>";
    echo "</center>";
}

$sql2 = "SELECT s_id,typename,number,title,date FROM scripture,types WHERE scripture.t_id = types.t_id";
$sql2 = "SELECT * FROM scripture ";
$result2 = mysqli_query($db_link, $sql2);

while ($row2 = $result2->fetch_assoc()) {
    if (isset($_POST["$row2[s_id]+1"])) {
        $_SESSION["edit_s_id"] = $row2["s_id"];
        echo "<script langauge = 'javascript' type='text/javascript'>";
        echo "window.location.href = 'AdminScriptureEdit.php'";
        echo "</script>";
    }

    if (isset($_POST["$row2[s_id]+2"])) {

        $_SESSION["delete_s_id"] = $row2["s_id"];
        $sql_delete = "DELETE FROM scripture WHERE scripture.s_id = $_SESSION[delete_s_id]";
        mysqli_query($db_link, $sql_delete);
        $filename = $row2["filename"]; //刪除檔案
        $typename = $row2["typename"]; //類別名稱

        unlink("../ScriptureFile/" . $typename . "/" . $filename);
        echo "<script>alert('成功刪除!');location.href='AdminScriptureManage.php'</script>";
    }
    if (isset($_POST["$row2[s_id]+1"])) {
        $_SESSION["edit_s_id"] = $row2["s_id"];
        echo "<script langauge = 'javascript' type='text/javascript'>";
        echo "window.location.href = 'AdminScriptureEdit.php'";
        echo "</script>";
    }
}
?>
                    <?php
mysqli_close($db_link);
?>

                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            

         
           
</body>

</html>
