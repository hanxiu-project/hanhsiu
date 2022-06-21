<?php include 'database.php'; ?>
<?php $title = '會員中心'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>

<body>
    <?php
    
    session_start();
    
    //$sqlold = "SELECT * FROM posts where old = '1' order by date DESC";
    //$resultold= mysqli_query($db_link,$sqlold);
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $getDate = date("Y-m-d");
    $sql_search_acc = "SELECT * FROM `members` WHERE `account` = '$_SESSION[acc]'";
    $resultsrchacc = mysqli_query($db_link, $sql_search_acc);
    $rows = mysqli_fetch_assoc($resultsrchacc);
    $acc = $rows["account"];
    $pwd = $rows["password"];
    $name = $rows["name"];
    $gender = $rows["gender"];
    $email = $rows["email"];
    $address = $rows["address"];
    $telephone = $rows["telephone"];
    $authority = $rows["authority"];
    $m_id = $rows["m_id"];
    ?>
       
      <main>
            <section class="bg-style__1">
                <div class="container bg-style__4 wrap-minheight p-4">
                    <div class="w-1000 mx-auto">
                        <div class="my-4 d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                            <h4 class="heading-style__2 mb-2 mb-md-0">會員中心</h4>
                            <span class="color01"><?php echo "$name"; ?>，您好！</span>
                        </div>

                        <div class="row">
                            <label class="col-12 col-md-3 col-lg-2 col-form-label order-2">帳號 / Account</label>
                            <span class="col-12 col-md-9 col-lg-4 form-text-style__1 order-2"><?php echo "$acc"; ?></span>

                            <div class="col-12 col-lg-6 order-1 order-lg-3 mb-3 mb-lg-0">
                                <div class="d-flex align-content-center">
                                    <a href="member-reset.php" class="btn-style__1 smallest mx-2">修改密碼</a>
                                    <a href="member-edit.php" class="btn-style__1 smallest mx-2">修改會員資料</a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 row">
                            <label class="col-12 col-sm-3 col-lg-2 col-form-label">姓名 / Ｎame</label>
                            <span class="col-12 col-sm-9 col-lg-4 form-text-style__1"><?php echo "$name"; ?></span>
                            <label class="col-12 col-sm-3 col-lg-2 col-form-label">性別 / Ｇender</label>
                            <span class="col-12 col-sm-9 col-lg-4 form-text-style__1"><?php echo "$gender"; ?></span>
                            <label class="col-12 col-sm-3 col-lg-2 col-form-label">電子信箱 / E-mail</label>
                            <span class="col-12 col-sm-9 col-lg-4 form-text-style__1"><?php echo "$email"; ?></span>
                            <label class="col-12 col-sm-3 col-lg-2 col-form-label">手機號碼 / Phone</label>
                            <span class="col-12 col-sm-9 col-lg-4 form-text-style__1"><?php echo "$telephone"; ?></span>
                            <label class="col-12 col-sm-3 col-lg-2 col-form-label">地址 / Address</label>
                            <span class="col-12 col-sm-9 col-lg-4 form-text-style__1"><?php echo "$address"; ?></span>
                        </div>

                        <div class="d-flex justify-content-strat align-items-end">
                            <h4 class="heading-style__2 darker mb-0">留言板</h4>
                            <span class="text-style__3 text-style__sm color03 mx-2"><strong>僅限</strong>經文內容錯誤為主</span>
                        </div>

                        <hr class="line-style__2" />

                        <form action="" method="post">
                            <div class="mb-3">
                                <textarea class="form-control" rows="5" name="message" placeholder="請輸入留言內容"></textarea>
                            </div>

                            <div class="text-center mt-4 mb-md-0">
                                <input type="submit" name="send" class="btn-style__1" value="送出" />
                            </div>
                            <?php
                           
                            if(isset($_POST["send"]))
                            {
                                $nowdate=date("Y-m-d H:i:s" , mktime(date('H'),date('i'),date('s'), date('m'), date('d'), date('Y')));
                                if(strlen($_POST[message])<=0)
                                {
                                    echo "<script>alert('請輸入留言內容！');location.href='member.php'</script>";
                                }
                                else
                                {
                                    $sql_msg="INSERT INTO `comments`(`m_id`,`message`,`msg_datetime`) VALUES ('$m_id','$_POST[message]','$nowdate')";
                                    mysqli_query($db_link, $sql_msg);
                                    echo "<script>alert('留言成功！');location.href='member.php'</script>";
                                }
                            }
                            ?>
                        </form>
                            <?php
                             $sql_allmsg="SELECT * FROM `comments` where `comments`.`m_id` = '$m_id' order by `msg_datetime` DESC";
                             $result_allmsg=mysqli_query($db_link,$sql_allmsg);
                             $result_allmsg1=mysqli_query($db_link,$sql_allmsg);
                            ?>
                            
                        <div class="mt-5">
                            <h4 class="heading-style__2 darker">歷史留言</h4>
                        </div>

                        <hr class="line-style__2" />

                        <div class="msg-list">
                            <?
                        while($allmsg=mysqli_fetch_assoc($result_allmsg))
                            {
                                $c_id=$allmsg['c_id'];
                                $m_id2=$allmsg['m_id'];
                                $msg=$allmsg['message'];
                                $time=$allmsg['msg_datetime'];
                                $status=$allmsg['status'];
                                $reply=$allmsg['reply'];
                                ?>

                                <div class="msg-wrap">
                                <div class="text-end">
                                    <button type="button" class="msg-wrap__btn" data-bs-toggle="modal" data-bs-target="#confirmModal"></button>
                                </div>
                                <a class="msg-wrap__link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#msgModal">
                                    <div class="msg-wrap__msg">
                                        <div class="truncate" data-bs-msgtime=" <?php echo $time; ?>">
                                            <p>
                                            <?php echo $msg; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                    if($status=='1')
                                    {
                                        ?>
                                        <div class="msg-wrap__reply">
                                        <div class="truncate" data-bs-msgtime="<?php echo $time; ?>">
                                            <p class="text-center"><?php echo $reply; ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }else
                                    {
                                        ?>
                                        <div class="msg-wrap__reply">
                                        <div class="truncate" data-bs-msgtime="<?php echo $time; ?>">
                                            <p class="text-center">尚無回覆內容</p>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                     ?>
                                  
                                    <p class="msg-wrap__time text-end p-2"><?php echo $time; ?></p>
                                </a>
                            </div>

                                <?php
                            }
                            ?>
                           
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Modal -->
        <div class="modal fade" id="msgModal" tabindex="-1" aria-labelledby="msgModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-style__1">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="jsMsgModalWrap"></div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn-style__2 darker mx-2" data-bs-dismiss="modal" aria-label="Close">關閉</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered modal-style__1">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <p class="text-center">確定要刪除此留言嗎？</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn-style__2 darker mx-2" data-bs-dismiss="modal" aria-label="Close">取消</button>
                        <button type="submit" name="del" class="btn-style__2 mx-2" data-bs-dismiss="modal" aria-label="Close">確定</button>
                     
                    </div>
                </div>
            </div>
        </div>

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