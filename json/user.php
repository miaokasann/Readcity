<?php
  error_reporting(0);
  session_set_cookie_params(3000);//セッションの時間を変更する場合もこの部分に記述する
  session_start();//セッションを利用するのでセッションを始めるための関数を呼び出す
  header("Content-Type:text/html;charset=utf-8");

  $db=@mysql_connect('localhost', 'root', '');
  if(!$db){
    die('connect failed!');
  }

  mysql_query("set names 'utf8'");//解决数据库中有汉字时显示在前台出现乱码问题
  mysql_select_db('Book',$db);

  $sql= <<< END
  CREATE TABLE  `Book`.`user` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `username` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  `sex` TEXT,
  `userbirth` TEXT,
  `mail` TEXT
  ) CHARACTER SET utf8 COLLATE utf8_general_ci
END;
  mysql_query($sql);

  $act=$_GET['act'];
  $pagesize=5;//设置每页最大能显示的数量

  switch($act){
    case 'reg':
      $username = $_POST['username'];
      $password = $_POST['password'];
      $mail = $_POST['mail'];
      $sex = $_POST['sex'];
      $userbirth = $_POST['userbirth'];
      
      $q="INSERT INTO user VALUES(null,'".$username."','".$password."','".$sex."','".$userbirth."','".$mail."',0)";
      $result = mysql_query($q);
    
      if(!$result){
        echo("{\"msg\":\"fail to insert data". mysql_error()."\"}");
      }
      else{
        echo "{\"msg\":\"success\"}";
        echo "<script>alert('注册成功！去登陆');window.location.href='../login.html'</script>";
        //header("location:../login.html");
      }
      mysql_close($db);
      break;

    case 'login': 
      $username = $_POST["username"];
      $password = $_POST["password"];

      $str = array
        (
          'code'=>false,//需要存一个username,用于登录展示用户名123
          'username'=>"",
          'userid'=>"",
          'admin'=>"",
          'msg'=>""
        );
      if($username == "" || $password == "")  
      {  
        $str['msg'] = "用户名/密码为空！";
         
      }
      else 
      {   
        $sql = "select id,username,password,admin from user where username = '$_POST[username]' and password = '$_POST[password]'";  
        $result = mysql_query($sql);
        $num = mysql_num_rows($result);
        if($num)  
        {  
          $row = mysql_fetch_array($result,MYSQL_ASSOC);  //将数据以索引方式储存在数组中 注：MYSQL_ASSOC - 关联数组; MYSQL_NUM - 数字数组; MYSQL_BOTH - 默认。同时产生关联和数字数组 
          $_SESSION['user_name']="$username";
          $_SESSION['user_id']=$row['id'];//将userid 存储在session中
          $_SESSION['admin']=$row['admin'];
          $ssid = session_id();
          setcookie("mgsessionId",$ssid);//设置一个mgsessionid 用于存储当前的session_id 存放到浏览器的cookie中
          setcookie("admin",$_SESSION['admin']);
          setcookie("userid",$_SESSION['user_id']);
          $str['code'] = true;
          $str['username'] = $_SESSION['user_name'];
          $str['userid'] = $row['id'];
          $str['admin'] = $row['admin'];
          $str['msg'] = "";
          echo json_encode($str);
          header("location:../dushu.html");
        }
        else 
        {  
          echo "<script>alert('用户名或密码不正确！');window.location.href='../login.html'</script>";
        }
      }
      
    break;

    case 'logoff':
      $username = $_GET['username'];
      echo $username;
      if(!empty($_SESSION['user_name']) && $_SESSION['user_name']===$username){
        session_unset();//free all session variable
        session_destroy();//销毁一个会话中的全部数据
        setcookie(session_name(),'',time()-3600);//销毁与客户端的卡号
        echo("{\"msg\":\"success\"}");
      }else{
        echo("{\"msg\":".mysql_error()."}");
      }
      break;
      
    case 'checkLogin':
     	 $str = array
        (
          'msg'=>false,//需要存一个username,用于登录展示用户名123
          'name'=>"",
          'id'=>"",
          "admin"=>""
        );

      if(session_id('mgsessionId') == $_COOKIE['mgsessionId']){//判断mgsessionid是不是存在,如果存在,返回true,并且返回用户数据
        $str['msg'] = true;
        $str['name'] = $_SESSION['user_name'];//需要存一个username,用于登录展示用户名123
        $str['id'] = $_SESSION['user_id'];//需要存一个userid,用于图书列表查询
        $str['admin'] = $_COOKIE['admin'];
      }else{
        $str['msg'] = false;
      }
	    echo json_encode($str);
    break;
    
    case 'user':
      $res = "SELECT * FROM user";
      $result = mysql_query($res);
      $results = array();
      if (mysql_num_rows($result) > 0) {
        // 输出数据
        while($row = mysql_fetch_assoc($result)) {
          $results[] = $row;
        }
        if($results){
          echo json_encode($results);   
        }
        else{
          echo mysql_error();
        }
    } else {
        echo "0 结果";
    }
    break;

    case 'changenow':
      $ad = $_GET['ad'];
      $id = $_GET['id'];

      $res = "update user set admin=$ad where id=".$id;
      $result = mysql_query($res);
      if(!$result){
        echo("{\"msg\":\"fail to modify data\"". mysql_error()."}");
        echo $ad;
        echo $id;
       }
       else{
         echo "{\"msg\":\"success\",\"id\":".$id."}";
       }
       mysql_close($db);
      break;

    case 'deluser':
    $id = $_GET['id'];

    $res = "delete from user where id=".$id;
      $result = mysql_query($res);
      if($result){
        echo "{\"msg\":\"success\"}";
      }else{
        echo mysql_error();
      }
      break;

    case 'catepage':
      $page=$_GET['page'];
      if($page==0){
          $page=1;
      }
      $str = array
      (
        'pagecount'=>'',
        'page'=>''
      );
      $row=mysql_fetch_row(mysql_query("select count(1) from user"));
      $recordcount=$row[0]; 
      if($recordcount==0){
        $pagecount=0;
      }   
      else if($recordcount<$pagesize||$recordcount==$pagesize){
        $pagecount=1;//如果记录总数量小于每页显示的记录数量,则只有一页
      }
      else if($recordcount%$pagesize==0){
        $pagecount=$recordcount/$pagesize;//如果没有余数,则页数等于总记录数量除以每页显示记录的数量
      }
      else{
        $pagecount=(int)($recordcount/$pagesize)+1;
        //取记录总数量不能整除每页显示记录的数量，
        //则页数等于总记录数量除以每页显示记录数量的结果取整再加 1
      }
      $str['pagecount'] = $pagecount;
      $str['page'] = $page;
      echo json_encode($str);
    break;

    case 'fenpage':
      $page = $_GET['page'];
      if(!$page)
      {
        $page = 1;
      }
      $results = array();
      $sql=($page-1)*$pagesize;
      $result=mysql_query("select * from user limit {$sql},{$pagesize}");
      if (mysql_num_rows($result) > 0) {
        // 输出数据
        while($row = mysql_fetch_assoc($result)) {
          $results[] = $row;
        }
        if($results){
          echo json_encode($results);
        }
        else{
          echo mysql_error();
        }
    } else {
        echo "{\"msg\":\"no\"}";
    }
      mysql_close($db);
      break;
  }
?>