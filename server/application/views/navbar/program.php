 <!-- Basic Card Example -->
 <h3 class="text-warning mx-3">Contoh Program </h3>

 <p class="text-gray-800 mx-5">Di bawah ini di sajikan beberapa contoh program.</p>

 <h3 class="text-dark mx-3"> Program Mikrokontroller (C++) </h3>
 <p class="text-gray-800 mx-5">Untuk bisa mengirim data ke Mestakung Clouds Device perlu di program sesuai ketentuan. Ada beberapa library yang harus anda gunakan yaitu <a href="https://arduinojson.org/v6/doc/">ArduinoJson</a> dan <a href="https://www.arduino.cc/reference/en/libraries/pubsubclient/">PubSubClient.</a></p>
 <div class="col lg-6">
     <div class="card shadow mb-4 ">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Library</h6>
         </div>
         <div class="card-body">
             <p> #include < ArduinoJson.h> <br>
                     #include < PubSubClient.h>
             </p>
         </div>
     </div>
 </div>
 <p class="text-gray-800 mx-5">Setting alamat MQTT Broker seperti gambar di bawah.</p>
 <div class="col lg-6">
     <div class="card shadow mb-4 ">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Setting MQTT</h6>
         </div>
         <div class="card-body">
             <p>
                 const char* mqtt_server = "192.168.100.147";
             </p>
         </div>
     </div>
 </div>
 <p class="text-gray-800 mx-5">Kemudian mengirim data sensor ke MQTT Broker. Data yang dikirm haruslah berbentuk Json (JavaScript Object Notation). Isi data Json yang dikirim adalah sebagai berikut :
 </p>
 <ul lass="list-unstyled text-dark mx-3">
     <li> chip_id.</li>
     <li> key_device.</li>
     <li> nama_header.</li>
     <li> code (code header dapat dilihat <a href="<?= base_url('home/mydevice'); ?>">disini</a>).</li>
     <li> nilai ( berisi nilai sensor sesuai bacaan).</li>
 </ul>
 <p class="text-gray-800 mx-5"> Di bawah ini akan disajikan contoh programnya.
 </p>
 <div class="col lg-6">
     <div class="card shadow mb-4 ">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Json</h6>
         </div>
         <div class="card-body">
             <p>
                 float nilai1 = random(28,32); <br>
                 float nilai2 = random(28,32); <br>
                 char buffer[256]; <br>
                 const int capacity = JSON_ARRAY_SIZE(5) + 2*JSON_OBJECT_SIZE(5); <br>
                 StaticJsonDocument< capacity> doc; <br>
                     JsonObject obj = doc.createNestedObject(); <br>
                     obj["chip_id"] = "SMT1";<br>
                     obj["key_device"] = "6834981364891"; <br>
                     obj["nama_header"] = "smartmeter"; <br>
                     JsonArray code = obj.createNestedArray("code");<br>
                     code.add(1);<br>
                     code.add(2);<br>
                     JsonArray nilai = obj.createNestedArray("nilai");<br>
                     nilai.add(nilai1);<br>
                     nilai.add(nilai2);<b></b>
         </div>
     </div>
 </div>
 <p class="text-gray-800 mx-5">Contoh penuh program :
 </p>
 <div class="col lg-6">
     <div class="card shadow mb-4 ">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Json</h6>
         </div>
         <div class="card-body">
             <p>
                 #include < ArduinoJson.h> <br>
                     #include < PubSubClient.h><br>
                         #include < ESP8266WiFi.h><br>
                             // Update these with values suitable for your network.<br>

                             const char* ssid = "Sangkan Paraning Dumadi";<br>
                             const char* password = "wongjowo123";<br>
                             const char* mqtt_server = "192.168.100.147";<br>
                             <br>
                             WiFiClient espClient;<br>
                             PubSubClient client(espClient);<br>
                             unsigned long lastMsg = 0;<br>
                             #define MSG_BUFFER_SIZE (50)<br>
                             char msg[MSG_BUFFER_SIZE];<br>
                             int value = 0;<br>

                             void setup_wifi() {<br>

                             delay(10);<br>
                             // We start by connecting to a WiFi network<br>
                             Serial.println();<br>
                             Serial.print("Connecting to ");<br>
                             Serial.println(ssid);<br>

                             WiFi.mode(WIFI_STA);<br>
                             WiFi.begin(ssid, password);<br>
                             <br>
                             while (WiFi.status() != WL_CONNECTED) {<br>
                             delay(500);<br>
                             Serial.print(".");<br>
                             }<br>
                             <br>
                             randomSeed(micros());<br>
                             <br>
                             Serial.println("");<br>
                             Serial.println("WiFi connected");<br>
                             Serial.println("IP address: ");<br>
                             Serial.println(WiFi.localIP());<br>
                             }<br>
                             <br>
                             void callback(char* topic, byte* payload, unsigned int length) {<br>
                             Serial.print("Message arrived [");<br>
                             Serial.print(topic);<br>
                             Serial.print("] ");<br>
                             for (int i = 0; i < length; i++) { Serial.print((char)payload[i]); } Serial.println();<br>
                                 // Switch on the LED if an 1 was received as first character <br>
                                 if ((char)payload[0]=='1' ) { <br>
                                 digitalWrite(BUILTIN_LED, LOW); <br>
                                 // Turn the LED on (Note that LOW is the voltage level <br>
                                 // but actually the LED is on; this is because <br>
                                 // it is active low on the ESP-01) } else { digitalWrite(BUILTIN_LED, HIGH); <br>
                                 // Turn the LED off by making the voltage HIGH } } <br>
                                 void reconnect() { <br>
                                 // Loop until we're reconnected <br>
                                 while (!client.connected()) { <br>
                                 Serial.print("Attempting MQTT connection..."); <br>
                                 // Create a random client ID <br>
                                 String clientId="ESP8266Client-" ;<br>
                                 clientId +=String(random(0xffff), HEX); <br>
                                 // Attempt to connect <br>
                                 if (client.connect(clientId.c_str())) { <br>
                                 Serial.println("connected"); <br>
                                 // Once connected, publish an announcement... <br>
                                 client.publish("outTopic", "hello world" ); <br>
                                 // ... and resubscribe <br>
                                 client.subscribe("inTopic"); } <br>
                                 else { Serial.print("failed, rc=");<br>
                                 Serial.print(client.state());<br>
                                 Serial.println(" try again in 5 seconds"); <br>
                                 // Wait 5 seconds before retrying <br>
                                 delay(5000); } } } <br>
                                 void setup() { <br>
                                 pinMode(BUILTIN_LED, OUTPUT); <br>
                                 // Initialize the BUILTIN_LED pin as an output <br>
                                 Serial.begin(115200);<br>
                                 setup_wifi(); <br>
                                 client.setServer(mqtt_server, 1883); <br>
                                 client.setCallback(callback);} <br>
                                 void loop() <br>
                                 { <br>
                                 if (!client.connected()) { reconnect();<br>
                                 } <br>
                                 client.loop(); <br>
                                 unsigned long now=millis(); <br>
                                 if (now - lastMsg> 2000) {
                                 <br>
                                 float nilai1 = random(28,32);<br>
                                 float nilai2 = random(28,32);<br>
                                 char buffer[256];<br>
                                 const int capacity = JSON_ARRAY_SIZE(5) + 2*JSON_OBJECT_SIZE(5);<br>
                                 StaticJsonDocument< capacity> doc;<br>
                                     JsonObject obj = doc.createNestedObject();<br>
                                     obj["chip_id"] = "SMT1";<br>
                                     obj["key_device"] = "6834981364891";<br>
                                     obj["nama_header"] = "smartmeter";<br>
                                     JsonArray code = obj.createNestedArray("code");<br>
                                     code.add(1);<br>
                                     code.add(2);<br>
                                     JsonArray nilai = obj.createNestedArray("nilai");<br>
                                     nilai.add(nilai1);<br>
                                     nilai.add(nilai2);<br>
                                     <br>
                                     size_t n = serializeJson(doc, buffer);<br>
                                     lastMsg = now;<br>
                                     ++value;<br>
                                     snprintf (msg, MSG_BUFFER_SIZE, "%ld", value);<br>
                                     Serial.print("Publish message: ");<br>
                                     Serial.println(msg);<br>
                                     client.publish("mgdm/test",buffer, n);<br>
                                     delay(3000);
                                     }<br>
                                     }<br>
         </div>
     </div>
 </div>