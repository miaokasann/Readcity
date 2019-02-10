var jsonObj;
var jsonArr;
var picPath;
var len = 0;
var modId = -1;//-1的时候是新增，修改的时候modId=自己的ID
var currentTemObj;
var isLogin = -1;
var otype=0;
var url;

checkLogin();//优先执行

// 打开登录对话框
$(function(){
  init();//各个对话框的初始化

  //点击加号添加图书的对话框打开
	$('#upload').click(function(){
		modId = -1;
		$('#upload_panel').dialog('open');
	});

  $('#login_o').click(function(){
		$('#login').dialog('open');
	});

// 打开注册对话框
	$('#reg_o').click(function(){
		$('#reg').dialog('open');
  });
  $('#reg_date').datepicker();//注册里面的日历
	$('#birth').datepicker();//上传图书信息的出版日期

});

/*分类筛选*/
function category(id){
		var one = id
		//console.log(one);
		$.ajax({
			url:'json/sql.php?act=cate&one='+one,
			success: function(response, status, xhr){
				// $('#gallery-wrapper').html(
				// 	`<div class="white-panel" id="upload">
				// 		<img src="images/add.jpg" class="thumb">
				// 	</div>`
				// );
				if(response){
					$('#gallery-wrapper').html('');
					var json = JSON.parse(response);
					len = jsonArr.length;
					for(var i=0;i<json.length;i++)
					{
						setAll2(json[i]);
					}
					moveon();
					}
					else{
						$('#gallery-wrapper').html('');
					}
				}
		});
}
//检查用户是否已经登录
function checkLogin(){
	$.ajax({
		type:'POST',
		url : 'json/user.php?act=checkLogin',
		contentType:'application/x-www-form-urlencoded;charset=utf-8',
		success:function (response, status, xhr){
      $('#gallery-wrapper').html('');
			var userid = -1;
			var checkjson = JSON.parse(response);
			if(checkjson.msg != false){//已经登录
				userid = checkjson.id;
				//setCookie('userid','userid',3000);
				url = 'json/sql.php?act=read&userid='+userid;
				$('#user_name').html(
					`你好,<a href="#">`+checkjson.name+`</a>
					<ul>
					<li onclick="searchLike(`+checkjson.id+`);"><a href="mylike.html?user=`+checkjson.id+`">我的收藏</a></li>
					<li onclick="logOff(`+checkjson.name+`);"><a href="dushu.html">退出登录</a></li>
					</ul>`
				);
        if(checkjson.admin == 1){
					$('#user_name').html(
						`你好,<a href="#">`+checkjson.name+`</a>
						<ul>
						<li onclick="searchLike(`+checkjson.id+`);"><a href="#">用户管理</a></li>
						<li onclick="logOff(`+checkjson.name+`);"><a href="dushu.html">退出登录</a></li>
						</ul>`
					);
          $('#gallery-wrapper').html(
            `<div class="white-panel" id="upload">
              <img src="images/add.jpg" class="thumb">
            </div>`
					);
					$('#upload').click(function(){
						modId = -1;
						$('#upload_panel').dialog('open');
					});
          //readAdmin();
        }
        else{
					url = 'json/sql.php?act=read&userid='+userid;
          //readnoAdmin();
        }
      }
      else{
				url = 'json/sql.php?act=read';
        $('#user_name').html('');
        //readnoAdmin();
      }
		}
	});
}

//非管理员情况下的读取
function readnoAdmin(){
  $.ajax({
    url : url,
    success : function (response, status, xhr) {
      jsonArr = JSON.parse(response);
      len = jsonArr.length;
      for(var i=0;i<jsonArr.length;i++)
      {
        setAll2(jsonArr[i]);
      }
      moveon();
    }
  });
}

//管理员情况下的读取
function readAdmin(){
  $.ajax({
    url : url,
    success : function (response, status, xhr) {
      jsonArr = JSON.parse(response);
      len = jsonArr.length;
      for(var i=0;i<jsonArr.length;i++)
      {
        setAll(jsonArr[i]);
      }
      moveon();
    }
  });
}

//查找我的收藏
function searchLike(data){
	
  $('#gallery-wrapper').html('');
  $.ajax({
		url : 'json/sql.php?act=read&otype=1&userid='+data,
		contentType:'application/x-www-form-urlencoded;charset=utf-8',
    success : function (response, status, xhr) {
			//window.location.reload();
      jsonArr = JSON.parse(response);
      len = jsonArr.length;
      for(var i=0;i<jsonArr.length;i++)
      {
        setAll2(jsonArr[i]);
      }
      moveon();
		},
		error: function(){
			alert(2);
		}
  });
}

//退出登录
function logOff(data){
  removeCookie('PHPSESSID');
  removeCookie('mgsessionId');
	removeCookie('userid');
	removeCookie('admin');
  $.ajax({
    url:'json/user.php?act=logoff&username='+data,
    success:function(data){
      window.location.reload();
    }
  });
}

function removeCookie(name){
	setCookie(name, '1', -1);
}

function setCookie(name, value, iDay){
	var oDate = new Date();
	oDate.setDate(oDate.getDate()+iDay);
  // document.cookie=name+'='+value+';expires='+oDate;
  document.cookie = name+"=' '"+";expires="+oDate+";path="+"/dushu/json";
}

function init(){
	/*上传panel的显示*/
		$('#upload_panel').dialog({
			autoOpen:false,
			modal: true,
			resizable: true,
			height: 500,
			position:{my:"left center",at:"left center",of:"#gallery-wrapper"},
			buttons:{
				'保存': function(e){
					doData(modId,e);
					/*点击保存按钮之后，获取文本框中的信息*/
					$(this).dialog('close');
					
				},
				'取消': function(){
					$(this).dialog('close');
				}
			},
			position:'center',
			width:'750px'
    });
}

function doData(theid,e){
	var jsonObj;
	var id = theid;
	if(theid == -1){
		jsonObj = {id:id,type:"",title:"",price:"",author:"",birth:"",description:"",pic:""};
	}else{
		jsonObj = currentTemObj;
	}
	
	var dropDown = $('#dropDown').val();
	console.log(dropDown);
	var title = $("#title").val();
	var price = $('#price').val();
	var author = $('#author').val();
	var birth = $('#birth').val();
	var description = $('#description').val();
	var thePic = theid == -1?picPath:$("#img_look").attr("src").replace("images/","");

	jsonObj.type = dropDown;
	jsonObj.title = title;
	jsonObj.price = price;
	jsonObj.author = author;
	jsonObj.birth = birth;
	jsonObj.description = description;
	jsonObj.pic = thePic;

	save(jsonObj);

	e.target.value = '';

}

/*新增或修改时候的保存*/
function save(jsonObj){
	var url = jsonObj.id==-1?'json/sql.php?act=add':'json/sql.php?act=mod';
	$.ajax({
		type:'POST',
		url : url,
		contentType:'application/x-www-form-urlencoded;charset=utf-8',
		data:jsonObj,
		success:function (response, status, xhr){
			console.log(response);
			var json = JSON.parse(response);
			console.log(json);
			var returnid = json.id;
			if(returnid == -1){
				alert(json.msg);
			}else{
				jsonObj.id = returnid;
				$(".cl").val("");
				console.log(jsonObj);
				jsonArr.push(jsonObj);
				setAll(jsonObj);
			}
		}
	});
}

/*修改*/
function mod(myid){
	modId = myid;
	for(var j=0;j<jsonArr.length;j++){
		var item = jsonArr[j];
		if(item.id == myid){
			currentTemObj = item;
			//jsonArr.splice(j,1);
		}
	}
	$('#dropDown').val(currentTemObj.type);
	$("#title").val(currentTemObj.title); 
	$('#price').val(currentTemObj.price);
	$('#author').val(currentTemObj.author);
	$('#birth').val(currentTemObj.birth);
	$('#description').val(currentTemObj.description);
	$("#img_look").attr("src", "images/"+currentTemObj.pic);
	$('#upload_panel').dialog('open');
}

	/*鼠标滑过显示详细信息*/
function moveon(){
	var oLi = document.getElementById('gallery-wrapper').getElementsByTagName('li');
	var oMeta = document.getElementsByClassName('more-meta');
	//console.log(oMeta.length);
	for(var i=0;i<oLi.length;i++){
		oLi[i].index=i;
		 oLi[i].onmouseover=function()
		 {
			 for(i=0;i<oLi.length;i++)
			 {
				 oMeta[i].style.display='none';
			 }

			 oMeta[this.index].style.display='block';
		 };
		 oLi[i].onmouseout=function(){

			 oMeta[this.index].style.display='none';

		 };
	}
}

/*删除图书信息*/
function del(myid){
	var idname = "theid_";
	var idnames = "theids_";
	$("#"+idname+myid).remove();
	$("#"+idnames+myid).remove();
	for(var j=0;j<jsonArr.length;j++){
		var item = jsonArr[j];
		if(item.id == myid){
			//jsonArr.splice(j,1);
			$.ajax({
				type:'POST',
				url:'json/sql.php?act=del',
				data:{id:myid},
			});
		}
	}
	moveon();
}


/*信息显示*/
function setAll(object){
	var ele = `<li class="white-panel" id="theid_myid" >
				<a href="bookmsg.html?book=myid"><img src="images/pic" class="thumb"></a>
				<div class="info" id="theids_myid">
				<h4><a href="#">title</a></h4>
				<p>price</p>
				<button onclick="del(myid);">删除</button>
				<button onclick="mod(myid);">编辑</button>
				<div class="more-meta" style="display:none;">
					<h4 class="biaoti">title</h4>
					<p>
						<span class="zuozhe">author</span>\/
						<span class="date">birth</span>\/
						<span class="publisher">人民出版社</span>
					</p>
					<p class="des">description</p>
				</div>
			</div>
			</li>
			`;

	if(modId != -1){
		$("#theid_"+modId).remove();
		$("#theids_"+modId).remove();
	}
	$('#gallery-wrapper').append(
		ele.replace(/myid/g,object.id)
		.replace('pic',object.pic)
		.replace(/title/g,object.title)
		.replace('price',object.price)
		.replace('author',object.author)
		.replace('birth',object.birth)
		.replace('description',object.description)
		);
		moveon();
}

function setAll2(object){
	var ele = `<li class="white-panel" id="theid_myid" >
				<a href="bookmsg.html?book=myid"><img src="images/pic" class="thumb"></a>
				<div class="info" id="theids_myid">
				<h4><a href="#">title</a></h4>
				<p>price</p>
				<div class="more-meta" style="display:none;">
					<h4 class="biaoti">title</h4>
					<p>
						<span class="zuozhe">author</span>\/
						<span class="date">birth</span>\/
						<span class="publisher">人民出版社</span>
					</p>
					<p class="des">description</p>
				</div>
			</div>
			</li>
			`;

	if(modId != -1){
		$("#theid_"+modId).remove();
		$("#theids_"+modId).remove();
	}
	$('#gallery-wrapper').append(
		ele.replace(/myid/g,object.id)
		.replace('pic',object.pic)
		.replace(/title/g,object.title)
		.replace('price',object.price)
		.replace('author',object.author)
		.replace('birth',object.birth)
		.replace('description',object.description)
		);
		moveon();
}

/*上传图片的方法*/
function change(){
	console.log($('#file'));
	var objUrl = getObjectURL($('#file')[0].files[0]);
    console.log("objUrl = "+objUrl) ;
    if (objUrl) 
    {
      $("#img_look").attr("src", objUrl);
      //$("#img_look").removeClass("hide");
    }
}

/*建立一个可存取到该file的url*/
function getObjectURL(file) {
    var url = null ; 
    if (window.createObjectURL!=undefined) { // basic
        url = window.createObjectURL(file) ;
    } else if (window.URL!=undefined) { // mozilla(firefox)
        url = window.URL.createObjectURL(file) ;
    } else if (window.webkitURL!=undefined) { // webkit or chrome
        url = window.webkitURL.createObjectURL(file) ;
    }
    return url ;
 }

function savePic2(){
    var formData = new FormData();
    formData.append("file", $('#file')[0].files[0]);   
    $.ajax({
        url: "json/upload.php",
        type: "POST",
        data: formData,
        /*必须false才会自动加上正确的Content-Type*/
        contentType: false,
        /*必须false才会避开jQuery对 formdata 的默认处理
        * XMLHttpRequest会对 formdata 进行正确的处理 */
        processData: false,
        success: function (data) {
					console.log(data);
					if(data != undefined){
						alert("上传成功！");
        		picPath = data;
					}else{
						alert("上传图片为空！");
					}
        },
        error: function () {
            alert("上传失败！");
            $("#imgWait").hide();
        }
    });        
}