<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Convite – EMI</title>
    <link rel="stylesheet" href="/v2/layui/css/layui.css">
    <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">

</head>
<body class="common_body common_background">
<script id="InviteTpl" type="text/html">
    <div class="common_margin_10 common_padding_10">
        <div class="label" style="color: #DEEFFF">Comissão</div>
        <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">link</div>
    </div>
    <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;">
        <img src="/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0">
        <div class="invite_friends_card_item" >
            <div class="value invite_code">Link de Convite</div>
            <div class="label" style="color: #C8A96A">link</div>
        </div>
        <div class="copy_btn" id="copy" style="text-align: center">
            Copiar
        </div>
    </div>
</script>
 
<div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
        Convite    </a>
</div>
<div class="common_margin_15" id="invite_friends_card"> <div class="common_margin_10 common_padding_10"> <div class="label" style="color: #DEEFFF">Comissão</div> <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">{{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'task')->sum('amount')) }}</div> </div> <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;"> <img src="/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0"> <div class="invite_friends_card_item"> <div class="value invite_code">Link de Convite</div> <div class="label" style="color: #C8A96A">{{url('register').'?ref='.auth()->user()->ref_id}}</div> </div> <div class="copy_btn" id="copy" style="text-align: center" onclick="copyLink('{{url('register').'?ref='.auth()->user()->ref_id}}')"> Copiar </div> </div> </div>
<div style="padding: 15px;;padding-top: 0px">

    <a href="/team" class="my_team_card">
        <div class="title">Minha Equipe</div>
        <div class="desc">Monte sua equipe e ganhe ainda mais</div>
        <div class="go_btn flex_space">
            <p>Ir</p> <img src="/v2/img/tasks/go.png">
        </div>
    </a>
    <a href="/tasks" class="daily_tasks_card">
        <div class="title">Recompensa de Tarefas</div>
        <div class="desc">Conclua tarefas e receba bônus diários</div>
        <div class="go_btn flex_space">
            <p>Ir</p> <img src="/v2/img/tasks/go.png">
        </div>
    </a>
    <a href="/lottery" class="tasks_lottery_card">
        <div class="title">Sorteio da Sorte</div>
        <div class="desc">A roda da fortuna gira com grandes prêmios</div>
        <div class="go_btn flex_space">
            <p>Ir</p> <img src="/v2/img/tasks/go.png">
        </div>
    </a>

</div>

<div class="tasks_reward_text_card" id="tasks_reward_text_card"> <div class="tasks_reward_title">Clube dos Milionários</div> <div class="tasks_reward_text">1. Convidar amigos e fazer com que invistam com sucesso dará a você chances no sorteio da sorte.</div> <div class="tasks_reward_text">2. Você receberá recompensas sobre os investimentos dos indicados:</div> <div class="tasks_reward_text">(Nível 1): Taxa de comissão de 35%</div> <div class="tasks_reward_text">(Nível 2): Taxa de comissão de 2%</div> <div class="tasks_reward_text">(Nível 3): Taxa de comissão de 1%</div> <div class="tasks_reward_text">Se você convidar 100 usuários e eles investirem 10.000 na plataforma, sua renda será: 1.000.000 * 38% = 380.000</div> <div class="tasks_reward_text">Cada promotor excelente pode ganhar pelo menos 1.000.000 por mês</div> <div class="tasks_reward_text">Entre em contato com o atendimento ao cliente para obter as últimas formas de ganhar dinheiro</div> </div>
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
<textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly=""></textarea>
<div class="footer_menu">

    <div class="content">
        <a href="/" class="item active" style="margin-top: 10px;">
            <img src="/v2/img/footer/home_active.png">
            <p>Início</p>
        </a>
        <a href="/product" class="item " style="margin-top: 10px;">
            <img src="/v2/img/footer/invest.png">
            <p>Investir</p>
        </a>
        <a href="/invitation" class="item" style="padding: 0px;position: relative">
            <img src="/v2/img/footer/invite.png" style="width:80px;height: 80px;margin-top: -25px; ">
        </a>
        <a href="/blog" class="item " style="margin-top: 10px;">
            <img src="/v2/img/footer/blog.png">
            <p>Blog</p>
        </a>
        <a href="/my" class="item " style="margin-top: 10px;">
            <img src="/v2/img/footer/account.png">
            <p>Conta</p>
        </a>
    </div>
</div>
<script src="/v2/layui/layui.js"></script>
<script src="/v2/js/invite.js"></script>


<div class="loader" style="
    position: fixed;
    display: none;
    top: 50%;
    z-index: 99;
    width: 143px;
    border-radius: 15px;
    overflow: hidden;
    left: 50%;
    transform: translate(-50%, -50%);
">
    <img src="{{asset('public/loading.gif')}}" style="width: 100%;" alt="">
</div>

@include('alert-message')
<script>
    function copyLink(text)
    {
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