<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Recompensas – EMI</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
.emi-label{font-size:12px;color:#6B6B6B}
.emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
.emi-gold{color:#C8A96A}
.flex-between{display:flex;justify-content:space-between;align-items:center}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
.progress-bar-bg{background:#E8DCC8;border-radius:4px;height:8px;overflow:hidden}
.progress-bar-fill{background:linear-gradient(90deg,#C8A96A,#D6A86B);height:8px;border-radius:4px;transition:width .3s}

.tab-row{display:flex;background:#fff;border:1px solid #E8DCC8;border-radius:10px;overflow:hidden;margin:16px;box-shadow:0 2px 8px rgba(200,169,106,.1)}
.tab-btn{flex:1;text-align:center;padding:12px 6px;font-size:14px;font-weight:600;color:#6B6B6B;cursor:pointer;border:none;background:transparent}
.tab-btn.on{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);color:#fff}

.tab-content{display:none;padding:0 16px 20px}
.tab-content.active{display:block}

.reward-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:16px;margin-bottom:12px}
.reward-stats{display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px;margin-bottom:14px}
.reward-stat{text-align:center;background:#F8F6F2;border-radius:8px;padding:10px 6px}
.reward-stat-value{font-family:'Playfair Display',serif;font-size:18px;font-weight:700;color:#C8A96A}
.reward-stat-label{font-size:11px;color:#6B6B6B;margin-top:3px}

.claim-btn{display:block;width:100%;padding:11px;background:#C8A96A;color:#fff;font-weight:700;text-align:center;border:none;border-radius:8px;cursor:pointer;font-size:14px;margin-top:12px}
.claim-btn.disabled{background:#E8DCC8;color:#999;cursor:default}

.section-label{font-family:'Playfair Display',serif;font-size:14px;font-weight:700;color:#1C1C1C;margin-bottom:12px}
</style>
</head>
<body>

<div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Recompensas
    </a>
</div>

<!-- Tab Navigation -->
<div class="tab-row">
    <button class="tab-btn on" onclick="showTab(event,'daily')">Recompensa Diária</button>
    <button class="tab-btn" onclick="showTab(event,'teams')">Recompensa de Equipe</button>
</div>

<!-- Daily Reward Tab -->
<div id="daily" class="tab-content active">
    @php
        $rewards = [
            ['bonus' => 100, 'required_invites' => 3],
            ['bonus' => 200, 'required_invites' => 5],
            ['bonus' => 500, 'required_invites' => 10],
            ['bonus' => 1000, 'required_invites' => 20],
        ];
    @endphp

    <div class="section-label">Recompensas por Convite</div>

    @foreach ($rewards as $reward)
        @php
            $claimed = in_array($reward['bonus'], $claimed_rewards);
            $progress = min(($first_level_invite_count / $reward['required_invites']) * 100, 100);
            $can_claim = !$claimed && $first_level_invite_count >= $reward['required_invites'];
        @endphp
        <div class="reward-card">
            <div class="reward-stats">
                <div class="reward-stat">
                    <div class="reward-stat-value">{{ $reward['bonus'] }}</div>
                    <div class="reward-stat-label">Bônus</div>
                </div>
                <div class="reward-stat">
                    <div class="reward-stat-value">{{ $first_level_invite_count }} / {{ $reward['required_invites'] }}</div>
                    <div class="reward-stat-label">Convites</div>
                </div>
                <div class="reward-stat">
                    <div class="reward-stat-value">{{ number_format($progress, 0) }}%</div>
                    <div class="reward-stat-label">Concluído</div>
                </div>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width:{{ $progress }}%"></div>
            </div>
            <button type="button"
                class="claim-btn {{ !$can_claim ? 'disabled' : '' }}"
                data-id="{{ $reward['bonus'] }}"
                {{ !$can_claim ? 'disabled' : '' }}>
                {{ $claimed ? 'Resgatado' : 'Resgatar' }}
            </button>
        </div>
    @endforeach
</div>

<!-- Team Reward Tab -->
<div id="teams" class="tab-content">
    @php
        $team_rewards = [
            ['bonus' => 300,   'required_invites' => 3,  'required_teams' => 10],
            ['bonus' => 2000,  'required_invites' => 10, 'required_teams' => 50],
            ['bonus' => 8000,  'required_invites' => 20, 'required_teams' => 100],
            ['bonus' => 15000, 'required_invites' => 30, 'required_teams' => 300],
            ['bonus' => 30000, 'required_invites' => 50, 'required_teams' => 500],
            ['bonus' => 50000, 'required_invites' => 60, 'required_teams' => 1000],
        ];
    @endphp

    <div class="section-label">Recompensas de Equipe</div>

    @foreach ($team_rewards as $reward)
        @php
            $can_claim_team = $first_level_invite_count >= $reward['required_invites'] && $total_count >= $reward['required_teams'];
        @endphp
        <div class="reward-card">
            <div class="reward-stats">
                <div class="reward-stat">
                    <div class="reward-stat-value">{{ $reward['bonus'] }}</div>
                    <div class="reward-stat-label">Bônus</div>
                </div>
                <div class="reward-stat">
                    <div class="reward-stat-value">{{ $first_level_invite_count }} / {{ $reward['required_invites'] }}</div>
                    <div class="reward-stat-label">Convites</div>
                </div>
                <div class="reward-stat">
                    <div class="reward-stat-value">{{ $total_count }} / {{ $reward['required_teams'] }}</div>
                    <div class="reward-stat-label">Membros</div>
                </div>
            </div>
            <button type="button"
                class="claim-btn {{ !$can_claim_team ? 'disabled' : '' }}"
                data-id="{{ $reward['bonus'] }}"
                {{ !$can_claim_team ? 'disabled' : '' }}>
                {{ $can_claim_team ? 'Resgatar' : 'Resgatado' }}
            </button>
        </div>
    @endforeach
</div>

@include('app.layout.menu')

<script>
function showTab(event, tabName) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('on'));
    document.getElementById(tabName).classList.add('active');
    event.currentTarget.classList.add('on');
}

document.querySelectorAll('.claim-btn').forEach(button => {
    button.addEventListener('click', function () {
        const bonus = this.getAttribute('data-id');
        if (!this.classList.contains('disabled')) {
            fetch("{{ route('claim.reward') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ bonus: bonus })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    this.innerText = 'Resgatado';
                    this.classList.add('disabled');
                    this.setAttribute('disabled', true);
                    location.reload();
                }
            })
            .catch(error => {
                alert('Ocorreu um erro. Tente novamente.');
            });
        }
    });
});
</script>

</body>
</html>
