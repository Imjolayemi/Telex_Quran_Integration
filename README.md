# Telex Quran Integration

## Overview
This integration fetches a daily Quranic verse using the **Al-Quran Cloud API** and makes it available via Telex as an interval-based integration. The integration runs periodically and sends the retrieved verse to the specified output channel.

## Features
- Fetches a daily Quranic verse.
- Uses the **Al-Quran Cloud API** for verse retrieval.
- Sends the verse to Telex as an interval-based integration.
- Outputs data in JSON format for easy processing.

## Integration Specification

### Integration Name
**Telex Quran Integration**

### Integration Category
**Spiritual & Motivation**

### Integration Type
**Interval** (Runs at scheduled intervals to fetch and send a Quranic verse)

### JSON Specification
```json
{
  "data": {
    "date": {
      "created_at": "YYYY-MM-DD",
      "updated_at": "YYYY-MM-DD"
    },
    "descriptions": {
      "app_description": "Fetches and sends a daily Quranic verse.",
      "app_logo": "https://example.com/quran-logo.png",
      "app_name": "Telex Quran Integration",
      "app_url": "https://example.com/telex-quran",
      "background_color": "#008000"
    },
    "integration_category": "Spiritual & Motivation",
    "integration_type": "interval",
    "is_active": true,
    "output": [
      {
        "label": "quranic_verse",
        "value": true
      }
    ],
    "key_features": [
      "Daily Quranic verse retrieval.",
      "Automated scheduling using Telex.",
      "Easy JSON format output."
    ],
    "permissions": {
      "monitoring_user": {
        "always_online": true,
        "display_name": "Quran Verse Bot"
      }
    },
    "settings": [
      {
        "label": "interval",
        "type": "text",
        "required": true,
        "default": "0 6 * * *"
      }
    ],
    "tick_url": "https://example.com/quran-tick-url",
    "target_url": "https://example.com/quran-fetch"
  }
}
```

## Setup Instructions

### 1. Clone the Repository
```sh
git clone https://github.com/imjolayemi/Telex-Quran-Integration.git
cd Telex-Quran-Integration
```

### 2. Install Dependencies (if needed)
```sh
composer install  # If using PHP with Composer
```

### 3. Create `telex-quran-integration.json`
Save the JSON specification above in a file named `telex-quran-integration.json` and host it online (e.g., GitHub Pages, Firebase Hosting, or your own server).

### 4. Run Locally (PHP Server)
```sh
php -S localhost:8000
```
Then, access it at:
```
http://localhost:8000
```

### 5. Deploy to the Internet
If you want to make the service accessible globally, use one of these methods:
- **Ngrok** (for temporary testing):
  ```sh
  ngrok http 8000
  ```
- **Port Forwarding** (if you have router access)
- **Cloud Hosting** (VPS, DigitalOcean, AWS, etc.)

## API Endpoint (Fetching the Verse)

### Example Request
```sh
GET https://api.alquran.cloud/v1/ayah/random
```

### Example Response
```json
{
  "code": 200,
  "status": "OK",
  "data": {
    "number": 255,
    "text": "Allah! There is no deity except Him, the Ever-Living, the Sustainer of existence...",
    "edition": {
      "identifier": "en.sahih",
      "language": "en",
      "name": "Saheeh International"
    }
  }
}
```

## License
This project is licensed under the MIT License. Feel free to modify and distribute.

---
**Maintained by:** Jolayemi  
**GitHub:** [Link](https://github.com/imjolayemi/)

**Contact:** imlandlord1@gmail.com / njolayemi@gmail.com


