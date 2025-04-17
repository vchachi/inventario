<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
        }
        .container {
            margin: 40px auto 10px;
            width: 100%;
        }
        .row {
            margin: 5px;
        }
        .td-bg {
            background-color: #f2f2f2;
        }
        .w-5 {
            width: 5%;
            display: inline-block;
        }
        .w-10 {
            width: 10%;
            display: inline-block;
        }
        .w-15 {
            width: 15%;
            display: inline-block;
        }
        .w-16 {
            width: 16%;
            display: inline-block;
        }
        .w-18 {
            width: 17.5%;
            display: inline-block;
        }
        .w-20 {
            width: 20%;
            display: inline-block;
        }
        .w-25 {
            width: 25%;
            display: inline-block;
        }
        .w-30 {
            width: 30%;
            display: inline-block;
        }
        .w-38 {
            width: 38%;
            display: inline-block;
        }
        .w-40 {
            width: 40%;
            display: inline-block;
        }
        .w-50 {
            width: 50%;
            display: inline-block;
        }
        .w-60 {
            width: 60%;
            display: inline-block;
        }
        .w-70 {
            width: 70%;
            display: inline-block;
        }
        .w-80 {
            width: 80%;
            display: inline-block;
        }
        .w-90 {
            display: inline-block;
            width: 90%;
        }
        .w-100 {
            display: inline-block;
            width: 100%;
        }
        .tc {
            text-align: center;
        }
        .tr {
            text-align: right;
        }
        .tl {
            text-align: left;
        }
        .bold {
            font-weight: bold;
        }
        .space {
            margin: 2px 1px;
        }
        .mt-10 {
            margin-top: 10px;
            box-sizing: border-box;
        }
        .mb-10 {
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .p-5 {
            padding: 5px;
            box-sizing: border-box;
        }
        .p-10 {
            padding: 10px;
            box-sizing: border-box;
        }
        .m-auto {
            display: inline-block;
            margin: auto;
        }
        ul {
            padding: 0px;
            margin: 0px;
        }
        .relative {
            position: relative;
        }
        .top {
            position: absolute;
            top: 0;
            width: 100%;
        }
        h1 {
            margin: 2px;
        }
        h2 {
            margin: 2px;
        }
        h3 {
            margin: 2px;
        }
        h4 {
            margin: 2px;
        }
        h5 {
            margin: 2px;
        }
        h6 {
            margin: 2px;
        }
        p {
            margin: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mb-10" style="min-height: 350px;">
            <div class="w-40 relative">
                <div class="top" style="top: 5px">
                    <div class="w-50 mb-10 tc" style="height: 120px; border: 2px solid #ddd"><h2 class="m-auto">LOGO</h2></div>
                    <div class="mt-10">
                        <h4 class="mb-10">Empresa SL</h4>
                        <p class="mb-10">NIF: B-000000000</p>
                        <p class="mb-10">Calle Nombre 0</p>
                        <p class="mb-10">Codigo Postal, Ciudad</p>
                        <p class="mb-10">Provincia, Pais</p>
                    </div>
                </div>
            </div>
            <div class="w-20 mt-10 tc relative">
                <div class="top" style="top: 100px">
                    <div class="w-70 mb-10 mt-10" style="height: 80px; border: 2px solid #ddd;"><h2 class="m-auto">Codigo QR</h2></div>
                    <p class="tc">Número reparación</p>
                </div>
            </div>
            <div class="w-38 tr relative">
                <div class="top">
                    <div class="mb-10 tl w-50">
                        <h2 class="tr mb-10">FACTURA</h2>
                        <h5 class="mb-10"><span style="color: #115a9f">NÚMERO FACTURA:</span> 4235232341</h5>
                        <h5><span style="color: #115a9f">FECHA FACTURA:</span> dd/mm/aaaa</h5>
                    </div>
                    <div class="mt-10 tl w-50">
                        <h4 class="mb-10" style="color: #115a9f">DESTINATARIO:</h4>
                        <p class="mb-10">Empresa Beta, S.L.</p>
                        <p class="mb-10">NIF: B00000000</p>
                        <p class="mb-10">Calle de la empresa, 23</p>
                        <p class="mb-10">28001 Cuidad (País)</p>
                        <p class="mb-10">email@empresa.es</p>
                        <p class="mb-10">Telf: +34-### ### ###</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-10" style="padding-bottom: 10px; border-bottom: 2px solid #115a9f;">
            <ul class="mb-10" style="border-bottom: 2px solid #115a9f;">   
                <li class="space w-10 p-5">CONCEPTO</li>
                <li class="space w-10 tc p-5">UNIDADES</li>
                <li class="space w-16 tc p-5">PRECIO UNITARIO</li>
                <li class="space w-10 tc p-5">DESCUENTO</li>
                <li class="space w-16 tc p-5">IMPORTE SIN IVA</li>
                <li class="space w-5 tc p-5">IVA(%)</li>
                <li class="space w-16 tc p-5">IMPORTE CON IVA</li>
            </ul>
            <ul>
                <li class="space w-10 td-bg p-5">Referencia 1</li>
                <li class="space w-10 td-bg tc p-5">10</li>
                <li class="space w-16 td-bg tc p-5">10,00 €</li>
                <li class="space w-10 td-bg tc p-5">0</li>
                <li class="space w-16 td-bg tc p-5">100,00 €</li>
                <li class="space w-5 td-bg tc p-5">21%</li>
                <li class="space w-16 td-bg tc p-5">121,00 €</li>
            </ul>
            <ul>
                <li class="space w-10 td-bg p-5">Referencia 2</li>
                <li class="space w-10 td-bg tc p-5">10</li>
                <li class="space w-16 td-bg tc p-5">10,00 €</li>
                <li class="space w-10 td-bg tc p-5">0</li>
                <li class="space w-16 td-bg tc p-5">100,00 €</li>
                <li class="space w-5 td-bg tc p-5">21%</li>
                <li class="space w-16 td-bg tc p-5">121,00 €</li>
            </ul>
            <ul>
                <li class="space w-10 td-bg p-5">Referencia 3</li>
                <li class="space w-10 td-bg tc p-5">10</li>
                <li class="space w-16 td-bg tc p-5">10,00 €</li>
                <li class="space w-10 td-bg tc p-5">0</li>
                <li class="space w-16 td-bg tc p-5">100,00 €</li>
                <li class="space w-5 td-bg tc p-5">21%</li>
                <li class="space w-16 td-bg tc p-5">121,00 €</li>
            </ul>
            <ul>
                <li class="space w-10 td-bg p-5">Referencia 4</li>
                <li class="space w-10 td-bg tc p-5">10</li>
                <li class="space w-16 td-bg tc p-5">10,00 €</li>
                <li class="space w-10 td-bg tc p-5">0</li>
                <li class="space w-16 td-bg tc p-5">100,00 €</li>
                <li class="space w-5 td-bg tc p-5">21%</li>
                <li class="space w-16 td-bg tc p-5">121,00 €</li>
            </ul>
        </div>
        <div class="row mt-10" style="height: 230px;">
            <div class="w-40 mt-10 mb-10 relative">
                <div class="top" style="top: 60px;">   
                    <h6 style="color: #115a9f">FORMA DE PAGO</h6>
                    <p>TRANSFERENCIA BANCARIA</p>
                    <p><span class="bold">Banco:</span> Entidad Financiera </p>
                    <p><span class="bold">Nº de cuenta:</span> ES00 0000 0000 0000 0000</p>
                </div>
            </div>
            <div class="w-18 relative"></div>
            <div class="w-40 tr relative">
                <div class="top">
                    <ul>
                        <li class="w-50 space td-bg tc p-5">Total Descuento</li>
                        <li class="w-40 space td-bg tr p-5">0,00 €</li>
                    </ul>
                    <ul>
                        <li class="w-50 space td-bg tc p-5">Subtotal</li>
                        <li class="w-40 space td-bg tr p-5">508,00 €</li>
                    </ul>
                    <ul>
                        <li class="w-50 space td-bg tc p-5">Recargo</li>
                        <li class="w-40 space td-bg tr p-5">96,52 €</li>
                    </ul>
                    <ul>
                        <li class="w-50 space td-bg tc p-5">Total</li>
                        <li class="w-40 space td-bg tr p-5">105,91 €</li>
                    </ul>
                    <ul>
                        <li class="w-50 space tc p-5" style="color: #fff; background-color: #115a9f;">Total</li>
                        <li class="w-40 space tr p-5" style="color: #fff; background-color: #115a9f;">{{$repairs->repair_cost}} €</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mb-10" style="border-bottom: 2px solid #ddd;">
            <p class="mb-10">OBSERVACIONES:</p>
        </div>
        <div class="row p-10">
            <h4 style="color: #ff0402" class="tc">Zona para que pueda poner el texto de ley proteccion de datos y garantia</h4>
            <p class="tc">
                <span style="color: #115a9f">Lorem ipsum dolor sit amet, consectetur adipiscing</span> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            </p>
        </div>
    </div>
</body>
</html>