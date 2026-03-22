<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Início – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { background: #F8F6F2; color: #1C1C1C; margin: 0; padding: 0 0 80px 0; }
    h1,h2,h3,.playfair { font-family: 'Playfair Display', serif; }

    /* ── Header ── */
    .emi-top-header {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      padding: 14px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .emi-top-header .logo-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .emi-top-header .logo-wrap img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid rgba(255,255,255,0.5);
    }
    .emi-top-header .user-info .masked-phone {
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      line-height: 1.2;
    }
    .emi-top-header .user-info .user-id {
      font-size: 11px;
      color: rgba(255,255,255,0.8);
      margin-top: 2px;
    }
    .emi-bell-btn {
      background: rgba(255,255,255,0.2);
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      color: #fff;
      text-decoration: none;
    }

    /* ── Balance Card ── */
    .emi-balance-card {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 50%, #B8943A 100%);
      margin: 16px;
      border-radius: 20px;
      padding: 20px 16px 16px;
      box-shadow: 0 4px 16px rgba(200,169,106,0.4);
      position: relative;
      overflow: hidden;
    }
    .emi-balance-card::before {
      content: '';
      position: absolute;
      top: -30px;
      right: -30px;
      width: 120px;
      height: 120px;
      background: rgba(255,255,255,0.08);
      border-radius: 50%;
    }
    .emi-balance-card::after {
      content: '';
      position: absolute;
      bottom: -20px;
      right: 40px;
      width: 80px;
      height: 80px;
      background: rgba(255,255,255,0.06);
      border-radius: 50%;
    }
    .emi-balance-card .bal-label {
      font-size: 12px;
      color: rgba(255,255,255,0.85);
      font-weight: 500;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .emi-balance-card .bal-amount {
      font-family: 'Playfair Display', serif;
      font-size: 30px;
      font-weight: 700;
      color: #fff;
      margin: 4px 0 14px;
      letter-spacing: -0.5px;
    }
    .emi-balance-card .bal-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      margin-bottom: 18px;
    }
    .emi-balance-card .income-block .inc-label {
      font-size: 11px;
      color: rgba(255,255,255,0.75);
    }
    .emi-balance-card .income-block .inc-amount {
      font-size: 16px;
      font-weight: 700;
      color: #fff;
      margin-top: 2px;
    }

    /* ── Quick Action Grid (5 circles) ── */
    .emi-quick-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 0;
      position: relative;
      z-index: 1;
    }
    .emi-quick-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
      text-decoration: none;
      padding: 4px 2px;
    }
    .emi-quick-item .q-circle {
      width: 44px;
      height: 44px;
      background: rgba(255,255,255,0.25);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(4px);
    }
    .emi-quick-item .q-circle svg {
      width: 20px;
      height: 20px;
      color: #fff;
    }
    .emi-quick-item .q-label {
      font-size: 11px;
      color: rgba(255,255,255,0.95);
      font-weight: 500;
      text-align: center;
    }

    /* ── VIP Progress Card ── */
    .emi-card {
      background: #fff;
      border: 1px solid #E8DCC8;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(200,169,106,0.15);
      padding: 16px;
      margin: 0 16px 12px;
    }
    .emi-card-title {
      font-family: 'Playfair Display', serif;
      font-size: 15px;
      font-weight: 700;
      color: #1C1C1C;
      margin-bottom: 12px;
    }
    .emi-vip-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .emi-vip-badge {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #fff;
      font-size: 11px;
      font-weight: 700;
      padding: 3px 10px;
      border-radius: 20px;
      letter-spacing: 0.5px;
    }
    .emi-vip-next {
      font-size: 12px;
      color: #6B6B6B;
    }
    .emi-progress-track {
      background: #F0E8D8;
      border-radius: 100px;
      height: 8px;
      overflow: hidden;
      margin-bottom: 6px;
    }
    .emi-progress-fill {
      background: linear-gradient(90deg, #C8A96A 0%, #D6A86B 100%);
      height: 100%;
      border-radius: 100px;
      transition: width 0.5s ease;
    }
    .emi-progress-text {
      font-size: 11px;
      color: #6B6B6B;
      text-align: right;
    }

    /* ── Announcement Strip ── */
    .emi-notice-strip {
      background: #FBF5E6;
      border: 1px solid #E8DCC8;
      border-radius: 10px;
      margin: 0 16px 12px;
      padding: 10px 14px;
      display: flex;
      align-items: center;
      gap: 10px;
      overflow: hidden;
    }
    .emi-notice-strip .notice-icon {
      flex-shrink: 0;
      width: 20px;
      height: 20px;
      color: #C8A96A;
    }
    .emi-notice-strip .notice-text {
      font-size: 13px;
      color: #6B6B6B;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ── Action Cards ── */
    .emi-section-title {
      font-family: 'Playfair Display', serif;
      font-size: 16px;
      font-weight: 700;
      color: #1C1C1C;
      padding: 0 16px 10px;
    }
    .emi-action-card {
      background: #fff;
      border: 1px solid #E8DCC8;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(200,169,106,0.15);
      padding: 16px;
      margin: 0 16px 12px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .emi-action-card .ac-text .ac-title {
      font-size: 14px;
      font-weight: 700;
      color: #1C1C1C;
      margin-bottom: 4px;
    }
    .emi-action-card .ac-text .ac-desc {
      font-size: 12px;
      color: #6B6B6B;
    }
    .emi-go-btn {
      background: #C8A96A;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 8px 16px;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      text-decoration: none;
      white-space: nowrap;
    }
    .emi-go-link {
      color: #C8A96A;
      font-weight: 600;
      font-size: 13px;
      text-decoration: none;
      white-space: nowrap;
    }

    /* ── Two-col card row ── */
    .emi-two-col {
      display: flex;
      gap: 12px;
      margin: 0 16px 12px;
    }
    .emi-two-col .emi-half-card {
      flex: 1;
      background: #fff;
      border: 1px solid #E8DCC8;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(200,169,106,0.15);
      padding: 14px 12px;
    }
    .emi-half-card .hc-title {
      font-size: 13px;
      font-weight: 700;
      color: #1C1C1C;
      margin-bottom: 4px;
    }
    .emi-half-card .hc-desc {
      font-size: 11px;
      color: #6B6B6B;
      margin-bottom: 10px;
    }

    /* ── Product Dialog ── */
    .emi-dialog-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.45);
      z-index: 19891000;
      align-items: flex-end;
      justify-content: center;
    }
    .emi-dialog-overlay.active {
      display: flex;
    }
    .emi-dialog-sheet {
      background: #fff;
      border-radius: 20px 20px 0 0;
      width: 100%;
      max-width: 430px;
      padding: 20px 16px 32px;
      box-shadow: 0 -4px 20px rgba(200,169,106,0.25);
    }
    .emi-dialog-sheet .sheet-handle {
      width: 40px;
      height: 4px;
      background: #E8DCC8;
      border-radius: 100px;
      margin: 0 auto 16px;
    }
    .emi-dialog-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
    }
    .emi-dialog-header img.product_dialog_image {
      width: 52px;
      height: 52px;
      border-radius: 10px;
      object-fit: cover;
      border: 1px solid #E8DCC8;
    }
    .emi-dialog-header .product_title {
      font-family: 'Playfair Display', serif;
      font-size: 15px;
      font-weight: 700;
      color: #1C1C1C;
    }
    .emi-dialog-header .product_vip_btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      border-radius: 20px;
      padding: 2px 8px;
      margin-top: 4px;
    }
    .emi-dialog-header .vip_level {
      font-size: 11px;
      font-weight: 700;
      color: #fff;
    }
    .emi-dialog-info {
      background: #F8F6F2;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 12px;
    }
    .emi-dialog-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 6px 0;
      border-bottom: 1px solid #EEE9DE;
    }
    .emi-dialog-row:last-child {
      border-bottom: none;
    }
    .emi-dialog-row .label {
      font-size: 13px;
      color: #6B6B6B;
      margin: 0;
    }
    .emi-dialog-row .value {
      font-size: 13px;
      font-weight: 700;
      color: #1C1C1C;
      margin: 0;
    }
    .emi-qty-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0 6px;
    }
    .emi-qty-row .label {
      font-size: 13px;
      color: #6B6B6B;
      margin: 0;
    }
    .emi-qty-input-wrap {
      display: flex;
      align-items: center;
    }
    .layui-input-affix { height: 30px !important; line-height: 30px !important; }
    .buy_btn {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #fff;
      border: none;
      border-radius: 10px;
      width: 100%;
      padding: 14px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      margin-top: 12px;
      font-family: 'Inter', sans-serif;
    }

    /* ── General dialog (reminder) ── */
    .dialog {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(200,169,106,0.25);
      z-index: 19891020;
      width: 300px;
      padding: 20px;
      border: 1px solid #E8DCC8;
    }
    .dialog .dialog_title {
      display: flex;
      align-items: center;
      gap: 8px;
      font-family: 'Playfair Display', serif;
      font-size: 15px;
      font-weight: 700;
      color: #1C1C1C;
      margin-bottom: 12px;
    }
    .dialog .dialog_title img {
      width: 20px;
      height: 20px;
    }
    .dialog .dialog_contents {
      font-size: 13px;
      color: #6B6B6B;
      margin-bottom: 16px;
    }
    .dialog .btn_group {
      display: flex;
      gap: 10px;
    }
    .dialog .btn_group .cancel {
      flex: 1;
      text-align: center;
      padding: 10px;
      border-radius: 8px;
      background: #F0E8D8;
      color: #6B6B6B;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
    }
    .dialog .btn_group .confirm {
      flex: 1;
      text-align: center;
      padding: 10px;
      border-radius: 8px;
      background: #C8A96A;
      color: #fff;
      font-weight: 600;
      font-size: 13px;
      text-decoration: none;
    }

    /* ── Telegram Popup ── */
    .emi-tg-popup {
      display: none; /* FIX: hidden by default; .active shows it */
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 40px rgba(200,169,106,0.3);
      z-index: 19891015;
      width: calc(100% - 48px);
      max-width: 340px;
      padding: 28px 20px 20px;
      border: 1px solid #E8DCC8;
      text-align: center;
    }
    .emi-tg-popup .tg-close {
      position: absolute;
      top: 12px;
      right: 14px;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #F0E8D8;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      color: #6B6B6B;
    }
    .emi-tg-popup .tg-icon {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      margin: 0 auto 14px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .emi-tg-popup .tg-icon svg {
      width: 28px;
      height: 28px;
      color: #fff;
    }
    .emi-tg-popup .tg-title {
      font-family: 'Playfair Display', serif;
      font-size: 17px;
      font-weight: 700;
      color: #1C1C1C;
      margin-bottom: 8px;
    }
    .emi-tg-popup .tg-text {
      font-size: 13px;
      color: #6B6B6B;
      line-height: 1.6;
      margin-bottom: 18px;
    }
    .emi-tg-popup .tg-btn {
      display: block;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #fff;
      border-radius: 10px;
      padding: 13px;
      font-weight: 700;
      font-size: 14px;
      text-decoration: none;
    }
    .emi-tg-shade {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.4);
      z-index: 19891014;
    }
    .emi-tg-shade.active, .emi-tg-popup.active { display: block; }
    .emi-tg-popup.active { display: flex; flex-direction: column; }

    /* Copy link area hidden */
    #copyTxt { height: 1px; opacity: 0; position: absolute; }
  </style>
</head>
<body>

  <!-- ══════════════════════════════════════
       TOP HEADER
  ══════════════════════════════════════ -->
  <div class="emi-top-header">
    <div class="logo-wrap">
      <img src="{{setting('logo')}}" alt="EMI Logo">
      <div class="user-info">
        <div class="masked-phone">
          {{substr(auth()->user()->phone, 0, 3)}}******{{substr(strrev(auth()->user()->phone), 0, 2)}}
        </div>
        <div class="user-id">ID: {{user()->ref_id}}</div>
      </div>
    </div>
    <a href="/notice" class="emi-bell-btn" aria-label="Notificações">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:20px;height:20px">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
      </svg>
    </a>
  </div>

  <!-- ══════════════════════════════════════
       BALANCE CARD
  ══════════════════════════════════════ -->
  <div class="emi-balance-card">
    <div class="bal-label">Seu Saldo</div>
    <div class="bal-amount user_balance">{{price(auth()->user()->balance)}}</div>

    <div class="bal-row">
      <div class="income-block">
        <div class="inc-label">Renda de Produtos</div>
        <div class="inc-amount product_income">
          {{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'balance_added')->sum('amount')) }}
        </div>
      </div>
    </div>

    <!-- 5 Quick-Action Circles -->
    <div class="emi-quick-grid">
      <a href="/recharge" class="emi-quick-item">
        <div class="q-circle">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
          </svg>
        </div>
        <span class="q-label">Depósito</span>
      </a>
      <a href="/withdraw" class="emi-quick-item">
        <div class="q-circle">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </div>
        <span class="q-label">Saque</span>
      </a>
      <a href="/team" class="emi-quick-item">
        <div class="q-circle">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <span class="q-label">Equipe</span>
      </a>
      <a href="/help" class="emi-quick-item">
        <div class="q-circle">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
        </div>
        <span class="q-label">Suporte</span>
      </a>
      <a href="{{setting('telegram')}}" class="emi-quick-item">
        <div class="q-circle">
          <svg viewBox="0 0 24 24" fill="currentColor" style="width:20px;height:20px">
            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.248l-2.04 9.614c-.15.677-.546.843-1.107.524l-3.067-2.26-1.48 1.424c-.163.163-.3.3-.616.3l.22-3.118 5.674-5.124c.247-.22-.054-.34-.384-.12L7.418 14.29l-3.007-.938c-.654-.204-.667-.654.137-.968l11.735-4.524c.545-.197 1.022.133.845.967l-.566-.58z"/>
          </svg>
        </div>
        <span class="q-label">Telegram</span>
      </a>
    </div>
  </div>

  <!-- ══════════════════════════════════════
       VIP PROGRESS CARD
  ══════════════════════════════════════ -->
  @php
    $vipLevel = auth()->user()->vip_level ?? 0;
    $totalInvestment = \App\Models\Purchase::where('user_id', auth()->id())->sum('amount');
    $vipTargets = [
      1 => 500, 2 => 1000, 3 => 2000, 4 => 4000, 5 => 8000,
      6 => 16000, 7 => 32000, 8 => 64000, 9 => 128000, 10 => 256000,
    ];
    $nextVipLevel = $vipLevel < 10 ? $vipLevel + 1 : 10;
    $nextTarget = $vipTargets[$nextVipLevel] ?? $totalInvestment;
    $progressPercent = $nextTarget > 0 ? min(100, ($totalInvestment / $nextTarget) * 100) : 0;
  @endphp
  <a href="/vip" style="text-decoration:none;">
    <div class="emi-card">
      <div class="emi-vip-row">
        <div class="emi-card-title" style="margin-bottom:0;">Nível VIP</div>
        <span class="emi-vip-badge">VIP {{ $vipLevel }}</span>
      </div>
      <div style="margin-bottom:6px;">
        <div class="emi-vip-next">Próximo nível: VIP {{ $nextVipLevel }}</div>
      </div>
      <div class="emi-progress-track">
        <div class="emi-progress-fill" style="width: {{ number_format($progressPercent, 2) }}%;"></div>
      </div>
      <div class="emi-progress-text">
        {{ number_format($totalInvestment, 2) }} / {{ number_format($nextTarget, 2) }}
      </div>
    </div>
  </a>

  <!-- ══════════════════════════════════════
       ANNOUNCEMENT / NOTICE STRIP
  ══════════════════════════════════════ -->
  <div class="emi-notice-strip">
    <svg class="notice-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
    </svg>
    <span class="notice-text" id="notice_content_display">
      Bem-vindo à EMI – Enoteca Millesimi. Invista com confiança.
    </span>
  </div>

  <!-- ══════════════════════════════════════
       ACTION CARDS
  ══════════════════════════════════════ -->
  <div class="emi-section-title">Recompensas &amp; Atividades</div>

  <!-- Check-in -->
  <div class="emi-action-card">
    <div class="ac-text">
      <div class="ac-title">Registrar Presença</div>
      <div class="ac-desc">Check-in diário: {{price(setting('checkin'))}}</div>
    </div>
    <button class="emi-go-btn" onclick="checkin()">Registrar →</button>
  </div>

  <!-- Sorteio -->
  <a href="/lottery" style="text-decoration:none;">
    <div class="emi-action-card">
      <div class="ac-text">
        <div class="ac-title">Sorteio</div>
        <div class="ac-desc">A roda da sorte gira com grandes prêmios</div>
      </div>
      <span class="emi-go-btn">Ir →</span>
    </div>
  </a>

  <!-- Mission Rewards (two-col) -->
  <div class="emi-two-col">
    <div class="emi-half-card">
      <div class="hc-title">Convidar Amigos</div>
      <div class="hc-desc">Convide e ganhe comissões</div>
      <a href="/team" class="emi-go-btn" style="display:inline-block;padding:7px 14px;font-size:12px;">Ir →</a>
    </div>
    <div class="emi-half-card">
      <div class="hc-title">Recompensa de Tarefas</div>
      <div class="hc-desc">Complete tarefas e receba bônus</div>
      <a href="/tasks" class="emi-go-btn" style="display:inline-block;padding:7px 14px;font-size:12px;">Ir →</a>
    </div>
  </div>

  <!-- My Team -->
  <a href="/team" style="text-decoration:none;">
    <div class="emi-action-card">
      <div class="ac-text">
        <div class="ac-title">Minha Equipe</div>
        <div class="ac-desc">Monte sua equipe e ganhe mais</div>
      </div>
      <span class="emi-go-link">Ir →</span>
    </div>
  </a>

  <!-- Hidden copy link -->
  <textarea style="height: 1px;opacity: 0;position:absolute;" name="copyTxt" id="copyTxt" readonly>{{url('register').'?ref='.auth()->user()->ref_id}}</textarea>

  <!-- ══════════════════════════════════════
       GENERAL REMINDER DIALOG
  ══════════════════════════════════════ -->
  <div id="dialog" class="dialog" style="display: none">
    <div class="dialog_title">
      <img class="dialog_icon" src="/v2/img/common/dialog_icon.png"> Lembrete
    </div>
    <div class="dialog_contents">
      <p class="text" id="dialog_text"></p>
    </div>
    <div class="btn_group">
      <div class="cancel">Cancelar</div>
      <a href="" id="jump_url" class="confirm">Depositar</a>
    </div>
  </div>

  <!-- ══════════════════════════════════════
       TELEGRAM POPUP
  ══════════════════════════════════════ -->
  <div class="emi-tg-shade" id="emi-tg-shade"></div>
  <div class="emi-tg-popup" id="emi-tg-popup">
    <button class="tg-close" id="emi-tg-close" aria-label="Fechar">×</button>
    <div class="tg-icon">
      <svg viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.248l-2.04 9.614c-.15.677-.546.843-1.107.524l-3.067-2.26-1.48 1.424c-.163.163-.3.3-.616.3l.22-3.118 5.674-5.124c.247-.22-.054-.34-.384-.12L7.418 14.29l-3.007-.938c-.654-.204-.667-.654.137-.968l11.735-4.524c.545-.197 1.022.133.845.967l-.566-.58z"/>
      </svg>
    </div>
    <div class="tg-title">Informações Oficiais</div>
    <div class="tg-text">Siga nosso canal oficial do Telegram para receber as últimas notícias e benefícios exclusivos.</div>
    <a href="{{setting('telegram')}}" class="tg-btn">Seguir Agora</a>
  </div>

  <!-- ══════════════════════════════════════
       PRODUCT PURCHASE DIALOG (LAYUI FORM)
       Bottom-sheet overlay — hidden by default
  ══════════════════════════════════════ -->
  <div class="emi-dialog-overlay" id="product_dialog_overlay">
    <div class="emi-dialog-sheet">
      <div class="sheet-handle"></div>
      <div id="product_dialog" class="layui-form">
        <input type="hidden" id="product_id" name="product_id">

        <!-- Header: image + name + vip badge -->
        <div class="emi-dialog-header">
          <img src="/v2/img/index/product.png" class="product_dialog_image">
          <div>
            <div class="product_title">Canal Oficial</div>
            <div class="product_vip_btn">
              <img class="product_vip_icon" src="/v2/img/vip/lv0.png" style="height:14px;width:14px;margin-right:2px">
              <span class="vip_level">VIP0</span>
            </div>
          </div>
        </div>

        <!-- Product info rows -->
        <div class="emi-dialog-info product_information">
          <div class="emi-dialog-row product_item">
            <p class="label">Preço Unitário</p>
            <p class="value product_price">MIL1000</p>
          </div>
          <div class="emi-dialog-row product_item">
            <p class="label">Rendimento</p>
            <p class="value product_days">30</p>
          </div>
          <div class="emi-dialog-row product_item">
            <p class="label">Renda Diária</p>
            <p class="value product_daily_income">MIL100</p>
          </div>
          <div class="emi-dialog-row product_item">
            <p class="label">Renda Total</p>
            <p class="value product_total_income">MIL3000</p>
          </div>
          <div class="emi-dialog-row product_item">
            <p class="label">Investimento Máximo</p>
            <p class="value product_maximum_share">10</p>
          </div>
        </div>

        <!-- Buy quantity + totals -->
        <div class="buy_information">
          <div class="emi-dialog-row product_item" style="align-items:center;padding:10px 0;">
            <p class="label" style="line-height:30px;margin:0;">Quantidade</p>
            <p class="value buy_share" style="margin:0;font-size:13px;color:#6B6B6B;"></p>
            <div class="layui-input-wrap">
              <input type="number" name="buy_share" id="buy_num" value="1" lay-precision="0" lay-affix="number" lay-filter="number" readonly placeholder="Quantidade" step="1" min="1" class="layui-input" style="height:32px;line-height:32px;border-color:#E8DCC8;">
              <div class="layui-input-affix layui-input-split layui-input-number layui-input-suffix">
                <i class="layui-icon layui-icon-up"></i>
                <i class="layui-icon layui-icon-down"></i>
              </div>
            </div>
          </div>
          <div class="emi-dialog-row product_item">
            <p class="label">Valor a Pagar</p>
            <p class="value product_pay_money">MIL100</p>
          </div>
          <div class="emi-dialog-row product_item">
            <p class="label">Rendimento Total Estimado</p>
            <p class="value product_pay_total_income">MIL3000</p>
          </div>
        </div>

        <button class="buy_btn" type="submit" lay-submit="" lay-filter="buy_product">Investir Agora</button>
      </div>
    </div>
  </div>

  <!-- Layui internals kept for JS compatibility -->
  <div class="layui-layer-move" id="layui-layer-move"></div>

  <!-- Notice content hidden textarea -->
  <textarea id="notice_content" style="display:none"></textarea>

  @include('app.layout.menu')

</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@include('alert-message')

<script>
// ── Utility ──────────────────────────────────────────
function copyLink(text) {
    const body = document.body;
    const input = document.createElement("input");
    body.append(input);
    input.style.opacity = 0;
    input.value = text.replaceAll(' ', '');
    input.select();
    input.setSelectionRange(0, input.value.length);
    document.execCommand("Copy");
    input.blur();
    input.remove();
    message('Copiado com sucesso!');
}

function checkin() {
    window.location.href = '{{ route("user.checkin") }}';
}

// ── Telegram popup close ─────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const tgPopup = document.getElementById('emi-tg-popup');
    const tgShade = document.getElementById('emi-tg-shade');
    const tgClose = document.getElementById('emi-tg-close');

    // Auto-show telegram popup (same behaviour as original)
    if (tgPopup && tgShade) {
        tgPopup.classList.add('active');
        tgShade.classList.add('active');
    }

    if (tgClose) {
        tgClose.addEventListener('click', function () {
            tgPopup.classList.remove('active');
            tgShade.classList.remove('active');
        });
    }
    if (tgShade) {
        tgShade.addEventListener('click', function () {
            tgPopup.classList.remove('active');
            tgShade.classList.remove('active');
        });
    }

    // ── Product dialog overlay close on outside click ──
    const overlay = document.getElementById('product_dialog_overlay');
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                overlay.classList.remove('active');
            }
        });
    }
});

// ── Open product dialog (called from product list pages) ──
function openProductDialog(productId) {
    document.getElementById('product_id').value = productId;
    document.getElementById('product_dialog_overlay').classList.add('active');
}
</script>
