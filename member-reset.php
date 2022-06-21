<?php include 'database.php'; ?>
<?php $title = '會員重設密碼'; ?>
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
                    <h4 class="heading-style__2 mb-2 mb-md-0">會員中心<span class="tline">修改密碼</span></h4>
                    <span class="color01"><?php echo "$row[name]" ?>，您好！</span>
                </div>

                <form class="mt-4" name="member-reset" method="post" action="">
                    <div class="mb-3 row">
                        <label for="inputPasswordOrg" class="col-sm-5 col-lg-3 col-form-label">密碼 / Password</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="password" class="form-control" name="password" id="inputPasswordOrg" placeholder="請輸入目前密碼" />
                        </div>
                    </div>
                    <hr class="line-style__1" />
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-5 col-lg-3 col-form-label">新密碼 / NewPassword</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="password" class="form-control" name="new_password" id="inputPassword" placeholder="請輸入新密碼" />
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="inputPasswordAgain" class="col-sm-5 col-lg-3 col-form-label">確認新密碼 / Confirm</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="password" class="form-control" name="re_password" id="inputPasswordAgain" placeholder="請再次輸入新密碼" />
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn-style__1" value="確認" name="go" />
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>


<?php
    if (isset($_POST["go"])) {
        $pw_hash = $row["password"];

        if(!password_verify($_POST["password"], $pw_hash))
        {
            echo "<script>alert('舊密碼輸入錯誤，請重新輸入。');</script>";
        }
        else if ($_POST["new_password"] != $_POST["re_password"]) {
            echo "<script>alert('確認密碼不符，請重新輸入');</script>";
        }
        else if (password_verify($_POST["password"], $pw_hash) && $_POST["new_password"] == $_POST["re_password"]) {
            $password_hash = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

            $sqlup_pwd="UPDATE `members` SET `password` = '$password_hash' WHERE `members`.`account` = '$row[account]'";
            mysqli_query($db_link,$sqlup_pwd);
            echo "<script>alert('修改完成，請重新登入');location.href='member.php'</script>";
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
