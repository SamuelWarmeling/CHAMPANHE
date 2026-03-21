<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Central de Ajuda – EMI</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>

    </style> 
  <style id="ss-chat-custom-css">.ss-chat-body {overflow: hidden !important}</style>
 </head> 
 <body class="common_background" style="background-image: url(/v2/img/help/bg.png);"> 
  <div class="common_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Central de Ajuda </a> 
  </div> 
  <div style="background: none;height: 168px;padding: 20px;border-radius: 0 0 40px 40px"> 
   <div class="flex_space"> 
    <div style="width: 214px;"> 
     <div class="service_title">
      Central de Atendimento
     </div>
     <div class="service_desc">
      Estamos com você sempre que precisar
     </div> 
    </div> 
   </div> 
  </div> 
  <div class="help_card" style="margin-top: -80px;"> 
   <a href="https://t.me/profelartech" class="help_flex"> 
    <div class="logo"> 
     <img src="/v2/img/help/recharge.png" style="background:#fff;border-radius:50px;"> 
    </div> 
    <div> 
     <p class="title">Seu depósito ainda não foi recebido?</p>
     <p class="describe">Após depositar com sucesso, se o saldo não tiver entrado na sua conta, informe aqui e nossa equipe irá auxiliá-lo!</p> 
    </div> </a> 
  </div> 
  <div class="help_card"> 
   <div href="/chatlink.html?&amp;language=en" class="help_flex service"> 
    <div class="logo"> 
     <img src="/v2/img/help/service.png"> 
    </div> 
    <div> 
     <p class="title">Atendimento Online</p>
     <p class="describe">Horário de atendimento: 09:00 - 16:30</p> 
    </div> 
   </div> 
  </div> 
  <div class="help_card"> 
   <a href="{{setting('telegram')}}" class="help_flex"> 
    <div class="logo"> 
     <img src="/v2/img/help/telegram.png"> 
    </div> 
    <div> 
     <p class="title">Telegram</p> 
     <p class="describe">Siga nosso canal oficial no Telegram para receber as últimas novidades e benefícios exclusivos</p> 
    </div> </a> 
  </div> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var laydate = layui.laydate;
        var slider = layui.slider;
        var element = layui.element;

        // Idioma configurado: pt (português)
        ssq.push('setLoginInfo', {
            user_id: "{{ md5(auth()->id()) }}",
            user_name: '{{ auth()->user()->nickname ?? auth()->user()->phone }}',
            language: 'pt',
            phone: '{{ auth()->user()->phone ?? "" }}',
            email: '{{ auth()->user()->email ?? "" }}',
            description: 'ID: {{ auth()->user()->ref_id ?? "" }}',
        });
        $('.service').click(function (){
            ssq.push('chatOpen');
        })
    });
</script> 
  <div id="ss-chat-p">
   <audio id="sspSoundNotice" preload="metadata" style="width:0;height:0;" src="https://client.salesmartly.com/setting/sounds/ling.mp3"></audio>
   <iframe title="Contact us" id="s-chat-plugin" style="
        display: none;
        border: none;
        position: fixed;
        opacity: 1;
        background: none transparent !important;
        margin: 0px;
        max-height: 100vh;
        max-width: 100vw;
        transform: translateY(0px);
        transition: all .5s ease 0s !important;
        visibility: visible;
        z-index: 999999999 !important;
        color-scheme: none;
        width: 100px;height: 90px;
        
        border-radius: 16px;
        top: auto;right: 0;bottom: 15px;left: auto
    "></iframe>
   <ssp-widget id="sspWidget" style="
        position: fixed;
        color-scheme: none;
        font-family: Roboto,sans-serif;
        top: auto;right: 12px;bottom: 10px;left: auto;
        z-index: 999999999 !important;
    "></ssp-widget>
   <iframe title="Preview Popup" id="s-chat-popup" style="
        display: none;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 2147483003;
        border: 0px;
        color-scheme: none;
    "></iframe>
  </div>
 </body>
</html>