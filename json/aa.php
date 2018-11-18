<?php
	header('content-type:text/html;charset="utf-8"');
	$jsonArr = array(
		array("id"=>1,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"1.jpg"),
		array("id"=>2,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"2.jpg"),
		array("id"=>3,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"3.jpg"),
		array("id"=>4,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"4.jpg"),
		array("id"=>5,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"5.jpg"),
		array("id"=>6,"type"=>"都市","title"=>"平凡的世界","price"=>"10","author"=>"霍金","birth"=>"2018-10-1","description"=>"我是平凡的世界","pic"=>"6.jpg"),
	);
	echo json_encode($jsonArr);
	// function str2arr1($str){
	//     $arr = explode("|",$str);
	//     $r = array();
	//     foreach ($arr as $val){
	//         $t = explode("=",$val);
	//         $r[$t[0]]= $t[1];
	//     }
	//     return $r;
	// }

	// $a='TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037|TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037';

	// // for ($i=0;$i<50;$i++){
	// //     $t = microtime();
	// //     $b = str2arr1($a);
	// //     $t1 = microtime();
	// //     str2arr($a);
	// //     $t2 = microtime();
	// //     echo $t2+$t-2*$t1.'<br />';
	// // }

	// print_r(str2arr1($a));
?>