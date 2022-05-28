<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="logo outside" href="index.php"><img src="img/logo.png" alt="漢修學苑" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger" id="hamburger-1">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-lg-0 w-100 justify-content-lg-between">
                    <li class="nav-item order-1 inside">
                        <a class="nav-link logo" id="logo" href="index.php"><img src="img/logo.png" alt="漢修學苑" /></a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" id="origin" onclick="changeActive('origin')" href="javascript:void(0)">緣起</a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" id="articletype" onclick="changeActive('articletype')" href="javascript:void(0)">瑜論講記</a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" id="kepan" onclick="changeActive('kepan')" href="javascript:void(0)">科判</a>
                    </li>
                    <li class="nav-item order-0">
                        <a class="nav-link" id="supplementtype" onclick="changeActive('supplementtype')" href="javascript:void(0)">補充資料</a>
                    </li>
                    <li class="nav-item order-2">
                        <a class="nav-link" id="videotypes" onclick="changeActive('videotypes')" href="javascript:void(0)">法音流佈</a>
                    </li>
                    <li class="nav-item order-2">
                        <a class="nav-link" id="news" onclick="changeActive('news')" href="javascript:void(0)">公告訊息</a>
                    </li>
                    <li class="nav-item order-2">
                        <a class="nav-link" id="contact" onclick="changeActive('contact')" href="javascript:void(0)">聯絡我們</a>
                    </li>
                    <!--帳號判斷-->
                    <?php
                    $sql_search_acc = "SELECT * FROM `members` WHERE `account` = '$_SESSION[acc]'";
                    $resultsrchacc = mysqli_query($db_link, $sql_search_acc);
                    $rows = mysqli_fetch_assoc($resultsrchacc);
                    $acc = $rows["account"];
                    $pwd = $rows["password"];
                    $name = $rows["name"];
                    $authority = $rows["authority"];
                    if ($_SESSION["acc"] == null || $_SESSION["pwd"] == null) {
                        echo "<li class='nav-item order-2'>";
                        echo "<a class=nav-link id='login' onclick=changeActive('login') href=login.php>註冊/登入</a>";
                        echo "</li>";
                    } else if ($_SESSION["acc"] != $acc  || $_SESSION["pwd"] != $pwd) {
                        echo "<li class=nav-item order-2>";
                        echo "<a class=nav-link id='login' onclick=changeActive('login') href=login.php>註冊/登入</a>";
                        echo "</li>";
                    } else if ($authority == '1' || $authority == '2') {
                        echo "<li class='nav-item order-2'>";
                        echo "<div class='dropdown'>";
                        echo "<a class='nav-link d-flex align-items-center dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
                        echo "<span class=account_text>";
                        echo "$name";
                        echo "，您好";
                        echo "</span>";
                        echo "</a>";
                        echo "<ul class='dropdown-menu dropdown-menu-end text-center' aria-labelledby='dropdownMenuLink'>";
                        echo "<li><a class='dropdown-item' href='member.html'>會員中心</a></li>";
                        echo "<li><a class='dropdown-item' href='#'>回後台</a></li>";
                        echo "<li><a class='dropdown-item' href='logout.php'>登出</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "</li>";
                    } else {
                        echo "<li class='nav-item order-2'>";
                        echo "<div class='dropdown'>";
                        echo "<a class='nav-link d-flex align-items-center dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>";
                        echo "<span class=account_text>";
                        echo "$name";
                        echo "，您好";
                        echo "</span>";
                        echo "</a>";
                        echo "<ul class='dropdown-menu dropdown-menu-end text-center' aria-labelledby='dropdownMenuLink'>";
                        echo "<li><a class='dropdown-item' href='member.html'>會員中心</a></li>";
                        echo "<li><a class='dropdown-item'href='logout.php'>登出</a></li>";
                        echo "</ul>";
                        echo "</div>";
                        echo "</li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
</header>

<script type="text/javascript">
    //載入後執行帶入tid撈出第二層下拉
    window.onload = function() {
        var navnum = document.getElementsByClassName('nav-link').length;
        var nav_checkedid = localStorage.getItem('nav-checked');

        for (var i = 1; i < navnum; i++) {
            if (document.getElementsByClassName('nav-link')[i].id == nav_checkedid) {
                document.getElementsByClassName('nav-link')[i].setAttribute('class', 'nav-link active')
            }
        }
    }

    function changeActive(navId) {
        localStorage.setItem('nav-checked', navId);
        var navnum = document.getElementsByClassName('nav-link').length;

        for (var i = 0; i < navnum; i++) {
            document.getElementsByClassName('nav-link')[i].setAttribute('class', 'nav-link');
        }
        location.href = navId + '.php';
    }
</script>