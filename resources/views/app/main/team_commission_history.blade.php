<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Comissão de Equipe – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .record-list {
      background: #fff;
      border-radius: 12px;
      margin: 10px 15px;
      padding: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }
    .record-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .record-item .record-title { font-weight: 600; color: #1C1C1C; margin: 0 0 4px; }
    .record-item .record-time { font-size: 12px; color: #888; }
    .record-amount { font-size: 18px; font-weight: 700; color: #C8A96A; }
    .record-date { font-size: 12px; color: #888; margin-top: 4px; text-align: right; }
  </style>
</head>
<body class="common_body">

<div class="common_header">
  <a href="{{ route('user.withdraw') }}" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Comissão de Equipe
  </a>
</div>

<div style="padding-bottom: 20px;">
  @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'commission')->orderByDesc('id')->get() as $element)
  <div class="record-list">
    <div class="record-item">
      <div>
        <p class="record-title">Comissão de Equipe</p>
        <span class="record-time">{{ $element->perticulation }}</span>
      </div>
      <div>
        <div class="record-amount">{{ price($element->amount) }}</div>
        <div class="record-date">{{ $element->created_at }}</div>
      </div>
    </div>
  </div>
  @endforeach
</div>

</body>
</html>
