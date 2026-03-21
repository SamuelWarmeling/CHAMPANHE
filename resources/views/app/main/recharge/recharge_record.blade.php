<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Histórico de Depósitos – EMI</title>
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
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
    .status-approved{background:#EAF0E6;color:#4A7A3A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .status-pending{background:#F5F0E8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .status-rejected{background:#F5ECEA;color:#8A3A3A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .record-row{background:#fff;border:1px solid #E8DCC8;border-radius:10px;padding:14px 16px;margin-bottom:8px;display:block;text-decoration:none;color:inherit}
    .record-row .amount{font-size:17px;font-weight:700;color:#C8A96A}
    .detail-line{display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-bottom:1px solid #F5EFE5}
    .detail-line:last-child{border-bottom:none;padding-bottom:0}
    .detail-line .lbl{font-size:12px;color:#6B6B6B}
    .detail-line .val{font-size:13px;font-weight:600;color:#1C1C1C}
    .empty-state{text-align:center;padding:48px 16px}
    .empty-state svg{opacity:0.35;margin-bottom:12px}
    .empty-state p{color:#6B6B6B;font-size:14px;margin:0}
  </style>
</head>
<body>

  <!-- Header -->
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      Histórico de Depósitos
    </a>
  </div>

  <div style="padding:16px">

    <!-- Balance Summary -->
    <div class="emi-card" style="background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);margin-bottom:16px">
      <p style="font-size:12px;color:rgba(255,255,255,0.8);margin:0 0 4px">Saldo da Conta</p>
      <p style="font-size:24px;font-weight:700;color:#fff;margin:0;font-family:'Playfair Display',serif">{{ price(auth()->user()->balance) }}</p>
    </div>

    <!-- Deposit Records -->
    @php
      $deposits = \App\Models\Deposit::where('user_id', auth()->id())->orderByDesc('id')->get();
    @endphp

    @if($deposits->isEmpty())
      <div class="empty-state">
        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="#C8A96A" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m9-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p>Nenhum depósito encontrado.</p>
      </div>
    @else
      @foreach($deposits as $element)
        @php
          $statusLabel = match($element->status) {
            'approved' => 'Aprovado',
            'progress' => 'Processando',
            'rejected' => 'Rejeitado',
            default    => 'Pendente'
          };
          $statusClass = match($element->status) {
            'approved' => 'status-approved',
            'progress' => 'status-pending',
            'rejected' => 'status-rejected',
            default    => 'status-pending'
          };
        @endphp
        <a href="/rechargeDetails/{{ $element->id }}" class="record-row">
          <div class="flex-between" style="margin-bottom:10px">
            <span class="amount">{{ price($element->amount) }}</span>
            <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
          </div>
          <div class="detail-line">
            <span class="lbl">Valor Recebido</span>
            <span class="val">{{ price($element->final_amount) }}</span>
          </div>
          <div class="detail-line">
            <span class="lbl">Taxa</span>
            <span class="val">{{ price($element->charge_amount) }}</span>
          </div>
          <div class="detail-line">
            <span class="lbl">Data de Solicitação</span>
            <span class="val" style="font-size:12px;font-weight:500;color:#6B6B6B">{{ $element->created_at }}</span>
          </div>
        </a>
      @endforeach
    @endif

  </div>

</body>
</html>
