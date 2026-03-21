<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Conta – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
    body { background: #F8F6F2; color: #1C1C1C; margin: 0; padding: 0 0 80px 0; }
    h1,h2,h3,.playfair { font-family: 'Playfair Display', serif; }

    /* ── Profile Header (tall, ~130px) ── */
    .emi-profile-header {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      padding: 20px 16px 24px;
      position: relative;
    }
    .emi-profile-header .header-top-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 14px;
    }
    .emi-profile-header .user-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .emi-profile-header .user-avatar {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      border: 2px solid rgba(255,255,255,0.6);
      object-fit: cover;
    }
    .emi-profile-header .user-info .user-phone {
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      line-height: 1.3;
    }
    .emi-profile-header .user-info .user-ref {
      font-size: 12px;
      color: rgba(255,255,255,0.8);
      margin-top: 3px;
    }
    .emi-profile-header .header-actions {
      display: flex;
      gap: 8px;
      align-items: center;
    }
    .emi-icon-btn {
      background: rgba(255,255,255,0.25);
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
      flex-shrink: 0;
    }
    .emi-icon-btn svg { width: 18px; height: 18px; }

    /* VIP badge in header bottom */
    .emi-header-vip-row {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .emi-header-vip-badge {
      background: rgba(255,255,255,0.25);
      border: 1px solid rgba(255,255,255,0.5);
      color: #fff;
      font-size: 12px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 20px;
      letter-spacing: 0.5px;
    }
    .emi-header-active-tag {
      background: rgba(255,255,255,0.15);
      color: rgba(255,255,255,0.9);
      font-size: 11px;
      padding: 3px 8px;
      border-radius: 20px;
    }

    /* ── Shared Card ── */
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

    /* ── VIP Progress Card ── */
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
    .emi-vip-img {
      width: 40px;
      height: 40px;
      flex-shrink: 0;
    }

    /* ── Saldo (3-col stat) Card ── */
    .emi-stat-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 0;
    }
    .emi-stat-col {
      text-align: center;
      padding: 4px 6px;
    }
    .emi-stat-col:not(:last-child) {
      border-right: 1px solid #E8DCC8;
    }
    .emi-stat-label {
      font-size: 11px;
      color: #6B6B6B;
      line-height: 1.4;
      margin-bottom: 4px;
    }
    .emi-stat-value {
      font-size: 15px;
      font-weight: 700;
      color: #C8A96A;
    }
    .emi-stat-section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 12px;
      border-bottom: 1px solid #F0E8D8;
      margin-bottom: 12px;
    }
    .emi-stat-section-header .sec-title {
      font-weight: 700;
      font-size: 14px;
      color: #1C1C1C;
    }
    .emi-stat-section-header .sec-link {
      font-size: 12px;
      color: #C8A96A;
      text-decoration: none;
      font-weight: 600;
    }

    /* ── Deposit / Withdraw Buttons ── */
    .emi-action-row {
      display: flex;
      gap: 12px;
      margin: 0 16px 12px;
    }
    .emi-action-row a {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #fff;
      border-radius: 10px;
      padding: 14px 10px;
      font-weight: 700;
      font-size: 14px;
      text-decoration: none;
      box-shadow: 0 2px 8px rgba(200,169,106,0.3);
    }
    .emi-action-row a svg { width: 18px; height: 18px; flex-shrink: 0; }

    /* ── 4-icon nav grid ── */
    .emi-icon-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      margin: 0 16px 12px;
    }
    .emi-icon-grid-item {
      background: #fff;
      border: 1px solid #E8DCC8;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(200,169,106,0.1);
      padding: 14px 6px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      text-decoration: none;
    }
    .emi-icon-grid-item .icon-circle {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: #FBF5E6;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .emi-icon-grid-item .icon-circle svg {
      width: 20px;
      height: 20px;
      color: #C8A96A;
    }
    .emi-icon-grid-item .icon-label {
      font-size: 11px;
      color: #1C1C1C;
      font-weight: 500;
      text-align: center;
      line-height: 1.3;
    }

    /* ── Service Menu List ── */
    .emi-menu-section-title {
      font-family: 'Playfair Display', serif;
      font-size: 15px;
      font-weight: 700;
      color: #1C1C1C;
      padding: 4px 16px 10px;
    }
    .emi-menu-list {
      background: #fff;
      border: 1px solid #E8DCC8;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(200,169,106,0.15);
      margin: 0 16px 12px;
      overflow: hidden;
    }
    .emi-menu-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 16px;
      border-bottom: 1px solid #E8DCC8;
      text-decoration: none;
      color: #1C1C1C;
      transition: background 0.15s;
    }
    .emi-menu-item:last-child { border-bottom: none; }
    .emi-menu-item:hover { background: #FBF5E6; }
    .emi-menu-item .menu-icon-wrap {
      width: 34px;
      height: 34px;
      border-radius: 8px;
      background: #FBF5E6;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .emi-menu-item .menu-icon-wrap svg {
      width: 18px;
      height: 18px;
      color: #C8A96A;
    }
    .emi-menu-item .menu-text {
      flex: 1;
      font-size: 14px;
      font-weight: 500;
    }
    .emi-menu-item .menu-chevron {
      color: #C8A96A;
      flex-shrink: 0;
    }
    .emi-menu-item .menu-chevron svg {
      width: 16px;
      height: 16px;
    }
    .emi-menu-item.logout-item .menu-text { color: #C0392B; }
    .emi-menu-item.logout-item .menu-icon-wrap { background: #FDF0EF; }
    .emi-menu-item.logout-item .menu-icon-wrap svg { color: #C0392B; }
    .emi-menu-item.logout-item .menu-chevron svg { color: #C0392B; }
  </style>
</head>
<body>

  <!-- ══════════════════════════════════════
       PROFILE HEADER (~130px tall)
  ══════════════════════════════════════ -->
  @php
    $vipLevel = $user->vip_level ?? 0;
    $totalInvestment = \App\Models\Purchase::where('user_id', auth()->id())->sum('amount');

    $vipTargets = [
        1 => 500,
        2 => 1000,
        3 => 2000,
        4 => 4000,
        5 => 8000,
        6 => 16000,
        7 => 32000,
        8 => 64000,
        9 => 128000,
        10 => 256000,
    ];

    $nextVipLevel = $vipLevel < 10 ? $vipLevel + 1 : 10;
    $nextTarget = $vipTargets[$nextVipLevel] ?? $totalInvestment;

    $progressPercent = $nextTarget > 0 ? min(100, ($totalInvestment / $nextTarget) * 100) : 0;
  @endphp

  <div class="emi-profile-header">
    <!-- Top row: avatar + name + icons -->
    <div class="header-top-row">
      <div class="user-row">
        <img src="{{setting('logo')}}" alt="Avatar" class="user-avatar">
        <div class="user-info">
          <div class="user-phone">
            {{substr(auth()->user()->phone, 0, 3)}}******{{substr(strrev(auth()->user()->phone), 0, 2)}}
          </div>
          <div class="user-ref">ID: {{user()->ref_id}}</div>
        </div>
      </div>
      <div class="header-actions">
        <a href="/setting" class="emi-icon-btn" aria-label="Configurações">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </a>
        <a href="/notice" class="emi-icon-btn" aria-label="Notificações">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
        </a>
      </div>
    </div>

    <!-- VIP badge row -->
    <div class="emi-header-vip-row">
      <span class="emi-header-vip-badge">VIP {{ $vipLevel }}</span>
      <span class="emi-header-active-tag">ACTIVE</span>
    </div>
  </div>

  <!-- ══════════════════════════════════════
       VIP PROGRESS CARD
  ══════════════════════════════════════ -->
  <a href="/vip" style="text-decoration:none;">
    <div class="emi-card" style="margin-top:16px;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;">
        <div style="flex:1;margin-right:12px;">
          <div class="emi-vip-row">
            <div class="emi-card-title" style="margin-bottom:0;">Nível VIP</div>
            <span class="emi-vip-badge">VIP {{ $vipLevel }}</span>
          </div>
          <div style="font-size:12px;color:#6B6B6B;margin-bottom:10px;">
            Próximo: VIP {{ $nextVipLevel }}
          </div>
          <div class="emi-progress-track">
            <div class="emi-progress-fill" style="width: {{ number_format($progressPercent, 2) }}%;"></div>
          </div>
          <div class="emi-progress-text">
            {{ number_format($totalInvestment, 2) }} / {{ number_format($nextTarget, 2) }}
          </div>
        </div>
        <img src="/v2/img/vip/lv{{ $vipLevel }}.png" alt="VIP {{ $vipLevel }}" class="emi-vip-img">
      </div>
    </div>
  </a>

  <!-- ══════════════════════════════════════
       SALDO CARD (3-col grid)
  ══════════════════════════════════════ -->
  <div class="emi-card">
    <div class="emi-stat-section-header">
      <span class="sec-title">Minha Renda</span>
      <a href="/balanceDetails" class="sec-link">Detalhes de Renda →</a>
    </div>
    <div class="emi-stat-grid">
      <div class="emi-stat-col">
        <div class="emi-stat-label">Saldo de<br>Depósito</div>
        <div class="emi-stat-value recharge_balance">{{ price(auth()->user()->balance) }}</div>
      </div>
      <div class="emi-stat-col">
        <div class="emi-stat-label">Renda de<br>Produtos</div>
        <div class="emi-stat-value product_income">
          {{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'balance_added')->sum('amount')) }}
        </div>
      </div>
      <div class="emi-stat-col">
        <div class="emi-stat-label">Nº de<br>Pedidos</div>
        <div class="emi-stat-value order_num">
          {{ \App\Models\Purchase::where('user_id', auth()->id())->count() }}
        </div>
      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════════
       DEPOSITAR / SACAR BUTTONS
  ══════════════════════════════════════ -->
  <div class="emi-action-row">
    <a href="/recharge">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
      </svg>
      Depositar
    </a>
    <a href="/withdraw">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
      </svg>
      Sacar
    </a>
  </div>

  <!-- ══════════════════════════════════════
       4-ICON NAV GRID
  ══════════════════════════════════════ -->
  <div class="emi-icon-grid">
    <a href="/orders" class="emi-icon-grid-item">
      <div class="icon-circle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
        </svg>
      </div>
      <span class="icon-label">Meus<br>Pedidos</span>
    </a>
    <a href="/balanceDetails" class="emi-icon-grid-item">
      <div class="icon-circle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
      </div>
      <span class="icon-label">Meu<br>Extrato</span>
    </a>
    <a href="/team" class="emi-icon-grid-item">
      <div class="icon-circle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </div>
      <span class="icon-label">Minha<br>Equipe</span>
    </a>
    <a href="/add-bank" class="emi-icon-grid-item">
      <div class="icon-circle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
        </svg>
      </div>
      <span class="icon-label">Cartão<br>Bancário</span>
    </a>
  </div>

  <!-- ══════════════════════════════════════
       SERVICE MENU LIST
  ══════════════════════════════════════ -->
  <div class="emi-menu-section-title">Mais Serviços</div>
  <div class="emi-menu-list">

    <!-- VIP -->
    <a href="/vip" class="emi-menu-item">
      <div class="menu-icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 3l14 9-14 9V3z"/>
        </svg>
      </div>
      <span class="menu-text">VIP</span>
      <span class="menu-chevron">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </span>
    </a>

    <!-- Central de Ajuda -->
    <a href="/help" class="emi-menu-item">
      <div class="menu-icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
      <span class="menu-text">Central de Ajuda</span>
      <span class="menu-chevron">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </span>
    </a>

    <!-- Telegram -->
    <a href="{{setting('telegram')}}" class="emi-menu-item">
      <div class="menu-icon-wrap">
        <svg viewBox="0 0 24 24" fill="currentColor" style="width:18px;height:18px;color:#C8A96A;">
          <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 8.248l-2.04 9.614c-.15.677-.546.843-1.107.524l-3.067-2.26-1.48 1.424c-.163.163-.3.3-.616.3l.22-3.118 5.674-5.124c.247-.22-.054-.34-.384-.12L7.418 14.29l-3.007-.938c-.654-.204-.667-.654.137-.968l11.735-4.524c.545-.197 1.022.133.845.967l-.566-.58z"/>
        </svg>
      </div>
      <span class="menu-text">Telegram</span>
      <span class="menu-chevron">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </span>
    </a>

    <!-- Configurações -->
    <a href="/setting" class="emi-menu-item">
      <div class="menu-icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </div>
      <span class="menu-text">Configurações</span>
      <span class="menu-chevron">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </span>
    </a>

    <!-- Alterar Senha -->
    <a href="/mine/setting" class="emi-menu-item">
      <div class="menu-icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
        </svg>
      </div>
      <span class="menu-text">Alterar Senha</span>
      <span class="menu-chevron">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </span>
    </a>

    <!-- Sair -->
    <a href="/logout" class="emi-menu-item logout-item">
      <div class="menu-icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
      </div>
      <span class="menu-text">Sair</span>
      <span class="menu-chevron">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </span>
    </a>

  </div>

  @include('app.layout.menu')

</body>
</html>
