<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Confirmar Pagamento – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    .notes-card{background:#FDF8F0;border:1px solid #E8DCC8;border-radius:12px;padding:16px;margin-bottom:12px}
    .notes-card p{font-size:13px;color:#6B6B6B;margin:0 0 6px;line-height:1.6}
    .notes-card p:last-child{margin-bottom:0}
    .detail-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #F0E8D8}
    .detail-row:last-child{border-bottom:none;padding-bottom:0}
    .detail-row .lbl{font-size:13px;color:#6B6B6B}
    .detail-row .val{font-size:14px;font-weight:600;color:#1C1C1C}
    .copy-btn{background:none;border:none;color:#C8A96A;font-size:13px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:4px;padding:0}
    .qr-block{display:flex;flex-direction:column;align-items:center;padding:16px 0;gap:12px}
    .qr-block img{border:3px solid #E8DCC8;border-radius:10px;width:160px;height:160px}
    .overlay-loader{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:100;justify-content:center;align-items:center}
    .spinner{width:44px;height:44px;border:4px solid #E8DCC8;border-top-color:#C8A96A;border-radius:50%;animation:spin 0.8s linear infinite}
    @keyframes spin{to{transform:rotate(360deg)}}
    .modal-box{position:fixed;inset:0;display:none;justify-content:center;align-items:center;z-index:110;background:rgba(0,0,0,0.45)}
    .modal-inner{background:#fff;border-radius:16px;padding:24px;width:calc(100% - 32px);max-width:420px}
    .modal-inner h3{font-family:'Playfair Display',serif;font-size:17px;color:#1C1C1C;margin:0 0 16px}
    .modal-inner label{font-size:13px;color:#6B6B6B;display:block;margin-bottom:4px;margin-top:12px}
    .modal-inner input[type="text"],.modal-inner input[type="file"]{width:100%;border:1px solid #E8DCC8;border-radius:8px;padding:10px 12px;font-size:14px;background:#fff;color:#1C1C1C}
    .warning-text{color:#8A3A3A;font-size:13px;margin:0 0 8px;line-height:1.5}
    .section-title{font-size:13px;font-weight:600;color:#6B6B6B;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 10px}
  </style>
</head>
<body>

  <!-- Header -->
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      Confirmar Pagamento
    </a>
  </div>

  <form action="{{ route('depositSubmit') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="padding:16px">

      <!-- Amount Summary Card -->
      <div class="emi-card" style="background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);text-align:center;margin-bottom:16px">
        <p style="font-size:12px;color:rgba(255,255,255,0.85);margin:0 0 6px">Valor a Depositar</p>
        <p style="font-size:30px;font-weight:700;color:#fff;margin:0;font-family:'Playfair Display',serif">{{ price($amount) }}</p>
        <div style="display:inline-block;background:rgba(255,255,255,0.2);border-radius:6px;padding:4px 12px;margin-top:10px">
          <span style="font-size:13px;color:#fff;font-weight:600">Transferência Bancária</span>
        </div>
      </div>

      <!-- Bank Details Card -->
      <div class="emi-card">
        <p class="section-title">Dados para Transferência</p>
        <p style="font-size:13px;color:#6B6B6B;margin:0 0 14px;line-height:1.6">
          Transfira exatamente <strong style="color:#C8A96A">{{ price($amount) }}</strong> para a conta abaixo e clique em "Já Paguei".
        </p>

        <!-- Bank Name Row -->
        <div class="detail-row">
          <span class="lbl">Nome do Banco</span>
          <button type="button" class="copy-btn" onclick="copyField('payment_method', this)">
            {{ $payment_method->name }}
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          </button>
        </div>

        <!-- Account Number Row -->
        <div class="detail-row">
          <span class="lbl">Número da Conta / Chave</span>
          <button type="button" class="copy-btn" onclick="copyField('acnn', this)">
            {{ $payment_method->address }}
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          </button>
        </div>

        <!-- QR Code -->
        <div class="qr-block">
          <p style="font-size:13px;color:#6B6B6B;margin:0">Ou escaneie o QR Code:</p>
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ urlencode($payment_method->address) }}" alt="QR Code">
          <button type="button" class="copy-btn" onclick="copyAddress('{{ $payment_method->address }}')">
            Copiar endereço
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          </button>
        </div>

        <p style="font-size:13px;color:#8A6C2A;text-align:center;margin:0;background:#FDF8F0;border-radius:8px;padding:10px">
          Use seu número de telefone cadastrado como referência.
        </p>
      </div>

      <!-- Notes -->
      <div class="notes-card">
        <p style="font-size:13px;font-weight:600;color:#8A6C2A;margin:0 0 10px">Dúvidas?</p>
        <p>Entre em contato pelo nosso canal oficial:
          <a href="{{ setting('telegram') }}" style="color:#C8A96A;font-weight:600">Telegram Oficial</a>
        </p>
      </div>

      <!-- Confirm Button -->
      <button type="button" class="emi-btn" style="font-size:15px;padding:14px 20px;margin-top:4px" onclick="next_()">
        Já Paguei
      </button>

    </div>

    <!-- Hidden Inputs -->
    <input type="hidden" id="payment_method" value="{{ $payment_method->name }}">
    <input type="hidden" id="acnn" value="{{ $payment_method->address }}">

    <!-- Loader Overlay -->
    <div id="bak" class="overlay-loader">
      <div style="background:#fff;border-radius:16px;padding:32px 40px;display:flex;flex-direction:column;align-items:center;gap:16px">
        <div class="spinner"></div>
        <p style="margin:0;font-size:14px;color:#6B6B6B">Verificando pagamento...</p>
      </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadID" class="modal-box">
      <div class="modal-inner">
        <h3>Confirmar Comprovante</h3>
        <p class="warning-text">Não foi possível verificar seu depósito automaticamente. Por favor, informe seu número de telefone e envie o comprovante.</p>
        <label>Número de Telefone</label>
        <input type="text" name="transaction_id" required placeholder="Digite seu número de telefone">
        <label>Comprovante de Pagamento</label>
        <input type="file" id="file-input" name="photo" accept=".png,.jpg,.jpeg,.pdf" required>
        <button type="submit" class="emi-btn" style="margin-top:20px;font-size:15px;padding:13px 20px">Enviar Comprovante</button>
        <button type="button" onclick="document.getElementById('uploadID').style.display='none'" style="display:block;width:100%;text-align:center;margin-top:10px;background:none;border:none;color:#6B6B6B;font-size:14px;cursor:pointer">Cancelar</button>
      </div>
    </div>

  </form>

  <script>
    function copyField(inputId, btn) {
      const val = document.getElementById(inputId).value;
      navigator.clipboard.writeText(val).then(() => {
        const orig = btn.innerHTML;
        btn.style.color = '#4A7A3A';
        setTimeout(() => { btn.style.color = '#C8A96A'; }, 1500);
      });
    }

    function copyAddress(text) {
      navigator.clipboard.writeText(text).then(() => {
        alert('Endereço copiado!');
      });
    }

    function next_() {
      const bak = document.getElementById('bak');
      bak.style.display = 'flex';
      setTimeout(() => {
        bak.style.display = 'none';
        document.getElementById('uploadID').style.display = 'flex';
      }, 3000);
    }
  </script>
</body>
</html>
