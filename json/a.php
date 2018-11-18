<?php
	$tojson = $_POST['arr'];
	print_r($tojson);

	$myfile = fopen("filename.txt", "w");
	fwrite($myfile, $tojson);
	fclose($myfile);
	//error_reporting(0);
	// include 'data.php';
	// $id = $_POST['id'];
	// $type = $_POST['type'];
	// $title = $_POST['title'];
	// $price = $_POST['price'];
	// $author = $_POST['author'];
	// $birth = $_POST['birth'];
	// $description = $_POST['description'];
	// $pic = $_POST['pic'];

	// $id = 1;
	// $type = 'dusi';
	// $title = 'girjo';
	// $price = '10';
	// $author = 'mary';
	// $birth = '2016-44-2';
	// $description = 'jgjkfjggjfkd;gkdl';
	// $pic = '100.jpg';

	// $info = compact('id','type','title','price','author','birth','description','pic');
	// $info_arr = object2array($info);
	// array_push($jsonArr,$info_arr);
	// //xprint_r($jsonArr);
	// //echo json_encode($arr);
	// //print_r($info);
	// foreach ($jsonArr as $key => $value) {
	// 	$arr = print_r($value);
	// }

	// function object2array($object) {
	//   if(is_object($object)) {
	//     foreach ($object as $key => $value) {
	//       $array[$key] = $value;
	//     }
	//   }
	//   else {
	//     $array = $object;
	//   }
	//   return $array;
	// }
?>


