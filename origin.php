<!DOCTYPE html>
<html lang="en">
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
		<?php include 'database.php'; ?>
		<?php $title = '漢修學苑'; ?>
		<?php include 'include/head.php'; ?>
		<?php include 'include/nav-bar.php'; ?>
        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="logo outside" href="index.php"><img src="img/logo.png" alt="漢修學苑" /></a>
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
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav me-auto mb-lg-0 w-100 justify-content-lg-between">
                            <li class="nav-item order-1 inside">
                                <a class="nav-link logo" href="index.php"><img src="img/logo.png" alt="漢修學苑" /></a>
                            </li>
                            <li class="nav-item order-0">
                                <a class="nav-link active" href="origin.php">緣起</a>
                            </li>
                            <li class="nav-item order-0">
                                <a class="nav-link" href="articletype.php">瑜論講記</a>
                            </li>
                            <li class="nav-item order-0">
                                <a class="nav-link" href="kepan.php">科判</a>
                            </li>
                            <li class="nav-item order-0">
                                <a class="nav-link" href="supplementtype.php">補充資料</a>
                            </li>
                            <li class="nav-item order-2">
                                <a class="nav-link" href="videotypes.php">法音流佈</a>
                            </li>
                            <li class="nav-item order-2">
                                <a class="nav-link" href="news.php">公告訊息</a>
                            </li>
                            <li class="nav-item order-2">
                                <a class="nav-link" href="contact.php">聯絡我們</a>
                            </li>
                            <li class="nav-item order-2">
                                <a class="nav-link" href="login.php">註冊/登入</a>
                            </li>
                            <li class="nav-item order-2 d-none">
                                <div class="dropdown">
                                    <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                                        ><span class="account_text">Your Account</span></a
                                    >

                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                                        <li>
                                            <a class="dropdown-item" href="member.php">會員中心</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">回後台</a></li>
                                        <li><a class="dropdown-item" href="login.php">登出</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

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
                            緣起
                            <div class="tit-en">origin</div>
                        </div>
                    </div>
                    <div class="main-wrap__right">
                        <div class="mb-4">
                            <h4 class="heading-style__2">《瑜伽師地論講記》電子筆錄網頁 緣起</h4>
                        </div>
						 <?php
							$sql="SELECT * FROM origin";
							$result= mysqli_query($db_link,$sql);
							while($row=$result->fetch_assoc())
							{
								/*echo "<tr>"*/                
								echo "<td >$row[content]</td>";
								/*echo "</tr>";*/
							}
								/*echo "</table>"; */          
								mysqli_close($db_link);
						?>
                        <!--p>漢修學苑佛學會，成立於2017年，首任理事長為常柏法師。</p>

                        <p>
                            常柏法師，1989年於 聖印長老座下出家，並於1996年至2001年赴美國法雲佛學院，追隨 玅境長老學習《瑜伽師地論》。因
                            玅境長老乃近代漢傳佛教不可多得的大善知識，除了生前宣講經論無數，於大乘止觀更是當代之首，故其指導不僅以建立正見、修習止觀、調伏煩惱為宗旨，更提倡依大乘法教修習止觀以趣求聖道。而常柏法師於此時入法雲寺佛學院、於長老座下學習《瑜伽師地論》等聖教，有幸親蒙長老的甘露法語，隨側請益，斷疑除惑，因此能於聖教及止觀有所認識及進趣修習，即便日後回台，也能依此繼續深入。
                        </p>

                        <p>
                            2003年3月 玅境長老亦返台，於4月12日至三德寺接見常柏法師與慧南法師，親囑要他們弘揚《瑜伽師地論》，五日後
                            玅境長老圓寂，常柏法師與慧南法師等佛學院同學，趕往苗栗法雲寺拜別長老，雖遽失大善知識，悲痛不已，但同時也於長老靈前發願：完成《瑜伽師地論》一百卷的試講學習。
                        </p>

                        <p>
                            在慧南法師及諸多同行善知識等支持、鼓勵下，常柏法師於2003年9月在高雄天明寺開始學講〈攝決擇分〉卷51，並於次年六月開辦天明寺佛學院，不僅學講卷1至卷50，同時還與卷51至卷100的學講雙軌進行，歷時7年3個月後，終於在2010年12月完成100卷的課程。
                        </p>

                        <p>
                            在此過程中，對眾多法義的詮釋，盡量以經論為依據，輔以學習融會後的心得，雖多數只能消文解義，但仍希望與同行善友們一起切磋。講述所依課本，沿用
                            玅境長老曾選用的新文豐出版社之《瑜伽師地論科句披尋記》四大冊為主，然而由於新文豐版的錯字較多，故電子筆錄改採慈照寺彌勒講堂校訂版的論文作為藍本。
                        </p>

                        <p>
                            本論講述費時7年有餘，其中難免存在一些口誤，常柏法師為避免誤導，故不流通語音檔。惟為因應眾多在家、出家佛弟子們的需求，順應見海法師建議，將所講述之100卷語音檔，由發心的法師、居士們逐字敲打成電子筆錄，自2007年底開始，再經5年，才全部輸入電腦。但由於口語講述與適合閱讀的文字編排差距甚多，又缺乏此類校對勘誤工作經驗，在人力限制下，勉力於2012年10月先行推出10卷的電子版筆錄，直至2021年底方完成100卷筆錄。
                        </p>

                        <p>
                            此外，100卷電子筆錄能夠完成，還要特別感恩在舊金山南灣的尹明潭居士大力協助，及華台申居士的努力推進。當然，也萬分感謝所有發心參與的法師、居士們能大力支持，使此有意義的傳續聖教工作，得以堅實的向前推動。
                        </p>

                        <p>
                            由於論文內容巨大，法義甚深，筆錄發佈後，總會發現不足及疏漏之處，為使其正確度提高，於2021年由勤益科大陳宏昌教授發心，協助帶領吳禹儒、胡東霖、許家詮、周秉佑等四位學員製作此漢修網頁版，以期持續進行修正。
                        </p>

                        <p>本電子筆錄與其補充資料尚未完善校訂，讀者大德若發現任何錯誤，請不吝發心指正。又版權所有，請勿重製、翻印、改作、及有任何作價或銷售行為。</p>

                        <p class="text-end mt-5">漢修學苑電子筆錄校對編輯小組　敬書</p>-->
                    </div>
                </div>
            </section>

            <div class="wave-block in-buttom"></div>
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
