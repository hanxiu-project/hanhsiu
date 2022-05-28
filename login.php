<?php include 'database.php'; ?>
<?php $title = '註冊/登入'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>
<!-- STYLE -->

<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>

<body>
    <main>
        <section class="bg-style__3">
            <div class="container">
                <div class="row justify-content-center justify-content-md-end">
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 login-wrap d-flex flex-column justify-content-center">
                        <div class="logo-circle mb-4">
                            <img src="img/logo_circle.png" alt="漢修學苑" />
                        </div>

                        <!--<form class="mt-4 px-4" action="member.html">-->
                        <form name="login01" method="post" action="">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="account" id="floatingInput" placeholder="account" />
                                <label for="floatingInput">帳號 / Account</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" />
                                <label for="floatingPassword">密碼 / Password</label>
                            </div>
                            <div class="mb-3 d-flex justify-content-center">
                                <div class="g-recaptcha" data-sitekey="6Lf2IyUgAAAAAHcP8VEbVsTnUXBkTiPGleznYRWx"></div>
                            </div>

                            <input type="submit" name="gologin" class="btn-style__1 full-w" value="登入" />
                        </form>

                        <div class="text-end mt-3">
                            <a class="link-style__2" href="forgetpw.html">忘記密碼</a>
                        </div>

                        <hr class="line-style__1" />

                        <div class="px-4">
                            <p>還沒有帳號？</p>
                            <a class="btn-style__1 full-w" href="registered.php">前往註冊</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        /*$_SESSION['acc'] = $_POST["account"];                            //session存帳號密碼
    $_SESSION['pwd'] = $_POST["password"];*/

        $sql_login = "SELECT * FROM `members` WHERE `account` = '$_POST[account]'";
        $result = mysqli_query($db_link, $sql_login);
        $row = mysqli_fetch_assoc($result);                        //查詢資料庫
        $acc = $row["account"];                                        //查詢到的帳號
        $pwdhash = $row["password"];                                        //查詢到的密碼
        $authority = $row["authority"];
        $_SESSION['authority'] = $authority;
        $_SESSION['name'] = $row["name"];
        $_SESSION['m_id'] = $row["m_id"];
        $_SESSION["verified"] = $row["verified"];

        if (isset($_POST["gologin"])) {
            if ($_POST["account"] == null || $_POST["password"] == null) {
                echo "<script>alert('請輸入帳號或密碼！');location.href='login.php'</script>";
            } else if ($acc != $_POST["account"] || (!password_verify($_POST["password"], $pwdhash))) {
                echo "<script>alert('帳號或密碼錯誤！請重新輸入。');location.href='login.php'</script>";
            }
            /*else if ($_SESSION["verified"] == 0) {
            echo "<script>alert('帳號尚未驗證，請至email收取信驗證信。');location.href='login.php'</script>";

=======
        } */ else if ($authority == 0) {
                $_SESSION['acc'] = $_POST["account"];                            //session存帳號密碼
                $_SESSION['pwd'] = $pwdhash;
                //header("location:indexs.php");
                echo "<script>location.href='news.php';</script>";        //導向一般會員頁面
            } else if ($authority == 1 || $authority == 2) {
                $_SESSION['acc'] = $_POST["account"];                            //session存帳號密碼
                $_SESSION['pwd'] = $pwdhash;
                $_SESSION["updatename"] = "$row[name]";
                //header("location:AdminScriptureManage.php");
                echo "<script>location.href='AdminScriptureManage.php';</script>";        //導向管理員頁面


            }
        }
        ?>
    </main>

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