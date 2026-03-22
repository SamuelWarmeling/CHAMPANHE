<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Sobre a EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{background:#F8F6F2;color:#1C1C1C;margin:0;padding:0 0 80px}
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}
    .emi-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:14px 16px;color:#fff}
    .emi-back{display:flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:15px;font-weight:600}
    .emi-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:20px;margin-bottom:12px}
    .emi-gold{color:#C8A96A}

    .page-wrap{padding:16px;}

    .logo-block{
      text-align:center;padding:24px 0 8px;
    }
    .logo-block img{
      width:96px;height:96px;border-radius:50%;
      border:3px solid #C8A96A;
      box-shadow:0 4px 16px rgba(200,169,106,0.25);
      object-fit:cover;
    }
    .logo-block .brand-name{
      font-family:'Playfair Display',serif;
      font-size:22px;font-weight:700;color:#1C1C1C;margin-top:12px;
    }
    .logo-block .brand-sub{
      font-family:'Playfair Display',serif;
      font-style:italic;font-size:14px;color:#C8A96A;margin-top:4px;
    }

    .section-title{
      font-family:'Playfair Display',serif;
      font-size:16px;font-weight:600;color:#C8A96A;
      margin:0 0 12px;letter-spacing:0.3px;
    }
    .about-text{
      font-size:14px;color:#4A4A4A;line-height:1.8;margin:0;
    }

    .values-grid{
      display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:4px;
    }
    .value-item{
      background:#F8F6F2;border:1px solid #E8DCC8;
      border-radius:10px;padding:14px 10px;text-align:center;
    }
    .value-item .v-icon{
      width:36px;height:36px;margin:0 auto 8px;
      background:linear-gradient(135deg,#C8A96A,#D6A86B);
      border-radius:50%;display:flex;align-items:center;justify-content:center;
    }
    .value-item .v-icon svg{width:18px;height:18px;color:#fff;}
    .value-item p{
      margin:0;font-size:12px;font-weight:700;color:#1C1C1C;
      letter-spacing:0.5px;text-transform:uppercase;
    }

    .divider{height:1px;background:#E8DCC8;margin:4px 0 16px;}
  </style>
</head>
<body>
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      Sobre a EMI
    </a>
  </div>

  <div class="page-wrap">

    <div class="logo-block">
      <img src="/images/logo-emi.png" alt="EMI Logo">
      <div class="brand-name">Enoteca Millesimi</div>
      <div class="brand-sub">Investimento em Vinhos Premium</div>
    </div>

    <div style="height:20px;"></div>

    <div class="emi-card">
      <div class="section-title">SOBRE NÓS</div>
      <div class="divider"></div>
      <p class="about-text">
        A EMI é uma empresa internacional de investimentos responsável, com sede no Brasil. Fundada para proporcionar oportunidades de crescimento financeiro seguro e transparente, a EMI oferece produtos de investimento de alto desempenho para seus membros em todo o mundo.
      </p>
    </div>

    <div class="emi-card">
      <div class="section-title">NOSSOS VALORES</div>
      <div class="divider"></div>
      <div class="values-grid">
        <div class="value-item">
          <div class="v-icon">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L3 7v10l9 5 9-5V7L12 2z"/></svg>
          </div>
          <p>Justiça</p>
        </div>
        <div class="value-item">
          <div class="v-icon">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-8v4h4l-5 8z"/></svg>
          </div>
          <p>Respeito</p>
        </div>
        <div class="value-item">
          <div class="v-icon">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
          </div>
          <p>Transparência</p>
        </div>
        <div class="value-item">
          <div class="v-icon">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <p>Responsabilidade</p>
        </div>
      </div>
    </div>

    <div class="emi-card">
      <div class="section-title">NOSSA VISÃO</div>
      <div class="divider"></div>
      <p class="about-text">
        Nossa visão é ser uma empresa de investimentos responsável, demonstrando liderança ao superar os padrões do setor e continuar elevando nossa própria performance. Um dos principais motivos do nosso sucesso é cumprir nossas promessas de justiça, respeito, transparência e responsabilidade. Esses princípios fazem parte da nossa cultura corporativa e são aplicados globalmente em todos os nossos projetos.
      </p>
    </div>

  </div>

  @include('app.layout.menu')
</body>
</html>
