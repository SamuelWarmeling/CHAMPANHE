<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Comissão da Equipe – EMI</title>
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
.flex-left{display:flex;align-items:center;gap:10px}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
.level-badge{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:3px 10px;font-size:12px;font-weight:600}

.record-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:14px 16px;margin-bottom:10px}
.record-title{font-size:14px;font-weight:600;color:#1C1C1C}
.record-sub{font-size:12px;color:#6B6B6B;margin-top:3px}
.record-amount{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:#C8A96A;white-space:nowrap}
.record-date{font-size:11px;color:#6B6B6B;margin-top:4px;text-align:right}

.empty-state{text-align:center;padding:60px 20px}
.empty-state-text{font-size:14px;color:#6B6B6B}

.page-padding{padding:16px}
.section-header{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;margin-bottom:12px}

.filter-tabs{display:flex;background:#fff;border:1px solid #E8DCC8;border-radius:10px;overflow:hidden;margin-bottom:16px}
.filter-tab{flex:1;text-align:center;padding:10px 6px;font-size:13px;font-weight:600;color:#6B6B6B;cursor:pointer;border:none;background:transparent}
.filter-tab.active{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);color:#fff}
</style>
</head>
<body>

<div class="emi-header">
    <a href="{{ route('user.withdraw') }}" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Comissão da Equipe
    </a>
</div>

<div class="page-padding">

    <!-- Filter tabs by level -->
    <div class="filter-tabs">
        <button class="filter-tab active" onclick="filterLevel(this, 'all')">Todos</button>
        <button class="filter-tab" onclick="filterLevel(this, '1')">Nível 1</button>
        <button class="filter-tab" onclick="filterLevel(this, '2')">Nível 2</button>
        <button class="filter-tab" onclick="filterLevel(this, '3')">Nível 3</button>
    </div>

    @php
        $records = \App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'commission')->orderByDesc('id')->get();
    @endphp

    @if($records->isEmpty())
        <div class="empty-state">
            <div style="font-size:48px;color:#E8DCC8;margin-bottom:16px">👥</div>
            <div class="empty-state-text">Nenhuma comissão de equipe registrada ainda.</div>
        </div>
    @else
        <div class="section-header">Registros de Comissão</div>
        @foreach($records as $element)
        <div class="record-card" data-level="{{ $element->step }}">
            <div class="flex-between">
                <div style="flex:1;min-width:0">
                    <div class="record-title">Comissão de Equipe</div>
                    <div style="display:flex;align-items:center;gap:8px;margin-top:6px;flex-wrap:wrap">
                        @if($element->step)
                            <span class="level-badge">Nível {{ $element->step }}</span>
                        @endif
                        <span style="font-size:12px;color:#6B6B6B">{{ $element->perticulation }}</span>
                    </div>
                </div>
                <div style="text-align:right;margin-left:12px">
                    <div class="record-amount">{{ price($element->amount) }}</div>
                    <div class="record-date">{{ $element->created_at }}</div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

</div>

<script>
function filterLevel(btn, level) {
    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.record-card').forEach(card => {
        if (level === 'all' || card.dataset.level == level) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

</body>
</html>
