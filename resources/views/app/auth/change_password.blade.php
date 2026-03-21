<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Alterar Senha – EMI</title>
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
    .emi-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:20px;margin:16px}

    .field-label{font-size:13px;font-weight:500;color:#6B6B6B;margin-bottom:6px;display:block;}
    .field-wrap{
      display:flex;align-items:center;
      background:#F8F6F2;border:1px solid #E8DCC8;
      border-radius:10px;margin-bottom:16px;height:48px;overflow:hidden;
      transition:border-color 0.2s;position:relative;
    }
    .field-wrap:focus-within{border-color:#C8A96A;}
    .field-wrap input{
      flex:1;border:none;background:transparent;
      padding:0 44px 0 14px;font-size:15px;color:#1C1C1C;outline:none;height:48px;
    }
    .field-wrap input::placeholder{color:#BBBBBB;}
    .pw-toggle{
      position:absolute;right:12px;top:50%;transform:translateY(-50%);
      background:none;border:none;cursor:pointer;padding:0;color:#6B6B6B;
      display:flex;align-items:center;
    }
    .pw-toggle svg{width:20px;height:20px;}

    .btn-submit{
      display:block;width:100%;padding:14px;
      background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);
      color:#fff;font-size:16px;font-weight:700;
      border:none;border-radius:10px;cursor:pointer;
      letter-spacing:0.5px;transition:opacity 0.2s;margin-top:8px;
    }
    .btn-submit:active{opacity:0.88;}

    /* layui overrides */
    .layui-input-wrap .layui-input,
    .layui-input-affix{
      font-family:'Inter',sans-serif !important;
      font-size:15px !important;
      color:#1C1C1C !important;
      height:48px !important;
      line-height:48px !important;
      background:transparent !important;
      border:none !important;
    }
  </style>
</head>
<body>
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      Alterar Senha
    </a>
  </div>

  <div class="emi-card">
    <form class="layui-form">
      <label class="field-label">Senha Atual</label>
      <div class="field-wrap">
        <input type="password" name="password" id="oldPw" lay-verify="required"
               placeholder="Digite a senha atual" autocomplete="off" class="layui-input">
        <button type="button" class="pw-toggle" onclick="toggleField('oldPw','eyeOld')" aria-label="Mostrar">
          <svg id="eyeOld" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
          </svg>
        </button>
      </div>

      <label class="field-label">Nova Senha</label>
      <div class="field-wrap">
        <input type="password" name="new_password" id="newPw" lay-verify="required"
               placeholder="Digite a nova senha" autocomplete="off" class="layui-input">
        <button type="button" class="pw-toggle" onclick="toggleField('newPw','eyeNew')" aria-label="Mostrar">
          <svg id="eyeNew" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
          </svg>
        </button>
      </div>

      <label class="field-label">Confirmar Nova Senha</label>
      <div class="field-wrap">
        <input type="password" name="confirm_password" id="confPw" lay-verify="required"
               placeholder="Confirme a nova senha" autocomplete="off" class="layui-input">
        <button type="button" class="pw-toggle" onclick="toggleField('confPw','eyeConf')" aria-label="Mostrar">
          <svg id="eyeConf" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
          </svg>
        </button>
      </div>

      <button class="btn-submit layui-btn layui-btn-fluid" lay-submit lay-filter="password">
        Salvar Alterações
      </button>
    </form>
  </div>

  <script src="/v2/layui/layui.js"></script>
  <script>
    function toggleField(fieldId, iconId) {
      var f = document.getElementById(fieldId);
      var icon = document.getElementById(iconId);
      if (f.type === 'password') {
        f.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
      } else {
        f.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
      }
    }

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
