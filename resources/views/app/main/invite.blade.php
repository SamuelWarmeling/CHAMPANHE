<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Convite & Tarefas – EMI</title>
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
.emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:pointer;display:block;width:100%;text-align:center;text-decoration:none}
.emi-label{font-size:12px;color:#6B6B6B}
.emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
.emi-gold{color:#C8A96A}
.flex-between{display:flex;justify-content:space-between;align-items:center}
.flex-left{display:flex;align-items:center;gap:10px}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

.commission-card{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);border-radius:12px;padding:20px 16px;margin:16px;color:#fff}
.commission-label{font-size:13px;color:rgba(255,255,255,0.85)}
.commission-value{font-family:'Playfair Display',serif;font-size:28px;font-weight:700;color:#fff;margin-top:6px}

.invite-link-text{font-size:12px;color:#C8A96A;word-break:break-all;margin-top:4px;line-height:1.5}

.nav-card-row{display:grid;grid-template-columns:1fr;gap:10px;padding:0 16px}
.nav-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:16px;display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:#1C1C1C}
.nav-card-left .nav-card-title{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C}
.nav-card-left .nav-card-desc{font-size:12px;color:#6B6B6B;margin-top:4px}
.nav-card-arrow{font-size:18px;color:#C8A96A;font-weight:700}

.rules-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;padding:16px;margin:12px 16px}
.rules-title{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;margin-bottom:10px}
.rules-text{font-size:13px;color:#6B6B6B;line-height:1.7;margin-bottom:6px}
.rules-highlight{color:#C8A96A;font-weight:600}
</style>
</head>
<body>

<div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Convite &amp; Tarefas
    </a>
</div>

<!-- Hidden template scripts preserved -->
<script id="InviteTpl" type="text/html">
    <div class="common_margin_10 common_padding_10">
        <div class="label" style="color: #FFFFFF">Comissão</div>
        <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">link</div>
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

<script id="TasksRewardTpl" type="text/html">
    <div class="tasks_reward_title">Clube dos Milionários</div>
    <div class="tasks_reward_text">1. Convidar amigos e fazê-los investir com sucesso dará a você uma chance no sorteio da sorte.</div>
    <div class="tasks_reward_text">2. Você receberá recompensas sobre os valores investidos pelos indicados:</div>
    <div class="tasks_reward_text">(Nível 1): Taxa de comissão de 35%</div>
    <div class="tasks_reward_text">(Nível 2): Taxa de comissão de 2%</div>
    <div class="tasks_reward_text">(Nível 3): Taxa de comissão de 1%</div>
    <div class="tasks_reward_text">Se você convidar 100 usuários e eles investirem 10.000 na plataforma, sua renda será: 1.000.000 × 38% = 380.000</div>
    <div class="tasks_reward_text">Cada promotor excelente pode ganhar no mínimo 1.000.000 por mês</div>
    <div class="tasks_reward_text">Entre em contato com o atendimento ao cliente para obter as últimas formas de ganhar</div>
</script>

<!-- Commission Summary -->
<div class="commission-card">
    <div class="commission-label">Comissão de Tarefas Acumulada</div>
    <div class="commission-value">{{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'task')->sum('amount')) }}</div>
</div>

<!-- Invite Link Card -->
<div style="padding:0 16px;margin-bottom:16px">
    <div class="emi-card">
        <div class="flex-left" style="gap:10px">
            <div style="width:40px;height:40px;background:#F5EDD8;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <img src="/v2/img/team/link_icon.png" style="width:24px;height:24px">
            </div>
            <div style="flex:1;min-width:0">
                <div style="font-size:13px;font-weight:600;color:#1C1C1C">Link de Convite</div>
                <div class="invite-link-text">{{ url('register').'?ref='.auth()->user()->ref_id }}</div>
            </div>
        </div>
        <button class="emi-btn" style="margin-top:14px" onclick="copyLink('{{ url('register').'?ref='.auth()->user()->ref_id }}')">
            Copiar Link
        </button>
    </div>
</div>

<!-- Navigation Cards -->
<div class="nav-card-row">
    <a href="/team" class="nav-card">
        <div class="nav-card-left">
            <div class="nav-card-title">Minha Equipe</div>
            <div class="nav-card-desc">Monte sua equipe e ganhe ainda mais</div>
        </div>
        <div class="nav-card-arrow">›</div>
    </a>
    <a href="/tasks" class="nav-card">
        <div class="nav-card-left">
            <div class="nav-card-title">Recompensa de Tarefas</div>
            <div class="nav-card-desc">Conclua tarefas e receba bônus diários</div>
        </div>
        <div class="nav-card-arrow">›</div>
    </a>
    <a href="/lottery" class="nav-card">
        <div class="nav-card-left">
            <div class="nav-card-title">Sorteio da Sorte</div>
            <div class="nav-card-desc">A roda da fortuna gira com grandes prêmios</div>
        </div>
        <div class="nav-card-arrow">›</div>
    </a>
</div>

<!-- Rules Card -->
<div class="rules-card">
    <div class="rules-title">Clube dos Milionários</div>
    <div class="rules-text">1. Convidar amigos e fazer com que invistam com sucesso dará a você chances no sorteio da sorte.</div>
    <div class="rules-text">2. Você receberá recompensas sobre os investimentos dos indicados:</div>
    <div class="rules-text"><span class="rules-highlight">(Nível 1):</span> Taxa de comissão de 35%</div>
    <div class="rules-text"><span class="rules-highlight">(Nível 2):</span> Taxa de comissão de 2%</div>
    <div class="rules-text"><span class="rules-highlight">(Nível 3):</span> Taxa de comissão de 1%</div>
    <hr style="border:none;border-top:1px solid #E8DCC8;margin:10px 0">
    <div class="rules-text">Se você convidar 100 usuários e eles investirem 10.000 na plataforma, sua renda será: 1.000.000 * 38% = <span class="rules-highlight">380.000</span></div>
    <div class="rules-text">Cada promotor excelente pode ganhar pelo menos <span class="rules-highlight">1.000.000</span> por mês.</div>
    <div class="rules-text">Entre em contato com o atendimento ao cliente para obter as últimas formas de ganhar dinheiro.</div>
</div>

<textarea style="height:1px;opacity:0" name="copyTxt" id="copyTxt" readonly=""></textarea>

@include('app.layout.menu')

<div class="loader" style="position:fixed;display:none;top:50%;z-index:99;width:143px;border-radius:15px;overflow:hidden;left:50%;transform:translate(-50%,-50%)">
    <img src="{{ asset('public/loading.gif') }}" style="width:100%" alt="">
</div>

@include('alert-message')

<script src="/v2/layui/layui.js"></script>
<script src="/v2/js/invite.js"></script>
<script>
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
    mes('Copied success..')
}
</script>
</body>
</html>
