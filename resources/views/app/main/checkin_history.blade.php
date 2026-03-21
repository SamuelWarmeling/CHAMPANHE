<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Histórico de Check-in – EMI</title>
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
.emi-label{font-size:12px;color:#6B6B6B}
.emi-gold{color:#C8A96A}
.flex-between{display:flex;justify-content:space-between;align-items:center}
.flex-left{display:flex;align-items:center;gap:10px}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

.page-padding{padding:16px}

.summary-strip{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);border-radius:12px;padding:16px;margin-bottom:16px;display:flex;justify-content:space-around;text-align:center;color:#fff}
.strip-item-value{font-family:'Playfair Display',serif;font-size:22px;font-weight:700}
.strip-item-label{font-size:11px;color:rgba(255,255,255,0.85);margin-top:2px}

.section-header{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;margin-bottom:12px}

.record-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:14px 16px;margin-bottom:10px;display:flex;align-items:center;gap:14px}
.record-icon-wrap{width:44px;height:44px;background:#F5EDD8;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
.record-info{flex:1;min-width:0}
.record-title{font-size:14px;font-weight:700;color:#1C1C1C}
.record-date{font-size:12px;color:#6B6B6B;margin-top:3px}
.record-amount{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:#C8A96A;white-space:nowrap}
.record-badge{display:inline-block;background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600;margin-top:4px}

.empty-state{text-align:center;padding:60px 20px}
.empty-state-text{font-size:14px;color:#6B6B6B}
</style>
</head>
<body>

<div class="emi-header">
    <a href="{{ route('lucky') }}" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Histórico de Check-in
    </a>
</div>

<div class="page-padding">

    @php
        $entries = \App\Models\BonusLedger::where('user_id', auth()->id())->orderByDesc('id')->get();
        $positiveEntries = $entries->where('amount', '>', 0);
    @endphp

    <!-- Summary Strip -->
    <div class="summary-strip">
        <div>
            <div class="strip-item-value">{{ $entries->count() }}</div>
            <div class="strip-item-label">Total Registros</div>
        </div>
        <div style="width:1px;background:rgba(255,255,255,0.3)"></div>
        <div>
            <div class="strip-item-value">{{ $positiveEntries->count() }}</div>
            <div class="strip-item-label">Sortes Ganhas</div>
        </div>
        <div style="width:1px;background:rgba(255,255,255,0.3)"></div>
        <div>
            <div class="strip-item-value">{{ price($positiveEntries->sum('amount')) }}</div>
            <div class="strip-item-label">Total Ganho</div>
        </div>
    </div>

    @if($entries->isEmpty())
        <div class="empty-state">
            <div style="font-size:48px;color:#E8DCC8;margin-bottom:16px">📅</div>
            <div class="empty-state-text">Nenhum histórico de sorte registrado ainda.</div>
        </div>
    @else
        <div class="section-header">Histórico de Sorte</div>
        @foreach($entries as $element)
            @if($element->amount > 0)
            <div class="record-card">
                <div class="record-icon-wrap">🍀</div>
                <div class="record-info">
                    <div class="record-title">Sorte Diária</div>
                    <div class="record-date">{{ $element->date }}</div>
                    <span class="record-badge">Prêmio</span>
                </div>
                <div class="record-amount">{{ price($element->amount) }}</div>
            </div>
            @endif
        @endforeach
    @endif

</div>

</body>
</html>
