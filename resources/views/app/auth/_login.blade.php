<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Entrar – EMI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
        <span class="tab_item active">Entrar</span>
        <a href="{{ url('register') }}" class="tab_item">Cadastrar</a>
      </div>

      <form action="{{ url('login') }}" method="post" id="loginForm">
        @csrf

        <div class="field_label">Número de Telefone</div>
        <div class="field_wrap">
          <span class="field_prefix">+27</span>
          <input type="text" name="phone" placeholder="Digite seu número" required autocomplete="off">
        </div>

        <div class="field_label">Senha</div>
        <div class="field_wrap">
          <input type="password" name="password" placeholder="Digite sua senha" required autocomplete="off">
        </div>

        <button type="submit" class="btn_submit">Entrar Agora</button>
      </form>
    </div>
  </div>

  @include('alert-message')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.getElementById('loginForm').addEventListener('submit', function() {
      document.querySelector('.btn_submit').textContent = 'Aguarde...';
    });
  </script>
</body>
</html>
