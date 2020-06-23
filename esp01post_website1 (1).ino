#include <dht11.h>

#include "SoftwareSerial.h"

String ssid = "Realme1"; //HOTSPOT KA naam

String password = "Zendra@123A";	//hotspot ka password

SoftwareSerial esp(6, 7); // RX=pin 6 , tx=pin 7 during code uploading and after that during operation rx=pin 7 and tx=pin 6

String data;
float aqi;
float humid;
float temp;
float dustDensity;

String server = "atmosphereiot.000webhostapp.com"; // local server ip address i.e tumhare laptop ka ip address jispe server bana hai

String uri = "/postdemo.php"; // location of  file which will post the data recieved to the mysql database
String temp ,humid ,aqi ,dustDensity;

void setup() {

  esp.begin(9600); //baud rate of esp

  Serial.begin(9600); //baud rate of serial

  reset(); // first reset the esp01 module

  connectWifi(); // then connect to wifi

}

//reset the esp8266 module

void reset() {

  esp.println("AT+RST");

  delay(1000);

  if (esp.find("OK")) Serial.println("Module Reset");

}

//connect to your wifi network

void connectWifi() {

  String cmd = "AT+CWJAP=\"" + ssid + "\",\"" + password + "\"";

  esp.println(cmd);

  delay(4000);

  if (esp.find("OK")) {

    Serial.println("Connected!");

  }

}



void loop() {

  aqi = analogRead(A0);  // Read sensor value and stores in a variable aq

  Serial.print("Airquality = ");

  Serial.println(aqi);

  
  int chk = DHT11.read(DHT11PIN);       // Read sensor value and stores in a variable 

  float humid = DHT11.humidity ;

  Serial.print("Humidity (%): ");
  Serial.println(humid, 2);

  float temp = DHT11.temperature
  Serial.print("Temperature (C): ");
  Serial.println(temp, 2);
 

  digitalWrite(ledPower,LOW);
  delayMicroseconds(samplingTime);

  voMeasured = analogRead(measurePin);

  delayMicroseconds(deltaTime);
  digitalWrite(ledPower,HIGH);
  delayMicroseconds(sleepTime);

  calcVoltage = voMeasured*(5.0/1024);
  dustDensity = 0.17*calcVoltage-0.1;

  if ( dustDensity < 0)
  {
    dustDensity = 0.00;
  }

  Serial.println("Raw Signal Value (0-1023):");
  Serial.println(voMeasured);

  Serial.println("Voltage:");
  Serial.println(calcVoltage);

  Serial.println("Dust Density:");
  Serial.println(dustDensity);

  delay(1000);  

  data = "aqipost=" + aqi + "&temppost=" + temp + "&hrvpost=" + humid + "&dustdenpost=" + dustDensity; // data sent must be under this form . if you change this remember to change the same in postdemo.php

  httppost();

  delay(1000);

}

void httppost() {

  esp.println("AT+CIPSTART=\"TCP\",\"" + server + "\",80"); //start a TCP connection.

  if (esp.find("OK")) {

    Serial.println("TCP connection ready");

  }
  delay(1000);

  String postRequest =

    "POST " + uri + " HTTP/1.0\r\n" +

    "Host: " + server + "\r\n" +

    "Accept: *" + "/" + "*\r\n" +

    "Content-Length: " + data.length() + "\r\n" +

    "Content-Type: application/x-www-form-urlencoded\r\n" +

    "\r\n" + data;

  String sendCmd = "AT+CIPSEND="; //determine the number of caracters to be sent.

  esp.print(sendCmd);

  esp.println(postRequest.length());

  delay(500);

  if (esp.find(">")) {
    Serial.println("Sending..");
    esp.print(postRequest);

    if (esp.find("SEND OK")) {
      Serial.println("Packet sent");

      while (esp.available()) {

        String tmpResp = esp.readString();

        Serial.println(tmpResp);

      }

      // close the connection

      esp.println("AT+CIPCLOSE");

    }

  }
}
