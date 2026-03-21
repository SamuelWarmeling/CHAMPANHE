<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Início – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="/v2/css/common.css?t=1.2">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .layui-col-space10>* { padding: 0 5px; }
    .layui-input-affix { height: 30px !important; line-height: 30px !important; }
  </style>
 </head>
 <body>

  <div class="swiper" id="vip_swiper" style="position: relative;display: none">
   <div class="swiper-container mySwiper">
    <div class="swiper-wrapper" id="swiper-wrapper">
     <div class="swiper-slide vip_card">
      <div class="flex_space">
       <img src="/v2/img/vip/lv0.png" style="width: 40px;height: 40px;">
       <img src="{{setting('logo')}}" style="width: 40px;height: 40px;">
      </div>
      <div class="vip_text">
        Este nível VIP requer convidar
       <strong class="people_num">0</strong> pessoas, com investimento total de
       <strong class="require_buy">MIL0</strong>.
      </div>
     </div>
    </div>
   </div>
  </div>

  <div id="product_dialog" class="layui-form" style="display: none">
   <input type="hidden" id="product_id" name="product_id">
   <div class="flex_left">
    <img src="/v2/img/index/product.png" class="product_dialog_image">
    <div>
     <div class="product_title">Canal Oficial</div>
     <div class="flex_space product_vip_btn">
      <img class="product_vip_icon" src="/v2/img/vip/lv0.png" style="height: 14px;width: 14px;margin-right: 2px">
      <span class="vip_level">VIP0</span>
     </div>
    </div>
   </div>
   <div class="product_information">
    <div class="product_item flex_space">
     <p class="label">Preço Unitário</p>
     <p class="value product_price"> MIL1000 </p>
    </div>
    <div class="product_item flex_space">
     <p class="label">Rendimento</p>
     <p class="value product_days"> 30 </p>
    </div>
    <div class="product_item flex_space">
     <p class="label">Renda Diária</p>
     <p class="value product_daily_income"> MIL100 </p>
    </div>
    <div class="product_item flex_space">
     <p class="label">Renda Total</p>
     <p class="value product_total_income"> MIL3000 </p>
    </div>
    <div class="product_item flex_space">
     <p class="label">Investimento Máximo</p>
     <p class="value product_maximum_share"> 10 </p>
    </div>
   </div>
   <div class="buy_information">
    <div class="product_item flex_space" style="padding: 5px">
     <p class="label" style="line-height: 30px;">Quantidade</p>
     <p class="value position buy_share" style="width: 100px"> </p>
     <div class="layui-input-wrap">
      <input type="number" name="buy_share" id="buy_num" value="1" lay-precision="0" lay-affix="number" lay-filter="number" readonly placeholder="Quantidade" step="1" min="1" class="layui-input" style="height: 32px;line-height: 32px">
      <div class="layui-input-affix layui-input-split layui-input-number layui-input-suffix">
       <i class="layui-icon layui-icon-up"></i>
       <i class="layui-icon layui-icon-down"></i>
      </div>
     </div>
     <p></p>
    </div>
    <div class="product_item flex_space">
     <p class="label">Valor a Pagar</p>
     <p class="value product_pay_money"> MIL100 </p>
    </div>
    <div class="product_item flex_space">
     <p class="label">Rendimento Total Estimado</p>
     <p class="value product_pay_total_income"> MIL3000 </p>
    </div>
   </div>
   <button class="buy_btn" type="submit" lay-submit="" lay-filter="buy_product"> Investir Agora </button>
  </div>

  <div class="layui-layer layui-layer-page" id="layui-layer1" type="page" times="1" showtime="0" contype="object" style="z-index: 19891015; width: 325px; height: 305px; position: fixed; top: 183.5px; left: 17.5px;">
   <div class="layui-layer-content" style="height: 305px;">
    <div id="telegram_dialog" class="layui-layer-wrap">
     <div class="telegram_content">
      <div class="telegram_title">Informações Oficiais</div>
      <div class="telegram_text">
        Siga nosso canal oficial do Telegram para receber as últimas notícias e benefícios exclusivos
      </div>
      <a href="{{setting('telegram')}}" class="telegram_btn common_margin_top_20"> Seguir Agora </a>
     </div>
    </div>
   </div>
   <div class="layui-layer-setwin">
    <span class="layui-icon layui-icon-close layui-layer-close layui-layer-close2"></span>
   </div>
   <span class="layui-layer-resize"></span>
  </div>

  <div class="index_header">
   <div class="index_banner flex_space" style="margin-top: 0px">
    <div class="flex_left">
     <img src="{{setting('logo')}}" class="user_avatar" style="">
     <div>
      <div class="label user_nickname"></div>
      <div class="title user_username" style="margin-top: 10px">
       {{substr(auth()->user()->phone, 0, 3)}}******{{substr(strrev(auth()->user()->phone), 0, 2)}} ID:{{user()->ref_id}}
      </div>
     </div>
    </div>
   </div>
   <div class="index_menu">
    <div class="flex_space">
     <div>
      <div class="label">Seu Saldo</div>
      <div class="title user_balance" style="margin-top: 10px;margin-bottom: 20px;">
       {{price(auth()->user()->balance)}}
      </div>
     </div>
     <div>
      <div class="label">Renda de Produtos</div>
      <div class="title product_income" style="margin-top: 10px;margin-bottom: 20px;">
       {{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'balance_added')->sum('amount')) }}
      </div>
     </div>
    </div>
    <div class="flex_space">
     <a class="menu" href="/recharge"> <img src="/v2/img/index/recharge.png"> <p class="menu_title">Depósito</p> </a>
     <a class="menu" href="/withdraw"> <img src="/v2/img/index/withdraw.png"> <p class="menu_title">Saque</p> </a>
     <a class="menu" href="/team"> <img src="/v2/img/index/team.png"> <p class="menu_title">Equipe</p> </a>
     <a class="menu" href="/help"> <img src="/v2/img/index/blog.png"> <p class="menu_title">Suporte</p> </a>
     <a class="menu" href="{{setting('telegram')}}"> <img src="/v2/img/index/telegram.png"> <p class="menu_title">Telegram</p> </a>
    </div>
   </div>
  </div>

  <div class="index_main">
   <div class="common_h1">Recompensas de Missão</div>
   <div class="flex_space common_margin_bottom_15">
    <div class="invite_friends_card common_padding_10" style="width: 49%">
     <div class="common_card_title common_margin_bottom_5">Convidar Amigos</div>
     <div class="common_card_desc common_margin_bottom_5">Convide amigos e ganhe comissões</div>
     <a href="/team" class="common_a_btn common_margin_top_5">Ir -&gt;</a>
    </div>
    <div class="tasks_card common_padding_10" style="width: 49%">
     <div class="common_card_title common_margin_bottom_5">Recompensa de Tarefas</div>
     <div class="common_card_desc common_margin_bottom_5">Receba comissão ao completar tarefas</div>
     <a href="/tasks" class="common_a_btn common_a_btn_tasks common_margin_top_5">Ir -&gt;</a>
    </div>
   </div>
   <div class="tasks_lottery_card">
    <div class="title">Registre presença e ganhe recompensas</div>
    <div class="desc">Check-in diário: {{price(setting('checkin'))}}</div>
    <div class="go_btn flex_space" id="sign_in" style="width: 120px">
     <p onclick="checkin()">Registrar Agora</p>
    </div>
   </div>
   <a href="/team" class="my_team_card">
    <div class="title">Minha Equipe</div>
    <div class="desc">Monte sua equipe e ganhe mais</div>
    <div class="go_btn flex_space">
     <p>Ir</p>
     <img src="/v2/img/tasks/go.png">
    </div>
   </a>
   <a href="/tasks" class="daily_tasks_card">
    <div class="title">Recompensa de Tarefas</div>
    <div class="desc">Complete tarefas e receba bônus diário</div>
    <div class="go_btn flex_space">
     <p>Ir</p>
     <img src="/v2/img/tasks/go.png">
    </div>
   </a>
   <a href="/lottery" class="tasks_lottery_card">
    <div class="title">Sorteio</div>
    <div class="desc">A roda da sorte gira com grandes prêmios</div>
    <div class="go_btn flex_space">
     <p>Ir</p>
     <img src="/v2/img/tasks/go.png">
    </div>
   </a>
   <textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly>{{url('register').'?ref='.auth()->user()->ref_id}}</textarea>
  </div>

  <textarea id="notice_content" style="display: none"></textarea>

  <div id="dialog" class="dialog" style="display: none">
   <div class="dialog_title">
    <img class="dialog_icon" src="/v2/img/common/dialog_icon.png"> Lembrete
   </div>
   <div class="dialog_contents">
    <p class="text" id="dialog_text"></p>
   </div>
   <div class="btn_group">
    <div class="cancel">Cancelar</div>
    <a href="" id="jump_url" class="confirm">Depositar</a>
   </div>
  </div>

  <div class="footer_menu">
   <div class="content">
    <a href="/" class="item active" style="margin-top: 10px;"> <img src="/v2/img/footer/home_active.png"> <p>Início</p> </a>
    <a href="/product" class="item " style="margin-top: 10px;"> <img src="/v2/img/footer/invest.png"> <p>Investir</p> </a>
    <a href="/invitation" class="item" style="padding: 0px;position: relative"> <img src="/v2/img/footer/invite.png" style="width:80px;height: 80px;margin-top: -25px;"> </a>
    <a href="/blog" class="item " style="margin-top: 10px;"> <img src="/v2/img/footer/blog.png"> <p>Blog</p> </a>
    <a href="/my" class="item " style="margin-top: 10px;"> <img src="/v2/img/footer/account.png"> <p>Conta</p> </a>
   </div>
  </div>

  <div class="layui-layer-shade" id="layui-layer-shade1" times="1" style="z-index: 19891014; background-color: rgb(0, 0, 0); opacity: 0.3;"></div>
  <div class="layui-layer-move" id="layui-layer-move"></div>

 </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@include('alert-message')

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
    message('Copiado com sucesso!');
}

function checkin() {
    window.location.href = '{{ route("user.checkin") }}';
}

document.addEventListener('DOMContentLoaded', function () {
    const closeBtn = document.querySelector('.layui-layer-close2');
    const popup = document.getElementById('layui-layer1');
    const shade = document.getElementById('layui-layer-shade1');
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            if (popup) popup.style.display = 'none';
            if (shade) shade.style.display = 'none';
        });
    }
});
</script>
