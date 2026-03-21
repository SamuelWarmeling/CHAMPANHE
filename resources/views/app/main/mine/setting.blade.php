<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Configurações – EMI</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .layui-panel-window {
            background: #FFFFFF !important;
            border-top: none
        }

        .layui-form-item {
            background: none;
            border-radius: 8px;
            background: #F6F6F6;
            height: 44px;
            line-height: 44px;
        }

        .layui-input {
            background: none;
            font-weight: 700;
            font-size: 18px;
            color: #1C1C1C;
            border: none;
            height: 44px;
            line-height: 44px;
        }
        .layui-input::placeholder {
            font-weight: 400;
            font-size: 16px;
            color: #B3B3B3;
        }

        .login_btn {
            background: linear-gradient( 135deg, #C8A96A 0%, #D6A86B 100%);
            box-shadow: 0px 4px 10px 0px rgba(200,169,106,0.25);
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 18px;
            color: #FFFFFF;
            height: 44px;
            line-height: 44px;

        }
        .password_item{
            display: block;
            padding: 10px;
            border-bottom: 1px solid #EDEDED;
            font-family: Arial, sans-serif;
            font-weight: 400;
            font-size: 14px;
            color: #1C1C1C;
            line-height: 20px;
        }
    </style> 
 </head> 
 <body class="common_body"> 
  <div class="common_header">
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Configurações </a> 
  </div> 
  <div style="margin: 30px 15px;"> 
   <div style="background: #FFFFFF;padding: 15px;border-radius: 8px;"> 
    <div class="layui-panel-window layui-font-16" style="border-radius: 8px;"> 
     <form class="layui-form" lay-filter="saveBankCardInfoForm"> 
      <input name="avatar" id="avatar" type="hidden" value="/public/uploads/user/avatar.png"> 
      <div class="demo-login-container"> 
       <div class="user-header" style="margin-top: 10px;display: flex;justify-content: flex-start"> 
        <div> 
         <img src="{{setting('logo')}}" style="width: 60px;height: 60px" class="layui-circle" id="upload_avatar">
         <input class="layui-upload-file" type="file" accept="image/*" name="file"> 
        </div> 
        <div style="padding-left: 10px;color: #818393"> 
         <h1 class="layui-font-16" style="color: #1C1C1C;margin-bottom: 10px;">Clique para alterar a foto</h1>
         <p>Recomendamos imagens 1:1 maiores que 100px</p> 
        </div> 
        <div style="clear: both"></div> 
       </div> 
       <div style="margin-top: 20px;margin-bottom: 7px;color: #474747;font-size: 18px;">
        Apelido
       </div> 
       <div class="layui-form-item"> 
        <input type="text" name="nickname" value="{{ auth()->user()->nickname ?? '' }}" lay-verify="required" placeholder="Seu apelido" autocomplete="off" class="layui-input"> 
       </div> 
       <!--<div style="margin-top: 20px;margin-bottom: 7px;color: #474747;font-size: 18px;">E-mail</div>--> 
       <!--<div class="layui-form-item">--> 
       <!--    <input type="text" name="email"  value="" lay-verify="required" placeholder="Email" autocomplete="off" class="layui-input">--> 
       <!--</div>--> 
       <div class="layui-form-item" style="border: none;       margin-top: 30px;"> 
        <button class="layui-btn  layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit="" lay-filter="saveInfo"> Salvar </button> 
       </div> 
      </div> 
     </form> 
    </div> 
   </div> 
  </div> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var upload = layui.upload;
        var element = layui.element;
        var uploadInst = upload.render({
            elem: '#upload_avatar'
            ,url: '/api/user/uploadAvatar'
            ,acceptMime: 'image/*'
            ,accept: 'jpg|png|gif|jpeg'
            ,data: {'directory': 'avatar'}
            ,done: function(res){
                layer.msg(res.msg);
                if(res.status == 1){
                    $('#avatar').val(res.result.path);
                    $('#upload_avatar').attr('src', res.result.show_path);
                }
            }
            ,error: function(){}
        });
        form.on('submit(saveInfo)', function(data){
            var data = data.field;
            $.post('/info', data, function(res){
                layer.msg(res.msg);
                if(res.status == 1){
                    window.location.href = '/my';
                }
            });
            return false;
        });

    });
</script> 
 </body>
</html>