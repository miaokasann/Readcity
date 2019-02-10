var jsonArr;
var theRequest;

GetRequest();
searchLike(theRequest.user);

function GetRequest() {
	var url = location.search; //获取url中"?"符后的字串
	theRequest = new Object();
	 if (url.indexOf("?") != -1) {
	       var str = url.substr(1);
	       strs = str.split("&");
	       for (var i = 0; i < strs.length; i++) {
	           theRequest[strs[i].split("=")[0]] = decodeURIComponent(strs[i].split("=")[1]);
	       }
	   }
		console.log(theRequest.book);
	   return theRequest;
		
	}

function searchLike(data){
	
  $('#gallery-wrapper').html('');
  $.ajax({
		url : 'json/sql.php?act=read&otype=1&userid='+data,
		contentType:'application/x-www-form-urlencoded;charset=utf-8',
    success : function (response, status, xhr) {
      //window.location.reload();
      $('#gallery-wrapper').html('');
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