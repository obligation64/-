function check (str) {
    $.ajax(
        {
            dataType:'json',
            type: 'post',
            url: "/index/index/checkNum",
            async : true,
            data:{'s':str},
            success : function(result){
                $("#num").html(result);
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status + "," + textStatus);
            }
        });
}
function checkpwd(str) {
    $.ajax(
        {
            dataType:'json',
            type: 'post',
            url: "/index/index/checkPwd",
            async : true,
            data:{'pwd':str},
            success : function(result){
                // alert(result);
                $("#pwd").html(result);
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status + "," + textStatus);
            }
        });
}
$('.pwd').blur(function () {
    if($("#password").val()!=$("#repassword").val()){
        $('#repwd').html('密码不一致');
    }else{
        $('#repwd').html('');
    }
});
function repwd(str) {
    if($("#password").val()!=$("#repassword").val()){
        $('#repwd').html('密码不一致');
    }else{
        $('#repwd').html('');
    }

}