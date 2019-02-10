<?php
  header("Content-Type:text/html;charset=utf-8");

  $db=@mysql_connect('localhost', 'root', '');
  if(!$db){
    die('connect failed!');
  }

  mysql_query("set names 'utf8'");//解决数据库中有汉字时显示在前台出现乱码问题
  mysql_query('CREATE DATABASE Book');
  mysql_select_db('Book',$db);

  $sql1= <<< END
  CREATE TABLE  `Book`.`manybook` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `type` TEXT NOT NULL ,
  `title` TEXT NOT NULL ,
  `price` INT,
  `author` TEXT,
  `birth` TEXT,
  `description` TEXT,
  `pic` TEXT
  ) CHARACTER SET utf8 COLLATE utf8_general_ci
END;
  mysql_query($sql1);

  
  $sql2= <<< END
  CREATE TABLE  `Book`.`user` (
  `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `username` TEXT NOT NULL,
  `password` TEXT NOT NULL,
  `sex` TEXT,
  `userbirth` TEXT,
  `mail` TEXT,
  `admin` INT NOT NULL
  ) CHARACTER SET utf8 COLLATE utf8_general_ci
END;
  mysql_query($sql2);
  
  $sql3= <<< END
  CREATE TABLE  `Book`.`connect` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `userid` INT NOT NULL,
  `bookid` INT NOT NULL
  ) CHARACTER SET utf8 COLLATE utf8_general_ci
END;
  mysql_query($sql3);

  $sql4= <<< END
  CREATE TABLE  `Book`.`session` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `sessionid` TEXT NOT NULL,
  `logintime` TIMESTAMP NOT NULL,
  `username` TEXT NOT NULL
  ) CHARACTER SET utf8 COLLATE utf8_general_ci
END;
  mysql_query($sql4);

?>