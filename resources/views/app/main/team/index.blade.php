<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Equipe – EMI</title>
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
.emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:pointer;display:block;width:100%;text-align:center}
.emi-btn-outline{background:transparent;color:#C8A96A;border:1.5px solid #C8A96A;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:pointer;display:block;width:100%;text-align:center;text-decoration:none}
.emi-label{font-size:12px;color:#6B6B6B}
.emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
.emi-gold{color:#C8A96A}
.flex-between{display:flex;justify-content:space-between;align-items:center}
.flex-left{display:flex;align-items:center;gap:10px}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
.level-badge{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:3px 10px;font-size:12px;font-weight:600}
.progress-bar-bg{background:#E8DCC8;border-radius:4px;height:8px;overflow:hidden}
.progress-bar-fill{background:linear-gradient(90deg,#C8A96A,#D6A86B);height:8px;border-radius:4px;transition:width .3s}

.summary-card{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);border-radius:12px;padding:20px 16px;margin:16px;color:#fff}
.summary-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:16px}
.summary-item{background:rgba(255,255,255,0.15);border-radius:8px;padding:12px;text-align:center}
.summary-item-value{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:#fff}
.summary-item-label{font-size:11px;color:rgba(255,255,255,0.85);margin-top:4px}
.summary-total-label{font-size:13px;color:rgba(255,255,255,0.85)}
.summary-total-value{font-family:'Playfair Display',serif;font-size:26px;font-weight:700;color:#fff;margin-top:4px}

.invite-link-text{font-size:12px;color:#C8A96A;word-break:break-all;margin-top:4px;line-height:1.4}
.invite-btn-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:14px}

.level-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;padding:16px;margin-bottom:10px}
.level-card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
.level-card-title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#1C1C1C}
.level-card-badge{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:4px 12px;font-size:12px;font-weight:600}
.level-stats{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px}
.level-stat{text-align:center;background:#F8F6F2;border-radius:8px;padding:10px 6px}
.level-stat-value{font-size:18px;font-weight:700;color:#C8A96A}
.level-stat-label{font-size:11px;color:#6B6B6B;margin-top:3px}

.section-title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#1C1C1C;margin:0 16px 10px;padding-top:4px}
.team-details-link{font-size:13px;color:#C8A96A;font-weight:600;text-decoration:none}

.lv1-accent{border-left:3px solid #C8A96A}
.lv2-accent{border-left:3px solid #A0845A}
.lv3-accent{border-left:3px solid #7A6040}
</style>
</head>
<body>

<div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Equipe
    </a>
</div>

@php
    $totalCommission = $levelTotalCommission1 + $levelTotalCommission2 + $levelTotalCommission3;
@endphp

<!-- Summary Card -->
<div class="summary-card">
    <div class="summary-total-label">Comissão Total da Equipe</div>
    <div class="summary-total-value">{{ price($totalCommission) }}</div>
    <div class="summary-grid">
        <div class="summary-item">
            <div class="summary-item-value">{{ $first_level_users->count() }}</div>
            <div class="summary-item-label">Membros Nível 1</div>
        </div>
        <div class="summary-item">
            <div class="summary-item-value">{{ $second_level_users->count() }}</div>
            <div class="summary-item-label">Membros Nível 2</div>
        </div>
        <div class="summary-item">
            <div class="summary-item-value">{{ $third_level_users->count() }}</div>
            <div class="summary-item-label">Membros Nível 3</div>
        </div>
        <div class="summary-item">
            <div class="summary-item-value">{{ $first_level_users->where('investor',1)->count() + $second_level_users->where('investor',1)->count() + $third_level_users->where('investor',1)->count() }}</div>
            <div class="summary-item-label">Total Ativos</div>
        </div>
    </div>
</div>

<!-- Invite Link Card -->
<div style="padding:0 16px">
    <div class="emi-card">
        <div class="flex-between">
            <div>
                <div style="font-size:13px;font-weight:600;color:#1C1C1C">Link de Convite</div>
                <div class="invite-link-text">{{ url('register').'?ref='.auth()->user()->ref_id }}</div>
            </div>
        </div>
        <div class="invite-btn-row">
            <button class="emi-btn" onclick="copyLink('{{ url('register').'?ref='.auth()->user()->ref_id }}')">
                Copiar Link
            </button>
            <a href="/qr-code" class="emi-btn-outline">QR Code</a>
        </div>
    </div>
</div>

<!-- Team Level Section -->
<div class="section-title" style="display:flex;justify-content:space-between;align-items:center;margin-top:4px">
    <span>Nível de Equipe</span>
    <a href="/member/1" class="team-details-link">Detalhes ›</a>
</div>

<div style="padding:0 16px">

    <!-- Nível 1 -->
    <div class="level-card lv1-accent">
        <div class="level-card-header">
            <div class="level-card-title">Nível 1</div>
            <span class="level-card-badge">35% Bônus</span>
        </div>
        <div class="level-stats">
            <div class="level-stat">
                <div class="level-stat-value">35%</div>
                <div class="level-stat-label">Rebate</div>
            </div>
            <div class="level-stat">
                <div class="level-stat-value">{{ $first_level_users->count() }}</div>
                <div class="level-stat-label">Convidados</div>
            </div>
            <div class="level-stat">
                <div class="level-stat-value">{{ $first_level_users->where('investor', 1)->count() }}</div>
                <div class="level-stat-label">Ativos</div>
            </div>
        </div>
    </div>

    <!-- Nível 2 -->
    <div class="level-card lv2-accent">
        <div class="level-card-header">
            <div class="level-card-title">Nível 2</div>
            <span class="level-card-badge">2% Bônus</span>
        </div>
        <div class="level-stats">
            <div class="level-stat">
                <div class="level-stat-value">2%</div>
                <div class="level-stat-label">Rebate</div>
            </div>
            <div class="level-stat">
                <div class="level-stat-value">{{ $second_level_users->count() }}</div>
                <div class="level-stat-label">Convidados</div>
            </div>
            <div class="level-stat">
                <div class="level-stat-value">{{ $second_level_users->where('investor', 1)->count() }}</div>
                <div class="level-stat-label">Ativos</div>
            </div>
        </div>
    </div>

    <!-- Nível 3 -->
    <div class="level-card lv3-accent">
        <div class="level-card-header">
            <div class="level-card-title">Nível 3</div>
            <span class="level-card-badge">1% Bônus</span>
        </div>
        <div class="level-stats">
            <div class="level-stat">
                <div class="level-stat-value">1%</div>
                <div class="level-stat-label">Rebate</div>
            </div>
            <div class="level-stat">
                <div class="level-stat-value">{{ $third_level_users->count() }}</div>
                <div class="level-stat-label">Convidados</div>
            </div>
            <div class="level-stat">
                <div class="level-stat-value">{{ $third_level_users->where('investor', 1)->count() }}</div>
                <div class="level-stat-label">Ativos</div>
            </div>
        </div>
    </div>

</div>

<!-- Hidden template scripts preserved -->
<script id="InviteTpl" type="text/html">
    <div class="common_margin_10 common_padding_10">
        <div class="label" style="color: #FFFFFF">Comissão</div>
        <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">r600</div>
    </div>
    <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;">
        <img src="/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0">
        <div class="invite_friends_card_item">
            <div class="value invite_code">Link de Convite</div>
            <div class="label" style="color: #C8A96A">link</div>
        </div>
        <div class="copy_btn" id="copy" style="text-align: center">
            Copiar
        </div>
    </div>
</script>

<script id="TeamTpl" type="text/html">
    <div class="team_level_card">
        <a href="/member/1" class="flex_space">
            <div class="team_level_title">Nível de Equipe</div>
            <div class="team_level_details">Detalhes da Equipe ></div>
        </a>
        <div class="team_level_item_card">
            <div class="flex_space">
                <div class="team_level_top_left">Nível 1</div>
                <img src="/v2/img/team/lv1.png" class="team_level_img">
            </div>
            <div class="flex_space">
                <div class="team_level_item_list flex_space">
                    <div class="team_level_item">
                        <div class="team_level_title">5%</div>
                        <div class="team_level_details">Lv 1 Rebate</div>
                    </div>
                    <div class="team_level_item">
                        <div class="team_level_title">5</div>
                        <div class="team_level_details">Total convidados</div>
                    </div>
                    <div class="team_level_item">
                        <div class="team_level_title">5</div>
                        <div class="team_level_details">Ativos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<textarea style="height:1px;opacity:0" name="copyTxt" id="copyTxt" readonly=""></textarea>

@include('app.layout.menu')
@include('alert-message')

<script>
function copyLink(text) {
    const body = document.body;
    const input = document.createElement("input");
    input.style.position = "absolute";
    input.style.opacity = 0;
    input.value = text.replaceAll(' ', '');
    body.appendChild(input);
    input.select();
    input.setSelectionRange(0, input.value.length);
    document.execCommand("copy");
    input.remove();
    ('Copied successfully.');
}

function receivedReward(condition) {
    if (condition === true) {
        window.location.href = '{{ route("user.received.reward", ["task_id" => "__TASK_ID__"]) }}';
    } else {
        alert('Target not eligible.');
    }
}
</script>

</body>
</html>
