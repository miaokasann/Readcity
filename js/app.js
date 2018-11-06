var jsonArr = 
[
	{id:1,title:"平凡的世界",description:"我是平凡的世界","img":"1.jpg"},
	{id:2,title:"平凡的世界",description:"我是平凡的世界","img":"1.jpg"},
	{id:3,title:"平凡的世界",description:"我是平凡的世界","img":"1.jpg"},
	{id:4,title:"平凡的世界",description:"我是平凡的世界","img":"1.jpg"},
	{id:5,title:"平凡的世界",description:"我是平凡的世界","img":"1.jpg"},
	{id:6,title:"平凡的世界",description:"我是平凡的世界","img":"1.jpg"}
];
$(function() {

	for(var i=0;i<jsonArr.length;i++){
		setAll(jsonArr[i].id,jsonArr[i].title,jsonArr[i].description);
	}
});

function setAll(id,title,description,img){
	var ele = "<li class='white-panel'>"+
				"<img src='images/id.jpg'  class='thumb'>"+
								"<h1><a href='#''>title</a></h1>"+
				"<p>description</p>"+
			"</li>"
	$('#gallery-wrapper').append(ele.replace('id',id).replace('title',title).replace('description',description));
}