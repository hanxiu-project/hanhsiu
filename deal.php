<?php include_once 'database.php'; ?>
<?php
if (isset($_POST['SelectedArticleType'])) {
    $SelectedId = $_POST['SelectedArticleType'];
    $sqlatcnum = "SELECT * FROM `scripture` where  `save`='0' && `t_id` = $SelectedId order by CONVERT(number , SIGNED)";
    $result_row = mysqli_query($db_link, $sqlatcnum);
    $inner = '';
    while ($script = mysqli_fetch_assoc($result_row)) {
        $inner = $inner . "<option value='$script[s_id]' >$script[number]</option>";
    }
    echo $inner;
}
if (isset($_POST['SelectedSupplementType'])) {
    $SelectedId = $_POST['SelectedSupplementType'];
    $sqlatcnum = "SELECT * FROM `supplements` where `save`='0' && `spt_id` = $SelectedId order by `sp_id`";
    $result_row = mysqli_query($db_link, $sqlatcnum);
    $inner = '';
    while ($script = mysqli_fetch_assoc($result_row)) {
        $inner = $inner . "<option value='$script[sp_id]' >$script[title]</option>";
    }
    echo $inner;
}

if (isset($_POST['SelectedVideoType'])) {
    $SelectedId = $_POST['SelectedVideoType'];
    $sqlatcnum = "SELECT s.* FROM video_smalltypes s where s.vbt_id = $SelectedId";
    $result_row = mysqli_query($db_link, $sqlatcnum);
    $inner = '';
    while ($script = mysqli_fetch_assoc($result_row)) {
        $inner = $inner . "<option value='$script[vst_id]' >$script[s_typename]</option>";
    }
    echo $inner;
}
