<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <title>Lucky Spinning</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('/profelar/img_1.png') no-repeat center center fixed;
      background-size: cover;
      color: white;
      text-align: center;
      overflow-x: hidden;
    }

    h1 {
      font-size: 2em;
      margin-top: 20px;
      color: #fff;
      text-shadow: 2px 2px #000;
    }

    .subtitle {
      font-size: 0.9em;
      color: #cfcfff;
      margin-bottom: 15px;
    }

    .wheel-container {
      position: relative;
      width: 320px;
      height: 320px;
      margin: 20px auto;
    }

    .pointer {
      position: absolute;
      top: -25px;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 0;
      border-left: 15px solid transparent;
      border-right: 15px solid transparent;
      border-bottom: 30px solid red;
      z-index: 5;
    }

    .wheel {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 6px solid #ffffff;
      background: url('/mbtech/p_1.png') no-repeat center center;
      background-size: cover;
      position: relative;
      transition: transform 4s ease-out;
      overflow: hidden;
    }

    .slice {
      width: 50%;
      height: 50%;
      position: absolute;
      top: 50%;
      left: 50%;
      transform-origin: 0% 0%;
      border: 1px solid transparent;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      color: #000;
    }

    .slice img {
      width: 40px;
      height: 40px;
      object-fit: contain;
      margin-bottom: 3px;
    }

    .center-button {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 80px;
      height: 80px;
      margin: -40px 0 0 -40px;
      background: red;
      color: yellow;
      font-weight: bold;
      font-size: 16px;
      border-radius: 50%;
      line-height: 80px;
      cursor: pointer;
      box-shadow: 0 0 10px #fff;
      border: 3px solid #fff;
      z-index: 10;
    }

    #chances {
      margin-top: 15px;
      font-size: 1rem;
    }

    .prize-display {
      margin: 20px auto;
      background: #ffffff33;
      color: #fff;
      padding: 10px;
      border-radius: 8px;
      width: 90%;
      max-width: 300px;
    }
  </style>
</head>
<body>

  <h1>Lucky Spinning</h1>
  <p class="subtitle">Joyful drawing of prizes</p>

  <div class="wheel-container">
    <div class="pointer"></div>
    <div class="wheel" id="wheel">
      <div class="slice" style="transform: rotate(0deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="19"><span>19</span></div>
      <div class="slice" style="transform: rotate(45deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="29"><span>29</span></div>
      <div class="slice" style="transform: rotate(90deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="199"><span>199</span></div>
      <div class="slice" style="transform: rotate(135deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="1999"><span>1999</span></div>
      <div class="slice" style="transform: rotate(180deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="9999"><span>9999</span></div>
      <div class="slice" style="transform: rotate(225deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="99999"><span>99999</span></div>
      <div class="slice" style="transform: rotate(270deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="79999"><span>79999</span></div>
      <div class="slice" style="transform: rotate(315deg) skewY(-45deg);"><img src="/profelar/coin.jpg" alt="999"><span>999</span></div>
    </div>
    <div class="center-button" onclick="spin()">Start</div>
  </div>

  <p id="chances">You have <strong>{{ $chances }}</strong> chances to participate in the lottery</p>
  <div id="result" class="prize-display"></div>

  <script>
    let spinning = false;

    function spin() {
      if (spinning) return;
      spinning = true;
      document.getElementById('result').innerHTML = '';

      fetch("{{ route('spin.now') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
      })
      .then(res => res.json())
      .then(data => {
        if (!data.success) {
          document.getElementById('result').innerHTML = `<strong>${data.message}</strong>`;
          spinning = false;
          return;
        }

        const wheel = document.getElementById("wheel");
        const deg = 3600 + Math.floor(Math.random() * 360);
        wheel.style.transform = `rotate(${deg}deg)`;

        setTimeout(() => {
          let current = parseInt(document.querySelector('#chances strong').textContent);
          document.querySelector('#chances strong').textContent = current - 1;
          document.getElementById('result').innerHTML = `
            🎉 <strong>You won ${data.amount}!</strong><br>
            <img src="${data.image}" alt="Reward" style="max-width:80px; margin-top:10px;">
          `;
          spinning = false;
        }, 4000);
      })
      .catch(() => {
        document.getElementById('result').innerHTML = 'Error. Please try again.';
        spinning = false;
      });
    }
  </script>

</body>
</html>