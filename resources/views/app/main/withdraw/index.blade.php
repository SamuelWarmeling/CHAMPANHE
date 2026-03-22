<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Saque – EMI</title>
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
    .emi-input{width:100%;border:1px solid #E8DCC8;border-radius:8px;padding:12px;background:#fff;color:#1C1C1C;font-size:14px;font-family:'Inter',sans-serif}
    .emi-label{font-size:12px;color:#6B6B6B;margin-bottom:4px;display:block}
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
    .notes-card{background:#FDF8F0;border:1px solid #E8DCC8;border-radius:12px;padding:16px;margin-bottom:12px}
    .notes-card p{font-size:13px;color:#6B6B6B;margin:0 0 6px;line-height:1.6}
    .notes-card p:last-child{margin-bottom:0}
    .rule-row{display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid #F0E8D8}
    .rule-row:last-child{border-bottom:none}
    .rule-row .lbl{font-size:13px;color:#6B6B6B}
    .rule-row .val{font-size:13px;font-weight:700;color:#1C1C1C}
    .loading-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.35);z-index:999;justify-content:center;align-items:center}
    .spinner{width:44px;height:44px;border:4px solid #E8DCC8;border-top-color:#C8A96A;border-radius:50%;animation:spin 0.8s linear infinite}
    @keyframes spin{to{transform:rotate(360deg)}}
    .section-title{font-size:13px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 12px}
    .input-group{margin-bottom:14px}
    .layui-input{height:44px;line-height:44px;background:#fff;border-radius:8px;border:1px solid #E8DCC8;padding:0 12px;width:100%;font-size:14px;color:#1C1C1C}
  </style>
</head>
<body>

  <!-- Header -->
  <div class="emi-header">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <a href="javascript:history.back(-1)" class="emi-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Saque
      </a>
      <a href="/withdraw/history" style="color:#fff;font-size:13px;font-weight:600;text-decoration:none;opacity:0.9">Histórico &rsaquo;</a>
    </div>
  </div>

  <div style="padding:16px">

    <!-- Balance Card -->
    <div class="emi-card" style="background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);margin-bottom:16px">
      <p style="font-size:12px;color:rgba(255,255,255,0.8);margin:0 0 4px">Saldo Disponível</p>
      <p style="font-size:26px;font-weight:700;color:#fff;margin:0;font-family:'Playfair Display',serif">{{ price(auth()->user()->balance) }}</p>
    </div>

    <!-- Withdrawal Form -->
    <div class="emi-card">
      <p class="section-title">Solicitar Saque</p>
      <form class="layui-form" method="post" action="{{ route('user.withdraw.request') }}">
        @csrf

        <!-- Amount -->
        <div class="input-group">
          <label class="emi-label">Valor do Saque</label>
          <input type="number" name="amount" id="withdrawal_amount"
            min="{{ $minWithdraw }}" max="{{ $maxWithdraw }}"
            value="" placeholder="Valor entre {{ $minWithdraw }} e {{ $maxWithdraw }}"
            autocomplete="off" class="emi-input">
          <div id="brl-conversion" style="margin-top:8px;padding:10px 12px;background:#FDF8F0;border:1px solid #E8DCC8;border-radius:8px;display:none">
            <span style="font-size:13px;color:#6B6B6B">Equivalente: </span>
            <span id="brl-value" style="font-size:15px;font-weight:700;color:#C8A96A"></span>
          </div>
        </div>

        <!-- Trade Password -->
        <div class="input-group">
          <label class="emi-label">Senha de Transação</label>
          <div style="position:relative">
            <input type="password" name="trade_password" id="trade_password"
              value="" placeholder="Digite sua senha de transação"
              autocomplete="off" class="emi-input" style="padding-right:44px">
            <button type="button" onclick="togglePwd()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;padding:0">
              <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#6B6B6B" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </button>
          </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="emi-btn" style="font-size:15px;padding:14px 20px;margin-top:6px" onclick="showLoading()">
          Solicitar Saque
        </button>

      </form>
    </div>

    <!-- Withdrawal Rules -->
    <div class="emi-card">
      <p class="section-title">Regras de Saque</p>
      <div class="rule-row">
        <span class="lbl">Horário de saque</span>
        <span class="val">09:00 – 16:30</span>
      </div>
      <div class="rule-row">
        <span class="lbl">Valor mínimo</span>
        <span class="val emi-gold">{{ price($minWithdraw) }}</span>
      </div>
      <div class="rule-row">
        <span class="lbl">Valor máximo</span>
        <span class="val emi-gold">{{ price($maxWithdraw) }}</span>
      </div>
      <div class="rule-row">
        <span class="lbl">Saques por dia</span>
        <span class="val">1 saque</span>
      </div>
      <div class="rule-row">
        <span class="lbl">Taxa de saque</span>
        <span class="val">{{ $withdrawCharge }}%</span>
      </div>
    </div>

    <!-- Notes -->
    <div class="notes-card">
      <p style="font-size:13px;font-weight:600;color:#8A6C2A;margin:0 0 10px">Observações Importantes</p>
      <p>1. Horário de saque: 09:00 – 16:30.</p>
      <p>2. Valor do saque entre {{ price($minWithdraw) }} e {{ price($maxWithdraw) }}.</p>
      <p>3. Para facilitar a liquidação financeira, só é permitido 1 saque por dia.</p>
      <p>4. Taxa de saque: {{ $withdrawCharge }}%.</p>
    </div>

  </div>

  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loadingOverlay">
    <div style="background:#fff;border-radius:16px;padding:32px 40px;display:flex;flex-direction:column;align-items:center;gap:16px">
      <div class="spinner"></div>
      <p style="margin:0;font-size:14px;color:#6B6B6B">Processando...</p>
    </div>
  </div>

  @include('alert-message')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
  <script>
    const MIL_TO_BRL = 0.73;

    document.getElementById('withdrawal_amount').addEventListener('input', function () {
      const mil = parseFloat(this.value);
      const box = document.getElementById('brl-conversion');
      const display = document.getElementById('brl-value');
      if (!mil || mil <= 0) { box.style.display = 'none'; return; }
      display.textContent = '= R$ ' + (mil * MIL_TO_BRL).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      box.style.display = 'block';
    });

    function showLoading() {
      document.getElementById('loadingOverlay').style.display = 'flex';
    }
    function togglePwd() {
      const input = document.getElementById('trade_password');
      input.type = input.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>
