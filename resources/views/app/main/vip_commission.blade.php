<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Renda de Pacotes – EMI</title>
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
.emi-label{font-size:12px;color:#6B6B6B}
.emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
.emi-gold{color:#C8A96A}
.flex-between{display:flex;justify-content:space-between;align-items:center}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
.level-badge{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:3px 10px;font-size:12px;font-weight:600}

.record-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:14px 16px;margin-bottom:10px}
.record-title{font-size:14px;font-weight:600;color:#1C1C1C}
.record-meta{font-size:12px;color:#6B6B6B;margin-top:4px}
.record-amount{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:#C8A96A;white-space:nowrap}

.empty-state{text-align:center;padding:60px 20px}
.empty-state-text{font-size:14px;color:#6B6B6B}

.page-padding{padding:16px}
.section-header{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;margin-bottom:12px}

.vip-banner{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);border-radius:12px;padding:18px 16px;margin-bottom:16px;color:#fff}
.vip-banner-title{font-family:'Playfair Display',serif;font-size:17px;font-weight:700}
.vip-banner-sub{font-size:12px;color:rgba(255,255,255,0.85);margin-top:4px}
</style>
</head>
<body>

<div class="emi-header">
    <a href="{{ route('ordered') }}" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Renda de Pacotes
    </a>
</div>

<div class="page-padding">

    <div class="vip-banner">
        <div class="vip-banner-title">Renda Diária de Pacotes</div>
        <div class="vip-banner-sub">Rendimentos gerados pelos seus pacotes activos</div>
    </div>

    <?php $commissions = \App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'daily_income')->orderByDesc('id')->get(); ?>

    @if($commissions->isEmpty())
        <div class="empty-state">
            <div style="font-size:48px;color:#E8DCC8;margin-bottom:16px">💼</div>
            <div class="empty-state-text">Nenhuma renda de pacote registrada ainda.</div>
        </div>
    @else
        <div class="section-header">Registros de Renda</div>
        @foreach($commissions as $element)
        <div class="record-card">
            <div class="flex-between">
                <div style="flex:1;min-width:0">
                    <div class="record-title">{{ $element->perticulation ?: 'Renda Diária de Pacote' }}</div>
                    <div class="record-meta">{{ $element->created_at }}</div>
                </div>
                <div class="record-amount" style="margin-left:12px">{{ price($element->amount) }}</div>
            </div>
        </div>
        @endforeach
    @endif

</div>

</body>
</html>
