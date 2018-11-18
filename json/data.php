<?php
	//error_reporting(0);
	// header('content-type:text/html;charset="utf-8"');
	// $jsonArr = array(
	// 	array("id"=>1,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"1.jpg"),
	// 	array("id"=>2,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"2.jpg"),
	// 	array("id"=>3,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"3.jpg"),
	// 	array("id"=>4,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"4.jpg"),
	// 	array("id"=>5,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"5.jpg"),
	// 	array("id"=>6,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"6.jpg"),
	// );
	// echo json_encode($jsonArr);

	// $arr = array_push($jsonArr, $info);

	// echo $arr;
	//echo json_encode($arr);
	// $file = 'filename.txt';
	// $text='<?php $rows='.var_export($jsonArr,true).';'; 
	// if(false!==fopen($file,'w+')){ 
	//   file_put_contents($file,$text); 
	// }else{ 
	//   echo '创建失败'; 
	// } 
	$jsonArr = array();
	$jsonto = array();
	$topicid = '';
../images/pic+shijianchuo.jpg
	$file = 'filename.txt';
	$cbody = file_get_contents($file);
	print_r($cbody);
	// $arr = (explode(";", $cbody));
	// //print_r($arr[0]);
	// $len = sizeof($arr);
	// for($i=0;$i<$len;$i++){
	// 	$jsonto[$i] = (explode(",", $arr[$i]));
	// 	array_push($jsonArr, $jsonto[$i]);
	// }
	// //var_dump($jsonArr);
	// header('content-type:text/html;charset="utf-8"');
	// //echo json_encode($jsonArr);
	// if(is_array($jsonArr)){
	// 	foreach ($jsonArr as $key => $value) {
			 
	// 		// $jsonto[] = $value['id'];
	// 		// $jsonto[] = $value['type'];
	// 		// print_r($jsonto);
	// 		for($i=0;$i<sizeof($value);$i++){
	// 			// $val = str2arr1($value[$i]);
	// 			// print_r($val);
	// 			$val .= $value[$i].',';

	// 		}

	//  	}
	//  	echo $val;
	// }

	// print_r(str2arr1($val));

	// function str2arr1($str){
	//     $arr = explode(",",$str);
	//     $r = array();
	//     foreach ($arr as $val){
	//         $t = explode("=>",$val);
	//         $r[$t[0]]= $t[1];
	//     }
	//     return $r;
	// }
	//print_r($jsonArr);
	//echo json_encode($jsonArr);
	// if(is_array($arr)){
	// 	

	// }

		// }
		// echo $topicid;
		// echo $arr.length;
		// for($i=0;$i<$arr.length;$i++){
		// 	echo $arr[$i];
		// }
	
	//$jsonArr = array_values($jsonArr);
	//print_r($jsonArr);
	//$jsonArrto = array();

	//$jsonArr .= $topicid;
	
	//echo json_encode($topicid);
	// echo json_encode(print_r($value));
	
	//print_r($arr);

	// $results = print_r($jsonArr, true); 
	// file_put_contents('filename.txt', print_r($jsonArr, true));

	//$file = 'filename.txt'; //先读取文件

	//$cbody = file($file); //file（）函数作用是返回一行数组，txt里有三行数据，因此一行被识别为一个数组，三行被识别为三个数组
	//echo json_encode($cbody);
	// for($i=0;$i<count($cbody);$i++){ //count函数就是获取数组的长度的，长度为3 因为一行被识别为一个数组 有三行

	// 	echo $cbody[$i];
	// 	echo "<br/>"; 
	// 	//最后是循环输出每个数组，在每个数组输出完毕后 ，输出一个换行，这样就可以达到换行效果
	// }
	// $arr = json_decode($cbody,true);
	// echo $arr;
        
        // print_r($arr);
        // foreach ($arr as &$item){
        //     $item['children'] = array_values($item['children']);
        //     foreach ($item['children'] as &$child){
        //         $child['children'] = array_values($child['children']);
        //     }
        // }
        //echo json_encode($arr);

	




	//$id = $_POST['id'];

	// $jsondata = jsondata_decode($jsonArr);
	// header("Content-Type: text/html; charset=UTF-8");
	// //print_r($jsondata);
	// $arr = $jsondata->data;
	// //print_r($arr);	
	
	// $count_json = count($arr);
	// //echo $count_json;
	// $a = array();
	// for($i=0;$i<$count_json;$i++)
	// {
	// 	$sz = object2array($arr[$i]);
	// 	//$a[] = $sz;
	// 	array_push($a,$sz);
				
	// }
	// print_r($a);	
	// //echo json_decode($a);


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

	// function array2object($array) {
	//   if (is_array($array)) {
	//     $obj = new StdClass();
	//     foreach ($array as $key => $val){
	//       $obj->$key = $val;
	//     }
	//   }
	//   else { $obj = $array; }
	//   return $obj;
	// }

?>