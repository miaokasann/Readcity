var jsonArr;
var theRequest;

GetRequest();
checkLike(theRequest.book);

$(function(){
	
	lookMsg(theRequest.book);
	$('#interest_sect_level .like').click(function(){
		var bookid = theRequest.book;
		$.ajax({
			url:'json/connect.php?act=like&bookid='+bookid,
			success: function(response, status, xhr){
				$('.like').text('💗喜欢');
			}
		});
	});
});

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
	
	function checkLike(id){
		var bookid = id;
		$.ajax({
			url:'json/connect.php?act=checklike&bookid='+id,
			success: function(response, status, xhr){
				var data = JSON.parse(response);
				if(data.or == "yes"){
					$('.like').text('💗喜欢');
				}
				else{
					$('.like').text('未喜欢');
				}
	
			}
		});
	}

function lookMsg(id){
	$.ajax({
		url:'json/sql.php?act=read&book='+id,
		success:function(data){
			jsonArr = JSON.parse(data);
			$('#wrapper .title').html(jsonArr[0].title);
			$('#mainpic .img').attr("src", 'images/'+jsonArr[0].pic);
			$('#info .author').html(jsonArr[0].author);
			$('#info .birth').html(jsonArr[0].birth);
			$('#info .price').html(jsonArr[0].price);
			$('#info .description').html(jsonArr[0].description);
		}
	});
}

function getCookie(name)
{
	var arr=document.cookie.split('; ');
	var i=0;
	for(i=0;i<arr.length;i++)
	{
		var arr2=arr[i].split('=');
		if(arr2[0]==name)
		{
			return arr2[1];
		}
	}
	//return '';
}

// function getCookie(cookieName){  
// 	var cookieValue="";  
// 	if (document.cookie && document.cookie != '') {   
// 			var cookies = document.cookie.split(';');  
// 			for (var i = 0; i < cookies.length; i++) {   
// 					 var cookie = cookies[i];  
// 					 if (cookie.substring(0, cookieName.length + 2).trim() == cookieName.trim() + "=") {  
// 								 cookieValue = cookie.substring(cookieName.length + 2, cookie.length);   
// 								 break;  
// 					 }  
// 			 }  
// 	}   
// 	return cookieValue;  
// }