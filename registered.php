<?php include 'database.php'; ?>
<?php $title = '會員註冊'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>

<body>

    <main>
        <section class="bg-style__1">
            <div class="container bg-style__4 wrap-minheight p-4">
                <div class="w-1000 mx-auto">
                    <h4 class="heading-style__2 mt-4">會員註冊</h4>
                    <form name="registered" method="post" action="">
                        <!--<form class="mt-4" action="login.php">-->
                        <div class="mb-3 row">
                            <label for="inputAccount" class="col-sm-5 col-lg-3 col-form-label">帳號 / Account</label>
                            <div class="col-sm-7 col-lg-9">
                                <input type="text" class="form-control" name="inputAccount" id="inputAccount" placeholder="請輸入帳號" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-5 col-lg-3 col-form-label">密碼 / NewPassword</label>
                            <div class="col-sm-7 col-lg-9">
                                <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="請輸入密碼" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPasswordAgain" class="col-sm-5 col-lg-3 col-form-label">確認密碼 / Confirm</label>
                            <div class="col-sm-7 col-lg-9">
                                <input type="password" class="form-control" name="inputPasswordAgain" id="inputPasswordAgain" placeholder="請再次輸入密碼" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputName" class="col-sm-5 col-lg-3 col-form-label">姓名 / Ｎame</label>
                            <div class="col-sm-7 col-lg-9">
                                <input type="text" class="form-control" name="inputName" id="inputName" placeholder="請輸入姓名" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputName" class="col-sm-5 col-lg-3 col-form-label">性別 / Ｇender</label>
                            <div class="col-sm-7 col-lg-9 d-flex">

                                <div class="form-check me-4">
                                    <input class="radio" type="radio" name="sex" value="男">
                                    <label class="form-check-label" for="flexRadioDefault1">男</label>
                                </div>
                                <div class="form-check">
                                    <input class="radio" type="radio" name="sex" value="女">
                                    <label class="form-check-label" for="flexRadioDefault2">女</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputEmail" class="col-sm-5 col-lg-3 col-form-label">電子信箱 / E-mail</label>
                            <div class="col-sm-7 col-lg-9">
                                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="請輸入電子信箱" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPhone" class="col-sm-5 col-lg-3 col-form-label">手機號碼 / Phone</label>
                            <div class="col-sm-7 col-lg-9">
                                <input type="tel" class="form-control" name="inputPhone" id="inputPhone" placeholder="請輸入手機號碼" maxlength="10" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputAddress" class="col-sm-5 col-lg-3 col-form-label">地址 / Address</label>
                            <div class="col-sm-7 col-lg-9">
                                <input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="請輸入地址" />
                            </div>
                        </div>
                        <div class="mb-4 mt-3 d-flex justify-content-center align-items-center flex-wrap">
                            <div class="form-check m-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    我已閱讀並同意<a class="link-style__1" href="javascript:;" data-bs-toggle="modal" data-bs-target="#serviceModal">服務條款</a>規章內容
                                </label>
                            </div>
                            <div class="m-3">
                                <div class="g-recaptcha" data-sitekey="your_site_key"></div>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" name="gore" class="btn-style__1" value="註冊" />
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer w3-include-html="include/_footer.php"></footer>

    <!-- Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-style__1">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="serviceModalLabel">服務條款</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <article w3-include-html="include/_service.html">
                        <!-- Loading -->
                        <div class="loader">
                            <div class="loading"></div>
                            <p>載入中...</p>
                        </div>
                    </article>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-style__2 darker" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="serviceModalToggle" aria-hidden="true" aria-labelledby="serviceModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-style__1">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="serviceModalLabel">隱私權政策</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <article w3-include-html="include/_privacy.html">
                        <!-- Loading -->
                        <div class="loader">
                            <div class="loading"></div>
                            <p>載入中...</p>
                        </div>
                    </article>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-style__2 darker" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
    <?php

    $sql = "SELECT * FROM `members` where `account`='$_POST[inputAccount]'";
    mysqli_query($db_link, 'SET CHARACTER SET UTF-8');
    $result = mysqli_query($db_link, $sql) or die("查詢失敗");
    $row = mysqli_fetch_assoc($result);
    $sqlmail = "SELECT * FROM `members` where `email`='$_POST[inputEmail]'";
    $resultmail = mysqli_query($db_link, $sqlmail) or die("查詢失敗");
    $rowmail = mysqli_fetch_assoc($resultmail);
    $idcheck = $row['account'];
    $mailcheck = $rowmail['email'];

    /*註冊按鈕*/

    if (isset($_POST["gore"])) {
        $u = $_POST['inputAccount'];
        $p = $_POST['inputPassword'];
        $e = $_POST['inputEmail'];

        if ($_POST['inputAccount'] == null || $_POST['inputPassword'] == null || $_POST['inputPasswordAgain'] == null || $_POST['inputName'] == null || $_POST['sex'] == null || $_POST['inputEmail'] == null || $_POST['inputPhone'] == null || $_POST['inputAddress'] == null) {
            echo "<script>alert('請輸入必填欄位');location.href='registered.php'</script>";
        } else if ($idcheck == $_POST['inputAccount']) {
            echo "<script>alert('帳號已被使用請重新輸入');location.href='registered.php'</script>";
        } else if ($mailcheck == $_POST['inputEmail']) {
            echo "<script>alert('email已被使用請重新輸入');location.href='registered.php'</script>";
        } else if ($_POST['inputPassword'] != $_POST['inputPasswordAgain']) {
            echo "<script>alert('確認密碼不符，請重新輸入');location.href='registered.php'</script>";
        } else {
            /*$sqlii = "INSERT INTO `members` (account,password,name,gender,email,address,telephone,authority) VALUES('$_POST[account]','$_POST[password]','$_POST[name]','$_POST[sex]','$_POST[email]','$_POST[address]','$_POST[telephone]','0')";
                  mysqli_query($db_link, $sqlii);*/

            $passowrd_hash = password_hash($p, PASSWORD_BCRYPT);

            $vkey = md5(time() . $u);
            $sql_insert = "INSERT INTO `members` (account,password,name,gender,email,address,telephone,authority,vkey) VALUES ('$_POST[inputAccount]','$passowrd_hash','$_POST[inputName]','$_POST[sex]','$_POST[inputEmail]','$_POST[inputAddress]','$_POST[inputPhone]','0','$vkey')";
            mysqli_query($db_link, $sql_insert);

            /* 寄送驗證信上線後可到忘記密碼頁面參考
                 if ($sql_insert) {

                      include('PHPMailer/PHPMailerAutoload.php');
                      $email = new PHPMailer();
                      $email->CharSet = 'UTF-8';
                      //$email->isSMTP();
                      $email->SMTPAuth = true;
                      //$email->SMTPSecure = 'ssl';
                      $email->Host = 'mail.hanhsiu.org';
                      $email->Port = '465';
                      $email->isHTML(true);
                      $email->Username = 'hanhsiu@hanhsiu.org';
                      $email->Password = 'Aqd#%&ca27';
                      $email->setFrom('hanhsiu@hanhsiu.org',"漢修學院");
                      $email->Subject = 'Email註冊驗證信通知';
                      $email->Body = "<a href='https://hanhsiu.org/hanhsiu/verify.php?vkey=$vkey'>註冊帳號</a>";
                      $email->addAddress("$e");
                      $email->SMTPDebug = 0;


                      if (!$email->Send()) {
                          echo "Error" . $email->ErrorInfo;
                      } else {

                          echo "<script>alert('感謝註冊，請到email收取驗證信！');location.href='indexs.php'</script>";
                      }

                  }*/
            echo "<script>alert('感謝註冊，請重新登入！');location.href='login.php'</script>";
        }
    }
    ?>

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