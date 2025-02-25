<?php

// Step 1: Fetch Quranic Verse from API
$quranApiUrl = "https://telex-quran-integration.onrender.com/";

$fetchCurl = curl_init($quranApiUrl);
curl_setopt($fetchCurl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($fetchCurl, CURLOPT_HTTPHEADER, array(
    'Accept: application/json'
));

$quranResponse = curl_exec($fetchCurl);
curl_close($fetchCurl);

// Check if API response is valid JSON
$quranData = json_decode($quranResponse, true);
if (json_last_error() !== JSON_ERROR_NONE || !isset($quranData["ayah_global_number"])) {
    die("❌ Failed to fetch Quranic verse.");
}

// Extract verse details
$ayahNumber = $quranData["ayah_global_number"];
$surah = $quranData["surah"];
$ayahInSurah = $quranData["ayah_number_in_surah"];
$arabicText = $quranData["arabic"];
$englishTranslation = $quranData["english_translation"];

// Step 2: Send Data to Telex Channel
$telexWebhookUrl = "https://ping.telex.im/v1/webhooks/01952f84-0017-76a5-94a9-b231fcfe2d4e";

$message = "📖 *Quran Verse of the Day*\n\n"
         . "📜 Surah: *$surah* (Ayah $ayahInSurah)\n"
         . "📖 Arabic: $arabicText\n"
         . "📚 Translation: \"$englishTranslation\"\n";

$data = array(
    "event_name" => "daily_quran_verse",
    "message" => $message,
    "status" => "success",
    "username" => "QuranBot",

 );

$sendCurl = curl_init($telexWebhookUrl);
curl_setopt($sendCurl, CURLOPT_POST, true);
curl_setopt($sendCurl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($sendCurl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($sendCurl, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json'
));

$response = curl_exec($sendCurl);
curl_close($sendCurl);

echo "Response from Telex: " . $response;

?>
