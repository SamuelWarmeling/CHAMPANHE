<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Help Center</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>

    </style> 
  <style id="ss-chat-custom-css">.ss-chat-body {overflow: hidden !important}</style>
 </head> 
 <body class="common_background" style="background-image: url(/v2/img/help/bg.png);"> 
  <div class="common_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Help Center </a> 
  </div> 
  <div style="background: none;height: 168px;padding: 20px;border-radius: 0 0 40px 40px"> 
   <div class="flex_space"> 
    <div style="width: 214px;"> 
     <div class="service_title">
      Service center
     </div> 
     <div class="service_desc">
      Accompany you all the way when you need it
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
     <p class="title">Your deposit has not been received yet?</p> 
     <p class="describe">After successfully charging your account, if the balance has not been entered into your account, please provide it here and customer service personnel will assist you in handling it!</p> 
    </div> </a> 
  </div> 
  <div class="help_card"> 
   <div href="/chatlink.html?&amp;language=en" class="help_flex service"> 
    <div class="logo"> 
     <img src="/v2/img/help/service.png"> 
    </div> 
    <div> 
     <p class="title">Online service</p> 
     <p class="describe">Working hours: 09:00:00 - 16:30:00</p> 
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
     <p class="describe">Follow our official Telegram channel to get the latest event news and receive treasure box benefits</p> 
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

        // 语言选项（根据需要选择并设置）
        // 'en-US': 'English',       英语
        // 'zh-CN': '中文',          简体中文
        // 'zh-HK': '繁體中文',      繁体中文
        // 'ru-RU': 'русский',      俄语
        // 'th-TH': 'ภาษาไทย',     泰语
        // 'vi-VN': 'Tiếng Việt',   越南语
        // 'mn': 'Монгол',          蒙古语
        // 'ja-JP': 'やまと',        日语
        // 'fr': 'français',        法语
        // 'pt': 'português',       葡萄牙语
        // 'es': 'español',         西班牙语
        // 'ar': 'العربية',         阿拉伯语
        // 'de': 'Deutsch'           德语
        ssq.push('setLoginInfo', {
            user_id: "ef4d761ede58191443436a59f9cfb3c9", // 加密后的用户id, 必填！
            user_name: '@Sir_sq01', // 对应用户名
            language: 'en-US', // 对应用户语言
            phone: '【456969】【90******68】', // 对应用户手机号
            email: '', // 对应用户邮箱
            description: '【456969】【+2349015501668】', // 对应客户资料的用户描述信息，例如套餐信息
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