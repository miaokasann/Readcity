var page;
var index;
var count;
$(function(){
  init();
  $.ajax({
    url:'json/user.php?act=fenpage',
    success: function(response,status,xhr){
      var json = JSON.parse(response);
      console.log(json);
      $('.page_up').text('');
      var len = json.length;
      for(var i=0;i<len;i++){
        setUser(json[i]);
      }
    }
  });
  catepage();
});

function init(){
  $('#edit').dialog({
    autoOpen:false,
    modal: true,
    resizable: true,
    height: 250,
    buttons:{
      '确定': function(e){
        var ad = $("input[type='radio']:checked").val();
        var id = $('.nowid').text();
        console.log(id);
        $.ajax({
          url:'json/user.php?act=changenow&ad='+ad+'&id='+id,
          success: function(response, status, xhr){
            
          }
        });
        $(this).dialog('close');
        window.location.reload();
      },
      '取消': function(){
        $(this).dialog('close');
      }
    },
    position:'center',
    width:'350px'
  });
}

function setUser(object){
  if(object.admin==1){
    object.adminzi='是';
  }
  else{
    object.adminzi='否';
  }
  $('.odd').append(
    `<tr>
        <td class="id">`+object.ID+`</td>
        <td class="username">`+object.username+`</td>
        <td class="sex">`+object.sex+`</td>
        <td class="birth">`+object.birth+`</td>
        <td class="admin">`+object.adminzi+`</td>
        <td>
        <a href="#" onclick="edit(`+object.admin+`,`+object.ID+`)">编辑权限</a>
        <a href="#" onclick="del(`+object.ID+`);">删除</a>
        </td>
      </tr>`
  );
}

function edit(ad,id){
  if(ad==1){
    $('.now').text("管理员");
  }
  else{
    $('.now').text("普通用户");
  }
  $('.nowid').text(id);
  $('#edit').dialog('open');
}

function del(id){
  $.ajax({
    url:'json/user.php?act=deluser&id='+id,
    success: function(response,status,xhr){
      window.location.reload();
    }
  });
}

function catepage(){
  $.ajax({
    url:'json/user.php?act=catepage',
    success: function(response,status,xhr){
      var json = JSON.parse(response);
      count = json.pagecount;
      for(var i=1;i<=count;i++){
        $('.foot ul').append(
          `<li id="`+i+`">
            <a href="javascript:;" onclick="viewpage(`+i+`)">`+i+`</a>
          </li>`
        );
      }
      $("#1").attr("class","active");
    }
  });
}

function prev(data){
  index = $("ul .active").index();
  page = index + 1;
  var down = data;
  page = page+down;
  //console.log(page);
  viewpage(page);
}
function next(data){
  index = $("ul .active").index();
  page = index + 1;
  
  var down = data;
  page = page+down;
  //console.log(page);
  viewpage(page);
}

function viewpage(page){
  if(page == 1){
    $('.page_up').text('');
    $('.page_down').text('下一页');
  }else{
    $('.page_up').text('上一页');
  }
  $("#"+page).attr("class","active");
  $("#"+page).siblings('li').removeClass('active');  
  index = $("ul .active").index();
  var p = index + 1;
  console.log(count);
  if(p>=count){
    $('.page_down').text('');
  }
  else{
    $('.page_down').text('下一页');
  }
  $.ajax({
    url:'json/user.php?act=fenpage&page='+page,
    success: function(response,status,xhr){
      // if(response.msg == no){

      // }
      var json = JSON.parse(response);
      console.log(json);
      $('.odd').html('');
      var len = json.length;
      for(var i=0;i<len;i++){
        setUser(json[i]);
      }
    }
  });
}