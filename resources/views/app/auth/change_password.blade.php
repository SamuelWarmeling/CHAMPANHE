<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Alterar Senha – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .login_btn {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 18px;
      color: #1C1C1C;
    }
    .layui-form-item {
      border-radius: 8px;
      border: 1px solid #EDE8DF;
      margin-bottom: 20px;
      height: 50px;
      background: #F8F6F2;
    }
    .layui-form-label {
      width: 80px;
      padding-top: 14px;
      border: none;
      background: none;
      border-right: 1px solid #EDE8DF;
      height: 30px;
      font-weight: 400;
      font-size: 16px;
      color: #1C1C1C;
    }
    .layui-input-block {
      margin-left: 80px;
      height: 50px;
      line-height: 50px;
    }
    .layui-input-wrap .layui-input, .layui-input-affix {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 16px;
      color: #1C1C1C !important;
      height: 50px !important;
      line-height: 50px !important;
    }
    .field_label {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 16px;
      color: #555;
      line-height: 18px;
      margin-bottom: 5px;
    }
  </style>
 </head>
 <body class="common_body">
  <div class="common_header">
   <a href="javascript:history.back(-1)" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Alterar Senha
   </a>
  </div>
  <div class="common_header_order"></div>
  <div class="common_card" style="margin: 15px;">
   <div class="common_card_content">
    <form class="layui-form">
     <div class="demo-login-container">
      <div class="field_label">Senha Atual</div>
      <div class="layui-form-item">
       <div class="layui-input-wrap">
        <input type="password" name="password" value="" lay-verify="required" placeholder="Digite a senha atual" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
        <div class="layui-input-affix layui-input-suffix">
         <i class="layui-icon layui-icon-eye-invisible"></i>
        </div>
       </div>
      </div>
      <div class="field_label">Nova Senha</div>
      <div class="layui-form-item">
       <div class="layui-input-wrap">
        <input type="password" name="new_password" value="" lay-verify="required" placeholder="Digite a nova senha" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
        <div class="layui-input-affix layui-input-suffix">
         <i class="layui-icon layui-icon-eye-invisible"></i>
        </div>
       </div>
      </div>
      <div class="layui-form-item" style="border: none; background: none">
       <button class="layui-btn layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit="" lay-filter="password">Atualizar Senha</button>
      </div>
     </div>
    </form>
   </div>
  </div>
  <script src="/v2/layui/layui.js"></script>
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        form.on('submit(password)', function(data){
            var data = data.field;
            $.post('/password', data, function(res){
                if(res.status == 1){
                    layer.msg(res.msg, {end: function(){
                        window.location.href = '/login';
                    }});
                } else {
                    layer.msg(res.msg);
                }
            });
            return false;
        });
    });
  </script>
 </body>
</html>
