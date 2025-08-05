<?php
header('Content-Type: application/json');
error_reporting(0);

$url = 'https://sinalpublico.vercel.app/';
$html = @file_get_contents($url);

if (!$html) {
    echo json_encode(['error' => 'Não foi possível carregar a página']);
    exit;
}

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$divs = $xpath->query('//div[contains(@class, "channel")]');

$canais = [];

foreach ($divs as $div) {
    $dataUrl = $div->getAttribute('data-url');
    $dataName = $div->getAttribute('data-name');
    
    $imgTag = $div->getElementsByTagName('img')->item(0);
    $imgSrc = $imgTag ? $imgTag->getAttribute('src') : '';

    $canais[] = [
        'nome' => $dataName,
        'logo' => $imgSrc,
        'link' => $dataUrl
    ];
}

echo json_encode($canais, JSON_UNESCAPED_UNICODE);
