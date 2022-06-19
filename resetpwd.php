<!DOCTYPE html>
<html lang="en">
<?php include 'database.php'; ?>
<?php $title = '重設密碼'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>漢修學苑</title>
    <link rel="shortcut icon" href="favicon.ico" />

    <!-- FACEBOOK SEO -->
    <meta property="og:title" content="漢修學苑" />
    <meta property="og:url" content="https://hanhsiu.org/" />
    <meta property="og:image" content="img/fb-open-graph-1.jpg" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="《瑜伽師地論》線上筆記" />
    <meta property="og:locale" content="zh_tw" />

    <!-- OTHER SETTING -->
    <meta name="format-detection" content="telephone=no" />
    <meta name="theme-color" content="#70593e" />

    <!-- STYLE -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="css/icofont/style.css" />
    <link rel="stylesheet" href="css/main.css" />

    <!-- JAVASCRIPT -->
    <script src="js/w3.js"></script>
</head>
<body>
<main>
    <?php

    if(isset($_GET['fgpwd']))
    {

    ?>
    <section class="bg-style__1">
        <div class="container bg-style__4 wrap-minheight p-4">
            <div class="w-1000 mx-auto">
                <h4 class="heading-style__2 mt-4">重新設定密碼</h4>

                <form class="mt-4" action="login.html">
                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-5 col-lg-3 col-form-label">電子信箱 / E-mail</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="請輸入電子信箱" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-5 col-lg-3 col-form-label">新密碼 / NewPassword</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="請輸入新密碼" />
                        </div>
                    </div>
                    <div class="mb-5 row">
                        <label for="inputPasswordAgain" class="col-sm-5 col-lg-3 col-form-label">確認新密碼 / Confirm</label>
                        <div class="col-sm-7 col-lg-9">
                            <input type="password" class="form-control" id="inputPasswordAgain" name="re_password" placeholder="請再次輸入新密碼" />
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn-style__1" value="確認" name="newpwd" />
                    </div>
                </form>
            </div>
        </div>
    </section>

        <?php

        $sql_email = "SELECT * FROM `members` WHERE `email` = '$_POST[email]'";
        $result = mysqli_query($db_link, $sql_email);
        $row = mysqli_fetch_assoc($result);						//查詢資料庫
        $resultnum=mysqli_num_rows($result);
        $acc = $row["account"];  										//查詢到的帳號
        $pwd = $row["password"];										//查詢到的密碼
        $email = $row["email"];

        if (isset($_POST["newpwd"])) {
            if($email != $_POST['email'])
            {
                echo "<script>alert('查無此電子郵件，請重新輸入。');</script>";
            }
            else if ($_POST[password] != $_POST[re_password]) {
                echo "<script>alert('確認密碼不符，請重新輸入');</script>";
            }
            else if ($email == $_POST[email] && $_POST[password] == $_POST[re_password]) {
                $sqlup_pwd="UPDATE `members` SET `password` = '$_POST[password]' WHERE `members`.`email` = '$_POST[email]'";
                mysqli_query($db_link,$sqlup_pwd);
                echo "<script>alert('修改完成，請重新登入');location.href='login.php'</script>";

            }

        }
    }

    mysqli_close($db_link);
    ?>
</main>

<footer w3-include-html="include/_footer.html"></footer>

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
