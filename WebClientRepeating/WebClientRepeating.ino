 /*
 Incluindo as bibliotecas dos sensores*/
char valortempcorp[10];
float tempCorp = 0;
int bat = 0;


#define USE_ARDUINO_INTERRUPTS true     
#include <SPI.h>
#include <Ethernet.h>
#include<Wire.h>
#include <Adafruit_MLX90614.h>
#include <PulseSensorPlayground.h>    .



Adafruit_MLX90614 mlx = Adafruit_MLX90614();
//Endereco I2C do MPU6050
const int MPU=0x68;  
//Variaveis para armazenar valores dos sensores de movimento
int AcX,AcY,AcZ,Tmp,GyX,GyY,GyZ;



 /*
 Configuração da Ehternet Shield.*/
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192, 168, 0, 177);
IPAddress myDns(192, 168, 0, 1);
EthernetClient client;
char server[] = "192.168.0.180";  // also change the Host line in httpRequest()
//IPAddress server(64,131,82,241);
unsigned long lastConnectionTime = 0;           // last time you connected to the server, in milliseconds
const unsigned long postingInterval = 10*1000;  // delay between updates, in milliseconds





PulseSensorPlayground pulseSensor;  // Cria uma instância do objeto PulseSensorPlayground chamado "pulseSensor"
const int PulseWire = 0;       // Determina que o cabo de leitura do sensor de batimentos seja ligado no pino analogico 0
const int LED13 = 13;          // Conforme o sensor recebe sinal, o led 13 da placa pisca.
int Threshold = 550;           // Determina qual sinal "contará como uma batida" e qual ignorar.
 /*
 Inicioalização das bibliotecas dos sensores.*/


 
void setup() {
  Serial.begin(9600);  
  pulseSensor.analogInput(PulseWire);   
  pulseSensor.blinkOnPulse(LED13);       
  pulseSensor.setThreshold(Threshold);   
   if (pulseSensor.begin()) {
    Serial.println("We created a pulseSensor Object !");
  }

  
  mlx.begin(); 
  Wire.begin();
  Wire.beginTransmission(MPU);
  Wire.write(0x6B); 
  Wire.write(0); 
  Wire.endTransmission(true);



  // start serial port:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }


   /*
 Inicializa a Ethernet Shield*/
  // start the Ethernet connection:
  Serial.println("Initialize Ethernet with DHCP:");
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // Check for Ethernet hardware present
    if (Ethernet.hardwareStatus() == EthernetNoHardware) {
      Serial.println("Ethernet shield was not found.  Sorry, can't run without hardware. :(");
      while (true) {
        delay(1); // do nothing, no point running without Ethernet hardware
      }
    }
    if (Ethernet.linkStatus() == LinkOFF) {
      Serial.println("Ethernet cable is not connected.");
    }
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip, myDns);
    Serial.print("My IP address: ");
    Serial.println(Ethernet.localIP());
  } else {
    Serial.print("  DHCP assigned IP ");
    Serial.println(Ethernet.localIP());
  }
  // give the Ethernet shield a second to initialize:
  delay(1000);
}


 /*
 Busca as Informações dos sensores*/
void loop() {
  int myBPM = pulseSensor.getBeatsPerMinute();
  
  if (pulseSensor.sawStartOfBeat()) {            // Constantly test to see if "a beat happened". 
  // Serial.println("♥  A HeartBeat Happened ! "); // If test is "true", print a message "a heartbeat happened".
//Serial.print("BPM: ");                        // Print phrase "BPM: " 
 Serial.println(myBPM);                        // Print the value inside of myBPM. 
  }
  bat = myBPM;
  tempCorp = mlx.readAmbientTempC();
  dtostrf(tempCorp, 3, 1, valortempcorp);

  
  Wire.beginTransmission(MPU);
  Wire.write(0x3B);  // starting with register 0x3B (ACCEL_XOUT_H)
  Wire.endTransmission(false);

  
  
  //Solicita os dados do sensor
  Wire.requestFrom(MPU,14,true);  
  //Armazena o valor dos sensores nas variaveis correspondentes
  AcZ=Wire.read()<<8|Wire.read(); //0x3F (ACCEL_ZOUT_H) & 0x40 (ACCEL_ZOUT_L)
   
  // if there's incoming data from the net connection.
  // send it out the serial port.  This is for debugging
  // purposes only:
  if (client.available()) {
    char c = client.read();
    Serial.write(c);
   
  }
  

  // if ten seconds have passed since your last connection,
  // then connect again and send data:
  if (millis() - lastConnectionTime > postingInterval) {
    httpRequest();
  }

}

// this method makes a HTTP connection to the server:
 /*
 Conecta no servidor e envia a requisição para o arquivo de inclusão no banco de dados.*/
void httpRequest() {
  // close any connection before send a new request.
  // This will free the socket on the WiFi shield
  client.stop();
  Serial.println(AcZ);
  // if there's a successful connection:
  if (client.connect(server, 80)) {
    Serial.println("connecting...");
    // send the HTTP GET request:
    client.println("GET /tcc/FONTES/teste/index.php?temp="+String(getTemp())+"&mov="+String(AcZ)+"&corp="+String(valortempcorp)+"&bat="+String(bat)+" HTTP/1.1");
    client.println("Host: 192.168.0.180");
    client.println("User-Agent: arduino-ethernet");
    client.println("Connection: close");
    client.println();

    // note the time that the connection was made:
    lastConnectionTime = millis();
  } else {
    // if you couldn't make a connection:
    Serial.println("connection failed");
  }
}

 /*
 Retorna o valor do sensor de temperatura*/
 float getTemp(){    
    return ((float(analogRead(A1))*5/1023))*100;
    //Serial.println(analogRead(A0));
  }
