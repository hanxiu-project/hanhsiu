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
    
    <?php include 'nav.php'; ?>
        <?php include '../database.php'; ?>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
                url: 'videosort.php',
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
        
       
        <div class="col-lg-12">
            <font size="6"><strong style= "background:white" >影音排序(直接拉就可以改變)</strong></font>
        </div>

        <!--Body-->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <table class="table table-striped table-hover table-bordered">
                    <thead>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_POST['update']))
                    {
                        foreach ($_POST['positions'] as $position) {
                            $index = $position[0];
                            $newposiotion = $position[1];
                            $sql = "UPDATE videos SET listorder = '$newposiotion' WHERE v_id= '$index'";
                            mysqli_query($db_link, $sql);
                            echo "<script>alert('排序完成!');location.href='test.php'</script>";
                        }
                        exit('success');
                    }

                    $sql="select * from `videos` where `typename`= '$_SESSION[typename]'   order by listorder ";
                    $result=mysqli_query($db_link,$sql);
                    echo "<tr align=center width='70%'>";
                    echo "<td width='20%'><b>順序編號</b></td>";
                    echo "<td width='80%'><b>影音類別</b></td>";
                    echo "</tr>";
                    while ($data = $result->fetch_array())
                    {
                        echo "<tr data-index=$data[v_id] data-position=$data[listorder]>";
                        echo "<td> $data[listorder] </td>";
                   
                        echo "<td>$data[vcontent]</td>";
                        
                       
                        echo "</tr>";
                    }

                    ?>
                    </tbody>
                  </table>

            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->


     
</form>
</body>

</html>
