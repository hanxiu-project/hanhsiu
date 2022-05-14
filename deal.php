<?php include_once 'database.php'; ?>
<?php
if (isset($_POST['SelectedArticleType'])) {
    $SelectedId = $_POST['SelectedArticleType'];
    $sqlatcnum = "SELECT * FROM `scripture` where  `save`='0' && `t_id` = $SelectedId order by `number`";
    $result_row = mysqli_query($db_link, $sqlatcnum);
    $inner = '';
    while ($script = mysqli_fetch_assoc($result_row)) {
        $inner = $inner . "<option value='$script[s_id]' >$script[number]</option>";
    }
    echo $inner;
}
