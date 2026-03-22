<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Depósito – EMI</title>
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
    .emi-label{font-size:12px;color:#6B6B6B;margin-bottom:4px}
    .emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
    .status-approved{background:#EAF0E6;color:#4A7A3A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .status-pending{background:#F5F0E8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .status-rejected{background:#F5ECEA;color:#8A3A3A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .record-row{background:#fff;border:1px solid #E8DCC8;border-radius:10px;padding:14px 16px;margin-bottom:8px}
    .record-row .amount{font-size:17px;font-weight:700;color:#C8A96A}

    .quick-amount{
      background:#fff;
      border:1px solid #E8DCC8;
      border-radius:8px;
      padding:10px 4px;
      text-align:center;
      font-size:13px;
      font-weight:600;
      color:#6B6B6B;
      cursor:pointer;
      transition:all 0.2s;
    }
    .quick-amount.active{
      background:#FDF8F0;
      border-color:#C8A96A;
      color:#C8A96A;
    }
    .payment-method-row{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:14px 16px;
      background:#fff;
      border:1px solid #E8DCC8;
      border-radius:10px;
      margin-bottom:8px;
      cursor:pointer;
    }
    .payment-method-row input[type="radio"]{
      width:18px;height:18px;accent-color:#C8A96A;
    }
    .notes-card{background:#FDF8F0;border:1px solid #E8DCC8;border-radius:12px;padding:16px;margin-bottom:12px}
    .notes-card p{font-size:13px;color:#6B6B6B;margin:0 0 6px;line-height:1.6}
    .notes-card p:last-child{margin-bottom:0}
    .loading-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.35);z-index:999;justify-content:center;align-items:center}
    .spinner{width:44px;height:44px;border:4px solid #E8DCC8;border-top-color:#C8A96A;border-radius:50%;animation:spin 0.8s linear infinite}
    @keyframes spin{to{transform:rotate(360deg)}}
    .section-title{font-size:13px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 10px}
  </style>
</head>
<body>

  <!-- Header -->
  <div class="emi-header">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <a href="/" class="emi-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Depósito
      </a>
      <a href="/deposit/history" style="color:#fff;font-size:13px;font-weight:600;text-decoration:none;opacity:0.9">Histórico &rsaquo;</a>
    </div>
  </div>

  <div style="padding:16px">

    <!-- Balance Card -->
    <div class="emi-card" style="background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);margin-bottom:16px">
      <p style="font-size:12px;color:rgba(255,255,255,0.8);margin:0 0 4px">Saldo Disponível</p>
      <p style="font-size:24px;font-weight:700;color:#fff;margin:0;font-family:'Playfair Display',serif">{{ price(auth()->user()->balance) }}</p>
    </div>

    <!-- Deposit Form -->
    <form onsubmit="goPayment(event)">

      <!-- Amount Input -->
      <div class="emi-card">
        <p class="section-title">Valor do Depósito</p>
        <div style="position:relative">
          <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#C8A96A;font-weight:700;font-size:16px">=</span>
          <input type="number" name="amount" id="recharge_amount" value="" placeholder="Digite o valor do depósito" autocomplete="off"
            class="emi-input" style="padding-left:28px">
        </div>

        <!-- BRL conversion display -->
        <div id="brl-conversion" style="margin-top:10px;padding:10px 12px;background:#FDF8F0;border:1px solid #E8DCC8;border-radius:8px;display:none">
          <span style="font-size:13px;color:#6B6B6B">Equivalente: </span>
          <span id="brl-value" style="font-size:15px;font-weight:700;color:#C8A96A"></span>
        </div>

        <!-- Quick Amounts -->
        <p class="section-title" style="margin-top:16px">Valores Rápidos</p>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px">
          @foreach([100, 340, 2880, 5750, 15500, 35900, 72000, 119000] as $value)
            @php $brl = number_format($value * 0.73, 2, ',', '.') @endphp
            <div class="quick-amount {{ $loop->first ? 'active' : '' }}" onclick="getAmount(this, {{ $value }})">
              <div>{{ number_format($value) }} MIL</div>
              <div style="font-size:10px;color:#9A9087;font-weight:400;margin-top:2px">R$ {{ $brl }}</div>
            </div>
          @endforeach
        </div>
      </div>

      <!-- Payment Method -->
      <div class="emi-card">
        <p class="section-title">Canal de Pagamento</p>
        @foreach(\App\Models\PaymentMethod::get() as $el)
          <label class="payment-method-row" style="cursor:pointer">
            <span style="font-size:14px;font-weight:500;color:#1C1C1C">{{ $el->name }}</span>
            <input type="radio" name="payment_method" value="{{ $el->id }}" {{ $loop->first ? 'checked' : '' }}>
          </label>
        @endforeach
      </div>

      <!-- Notes -->
      <div class="notes-card">
        <p style="font-size:13px;font-weight:600;color:#8A6C2A;margin:0 0 10px">Observações Importantes</p>
        <p>1. Se houver dificuldade em pagar um valor alto de uma vez, você pode parcelar — por exemplo, R$10.000 em 2 vezes de R$5.000.</p>
        <p>2. Não modifique o valor do depósito. A modificação não autorizada pode resultar no não crédito.</p>
        <p>3. Cada depósito deve ser iniciado por esta página; não salve o link de pagamento para uso posterior.</p>
        <p>4. O depósito é creditado em até 5 minutos. Se não for creditado, entre em contato com o suporte.</p>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="emi-btn" style="font-size:15px;padding:14px 20px">
        Confirmar Depósito
      </button>

    </form>

  </div>

  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loadingOverlay">
    <div style="background:#fff;border-radius:16px;padding:32px 40px;display:flex;flex-direction:column;align-items:center;gap:16px">
      <div class="spinner"></div>
      <p style="margin:0;font-size:14px;color:#6B6B6B">Processando...</p>
    </div>
  </div>

  @include('alert-message')

  <script>
    const MIL_TO_BRL = 0.73;

    function formatBRL(value) {
      return 'R$ ' + value.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateConversion(mil) {
      const box = document.getElementById('brl-conversion');
      const display = document.getElementById('brl-value');
      if (!mil || mil <= 0) {
        box.style.display = 'none';
        return;
      }
      display.textContent = '= ' + formatBRL(mil * MIL_TO_BRL);
      box.style.display = 'block';
    }

    document.getElementById('recharge_amount').addEventListener('input', function () {
      updateConversion(parseFloat(this.value));
    });

    function getAmount(_this, amount) {
      document.querySelector('input[name="amount"]').value = amount;
      document.querySelectorAll('.quick-amount').forEach(q => q.classList.remove('active'));
      _this.classList.add('active');
      updateConversion(amount);
    }

    // Show conversion for the pre-selected quick amount on load
    document.addEventListener('DOMContentLoaded', function () {
      const first = document.querySelector('.quick-amount.active');
      if (first) {
        const val = parseFloat(document.querySelector('input[name="amount"]').value);
        if (val > 0) updateConversion(val);
      }
    });

    function goPayment(event) {
      event.preventDefault();
      const overlay = document.getElementById('loadingOverlay');
      const amount = document.getElementById('recharge_amount').value;
      const method = document.querySelector('input[name="payment_method"]:checked');

      if (!method) {
        alert("Selecione o canal de pagamento");
        return;
      }

      if (!amount || amount <= 0) {
        alert("Informe o valor do depósito");
        return;
      }

      overlay.style.display = 'flex';

      setTimeout(() => {
        overlay.style.display = 'none';
        window.location.href = '{{ url('user/payment') }}/' + amount + '/' + method.value;
      }, 2000);
    }
  </script>
</body>
</html>
