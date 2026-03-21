<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Team</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
 </head> 
<body class="common_body common_background">
<div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
        Team    </a>
</div>
<script id="InviteTpl" type="text/html">
    <div class="common_margin_10 common_padding_10">
        <div class="label" style="color: #DEEFFF">Commission</div>
        <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">r600</div>
    </div>
    <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;">
      <img src="/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0">
        <div class="invite_friends_card_item" >
            <div class="value invite_code">Invite Link</div>
            <div class="label" style="color: #5072EE">link</div>
        </div>
        <div class="copy_btn" id="copy" style="text-align: center">
            Copy
        </div>
    </div>
</script>
<script id="TeamTpl" type="text/html">
    <div class="team_level_card">
        <a href="/member/1" class="flex_space">
            <div class="team_level_title">Team Level</div>
            <div class="team_level_details">Team Detalls ></div>
        </a>
        <div class="team_level_item_card">
            <div class="flex_space">
                <div class="team_level_top_left">
                    Leve1
                </div>
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
                        <div class="team_level_details">Total invite</div>

                    </div>
                    <div class="team_level_item">
                        <div class="team_level_title">5</div>
                        <div class="team_level_details">Active</div>

                    </div>
                </div>
            </div>
        </div>
        <div class="team_level_item_card" style="background: linear-gradient( 88deg, #EAEEF7 0%, #D1D8F2 100%);">
            <div class="flex_space">
                <div class="team_level_top_left" style='    background-image: url("/v2/img/team/lv2_bg.png");'>
                    Leve2
                </div>
                <img src="/v2/img/team/lv2.png" class="team_level_img">
            </div>
            <div class="flex_space">
                <div class="team_level_item_list flex_space">
                    <div class="team_level_item">

                        <div class="team_level_title">77%</div>
                        <div class="team_level_details">Lv 2 Rebate</div>
                    </div>
                    <div class="team_level_item">

                        <div class="team_level_title">77</div>
                        <div class="team_level_details">Total invite</div>
                    </div>
                    <div class="team_level_item">

                        <div class="team_level_title">77</div>
                        <div class="team_level_details">Active</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="team_level_item_card" style="background: linear-gradient( 88deg, #F4D5D4 0%, #F5C1B4 100%);">
            <div class="flex_space">
                <div class="team_level_top_left" style='    background-image: url("/v2/img/team/lv3_bg.png");'>

                </div>
                <img src="/v2/img/team/lv3.png" class="team_level_img">
            </div>
            <div class="flex_space">
                <div class="team_level_item_list flex_space">
                    <div class="team_level_item">

                        <div class="team_level_title">32%</div>
                        <div class="team_level_details">Lv 3 Rebate</div>
                    </div>
                    <div class="team_level_item">

                        <div class="team_level_title">32</div>
                        <div class="team_level_details">Total invite</div>
                    </div>
                    <div class="team_level_item">

                        <div class="team_level_title">32</div>
                        <div class="team_level_details">Active</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
@php
    $totalCommission = $levelTotalCommission1 + $levelTotalCommission2 + $levelTotalCommission3;
@endphp
<div class="common_margin_15" id="invite_friends_card"> <div class="common_margin_10 common_padding_10"> <div class="label" style="color: #DEEFFF">Commission</div> <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">{{price($totalCommission) }}</div> </div> <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;"> <img src="/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0"> <div class="invite_friends_card_item"> <div class="value invite_code">Invite Link</div> <div class="label" style="color: #5072EE">h{{url('register').'?ref='.auth()->user()->ref_id}}</div> </div> <div class="copy_btn" id="copy" style="text-align: center" onclick="copyLink('{{url('register').'?ref='.auth()->user()->ref_id}}')"> Copy </div> </div> </div>
<div class="common_card common_margin_15">
    <div id="team_level_card"> <div class="team_level_card"> <a href="/member/1" class="flex_space"> <div class="team_level_title">Team Level</div> <div class="team_level_details">Team Detalls &gt;</div> </a> <div class="team_level_item_card"> <div class="flex_space"> <div class="team_level_top_left"> Leve1 </div> <img src="/v2/img/team/lv1.png" class="team_level_img"> </div> <div class="flex_space"> <div class="team_level_item_list flex_space"> <div class="team_level_item"> <div class="team_level_title">35%</div> <div class="team_level_details">Lv 1 Rebate</div> </div> <div class="team_level_item"> <div class="team_level_title">{{$first_level_users->count()}}</div> <div class="team_level_details">Total invite</div> </div> <div class="team_level_item"> <div class="team_level_title">{{$first_level_users->where('investor', 1)->count()}}</div> <div class="team_level_details">Active</div> </div> </div> </div> </div> <div class="team_level_item_card" style="background: linear-gradient( 88deg, #EAEEF7 0%, #D1D8F2 100%);"> <div class="flex_space"> <div class="team_level_top_left" style=" background-image: url(&quot;/v2/img/team/lv2_bg.png&quot;);"> Leve2 </div> <img src="/v2/img/team/lv2.png" class="team_level_img"> </div> <div class="flex_space"> <div class="team_level_item_list flex_space"> <div class="team_level_item"> <div class="team_level_title">2%</div> <div class="team_level_details">Lv 2 Rebate</div> </div> <div class="team_level_item"> <div class="team_level_title">{{$second_level_users->count()}}</div> <div class="team_level_details">Total invite</div> </div> <div class="team_level_item"> <div class="team_level_title">{{$second_level_users->where('investor', 1)->count()}}</div> <div class="team_level_details">Active</div> </div> </div> </div> </div> <div class="team_level_item_card" style="background: linear-gradient( 88deg, #F4D5D4 0%, #F5C1B4 100%);"> <div class="flex_space"> <div class="team_level_top_left" style=" background-image: url(&quot;/v2/img/team/lv3_bg.png&quot;);"> </div> <img src="/v2/img/team/lv3.png" class="team_level_img"> </div> <div class="flex_space"> <div class="team_level_item_list flex_space"> <div class="team_level_item"> <div class="team_level_title">1%</div> <div class="team_level_details">Lv 3 Rebate</div> </div> <div class="team_level_item"> <div class="team_level_title">{{$third_level_users->count()}}</div> <div class="team_level_details">Total invite</div> </div> <div class="team_level_item"> <div class="team_level_title">{{$third_level_users->where('investor', 1)->count()}}</div> <div class="team_level_details">Active</div> </div> </div> </div> </div> </div> </div>
</div>


<textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly=""></textarea>
<div class="footer_menu">

    <div class="content">
        <a href="/" class="item active" style="margin-top: 10px;">
            <img src="/v2/img/footer/home_active.png">
            <p>Home</p>
        </a>
         <a href="/product" class="item " style="margin-top: 10px;">
            <img src="/v2/img/footer/invest.png">
            <p>Invest</p>
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
            <p>Account</p>
        </a>
    </div>
</div>
<!--script src="/v2/layui/layui.js"></script>
<script src="/v2/js/team.js"></script>-->


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

        // If you don't have a message() function, use alert
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
