#include <iostream>
#include <math.h>
#include <time.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <conio.h>

void limpiar_pantalla();
void menu();
void menu_arreglos();
void arreglo_1();
void arreglo_2();
void arreglo_3();

void menu_matrices();
void matriz_1();
void matriz_2();
void imprimir_matriz_3();
void matriz_3();

void menu_punteros();
void puntero_1();
void punteros_2();
void puntero_3();
void puntero_4();
void puntero_5();
void buscar_numero(int *p, int n);
void punteros_6();
void punteros_7();
void punteros_8();
void punteros_9();
void punteros_10();
void punteros_11();
void puntero_12();

void menu_estructuras();
void structs_1();
void struct_2();
void struct_3();
void struct_4();
void struct_5();
void struct_6();


// puntero_11
struct alumnos{
	char nombre[30];
	int edad;
	float promedio;
}alumnos[3], *p_alumnos = &alumnos[0];

//puntero_12
struct ciclista{
	int horas;
	int minutos;
	int segundos;
}ciclista1[3], *p_ciclista1 = &ciclista1[0];

//structs 
struct competidor{
	char nombre[30];
	int edad;
	char sexo[10];
	char club[30];
}competidor1, *p_competidor = &competidor1;

struct estudiante{
	char nombre[30];
	int edad;
	char grado[30];
	float promedio;
}estudiantes[3], *p_estudiantes = &estudiantes[0];

struct trabajadores{
	char nombre[30];
	char cargo[30];
	int edad;
	int salario;
};

struct promedio{
	float nota1, nota2, nota3;
	float promedios;
};

struct estudiante2{
	char nombre[30];
	char sexo[30];
	int edad;
	struct promedio notas;
}estudiante1, *p_estu = &estudiante1;

struct promedio2{
	float nota1, nota2, nota3;
	float promedios;
};

struct estudiante3{
	char nombre[30];
	char sexo[30];
	int edad;
	struct promedio2 notas;
};


struct p_sana{
	char nombre[30];
	char sexo[30];
	int edad;
};

struct p_disca{
	char nombre[30];
	char sexo[30];
	char disc[30];
	int edad;
};

struct persona{
	char nombre[30];
	bool discapacidad;
	struct p_sana perso_sana ;
	struct p_disca perso_disc ;
};



void arreglo_3(){
	int i, j , n, matriz[4][4], c2=0, c3=0;
	int *p_m;
	p_m = &matriz[0][0];
	printf("\n\n\t\tIngrese 4 numeros\n\t\t");
	
	for(i=0;i<4;i++){
		for(j=0;j<1;j++){
			scanf("%i",&n);
			*(p_m+i+j*4) = n;
		}
	}
	
	for(i=0;i<4;i++){
		*(p_m+i+1 * 4) = pow(*(p_m+i+0* 4),2);
		*(p_m+i+2 * 4) = pow(*(p_m+i+0* 4),3);
		*(p_m+i+3 * 4) = pow(*(p_m+i+0* 4),4);
	}	
	
	printf("\n\t\t");
	for(i=0;i<4;i++){
		for(j=0;j<4;j++){
			printf("|%i|",*(p_m+i+j*4));
		}
		printf("\n\t\t");
	}
}

void arreglo_2(){
	srand(time(NULL));
	int i, r, n1, n2;
	printf("\n\n\t\tIngrese dos valores para determinar el tamaño del array\n\t\t");
	scanf("%i %i",&n1, &n2);
	r=n1*n2;
	int v[r];
	int *p_v = &v[0];
	
	printf("\n\t\t");
	
	for(i=0;i<r;i++){
		*(p_v+i) = rand()%2;
		printf("%i \t",*(p_v+i));
	}
}

void arreglo_1(){
	int i;
	float v[]={32.583, 11.239, 45.781, 22.237};
	float *p_v = &v[0];
	
	printf("\n\n\t\t");
	for(i=0;i<4;i++){
		printf("%.3f \n\t\t",*(p_v+i));
	}
}

void menu_arreglos(){
	system("cls");
	printf("\n\n\t\tSeleccione la opcion deseada\n\n");
	printf("\t\t1. Imprimir un arreglo\n");
	printf("\t\t2. Arreglo de 0's y 1's\n");
	printf("\t\t3. Arreglo de columnas exponenciales\n");
	printf("\t\t4. Volver al menu principal\n\t\t");
	int opc;
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				arreglo_1();
				printf("\n\n");
				system("pause");
				menu_arreglos();
			break;
		case 2: limpiar_pantalla();
				arreglo_2();
				printf("\n\n");
				system("pause");
				menu_arreglos();
			break;
		case 3: limpiar_pantalla();
				arreglo_3();
				printf("\n\n");
				system("pause");
				menu_arreglos();
			break;
		case 4:	limpiar_pantalla();
				menu();
			break;
		default:	limpiar_pantalla();
					printf("\n\n\t\tHa introducido un dato invalido\n");
					system("pause");
					menu_arreglos();
			break;
	}
}


void imprimir_matriz_3(int *p){
	int i,j;
	printf("\n\n");
	for(i=0;i<3;i++){
		printf("\t\t");
		for(j=0;j<3;j++){
			printf("\t%i\t",*(p+i+j*3));
		}
		printf("\n");
	}
}

void matriz_3(){
	int matriz[3][3], vector[9], contador_div=0, contador=0, i, j;
	int *p_matriz;
	p_matriz = &matriz[0][0];
	
	for(i=2;i<24;i++){
		for(j=1;j<24;j++){
			if(i % j == 0){
				contador_div++;
			}
			
		}
		if(contador_div < 3){
			vector[contador] = i;
			contador++;
		}
		contador_div = 0;
	}
	contador=0;
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			*(p_matriz+i+j*3) = vector[contador];
			contador++;
		}
	}
	imprimir_matriz_3(p_matriz);

	
}

void matriz_2(){
	srand(time(NULL));
	int matriz[3][3], i , j;
	int *p_matriz;
	p_matriz = &matriz[0][0];
	
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			*(p_matriz+i+j*3) = 1+rand()%((99+1)-1);
		}
	}
	
	
	for(i=0;i<3;i++){
		printf("\n\t\t");
		for(j=0;j<3;j++){
			printf("%d \t",*(p_matriz+i+j *3));
		}
	}
}

void matriz_1(){
	int i, j, matriz[4][4], n, suma=0;
	int *p_matriz;
	p_matriz = &matriz[0][0];
	
	printf("\n\n\t\tIngrese los valores para la matriz\n");
	for(i=0;i<3;i++){
		for(j=0;j<3;j++){
			scanf("%i",&n);
			*(p_matriz+i+j *3) = n;
			suma += *(p_matriz+i+j*3);
		}
	}
	
	for(i=0;i<3;i++){
		printf("\n\t\t");
		for(j=0;j<3;j++){
			printf("%d \t",*(p_matriz+i+j*3));
		}
	}
	
	printf("\n\n\t\tLa suma de los numeros es: %i \n",suma);
		
}

void menu_matrices(){
	system("cls");
	printf("\n\n\t\tSeleccione la opcion deseada\n\n");
	printf("\t\t1. Suma de posiciones de la matriz\n");
	printf("\t\t2. Matriz con asignacion automatica\n");
	printf("\t\t3. Matriz con asignacion automatica de numeros primos\n");
	printf("\t\t4. Volver al menu principal\n\t\t");
	int opc;
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				matriz_1();
				printf("\n\n");
				system("pause");
				menu_matrices();
			break;
		case 2: limpiar_pantalla();
				matriz_2();
				printf("\n\n");
				system("pause");
				menu_matrices();
			break;
		case 3: limpiar_pantalla();
				matriz_3();
				printf("\n\n");
				system("pause");
				menu_matrices();
			break;
		case 4:	limpiar_pantalla();
				menu();
			break;
		default:	limpiar_pantalla();
					printf("\n\n\t\tHa introducido un dato invalido\n");
					system("pause");
					menu_matrices();
			break;
	}
}


void puntero_12(){
	int i, t_horas=0, t_minutos=0, t_segundos=0, t_dias=0, bandera=0;
	
	printf("\n\n\t\tIngrese el tiempo utilizado por el ciclista en el formato horas, minutos,segundos");
	
	for(i=0;i<3;i++){
		printf("\n\n\t\t\t\tEtapa #%i\n",i+1);
		
		printf("\t\tHoras =\t");
		scanf("%i",&(p_ciclista1+i)->horas);
		t_horas += (p_ciclista1+i)->horas;
		
		printf("\n\t\tMinutos =\t");
		scanf("%i",&(p_ciclista1+i) -> minutos);
		t_minutos += (p_ciclista1+i)->minutos;
		
		printf("\n\t\tSegundos =\t");
		scanf("%i",&(p_ciclista1+i)->segundos);
		t_segundos += (p_ciclista1+i)->segundos;
	}
	
	while(bandera==0){
		if(t_segundos >60){
			t_minutos+=1;
			t_segundos-=60;
		}
		if(t_minutos >60){
			t_horas+=1;
			t_minutos-=60;
		}
		if(t_horas >24){
			t_dias+=1;
			t_horas-=24;
		}
		if(t_segundos < 60 && t_minutos <60 && t_horas <24){
			bandera=1;
		}
	}
	printf("\n\n\t\tEl tiempo total del recorrido en formato dia/hora/minutos/segundos es: \n\t\t");
	printf("%i %s %i %s %i %s %i",t_dias,":",t_horas,":",t_minutos,":",t_segundos);
}

void punteros_11(){
	int i,posicion;
	float n_mayor=0;
	
	for(i=0;i<3;i++){
		printf("\n\n\t\tIngrese los datos del alumno #%i",i+1);
		printf("\n\n\t\tNombre =\t");
		scanf("%s",&*(p_alumnos+i) -> nombre);
		fflush(stdin);
		printf("\n\t\tEdad =\t");
		scanf("%d",&(p_alumnos+i)->edad);
		printf("\n\t\tIngrese el promedio =\t");
		scanf("%f",&(p_alumnos+i)->promedio);
	}
	
	for(i=0;i<3;i++){
		if((p_alumnos+i)->promedio > n_mayor){
			n_mayor = (p_alumnos+i)->promedio;
			posicion=i;
		}
	}
	
	printf("\n\n\t\tEl mejor promedio es:");
	printf("\n\n\t\tNombre = %s \n",(p_alumnos+posicion)->nombre);
	printf("\n\t\tEdad = %i \n",(p_alumnos+posicion)->edad);
	printf("\n\t\tPromedio = %.2f",(p_alumnos+posicion)->promedio);

}

void punteros_10(){
	
}

void punteros_9(){

}

void punteros_8(){
	int c_a = 0, c_e =0 , c_i = 0, c_o = 0, c_u= 0;
	char cadena[100];
	char *p_cadena;
	
	printf("\n\n\t\tIngrese una frase o una palabra\n\t\t");
	fflush(stdin);
	fgets(cadena,100,stdin);
	fflush(stdin);
	strupr(cadena);
	
	p_cadena = &cadena[0];
	
	while(*p_cadena){
		switch(*p_cadena){
			case 'A': c_a++;
				break;
			case 'E': c_e++;
				break;
			case 'I': c_i++;
				break;
			case 'O': c_o++;
				break;
			case 'U': c_u++;
				break;
		}
		p_cadena++;
	}
	
	printf("\n\n\t\tla palabra o frase es: %s",cadena);
	
	printf("\n\n\t\tEl numero de vocales es: \n");
	printf("\n\n\t\ta = %i \n",c_a);
	printf("\n\n\t\te = %i \n",c_e);
	printf("\n\n\t\ti = %i \n",c_i);
	printf("\n\n\t\to = %i \n",c_o);
	printf("\n\n\t\tu = %i \n",c_u);
}

void punteros_7(){
	int contador_vocales = 0;
	char nombre[30];
	char *p_nombre;
		
	printf("\n\n\t\tIngrese su nombre\n\t\t");
	scanf("%s",&nombre);
	
	strupr(nombre);
	
	p_nombre = &nombre[0];
	
	while(*p_nombre){
		switch(*p_nombre){
			case 'A':
			case 'E':
			case 'I':
			case 'O':
			case 'U':
				contador_vocales++;
				break;
		}
		p_nombre++;
	}
	
	printf("\n\n\t\tEl nombre es: %s",nombre);
	printf("\n\n\t\tEl numero de vocales es: %i\n",contador_vocales);
	

}

void buscar_numero(int *p, int n){
	int i, numero;


	printf("\n\n\t\tQue numero desea buscar en el vector\n\t\t");
	scanf("%i",&numero);
	
	for(i=0;i<n;i++){
		if(numero == *(p+i)){
			printf("\n\n\t\tEl numero buscado esta en la posicion: %i",i+1);
		}
	}

}

void punteros_6(){
	int v, i, n;
	int *p_v;
	p_v=&v;
	
	printf("\n\n\t\tCuantos elementos desea ingresar\n\t\t");
	scanf("%i",&n);
	
	p_v = new int [n];
	
	for(i=0;i<n;i++){
		printf("\n\n\t\tIngrese el numero #%i \t",i+1);
		scanf("\t%i",&*(p_v+i));
	}
	
	buscar_numero(p_v, n);
	delete[] p_v;
}

void puntero_5(){
	int i,j, v, n, aux;
	int *p_v;
	p_v = &v;
	
	printf("\n\n\t\tCuantos numeros desea ingresar\n\t\t");
	scanf("%i",&n);
	p_v = new int[n];
	
	
	for(i=0;i<n;i++){
		printf("\n\t\tIngrese el numero #%i: \t",i+1);
		scanf("%i",&*(p_v+i));	
	}
	
	for(i=0;i<n;i++){
		for(j=i+1;j<n;j++){
			if(*(p_v+j) > *(p_v+j+1)){
				aux = *(p_v+j);
				*(p_v+j) = *(p_v+j+1);
				*(p_v+j+1) = aux;
			}
		}
	}
		
	printf("\n\n\t\tOrdenados en forma ascendete \n\n\t");
	for(i=0;i<n;i++){
		printf("\t%i",*(p_v+i));
	}
	delete[] p_v;
}

void puntero_4(){
	srand(time(NULL));
	int v, i, n, numero_menor=100, posicion=0;
	int *p_v;
	p_v=&v;
	printf("\n\n\t\tIngrese le tamaño del vector\n\t\t");
	scanf("%i",&n);
	p_v = new int [n];
	
	for(i=0;i<n;i++){
		*(p_v+i) = 1+rand()%((99+1)-1);
		if(*(p_v+i) < numero_menor){
			numero_menor = *(p_v+i);
			posicion = i;
		}
	}
	printf("\n\n\t\tLos elementos son: \n\n\t");
	for(i=0;i<n;i++){
		printf("\t%i ",*(p_v+i));
	}
	printf("\n\n\t\tEl numero menor es: %i",*(p_v+posicion));
	delete[] p_v;
}

void puntero_3(){
	srand(time(NULL));
	int v[10], i;
	int *p_v;
	p_v = &v[0];
	printf("\n\n\t\tlos numeros son:\n\n\t");
	for(i=0;i<10;i++){
		*(p_v+i) = 1+rand()%((99+1)-1);
		printf("\t%i",*(p_v+i));
	}	
	printf("\n");
	for(i=0;i<10;i++){
		if(*(p_v+i) % 2 == 0){
			printf("\n\n\t\tEl numero %i es par \n",*(p_v+i));
			printf("\n\t\tLa posicion de memoria es: %p \n",p_v+i);
		}
	}	
}

void punteros_2(){
	int i, n, contador_div=0;
	int *p_n;
	p_n = &n;
	printf("\n\n\t\tIngrese un numero\n\t\t");
	scanf("%i",&*(p_n));
	
	for(i=1;i<n;i++){
		if(n % i == 0){
			contador_div++;
		}
	}
	if(contador_div == 2){
		printf("\n\n\t\tEl numero es primo \n");
		printf("\t\tLa posicion de memoria es %p",p_n);
	}else{
		printf("\n\n\t\tEl numero no es primo \n");
		printf("\t\tLa posicion de memoria es %p",p_n);
	}
	
	
}

void puntero_1(){
	int i, n;
	int *p_n;
	p_n = &n;
	
	printf("\n\n\t\tIngrese un numero\n\t\t");
	scanf("%i",&*(p_n));
	
	if(*(p_n) % 2 == 0){
		printf("\n\n\t\tEl numero es par \n");
		printf("\t\tSu posicion en memoria es: %p",p_n);
	}else{
		printf("\n\n\t\tEl numero es impar \n");
		printf("\t\tSu posicion en memoria es: %p",p_n);
	}
	

}

void menu_punteros(){
	
	system("cls");
	printf("\n\n\t\tSeleccione la opcion deseada\n\n");
	printf("\t\t1. Comprobar si un numero es par o impar\n");
	printf("\t\t2. Determinar si un numero es primo o no\n");
	printf("\t\t3. Llenar un vector de 10 posiciones\n");
	printf("\t\t4. Numero menor de un arreglo dinamico\n");
	printf("\t\t5. Vector dinamico ordenado\n");
	printf("\t\t6. Buscar un numero en arreglo dinamico\n");
	printf("\t\t7. Numero de vocales de un nombre\n");
	printf("\t\t8. Numero de vocales de una cadena de caracteres\n");
	printf("\t\t9. Suma de dos matrices dinamicas\n");
	printf("\t\t10. Matriz transpuesta dinamica\n");
	printf("\t\t11. Estructura alumnos, mejor promedio\n");
	printf("\t\t12. Recorrido de un ciclista\n");
	printf("\t\t13. Volver al menu principal\n\t\t");
	int opc;
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				puntero_1();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
		case 2: limpiar_pantalla();
				punteros_2();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
		case 3: limpiar_pantalla();
				puntero_3();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
		case 4: limpiar_pantalla();
				puntero_4();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
		case 5: limpiar_pantalla();
				puntero_5();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
			
		case 6: limpiar_pantalla();
				punteros_6();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
			
		case 7: limpiar_pantalla();
				punteros_7();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
			
		case 8: limpiar_pantalla();
				punteros_8();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
		case 9: limpiar_pantalla();
				punteros_9();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
		case 10: limpiar_pantalla();
				punteros_10();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;	
		case 11: limpiar_pantalla();
				punteros_11();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;	
		case 12: limpiar_pantalla();
				puntero_12();
				printf("\n\n");
				system("pause");
				menu_punteros();
			break;
		case 13: limpiar_pantalla();
				menu();
			break;
		default:	limpiar_pantalla();
					printf("\n\n\t\tHa introducido un dato invalido\n");
					system("pause");
					menu_punteros();
			break;
	}
}


void struct_6(){
	int n, opc, i, contador_dis=0, contador_sana=0;
	
	printf("\n\n\t\tCuantas personas desea ingresar?\n\t\t");
	scanf("%i",&n);
	
	persona *p_persona = new persona[n];
	persona *persona_sana = new persona[n];
	persona *persona_disca = new persona[n];

	
	for(i=0;i<n;i++){
		printf("\n\n\t\tIngrese los datos del paciente #%i\n",i+1);
		printf("\n\t\tNombre =\t");
		fflush(stdin);
		gets((p_persona+i)->nombre);
		fflush(stdin);
		printf("\n\t\tLa persona tiene alguna discapacidad?\n");
		printf("\t\tPresione 1 para indicar que si, 0 para indicar que no la posee\n\t\t");
		fflush(stdin);
		scanf("%i",&opc);
		fflush(stdin);
		
		if(opc == 1){
			p_persona->discapacidad = true;
			contador_dis++;
				strcpy((persona_disca+i)->perso_disc.nombre, (p_persona+i)->nombre);
			printf("\n\t\tDiscapacidad =\t");
			fflush(stdin);
			gets((persona_disca+i)->perso_disc.disc);
			fflush(stdin);
			printf("\n\t\tSexo =\t");
			fflush(stdin);
			gets((persona_disca+i)->perso_disc.sexo);
			fflush(stdin);
			printf("\n\t\tEdad =\t");
			scanf("%i",&(persona_disca+i)->perso_disc.edad);
			
		}else{
			p_persona->discapacidad = false;
			contador_sana++;
				strcpy((persona_sana+i)->perso_sana.nombre, (p_persona+i)->nombre);
			printf("\n\t\tSexo =\t");
			fflush(stdin);
			gets((persona_sana+i)->perso_sana.sexo);
			fflush(stdin);
			printf("\n\t\tEdad =\t");
			scanf("%i",&(persona_sana+i)->perso_sana.edad);
			
		}
	}
	
	printf("\n\n\t\tPersonas sin discapacidades\n");
	
	for(i=0;i<=contador_sana;i++){
		if((persona_sana+i)->perso_sana.edad != 0){
			printf("\n\t\tNombre = %s \n",(persona_sana+i)->perso_sana.nombre);
			printf("\t\tSexo = %s \n",(persona_sana+i)->perso_sana.sexo);
			printf("\t\tEdad = %i \n",(persona_sana+i)->perso_sana.edad);
		}
		
	}
	printf("\n\n");
	printf("\n\n\t\tPersonas con discapacidades\n");
	for(i=0;i<n;i++){
		if((persona_disca+i)->perso_disc.edad != 0){
			printf("\n\t\tNombre = %s \n",(persona_disca+i)->perso_disc.nombre);
			printf("\t\tDiscapacidad = %s \n",(persona_disca+i)->perso_disc.disc);
			printf("\t\tSexo = %s \n",(persona_disca+i)->perso_disc.sexo);
			printf("\t\tEdad = %i \n",(persona_disca+i)->perso_disc.edad);
		}
	}
	
	delete[] p_persona;
	delete[] persona_sana;
	delete[] persona_disca;
}

void struct_5(){
	int n, i,  posicion_menor, posicion_mayor;
	float n_mayor = 0, n_menor = 500000;

	printf("\n\n\t\tCuantos estudiantes desea ingresar\n\t\t");
	scanf("%i",&n);
	
	
	estudiante3 *p_estu = new estudiante3[n];
	
	for(i=0;i<n;i++){
		printf("\n\n\t\tIngrese los datos del estudiante #%i\n",i+1);
		printf("\n\t\tNombre =\t");
		fflush(stdin);
		gets((p_estu+i)->nombre);
		fflush(stdin);
		printf("\t\tSexo =\t");
		gets((p_estu+i)->sexo);
		fflush(stdin);
		printf("\t\tEdad =\t");
		scanf("%i",&(p_estu+i)->edad);
		printf("\t\tNota 1 =\t");
		scanf("%f",&(p_estu+i)->notas.nota1);
		printf("\t\tNota 2 =\t");
		scanf("%f",&(p_estu+i)->notas.nota2);
		printf("\t\tNota 3 =\t");
		scanf("%f",&(p_estu+i)->notas.nota3);
		(p_estu+i)->notas.promedios = ((p_estu+i)->notas.nota1 + (p_estu+i)->notas.nota2 + (p_estu+i)->notas.nota3)/3;
	}
	
	
	for(i=0;i<n;i++){
		if((p_estu+i)->notas.promedios > n_mayor){
			n_mayor= (p_estu+i)->notas.promedios;
			posicion_mayor=i;
		}
		if((p_estu+i)->notas.promedios < n_menor){
			n_menor = (p_estu+i)->notas.promedios;
			posicion_menor=i;
		}
	}
	
		printf("\n\n\t\tDatos del mejor promedio\n");
		printf("\n\t\tNombre = %s\n",(p_estu+posicion_mayor)->nombre);
		printf("\t\tSexo = %s\n",(p_estu+posicion_mayor)->sexo);
		printf("\t\tNota 1 = %.2f \n",(p_estu+posicion_mayor)->notas.nota1);
		printf("\t\tNota 2 = %.2f \n",(p_estu+posicion_mayor)->notas.nota2);
		printf("\t\tNota 3 = %.2f \n",(p_estu+posicion_mayor)->notas.nota3);
		printf("\t\tPromedio = %.2f \n",(p_estu+posicion_mayor)->notas.promedios);
		
		printf("\n\n\t\tDatos del menor promedio\n");
		printf("\n\t\tNombre = %s\n",(p_estu+posicion_menor)->nombre);
		printf("\t\tSexo = %s\n",(p_estu+posicion_menor)->sexo);
		printf("\t\tNota 1 = %.2f \n",(p_estu+posicion_menor)->notas.nota1);
		printf("\t\tNota 2 = %.2f \n",(p_estu+posicion_menor)->notas.nota2);
		printf("\t\tNota 3 = %.2f \n",(p_estu+posicion_menor)->notas.nota3);
		printf("\t\tPromedio = %.2f \n",(p_estu+posicion_menor)->notas.promedios);
	
		delete[] p_estu;
	
}

void struct_4(){
	
	printf("\n\n\t\tIngrese los siguientes datos del estudiante\n");
	printf("\n\t\tNombre =\t");
	fflush(stdin);
	gets(p_estu->nombre);
	fflush(stdin);
	printf("\t\tSexo =\t");
	gets(p_estu->sexo);
	fflush(stdin);
	printf("\t\tEdad =\t");
	scanf("%i",&p_estu->edad);
	printf("\t\tNota 1 =\t");
	scanf("%f",&p_estu->notas.nota1);
	printf("\t\tNota 2 =\t");
	scanf("%f",&p_estu->notas.nota2);
	printf("\t\tNota 3 =\t");
	scanf("%f",&p_estu->notas.nota3);
	p_estu->notas.promedios = (p_estu->notas.nota1 + p_estu->notas.nota2 + p_estu->notas.nota3)/3;
	
	printf("\n\n\t\tDatos del estudiante\n");
	printf("\n\t\tNombre = %s\n",p_estu->nombre);
	printf("\n\t\tSexo = %s\n",p_estu->sexo);
	printf("\n\t\tNota 1 = %.2f \n",p_estu->notas.nota1);
	printf("\n\t\tNota 2 = %.2f \n",p_estu->notas.nota2);
	printf("\n\t\tNota 3 = %.2f \n",p_estu->notas.nota3);
	printf("\n\t\tPromedio = %.2f \n",p_estu->notas.promedios);
	
}

void struct_3(){
	int n, i, n_mayor =0, n_menor = 5000000, posicion_menor, posicion_mayor;
	printf("\n\n\t\tCuantos empleados desea registrar\n\t\t");
	scanf("%i",&n);
	
	trabajadores *trabajador = new trabajadores[n];
	
	for(i=0;i<n;i++){
		printf("\n\n\t\tIngrese los datos del empleado #%i\n",i+1);
		printf("\t\tNombre =\t");
		fflush(stdin);
		scanf("%s",&*(trabajador+i)->nombre);
		fflush(stdin);
		printf("\t\tCargo =\t");
		scanf("%s",&*(trabajador+i)->cargo);
		fflush(stdin);
		printf("\t\tEdad =\t");
		scanf("%i",&(trabajador+i)->edad);
		fflush(stdin);
		printf("\t\tSalario =\t");
		scanf("%i",&(trabajador+i)->salario);
		fflush(stdin);
	}
	
	for(i=0;i<n;i++){
		if((trabajador+i)->salario > n_mayor){
			n_mayor= (trabajador+i)->salario;
			posicion_mayor=i;
		}
		if((trabajador+i)->salario < n_menor){
			n_menor = (trabajador+i)->salario;
			posicion_menor=i;
		}
	}
	
	printf("\n\n\t\tEmpleado con mayor salario\n");
	
	printf("\n\t\tNombre = %s\n",(trabajador+posicion_mayor)->nombre);
	printf("\n\t\tCargo = %s\n",(trabajador+posicion_mayor)->cargo);
	printf("\n\t\tEdad = %i\n",(trabajador+posicion_mayor)->edad);
	printf("\n\t\tSalario = %i\n",(trabajador+posicion_mayor)->salario);
	
	printf("\n\n\t\tEmpleado con menor salario\n");
	
	printf("\n\t\tNombre = %s\n",(trabajador+posicion_menor)->nombre);
	printf("\n\t\tCargo = %s\n",(trabajador+posicion_menor)->cargo);
	printf("\n\t\tEdad = %i\n",(trabajador+posicion_menor)->edad);
	printf("\n\t\tSalario = %i\n",(trabajador+posicion_menor)->salario);
	
	delete[] trabajador;
}

void struct_2(){
	int i,posicion;
	float n_mayor=0;
	
	
	for(i=0;i<3;i++){
		printf("\n\n\t\tIngrese los datos del alumno #%i\n",i+1);
		printf("\n\t\tNombre =\t");
		scanf("%s",&*(p_estudiantes+i) -> nombre);
		fflush(stdin);
		printf("\n\t\tEdad =\t");
		scanf("%d",&(p_estudiantes+i)->edad);
		printf("\n\t\tGrado= \t");
		scanf("%s",&*(p_estudiantes+i) -> grado);
		printf("\n\t\tPromedio =\t");
		scanf("%f",&(p_estudiantes+i)->promedio);
	}
	
	for(i=0;i<3;i++){
		if((p_estudiantes+i)->promedio > n_mayor){
			n_mayor = (p_estudiantes+i)->promedio;
			posicion=i;
		}
	}
	
	printf("\n\n\n\t\tEl mejor promedio es =\n");
	printf("\n\t\tNombre = %s \n",(p_estudiantes+posicion)->nombre);
	printf("\n\t\tEdad = %i \n",(p_estudiantes+posicion)->edad);
	printf("\n\t\tGrado = %s\n",(p_estudiantes+posicion)->grado);
	printf("\n\t\tPromedio = %.2f",(p_estudiantes+posicion)->promedio);

}

void structs_1(){
	printf("\n\n\t\tIngrese el nombre del competidor = \t");
	fflush(stdin);
	gets(p_competidor->nombre);
	printf("\n\t\tIngrese la edad = \t");
	scanf("%i",&p_competidor ->edad);
	printf("\n\t\tIngrese el sexo = \t");
	fflush(stdin);
	gets(p_competidor ->sexo);
	printf("\n\t\tIngrese el club = \t");
	fflush(stdin);
	gets(p_competidor ->club);
	
	printf("\n\n\t\t\tDatos competidor\n\n");
	printf("\t\tNombre = %s \n",p_competidor ->nombre);
	printf("\t\tEdad = %i\n",p_competidor ->edad);
	printf("\t\tCategoria = ");
	if(competidor1.edad <= 15){
		printf("Infantil\n");
	}else{
		if(p_competidor ->edad <= 30 ){
			printf("Joven\n");
		}else{
			printf("Mayor\n");
		}
	}
	printf("\t\tSexo = %s\n",p_competidor ->sexo);
	printf("\t\tClub = %s\n",p_competidor ->club);
}


void menu_estructuras(){
	system("cls");
	printf("\n\n\t\tSeleccione la opcion deseada\n\n");
	printf("\t\t1. Estructura de un competidor\n");
	printf("\t\t2. Estructura de estudiantes y su mejor promedio\n");
	printf("\t\t3. Estructura de trabajadores\n");
	printf("\t\t4. Estructura de estudiantes v2 y su mejor promedio\n");
	printf("\t\t5. Estructura de estudiante, vector dinamico\n");
	printf("\t\t6. Estructura de una persona\n");
	printf("\t\t7. Volver al menu principal\n\t\t");
	int opc;
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				structs_1();
				printf("\n\n");
				system("pause");
				menu_estructuras();
			break;
		case 2: limpiar_pantalla();
				struct_2();
				printf("\n\n");
				system("pause");
				menu_estructuras();
			break;
		case 3: limpiar_pantalla();
				struct_3();
				printf("\n\n");
				system("pause");
				menu_estructuras();
			break;
		case 4: limpiar_pantalla();
				struct_4();
				printf("\n\n");
				system("pause");
				menu_estructuras();
			break;
		case 5: limpiar_pantalla();
				struct_5();
				printf("\n\n");
				system("pause");
				menu_estructuras();
			break;
		case 6: limpiar_pantalla();
				struct_6();
				printf("\n\n");
				system("pause");
				menu_estructuras();
			break;
		case 7:	limpiar_pantalla();
				menu();
			break;
		default:	limpiar_pantalla();
					printf("\n\n\t\tHa introducido un dato invalido\n");
					system("pause");
					menu_estructuras();
			break;
	}
}

void menu(){
	printf("\n\n\t\tSeleccione la opcion deseada\n\n");
	printf("\t\t1. Arreglos con punteros\n");
	printf("\t\t2. Matrices con punteros\n");
	printf("\t\t3. Ejercicios punteros\n");
	printf("\t\t4. Estructuras con punteros\n");
	printf("\t\t5. Salir\n\t\t");
	int opc;
	scanf("%i",&opc);
	switch(opc){
		case 1: limpiar_pantalla();
				menu_arreglos();
			break;
		case 2: limpiar_pantalla();
				menu_matrices();
			break;
		case 3: limpiar_pantalla();
				menu_punteros();
			break;
		case 4: limpiar_pantalla();
				menu_estructuras();
			break;
		case 5:	limpiar_pantalla();
				printf("\n\n\t\tHasta luego\n");
			break;
		default:	limpiar_pantalla();
					printf("\n\n\t\tHa introducido un dato invalido\n");
					system("pause");
					menu_arreglos();
			break;
	}
}

void limpiar_pantalla(){
	system("cls");
	system("pause");
}

int main() {
	system("color F5");
	menu();
	return 0;
}
