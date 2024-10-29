<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

// .env dosyasını yükleyin
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $apiKey = $_ENV['API_KEY'];
    $apiUrl = $_ENV['API_URL'];

    // API anahtarının doğruluğunu kontrol edin
    if (!$apiKey) {
        echo json_encode(["error" => "API anahtarı eksik veya geçersiz."]);
        exit;
    }

    // URL'yi doğru biçimlendirin
    $fullUrl = "{$apiUrl}?q={$city}&appid={$apiKey}&units=metric&lang=tr";

    try {
        $response = file_get_contents($fullUrl);
        if ($response === FALSE) {
            throw new Exception("API isteği başarısız.");
        }
        echo $response;
    } catch (Exception $e) {
        echo json_encode(["error" => "Bir hata oluştu: " . $e->getMessage()]);
    }
    exit;
}
?>
