#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <string.h>
#include <windows.h>
#include <math.h>


//----- Prototipos -----///
int main();
void menu();
void limpiar_pantalla();

void opc_while1();
void opc_while2();
void opc_while3();
void menu_while();

void opc_for1();
void opc_for2();
void opc_for3();
void menu_for();

void opc_array1();
void opc_array2();
void menu_array();

void opc_switch1();
void opc_switch2();
void opc_switch3();
void menu_switch();

void elevacion(int inicial, int final, int potencia, int matriz[4][4]);
void opc_matriz1();
void opc_matriz2();
void opc_matriz3();
void imprimir_matriz(int matriz[3][3]);
void N_primos(int vector[], int matriz[3][3]);
void opc_matriz4();
void menu_matriz();

void struc_1();
void asignar_datos_struct_2();
void mostrar_datos_struct_2();
void opc_2struct();
void asignar_datos_struct_3();
void mostrar_datos_struct3();
void asignar_datos_struct_4(int n);
void mayor_menor(float promedio[], int n);
void mostrar_resultados(float promedio[], int posicion_mayor, int posicion_menor);
void mostrar_datos_struct_4(float promedio[], int posicion);

//---- Struct´s -----//

// #1

struct estudiantes{
	char nombre[30];
	float nota1, nota2, nota3;
	float promedio;
}estudiante[100], aux[100];

// #2
struct competidor{
	char nombre[30];
	int edad;
	char sexo[10];
	char club[30];
}competidor1;
// #3
struct promedio_alumnos{
	float nota1;
	float nota2;
	float nota3;
};

struct alumnos{
	char nombre[30];
	char sexo[10];
	int edad;
	struct promedio_alumnos promedio;
}alumno1;
//#4

struct promedio_alumno{
	float nota1;
	float nota2;
	float nota3;
};

struct alumno{
	char nombre[30];
	char sexo[10];
	int edad;
	struct promedio_alumno promedio;
}alumno[50];


// ------ Funciones ----//

void opc_while1(){
	int i =1 , r=2 ;
	printf("\n\n");
	while(i <= 100){
		if(i==1){
			printf("\t%i %c %i %c ",i, '+', r, '=');
			r +=i;
			printf("\t%i \n",r);
			i+=2;
		}else{
			printf("\t%i %c %i %c ",i, '+', r, '=');
			r +=i;
			printf("\t%i \n",r);
			i++;
		}
	}
}

void opc_while2(){
	int i =1 , r=4 ;
	printf("\n\n");
	while(i <= 50){
		if(i % 2 == 0){
			if(i == 2){
				printf("\t%i %c %i %c ",i, '+', r, '=');
				r +=i;
				printf("\t%i \n",r);
				i+=4;	
			}
			printf("\t%i %c %i %c ",i, '+', r, '=');
			r +=i;
			printf("\t%i \n",r);
			i++;
		}else{
			i++;
		}
	}
}

void opc_while3(){
	int i =1 , r=3;
	printf("\n\n");
	while(i <= 50){
		if(i % 2 != 0){
			if(i == 1){
				printf("\t%i %c %i %c ",i, '+', r, '=');
				r +=i;
				printf("\t%i \n",r);
				i+=4;	
			}
			printf("\t%i %c %i %c ",i, '+', r, '=');
			r +=i;
			printf("\t%i \n",r);
			i++;
		}else{
			i++;
		}
	}

}

void menu_while(){
	limpiar_pantalla();
	int opc;
	printf("\n\t\tIngrese el numero correspondiente a la opcion deseada\n\n\n");
	printf("\t1. Sumar los numeros del 1 al 100\n");
	printf("\t2. Sumar los numeros pares del 1 al 50\n");
	printf("\t3. Sumar los numeros impares del 1 al 50\n");
	printf("\t4. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	
	switch(opc){
		case 1: limpiar_pantalla();
				opc_while1();
				getch();
				menu_while();
			break;
		case 2: limpiar_pantalla();
				opc_while2();
				getch();
				menu_while();
			break;
		case 3: limpiar_pantalla();
				opc_while3();
				getch();
				menu_while();
			break;
		case 4: limpiar_pantalla();
				main();
			break;
		default: limpiar_pantalla();
				 printf("\n\n\t\tDato invalido");
				 getch();
				 menu_while();
			break;
	}
}


void opc_for1(){
	int i, n, r;
	printf("\n\tIngrese el numero al que desea saber la tabla de multiplicar\n\t");
	scanf("%i",&n);
	printf("\n\n");
	for(i=1;i<=20;i++){
		r = n*i;
		printf("\t%i %c %i %c %i\n", n, '*', i, '=', r);
	}
}

void opc_for2(){
	int i, n, r = 1;
	printf("\n\t\tIngrese el numero al que desea conocer su factorial\n\t");
	scanf("%i",&n);
	
	printf("\n\n\t");
	for(i=1;i<=n;i++){
		r *= i;
		if(i < n)
		{
			printf(" %i %c", i,'*');	
		}else{
			printf(" %i",i);
		}
	}
	printf(" %c %i \n", '=', r);
}

void opc_for3(){
	int i, n, n1= 0, n2= 1, r=1;
	printf("\n\t\tIngrese la cantidad numeros que desea ver en la serie de Fibonacci\n\t");
	scanf("%i",&n);
	printf("\n\n");
	printf("\t| 0 1 |");
	for(i=0;i<n;i++){
		r = n1+n2;
		printf(" %i",r);
		n1 = n2;
		n2= r;
	}
}

void menu_for(){
	limpiar_pantalla();
	int opc;
	printf("\n\t\tIngrese el numero correspondiente a la opcion deseada\n\n");
	printf("\t1. Tabla de multiplicar de un numero del 1 al 20\n");
	printf("\t2. Factorial de un numero\n");
	printf("\t3. Sucesion de Fibonacci\n");
	printf("\t4. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	
	switch(opc){
		case 1: limpiar_pantalla();
				opc_for1();
				getch();
				menu_for();
			break;
		case 2: limpiar_pantalla();
				opc_for2();
				getch();
				menu_for();
			break;
		case 3: limpiar_pantalla();
				opc_for3();
				getch();
				menu_for();
			break;
		case 4: limpiar_pantalla();
				main();
			break;
		default: limpiar_pantalla();
				 printf("\n\t\tDato invalido");
				 getch();
				 menu_for();
			break;
	}
}


void opc_array1(){
	float v[4]={32.583 , 11.239, 45.781, 22.237};
	int i;
	printf("\n\n");
	for(i=0;i<4;i++){
		printf("\t%.3f \t",v[i]);
	}
}

void opc_array2(){
	int i, n1, n2, r;
	srand(time(NULL));
	printf("\n\t\tIngrese dos valores para determinar el tamaño del array\n\t");
	scanf("%i %i", &n1, &n2);
	r = n1*n2;
	int v[r];
	printf("\n\n");
	for(i=0;i<r;i++){
		v[i] = rand()%2;
		printf("\t%i \t",v[i]);
	}
}

void menu_array(){
	limpiar_pantalla();
	int opc;
	printf("\n\t\tIngrese el numero correspondiente a la opcion deseada\n\n");
	printf("\t1. Array de decimales\n");
	printf("\t2. Array de ceros y unos\n");
	printf("\t3. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				opc_array1();
				getch();
				menu_array();
			break;
		case 2: limpiar_pantalla();
				opc_array2();
				getch();
				menu_array();
			break;
		case 3: limpiar_pantalla();
				main();
			break;
		default: limpiar_pantalla();
				 printf("\n\t\tDato invalido\n");
				 getch();
				 menu_array();
			break;
	}
}


void opc_switch1(){
	int mes;
	
	SYSTEMTIME str_t;
	GetSystemTime(&str_t);
  	mes = str_t.wMonth;	
 
  
  switch(mes){  
  	case 1: printf("\n\tEste mes es: Enero");
  		break;
  	case 2: printf("\n\tEste mes es: Febrero");
  		break;
  	case 3: printf("\n\tEste mes es: Marzo");
  		break;
  	case 4:	printf("\n\tEste mes es: Abril");
  		break;
  	case 5:	printf("\n\tEste mes es: Mayo");
  		break;
  	case 6:	printf("\n\tEste mes es: Junio");
  		break;
  	case 7:	printf("\n\tEste mes es: Julio");
  		break;
  	case 8:	printf("\n\tEste mes es: Agosto");
  		break;
  	case 9:	printf("\n\tEste mes es: Septiembre");
  		break;
  	case 10:printf("\n\tEste mes es: Octubre");
  		break;
  	case 11:printf("\n\tEste mes es: Noviembre");
  		break;
  	case 12:printf("\n\tEste mes es: Diciembre");
  		break;	  	    	
  }
  getch();
	
}

void opc_switch2(){
	char letra;
	printf("\n\t\tIngrese la vocal a la cual le desea conocer el codigo Ascci\n\t");
	fflush(stdin);
	scanf("%c",&letra);
	printf("\n\tEl codigo Ascci es = ");
	switch(letra){
		case 'a': printf("97");
			break;
		case 'e': printf("101");
			break;
		case 'i': printf("105");
			break;
		case 'o': printf("111");
			break;
		case 'u': printf("117");
			break;
		default: limpiar_pantalla();
				 printf("Dato invalido\n");
				 getch();
				 menu_switch();
			break;
	}
}

void opc_switch3(){
	int n;
	printf("\n\t\tIngrese un numero del 1 al 9 para conocer el codigo Ascci\n\t");
	scanf("%i",&n);
	printf("\n\tEl codigo Ascci es = ");
	switch(n){
		case 0: printf("\t48");
			break;
		case 1: printf("\t49");
			break;
		case 2: printf("\t50");
			break;
		case 3: printf("\t51");
			break;
		case 4: printf("\t52");
			break;
		case 5: printf("\t53");
			break;
		case 6: printf("\t54");
			break;
		case 7: printf("\t55");
			break;
		case 8: printf("\t56");
			break;
		case 9: printf("\t57");
			break;
		default: limpiar_pantalla();
				 printf("Dato invalido\n");
				 getch();
				 menu_switch();
			break;
	}
	
}

void menu_switch(){
	limpiar_pantalla();
	int opc;
	printf("\n\t\tIngrese el numero correspondiente a la opcion deseada\n\n");
	printf("\t1. Consultar el mes del sistema\n");
	printf("\t2. Codigo Ascci de una vocal\n");
	printf("\t3. Codigo Ascci de un numero\n");
	printf("\t4. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				opc_switch1();
				getch();
				menu_switch();
			break;
		case 2: limpiar_pantalla();
				opc_switch2();
				getch();
				menu_switch();
			break;
		case 3: limpiar_pantalla();
				opc_switch3();
				getch();
				menu_switch();
			break;
		case 4: limpiar_pantalla();
				main();
			break;
		default: limpiar_pantalla();
				 printf("Dato invalido\n");
				 getch();
				 menu_switch();
			break;
	}
}


void elevacion(int inicial, int final, int potencia, int matriz[4][4]){
	int i, j;
	int c2 = 0 , c3 =0;
	for(i=0;i<4;i++){
		for(j=inicial;j<final;j++){
			matriz[i][j] = pow(matriz[c2][c3],potencia);
			c2++;
		}		
	}
}

void opc_matriz1(){
	int i, j , n, M[4][4], c2=0, c3=0;
	printf("\n\t\tIngrese 4 numeros\n");
	for(i=0;i<4;i++){
		for(j=0;j<1;j++){
			printf("\t");
			scanf("%i",&n);
			M[i][j] = n;
		}
	}
	
	elevacion(1,2,2,M);
	elevacion(2,3,3,M);
	elevacion(3,4,4,M);
	
	printf("\n\n");
	
	for(i=0;i<4;i++){
		for(j=0;j<4;j++){
			printf("\t|%i|",M[i][j]);
		}
		printf("\n");
	}
}

void opc_matriz2(){
	int i, j, n ,r=0, z= 1, m[3][3];
	printf("\n\t\tIngrese 9 numeros\n\n");
	
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			printf("\t%i = \t",z);
			scanf("%i",&m[i][j]);
			r +=m[i][j];
			z++;
		}
	}
	printf("\n\n\tLa suma de las posiciones de la matriz es: %i\n",r);
}

void opc_matriz3(){
	int i, j, M[3][3];
	srand(time(NULL));
	printf("\n\n");
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			M[i][j] = rand()%10;
			printf("\t%i",M[i][j]);
		}
		printf("\n");
	}
}

void imprimir_matriz(int matriz[3][3]){
	int i,j;
	printf("\n");
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			printf("\t%i\t",matriz[i][j]);
		}
		printf("\n");
	}
}

void N_primos(int vector[], int matriz[3][3]){
	int i, j, contador_div=0, contador=0;
	
	for(i=1;i<24;i++){
		for(j=1;j<24;j++){
			if(i == 1){
				i++;
			}
			if(i % j == 0){
				contador_div++;
			}
		}
		if(contador_div < 3){
			vector[contador] = i;
			contador++;
		}
		contador_div =0;
	}
	contador=0;
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			matriz[i][j] = vector[contador];
			contador++;
		}
	}
	imprimir_matriz(matriz);
	
}

void opc_matriz4(){
	int v[9], matriz[3][3];
	N_primos(v, matriz);
}

void menu_matriz(){
	limpiar_pantalla();
	int opc;
	printf("\n\t\tIngrese el numero correspondiente a la opcion deseada\n\n");
	printf("\t1. Matriz con potenciacion\n");
	printf("\t2. Llenar una matriz y sumar sus posiciones\n");
	printf("\t3. Matriz con asignacion automatica\n");
	printf("\t4. Matriz con asignacion automatica de numeros primos\n");
	printf("\t5. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				opc_matriz1();
				getch();
				menu_matriz();
			break;
		case 2: limpiar_pantalla();
				opc_matriz2();
				getch();
				menu_matriz();
			break;
		case 3: limpiar_pantalla();
				opc_matriz3();
				getch();
				menu_matriz();
			break;
		case 4: limpiar_pantalla();
				opc_matriz4();
				getch();
				menu_matriz();
			break;
		case 5: limpiar_pantalla();
				main();
			break;
		default: limpiar_pantalla();
				 printf("\n\t\tDato invalido\n");
				 getch();
				 menu_matriz();
			break;
	}
}

void struc_1(){
	int n, i, j, z = 0, contador=1;
	printf("\n\tCuantos alumnos desea ingresar?\n\t");
	scanf("%i",&n);
	
	for(i=0;i<n;i++){
		printf("\n\n\tIngrese los datos del alumno #%i\n\n",i+1);
		printf("\tNombre = ");
		fflush(stdin);
		gets(estudiante[i].nombre);
		printf("\tIngrese las notas = ");
		scanf("%f %f %f",&estudiante[i].nota1,&estudiante[i].nota2,&estudiante[i].nota3);
		estudiante[i].promedio = (estudiante[i].nota1 + estudiante[i].nota2 + estudiante[i].nota3) / 3;
		
	}
	for(i=0;i<n;i++){
		for(j=0;j<n;j++){
			if(estudiante[j].promedio > estudiante[j+1].promedio){
				aux[z] = estudiante[j+1];
				estudiante[j+1] = estudiante[j];
				estudiante[j] = aux[z];
				z++;
			}
		}
	}
	limpiar_pantalla();
	printf("\n\n\t\tAlumnos ordenados por orden de merito\n");
	for(i=n;i>0;i--){
		printf("\n\tPuesto #%i\n",contador);
		printf("\tNombre = %s\n",estudiante[i].nombre);
		printf("\tNota 1 = %.2f\n",estudiante[i].nota1);
		printf("\tNota 2 = %.2f\n",estudiante[i].nota2);
		printf("\tNota 3 = %.2f\n",estudiante[i].nota3);
		printf("\tPromedio = %.2f\n",estudiante[i].promedio);
		contador++;
	}
}

void asignar_datos_struct_2(){
	printf("\n\tIngrese el nombre del competidor = ");
	fflush(stdin);
	gets(competidor1.nombre);
	printf("\tIngrese la edad = ");
	scanf("%i",&competidor1.edad);
	printf("\tIngrese el sexo = ");
	fflush(stdin);
	gets(competidor1.sexo);
	printf("\tIngrese el club = ");
	fflush(stdin);
	gets(competidor1.club);
}

void mostrar_datos_struct_2(){
	printf("\n\t\tDatos competidor\n\n");
	printf("\tNombre = %s \n",competidor1.nombre);
	printf("\tEdad = %i\n",competidor1.edad);
	printf("\tCategoria = ");
	if(competidor1.edad <= 15){
		printf("\tInfantil\n");
	}else{
		if(competidor1.edad <= 30 ){
			printf("\tJoven\n");
		}else{
			printf("\tMayor\n");
		}
	}
	printf("\tSexo = %s\n",competidor1.sexo);
	printf("\tClub = %s\n",competidor1.club);
}

void opc_2struct(){
	asignar_datos_struct_2();
	limpiar_pantalla();
	mostrar_datos_struct_2();
}

void asignar_datos_struct_3(){
	printf("\n\tIngrese el nombre del alumno\n\t");
	fflush(stdin);
	gets(alumno1.nombre);
	printf("\tIngrese el sexo del alumno\n\t");
	fflush(stdin);
	gets(alumno1.sexo);
	printf("\tIngrese la edad del estudiante\n\t");
	scanf("%i",&alumno1.edad);
	printf("\tIngrese las notas\n\t");
	scanf("%f %f %f",&alumno1.promedio.nota1,&alumno1.promedio.nota2,&alumno1.promedio.nota3);
}

void mostrar_datos_struct3(){
	printf("\n\t\tDatos alumno\n\n");
	float promedio = 0;
	printf("\tNombre = %s\n",alumno1.nombre);
	printf("\tSexo = %s\n",alumno1.sexo);
	printf("\tEdad = %i\n",alumno1.edad);
	printf("\tNota 1 = %.2f\n",alumno1.promedio.nota1);
	printf("\tNota 2 = %.2f\n",alumno1.promedio.nota2);
	printf("\tNota 3 = %.2f\n",alumno1.promedio.nota3);
	promedio = (alumno1.promedio.nota1 + alumno1.promedio.nota2 + alumno1.promedio.nota3) / 3;
	printf("\tPromedio = %.2f\n",promedio);
}

void opc_3struct(){
	asignar_datos_struct_3();
	limpiar_pantalla();
	mostrar_datos_struct3();
}

void mostrar_datos_struct_4(float promedio[], int posicion){
	printf("\n\tNombre = %s\n",alumno[posicion].nombre);
	printf("\tSexo = %s\n",alumno[posicion].sexo);
	printf("\tEdad = %i\n",alumno[posicion].edad);
	printf("\tNota 1 = %.2f\n",alumno[posicion].promedio.nota1);
	printf("\tNota 2 = %.2f\n",alumno[posicion].promedio.nota2);
	printf("\tNota 3 = %.2f\n",alumno[posicion].promedio.nota3);
	printf("\tPromedio = %.2f\n",promedio[posicion]);
}

void mostrar_resultados(float promedio[], int posicion_mayor, int posicion_menor){
	limpiar_pantalla();
	printf("\n\t\t\tMejor promedio\n");
	mostrar_datos_struct_4(promedio,posicion_mayor);
	printf("\n\t\tMenor promedio\n");
	mostrar_datos_struct_4(promedio, posicion_menor);
}

void mayor_menor(float promedio[], int n){
	int i;
	float nMayor =0.00, nMenor = 5.00;
	int pMayor, pMenor;
	
	for(i=0;i<n;i++){
		if(promedio[i] > nMayor){
			nMayor = promedio[i];
			pMayor = i;
		}else{
			if(promedio[i] < nMenor){
				nMenor = promedio[i];
				pMenor = i;
			}
		}
	}
	mostrar_resultados(promedio,pMayor,pMenor);
}

void asignar_datos_struct_4(int n){
	int i;
	float promedio[n];
	for(i=0;i<n;i++){
		printf("\n\n\tIngrese los datos del alumno #%i\n\n",i+1);
		printf("\tNombre = ");
		fflush(stdin);
		gets(alumno[i].nombre);
		printf("\tSexo = ");
		fflush(stdin);
		gets(alumno[i].sexo);
		printf("\tEdad = ");
		scanf("%i",&alumno[i].edad);
		printf("\tIngrese las notas = ");
		scanf("%f %f %f",&alumno[i].promedio.nota1,&alumno[i].promedio.nota2,&alumno[i].promedio.nota3);
		promedio[i] = (alumno[i].promedio.nota1 + alumno[i].promedio.nota2 + alumno[i].promedio.nota3) / 3;
	}
	mayor_menor(promedio, n);
}

void opc_4struct(){
	int n;
	printf("\n\t\tCuantos alumnos desea ingresar?\n\t");
	scanf("%i",&n);
	asignar_datos_struct_4(n);
}

void menu_struct(){
	limpiar_pantalla();
	int opc;
	printf("\n\t\tIngrese el numero correspondiente a la opcion deseada\n\n");
	printf("\t1. Alumnos y sus promedios ordenados por orden de merito\n");
	printf("\t2. Informacion de un competidor\n");
	printf("\t3. Estructura anidada de alumnos\n");
	printf("\t4. Estructura anidada de alumnos, menor y mayor promedio\n");
	printf("\t5. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				struc_1();
				getch();
				menu_struct();
			break;
		case 2: limpiar_pantalla();
				opc_2struct();
				getch();
				menu_struct();
			break;
		case 3: limpiar_pantalla();
				opc_3struct();
				getch();
				menu_struct();
			break;
		case 4: limpiar_pantalla();
				opc_4struct();
				getch();
				menu_struct();
			break;
		case 5: limpiar_pantalla();
				main();
			break;
		default: limpiar_pantalla();
				 printf("\n\t\tDato invalido\n");
				 getch();
				 menu_struct();
			break;
	}
}


void limpiar_pantalla(){
	system("cls");
	Sleep(1000);
}

void menu(){
	int opc;
	printf("\n\t\tIngrese el numero correspondiente a la opcion deseada\n\n");
	printf("\t1. Ciclo While\n");
	printf("\t2. Ciclo For\n");
	printf("\t3. Arrays\n");
	printf("\t4. Switch\n");
	printf("\t5. Matrices\n");
	printf("\t6. Estructuras\n");
	printf("\t7. Salir\n\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				menu_while();
			break;
		case 2: limpiar_pantalla();
				menu_for();
			break;
		case 3: menu_array();
				limpiar_pantalla();
			break;
		case 4: limpiar_pantalla();
				menu_switch();
			break;
		case 5:	limpiar_pantalla();
				menu_matriz();
			break;
		case 6:	limpiar_pantalla();
				menu_struct();
			break;
		case 7: limpiar_pantalla();
				printf("\n\t\tHasta luego\n");
			break;
		default:limpiar_pantalla(); 
				printf("\n\t\tDato invalido");
				getch();
				main();
			break;
	}	
}

int main() {
	system("color F5");
	menu();
	return 0;
}
