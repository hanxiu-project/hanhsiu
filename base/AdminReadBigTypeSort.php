<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>讀誦大類別排序 | 管理後台</title>

    <?php
    include 'head.php';
    ?>

    <!-- 後台講記排序 CSS -->
    <link href="style.css" rel="stylesheet" type="text/css">

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('table tbody').sortable({
                update:function (event,ui){
                    $(this).children().each(function (index){
                        if ($(this).attr('data-position') != (index)){
                            $(this).attr('data-position',(index)).addClass('updated');
                        }
                    });

                    saveNewPositions();
                }
            });
        });

        function  saveNewPositions(){
            var positions = [];
            $('.updated').each(function (){
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                $(this).removeClass('updated');
            });

            $.ajax({
                url: 'AdminReadBigTypeSort.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    update: 1,
                    positions: positions
                }, success: function (response){
                    console.log(response);
                    window.location.reload();
                }
            });
        }
    </script>
</head>

<body>
<?php
session_start();
include 'verification.php';
?>
<form name="forms" method="post" action="">
    <div id="wrapper">
        <?php
        include 'nav.php';
        include '../database.php';
        ?>

        <div class="col-lg-12">
            <h2><b>讀誦大類別排序(直接拉就可以改變)</b><h1>
        </div>
        <!--Body-->
        <div id="page-wrapper">
            <div class="container-fluid">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_POST['update'])) {
                        foreach ($_POST['positions'] as $position) {
                            $index = $position[0];
                            $newposiotion = $position[1];
                            $sql = "UPDATE repeatafterme_bigtypes SET listorder = '$newposiotion' WHERE t_id= '$index'";
                            mysqli_query($db_link, $sql);
                            echo "<script>alert('排序完成!');location.href='test.php'</script>";
                        }
                        exit('success');
                    }

                    $sql = "select * from repeatafterme_bigtypes order by listorder";
                    $result = mysqli_query($db_link, $sql);
                    echo "<tr align=center width='70%'>";
                    echo "<td width='20%'><b>順序編號</b></td>";
                    echo "<td width='80%'><b>讀誦大類別</b></td>";
                    echo "</tr>";
                    while ($data = $result->fetch_array()) {
                        echo "<tr data-index=$data[t_id] data-position=$data[listorder]>";
                        echo "<td> $data[listorder] </td>";
                        echo "<td> $data[repeatype] </td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>

            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->


        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>
</form>
</body>

</html>
