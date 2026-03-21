<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Sorteio Diário – EMI</title>
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
.emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:12px 20px;font-weight:700;font-size:15px;cursor:pointer;display:block;width:100%;text-align:center}
.emi-label{font-size:12px;color:#6B6B6B}
.emi-gold{color:#C8A96A}
.flex-between{display:flex;justify-content:space-between;align-items:center}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

.lucky-hero{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:28px 16px 24px;text-align:center;color:#fff}
.lucky-hero-title{font-family:'Playfair Display',serif;font-size:24px;font-weight:700;margin-bottom:6px}
.lucky-hero-sub{font-size:13px;color:rgba(255,255,255,0.85)}
.lucky-icon-wrap{width:80px;height:80px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:38px}

.page-padding{padding:16px}

.lucky-input{width:100%;padding:13px 14px;border-radius:8px;border:1.5px solid #E8DCC8;font-size:15px;background:#fff;color:#1C1C1C;outline:none;margin-bottom:14px}
.lucky-input:focus{border-color:#C8A96A}

.rules-list{list-style:none;margin:0;padding:0}
.rules-list li{font-size:13px;color:#6B6B6B;padding:6px 0;border-bottom:1px solid #F0EBE0;display:flex;gap:8px}
.rules-list li:last-child{border-bottom:none}
.rules-list li::before{content:"•";color:#C8A96A;font-weight:700;flex-shrink:0}

.history-link{display:flex;align-items:center;justify-content:center;gap:6px;margin-top:16px;color:#C8A96A;font-weight:600;font-size:14px;text-decoration:none}

.info-row{display:flex;gap:10px;margin-bottom:14px}
.info-badge{flex:1;background:#F5EDD8;border-radius:8px;padding:10px;text-align:center}
.info-badge-label{font-size:11px;color:#8A6C2A;font-weight:600}
.info-badge-value{font-size:14px;font-weight:700;color:#C8A96A;margin-top:3px}

.section-title{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;margin-bottom:12px}
</style>
</head>
<body>

<div class="emi-header" style="padding-bottom:0">
    <a href="{{ route('dashboard') }}" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Sorteio Diário
    </a>
</div>

<!-- Hero Section -->
<div class="lucky-hero">
    <div class="lucky-icon-wrap">🎰</div>
    <div class="lucky-hero-title">Sorte da Fortuna</div>
    <div class="lucky-hero-sub">Use seu código para girar e ganhar prêmios diários</div>
</div>

<div class="page-padding">

    <!-- Info Badges -->
    <div class="info-row">
        <div class="info-badge">
            <div class="info-badge-label">Valor da Sorte</div>
            <div class="info-badge-value">1 – 5</div>
        </div>
        <div class="info-badge">
            <div class="info-badge-label">Sorteios Acumulados</div>
            <div class="info-badge-value">1 – 1</div>
        </div>
        <div class="info-badge">
            <div class="info-badge-label">Prêmio Máximo</div>
            <div class="info-badge-value">50</div>
        </div>
    </div>

    <!-- Code Input Card -->
    <div class="emi-card">
        <div class="section-title">Inserir Código de Sorteio</div>
        <input type="text" name="code" class="lucky-input" placeholder="Digite seu código da sorte">
        <button class="emi-btn" onclick="StartLucky()">Obter Oportunidade de Sorteio</button>
    </div>

    <!-- History Link -->
    <a href="{{ route('checkin.history') }}" class="history-link">
        Ver Histórico de Sorteios <span style="font-size:18px">›</span>
    </a>

    <!-- Rules Card -->
    <div class="emi-card" style="margin-top:16px">
        <div class="section-title">Como Funciona</div>
        <ul class="rules-list">
            <li>Você pode ganhar de 1 a 50 usando o Código de Sorte.</li>
            <li>O valor do prêmio depende da sua roda da fortuna.</li>
            <li>Acompanhe nosso grupo oficial para obter os códigos de sorteio diários.</li>
            <li>Cada código é válido para uso único apenas.</li>
        </ul>
    </div>

</div>

@include('alert-message')
@include('loading')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
function StartLucky() {
    loading();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    var code = document.querySelector('input[name="code"]').value;
    if (code == '') {
        loadingOff();
        message('Digite o código de sorteio.');
        return 0;
    }

    $.ajax({
        url: "{{ url('submit-bonus-amount') }}" + "/" + code,
        type: 'get',
        dataType: 'json',
        success: function (res) {
            document.querySelector('input[name="code"]').value = '';
            loadingOff();
            if (res.status == true) {
                msg('Sucesso!');
                setTimeout(function () {
                    msgOff();
                }, 500);
            } else {
                message(res.error);
            }
        }
    });
}
</script>
</body>
</html>
