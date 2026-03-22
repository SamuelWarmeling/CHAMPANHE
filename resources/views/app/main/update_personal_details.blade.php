<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Atualizar Dados Pessoais – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{background:#F8F6F2;color:#1C1C1C;margin:0;padding:0 0 80px}
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}
    .emi-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:14px 16px;color:#fff}
    .emi-back{display:flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:15px;font-weight:600}
    .page-wrap{padding:16px;}

    .settings-card{
      background:#fff;border:1px solid #E8DCC8;border-radius:12px;
      box-shadow:0 2px 8px rgba(200,169,106,.15);padding:20px;
    }

    .avatar-block{
      display:flex;align-items:center;gap:14px;margin-bottom:24px;
      padding-bottom:20px;border-bottom:1px solid #F5EDD8;
    }
    .avatar-block img{
      width:64px;height:64px;border-radius:50%;
      border:2.5px solid #C8A96A;
      box-shadow:0 2px 10px rgba(200,169,106,0.25);
      object-fit:cover;cursor:pointer;
    }
    .avatar-hint h3{
      font-family:'Inter',sans-serif;
      font-size:14px;font-weight:600;color:#1C1C1C;margin:0 0 4px;
    }
    .avatar-hint p{font-size:12px;color:#6B6B6B;margin:0;line-height:1.5;}

    .field-label{font-size:13px;font-weight:500;color:#6B6B6B;margin-bottom:6px;display:block;}
    .field-group{margin-bottom:16px;}
    .field-wrap{
      display:flex;align-items:center;
      background:#F8F6F2;border:1px solid #E8DCC8;
      border-radius:10px;height:48px;overflow:hidden;
      transition:border-color 0.2s;
    }
    .field-wrap:focus-within{border-color:#C8A96A;}
    .field-wrap .layui-input{
      flex:1;border:none !important;background:transparent !important;
      padding:0 14px !important;font-size:15px !important;color:#1C1C1C !important;
      outline:none;height:48px !important;line-height:48px !important;
      font-family:'Inter',sans-serif !important;font-weight:400 !important;
    }
    .field-wrap .layui-input::placeholder{color:#BBBBBB !important;}

    .btn-save{
      display:block;width:100%;padding:14px;
      background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);
      color:#fff;font-size:16px;font-weight:700;
      border:none;border-radius:10px;cursor:pointer;
      letter-spacing:0.5px;transition:opacity 0.2s;margin-top:8px;
    }
    .btn-save:active{opacity:0.88;}

    .layui-upload-file{
      position:absolute;opacity:0;width:64px;height:64px;cursor:pointer;
    }
  </style>
</head>
<body>
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      Atualizar Dados Pessoais
    </a>
  </div>

  <div class="page-wrap">
    <div class="settings-card">
      <form class="layui-form" lay-filter="saveBankCardInfoForm">
        <input name="avatar" id="avatar" type="hidden" value="/public/uploads/user/avatar.png">

        <div class="avatar-block">
          <div style="position:relative;">
            <img src="/images/logo-emi.png" style="width:64px;height:64px;" class="layui-circle" id="upload_avatar" alt="Avatar">
            <input class="layui-upload-file" type="file" accept="image/*" name="file">
          </div>
          <div class="avatar-hint">
            <h3>Clique para alterar a foto</h3>
            <p>Recomendamos imagens 1:1<br>maiores que 100px</p>
          </div>
        </div>

        <div class="field-group">
          <label class="field-label">Apelido</label>
          <div class="field-wrap">
            <input type="text" name="nickname" value="{{ auth()->user()->nickname ?? '' }}"
                   lay-verify="required" placeholder="Seu apelido"
                   lay-reqtext="nickname" autocomplete="off" class="layui-input">
          </div>
        </div>

        <div class="field-group">
          <label class="field-label">E-mail</label>
          <div class="field-wrap">
            <input type="text" name="email" value="{{ auth()->user()->email ?? '' }}"
                   lay-verify="required" placeholder="E-mail"
                   lay-reqtext="email" autocomplete="off" class="layui-input">
          </div>
        </div>

        <button class="btn-save layui-btn layui-btn-fluid" lay-submit lay-filter="saveInfo">
          Salvar
        </button>
      </form>
    </div>
  </div>

  <script src="/v2/layui/layui.js"></script>
  <script>
    layui.use(function(){
      var $ = layui.jquery;
      var layer = layui.layer;
      var form = layui.form;
      var upload = layui.upload;

      var uploadInst = upload.render({
        elem: '#upload_avatar',
        url: '/uploadPicture',
        acceptMime: 'image/*',
        accept: 'jpg|png|gif|jpeg',
        data: {'directory': 'avatar'},
        done: function(res){
          layer.msg(res.msg);
          if(res.status == 1){
            $('#avatar').val(res.result.path);
            $('#upload_avatar').attr('src', res.result.show_path);
          }
        },
        error: function(){}
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
