<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Recompensas – EMI</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .tab-nav {
      display: flex;
      background: #fff;
      border-radius: 12px;
      margin: 15px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }
    .tab-nav a {
      flex: 1;
      text-align: center;
      padding: 12px 0;
      color: #666;
      text-decoration: none;
      font-weight: 500;
    }
    .tab-nav a.on {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #1C1C1C;
      font-weight: 700;
    }
    .tab-content { display: none; padding: 0 15px 80px; }
    .tab-content:first-of-type { display: block; }
    .task-list {
      background: #fff;
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }
    .task-stats { display: flex; justify-content: space-around; text-align: center; margin-bottom: 12px; }
    .task-stats h3 { font-size: 18px; font-weight: 700; color: #C8A96A; }
    .task-stats span { font-size: 12px; color: #888; }
    .task-progress { background: #EDE8DF; border-radius: 100px; height: 8px; margin-bottom: 12px; overflow: hidden; }
    .task-progress-bar { background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%); height: 100%; border-radius: 100px; }
    .claim-btn {
      display: block;
      width: 100%;
      padding: 10px;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #1C1C1C;
      font-weight: 700;
      text-align: center;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 15px;
    }
    .claim-btn.disabled {
      background: #EDE8DF;
      color: #999;
      cursor: default;
    }
  </style>
</head>
<body class="common_body">

<div class="common_header">
  <a href="javascript:history.back(-1)" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Recompensas
  </a>
</div>

<div class="tab-nav">
  <a href="#" class="on" onclick="showTab(event, 'daily')">Recompensa Diária</a>
  <a href="#" onclick="showTab(event, 'teams')">Recompensa de Equipe</a>
</div>

<!-- Daily Reward Section -->
<div id="daily" class="tab-content" style="display: block;">
  @php
    $rewards = [
      ['bonus' => 100, 'required_invites' => 3],
      ['bonus' => 200, 'required_invites' => 5],
      ['bonus' => 500, 'required_invites' => 10],
      ['bonus' => 1000, 'required_invites' => 20],
    ];
  @endphp

  @foreach ($rewards as $reward)
    @php
      $claimed = in_array($reward['bonus'], $claimed_rewards);
      $progress = min(($first_level_invite_count / $reward['required_invites']) * 100, 100);
      $can_claim = !$claimed && $first_level_invite_count >= $reward['required_invites'];
    @endphp
    <div class="task-list">
      <div class="task-stats">
        <div><h3>{{ $reward['bonus'] }}</h3><span>Bônus</span></div>
        <div><h3>{{ $first_level_invite_count }} / {{ $reward['required_invites'] }}</h3><span>Convites</span></div>
        <div><h3>{{ number_format($progress, 0) }}%</h3><span>Concluído</span></div>
      </div>
      <div class="task-progress">
        <div class="task-progress-bar" style="width: {{ $progress }}%;"></div>
      </div>
      <button type="button" class="claim-btn {{ !$can_claim ? 'disabled' : '' }}" data-id="{{ $reward['bonus'] }}" {{ !$can_claim ? 'disabled' : '' }}>
        {{ $claimed ? 'Resgatado' : 'Resgatar' }}
      </button>
    </div>
  @endforeach
</div>

<!-- Team Reward Section -->
<div id="teams" class="tab-content">
  @php
    $team_rewards = [
      ['bonus' => 300, 'required_invites' => 3, 'required_teams' => 10],
      ['bonus' => 2000, 'required_invites' => 10, 'required_teams' => 50],
      ['bonus' => 8000, 'required_invites' => 20, 'required_teams' => 100],
      ['bonus' => 15000, 'required_invites' => 30, 'required_teams' => 300],
      ['bonus' => 30000, 'required_invites' => 50, 'required_teams' => 500],
      ['bonus' => 50000, 'required_invites' => 60, 'required_teams' => 1000],
    ];
  @endphp

  @foreach ($team_rewards as $reward)
    @php
      $can_claim_team = $first_level_invite_count >= $reward['required_invites'] && $total_count >= $reward['required_teams'];
    @endphp
    <div class="task-list">
      <div class="task-stats">
        <div><h3>{{ $reward['bonus'] }}</h3><span>Bônus</span></div>
        <div><h3>{{ $first_level_invite_count }} / {{ $reward['required_invites'] }}</h3><span>Convites</span></div>
        <div><h3>{{ $total_count }} / {{ $reward['required_teams'] }}</h3><span>Membros</span></div>
      </div>
      <button type="button" class="claim-btn {{ !$can_claim_team ? 'disabled' : '' }}" data-id="{{ $reward['bonus'] }}" {{ !$can_claim_team ? 'disabled' : '' }}>
        {{ $can_claim_team ? 'Resgatar' : 'Resgatado' }}
      </button>
    </div>
  @endforeach
</div>

<div class="footer_menu">
  <div class="content">
    <a href="/" class="item" style="margin-top: 10px;"><img src="/v2/img/footer/home.png"><p>Início</p></a>
    <a href="/product" class="item" style="margin-top: 10px;"><img src="/v2/img/footer/invest.png"><p>Investir</p></a>
    <a href="/invitation" class="item" style="padding: 0px;position: relative"><img src="/v2/img/footer/invite.png" style="width:80px;height: 80px;margin-top: -25px;"></a>
    <a href="/blog" class="item" style="margin-top: 10px;"><img src="/v2/img/footer/blog.png"><p>Blog</p></a>
    <a href="/my" class="item" style="margin-top: 10px;"><img src="/v2/img/footer/account.png"><p>Conta</p></a>
  </div>
</div>

<script>
function showTab(event, tabName) {
  event.preventDefault();
  document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
  document.querySelectorAll('.tab-nav a').forEach(link => link.classList.remove('on'));
  document.getElementById(tabName).style.display = 'block';
  event.currentTarget.classList.add('on');
}

document.querySelectorAll('.claim-btn').forEach(button => {
  button.addEventListener('click', function() {
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
