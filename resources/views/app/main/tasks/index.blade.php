<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Tarefas – EMI</title>
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
.emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:pointer;display:inline-block;text-align:center;text-decoration:none}
.emi-label{font-size:12px;color:#6B6B6B}
.emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
.emi-gold{color:#C8A96A}
.flex-between{display:flex;justify-content:space-between;align-items:center}
.flex-left{display:flex;align-items:center;gap:10px}
.divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}
.progress-bar-bg{background:#E8DCC8;border-radius:4px;height:8px;overflow:hidden}
.progress-bar-fill{background:linear-gradient(90deg,#C8A96A,#D6A86B);height:8px;border-radius:4px;transition:width .3s}

.commission-card{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);border-radius:12px;padding:20px 16px;margin:16px;color:#fff}
.commission-label{font-size:13px;color:rgba(255,255,255,0.85)}
.commission-value{font-family:'Playfair Display',serif;font-size:26px;font-weight:700;color:#fff;margin-top:6px}
.invite-link-sub{font-size:12px;color:rgba(255,255,255,0.75);margin-top:8px;word-break:break-all}

.invite-info-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;padding:14px 16px;margin:0 16px 16px}
.invite-info-title{font-size:14px;font-weight:700;color:#1C1C1C;margin-bottom:4px}
.invite-info-text{font-size:13px;color:#6B6B6B}

.section-title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#1C1C1C;margin:0 16px 10px}

.task-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:16px;margin:0 16px 12px}
.task-top{display:flex;gap:12px;align-items:flex-start}
.task-icon{width:52px;height:52px;flex-shrink:0;object-fit:contain}
.task-info{flex:1;min-width:0}
.task-req{font-size:13px;color:#6B6B6B;margin-bottom:4px}
.task-req strong{color:#1C1C1C}
.task-reward{font-size:13px;color:#6B6B6B}
.task-reward strong{color:#C8A96A;font-size:15px}
.task-progress-row{display:flex;align-items:center;gap:10px;margin-top:10px}
.task-progress-count{font-size:13px;font-weight:700;white-space:nowrap}
.task-progress-count span{color:#C8A96A}
.task-action{margin-top:12px}
.btn-claim{display:inline-block;padding:9px 20px;background:#C8A96A;color:#fff;font-weight:700;font-size:13px;border-radius:8px;border:none;cursor:pointer;text-decoration:none}
.btn-claimed{display:inline-block;padding:9px 20px;background:#E8DCC8;color:#999;font-size:13px;border-radius:8px;border:none;cursor:default}
.btn-unavailable{display:inline-block;padding:9px 20px;background:#F0EBE0;color:#AAA;font-size:13px;border-radius:8px;border:none;cursor:default}

.copy-link-btn{display:block;margin-top:10px;padding:9px;background:#C8A96A;color:#fff;font-weight:600;font-size:13px;border-radius:8px;border:none;cursor:pointer;width:100%;text-align:center}
</style>
</head>
<body>

<div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
        <i class="layui-icon layui-icon-left layui-font-18"></i>
        Tarefas
    </a>
</div>

<!-- Commission + Invite Link Summary -->
<div class="commission-card">
    <div class="commission-label">Comissão de Tarefas Acumulada</div>
    <div class="commission-value">{{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'task')->sum('amount')) }}</div>
    <div class="invite-link-sub">{{ url('register').'?ref='.auth()->user()->ref_id }}</div>
    <button class="copy-link-btn" onclick="copyLink('{{ url('register').'?ref='.auth()->user()->ref_id }}')">
        Copiar Link de Convite
    </button>
</div>

<!-- Invite Info -->
<div class="invite-info-card">
    <div class="invite-info-title">Recompensas por Convite</div>
    <div class="invite-info-text">
        Se você convidar amigos e eles se ativarem com sucesso, você receberá
        <strong style="color:#C8A96A">R50</strong> de recompensa por convite.
    </div>
</div>

<!-- Task List -->
<div class="section-title">Recompensas de Tarefas</div>

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

    <div class="task-card">
        <div class="task-top">
            <img src="/v2/img/tasks/rewards_icon.png" class="task-icon" alt="Tarefa">
            <div class="task-info">
                <div class="task-req">
                    Requisito: <strong>Convidar {{ $task->team_size }} pessoas ativas</strong>
                </div>
                <div class="task-reward">
                    Recompensa: <strong>{{ price($task->bonus) }}</strong>
                </div>
            </div>
        </div>
        <div class="task-progress-row">
            <div class="progress-bar-bg" style="flex:1">
                <div class="progress-bar-fill" style="width:{{ $progress }}%"></div>
            </div>
            <div class="task-progress-count">
                <span>{{ $currentCount }}</span> / {{ $task->team_size }}
            </div>
        </div>
        <div class="task-action">
            @if($apply)
                <span class="btn-claimed">Resgatado</span>
            @elseif($isClaimable)
                <a href="{{ route('user.received.reward', $task->id) }}" class="btn-claim">Resgatar Agora</a>
            @else
                <span class="btn-unavailable">Não Disponível</span>
            @endif
        </div>
    </div>
@endforeach

<div style="height:20px"></div>
<textarea style="height:1px;opacity:0" name="copyTxt" id="copyTxt" readonly></textarea>

@include('app.layout.menu')
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
    ('Copied successfully.');
}
</script>
</body>
</html>
