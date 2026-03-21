<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <title>Tasks</title> 
    <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
    <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
    <style>
        .common_body {
            background-image: url("/v2/img/tasks/bg.png");
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .tasks_progress {
            width: 90px;
            height: 30px;
            background-image: url("/v2/img/tasks/finish_bg.png");
            background-size: 100%;
            background-repeat: no-repeat;
            text-align: left;
            padding-top: 5px;
            padding-left: 7px;
            color: #FFFFFF;
            font-weight: 700;
            font-size: 14px;
        }
        .tasks_progress_active {
            width: 90px;
            height: 30px;
            background-image: url("/v2/img/tasks/progress_bg.png");
            background-size: 100%;
            background-repeat: no-repeat;
            text-align: left;
            padding-top: 5px;
            padding-left: 7px;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: 700;
        }
    </style> 
</head> 
<body class="common_body common_background"> 

    <div class="common_header"> 
        <a href="javascript:history.back(-1)" class="back position"> 
            <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Tasks 
        </a> 
    </div>
    <div class="common_margin_15" id="invite_friends_card"> <div class="common_margin_10 common_padding_10"> <div class="label" style="color: #DEEFFF">Commission</div> <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">{{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'task')->sum('amount')) }}</div> </div> <div class="common_card common_margin_top_20 flex_space position" style="padding-left: 50px;"> <img src="/v2/img/team/link_icon.png" style="width: 44px;height: 44px;position: absolute;top: 10px;left: 0"> <div class="invite_friends_card_item"> <div class="value invite_code">Invite Link</div> <div class="label" style="color: #5072EE">{{url('register').'?ref='.auth()->user()->ref_id}}</div> </div> <div class="copy_btn" id="copy" style="text-align: center" onclick="copyLink('{{url('register').'?ref='.auth()->user()->ref_id}}')"> Copy </div> </div> </div>

    <div class="common_margin_15" id="invite_friends_card"> </div> 

    <div class="common_margin_15"> 
        <div class="tasks_invite_rewards"> 
            <div class="flex_space"> 
                <div> 
                    <div class="title">Invite rewards</div> 
                    <div class="text" style="font-weight: 400;font-size: 14px;color: #666666;margin-top: 10px;">
                        If you invite friends and successfully activate, you will receive 
                        <strong style="color: #486BEA">R50</strong> rewards 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 

    <div class="common_item_title" style="margin-left: 15px;">Task Rewards</div> 

    @php
        $referUsers = \App\Models\User::where('ref_by', auth()->user()->ref_id)
            ->where('investor', 1)
            ->count();
    @endphp

    @foreach(\App\Models\Task::all() as $task)
        @php
            $apply = \App\Models\TaskRequest::where('task_id', $task->id)
                    ->where('user_id', auth()->id())
                    ->where('status', '!=', 'rejected')
                    ->first();

            $progress = min(100, ($referUsers / $task->team_size) * 100);
            $currentCount = min($referUsers, $task->team_size);
            $isClaimable = !$apply && $referUsers >= $task->team_size;
        @endphp

        <div class="common_card common_margin_15" style="padding: 0"> 
            <div class="flex_left common_padding_15" style="padding-top: 15px"> 
                <div style="background: none;margin-right: 10px;"> 
                    <img src="/v2/img/tasks/rewards_icon.png" style="height: 70px;width: 70px"> 
                </div> 
                <div style="width: 100%"> 
                    <div style="margin-bottom: 10px;"> 
                        <div class="label">
                            Require: 
                            <strong>Invite to activate {{ $task->team_size }} people</strong>
                        </div> 
                        <div class="value position" style="margin-top: 10px">
                            Rewards: 
                            <strong style="color: #486BEA">{{ price($task->bonus) }}</strong>
                        </div> 
                    </div> 
                    <div class="flex_space"> 
                        <div class="layui-progress" style="width: 160px;height: 10px;margin-top: 5px"> 
                            <div class="layui-progress-bar layui-bg-blue"
                                lay-percent="{{ $progress }}%"
                                style="height: 10px; background: linear-gradient(rgb(74, 109, 235) 0%, rgb(92, 125, 245) 100%); width: {{ $progress }}%;">
                            </div> 
                        </div> 
                        <div class="value">
                            <span style="color: #486BEA;font-weight:700">{{ $currentCount }}</span> / {{ $task->team_size }}
                        </div> 
                    </div> 

                    <div style="margin-top: 10px;">
                        @if($apply)
                            <button class="layui-btn layui-btn-sm" style="background: #00c48f; border-radius: 20px;" disabled>Claimed</button>
                        @elseif($isClaimable)
                            <a href="{{ route('user.received.reward', $task->id) }}" class="layui-btn layui-btn-sm" style="background: #1666f0; color: #fff; border-radius: 20px;">Claim Now</a>
                        @else
                            <button class="layui-btn layui-btn-sm layui-btn-disabled" style="border-radius: 20px;">Not Ready</button>
                        @endif
                    </div>
                </div> 
            </div> 
        </div> 
    @endforeach

    <div style="height: 80px;"></div> 

    <textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly></textarea> 

    <div class="footer_menu"> 
        <div class="content"> 
            <a href="/" class="item " style="margin-top: 10px;"> 
                <img src="/v2/img/footer/home.png"> 
                <p>Home</p> 
            </a> 
            <a href="/product" class="item " style="margin-top: 10px;"> 
                <img src="/v2/img/footer/invest.png"> 
                <p>Invest</p> 
            </a> 
            <a href="/invitation" class="item" style="padding: 0px;position: relative"> 
                <img src="/v2/img/footer/invite.png" style="width:80px;height: 80px;margin-top: -25px;"> 
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
    @include('alert-message')

<!-- ✅ Global Copy Function -->
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
    ('Copied successfully.');
}
</script>
</body>
</html>
