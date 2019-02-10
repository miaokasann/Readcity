<?php
  header("Content-Type:text/html;charset=utf-8");

  $db=@mysql_connect('localhost', 'root', '');
  if(!$db){
    die('connect failed!');
  }

  mysql_query("set names 'utf8'");//解决数据库中有汉字时显示在前台出现乱码问题
  mysql_select_db('Book',$db);

  $sql= <<< END
  CREATE TABLE  `Book`.`connect` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `userid` INT NOT NULL,
  `bookid` INT NOT NULL
  ) CHARACTER SET utf8 COLLATE utf8_general_ci
END;
  mysql_query($sql);
  
  $act = $_GET['act'];
  $userid = $_COOKIE['userid'];
  $bookid = $_GET['bookid'];

  switch($act){
    case 'like':
      $str = array(
        'code'=>false,
        'msg'=>"",
        'or'=>""
      );
    
      $q="select * from connect where (userid=".$userid." and bookid=".$bookid.")";
      $result = mysql_query($q,$db);
      // $row = mysql_fetch_array($result,MYSQL_ASSOC);
      $num = mysql_num_rows($result);
      if(!$num){
        $q="INSERT INTO connect VALUES(null,'".$userid."','".$bookid."')";
        $res = mysql_query($q,$db);
        $getID=mysql_insert_id();
        if(!$res){
          $str['msg']="插入失败！";
          $str['or']="no";
        }
        else{
          $str['code'] = true;
          $str['msg']="喜欢成功！";
          $str['or']="yes";
        }
      }
      else{
        $str['msg']="已经喜欢了！";
        $str['or']="yes";
        
      }
      echo json_encode($str);
      mysql_close($db);
      break;

    case 'checklike':
      $str = array(
        'code'=>false,
        'msg'=>"",
        'or'=>""
      );
    
      $q="select * from connect where (userid=".$userid." and bookid=".$bookid.")";
      $result = mysql_query($q,$db);
      // $row = mysql_fetch_array($result,MYSQL_ASSOC);
      $num = mysql_num_rows($result);
      if($num){
        $str['msg']="已经喜欢了！";
        $str['or']="yes";
      }
      else{
        $str['or']="no";
      }
      echo json_encode($str);
      mysql_close($db);
      break;
  }

?>