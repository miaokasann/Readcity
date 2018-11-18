var jsonArr;
$(function() {
	$.ajax({
		type : 'POST',
		url : 'json/data.php',
		dataType : 'json',
		success : function (response, status, xhr) {
			var len = response.length;
			jsonArr = response;
			for(var i=0;i<jsonArr.length;i++)
			{
				setAll(jsonArr[i].id,jsonArr[i].title,jsonArr[i].description,jsonArr[i].pic,jsonArr[i].price,jsonArr[i].author,jsonArr[i].birth);
			}
		/*上传panel的显示*/
		$('#upload_panel').dialog({
			autoOpen:false,
			modal: true,
			resizable: true,
			height: 500,
			position:{my:"left center",at:"left center",of:"#gallery-wrapper"},
			buttons:{
				'保存': function(e){
					alert(1);
					//alert('数据提交中');
					/*点击保存按钮之后，获取文本框中的信息*/
					var id =len+1;
					var jsonObj = {id:id,type:"",title:"",price:"",author:"",birth:"",description:"",pic:""};
					var dropDown = $('#dropDown').val();
					var title = $('#title').val();
					var price = $('#price').val();
					var author = $('#author').val();
					var birth = $('#birth').val();
					var description = $('#description').val();
					var btn_file = $('#btn_file').val();
					jsonObj.type = dropDown;
					jsonObj.title = title;
					jsonObj.price = price;
					jsonObj.author = author;
					jsonObj.birth = birth;
					jsonObj.description = description;
					jsonObj.pic = btn_file;
					jsonArr.push(jsonObj);
					//console.log(jsonObj);
					//console.log($.param(jsonArr));
					//alert(jsonObj);
					//console.log(jsonArr);
					//var arr = $.param(jsonObj);
					var arr = JSON.stringify(jsonArr);
					save(arr);

					e.target.value = '';
					//console.log(jsonObj);
					setAll(id,title,description);

					$(this).dialog('close');
				},
				'取消': function(){
					$(this).dialog('close');
				}
			},
			position:'center',
			width:'750px'
		});

		$('#upload').click(function(){
			$('#upload_panel').dialog('open');
		});


		$('#pic_upload').buttonset();
		$('#btn_file_ok').buttonset();
		$('#birth').datepicker();
		
	/*鼠标滑过显示详细信息*/
 	var oLi = document.getElementById('gallery-wrapper').getElementsByTagName('li');
 	var oMeta = document.getElementsByClassName('more-meta');
 	console.log(oMeta.length);
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
	});
	
});

/*信息显示*/
function setAll(id,title,description,pic,price,author,birth){
	var ele = `<li class="white-panel" id="theid_myid">
				<a href="#"><img src="images/pic" class="thumb"></a>
			</li>
			<div class="info" id="theids_myid">
				<h4><a href="#">title</a></h4>
				<p>price</p>
				<button onclick="del(myid);">删除</button>
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
			`
	$('#gallery-wrapper').append(ele.replace(/myid/g,id).replace('pic',pic).replace(/title/g,title).replace('price',price).replace('author',author).replace('birth',birth).replace('description',description));
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
			jsonArr.splice(j,1);
		}
	}
	save(JSON.stringify(jsonArr));
}


function show(){
	$("#btn_file").css('display','block');
	$("#btn_file_ok").css('display','block');
}

/*上传图片的方法*/
function change(){
	//alert(1);
	console.log($('#btn_file'));
	var objUrl = getObjectURL($('#btn_file')[0].files[0]);
    console.log("objUrl = "+objUrl) ;
    if (objUrl) 
    {
      $("#img_look").attr("src", objUrl);
      //$("#img_look").removeClass("hide");
    }
}
echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . strtotime('now');
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


function save(arr){
	$.ajax({
		type:'POST',
		url:'json/a.php',
		data:{"arr":arr},
		success:function (response, status, xhr){
			alert("你保存成功了");
		},
		error:function(response, status, xhr){
			alert("出错了");
		}
	});
}

function savePic(){
	$.ajax({
		type:'POST',
		url:'json/a.php',
		data:{"arr":arr},
		success:function (response, status, xhr){
			//console.log(response);
			save();
		}
	});
}
