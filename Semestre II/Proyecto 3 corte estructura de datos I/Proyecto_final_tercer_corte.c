#include <stdio.h>
#include <stdlib.h>
#include <windows.h>

/*      contadores globales      */
int NumeroEquipos = 0; 
int EquiposDeseadosFutbol = 0; 
int EquiposDeseadosBaloncesto = 0; 
int NumeroEquiposBaloncesto = 0; 
int NumeroEquiposFutbol = 0; 
int NumeroEquiposTotales;
int contador1 = 1;
int contador2 = 1;
int CantidadPartidosFutbol = 0;
int CantidadPartidosDeseadosFutbol = 0;
int CantidadPartidosBaloncesto = 0;
int CantidadPartidosDeseadosBaloncesto = 0;

/*           Prototipos            */
void registrar_datos_futbol();
void registrar_datos_baloncesto();
void menu_principal();
void menu_registro_equipos();
void menu_resultados_generales();
void menu_resultados_futbol();
void goleador_equipo();
void campeon_liga();
void menu_resultados_baloncesto();
void mejor_triplista();
void campeon_liga_baloncesto();
void equipos_registrados_futbol();
void equipos_registrados_baloncesto();
void menu_equipos_registrados();

struct baloncesto{
	int NumeroPerdidasBalon;
	int NumeroRebotesCogidos;
	char NombreMejorAnotadorTriples[30];
	int NumeroTriplesMejorTriplista;
};

struct futbol{
	int NumeroEmpates;
	int NumeroGolesFavor;
	int NumeroGolesContra;
	char NombreGoleadorEquipo[30];
	int NumeroGolesGoleador;
};

struct equipos{
	char nombreEquipo[30];
	int NumeroVictorias;
	int NumeroDerrotas;
	struct baloncesto equipos_baloncesto;
	struct futbol equipos_futbol;
}equipoFut[1000], equipoBas[1000], prueba[3];

void registrar_datos_futbol(){
	int opcion;
	system("cls");
	if(contador2 == 1){
		printf("\n\n\tCuantos equipos desea registrar?\n\t");
		scanf("%i",&EquiposDeseadosFutbol);
		contador2++;
		printf("\tCuantos partidos de la competencia se han jugado?\n\t");
		scanf("%i",&CantidadPartidosDeseadosFutbol);
		Sleep(2000);
		registrar_datos_futbol();
	}else{
		if(NumeroEquiposFutbol < EquiposDeseadosFutbol ){
			fflush(stdin);
			printf("\n\n\tIngrese el nombre del equipo\n\t");
			gets(equipoFut[NumeroEquiposFutbol].nombreEquipo);
			printf("\n\tIngrese el numero de victorias\n\t");
			scanf("%i",&equipoFut[NumeroEquiposFutbol].NumeroVictorias);
			printf("\n\tIngrese el numero de derrotas\n\t");
			scanf("%i",&equipoFut[NumeroEquiposFutbol].NumeroDerrotas);
			printf("\n\tIngrese el numero de empates\n\t");
			scanf("%i",&equipoFut[NumeroEquiposFutbol].equipos_futbol.NumeroEmpates);
			
			CantidadPartidosFutbol = equipoFut[NumeroEquiposFutbol].NumeroVictorias + equipoFut[NumeroEquiposFutbol].NumeroDerrotas + equipoFut[NumeroEquiposFutbol].equipos_futbol.NumeroEmpates;
			if(CantidadPartidosFutbol ==  CantidadPartidosDeseadosFutbol ){
				fflush(stdin);
				printf("\n\tIngrese el numero de goles a favor\n\t");
				scanf("%i",&equipoFut[NumeroEquiposFutbol].equipos_futbol.NumeroGolesFavor);
				printf("\n\tIngrese el numero de goles en contra\n\t");
				scanf("%i",&equipoFut[NumeroEquiposFutbol].equipos_futbol.NumeroGolesContra);
				printf("\n\tIngrese el numero de goles del goleador\n\t");
				scanf("%i",&equipoFut[NumeroEquiposFutbol].equipos_futbol.NumeroGolesGoleador);
				if(equipoFut[NumeroEquiposFutbol].equipos_futbol.NumeroGolesGoleador > equipoFut[NumeroEquiposFutbol].equipos_futbol.NumeroGolesFavor){
					system("cls");
					printf("\n\n\tError: los goles del goleador no deben de ser mayores al numero de goles a favor del equipo\n");
					Sleep(2000);
					menu_registro_equipos();
				}	
				fflush(stdin);
				printf("\n\tIngrese el nombre del goleador del equipo\n\t");
				gets(equipoFut[NumeroEquiposFutbol].equipos_futbol.NombreGoleadorEquipo);
				NumeroEquiposFutbol++;
				
			}else{			
				printf("\n\n\tLa cantidad de victorias, derrotas y empates no corresponde al numero de partidos de la competicion\n");
				Sleep(2000);
				menu_registro_equipos();
			}
		}else{
			printf("\n\n\t\t!Lo sentimos!, hemos llegado al limite de equipos en la competicion\n");
			Sleep(2000);
			menu_principal();
		}
	}
}

void registrar_datos_baloncesto(){
	int opcion;
	system("cls");
	if(contador1 == 1){
		printf("\n\n\tCuantos equipos desea registrar?\n\t");
		scanf("%i",&EquiposDeseadosBaloncesto);
		contador1++;
		printf("\tCuantos partidos de la competencia se han jugado?\n\t");
		scanf("%i",&CantidadPartidosDeseadosBaloncesto);
		Sleep(2000);
		registrar_datos_baloncesto();
	}else{
		if(NumeroEquiposBaloncesto < EquiposDeseadosBaloncesto){
			fflush(stdin);
			printf("\n\n\tIngrese el nombre del equipo\n\t");
			gets(equipoBas[NumeroEquiposBaloncesto].nombreEquipo);
			printf("\n\tIngrese el numero de victorias\n\t");
			scanf("%i",&equipoBas[NumeroEquiposBaloncesto].NumeroVictorias);
			printf("\n\tIngrese el numero de derrotas\n\t");
			scanf("%i",&equipoBas[NumeroEquiposBaloncesto].NumeroDerrotas);
			
			CantidadPartidosBaloncesto = equipoBas[NumeroEquiposBaloncesto].NumeroVictorias + equipoBas[NumeroEquiposBaloncesto].NumeroDerrotas;
			if(CantidadPartidosBaloncesto == CantidadPartidosDeseadosBaloncesto){
				fflush(stdin);
				printf("\n\tIngrese el numero de rebotes cogidos\n\t");
				scanf("%i",&equipoBas[NumeroEquiposBaloncesto].equipos_baloncesto.NumeroRebotesCogidos);
				printf("\n\tIngrese el numero de perdidas de balon\n\t");
				scanf("%i",&equipoBas[NumeroEquiposBaloncesto].equipos_baloncesto.NumeroPerdidasBalon);
				printf("\n\tIngrese el numero de triples del mejor triplista\n\t");
				scanf("%i",&equipoBas[NumeroEquiposBaloncesto].equipos_baloncesto.NumeroTriplesMejorTriplista);
				fflush(stdin);
				printf("\n\tIngrese el nombre del mejor anotador de triples\n\t");
				gets(equipoBas[NumeroEquiposBaloncesto].equipos_baloncesto.NombreMejorAnotadorTriples);
				NumeroEquiposBaloncesto++;
	
			}else{
				printf("\n\n\tLa cantidad de victorias y derrotas no corresponde al numero de partidos de la competicion\n");
				Sleep(2000);
				menu_registro_equipos();
			}
		
		}else{	
			printf("\n\n\t\t!Lo sentimos!, hemos llegado al limite de equipos en la competicion\n");
			Sleep(2000);
			menu_principal();
		}
	}
}

void goleador_equipo(){
	system("cls");
	int i, PosicionVector, NumeroMayorGoles = 0;
	for(i=0;i<EquiposDeseadosFutbol;i++){
		if(equipoFut[i].equipos_futbol.NumeroGolesGoleador > NumeroMayorGoles){
			NumeroMayorGoles = equipoFut[i].equipos_futbol.NumeroGolesGoleador;
			PosicionVector = i;
		}
	}
	if(NumeroMayorGoles == 0){
		printf("\n\n\tAun no se han registrado equipos");
		Sleep(2000);
	}else{
		printf("\n\n\tEl goleador de la competencia es [%s], jugador del equipo [%s], con un total de [%i] goles\n",equipoFut[PosicionVector].equipos_futbol.NombreGoleadorEquipo, equipoFut[PosicionVector].nombreEquipo, equipoFut[PosicionVector].equipos_futbol.NumeroGolesGoleador);
		Sleep(2000);
	}
}

void mejor_triplista(){
	system("cls");
	int i, PosicionVectorB, NumeroMayorTriples = 0;
	for(i=0;i<EquiposDeseadosBaloncesto;i++){
		if(equipoBas[i].equipos_baloncesto.NumeroTriplesMejorTriplista > NumeroMayorTriples){
			NumeroMayorTriples = equipoBas[i].equipos_baloncesto.NumeroTriplesMejorTriplista;
			PosicionVectorB = i;
		}
	}
	if(NumeroMayorTriples == 0){
		printf("\n\n\tAun no se han registrado equipos");
		Sleep(2000);
	}else{
		printf("\n\n\tEl mejor triplista de la competenca es [%s], jugador del equipo [%s], con un total de [%i] triples\n",equipoBas[PosicionVectorB].equipos_baloncesto.NombreMejorAnotadorTriples, equipoBas[PosicionVectorB].nombreEquipo, equipoBas[PosicionVectorB].equipos_baloncesto.NumeroTriplesMejorTriplista);
		Sleep(2000);
	}
	
}

void campeon_liga(){
	system("cls");
	int i, PosicionVector, NumeroMayorPuntos = 0, PuntosEquipo[EquiposDeseadosFutbol];
	for(i=0;i<EquiposDeseadosFutbol;i++){
		PuntosEquipo[i] = (equipoFut[i].NumeroVictorias * 3) + equipoFut[i].equipos_futbol.NumeroEmpates;
	}
	for(i=0;i<EquiposDeseadosFutbol;i++){
		if(PuntosEquipo[i] > NumeroMayorPuntos){
			NumeroMayorPuntos = PuntosEquipo[i];
			PosicionVector = i;
		}
	}
	if(NumeroMayorPuntos == 0){
		printf("\n\n\tAun no se han registrado equipos");
		Sleep(2000);
	}else{
		printf("\n\n\tEl equipo ganador de la liga es el [%s] con un total de [%i] puntos\n",equipoFut[PosicionVector].nombreEquipo, NumeroMayorPuntos);
		Sleep(2000);
	}

}

void campeon_liga_baloncesto(){
	system("cls");
	int i, PosicionVectorB, NumeroMayorPuntosB = 0, PuntosEquipoB[EquiposDeseadosBaloncesto];
	for(i=0;i<EquiposDeseadosBaloncesto;i++){
		PuntosEquipoB[i] = (equipoBas[i].NumeroVictorias * 3);

	}	
	for(i=0;i<EquiposDeseadosBaloncesto;i++){
		if(PuntosEquipoB[i] > NumeroMayorPuntosB){
			NumeroMayorPuntosB = PuntosEquipoB[i];
			PosicionVectorB = i;
		}
	}
	if(NumeroMayorPuntosB == 0){
		printf("\n\n\tAun no se han registrado equipos");
		Sleep(2000);		
	}else{
		printf("\n\n\tEl equipo ganador de la liga es el [%s] con un total de [%i] puntos\n",equipoBas[PosicionVectorB].nombreEquipo, NumeroMayorPuntosB);
		Sleep(2000);
	}

}

void equipos_registrados_futbol(){
	system("cls");
	int i = 0;
	int NumeroEquiposfutbolContador = 0;
	if(NumeroEquiposFutbol == 0){
		printf("\n\n\t\tAun no se han registrado equipos\n");
		menu_principal();
	}else{
		for(i=0;i<NumeroEquiposFutbol;i++){
		printf("\n\n\t\tEquipo #%i\n\n",i+1);
		printf("\tEl nombre de equipo es = %s\n",equipoFut[i].nombreEquipo);
		printf("\tEl numero de Victorias es = %i\n",equipoFut[i].NumeroVictorias);
		printf("\tEl numero de de derrotas es = %i\n",equipoFut[i].NumeroDerrotas);
		printf("\tEl numero de de empates es = %i\n",equipoFut[i].equipos_futbol.NumeroEmpates);
		printf("\tEl numero de goles a favor es = %i\n",equipoFut[i].equipos_futbol.NumeroGolesFavor);
		printf("\tEl numero de goles en contra es = %i\n",equipoFut[i].equipos_futbol.NumeroGolesContra);
		printf("\tEl numero de diferencia de goles es = %i\n",equipoFut[i].equipos_futbol.NumeroGolesFavor - equipoFut[i].equipos_futbol.NumeroGolesContra);
		printf("\tEl numero de goles del goleador es = %i\n",equipoFut[i].equipos_futbol.NumeroGolesGoleador);
		printf("\tEl nombre del goleador es = %s\n",equipoFut[i].equipos_futbol.NombreGoleadorEquipo);
		
			if(NumeroEquiposfutbolContador < EquiposDeseadosFutbol-1){
				printf("\n\n\tPresione una tecla para ver el siguiente equipo\n");
				NumeroEquiposfutbolContador++;
				getch();
				system("cls");
			}else{
				printf("\n\n\tEsos fueron todos los equipos, presione una tecla para volver al menu\n");
				getch();
			}
		
		}	
	}
	
}

void equipos_registrados_baloncesto(){
	system("cls");
	int i = 0;
	int NumeroEquiposbaloncestoContador = 0;
	if(NumeroEquiposBaloncesto == 0){
		printf("\n\n\t\tAun no se han registrado equipos\n");
		Sleep(2000);
		menu_principal();
	}else{
		for(i=0;i<NumeroEquiposBaloncesto;i++){
		printf("\n\n\t\tEquipo #%i\n\n",i+1);
		printf("\tEl nombre de equipo es = %s\n",equipoBas[i].nombreEquipo);
		printf("\tEl numero de Victorias es = %i\n",equipoBas[i].NumeroVictorias);
		printf("\tEl numero de de derrotas es = %i\n",equipoBas[i].NumeroDerrotas);
		printf("\tEl numero de rebotes cogidos es = %i\n",equipoBas[i].equipos_baloncesto.NumeroRebotesCogidos);
		printf("\tEl numero de perdidas de balon es = %i\n",equipoBas[i].equipos_baloncesto.NumeroPerdidasBalon);
		printf("\tEl numero de triples del mejor triplista es = %i\n",equipoBas[i].equipos_baloncesto.NumeroTriplesMejorTriplista);
		printf("\tEl nombre del mejor anotador de triples es = %s\n",equipoBas[i].equipos_baloncesto.NombreMejorAnotadorTriples);
		
			if(NumeroEquiposbaloncestoContador < EquiposDeseadosBaloncesto-1){
				printf("\n\n\tPresione una tecla para ver el siguiente equipo\n");
				NumeroEquiposbaloncestoContador++;
				getch();
				system("cls");
			}else{
				printf("\n\n\tEsos fueron todos los equipos, presione una tecla para volver al menu\n");
				getch();
			}
		}	
	}
	
}

void menu_registro_equipos(){
	system("cls");
	int Opcion;
	if(NumeroEquipos < NumeroEquiposTotales){
		printf("\n\n\t\tLas competiciones actuales son: Futbol y Baloncesto\n");
		if(EquiposDeseadosFutbol != 0 && EquiposDeseadosBaloncesto != 0 ){
			NumeroEquiposTotales = EquiposDeseadosFutbol + EquiposDeseadosBaloncesto;
		}
		printf("\n\n\t\tPresione la tecla correspondiente a la opcion deseada\n\n");
		printf("\t1. Para registrar el equipo en la competencia de futbol\n");
		printf("\t2. Para registrar el equipo en la competencia de baloncesto\n");
		printf("\t3. Para regresar al menu principal\n\t");
		
		scanf("%i",&Opcion);
		switch(Opcion){
			case 1: registrar_datos_futbol();
					NumeroEquipos++;
					Sleep(2000);
					menu_principal();
				break;
			case 2: registrar_datos_baloncesto();
					NumeroEquipos++;
					Sleep(2000);
					menu_principal();
				break;
			case 3: menu_principal();
				break;
			default: system("cls");
					 printf("Ha introducido un dato invalido\n");
					 Sleep(2000);
				 	 menu_registro_equipos();
				break;
		}
	}else{
		printf("\n\n\t\t!Lo sentimos!, hemos llegado al limite de equipos en las competiciones\n");
		Sleep(2000);
		menu_principal();
	}
}

void menu_equipos_registrados(){
	system("cls");
	int opcion;
	printf("\n\n\t\tPresione la tecla correspondiente a la opcion deseada\n\n");
	printf("\t1. Para ver los equipos registrados en la competencia de futbol\n");
	printf("\t2. Para ver los equipos registrados en la competencia de baloncesto\n");
	printf("\t3. Para volver al menu anterior\n\t");
	scanf("%i",&opcion);
	switch(opcion){
		case 1: equipos_registrados_futbol();
				Sleep(2000);
				menu_equipos_registrados();
			break;
		case 2: equipos_registrados_baloncesto();
				Sleep(2000);
				menu_equipos_registrados();
			break;
		case 3: menu_resultados_generales();
			break;
		default: system("cls");
				 printf("\n\n\t\tHa introducido un dato invalido\n");
				 Sleep(2000);
				 menu_equipos_registrados();
			break;
	}
}

void menu_resultados_futbol(){
	int Opcion;
	system("cls");
	printf("\n\n\t\tPresione la tecla correspondiente a la opcion deseada\n\n");
	printf("\t1. Para ver el maximo goleador de la competencia\n");
	printf("\t2. Para ver el equipo ganador de la competencia\n");
	printf("\t3. Para volver al menu anterior\n\t");
	
	scanf("%i",&Opcion);
	switch(Opcion){
		case 1: goleador_equipo();
				Sleep(2000);
				menu_resultados_futbol();
			break;
		case 2: campeon_liga();
				Sleep(2000);
				menu_resultados_futbol();
			break;
		case 3: menu_resultados_generales();
			break;
		default: system("cls");
				 printf("\n\n\t\tHa introducido un dato invalido\n");
				 Sleep(2000);
				 menu_resultados_futbol();
			break;
	}
}

void menu_resultados_baloncesto(){
	int Opcion;
	system("cls");
	printf("\n\n\t\tPresione la tecla correspondiente a la opcion deseada\n\n");
	printf("\t1. Para ver el mejor triplista de la competencia\n");
	printf("\t2. Para ver el equipo ganador de la competencia\n");
	printf("\t3. Para volver al menu anterior\n\t");
	
	scanf("%i",&Opcion);
	switch(Opcion){
		case 1: 
				mejor_triplista();
				Sleep(2000);
				menu_resultados_baloncesto();
			break;
		case 2: campeon_liga_baloncesto();
				Sleep(2000);
				menu_resultados_baloncesto();
			break;
		case 3: menu_resultados_generales();
			break;
		default: system("cls");
				 printf("\n\n\t\tHa introducido un dato invalido\n");
				 Sleep(2000);
				 menu_resultados_baloncesto();
			break;
	}
}

void menu_resultados_generales(){
	int Opcion;
	system("cls");
	printf("\n\n\t\tPresione la tecla correspondiente a la opcion deseada\n\n");
	printf("\t1. Para ver los resultados de la competencia de futbol\n");
	printf("\t2. Para ver los resultados de la competencia de baloncesto\n");
	printf("\t3. Para ver los equipos registrados\n");
	printf("\t4. Para volver al menu principal\n\t");
	
	scanf("%i",&Opcion);
	switch(Opcion){
		case 1: menu_resultados_futbol();
			break;
		case 2: menu_resultados_baloncesto();
			break;
		case 3: menu_equipos_registrados();
			break;
		case 4: menu_principal();
			break;
		default: system("cls");
				 printf("\n\n\t\tHa introducido un dato invalido\n");
				 Sleep(2000);
				 menu_principal();
			break;
	}
}

void menu_principal(){
	system("cls");
	int Opcion;
	printf("\n\n\t\tBienvenidos a las competencias Cotecnova\n\n");
	printf("\tPresione la tecla correspondiente a la opcion deseada\n\n");
	printf("\t1. Para registrar equipos en las competiciones actuales\n");
	printf("\t2. Para ver los resultados de las competiciones actuales\n");
	printf("\t3. Para salir y finalizar el programa\n\t");
	scanf("%i",&Opcion);
	
	switch(Opcion){
		
		case 1: menu_registro_equipos();
			break;
		case 2:	menu_resultados_generales();
			break;
		case 3: system("cls");
				printf("\n\n\t\tGracias por utilizar la aplicacion, !Hasta luego!\n");
				exit(-1);
			break;
		default: system("cls");
				 printf("\n\n\t\tHa introducido un dato invalido\n");
				 Sleep(2000);
				 menu_principal();
			break;
	}
}

int main() {
	NumeroEquiposTotales = 100;
	system("color F5");
	menu_principal();
	return 0;
}
