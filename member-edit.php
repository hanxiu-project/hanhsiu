<?php include 'database.php'; ?>
<?php $title = '會員修改資料'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>

<body>
<?php
    $sql = "SELECT * FROM `members` WHERE `account` = '$_SESSION[acc]'";
    $result = mysqli_query($db_link, $sql);
    $row = $result->fetch_assoc()
?>

<main>
    <section class="bg-style__1">
        <div class="container bg-style__4 wrap-minheight p-4">
            <div class="w-1000 mx-auto">
                <div class="my-4 d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                    <h4 class="heading-style__2 mb-2 mb-md-0">會員中心<span class="tline">修改會員資料</span></h4>
                    <span class="color01"><?php echo "$row[name]" ?>，您好！</span>
                </div>

                <form class="mt-4" name="member-edit" method="post" action="">
                    <div class="mb-3 row">
                        <label for="inputName" class="col-sm-5 col-lg-3 col-form-label">姓名 / Ｎame</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="請輸入姓名" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputName" class="col-sm-5 col-lg-3 col-form-label">性別 / Ｇender</label>
                        <div class="col-sm-7 col-lg-9 d-flex">
                            <div class="form-check me-4">
                                <input class="form-check-input" type="radio" name="sex" id="flexRadioDefault1" />
                                <label class="form-check-label" for="flexRadioDefault1">男</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sex" id="flexRadioDefault2" checked />
                                <label class="form-check-label" for="flexRadioDefault2">女</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-5 col-lg-3 col-form-label">電子信箱 / E-mail</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="請輸入電子信箱" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPhone" class="col-sm-5 col-lg-3 col-form-label">手機號碼 / Phone</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="tel" class="form-control" id="inputPhone" name="telephone" placeholder="請輸入手機號碼" />
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="inputAddress" class="col-sm-5 col-lg-3 col-form-label">地址 / Address</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="請輸入地址" />
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn-style__1" value="儲存" name="save" />
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
    $sql_mail = "SELECT * FROM `members` where `email`='$_POST[email]'";
    $result_mail = mysqli_query($db_link, $sql_mail) or die("查詢失敗");
    $row_mail = mysqli_fetch_assoc($result_mail);
    $mail_check = $row_mail['email'];

    if (isset($_POST["save"])) {
        if ($_POST["name"] == null || $_POST["sex"] == null || $_POST["email"] == null || $_POST["telephone"] == null || $_POST["address"] == null) {
            echo "<script>alert('請輸入必填欄位');location.href='member-edit.php'</script>";
        }
        elseif ($mail_check == $_POST['email']) {
            echo "<script>alert('Email已被使用請重新輸入');location.href='member-edit.php'</script>";
        }
        else {
            $sql_insert = "INSERT INTO `members` (name,gender,email,address,telephone) VALUES ('$_POST[name]','$_POST[sex]','$_POST[email]','$_POST[address]','$_POST[telephone]')";
            mysqli_query($db_link, $sql_insert);
            echo "<script>alert('修改完成！');location.href='member.php'</script>";
        }
    }
?>

<footer w3-include-html="include/_footer.php"></footer>

<!-- JAVASCRIPT W3 -->
<script>
    w3.includeHTML();
</script>

<!-- JAVASCRIPT -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/main.js"></script>
</body>
</html>
