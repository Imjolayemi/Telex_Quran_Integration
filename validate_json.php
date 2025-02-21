<?php
$json = file_get_contents('telex-quran-integration.json');
$data = json_decode($json);

if (json_last_error() === JSON_ERROR_NONE) {
    echo "✅ JSON is valid!";
} else {
    echo "❌ JSON is invalid: " . json_last_error_msg();
}
?>
