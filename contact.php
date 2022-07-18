<?php include 'database.php'; ?>
<?php $title = '聯絡我們'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>

<body>
    <main>
        <div class="hero stop-banner">
            <svg class="cloud cleft">
                <use xlink:href="img/cloud_left.svg#cloud-left"></use>
            </svg>
            <svg class="cloud cright">
                <use xlink:href="img/cloud_right.svg#cloud-right"></use>
            </svg>
        </div>

        <section>
            <div class="container main-wrap">
                <div class="main-wrap__left">
                    <div data-boxname="head" class="heading-style__1 mx-auto">
                        聯絡我們
                        <div class="tit-en">contact</div>
                    </div>
                </div>

                <!--蓮花剪貼畫 PNG由588ku设计 <a href="https://zh.pngtree.com"> Pngtree.com</a>-->
                <div class="main-wrap__right bg-style__2">
                    <?php
                    $sql = "SELECT * FROM contact";
                    $result = mysqli_query($db_link, $sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td >$row[content]</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    mysqli_close($db_link);
                    ?>

                    <!--<div class="mb-4">
                            <h4 class="heading-style__2">感荷僧俗檀越善心擁護!!</h4>
                        </div>

                        <p class="mb-4"><strong>漢修學苑所有活動並無委託任何道場、居士團體或個人進行募化</strong><br />若欲發心護持供養常住，請直接匯款如下：</p>

                        <h6><strong>1.郵局</strong></h6>
                        <p>
                            郵局代號：700<br />
                            帳號：0021-242-0409-641<br />
                            戶名：臺中市漢修學苑佛學會 胡淑雲
                        </p>

                        <hr class="line-style__1 w-25" />

                        <h6><strong>2.台灣銀行太平分行 </strong></h6>
                        <p class="mb-4">
                            銀行代號：004-1702<br />
                            帳號：170-001-01483-9<br />
                            戶名：臺中市漢修學苑佛學會
                        </p>

                        <p>由於常住款與供僧款須各別專款專用，若欲作供僧款用途，請來信或來電詢問，<br />不情之請，實感德便!</p>
                        <p>若有匯款，煩請來電或來信告知地址與電話，將以掛號寄送收據；<br />收據開立皆以帳簿內匯款人姓名為主。</p>

                        <p class="mb-4">感恩您的護持!!</p>

                        <p>
                            臺中市漢修學苑佛學會敬啟<br />
                            <a class="link-style__1" href="mailto:hanhsiuschool@gmail.com">hanhsiuschool@gmail.com</a><br />
                            <a class="link-style__1" href="tel:04-2213-2881">04-2213-2881</a>
                        </p>-->
                </div>
            </div>
        </section>

        <div class="wave-block in-buttom"></div>
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