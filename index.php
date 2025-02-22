<?php

header('Content-Type: application/json; charset=UTF-8');

// Allow requests from any origin + explicitly allow Telex
$allowedOrigins = [
    'https://telex.im',
    'https://*.telex.im',
    'http://telextest.im',
    'http://staging.telextest.im'
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '*';

// Allow only specified Telex domains
if (in_array($origin, $allowedOrigins) || fnmatch('https://*.telex.im', $origin)) {
    header("Access-Control-Allow-Origin: $origin");
} else {
    header("Access-Control-Allow-Origin: *");
}

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Define total Ayahs in Quran
$totalAyahs = 6236;

// Select a random Ayah
$globalAyahNumber = rand(1, $totalAyahs);

// API URLs for Arabic and English translations
$arabicApiUrl = "https://api.alquran.cloud/v1/ayah/$globalAyahNumber/quran-uthmani"; // Arabic (Uthmani script)
$englishApiUrl = "https://api.alquran.cloud/v1/ayah/$globalAyahNumber/en.asad"; // English (Asad translation)

// Function to fetch data from API
function fetch_quran_ayah($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout to prevent hanging requests

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        return null; // Return null if API request fails
    }

    // Check if response is already JSON
    $decoded = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        return $decoded; // Return decoded JSON instead of a string
    }

    return null;
}

// Fetch Arabic and English translations
$arabicData = fetch_quran_ayah($arabicApiUrl);
$englishData = fetch_quran_ayah($englishApiUrl);

// Validate API response
if (!$arabicData || !$englishData || !isset($arabicData['data']) || !isset($englishData['data'])) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to fetch Quranic verse. Please try again later."], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Extract relevant data
$surahName = $englishData['data']['surah']['englishName']; // Surah name in English
$ayahInSurah = $englishData['data']['numberInSurah']; // Ayah number within the Surah
$arabicText = $arabicData['data']['text']; // Arabic text (Uthmani script)
$englishText = $englishData['data']['text']; // English translation

// Prepare JSON response
$output = [
    "ayah_global_number" => $globalAyahNumber, // Global Ayah number (1-6236)
    "surah" => $surahName,
    "ayah_number_in_surah" => $ayahInSurah,
    "arabic" => $arabicText,
    "english_translation" => $englishText,
    "source" => "Al-Quran Cloud API"
];

// Prevent double serialization by checking if output is already JSON
if (!is_string($output) || json_decode($output) === null) {
    echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {
    echo $output;
}

?>
