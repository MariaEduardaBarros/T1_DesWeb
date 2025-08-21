<?php

require 'autoloader.php';

session_start();
$total = $_SESSION['total'];
$usuario = $_SESSION['usuario'];

use OpenBoleto\Banco\Santander;
use OpenBoleto\Agente;

$sacado = new Agente($usuario->Nome, $usuario->CPF, $usuario->Endereco, null, null, null);
$cedente = new Agente('Empresa T3EK LTDA', '02.123.123/0001-11', 'Centro 400 Loja 4', '29500-000', 'Alegre', 'ES');

$boleto = new Santander(array(
    // Parâmetros obrigatórios
    'dataVencimento' => new DateTime('+7 Days'),
    'valor' => $total,
    'sequencial' => 12345678901, // Até 13 dígitos
    'sacado' => $sacado,
    'cedente' => $cedente,
    'agencia' => 1234, // Até 4 dígitos
    'carteira' => 102, // 101, 102 ou 201
    'conta' => 1234567, // Código do cedente: Até 7 dígitos
     // IOS – Seguradoras (Se 7% informar 7. Limitado a 9%)
     // Demais clientes usar 0 (zero)
    'ios' => '0', // Apenas para o Santander

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
    //'moeda' => Santander::MOEDA_REAL,
    //'dataDocumento' => new DateTime(),
    //'dataProcessamento' => new DateTime(),
    //'contraApresentacao' => true,
    //'pagamentoMinimo' => 23.00,
    //'aceite' => 'N',
    //'especieDoc' => 'ABC',
    //'numeroDocumento' => '123.456.789',
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
