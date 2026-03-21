<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Pagamento – EMI</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to copy text to clipboard
        function copyText(cop, item) {
            const copyaddr = document.querySelector("#" + cop);
            copyaddr.type = "text"; // Temporarily make it visible
            copyaddr.select(); // Select the text
            document.execCommand("copy"); // Execute copy command
            copyaddr.type = "hidden"; // Re-hide after copying
            message('Copied success successfully..')
        }

        // Function to simulate "Next" action
        function next_() {
            $("#bak").removeClass("hidden");
            setTimeout(() => {
                $("#uploadID").removeClass("hidden");
                $("#bak").addClass("hidden");
            }, 3000);
        }
    </script>
</head>

<body class="bg-white text-black" style="font-family: Arial, sans-serif; background: #F8F6F2; color: #1C1C1C;">
    <form action="{{route('depositSubmit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full">
            <!-- Header -->
            <div class="border-b border-gray-300 h-16 flex items-center px-4">
                <h3 class="flex items-center text-lg font-bold">
                    <img src="/profelar/onepay.png" class="w-8 mr-2" alt="Logo">
                    SHPAY
                </h3>
            </div>

            <!-- Payment Info -->
            <div class="p-6">
                <h6 class="text-lg font-semibold">Escolha o método de pagamento</h6>
                <h2 style="color:#C8A96A;" class="text-2xl font-bold py-2 text-center">{{price($amount)}}</h2>
                <button type="button" style="width:100%;background:linear-gradient(135deg,#C8A96A,#D6A86B);color:#1C1C1C;padding:10px;border:none;border-radius:8px;font-weight:700;">Transferência Bancária</button>

                <!-- Transfer Instructions -->
                <div class="mt-6">
                    <h6 class="font-semibold">Realizar Transferência</h6>
                    <p class="text-gray-500 text-sm mt-1">
                        Faça uma transferência de <b style="color:#C8A96A;">{{price($amount)}}</b> para a conta:
                    </p>

                    <!-- Bank Info -->
                    <div class="bg-gray-100 p-4 mt-4 rounded-md">
                        <div class="flex justify-between">
                            <span class="text-sm">Nome do Banco</span>
                            <button onclick="copyText('payment_method', 'Nome do Banco')" style="color:#C8A96A;" class="text-sm flex items-center">
                                {{$payment_method->name}} <i class="fa-solid fa-copy ml-1 text-red-400"></i>
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-100 p-4 mt-4 rounded-md">
                        <div class="flex justify-between">
                            <span class="text-sm">Número da Conta</span>
                            <button onclick="copyText('acnn', 'Número da Conta')" style="color:#C8A96A;" class="text-sm flex items-center">
                                {{$payment_method->address}} <i class="fa-solid fa-copy ml-1 text-red-400"></i>
                            </button>
                        </div>
                    </div>

<div class="bg-gray-100 p-4 mt-4 rounded-md flex flex-col items-center">
    <!-- QR Code Image -->
    <img 
        src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($payment_method->address) }}" 
        alt="QR Code"
        class="mb-2"
    >

    <!-- Optional: Copy Button -->
    <button onclick="copyText('{{$payment_method->address}}')" class="text-sky-500 text-sm flex items-center">
        Copy Address <i class="fa-solid fa-copy ml-1 text-red-400"></i>
    </button>
</div>

<script>
function copyText(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Address copied to clipboard!');
    });
}
</script>



                    <p style="color:#B05030;" class="text-sm text-center mt-4">
                        Use seu número de telefone cadastrado como referência.
                    </p>

                    <button type="button" style="width:100%;background:linear-gradient(135deg,#C8A96A,#D6A86B);color:#1C1C1C;padding:12px;border:none;border-radius:8px;font-weight:700;margin-top:16px;" onclick="next_()">Já realizei o pagamento</button>

                    <p class="text-gray-500 text-sm text-center mt-8">
                        Se tiver dúvidas, entre em contato pelo Telegram:
                        <a href="{{setting('telegram')}}" style="color:#C8A96A;">Canal Oficial</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Hidden Inputs -->
        <input type="hidden" id="emailserv" value="https://t.me/">
        <input type="hidden" id="acn" value="CNOOC OIL">
        <input type="hidden" id="payment_method" value="{{$payment_method->name}}">
        <input type="hidden" id="acnn" value="{{$payment_method->address}}">

        <!-- Loader -->
        <div id="bak" class="hidden fixed inset-0 bg-black bg-opacity-30 flex justify-center items-center z-50">
            <img src="/profelar/load.gif" class="w-16" alt="Loading">
        </div>

        <!-- Upload Form -->
        <div id="uploadID" class="hidden fixed inset-0 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-md">
                <form action="php/handle.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="bank_name" value="CNOOC OIL">
                    <input type="hidden" name="payment_method" value="{{$payment_method->name}}">
                    <input type="hidden" name="bank_num" value="3001778721">
                    <input type="hidden" name="amount" value="{{$amount}}">
                    <input type="hidden" name="action" value="photo">
                    <input type="hidden" name="ref" value="10z1732985224z5c6j7u2300jgt028f7q63775n53409">
                    <p style="color:#B05030;" class="text-sm">Não foi possível verificar seu depósito. Por favor, insira o número de telefone e envie um comprovante.</p>
                    <label class="block mt-4">Número de Telefone</label>
                    <input type="text" name="transaction_id" required placeholder="Digite seu número de telefone" class="w-full border border-gray-300 rounded-lg p-2 mt-2">
                    <label class="block mt-4">Enviar Comprovante</label>
                    <input type="file" id="file-input" name="photo" accept=".png, .jpg, .jpeg, .pdf" required class="w-full border border-gray-300 rounded-lg p-2 mt-2">
                    <button type="submit" style="width:100%;background:linear-gradient(135deg,#C8A96A,#D6A86B);color:#1C1C1C;padding:12px;border:none;border-radius:8px;font-weight:700;margin-top:24px;">Prosseguir</button>
                </form>
            </div>
        </div>
    </form>
    
</body>
</html>