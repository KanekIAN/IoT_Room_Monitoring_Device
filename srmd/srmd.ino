#include <WiFi.h>
#include <HTTPClient.h>
#include <DHT.h>

#define FLAME_PIN 5
#define BUZZER_PIN 19
#define DHTPIN 4
#define PIR_PIN 27
#define SMOKE_SENSOR_PIN 32
#define DOOR_SENSOR_PIN 25
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// const char* ssid = "UrWhatUsay";
// const char* password = "janganlupa12";
// const char* serverUrl = "http://192.168.18.5:8000/api/datasensor";

// const char* ssid = "smartroom";
// const char* password = "smartroom519";
// const char* serverUrl = "http://192.168.1.149:8000/api/datasensor";

// const char* ssid = "Redmi Note 11";
// const char* password = "janganlupa12";
// const char* serverUrl = "http://192.168.240.16:8000/api/datasensor";

// const char* ssid = "SAWCON DEEZ";
// const char* password = "peepeepoopoo";
// const char* serverUrl = "http://192.168.83.16:8000/api/datasensor";

// const char* ssid = "Wammu";
// const char* password = "2444666668888888LOL";
// const char* serverUrl = "http://192.168.214.16:8000/api/datasensor";

const char* ssid = "Mili's";
const char* password = "cewenyahyunjin";
const char* serverUrl = "http://192.168.199.16:8000/api/datasensor";

int flameValue;
int pirValue;
int smokeSensorValue;
int doorState;

void connectWiFi() {
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("WiFi TERSAMBUNG!");
}

void setup() {
  Serial.begin(9600);
  pinMode(FLAME_PIN, INPUT);
  pinMode(BUZZER_PIN, OUTPUT);
  pinMode(PIR_PIN, INPUT);
  pinMode(SMOKE_SENSOR_PIN, INPUT); 
  pinMode(DOOR_SENSOR_PIN, INPUT_PULLUP);
  dht.begin();
  connectWiFi();
}

void loop() {

  float h = dht.readHumidity();
  float t = dht.readTemperature();

  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.println("%");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.println(" Celsius");

  flameValue = digitalRead(FLAME_PIN);
  if (flameValue == HIGH) {
    Serial.println("FLAME DETECTED!");
    digitalWrite(BUZZER_PIN, HIGH);  
  } else {
    Serial.println("No Flame.");
    digitalWrite(BUZZER_PIN, LOW);   
  }

  pirValue = digitalRead(PIR_PIN);
  if (pirValue == HIGH) {
    Serial.println("Motion Detected!");

  } else {
    Serial.println("No Motion.");
    
  }

  smokeSensorValue = analogRead(SMOKE_SENSOR_PIN);
  if (smokeSensorValue > 100) {
    Serial.println("TERDETEKSI GAS!");
  } else{ 
    Serial.println("Tidak ada Gas.");
  }  

  doorState = digitalRead(DOOR_SENSOR_PIN);
  if (doorState == HIGH) {
    Serial.println("PINTU TERBUKA!");
  } else {
    Serial.println("Pintu Tertutup.");
  }

String postData = "{\"suhu\":" + String(t) +
                    ",\"kelembapan\":" + String(h) +
                    ",\"api\":" + String(flameValue) +
                    ",\"asap\":" + String(smokeSensorValue) +
                    ",\"motion\":" + String(pirValue) +
                    ",\"pintu\":" + String(doorState) +
                    ",\"buzzer\":" + String(digitalRead(BUZZER_PIN)) +
                    "}";

  //HTTP
  HTTPClient http;
  http.begin(serverUrl);
  http.addHeader("Content-Type", "application/json");

  int httpResponseCode = http.POST(postData);

  if (httpResponseCode == 200) {
    Serial.println("Data Sent Successfully");
  } else {
    Serial.print("Error sending data. HTTP response code: ");
    Serial.println(httpResponseCode);
  }

    http.end();

  Serial.println(" ");
  delay(1000);
}
