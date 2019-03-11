<?php
    if( isset($_POST["user_id"]) && ($_POST["user_pw"]=="" || $_POST["user_name"]=="" || $_POST["user_sex"]=="" || $_POST["user_birth_year"]=="" || $_POST["user_birth_month"]=="" || $_POST["user_birth_day"]=="" || $_POST["user_email_1"]=="" || $_POST["user_email_2"]=="" || $_POST["user_job"]=="") ) {
?>
<script>
    alert('모든 정보를 정확히 입력해주세요.');
</script>
<?php
    }
    else if ( isset($_POST["user_id"]) ) {
        $id = $_POST["user_id"];
        $pw = $_POST["user_pw"];
        $name = $_POST["user_name"];
        if( $_POST["user_sex"] == "m" ) 
            $sex = 0;
        else if( $_POST["user_sex"] == "w" )
            $sex = 1;
        $d = $_POST["user_birth_year"]."-".$_POST["user_birth_month"]."-".$_POST["user_birth_day"];
        $birth = date_create($d)->format("Y-m-d");
        $email = $_POST["user_email_1"]."@".$_POST["user_email_2"];
        $phone = $_POST["user_phone_1"]."-".$_POST["user_phone_2"]."-".$_POST["user_phone_3"];
        $job = (int)$_POST["user_job"];
        $mileage = 0;
        
        $db_user="root";
        $db_pass="1234";
        $db_type="mysql";
        $db_host="localhost";
        $db_name="project";
        $tb_name="customer";
        $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";
        
        try{
            $pdo=new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "insert into customer (cid, password, name, sex, birth, phone, email, job, mileage) values ( :id, :pw, :name, :sex, :birth, :phone, :email, :job, :mileage)";
               
            
            $stmh = $pdo->prepare($sql);
            
            $stmh->bindValue(':id', $id);
            $stmh->bindValue(':pw', $pw, PDO::PARAM_STR);
            $stmh->bindValue(':name', $name, PDO::PARAM_STR);
            $stmh->bindValue(':sex', $sex, PDO::PARAM_INT);
            $stmh->bindValue(':birth', $birth, PDO::PARAM_STR);
            $stmh->bindValue(':phone', $phone, PDO::PARAM_STR);
            $stmh->bindValue(':email', $email, PDO::PARAM_STR);
            $stmh->bindValue(':job', $job, PDO::PARAM_INT);
            $stmh->bindValue(':mileage', $mileage, PDO::PARAM_INT);
            
            $stmh->execute();
        } catch (PDOException $Exception) {
            die('Error: '.$Exception->getMessage());
        }
?>
<script>
    alert('회원가입에 성공하였습니다.');
</script>
<?php
        Header("Location:../index.php");
    }
?>

<html>
    <head>
        <title>한빛출판네트워크</title>
        <style>
            <?php include "../css/layout_member.css"; ?> 
        </style>
    </head>
    <body>
        <form method="post" action="./member_agree.php">
            <fieldset>
                <legend>회원정보 필수입력</legend>
                <p class="register_tit"><strong>회원정보 <span>(필수)</span></strong></p>
                <p class="register_cap"><span>* </span>는 필수 입력 사항입니다.</p>

                <div class="register_essential">
                    <div class="register_li">
                        <div class="i_tit"><strong>아이디<span>* </span></strong></div>
                        <div class="i_con">
                            <input type="text" name="user_id" id="user_id" class="i_text" value="">
                        </div>
                    </div>

                    <div class="register_li">
                        <div class="i_tit"><strong>비밀번호<span>* </span></strong></div>
                        <div class="i_con">
                            <input type="password" name="user_pw" id="user_passwd" class="i_text" value="">
                            <span id="pw_tip">8~20자리의 영문, 숫자 조합을 권장합니다</span>	
                        </div>
                    </div>

                    <div class="register_li">
                        <div class="i_tit"><strong>이름<span>* </span></strong></div>
                        <div class="i_con">
                            <label>
                                <input type="text" name="user_name" id="user_name" value="" class="i_text">	
                            </label>
                        </div>
                    </div>

                    <div class="register_li">
                        <div class="i_tit"><strong>성별<span>* </span></strong></div>
                        <div class="i_con">
                            <label class="ra_label">
                                <input type="radio" name="user_sex" id="user_sex" value="m" class="i_radio" checked="">
                                <span>남성</span>
                            </label>
                            <label class="ra_label">
                                <input type="radio" name="user_sex" id="user_sex" value="w" class="i_radio">
                                <span>여성</span>
                            </label>
                        </div>
                    </div>

                    <div class="register_li">
                        <div class="i_tit"><strong>생년월일<span>* </span></strong></div>
                        <div class="i_con">
                            <label>
                            <select id="m_birth_year" name="user_birth_year" class="i_select">	
                                <option value="">::선택::</option>                                              
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
                                <option value="2013">2013</option>
                                <option value="2012">2012</option>
                                <option value="2011">2011</option>
                                <option value="2010">2010</option>
                                <option value="2009">2009</option>
                                <option value="2008">2008</option>
                                <option value="2007">2007</option>
                                <option value="2006">2006</option>
                                <option value="2005">2005</option>
                                <option value="2004">2004</option>
                                <option value="2003">2003</option>
                                <option value="2002">2002</option>
                                <option value="2001">2001</option>
                                <option value="2000">2000</option>
                                <option value="1999">1999</option>
                                <option value="1998">1998</option>
                                <option value="1997">1997</option>
                                <option value="1996">1996</option>
                                <option value="1995">1995</option>
                                <option value="1994">1994</option>
                                <option value="1993">1993</option>
                                <option value="1992">1992</option>
                                <option value="1991">1991</option>
                                <option value="1990">1990</option>
                                <option value="1989">1989</option>
                                <option value="1988">1988</option>
                                <option value="1987">1987</option>
                                <option value="1986">1986</option>
                                <option value="1985">1985</option>
                                <option value="1984">1984</option>
                                <option value="1983">1983</option>
                                <option value="1982">1982</option>
                                <option value="1981">1981</option>
                                <option value="1980">1980</option>
                                <option value="1979">1979</option>
                                <option value="1978">1978</option>
                                <option value="1977">1977</option>
                                <option value="1976">1976</option>
                                <option value="1975">1975</option>
                                <option value="1974">1974</option>
                                <option value="1973">1973</option>
                                <option value="1972">1972</option>
                                <option value="1971">1971</option>
                                <option value="1970">1970</option>
                                <option value="1969">1969</option>
                                <option value="1968">1968</option>
                                <option value="1967">1967</option>
                                <option value="1966">1966</option>
                                <option value="1965">1965</option>
                                <option value="1964">1964</option>
                                <option value="1963">1963</option>
                                <option value="1962">1962</option>
                                <option value="1961">1961</option>
                                <option value="1960">1960</option>
                            </select>
                            </label>
                            <label>
                            <select id="m_birth_month" name="user_birth_month" class="i_select">								
                                <option value="">::선택::</option>													
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            </label>
                            <label>							
                            <select id="m_birth_day" name="user_birth_day" class="i_select">									
                                <option value="">::선택::</option>												
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>  
                            </label>   
                        </div>
                    </div>

                    <div class="register_li">
                        <div class="i_tit"><strong>이메일<span>* </span></strong></div>
                        <div class="i_con">
                            <label>
                                <input type="text" name="user_email_1" id="user_email_1" class="i_text2" value="">	
                            </label>
                            @
                            <label>
                                <input type="text" name="user_email_2" id="user_email_2" class="i_text2" value="">	
                            </label>
                        </div>
                    </div>

                    <div class="register_li">
                        <div class="i_tit"><strong>휴대전화<span>* </span></strong></div>
                        <div class="i_con">
                            <label>
                                <input type="text" name="user_phone_1" id="user_phone_1" class="i_text3" value="" maxlength="4">	
                            </label>
                            - 
                            <label>
                                <input type="text" name="user_phone_2" id="user_phone_2" class="i_text3" value="" maxlength="4">	
                            </label>
                            - 
                            <label>
                                <input type="text" name="user_phone_3" id="user_phone_3" class="i_text3" value="" maxlength="4">	
                            </label>
                        </div>
                    </div>
                    
                    <div class="register_li">
                        <div class="i_tit"><strong>직업<span>* </span></strong></div>
                        <div class="i_con">
                            <label>	
                                <select id="user_job" name="user_job" class="i_select2">		
                                    <option value="">:: 선택하세요. ::</option>
                                    <option value="2">중학생</option>
                                    <option value="3">고등학생</option>
                                    <option value="4">대학(원)생</option>
                                    <option value="5">S/W관련직</option>
                                    <option value="6">H/W관련직</option>
                                    <option value="7">인터넷관련직</option>
                                    <option value="8">사무/관리직</option>
                                    <option value="9">일반영업직</option>
                                    <option value="10">제조/생산직</option>
                                    <option value="11">언론/출판/방송/연예</option>
                                    <option value="12">공무원</option>
                                    <option value="13">교원/강사직</option>
                                    <option value="14">건강/의료직</option>
                                    <option value="15">법조/전문직</option>
                                    <option value="16">프리랜서</option>
                                    <option value="17">주부</option>
                                    <option value="18">자영업</option>
                                    <option value="19">기타</option>		
                                </select>								
                            </label>
                        </div>
                    </div>	
                </div>
            </fieldset>
            <div class="btn_label_default">
                <label>
                    <input type="submit" name="mem_proc_btn" id="mem_proc_btn" value="회원가입하기" class="btn_blue">
                    <!--button name="mem_proc_btn" type="button" value="다음단계" class="btn_blue" onclick="mem_submit();">회원가입하기</button -->		
                </label>
            </div>
        </form>
        <?php
        ?>
    </body>
</html>