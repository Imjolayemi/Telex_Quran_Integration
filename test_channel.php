<?php
$url = "https://ping.telex.im/v1/webhooks/01952524-c782-745b-a22a-5695a65bbed4";
$data = array(
    "event_name" => "string",
    "message" => "welcome",
    "status" => "success",
    "username" => "collins"
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json'
));

$response = curl_exec($curl);
curl_close($curl);

echo $response;
?>


{
    "data": {
      "date": {
        "created_at": "2025-02-19",
        "updated_at": "2025-02-19"
      },
      "descriptions": {
        "app_description": "A bot that sends a daily Quranic verse with translation.",
        "app_logo": "https://iili.io/JqhkJOG.png",
        "app_name": "Daily Quranic Verse Bot",
        "app_url": "https://telex-quran-integration.onrender.com",
        "background_color": "#006400"
      },
      "integration_category": "Communication & Collaboration",
      "integration_type": "interval",
      "is_active": true,
  
      "key_features": [
        "Fetches a new Quranic verse every day.",
        "Includes Arabic text and translation.",
        "Supports multiple translations.",
        "Automated delivery to Telex channels."
      ],
      "permissions": {
        "monitoring_user": {
          "always_online": true,
          "display_name": "Quranic Verse Bot"
        }
      },
      "website": "https://telex-quran-integration.onrender.com/integration.json",
      "author": "Jolayemi",
      "settings": [
        {
          "label": "interval",
          "type": "text",
          "required": true,
          "default": "0 9 * * *"
        },
        {
          "label": "Surah Name",
          "type": "text",
          "required": true,
          "default": ""
        },
        {
          "label": "Ayah Number",
          "type": "number",
          "required": true,
          "default": "0"
        },
        {
          "label": "Arabic",
          "type": "text",
          "required": true,
          "default": ""
        },
        {
          "label": "English Translation",
          "type": "dropdown",
          "required": true,
          "default": "Muhammad Asad"
        }
      ],
      "tick_url": "https://telex-quran-integration.onrender.com/tick",
      "target_url": ""
    }
  }
  