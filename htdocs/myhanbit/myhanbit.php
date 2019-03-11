<?php
    session_start();
    if(!isset($_SESSION['ses_id'])) {
?>
<script>
    alert('로그인을 해주세요.');
    history.back();
</script>
<?php
    }
    else {
        $id = $_SESSION['ses_id'];
        $pw = $_SESSION['ses_pw'];
        $name = $_SESSION['ses_name'];
    }

    $db_user="root";
    $db_pass="1234";
    $db_type="mysql";
    $db_host="localhost";
    $db_name="project";
    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";
    $tb_name="customer";

    try{
        $pdo=new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from $tb_name where cid = :id and password = :pw";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':id', $id, PDO::PARAM_STR);
        $stmh->bindValue(':pw', $pw, PDO::PARAM_STR);
        $stmh->execute();
        //$pdo->commit();
        
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
        $sex = $row['sex'];
        $birth = $row['birth'];
        $phone = $row['phone'];
        $email = $row['email'];
        $job = $row['job'];
        $mileage = $row['mileage'];
    } catch (PDOException $Exception) {
        //$pdo->rollBack();
        die('Error: '.$Exception->getMessage());
    }

?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8"/>
        <title>한빛출판네트워크</title>
        <link rel="stylesheet" href="/css/common.css" />
        
        <link rel="stylesheet" href="/css/layout-hanbit.css" />
        <link rel="stylesheet" href="/css/layout-member.css" />
        
        <link rel="stylesheet" href="/css/layout-store.css" />
        <link rel="stylesheet" href="/css/layout-myhanbit.css" />
        
        <link rel="stylesheet" href="./css/main.css" />
    </head>

<body>
    <header>
  	<nav>
            <div id="wrap_nav">
                <ul class="top_brand">
                    <li><a href="../index.php" name="hanbit_network"><span>HOME</span></a></li>
                    <li class="welcome"><p style="font-size:15px; color:#fff;"><?=htmlspecialchars($name)?>님, 환영합니다.</p></li>

                </ul>

                <ul class="top_menu">
                <?php
                if(!isset($_SESSION['ses_id'])) {
                ?>
                <li><a href="/member/login.php" class="login"><img src="/img/top_icon_login.png">로그인</a></li>
                <li><a href="/member/member_agree.php" class="join"><img src="/img/top_icon_join.png">회원가입</a></li>
                <?php
                }
                else {
                ?>
                <li><a href="../logout.php" class="logout"><img src="/img/top_icon_logout.png">로그아웃</a></li>
                <?php
                }
                ?>
                <li><a href="/myhanbit/myhanbit.php" class="myhanbit"><img src="/img/top_icon_my.png">마이한빛</a></li>
                <li><a href="/store/store_submain.php" class="cart"><img src="/img/top_icon_cart.png">STORE</a></li>
                </ul>
            </div>
	</nav>
    </header>

    <div id="container">
            <div class="myhanbit_wrap">
                    <div class="sm_myinfo">
                            <div class="my_rating">
                                    <div class="icon">
                                        <img src="../img/rating_icon1.png" alt="" />
                                    </div>
                                    <p>한빛출판네트워크의 가족이신</p>
                                    <p><?=htmlspecialchars($name)?>님, 환영합니다.</p>				
                            </div>
                    </div>
                    <!-- //회원등급 -->

                    <!-- 마일리지 -->
                    <div class="sm_mymileage">
                            <dl class="mileage_section1">
                                    <dt>마일리지</dt>
                                    <dd><span><?=htmlspecialchars($mileage)?></span> 점</dd>
                            </dl>
                            <dl class="mileage_section2">
                                    <dt>마일리지 충전</dt>
                                    <br>
                                    <form name="recharge" id="recharge" method="post" action="./recharge.php">
                                        <div style="display:inline;">
                                            <span><input name="recharge" id="recharge" type="text" value="" style="width: 82px; height: 30px;"></span> 원 
                                            <input type="submit" value="충전" style=" background: #5e7e9b; width: 52px; height: 30px; margin:0; border: 0; padding:0; border-radius: .3em; color: #FFF;">
                                        </div>
                                    </form>
                            </dl>
                    </div>
                    <!-- //마일리지 -->

                    <!-- 최근 구매이력 -->
                    <div class="sm_myorder">
                            <p class="tit">내 정보</p>
                            <p><span>아이디 : </span><?=htmlspecialchars($id)?></p>
                            <p><span>이  름 : </span><?=htmlspecialchars($name)?></p>
                            <p><span>성  별 : </span><?php if($sex==0) {print "남성";} else {print "여성";}?></p>
                            <p><span>생년월일 : </span><?=htmlspecialchars($birth)?></p>
                            <p><span>전화번호 : </span><?=htmlspecialchars($phone)?></p>
                            <p><span>e-메일 : </span><?=htmlspecialchars($email)?></p>
                            <p><span>직  업 : </span><?php
                                                        switch( (int) $job ) {
                                                            case 2 :
                                                                print "중학생";
                                                                break;
                                                            case 3 :
                                                                print "고등학생";
                                                                break;
                                                            case 4 :
                                                                print "대학(원)생";
                                                                break;
                                                            case 5 :
                                                                print "S/W관련직";
                                                                break;
                                                            case 6 :
                                                                print "H/W관련직";
                                                                break;
                                                            case 7 :
                                                                print "인터넷관련직";
                                                                break;
                                                            case 8 :
                                                                print "사무관리직";
                                                                break;
                                                            case 9 :
                                                                print "일반영업직";
                                                                break;
                                                            case 10 :
                                                                print "제조/생산직";
                                                                break;
                                                            case 11 :
                                                                print "언론/출판/방송/연예";
                                                                break;
                                                            case 12 :
                                                                print "공무원";
                                                                break;
                                                            case 13 :
                                                                print "교원/강사직";
                                                                break;
                                                            case 14 :
                                                                print "건강/의료직";
                                                                break;
                                                            case 15 :
                                                                print "법조/전문직";
                                                                break;
                                                            case 16 :
                                                                print "프리랜서";
                                                                break;
                                                            case 17 :
                                                                print "주부";
                                                                break;
                                                            case 18 :
                                                                print "자영업";
                                                                break;
                                                            case 19 :
                                                                print "기타";
                                                                break;
                                                            default :
                                                                print "No";
                                                        }
                                                     ?></p>
                            
                    </div>
                    <!-- //최근 구매이력 -->

                    <!-- My Book -->
                    <div class="submain_mypagae_foot smf_l">
                            <p class="sm_tit">My Book</p>						
                                <table width="500" boarder="1" cellspacing="0" cellpadding="8">
                                    <tbody>
                                        <tr>
                                            <th>등록번호</th>
                                            <th>서명</th>
                                            <th>저자</th>
                                            <th>출판사</th>
                                        </tr>
<?php
    try{
        //sql2는 책 정보
        $sql= "select isbn from book where cid = :id";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':id', $id, PDO::PARAM_STR);
        //$stmh2->bindValue(':pw', $pw, PDO::PARAM_STR);
        $stmh->execute();
        
        
        while($temp_row = $stmh->fetch(PDO::FETCH_ASSOC)) {
            $sql = "select * from book_type where isbn = :isbn";
            
            $stmh2 = $pdo->prepare($sql);
            $stmh2->bindValue(':isbn', $temp_row['isbn'], PDO::PARAM_STR);
            //$stmh2->bindValue(':pw', $pw, PDO::PARAM_STR);
            $stmh2->execute();
            $row = $stmh2->fetch(PDO::FETCH_ASSOC);
?>
                                        <tr>
                                            <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['isbn'])?></td>
                                            <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['name'])?></td>
                                            <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['author'])?></td>
                                            <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['publisher'])?></td>
                                            <td>
                                                <form name="look_book" method="get" action="/store/books/look.php" style="margin: 0 auto; ">
                                                    <div style="text-align: center">
                                                        <input type="hidden" name="isbn" value=<?=htmlspecialchars($row['isbn'])?>>
                                                        <input type="submit" value="책 정보" style=" background: #2d3651; width: 82px; height: 30px; margin:0; border: 0; padding:0; border-radius: .3em; color: #FFF;">
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
            }
        } catch (PDOException $Exception) {
            die('Error: '.$Exception->getMessage());
        }
                                        ?>
                                    </tbody>
                                </table>
                    </div>
                    <!-- //My Book -->

                    
            </div>

    </div>
    <!-- //Contents -->


</body>
</html>
