<?php include 'database.php'; ?>
<?php $title = '漢修學苑'; ?>
<?php include 'include/head.php'; ?>
<?php include 'include/nav-bar.php'; ?>

<body>
    <main>
        <div class="hero">
            <svg class="cloud cleft animate__animated animate__fadeInLeftBig animate__slow">
                <use xlink:href="img/cloud_left.svg#cloud-left"></use>
            </svg>
            <svg class="cloud cright animate__animated animate__fadeInRightBig animate__slow">
                <use xlink:href="img/cloud_right.svg#cloud-right"></use>
            </svg>

            <div class="hero-text">
                <div class="hero-text__wording animate__animated animate__fadeIn animate__delay-1s">
                    <span>晉宋齊梁唐代間，</span>
                    <span>高僧求法離長安，</span>
                    <span>去人成百歸無十，</span>
                    <span>後者安知前者難。</span>
                    <span>路遙碧天唯冷結，</span>
                    <span>沙河遮日力疲殫，</span>
                    <span>後賢如未諳斯旨，</span>
                    <span>往往將經容易看。</span>
                </div>
                <span class="hero-text__sign animate__animated animate__fadeIn animate__delay-2s">唐‧義淨大師</span>
            </div>

            <div class="hero-slider animate__animated animate__fadeInUp">
                <div class="hero-slider__banner pic01"></div>
                <div class="hero-slider__banner pic02"></div>
                <div class="hero-slider__banner pic03"></div>
                <div class="hero-slider__banner pic04"></div>
                <div class="hero-slider__banner pic05"></div>
                <div class="hero-slider__banner pic06"></div>
            </div>
        </div>

        <section class="my-5">
            <div class="container">
                <div class="logo-circle">
                    <img src="img/logo_circle.png" alt="漢修學苑" />
                </div>

                <p class="text-style__1 my-5">
                    漢修學苑，為依止
                    <span class="d-inline-block one-line">
                        <sup><small>上</small></sup>
                        玅
                        <sup><small>下</small></sup>
                        境長老
                    </span>
                    遺教，<br />
                    由常柏法師領導，致力於弘揚大乘佛法、唯識論典─
                    <span class="d-inline-block">《瑜伽師地論》</span>教法的僧團。
                </p>

                <div class="news-box w-1000 mx-auto">
                    <div class="news-box__tit">
                        <div class="heading-style__1">
                            最新公告
                            <div class="tit-en">news</div>
                        </div>
                    </div>
                    <ul class="news-box__list">
                        <?php
                        # 設定時區
                        date_default_timezone_set('Asia/Taipei');
                        $getDate = date("Y-m-d");
                        $sql = "SELECT * FROM posts where  save = '0' && old = '0' && keep = '0' && top = '0' || save = '0'  && keep = '0' && top = '1'  order by `top` DESC, `date` desc ";
                        $result = mysqli_query($db_link, $sql);
                        while ($row = $result->fetch_assoc()) {
                            $date1 = strtotime($getDate);
                            $date2 = strtotime($row['date']);
                            $days = (($date1 - $date2) / 86400);

                            if ($getDate >= $row['newday']) {
                                $sqlii = "update `posts` set old='1'  where `p_id`='$row[p_id]'";
                                mysqli_query($db_link, $sqlii);
                            }

                            echo "<li>";
                            if ($row['top'] == '1') {
                                echo "<p ><i class='fas fa-thumbtack'></i>&nbsp&nbsp$row[date]</p>";
                            } else {
                                echo "<p  >&emsp; $row[date]</p>";
                            }

                            echo "<p align='center' style='vertical-align:middle;'><a href = 'post.php?id=$row[p_id]'>$row[title]</a></p>";
                            echo "</li>";
                        }
                        mysqli_close($db_link);
                        ?>
                        <!--<li>
                                <p class="date">2021-10-26</p>
                                <p class="tit"><a href="post.html">對外開放 之 課程總覽</a></p>
                            </li>
                            <li>
                                <p class="date">2021-10-26</p>
                                <p class="tit"><a href="post.html">對外開放 之 課程總覽</a></p>
                            </li>
                            <li>
                                <p class="date">2021-10-26</p>
                                <p class="tit"><a href="post.html">對外開放 之 課程總覽</a></p>
                            </li>
                            <li>
                                <p class="date">2021-10-26</p>
                                <p class="tit"><a href="post.html">對外開放 之 課程總覽</a></p>
                            </li>
                            <li>
                                <p class="date">2021-10-26</p>
                                <p class="tit"><a href="post.html">對外開放 之 課程總覽</a></p>
                            </li>-->

                </div>

                <div class="text-center my-5">
                    <a class="btn-style__1" href="news.php">所有公告</a>
                </div>
            </div>
        </section>

        <div class="wave-block"></div>

        <section class="my-5">
            <div class="container">
                <div class="row w-1000 m-auto">
                    <div class="col-12 col-md-5 align-self-center text-center">
                        <div class="index-img__1 mb-4"></div>
                        <p class="text-style__sm">*日本京都 廣隆寺 「彌勒菩薩半跏思惟像」</p>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="heading-style__1 max-size my-4">
                            關於“瑜伽師地論講記”
                            <div class="tit-en">about</div>
                        </div>
                        <p class="text-style__2">《瑜伽師地論》為彌勒菩薩所說，原為梵文，後由唐朝玄奘法師譯為漢文。玄奘大師當時至印度取經，主要就是為學習《瑜伽師地論》。</p>
                        <p class="text-style__2">《瑜伽師地論》共一百卷，內容由淺而深、有略有廣，它不是佛法概論，而是全面而詳細的、深刻而有次第的完備介紹全體佛法。</p>
                        <p class="text-style__2">
                            論中闡明一切凡聖的因果－－生死緣起及涅槃緣起；對於聖道次第、禪法等的開示全面而深入，將由凡轉聖的過程、條件及方法做了完整詳細的說明，既能符合佛的法印又能契合眾生根機，如同一張道次第的地圖，若能循此路徑，則可避免歧途，安全地到達究竟解脫的目的地。
                        </p>
                        <p class="text-style__2">是故，本論為有心於聖道者之所必學！</p>

                        <div class="text-center my-5">
                            <a class="btn-style__1" href="articletype.html">閱讀講記</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-style__1 py-5 contact-wrap">
            <svg class="cloud cleft">
                <use xlink:href="img/cloud_left.svg#cloud-left"></use>
            </svg>
            <svg class="cloud cright">
                <use xlink:href="img/cloud_right.svg#cloud-right"></use>
            </svg>
            <div class="container">
                <div class="row w-1000 m-auto">
                    <div class="col-12 col-md-4">
                        <div class="heading-style__1 m-auto mt-5">
                            聯絡我們
                            <div class="tit-en">contact</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <form action="#">
                            <div class="mb-3 row">
                                <label class="col-12 col-md-4 col-xl-3 col-form-label">名字 / Ｎame</label>
                                <div class="col-12 col-md-8 col-xl-9">
                                    <input type="text" class="form-control" placeholder="請輸入您的名字" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-12 col-md-4 col-xl-3 col-form-label">電子信箱 / E-mail</label>
                                <div class="col-12 col-md-8 col-xl-9">
                                    <input type="email" class="form-control" placeholder="請輸入您的電子信箱" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-12 col-md-4 col-xl-3 col-form-label">標題 / Subject</label>
                                <div class="col-12 col-md-8 col-xl-9">
                                    <input type="text" class="form-control" placeholder="請輸入郵件標題" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-12 col-md-4 col-xl-3 col-form-label">內容 / Message</label>
                                <div class="col-12 col-md-8 col-xl-9">
                                    <textarea class="form-control" rows="8" placeholder="請輸入郵件內容"></textarea>
                                </div>
                            </div>

                            <div class="text-center mt-5 mb-5 mb-md-0">
                                <input type="submit" class="btn-style__1" value="送出" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="wave-block"></div>
        </section>
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