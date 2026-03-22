<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Entrar – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{
      margin:0;
      background:#F8F6F2;
      background-image:radial-gradient(circle at 20% 20%, rgba(200,169,106,0.08) 0%, transparent 50%),
                       radial-gradient(circle at 80% 80%, rgba(200,169,106,0.06) 0%, transparent 50%);
      color:#1C1C1C;
      min-height:100vh;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      padding:24px 16px;
    }
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}

    .auth-wrap{width:100%;max-width:380px}

    .auth-logo{text-align:center;margin-bottom:32px}
    .auth-logo img{
      width:88px;height:88px;border-radius:50%;
      border:3px solid #C8A96A;
      box-shadow:0 4px 16px rgba(200,169,106,0.3);
      object-fit:cover;
    }
    .auth-logo h2{
      font-family:'Playfair Display',serif;
      margin:14px 0 0;font-size:22px;font-weight:700;color:#1C1C1C;
    }
    .auth-logo p{
      font-family:'Playfair Display',serif;
      font-style:italic;margin:4px 0 0;font-size:14px;color:#C8A96A;font-weight:400;
    }

    .auth-card{
      background:#fff;
      border:1px solid #E8DCC8;
      border-radius:16px;
      padding:28px 24px;
      box-shadow:0 4px 20px rgba(200,169,106,0.15);
    }
    .auth-card-title{
      font-family:'Playfair Display',serif;
      font-size:22px;font-weight:600;color:#1C1C1C;
      margin:0 0 24px;text-align:center;
    }

    .form-tab{
      display:flex;margin-bottom:24px;
      border-bottom:2px solid #E8DCC8;
    }
    .form-tab .tab-item{
      flex:1;text-align:center;padding:10px 0;font-size:15px;font-weight:600;
      color:#6B6B6B;text-decoration:none;
      border-bottom:3px solid transparent;margin-bottom:-2px;transition:all 0.2s;
    }
    .form-tab .tab-item.active{color:#C8A96A;border-bottom-color:#C8A96A;}

    .field-label{font-size:13px;font-weight:500;color:#6B6B6B;margin-bottom:6px;display:block;}
    .field-wrap{
      display:flex;align-items:center;
      background:#F8F6F2;border:1px solid #E8DCC8;
      border-radius:10px;margin-bottom:16px;overflow:hidden;height:48px;
      transition:border-color 0.2s;
    }
    .field-wrap:focus-within{border-color:#C8A96A;}
    .field-prefix{
      padding:0 12px;font-size:14px;color:#6B6B6B;
      border-right:1px solid #E8DCC8;line-height:48px;white-space:nowrap;
    }
    .field-wrap input{
      flex:1;border:none;background:transparent;
      padding:0 14px;font-size:15px;color:#1C1C1C;outline:none;height:48px;
    }
    .field-wrap input::placeholder{color:#BBBBBB;}
    .pw-wrap{position:relative;display:flex;align-items:center;}
    .pw-wrap input{padding-right:44px !important;}
    .pw-toggle{
      position:absolute;right:12px;top:50%;transform:translateY(-50%);
      background:none;border:none;cursor:pointer;padding:0;color:#6B6B6B;
      display:flex;align-items:center;
    }
    .pw-toggle svg{width:20px;height:20px;}

    .remember-row{
      display:flex;align-items:center;gap:8px;margin-bottom:20px;
      font-size:13px;color:#6B6B6B;
    }
    .remember-row input[type=checkbox]{
      accent-color:#C8A96A;width:16px;height:16px;cursor:pointer;
    }

    .btn-submit{
      display:block;width:100%;padding:14px;
      background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);
      color:#fff;font-size:16px;font-weight:700;
      border:none;border-radius:10px;cursor:pointer;
      letter-spacing:0.5px;transition:opacity 0.2s;
    }
    .btn-submit:active{opacity:0.88;}

    .auth-link{text-align:center;margin-top:20px;font-size:14px;color:#6B6B6B;}
    .auth-link a{color:#C8A96A;font-weight:600;text-decoration:none;}
    .auth-link a:hover{text-decoration:underline;}
  </style>
</head>
<body>
  <div class="auth-wrap">
    <div class="auth-logo">
      <img src="/images/logo-emi.png" alt="EMI Logo">
      <h2>EMI</h2>
      <p>Enoteca Millesimi</p>
    </div>

    <div class="auth-card">
      <div class="form-tab">
        <span class="tab-item active">Entrar</span>
        <a href="{{ url('register') }}" class="tab-item">Cadastrar</a>
      </div>

      <h2 class="auth-card-title">Bem-vindo de volta</h2>

      <form action="{{ url('login') }}" method="post" id="loginForm">
        @csrf

        <label class="field-label">Número de Telefone</label>
        <div class="field-wrap">
          <span class="field-prefix">+27</span>
          <input type="text" name="phone" placeholder="Digite seu número" required autocomplete="off">
        </div>

        <label class="field-label">Senha</label>
        <div class="field-wrap" style="position:relative;">
          <div class="pw-wrap" style="flex:1;height:48px;">
            <input type="password" name="password" id="pwField" placeholder="Digite sua senha" required autocomplete="off" style="width:100%;padding-right:44px;">
            <button type="button" class="pw-toggle" onclick="togglePw()" aria-label="Mostrar/ocultar senha">
              <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="remember-row">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Lembrar senha</label>
        </div>

        <button type="submit" class="btn-submit" id="btnSubmit">Entrar</button>
      </form>

      <div class="auth-link">
        Não tem conta? <a href="{{ url('register') }}">Cadastre-se</a>
      </div>
    </div>
  </div>

  @include('alert-message')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.getElementById('loginForm').addEventListener('submit', function() {
      document.getElementById('btnSubmit').textContent = 'Aguarde...';
    });
    function togglePw() {
      var f = document.getElementById('pwField');
      var icon = document.getElementById('eyeIcon');
      if (f.type === 'password') {
        f.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
      } else {
        f.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
      }
    }
  </script>
</body>
</html>
