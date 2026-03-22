<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Cadastro – EMI</title>
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

    .otp-row{display:flex;gap:10px;margin-bottom:16px;}
    .otp-row .field-wrap{flex:1;margin-bottom:0;}
    .otp-send-btn{
      height:48px;padding:0 16px;
      background:transparent;border:1.5px solid #C8A96A;
      border-radius:10px;color:#C8A96A;
      font-size:13px;font-weight:600;cursor:pointer;
      white-space:nowrap;flex-shrink:0;transition:all 0.2s;
    }
    .otp-send-btn:hover{background:#C8A96A;color:#fff;}
    .otp-send-btn:disabled{opacity:0.55;cursor:default;background:transparent;color:#C8A96A;}

    .btn-submit{
      display:block;width:100%;padding:14px;
      background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);
      color:#fff;font-size:16px;font-weight:700;
      border:none;border-radius:10px;cursor:pointer;
      letter-spacing:0.5px;transition:opacity 0.2s;
      margin-top:4px;
    }
    .btn-submit:active{opacity:0.88;}

    .auth-link{text-align:center;margin-top:20px;font-size:14px;color:#6B6B6B;}
    .auth-link a{color:#C8A96A;font-weight:600;text-decoration:none;}
    .auth-link a:hover{text-decoration:underline;}

    .loading-overlay{
      display:none;position:fixed;z-index:9999;
      background:rgba(0,0,0,0.5);
      top:0;left:0;width:100%;height:100%;
      justify-content:center;align-items:center;flex-direction:column;
    }
    .spinner{
      width:48px;height:48px;
      border:4px solid rgba(255,255,255,0.3);
      border-top:4px solid #C8A96A;
      border-radius:50%;animation:spin 0.8s linear infinite;
    }
    @keyframes spin{to{transform:rotate(360deg);}}
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
        <a href="{{ url('login') }}" class="tab-item">Entrar</a>
        <span class="tab-item active">Cadastrar</span>
      </div>

      <h2 class="auth-card-title">Criar Conta</h2>

      <form class="layui-form" method="POST" action="{{ url('register') }}" id="registerForm">
        @csrf

        <label class="field-label">Número de Telefone</label>
        <div class="field-wrap">
          <span class="field-prefix">+27</span>
          <input type="text" name="phone" id="regPhone" placeholder="Digite seu número" required autocomplete="off">
        </div>

        <label class="field-label">Código de Verificação (OTP)</label>
        <div class="otp-row">
          <div class="field-wrap">
            <input type="number" name="code" id="otpCode" placeholder="Código OTP" required autocomplete="off">
          </div>
          <button type="button" class="otp-send-btn" id="sendOtpBtn" onclick="sendOtp()">Enviar Código</button>
        </div>

        <label class="field-label">Senha</label>
        <div class="field-wrap">
          <input type="password" name="password" placeholder="Digite sua senha" required autocomplete="off">
        </div>

        <label class="field-label">Confirmar Senha</label>
        <div class="field-wrap">
          <input type="password" name="password_confirmation" placeholder="Confirme sua senha" required autocomplete="off">
        </div>

        <label class="field-label">Código de Convite</label>
        <div class="field-wrap">
          <input type="text" name="ref_by" id="refBy" value="{{ $ref_by ?? '' }}" placeholder="Digite o código de convite" required autocomplete="off">
        </div>

        <button type="submit" class="btn-submit" id="registerBtn">Cadastrar</button>
      </form>

      <div class="auth-link">
        Já tem conta? <a href="{{ url('login') }}">Entrar</a>
      </div>
    </div>
  </div>

  <div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
    <p style="color:#fff;margin-top:12px;font-size:14px;font-family:'Inter',sans-serif;">Processando...</p>
  </div>

  @include('alert-message')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Pre-fill referral code from URL query parameter
    (function(){
      var urlParams = new URLSearchParams(window.location.search);
      var shareCode = urlParams.get('shareCode') || urlParams.get('ref_by') || urlParams.get('invite');
      if (shareCode) {
        var el = document.getElementById('refBy');
        if (el && !el.value) el.value = shareCode;
      }
    })();

    function sendOtp() {
      var phone = document.getElementById('regPhone').value;
      if (!phone) {
        alert('Por favor, insira seu número de telefone');
        return;
      }
      document.getElementById('loadingOverlay').style.display = 'flex';
      setTimeout(function() {
        document.getElementById('loadingOverlay').style.display = 'none';
        var otp = Math.floor(100000 + Math.random() * 900000);
        document.getElementById('otpCode').value = otp;
        var timeLeft = 120;
        var btn = document.getElementById('sendOtpBtn');
        btn.disabled = true;
        btn.textContent = timeLeft + 's';
        var timer = setInterval(function() {
          timeLeft--;
          btn.textContent = timeLeft + 's';
          if (timeLeft <= 0) {
            clearInterval(timer);
            btn.disabled = false;
            btn.textContent = 'Enviar Código';
          }
        }, 1000);
      }, 1000);
    }

    document.getElementById('registerForm').addEventListener('submit', function() {
      document.getElementById('loadingOverlay').style.display = 'flex';
    });
  </script>
</body>
</html>
