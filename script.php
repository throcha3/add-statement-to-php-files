<?php

// Caminho para a pasta onde os arquivos de teste estão localizados
$directory = __DIR__ . '/tests/Feature';

// Função para adicionar o use statement na 5ª linha do arquivo PHP
function addUseStatement($filePath) {
    // O use statement a ser adicionado
    $useStatement = 'use PHPUnit\Framework\Attributes\Test;';

    // Ler o conteúdo do arquivo
    $lines = file($filePath);

    // Verificar se o arquivo tem menos de 5 linhas
    if (count($lines) < 5) {
        // Adicionar linhas em branco até alcançar a 5ª linha
        while (count($lines) < 5) {
            $lines[] = PHP_EOL;
        }
    }

    // Adicionar o use statement na 5ª linha (índice 4)
    array_splice($lines, 4, 0, $useStatement . PHP_EOL);

    // Escrever o conteúdo modificado de volta no arquivo
    file_put_contents($filePath, implode('', $lines));
    echo "Adicionado use statement na 5ª linha do arquivo: $filePath\n";
}

// Função recursiva para percorrer a pasta e processar os arquivos PHP
function processDirectory($dir) {
    //var_dump($dir);die;
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $filePath = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($filePath)) {
            processDirectory($filePath);
        } elseif (pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
            addUseStatement($filePath);
        }
    }
}

// Iniciar o processo na pasta de testes
processDirectory($directory);
