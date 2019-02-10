$(function(){
  $('#submit').click(function(){
    var username = $('#email').val();
    var password = $('#password').val();

    $.ajax({
        type:'POST',
        url:'json/user.php?act=login',
        contentType:'application/x-www-form-urlencoded;charset=utf-8',
        data:{username:username,password:password},
        success:function(data){
            alert(1);
            console.log(data);
            window.location.href="dushu.html"
        },
        error:function(e){
            console.log(e);
            alert(2);
        }
    });
});
});

var page = 1;
var rows = 10;

var sqlpage = (page-1)*rows;

SELECT * from `user` LIMIT 0,10;
SELECT * from `user` LIMIT 10,10;
SELECT * from `user` LIMIT 20,10;