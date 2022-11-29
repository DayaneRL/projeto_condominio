// C++ code
#include <Ethernet.h> //habilidade necessária para que o nosso Arduino, ao estar atuando como um servidor web, seja capaz de conversar com um cliente que esteja conectado a ele
#include <MySQL_Connection.h> //promover a conexão Arduino UNO/servidor MySQL e executar as sentenças de manipulação de informações em um banco de dados
#include <MySQL_Cursor.h> //promover a conexão Arduino UNO/servidor MySQL e executar as sentenças de manipulação de informações em um banco de dados
#include <SPI.h> //é um protocolo de dados seriais síncronos utilizado em microcontroladores para comunicação entre o microcontrolador e um ou mais periféricos


//DECLARAÇÃO DE INPUTS
#define SenAgua A0 //Fotorresistor representando um Sensor de Agua, cabo Turquesa
#define SenLuz A1 //Fotorresistor representando um Sensor de Luz, cabo Roxo
#define ButAgua 2 //Botão Agua, Cabo Rosa
#define ButLuz 3 //Botão Luz, Cabo Rosa
#define SenPres 4 //Sensor de Presença, cabo Marrom
//DECLARAÇÃO DE OUTPUTS
#define LedAgua 12 //Led informativo do fluxo de agua corrente, cabo Azul
#define LedLuz 11 //Led informativo de consumo de energia, cabo Amarelo
#define ReleAgua 8 //Rele representando uma válvula solenóide, cabo Roxo
#define ReleLuz 9 //Rele, cabo Rosa
#define Lampada 5 //Led representando uma lampada, cabo Verde
//Os leds conectados aos reles não tem ligação em portas arduíno

//configurando conexao
byte mac_addr[] = { 0x00, 0x27, 0x13, 0xAE, 0x79, 0x0F }; //informar MAC host
IPAddress server_addr(10,10,117,14); //informar ip host

//acesso ao BD
char user[] = "arduino";         
char password[] = "arduino123";        

//STRING PARA BANCO
char INSERIR_TEMP[] = "INSERT INTO registrotemp (temperatura) VALUES (%s)";
char BANCODEDADOS[] = "USE internet_shield";
EthernetClient client;
MySQL_Connection conn((Client *)&client);

//leitura temperatura
int leitura;
float leituraconvertida;
char sentenca[128];
char valortemp[10];






void setup() 
{ 
   Serial.begin(9600);
   while (!Serial); 
   Ethernet.begin(mac_addr);
   Serial.println("Conectando...");
   
   if (conn.connect(server_addr, 3306, user, password)) 
   {
      delay(1000);
      
      MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
      cur_mem->execute(BANCODEDADOS);
      delete cur_mem;
   }
   else
   {
      Serial.println("A conexão falhou");
      conn.close();
   }
   
}


//TROCAR NOME LM35 POR SENSOR CORRETO
void loop() 
{
   Serial.println("Executando sentença");
   leitura = analogRead(LM35);
   leituraconvertida = (float(analogRead(LM35))*5/(1023))/0.1;
   Serial.print("Temperatura: ");
   Serial.println(round(leituraconvertida));
   dtostrf(leituraconvertida, 4, 1, valortemp);
   sprintf(sentenca, INSERIR_TEMP, valortemp);
   
   MySQL_Cursor *cur_mem = new MySQL_Cursor(&conn);
   cur_mem->execute(sentenca);
   delete cur_mem;
   delay(5000);
}