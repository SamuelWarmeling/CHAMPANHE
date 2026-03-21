<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Dados Bancários – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{background:#F8F6F2;color:#1C1C1C;margin:0;padding:0 0 80px}
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}
    .emi-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:14px 16px;color:#fff}
    .emi-back{display:flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:15px;font-weight:600}
    .emi-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:16px;margin-bottom:12px}
    .emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:12px 20px;font-weight:600;font-size:14px;cursor:pointer;display:block;width:100%;text-align:center}
    .emi-input{width:100%;border:1px solid #E8DCC8;border-radius:8px;padding:12px;background:#fff;color:#1C1C1C;font-size:14px;font-family:'Inter',sans-serif;outline:none}
    .emi-select{width:100%;border:1px solid #E8DCC8;border-radius:8px;padding:12px;background:#fff;color:#1C1C1C;font-size:14px;font-family:'Inter',sans-serif;outline:none;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24' stroke='%23C8A96A' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:36px}
    .emi-label{font-size:12px;color:#6B6B6B;margin-bottom:4px;display:block;font-weight:500}
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
    .notes-card{background:#FDF8F0;border:1px solid #E8DCC8;border-radius:12px;padding:16px;margin-bottom:12px}
    .notes-card p{font-size:13px;color:#6B6B6B;margin:0 0 6px;line-height:1.6}
    .notes-card p:last-child{margin-bottom:0}
    .input-group{margin-bottom:14px}
    .input-group:last-child{margin-bottom:0}
    .loading-img{position:fixed;display:none;top:50%;left:50%;transform:translate(-50%,-50%);width:100%;z-index:999}
    .section-title{font-size:13px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 16px}
    .emi-input:focus,.emi-select:focus{border-color:#C8A96A}
    .layui-form-select dl{z-index:900!important}
  </style>
</head>
@php
  $user = auth()->user();
@endphp
<body>

  <!-- Header -->
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      Dados Bancários
    </a>
  </div>

  <div style="padding:16px">

    <!-- Form Card -->
    <div class="emi-card">
      <p class="section-title">Cadastrar Conta Bancária</p>
      <form action="{{ route('user.bank_setup_confirm') }}" class="layui-form" lay-filter="saveBankCardInfoForm" method="post">
        @csrf
        <input name="id" type="hidden" value="">

        <!-- Bank Selector -->
        <div class="input-group">
          <label class="emi-label">Banco</label>
          <div style="position:relative">
            <select name="gateway_method" lay-verify="required" lay-reqtext="Selecione o banco" class="emi-select">
              <option value="">Selecione o banco</option>
              @foreach(\App\Models\BankList::where('status', '1')->get() as $elemenet)
                <option value="{{ $elemenet->bank_code }}" @if($user->gateway_method == $elemenet->bank_code) selected @endif>{{ $elemenet->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- Card Holder Name -->
        <div class="input-group">
          <label class="emi-label">Nome do Titular</label>
          <div style="position:relative">
            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%)">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#C8A96A" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </span>
            <input type="text" name="realname" value="{{ $user->realname }}" lay-verify="required" placeholder="Nome do titular da conta" autocomplete="off" class="emi-input" style="padding-left:36px">
          </div>
        </div>

        <!-- Account Number -->
        <div class="input-group">
          <label class="emi-label">Número da Conta / Chave PIX</label>
          <div style="position:relative">
            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%)">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#C8A96A" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M2 10h20"/></svg>
            </span>
            <input type="text" name="gateway_address" value="{{ $user->gateway_address }}" lay-verify="required" placeholder="Número da conta ou chave PIX" autocomplete="off" class="emi-input" style="padding-left:36px">
          </div>
        </div>

        <!-- Trade Password -->
        <div class="input-group">
          <label class="emi-label">Senha de Transação</label>
          <div style="position:relative">
            <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%)">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#C8A96A" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </span>
            <input type="password" name="trade_password" value="" lay-verify="required" lay-reqtext="Senha de transação" placeholder="Senha de transação" autocomplete="off" class="emi-input" style="padding-left:36px;padding-right:44px" id="bank_trade_pwd" lay-affix="eye">
            <button type="button" onclick="toggleBankPwd()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#6B6B6B" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </button>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="emi-btn" style="font-size:15px;padding:14px 20px;margin-top:6px" lay-submit="" lay-filter="saveBankCardInfo">
          Salvar Conta Bancária
        </button>

      </form>
    </div>

    <!-- Notes -->
    <div class="notes-card">
      <p style="font-size:13px;font-weight:600;color:#8A6C2A;margin:0 0 10px">Observações Importantes</p>
      <p>1. Você pode adicionar apenas uma conta bancária para saques.</p>
      <p>2. Certifique-se de que os dados bancários estão corretos e que a conta está ativa.</p>
    </div>

  </div>

  <img style="position:fixed;display:none;top:50%;left:50%;transform:translate(-50%,-50%);width:100%;z-index:999" src="{{ asset('public/loading.gif') }}" class="loading" alt="">
  <div class="layui-layer-move"></div>
  @include('alert-message')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.all.js"></script>
  <script>
    function toggleBankPwd() {
      const input = document.getElementById('bank_trade_pwd');
      input.type = input.type === 'password' ? 'text' : 'password';
    }

    layui.use('form', function() {
      var form = layui.form;

      form.on('submit(saveBankCardInfoForm)', function(data) {
        document.querySelector('.loading').style.display = 'block';

        var isValid = true;

        form.verify({
          required: function(value, item) {
            if (!value.trim()) {
              return 'Este campo é obrigatório!';
            }
          }
        });

        if (!form.checkValidity()) {
          document.querySelector('.loading').style.display = 'none';
          isValid = false;
        }

        return isValid;
      });

      form.render();
    });
  </script>
</body>
</html>
