<?php
include(“PHPMailerAutoload.php”);
// 產生 Mailer 實體
$mail = new PHPMailer();

// 設定為 SMTP 方式寄信
$mail->IsSMTP();

// SMTP 伺服器的設定，以及驗證資訊
$mail->SMTPAuth = true;
$mail->Host = “hanhsiu.org“; //設定有任何指向主機空間的網址名稱
$mail->Port = 25; //主機空間的郵件伺服器port為 25（SSL連線與上面的HOST是有關，在不熟悉時建議使用非SSL的方式測試）
$mail->SMTPAuth = false;
$mail->SMTPSecure = false;

// 信件內容的編碼方式
$mail->CharSet = 'utf-8';

// 信件處理的編碼方式
$mail->Encoding = “base64”;

// SMTP 驗證的使用者資訊
$mail->Username = 'hanhsiu@hanhsiu.org'; //在cPanel新增mail的帳號（需要完整的mail帳號，含@後都要填寫）
$mail->Password = “p2VSJg7VVEycBJY“; //在cpanel新增mail帳號時設定的密碼，請小心是否有空格，空格也算一碼。

// 信件內容設定
$mail->From = 'hanhsiu@hanhsiu.org'; //需要與上述的使用者資訊相同mail
$mail->FromName = “漢修學苑“; //此顯示寄件者名稱
$mail->Subject = “漢修學苑｜重設您的會員密碼“; //信件主旨
$mail->Body = “測試信喔“; //信件內容
$mail->IsHTML(true);

// 收件人
$mail->AddAddress("2365275a@gmail.com", “XXX系統通知信“); //此為收件者的電子信箱及顯示名稱

// 顯示訊息
if(!$mail->Send()) {
echo "Mail error: " . $mail->ErrorInfo;
}else {
echo "Mail sent";
}
?>