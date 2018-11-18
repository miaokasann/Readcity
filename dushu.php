<?php
	error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>dushu</title>
	
	<link rel="stylesheet" href="css/common.css" />
	<link rel="stylesheet" href="css/smoothness/jquery ui.css">
	<script src="js/jquery.js"></script>
	<script src="js/jquery ui.js"></script>
	<script src="js/app.js"></script>
</head>
<body>
	<?php
		$checked = '{["1":"4"]}';
		$toArray = json_decode($checked);
		print_r($toArray);
		//echo $toArray;
	?>
	<div class="headerBox">
		<div class="header comWidth">
			<div class="logo fl">
				<a href="#">读书 dushu</a>
			</div>
			<div class="searchBox fl">
				<input type="text" class="search_input fl" />
				<input type="button" class="search_btn" value="搜书" />
			</div>
			<ul class="menu fr">
				<li>
					<div class="menuTxt">
						<a href="#" class="login">登录</a><span>|</span><a href="#">注册</a>
					</div>
				</li>
				<li>
					<div class="menuTxt">
						<a href="#" class="record">观看记录</a>
					</div>
				</li>
				<li>
					<div class="menuTxt">
						<a href="#" class="upload">上传</a>
					</div>
				</li>
			</ul>

		</div>
	</div>
	<div class="navBox">
		<div class="nav">
			<div class="type_menu active">
				<a href="#">新书</a>
				<i></i>
			</div>
			<div class="type_menu">
				<a href="#">推荐</a>
				<i></i>
			</div>
			<div class="type_menu">
				<a href="#">书单</a>
				<i></i>
			</div>
		</div>
	</div>
	<div class="label">
		<span>标签：</span>
		<li><a href="#">都市</a></li>
		<li><a href="#">武侠</a></li>
		<li><a href="#">文史</a></li>
		<li><a href="#">科技</a></li>
	</div>
	<div class="main">
		<ul id="gallery-wrapper">
			<div class="white-panel" id="upload">
				<img src="images/add.jpg" class="thumb">
			</div>
		</ul>
	</div>
	
	<!-- 上传对话框的html -->
	<div id="upload_panel" title="新增/修改图书">
		<p>
			<label for="type">类型/标签：</label>
			<select id="dropDown" class="text">
				<option>都市</option>
				<option>武侠</option>
				<option>文史</option>
				<option>科技</option>
			</select>
		</p>
		<p>
			<label for="title">书名：</label>
			<input type="text" name="title" class="text" id="title" title="请输入书名"/>
		</p>
		<p>
			<label for="price">定价：</label>
			<input type="text" name="price" class="text" id="price" title="请输入价格！"/>
		</p>
		<p>
			<label for="author">作者：</label>
			<input type="text" name="author" class="text" id="author" title="请输入作者姓名！"/>
		</p>
		<p>
			<label for="birth">出版日期：</label>
			<input type="text" name="birth" readonly="readonly" class="text" id="birth" />
		</p>
		<p>
			<label for="description">详情介绍：</label>
			<textarea name="description" class="text" id="description" style="line-height:30px; width: 200px; height: 300px;"></textarea>
		</p>
		<p>
			<label for="pic_upload">封面图上传：</label>
			<input type="file" id="btn_file" class="btn-file" accept="image/*" onchange="change()" />
			<input type="button" id="btn_file_ok" class="btn-file-ok" value="确定" style="display: none;" onclick="uploadImg();" />
			<!-- <input type="button" name="pic_upload" class="text" id="pic_upload" value="点击上传" onclick="show();" /> -->
		</p>
		<p class="img-look">
			<label for="pic_upload">预览图：</label>
			<img id="img_look" alt="" style="width: 250px; height: 200px;">
		</p>
	</div>
	
	<!-- <div class="cover">
		<a href="#" title="">
			<img src="images/10.jpg" class="thumb" alt="">
		</a>
	</div>
	<div class="info">
		<div class="title"></div>
		<div class="author"></div>
		<div class="more-meta">
			<h4 class="title">设计与真理</h4>
			<p>
				<span class="author">发货人</span>/
				<span class="birth">2018-10-4</span>/
				<span class="publisher">人民出版社</span>
			</p>
			<p class="description">偷书贼》是澳大利亚知名作家马库斯•苏萨克的长篇小说代表作，它像《解忧杂货店》和《追风筝的人》一样，可以战胜孤独和恐惧，拯救身陷绝望的人，遇到这些书，是我们这一代人的幸运。
二战期间，九岁的德国姑娘莉泽尔和弟弟被送往寄养家庭。弟弟不幸病死在火车上。在埋葬弟弟的荒原上，莉泽尔捡到了一本对她意义非凡的书《掘墓人手册》。</p>
		</div>
	</div> -->
	
</body>
</html>