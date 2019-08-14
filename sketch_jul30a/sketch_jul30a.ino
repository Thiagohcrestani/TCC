

/*
    PHP WEBTEMP v1.0
    Este código realiza a leitura da temperatura através do pino A8 do Arduino Mega 2560
    e através do shield Ethernet realiza a persistência da temperatura coletada, aliado
    a um script PHP que realiza exibição dos dados.
     
    Desenvolvido por Deividson Calixto da Silva.
    BLOG: https://dcalixtoblog.wordpress.com
     
    Agradecimento ao Dr. Charles A. Bell;
     
    Biblioteca MYSQL Connector utilizada:
    http://www.arduinolibraries.info/libraries/my-sql-connector-arduino(Dr. Charles A. Bell)
    https://github.com/ChuckBell/MySQL_Connector_Arduino
*/
#define sensortemp A0 //Pino analógico em que estará conectado o sensor LM35
#include <Ethernet.h> 
#include <MySQL_Connection.h>
#include <MySQL_Cursor.h>
#include <PulseSensorPlayground.h>
 
byte mac[]     = { 0x70, 0xB3, 0xD5, 0x0A, 0xC2, 0xA3 }; //Define o endereço físico da placa
byte ip[]      = { 192, 168, 0, 10 };  // Ip da EthernetShield
byte gateway[] = { 192, 168, 0, 1 };   // Gateway
byte subnet[]  = { 255, 255, 255, 0 }; // Máscara de subrede
 
const long TEMPO_PERSIST = 6000 ; //30 min
unsigned long millisAnteriorConex = 0;
unsigned long millisAtualConex = 0;
 
int valAnalog = 0;
int temp = 0;
 
IPAddress server_addr(192, 168, 0, 180);  // IP of the MySQL *server* here
char user[] = "thiago";              // usuário MySQL
char password[] = "123";        // senha MySQL
 
// Sample query
char INSERT_SQL[180] = "UPDATE babycontrol.armazenamentodados SET data_hora_evento = now(), tipo_evento = '%d', observacao_evento = 'Temperatura' WHERE id_berco = '1' and id_sensor = '1' ";
char QUERY_AUX[180] = "";
EthernetClient client;
MySQL_Connection conn((Client *)&client);
 
void setup() {
  Serial.begin(9600);
  //while (!Serial.available());
  Ethernet.begin(mac, ip, gateway, subnet); //Inicializando a ethernet
  Serial.println("Conectar!");
}
 
void loop() {  
  //evitar o overflow da millis(), quando esta é reiniciada;
  millisAtualConex = millis();
  if (millisAtualConex < millisAnteriorConex) {
    millisAnteriorConex = millisAtualConex;
  }
   
  //realiza a conexão de acordo com o TEMPO_PERSIST
  if (millisAtualConex - millisAnteriorConex >= TEMPO_PERSIST) { 
    millisAnteriorConex = millisAtualConex; 
      
    Serial.println("Mais um minuto...");
    
    if (conn.connect(server_addr, 3306, user, password)) {    
      Serial.println("INSERT_SQL_ANTES");
      Serial.println(INSERT_SQL);
      valAnalog = analogRead(sensortemp); // Leitura do pino analógico correspondente ao sensor e guarda em valAnalog
      temp = (5.0 * valAnalog * 100.0)/1024.0; //Armazena a temperatura e realiza cálculos para Celsius;                        
      //Faço a preparação para execução da Query do Histórico, substitui a variável temp, dentro de INSERT_SQL, atribuindo ao 
      //QUERY_AUX os valores já substituídos;
      sprintf(QUERY_AUX, INSERT_SQL, temp);
      Serial.println("Persistindo data. ");  
      Serial.println(temp);
      Serial.println("QUERY_AUX_DEPOIS:");
      Serial.println(QUERY_AUX);
      // Instancia a clase que realiza a query
      MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
      // execução da query
      cur_mem->execute(QUERY_AUX);      
      // liberando memória após o insert;
      delete cur_mem;
      delay(50);
      //fechar a conexão
      conn.close();
      delay(50);      
    }else{
        Serial.println("Falha ao conectar!");
    }
  }
}
