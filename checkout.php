<?php
session_start();
$cart = $_SESSION['cart'] ?? ['items' => [], 'subtotal' => 0, 'total_qty' => 0];
$items = $cart['items'] ?? [];
$subtotal = $cart['subtotal'] ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Pizzaria Top Pizza</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f5f5f5; }
        .container { max-width: 680px; margin: 0 auto; padding: 16px; }
        .header { background: #f50000; color: #fff; padding: 14px 16px; display: flex; align-items: center; gap: 12px; position: sticky; top: 0; z-index: 100; }
        .header button { background: none; border: none; color: #fff; cursor: pointer; display: flex; align-items: center; }
        .header h1 { font-size: 17px; font-weight: 600; }
        .order-summary { background: #fff; border-radius: 16px; padding: 16px; margin-bottom: 16px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .order-summary h2 { font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 12px; text-transform: uppercase; letter-spacing: .4px; }
        .order-item { display: flex; gap: 12px; align-items: flex-start; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .order-item:last-child { border-bottom: none; }
        .order-item img { width: 60px; height: 60px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
        .order-item-info { flex: 1; }
        .order-item-name { font-size: 13px; font-weight: 600; color: #1f2937; }
        .order-item-qty { font-size: 12px; color: #9ca3af; margin-top: 2px; }
        .order-item-price { font-size: 14px; font-weight: 700; color: #f50000; }
        .order-totals { margin-top: 12px; border-top: 1px solid #f3f4f6; padding-top: 12px; }
        .order-total-row { display: flex; justify-content: space-between; font-size: 14px; color: #6b7280; margin-bottom: 6px; }
        .order-total-row.total { font-size: 16px; font-weight: 700; color: #1f2937; border-top: 1px solid #f3f4f6; padding-top: 10px; margin-top: 4px; }
        .order-total-row .green { color: #16a34a; font-weight: 500; }
        .steps { display: flex; margin-bottom: 16px; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .step { flex: 1; padding: 12px; text-align: center; font-size: 13px; font-weight: 600; color: #9ca3af; border-bottom: 3px solid transparent; }
        .step.active { color: #f50000; border-bottom-color: #f50000; }
        .step.done { color: #16a34a; border-bottom-color: #16a34a; }
        .form-section { background: #fff; border-radius: 16px; padding: 20px; margin-bottom: 16px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .form-section h2 { font-size: 15px; font-weight: 700; color: #1f2937; margin-bottom: 16px; }
        .form-group { margin-bottom: 14px; }
        .form-group label { display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .form-group input { width: 100%; padding: 12px 14px; border: 1.5px solid #e5e7eb; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; transition: border-color .15s; }
        .form-group input:focus { border-color: #f50000; box-shadow: 0 0 0 3px rgba(245,0,0,.08); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .cep-wrap { position: relative; }
        .cep-btn { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: #f50000; color: #fff; border: none; border-radius: 8px; padding: 6px 12px; font-size: 12px; font-weight: 600; cursor: pointer; }
        .btn-primary { width: 100%; padding: 16px; background: #f50000; color: #fff; border: none; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: opacity .2s; margin-top: 8px; }
        .btn-primary:hover { opacity: .9; }
        .btn-primary:disabled { opacity: .6; cursor: not-allowed; }
        .btn-secondary { width: 100%; padding: 14px; background: #f3f4f6; color: #374151; border: none; border-radius: 12px; font-size: 14px; font-weight: 600; cursor: pointer; margin-top: 8px; }
        .pix-screen { display: none; background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 1px 4px rgba(0,0,0,.08); text-align: center; }
        .pix-screen h2 { font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 6px; }
        .pix-screen p { font-size: 13px; color: #6b7280; margin-bottom: 20px; }
        .pix-qr { width: 200px; height: 200px; margin: 0 auto 16px; border: 2px solid #e5e7eb; border-radius: 12px; overflow: hidden; }
        .pix-qr img { width: 100%; height: 100%; }
        .pix-copy { background: #f3f4f6; border-radius: 10px; padding: 12px; margin-bottom: 16px; word-break: break-all; font-size: 11px; color: #374151; text-align: left; }
        .btn-copy { width: 100%; padding: 14px; background: #1f2937; color: #fff; border: none; border-radius: 12px; font-size: 14px; font-weight: 700; cursor: pointer; margin-bottom: 10px; }
        .pix-timer { font-size: 13px; color: #9ca3af; margin-bottom: 16px; }
        .pix-timer span { color: #f50000; font-weight: 700; }
        .pix-status { padding: 10px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 16px; }
        .pix-status.pending { background: #fef9c3; color: #854d0e; }
        .pix-status.paid { background: #dcfce7; color: #166534; }
        .success-screen { display: none; text-align: center; padding: 40px 20px; background: #fff; border-radius: 16px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .success-icon { width: 80px; height: 80px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
        .success-screen h2 { font-size: 22px; font-weight: 700; color: #1f2937; margin-bottom: 8px; }
        .success-screen p { font-size: 14px; color: #6b7280; margin-bottom: 24px; }
        .loading { display: inline-block; width: 20px; height: 20px; border: 3px solid rgba(255,255,255,.3); border-top-color: #fff; border-radius: 50%; animation: spin .7s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .hidden { display: none !important; }
    </style>
</head>
<body>

<div class="header">
    <button onclick="window.location.href='/pizzatop_v1/index.html'">
        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <h1>Finalizar Pedido</h1>
</div>

<div class="container">

    <div class="order-summary">
        <h2>🛒 Seu Pedido</h2>
        <?php foreach ($items as $item): ?>
        <div class="order-item">
            <?php if (!empty($item['image'])): ?>
            <img src="/pizzatop_v1/<?= htmlspecialchars($item['image']) ?>" alt="">
            <?php endif; ?>
            <div class="order-item-info">
                <div class="order-item-name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="order-item-qty">Qtd: <?= $item['quantity'] ?></div>
            </div>
            <div class="order-item-price">R$ <?= number_format($item['unit_price'] * $item['quantity'], 2, ',', '.') ?></div>
        </div>
        <?php endforeach; ?>
        <div class="order-totals">
            <div class="order-total-row"><span>Subtotal</span><span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span></div>
            <div class="order-total-row"><span>Frete</span><span class="green">Grátis</span></div>
            <div class="order-total-row total"><span>Total</span><span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span></div>
        </div>
    </div>

    <div class="steps">
        <div class="step active" id="step1-tab">1 Entrega</div>
        <div class="step" id="step2-tab">2 Pagamento</div>
    </div>

    <div id="step1" class="form-section">
        <h2>Detalhes de entrega</h2>
        <div class="form-group">
            <label>Nome Completo *</label>
            <input type="text" id="nome" placeholder="Seu nome completo">
        </div>
        <div class="form-group">
            <label>Telefone (WhatsApp) *</label>
            <input type="tel" id="telefone" placeholder="(00) 00000-0000" oninput="maskPhone(this)">
        </div>
        <div class="form-group">
            <label>CEP *</label>
            <div class="cep-wrap">
                <input type="text" id="cep" placeholder="00000-000" maxlength="9" oninput="maskCEP(this)">
                <button class="cep-btn" onclick="buscarCEP()">Buscar</button>
            </div>
        </div>
        <div class="form-group">
            <label>Rua *</label>
            <input type="text" id="rua" placeholder="Nome da rua">
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Número *</label>
                <input type="text" id="numero" placeholder="123">
            </div>
            <div class="form-group">
                <label>Complemento</label>
                <input type="text" id="complemento" placeholder="Apto, bloco...">
            </div>
        </div>
        <div class="form-group">
            <label>Bairro *</label>
            <input type="text" id="bairro" placeholder="Seu bairro">
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Cidade *</label>
                <input type="text" id="cidade" placeholder="Cidade">
            </div>
            <div class="form-group">
                <label>Estado *</label>
                <input type="text" id="estado" placeholder="SP" maxlength="2">
            </div>
        </div>
        <button class="btn-primary" onclick="irParaPagamento()">
            Confirmar endereço
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    <div id="step2" class="form-section hidden">
        <h2>💠 Pagamento via PIX</h2>
        <p style="font-size:13px;color:#6b7280;margin-bottom:16px;">Clique em <strong>Gerar PIX</strong> para receber o QR Code e finalizar seu pedido.</p>
        <button class="btn-secondary" onclick="voltarEntrega()">← Voltar</button>
        <button class="btn-primary" id="btn-gerar-pix" onclick="gerarPIX()">
            Gerar PIX
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    <div class="pix-screen" id="pix-screen">
        <h2>💠 Pague com PIX</h2>
        <p>Escaneie o QR Code ou copie o código abaixo</p>
        <div class="pix-qr">
            <img id="pix-qr-img" src="" alt="QR Code PIX">
        </div>
        <div class="pix-status pending" id="pix-status">⏳ Aguardando pagamento...</div>
        <div class="pix-timer">Expira em: <span id="pix-timer">--:--</span></div>
        <div class="pix-copy" id="pix-code">Gerando código...</div>
        <button class="btn-copy" onclick="copiarPIX()">📋 Copiar código PIX</button>
        <p style="font-size:12px;color:#9ca3af;">Após o pagamento, a confirmação é automática.</p>
    </div>

    <div class="success-screen" id="success-screen">
        <div class="success-icon">
            <svg width="40" height="40" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h2>Pagamento Confirmado! 🎉</h2>
        <p>Seu pedido foi recebido e já está sendo preparado.<br>Em breve entraremos em contato pelo WhatsApp.</p>
        <a href="/pizzatop_v1/" style="display:inline-block;margin-top:16px;font-size:13px;color:#6b7280;text-decoration:underline">Voltar ao cardápio</a>
    </div>

</div>

<script>
const TOTAL_CENTAVOS = <?= $subtotal * 100 ?>;

const cartItems = <?= json_encode(array_map(function($item) {
    return [
        'title' => $item['name'],
        'unitPrice' => (int)round($item['unit_price'] * 100),
        'quantity' => (int)$item['quantity']
    ];
}, $items)) ?>;

let pixTransactionId = null;
let pixCheckInterval = null;
let timerInterval = null;

function maskPhone(el) {
    let v = el.value.replace(/\D/g,'');
    if (v.length > 11) v = v.slice(0,11);
    if (v.length > 6) v = '(' + v.slice(0,2) + ') ' + v.slice(2,7) + '-' + v.slice(7);
    else if (v.length > 2) v = '(' + v.slice(0,2) + ') ' + v.slice(2);
    else if (v.length > 0) v = '(' + v;
    el.value = v;
}

function maskCEP(el) {
    let v = el.value.replace(/\D/g,'');
    if (v.length > 5) v = v.slice(0,5) + '-' + v.slice(5,8);
    el.value = v;
}

async function buscarCEP() {
    const cep = document.getElementById('cep').value.replace(/\D/g,'');
    if (cep.length !== 8) { alert('CEP inválido!'); return; }
    try {
        const r = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const d = await r.json();
        if (d.erro) { alert('CEP não encontrado!'); return; }
        document.getElementById('rua').value = d.logradouro || '';
        document.getElementById('bairro').value = d.bairro || '';
        document.getElementById('cidade').value = d.localidade || '';
        document.getElementById('estado').value = d.uf || '';
        document.getElementById('numero').focus();
    } catch(e) { alert('Erro ao buscar CEP.'); }
}

function irParaPagamento() {
    const nome = document.getElementById('nome').value.trim();
    const tel = document.getElementById('telefone').value.trim();
    const rua = document.getElementById('rua').value.trim();
    const numero = document.getElementById('numero').value.trim();
    const bairro = document.getElementById('bairro').value.trim();
    const cidade = document.getElementById('cidade').value.trim();
    if (!nome || !tel || !rua || !numero || !bairro || !cidade) {
        alert('Preencha todos os campos obrigatórios!');
        return;
    }
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
    document.getElementById('step1-tab').classList.remove('active');
    document.getElementById('step1-tab').classList.add('done');
    document.getElementById('step2-tab').classList.add('active');
    window.scrollTo(0, 0);
}

function voltarEntrega() {
    document.getElementById('step2').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
    document.getElementById('step2-tab').classList.remove('active');
    document.getElementById('step1-tab').classList.remove('done');
    document.getElementById('step1-tab').classList.add('active');
    window.scrollTo(0, 0);
}

function gerarCPFFicticio() {
    const n = () => Math.floor(Math.random() * 9) + 1;
    let cpf = '';
    for (let i = 0; i < 9; i++) cpf += n();
    let s1 = 0, s2 = 0;
    for (let i = 0; i < 9; i++) s1 += parseInt(cpf[i]) * (10 - i);
    let d1 = 11 - (s1 % 11); if (d1 >= 10) d1 = 0;
    cpf += d1;
    for (let i = 0; i < 10; i++) s2 += parseInt(cpf[i]) * (11 - i);
    let d2 = 11 - (s2 % 11); if (d2 >= 10) d2 = 0;
    cpf += d2;
    return cpf;
}

function gerarEmailFicticio(nome) {
    const clean = nome.toLowerCase().replace(/\s+/g, '.').replace(/[^a-z.]/g, '');
    const rand = Math.floor(Math.random() * 9000) + 1000;
    return `${clean}${rand}@pedido.com`;
}

async function gerarPIX() {
    const btn = document.getElementById('btn-gerar-pix');
    btn.disabled = true;
    btn.innerHTML = '<span class="loading"></span> Gerando PIX...';

    const nome = document.getElementById('nome').value.trim();
    const telefone = document.getElementById('telefone').value.replace(/\D/g,'');
    const rua = document.getElementById('rua').value.trim();
    const numero = document.getElementById('numero').value.trim();
    const complemento = document.getElementById('complemento').value.trim();
    const bairro = document.getElementById('bairro').value.trim();
    const cidade = document.getElementById('cidade').value.trim();
    const estado = document.getElementById('estado').value.trim().toUpperCase();
    const cep = document.getElementById('cep').value.replace(/\D/g,'');

    const cpf = gerarCPFFicticio();
    const email = gerarEmailFicticio(nome);

    const payload = {
        customer: {
            name: nome,
            email: email,
            phone: telefone,
            document: { number: cpf, type: 'CPF' }
        },
        shipping: {
            address: {
                street: rua,
                streetNumber: numero,
                complement: complemento || '',
                zipCode: cep,
                neighborhood: bairro,
                city: cidade,
                state: estado,
                country: 'BR'
            }
        },
        paymentMethod: 'PIX',
        amount: TOTAL_CENTAVOS,
        items: cartItems,
        pix: { expiresInDays: 1 },
        description: 'Pedido Pizzaria Top Pizza'
    };

    try {
        const response = await fetch('/pizzatop_v1/api/create-pix.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        // POR:
        if (!response.ok) {
            alert('Erro: ' + JSON.stringify(data));
            btn.disabled = false;
            btn.innerHTML = 'Gerar PIX';
         return;
        }

        pixTransactionId = data.id;

        document.getElementById('step2').classList.add('hidden');
        document.getElementById('pix-screen').style.display = 'block';
        window.scrollTo(0, 0);

        if (data.pix && data.pix.qrcode) {
    const qrText = data.pix.qrcodeText || data.pix.qrcode;
    document.getElementById('pix-qr-img').src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(qrText);
    
    document.getElementById('pix-code').textContent = qrText;}

        if (data.pix && data.pix.expirationDate) {
            iniciarTimer(new Date(data.pix.expirationDate));
        }

        pixCheckInterval = setInterval(() => verificarPagamento(data.id), 5000);

    } catch(e) {
        alert('Erro ao gerar PIX. Tente novamente.');
        btn.disabled = false;
        btn.innerHTML = 'Gerar PIX';
    }
}

async function verificarPagamento(id) {
    try {
        const r = await fetch(`/pizzatop_v1/api/check-pix.php?id=${id}`);
        const data = await r.json();
        if (data.status === 'paid') {
            clearInterval(pixCheckInterval);
            clearInterval(timerInterval);
            document.getElementById('pix-status').className = 'pix-status paid';
            document.getElementById('pix-status').textContent = '✅ Pagamento confirmado!';
            setTimeout(() => {
                document.getElementById('pix-screen').style.display = 'none';
                document.getElementById('success-screen').style.display = 'block';
                fetch('/pizzatop_v1/api/clear-cart.php', { method: 'POST' });
            }, 1500);
        }
    } catch(e) {}
}

function iniciarTimer(expiracao) {
    timerInterval = setInterval(() => {
        const diff = Math.floor((expiracao - new Date()) / 1000);
        if (diff <= 0) {
            clearInterval(timerInterval);
            document.getElementById('pix-timer').textContent = 'Expirado';
            return;
        }
        const h = Math.floor(diff / 3600);
        const m = Math.floor((diff % 3600) / 60);
        const s = diff % 60;
        document.getElementById('pix-timer').textContent =
            (h > 0 ? h + ':' : '') +
            String(m).padStart(2,'0') + ':' +
            String(s).padStart(2,'0');
    }, 1000);
}

function copiarPIX() {
    const code = document.getElementById('pix-code').textContent;
    navigator.clipboard.writeText(code).then(() => {
        alert('Código PIX copiado!');
    }).catch(() => {
        const el = document.createElement('textarea');
        el.value = code;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert('Código PIX copiado!');
    });
}
</script>
</body>
</html>