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
                                <a class="nav-link" href="origin.php">緣起</a>
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
                                <a class="nav-link active" href="contact.php">聯絡我們</a>
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
                            聯絡我們
                            <div class="tit-en">contact</div>
                        </div>
                    </div>

                    <!--蓮花剪貼畫 PNG由588ku设计 <a href="https://zh.pngtree.com"> Pngtree.com</a>-->
                    <div class="main-wrap__right bg-style__2">
                          <?php
							$sql="SELECT * FROM contact";
							$result= mysqli_query($db_link,$sql);
							 while($row=$result->fetch_assoc())
							{
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
