<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Cadastro – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      background: #F8F6F2;
      font-family: Arial, sans-serif;
      color: #1C1C1C;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .login_wrap {
      width: 100%;
      max-width: 420px;
    }
    .login_logo {
      text-align: center;
      margin-bottom: 30px;
    }
    .login_logo img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid #C8A96A;
    }
    .login_logo h2 {
      margin: 12px 0 0;
      font-size: 22px;
      font-weight: 700;
      color: #1C1C1C;
    }
    .login_logo p {
      margin: 4px 0 0;
      font-size: 13px;
      color: #888;
    }
    .login_card {
      background: #fff;
      border-radius: 16px;
      padding: 28px 24px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .form_tab {
      display: flex;
      margin-bottom: 24px;
      border-bottom: 2px solid #EDE8DF;
    }
    .form_tab .tab_item {
      flex: 1;
      text-align: center;
      padding: 10px 0;
      font-size: 16px;
      font-weight: 600;
      color: #888;
      text-decoration: none;
      border-bottom: 3px solid transparent;
      margin-bottom: -2px;
      transition: all 0.2s;
    }
    .form_tab .tab_item.active {
      color: #C8A96A;
      border-bottom-color: #C8A96A;
    }
    .field_label {
      font-size: 13px;
      font-weight: 600;
      color: #555;
      margin-bottom: 6px;
    }
    .field_wrap {
      display: flex;
      align-items: center;
      background: #F8F6F2;
      border: 1px solid #EDE8DF;
      border-radius: 10px;
      margin-bottom: 16px;
      overflow: hidden;
      height: 48px;
    }
    .field_prefix {
      padding: 0 12px;
      font-size: 14px;
      color: #888;
      border-right: 1px solid #EDE8DF;
      line-height: 48px;
      white-space: nowrap;
    }
    .field_wrap input {
      flex: 1;
      border: none;
      background: transparent;
      padding: 0 14px;
      font-size: 15px;
      color: #1C1C1C;
      outline: none;
      height: 48px;
    }
    .field_wrap input::placeholder {
      color: #BBBBBB;
    }
    .otp_row {
      display: flex;
      gap: 10px;
      margin-bottom: 16px;
    }
    .otp_row .field_wrap {
      flex: 1;
      margin-bottom: 0;
    }
    .otp_send_btn {
      height: 48px;
      padding: 0 16px;
      background: #EDE8DF;
      border: 1px solid #C8A96A;
      border-radius: 10px;
      color: #C8A96A;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      white-space: nowrap;
      flex-shrink: 0;
    }
    .otp_send_btn:disabled {
      opacity: 0.6;
      cursor: default;
    }
    .btn_submit {
      display: block;
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #1C1C1C;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 8px;
      letter-spacing: 0.5px;
    }
    .btn_submit:active {
      opacity: 0.88;
    }
    .loading_overlay {
      display: none;
      position: fixed;
      z-index: 9999;
      background: rgba(0,0,0,0.5);
      top: 0; left: 0;
      width: 100%; height: 100%;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
    .spinner {
      width: 48px; height: 48px;
      border: 4px solid rgba(255,255,255,0.3);
      border-top: 4px solid #C8A96A;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
  </style>
</head>
<body>
  <div class="login_wrap">
    <div class="login_logo">
      <img src="{{setting('logo')}}" alt="EMI Logo">
      <h2>EMI – Enoteca Millesimi</h2>
      <p>Plataforma de Investimento em Vinhos Premium</p>
    </div>

    <div class="login_card">
      <div class="form_tab">
        <a href="{{ url('login') }}" class="tab_item">Entrar</a>
        <span class="tab_item active">Cadastrar</span>
      </div>

      <form class="layui-form" method="POST" action="{{ url('register') }}" id="registerForm">
        @csrf

        <div class="field_label">Número de Telefone</div>
        <div class="field_wrap">
          <span class="field_prefix">+27</span>
          <input type="text" name="phone" id="regPhone" placeholder="Digite seu número" required autocomplete="off">
        </div>

        <div class="field_label">Senha</div>
        <div class="field_wrap">
          <input type="password" name="password" placeholder="Digite sua senha" required autocomplete="off">
        </div>

        <div class="field_label">Código de Convite</div>
        <div class="field_wrap">
          <input type="text" name="ref_by" value="{{ $ref_by ?? '' }}" placeholder="Digite o código de convite" required autocomplete="off">
        </div>

        <div class="field_label">Código de Verificação (OTP)</div>
        <div class="otp_row">
          <div class="field_wrap">
            <input type="number" name="code" id="otpCode" placeholder="Código OTP" required autocomplete="off">
          </div>
          <button type="button" class="otp_send_btn" id="sendOtpBtn" onclick="sendOtp()">Enviar</button>
        </div>

        <button type="submit" class="btn_submit" id="registerBtn">Cadastrar Agora</button>
      </form>
    </div>
  </div>

  <div class="loading_overlay" id="loadingOverlay">
    <div class="spinner"></div>
    <p style="color:#fff;margin-top:12px;font-size:14px;">Processando...</p>
  </div>

  @include('alert-message')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function sendOtp() {
      const phone = document.getElementById('regPhone').value;
      if (!phone) {
        alert('Por favor, insira seu número de telefone');
        return;
      }
      document.getElementById('loadingOverlay').style.display = 'flex';
      setTimeout(() => {
        document.getElementById('loadingOverlay').style.display = 'none';
        const otp = Math.floor(100000 + Math.random() * 900000);
        document.getElementById('otpCode').value = otp;
        let timeLeft = 120;
        const btn = document.getElementById('sendOtpBtn');
        btn.disabled = true;
        btn.textContent = timeLeft + 's';
        const timer = setInterval(() => {
          timeLeft--;
          btn.textContent = timeLeft + 's';
          if (timeLeft <= 0) {
            clearInterval(timer);
            btn.disabled = false;
            btn.textContent = 'Enviar';
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
