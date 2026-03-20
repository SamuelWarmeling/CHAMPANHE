<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Update Password</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
  <style>
        .login_btn{
            background: #1A53CF;
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 18px;
            color: #FFFFFF;
        }
        .layui-form-item{
            border-radius: 8px;
            border: 1px solid #CFD0D9;
            margin-bottom: 20px;
            height: 50px;background: #FFFFFf;

        }
        .layui-form-label{
            width: 80px;
            padding-top: 14px;
            border: none;
            background: none;
            border-right: 1px solid #CFD0D9;
            height: 30px;
            font-weight: 400;
            font-size: 18px;
            color: #2A415C;

        }
        .layui-input-block{
            margin-left: 80px;
            height: 50px;
            line-height: 50px;
        }
        .layui-input-wrap{
            border-radius:8px;
        }
        .layui-input-wrap .layui-input,.layui-input-affix {
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 16px;
            color: #2A415C !important;
        }
        .layui-input-wrap .layui-input,.layui-input-affix {
            height: 50px !important;
            line-height: 50px !important;
        }
        .label{
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 16px;
            color: #818393;
            line-height: 18px;
            margin-bottom: 5px;
        }
    </style> 
 </head> 
 <body class="common_body"> 
  <div class="common_header" style=" background: #2857AF;"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Update Password </a> 
  </div> 
  <div class="common_header_order"></div> 
  <div class="common_card" style="margin: 15px;"> 
   <div class="common_card_content"> 
    <form class="layui-form"> 
     <div class="demo-login-container"> 
      <div class="label">
       Old Password
      </div> 
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <input type="password" name="password" value="" lay-verify="required" placeholder="Please enter password" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
        <div class="layui-input-affix layui-input-suffix">
         <i class="layui-icon layui-icon-eye-invisible"></i>
        </div> 
       </div> 
      </div> 
      <div class="label">
       New Password
      </div> 
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <input type="password" name="new_password" value="" lay-verify="required" placeholder="Please enter new password" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
        <div class="layui-input-affix layui-input-suffix">
         <i class="layui-icon layui-icon-eye-invisible"></i>
        </div> 
       </div> 
      </div> 
      <div class="layui-form-item" style="border: none;background: none"> 
       <button class="layui-btn layui-btn-danger layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit="" lay-filter="password">Update Password</button> 
      </div> 
     </div> 
    </form> 
   </div> 
  </div> 
  <!--	底部内容-开始	  --> 
  <a href="/help" target="_blank" id="service"> <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px"> </a> 
  <!--	底部内容-结束	  --> 
  <!-- body 末尾处引入 layui --> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;


        // 提交事件
        form.on('submit(password)', function(data){
            var data = data.field; // 获取表单字段值
            $.post('/password',data,function (res) {
                console.log(res)

                if(res.status==1){
                    layer.msg(res.msg,{end:function () {
                            window.location.href='/login'
                        }});

                }else{
                    layer.msg(res.msg);
                }
            })
            return false; // 阻止默认 form 跳转
        });
    });
</script> 
 </body>
</html>