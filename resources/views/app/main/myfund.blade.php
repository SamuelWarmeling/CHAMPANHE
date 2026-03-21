<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Meus Fundos – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .fund-list { padding: 15px; }
    .fund-card {
      background: #fff;
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }
    .fund-header { display: flex; align-items: center; margin-bottom: 12px; }
    .fund-header img { width: 50px; height: 50px; border-radius: 8px; margin-right: 12px; }
    .fund-name { font-weight: 700; font-size: 16px; color: #1C1C1C; }
    .fund-expiry { font-size: 12px; color: #888; margin-top: 4px; }
    .fund-stats { display: flex; justify-content: space-between; margin: 10px 0; }
    .fund-stat { text-align: center; }
    .fund-stat .s { font-weight: 700; color: #C8A96A; font-size: 15px; }
    .fund-stat .n { font-size: 12px; color: #888; margin-top: 2px; }
    .fund-status {
      display: block;
      width: 100%;
      padding: 10px;
      background: #EDE8DF;
      color: #888;
      font-weight: 700;
      text-align: center;
      border: none;
      border-radius: 8px;
      font-size: 15px;
    }
  </style>
</head>
<body class="common_body">

<div class="common_header">
  <a href="javascript:history.back(-1)" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Meus Fundos
  </a>
</div>

<div class="fund-list">
  <?php
  $myFund = \App\Models\FundInvest::where('user_id', auth()->id())->where('status', 'active')->pluck('fund_id')->toArray();
  ?>
  @foreach(\App\Models\Fund::whereIn('id', $myFund)->get() as $element)
    <?php
    $activeFund = \App\Models\FundInvest::where('fund_id', $element->id)->where('status', 'active')->first();
    ?>
    <div class="fund-card">
      <div class="fund-header">
        <img src="{{ asset($element->photo) }}" alt="">
        <div>
          <div class="fund-name">{{ $element->name }}</div>
          <div class="fund-expiry">Vencimento: {{ $activeFund->validity_expired }}</div>
        </div>
      </div>
      <div class="fund-stats">
        <div class="fund-stat">
          <div class="s">{{ price($element->minimum_invest) }}</div>
          <div class="n">Faixa de Investimento</div>
        </div>
        <div class="fund-stat">
          <div class="s">{{ price($element->commission / $element->validity) }}</div>
          <div class="n">Rendimento Diário</div>
        </div>
        <div class="fund-stat">
          <div class="s">{{ price($element->commission) }}</div>
          <div class="n">Rendimento Total</div>
        </div>
        <div class="fund-stat">
          <div class="s">{{ $element->validity }} Dias</div>
          <div class="n">Período</div>
        </div>
      </div>
      <button class="fund-status" disabled>Em Andamento</button>
    </div>
  @endforeach
</div>

</body>
</html>
