<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>invitation</title>
    <link rel="stylesheet" href="/public/v2/layui/css/layui.css">
    <link rel="stylesheet" href="/public/v2/css/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">

</head>
<body class="common_body common_background">
<script id="InviteTpl" type="text/html">
    <div class="common_margin_10 common_padding_10">
        <div class="label" style="color: #DEEFFF">Commission</div>
        <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">link</div>
    </div>
    <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;">
        <img src="/public/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0">
        <div class="invite_friends_card_item" >
            <div class="value invite_code">Invite Link</div>
            <div class="label" style="color: #5072EE">link</div>
        </div>
        <div class="copy_btn" id="copy" style="text-align: center">
            Copy
        </div>
    </div>
</script>
 
<div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
        invitation    </a>
</div>
<div class="common_margin_15" id="invite_friends_card"> <div class="common_margin_10 common_padding_10"> <div class="label" style="color: #DEEFFF">Commission</div> <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">{{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'task')->sum('amount')) }}</div> </div> <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;"> <img src="/public/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0"> <div class="invite_friends_card_item"> <div class="value invite_code">Invite Link</div> <div class="label" style="color: #5072EE">{{url('register').'?ref='.auth()->user()->ref_id}}</div> </div> <div class="copy_btn" id="copy" style="text-align: center"onclick="copyLink('{{url('register').'?ref='.auth()->user()->ref_id}}')"> Copy </div> </div> </div>
<div style="padding: 15px;;padding-top: 0px">

    <a href="/team" class="my_team_card">
        <div class="title">My Team</div>
        <div class="desc">Build your own team and make more money</div>
        <div class="go_btn flex_space">
            <p>Go</p> <img src="/public/v2/img/tasks/go.png">
        </div>
    </a>
    <a href="/tasks" class="daily_tasks_card">
        <div class="title">Task reward</div>
        <div class="desc">Complete tasks and receive a daily salary bonus</div>
        <div class="go_btn flex_space">
            <p>Go</p> <img src="/public/v2/img/tasks/go.png">
        </div>
    </a>
    <a href="/lottery" class="tasks_lottery_card">
        <div class="title">Lucky Draw</div>
        <div class="desc">The lucky wheel keeps spinning with great gifts</div>
        <div class="go_btn flex_space">
            <p>Go</p> <img src="/public/v2/img/tasks/go.png">
        </div>
    </a>

</div>

<div class="tasks_reward_text_card" id="tasks_reward_text_card"> <div class="tasks_reward_title">Millionaires Club</div> <div class="tasks_reward_text">1、Inviting friends to join us and successfully investing will give you a chance to win a lucky draw.</div> <div class="tasks_reward_text">2、You will receive rewards for subordinate investment amounts:</div> <div class="tasks_reward_text">(Level 1): Commission rate of 35%</div> <div class="tasks_reward_text">(Level 2): Commission rate of 2%</div> <div class="tasks_reward_text">(Level 3): Commission rate of 1%</div> <div class="tasks_reward_text">If you invite 100 users to join and invest 10000 Rupee on the platform, your income will be: 1000000 * 38%=380000 Rupee</div> <div class="tasks_reward_text">Each excellent promoter can earn at least 1,000,000 Rupee per month</div> <div class="tasks_reward_text">Contact customer service to join the promoter alliance and get the latest ways to make money</div> </div>
<script id="TasksRewardTpl" type="text/html">
    <div class="tasks_reward_title">Millionaires Club</div>
    <div class="tasks_reward_text">1、Inviting friends to join us and successfully investing will give you a chance to win a lucky draw.</div>
    <div class="tasks_reward_text">2、You will receive rewards for subordinate investment amounts:</div>
    <div class="tasks_reward_text">(Level 1): Commission rate of 21%</div>
    <div class="tasks_reward_text">(Level 2): Commission rate of 2%</div>
    <div class="tasks_reward_text">(Level 3): Commission rate of 1%</div>
    <div class="tasks_reward_text">If you invite 100 users to join and invest 10000 Rupee on the platform, your income will be: 1000000 * 38%=380000 Rupee</div>
    <div class="tasks_reward_text">Each excellent promoter can earn at least 1,000,000 Rupee per month</div>
    <div class="tasks_reward_text">Contact customer service to join the promoter alliance and get the latest ways to make money</div>

</script>
<textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly=""></textarea>
<div class="footer_menu">

    <div class="content">
        <a href="/" class="item active" style="margin-top: 10px;">
            <img src="/public/v2/img/footer/home_active.png">
            <p>Home</p>
        </a>
         <a href="/product" class="item " style="margin-top: 10px;">
            <img src="/public/v2/img/footer/invest.png">
            <p>Invest</p>
        </a>
        <a href="/invitation" class="item" style="padding: 0px;position: relative">
            <img src="/public/v2/img/footer/invite.png" style="width:80px;height: 80px;margin-top: -25px; ">

        </a>
        <a href="/blog" class="item " style="margin-top: 10px;">
            <img src="/public/v2/img/footer/blog.png">
            <p>Blog</p>
        </a>

        <a href="/my" class="item " style="margin-top: 10px;">
            <img src="/public/v2/img/footer/account.png">
            <p>Account</p>
        </a>
    </div>
</div>
<script src="/public/v2/layui/layui.js"></script>
<script src="/public/v2/js/invite.js"></script>


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