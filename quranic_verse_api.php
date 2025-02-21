<?php

// // Fetch a random Quranic verse from Al-Quran Cloud API
// $quranApiUrl = "https://api.alquran.cloud/v1/ayah/" . 2 . "/en.asad"; // Fetches a random Ayah with translation

// // Use cURL to make the API request
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $quranApiUrl);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $response = curl_exec($ch);
// curl_close($ch);

// // Decode JSON response
// $data = json_decode($response, true);

// // Check if the API returned a valid response
// if ($data && isset($data['data'])) {
//     // Extract verse details
//     $ayahText = $data['data']['text']; // Arabic text
//     $translation = $data['data']['edition']['name']; // Translation name
//     $ayahNumber = $data['data']['numberInSurah']; // Ayah number
//     $surahName = $data['data']['surah']['englishName']; // Surah name

//     // Prepare JSON response
//     $output = [
//         "surah" => $surahName,
//         "ayah_number" => $ayahNumber,
//         "verse" => $ayahText,
//         "translation" => $translation,
//         "source" => "Al-Quran Cloud API"
//     ];

//     // Set header for JSON response
//     header('Content-Type: application/json');
//     echo json_encode($output, JSON_PRETTY_PRINT);
// } else {
//     // Return an error message in JSON format
//     header('Content-Type: application/json');
//     echo json_encode(["error" => "Failed to fetch Quranic verse"], JSON_PRETTY_PRINT);
// }

?>

<?php

// Specify the Ayah number you want (random or specific)
$ayahNumber = 2; // You can change this to any Ayah number

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
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>

