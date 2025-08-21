<?php

require 'autoloader.php';

session_start();
$total = $_SESSION['total'];
$usuario = $_SESSION['usuario'];

use OpenBoleto\Banco\Itau;
use OpenBoleto\Agente;

$sacado = new Agente($usuario->Nome, $usuario->CPF, $usuario->Endereco, null, null, null);
$cedente = new Agente('Empresa T3EK LTDA', '02.123.123/0001-11', 'Centro 400 Loja 4', '29500-000', 'Alegre', 'ES');

$boleto = new Itau(array(
    // Parâmetros obrigatórios
    'dataVencimento' => new DateTime('+7 Days'),
    'valor' => $total,
    'sequencial' => 12345678, // 8 dígitos
    'sacado' => $sacado,
    'cedente' => $cedente,
    'agencia' => 1724, // 4 dígitos
    'carteira' => 112, // 3 dígitos
    'conta' => 12345, // 5 dígitos
    
    // Parâmetro obrigatório somente se a carteira for
    // 107, 122, 142, 143, 196 ou 198
    'codigoCliente' => 12345, // 5 dígitos
    'numeroDocumento' => 1234567, // 7 dígitos

    // Parâmetros recomendáveis
    //'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
    'contaDv' => 2,
    'agenciaDv' => 1,
    'descricaoDemonstrativo' => array( // Até 5
        'Compra de materiais cosméticos',
        'Compra de alicate',
    ),
    'instrucoes' => array( // Até 8
        'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
        'Não receber após o vencimento.',
    ),

    // Parâmetros opcionais
    //'resourcePath' => '../resources',
    //'moeda' => Itau::MOEDA_REAL,
    //'dataDocumento' => new DateTime(),
    //'dataProcessamento' => new DateTime(),
    //'contraApresentacao' => true,
    //'pagamentoMinimo' => 23.00,
    //'aceite' => 'N',
    //'especieDoc' => 'ABC',
    //'usoBanco' => 'Uso banco',
    //'layout' => 'layout.phtml',
    //'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
    //'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
    //'descontosAbatimentos' => 123.12,
    //'moraMulta' => 123.12,
    //'outrasDeducoes' => 123.12,
    //'outrosAcrescimos' => 123.12,
    //'valorCobrado' => 123.12,
    //'valorUnitario' => 123.12,
    //'quantidade' => 1,
));

echo $boleto->getOutput();
