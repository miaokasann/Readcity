<?php
error_reporting(0);
  /*
**********************************************
	Author:	miaokasann
	Date:	2018-11-24

	usage:
    读取√
    

    写入√

    修改√

    删除√

	注意：	服务器所返回的时间戳都是秒（JS是毫秒）
**********************************************
*/
header("Content-Type:text/html;charset=utf-8");  

  $db=@mysql_connect('localhost', 'root', '');

  if(!$db){
    die('connect failed!');
  }

  $a = mysql_query("set names 'utf8'");//解决数据库中有汉字时显示在前台出现乱码问题
  $a = mysql_query('CREATE DATABASE Book');
  $a = mysql_select_db('Book',$db);//设置数据库

  $act=$_GET['act'];

  switch($act){
    case 'read':
    $res = "SELECT * FROM manybook where 1=1";
      $id = $_GET['userid'];
      $bid = $_GET['book'];
      $opera_type = $_GET['otype'];//判断是否是收藏 1/全部书籍 0

      if($id>0 && $opera_type == 1){
        $res .= " and id in (select bookid from connect where userid = ".$id.")";
      }
      if($bid > 0){
        $res .= " and id = ".$bid;
      }
      // echo $res;
      $result = mysql_query($res);
      $results = array();
      if (mysql_num_rows($result) > 0) {
        // 输出数据
        while($row = mysql_fetch_assoc($result)) {
          $results[] = $row;
        }
        if($results){
          echo json_encode($results);   
        }else{
          echo mysql_error();
        }
    } else {
        echo "0 结果";
    }
    break;

    case 'add':
      $type = $_POST['type'];
      $title = $_POST['title'];
      $price = empty($_POST['price'])?0:$_POST['price'];
      $author = $_POST['author'];
      $birth = $_POST['birth'];
      $description = $_POST['description'];
      $pic = $_POST['pic'];

      $q="INSERT INTO manybook VALUES(null,'".$type."','".$title."','".$price."','".$author."','".$birth."','".$description."','".$pic."')";

      $result = mysql_query($q,$db);
      $getID=mysql_insert_id();//获取插入记录的ID

      if(!$result){
       echo("{\"msg\":\"fail to insert data". mysql_error()."\",\"id\":-1}");
      }
      else{
        echo "{\"msg\":\"success\",\"id\":".$getID."}";
      }
      mysql_close($db);
      break;
    
    case 'mod':
      $id = $_POST['id'];
      $type = $_POST['type'];
      $title = $_POST['title'];
      $price = empty($_POST['price'])?0:$_POST['price'];
      $author = $_POST['author'];
      $birth = $_POST['birth'];
      $description = $_POST['description'];
      $pic = $_POST['pic'];
      
      $res = "update manybook set type='$type',title='$title',price=$price,author='$author',birth='$birth',description='$description',pic='$pic' where id=".$id;
      $result = mysql_query($res);
      if(!$result){
        echo("{\"msg\":\"fail to modify data\"". mysql_error()."}");
       }
       else{
         echo "{\"msg\":\"success\",\"id\":".$id."}";
       }
       mysql_close($db);
      break;
      
    case 'del':
      $id = $_POST['id'];
      $res = "delete from manybook where id=".$id;
      $result = mysql_query($res);
      if($result){
        echo "{\"msg\":\"success\"}";
      }else{
        echo mysql_error();
      }
      break;

    case 'cate':
      $one = $_GET['one'];
      $res = "select * from manybook where type='".$one."'";
      $result = mysql_query($res);
      //$row = mysql_fetch_array($result,MYSQL_ASSOC);
      $results = array();
      if (mysql_num_rows($result) > 0) {
        // 输出数据
        while($row = mysql_fetch_assoc($result)) {
          $results[] = $row;
        }
        if($results){
          echo json_encode($results);   
        }else{
          echo mysql_error();
        }
      }
      break;
    }
?>