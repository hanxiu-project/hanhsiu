<!DOCTYPE html>
<html lang="en">
<?php include 'database.php'; ?>
<?php $title = '忘記密碼'; ?>
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
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="logo outside" href="index.html"><img src="img/logo.png" alt="漢修學苑" /></a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <div class="hamburger" id="hamburger-1">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </button>
        </div>
    </nav>
</header>

<main>
    <section class="bg-style__1">
        <div class="container bg-style__4 wrap-minheight p-4">
            <div class="w-1000 mx-auto">
                <h4 class="heading-style__2 mt-4">忘記密碼</h4>

                <p>輸入您註冊的電子郵件，並至信箱收取確認信：</p>

                <form class="mt-4" name="forgetpwd" method="post" action="" >
                    <div class="mb-5 row">
                        <label for="inputEmail" class="col-sm-4 col-lg-3 col-xl-2 col-form-label">電子信箱 / E-mail</label>
                        <div class="col-sm-8 col-lg-9 col-xl-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="請輸入電子信箱" name="checkemail" />
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn-style__1" value="送出" name="go" />
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php


$sql_login = "SELECT * FROM `members` WHERE `email` = '$_POST[checkemail]'";
$result = mysqli_query($db_link, $sql_login);
$row = mysqli_fetch_assoc($result);                        //查詢資料庫
$email = $_POST['checkemail'];                                        //查詢到email
$u = $row["name"];

$_SESSION["verified"] = $row["verified"];

if (isset($_POST["go"])) {
    if ($email != $row['email']) {
        echo "<script>alert('e-mail與會員e-mail不符');location.href='forgetpwd.php'</script>";
    } else {
        $fgpwd = md5(time() . $u);
        $sql_login = "SELECT * FROM `members` WHERE `email` = '$_POST[checkemail]'";
        mysqli_query($db_link, $sql_login);
        if ($sql_login) {

            include('PHPMailer/PHPMailerAutoload.php');

            $mail = new PHPMailer();

            // 設定為 SMTP 方式寄信
            $mail->IsSMTP();

            // SMTP 伺服器的設定，以及驗證資訊
            $mail->SMTPAuth = true;
            $mail->Host = 'mail.hanhsiu.org'; //設定有任何指向主機空間的網址名稱
            $mail->Port = 25; //主機空間的郵件伺服器port為 25（SSL連線與上面的HOST是有關，在不熟悉時建議使用非SSL的方式測試）
            $mail->SMTPAuth = false;
            $mail->SMTPSecure = false;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            // 信件內容的編碼方式
            $mail->CharSet = 'utf-8';

            // 信件處理的編碼方式
            $mail->Encoding = "base64";

            // SMTP 驗證的使用者資訊
            $mail->Username = 'hanhsiu@hanhsiu.org'; //在cPanel新增mail的帳號（需要完整的mail帳號，含@後都要填寫）
            $mail->Password = "p2VSJg7VVEycBJY"; //在cpanel新增mail帳號時設定的密碼，請小心是否有空格，空格也算一碼。

            // 信件內容設定
            $mail->From = 'hanhsiu@hanhsiu.org'; //需要與上述的使用者資訊相同mail
            $mail->FromName = "漢修學苑"; //此顯示寄件者名稱
            $mail->Subject = "漢修學苑｜重設您的會員密碼"; //信件主旨
            $mail->Body = "<a href=' https://hanhsiu.org/hanhsiu/resetpwd.php?fgpwd=$fgpwd'>重設密碼</a>"; //信件內容
            $mail->IsHTML(true);

            // 收件人
            $mail->AddAddress("$email"); //此為收件者的電子信箱及顯示名稱
            //$mail->SMTPDebug = 3;
            // 顯示訊息
            if(!$mail->Send()) {
                echo "Mail error: " . $mail->ErrorInfo;
            }else {
                echo "<script>location.href='mail.php'</script>";
            }

            /* $mail = new PHPMailer();
             $mail->CharSet = 'UTF-8';
             $mail->isSMTP();
             $mail->SMTPAuth = true;
             $mail->SMTPSecure = 'ssl';
             $mail->Host = 'smtp.gmail.com';
             $mail->Port = '465';
             $mail->isHTML();
             $mail->Username = 'xuj8906@gmail.com';
             $mail->Password = '3acc732087p';
             $mail->setFrom('crazy32968@gmail.com');
             $mail->Subject = '漢修學院｜重設您的會員密碼';
             $mail->Body = "<a href='http://localhost/漢修專題/resetpwd.php?fgpwd=$fgpwd'>重設密碼</a>";
             $mail->addAddress("$email");
             $mail->SMTPDebug = 3;

             if (!$mail->Send()) {
                 echo "Error" . $mail->ErrorInfo;
             } else {

                 echo "<script>alert('已寄出重設密碼郵件，請到email收取信件！');location.href='indexs.php'</script>";
             }*/

        }
    }


}

mysqli_close($db_link);
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
