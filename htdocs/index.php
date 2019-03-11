<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>한빛출판네트워크</title>
        <link rel="stylesheet" href="/css/common.css" />
        <link href="/css/hover.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="/css/layout-hanbit.css" />
        <link rel="stylesheet" href="/css/layout-member.css" />
        <link rel="stylesheet" href="/css/layout-network.css" />
        <link rel="stylesheet" href="/css/layout-store.css" />
        <link rel="stylesheet" href="/css/layout-myhanbit.css" />
        <link rel="stylesheet" href="/css/layout-event.css" />
        <link rel="stylesheet" href="./css/main.css" />
    </head>
    <body>
        <header>
            <nav>
                <div id="wrap_nav">
                    <ul class="top_brand">
                        <li><a href="/index.php" name="hanbit_network"><span>HOME</span></a></li>
                        <li><p style="font-size:15px; color:#fff;"><?php if(isset($_SESSION['ses_id'])) {print $_SESSION['ses_name']."님 환영합니다.";}?></p></li>
                    </ul>
                    
                    <ul class="top_menu">
                        <?php
                        if(!isset($_SESSION['ses_id'])) {
                        ?>
                        <li><a href="/member/manager_login.php" class="login"><img src="/img/top_icon_login.png">매니저 로그인</a></li>
                        <li><a href="/member/login.php" class="login"><img src="/img/top_icon_login.png">로그인</a></li>
                        <li><a href="/member/member_agree.php" class="join"><img src="/img/top_icon_join.png">회원가입</a></li>
                        <?php
                        }
                        else {
                        ?>
                        <li><a href="/logout.php" class="logout"><img src="/img/top_icon_logout.png">로그아웃</a></li>
                        <li><a href="/myhanbit/myhanbit.php" class="myhanbit"><img src="/img/top_icon_my.png">마이한빛</a></li>
                        <?php
                        }
                        ?>
                        <li><a href="/store/store_submain.php" class="cart"><img src="/img/top_icon_cart.png">STORE</a></li>
                    </ul>
                </div>
            </nav>      
        </header>

        <br>
        <br>
        <br>
        <br>
        <br>
        <!-- logo -->
        <h1><a href="./index.php"><img src="/img/logo_hanbit.png"></a></h1>
        <!-- //logo -->
        <br>
        <br>
        <form method="post" action="./search/search_sublist.php">
            <fieldset class="foot_srch">
                <legend>하단 검색영역</legend>
                <input title="검색어" class="foot_srch_keyword" name="bookname" type="text" value=""  id="foot_keyword_str" style="font-size:16px;">
                <input type="image" alt="" class="foot_srch_btn" style="cursor: pointer;" >
            </fieldset>
        </form>

    </body>
</html>