<?php
header('Content-Type: application/json; charset=UTF-8');

// Specify the Ayah number you want (random or specific)
$ayahNumber = rand(1, 6325); // You can change this to any Ayah number

// API URLs for Arabic and English translations
$arabicApiUrl = "https://api.alquran.cloud/v1/ayah/$ayahNumber/quran-uthmani"; // Arabic (Uthmani script)
$englishApiUrl = "https://api.alquran.cloud/v1/ayah/$ayahNumber/en.asad"; // English (Asad translation)

// Function to fetch data from API
function fetch_quran_ayah($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// Fetch Arabic and English translations
$arabicData = fetch_quran_ayah($arabicApiUrl);
$englishData = fetch_quran_ayah($englishApiUrl);

// Check if both responses are valid
if (!isset($arabicData['data']) || !isset($englishData['data'])) {
    echo json_encode(["error" => "Failed to fetch Quranic verse"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Extract relevant data
$surahName = $englishData['data']['surah']['englishName']; // Surah name in English
$ayahNumber = $englishData['data']['numberInSurah']; // Ayah number in the Surah
$arabicText = $arabicData['data']['text']; // Arabic text (Uthmani script)
$englishText = $englishData['data']['text']; // English translation

// Prepare JSON response
$output = [
    "surah" => $surahName,
    "ayah_number" => $ayahNumber,
    "arabic" => $arabicText,
    "english_translation" => $englishText,
    "source" => "Al-Quran Cloud API"
];

// Set JSON response headers
echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>

