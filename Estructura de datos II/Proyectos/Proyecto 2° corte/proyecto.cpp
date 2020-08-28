#include <iostream>
#include <conio.h>
#include <math.h>
#include <stdlib.h>
#include <time.h>
#include <windows.h>
#include <stdio.h>


struct nodo{
	int dato_nodo;
	nodo *siguiente; 
};

void asignar_datos_cola_ordenados(nodo *&frente,nodo *&fin, int v[]);
void ordenar_datos_cola(nodo *&frente, nodo *&fin);
int main();
void limpiar();


bool b=false;
int numero=0;
FILE *lista;



bool cola_vacia(nodo *&frente){
	return (frente == NULL)?true : false;
}

void crear_archivo(){
	int i=0, n=0;
	lista = fopen("ListaNumeros.txt","w");
	srand(time(NULL));
	if(lista == NULL){
		system("cls");
		printf("\n\n\t\tError, no se puede crear el archivo");
	}else{
		while(i < numero){
			n = 1+rand()%((numero)-1);
			fprintf(lista,"%i \n",n);
			i++;
		}
		printf("\n\n\t\tArchivo creado correctamente");
	}
	fclose(lista);
}

void menu_rango(){
	int opc=0;
	printf("\n\n\t\t\tSeleccione la cantidad y rango de los numeros aleatorios\n");
	printf("\n\t1. 10\n");
	printf("\t2. 100\n");
	printf("\t3. 1000\n");
	printf("\t4. 10000\n\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: numero = 10;
				crear_archivo();
			break;
		case 2: numero = 100;
				crear_archivo();
			break;
		case 3: numero = 1000;
				crear_archivo();
			break;
		case 4: numero = 10000;
				crear_archivo();
			break;
		default:system("cls");
				printf("Dato invalido\n\n\t\t");
				system("pause");
				menu_rango();
			break;
	}
}

void mostrar_datos_txt(){
	int dato=0, i=1, c=0;
	lista = fopen("ListaNumeros.txt","r");
	if(lista == NULL){
		printf("\n\n\t\tNo se ha creado ningun archivo");
	}else{
		printf("\n\n\t\tDatos desde el txt\n\n");
		while(c < numero){
		fscanf(lista,"%i",&dato);
		printf("\tdato [%i] = %i\n",i,dato);
		i++;
		c++;
	}
		fflush(lista);
		fclose(lista);
	}
	
}

void insertar_dato_cola(nodo *&frente, nodo *&fin, int dato){
	nodo *nuevo_nodo_cola = new nodo();
	nuevo_nodo_cola->dato_nodo = dato;
	nuevo_nodo_cola->siguiente = NULL;
	if(cola_vacia(frente)){
		frente = nuevo_nodo_cola;
	}else{
		fin->siguiente = nuevo_nodo_cola;
	}
	fin = nuevo_nodo_cola;
}

void insertar_datos_cola(nodo *&frente, nodo *&fin){
	int dato=0, c=0;
	lista = fopen("ListaNumeros.txt","r");
	if(lista == NULL){
		printf("\n\n\t\tLa lista esta vacia");
	}else{
		while(c < numero){
			fscanf(lista,"%i",&dato);
			insertar_dato_cola(frente,fin,dato);
			c++;
		}
	}
	fflush(lista);
	fclose(lista);
}

void mostrar_datos_cola(nodo *&frente, nodo *&fin){
	nodo *aux;
	int i=1, c=0;
	if(frente == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		aux = frente;
		printf("\n\n\t\tDatos desde la cola\n\n");
		while(c < numero){
			printf("\tDato [%i] = %i \n",i,aux->dato_nodo);
			aux = aux->siguiente;
			i++;
			c++;
		}
	}
}

void eliminar_datos_cola(nodo *&frente, nodo *&fin){
	if(frente == NULL){
		//printf("No hay datos registrados\n");
	}else{
		
		while(frente != NULL){
		nodo *aux = frente;
		if(frente == fin){
			frente = NULL;
			fin == NULL;
		}else{
			frente = frente->siguiente;
		}
		delete aux;
		}
	}
}

void menu_ordenamiento(int v[]){
	int opc=0, i=0, j=0,k=0, aux=0, salto=numero/2;
	system("cls");
	printf("\n\n\t\tSeleccione el ordenamiento deseado\n\n");
	printf("\t1. Burbuja\n");
	printf("\t2. Shell\n\t");
	scanf("%i",&opc);
	
	switch(opc){
		case 1: printf("\n\n\t\tDatos ordenados");
				for(i=0;i<numero;i++){
					for(j=0;j<numero-1;j++){
						if(v[j] > v[j+1]){
							aux = v[j];
							v[j] = v[j+1];
							v [j+1] = aux;
							}
						}
					}
			break;
		case 2: printf("\n\n\t\tDatos ordenados\n");
				while(salto > 0){
					for(i=salto;i<numero;i++){
						j=i-salto;
						while(j >= 0){
							k=j+salto;
							if(v[j] <= v[k]){
								j-=1;
							}else{
								aux = v[j];
								v[j] = v[k];
								v[k] = aux;
								j -=salto;
							}
						}
					}
					salto=salto/2;
				}
				
			break;
		default: printf("\n\n\t\tDato invalido\n\n\t\t");
				 system("pause");
				 menu_ordenamiento(v);
			break;
	}
}

void ordenar_datos_cola(nodo *&frente, nodo *&fin){
	int i=0, c=0;
	nodo *aux;
	int vector[numero];
	
	if(frente == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		aux = frente;
		while(c < numero){
			vector[i] = aux->dato_nodo;
			aux = aux->siguiente;
			i++;
			c++;
		}
		menu_ordenamiento(vector);
		printf("\n\t\t");
		eliminar_datos_cola(frente,fin);
		asignar_datos_cola_ordenados(frente,fin,vector);
	}
}

void asignar_datos_cola_ordenados(nodo *&frente,nodo *&fin, int v[]){
	int i=0;
	for(i=0;i<numero;i++){
		insertar_dato_cola(frente,fin,v[i]);
	}
}

void guardar_datos_cola_txt(nodo *&frente, nodo *&fin){
	int i=0;
	lista = fopen("ListaNumeros.txt","w");
	nodo *aux; 
	if(fin == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		aux = frente;
		while(i < numero){
			fprintf(lista,"%i\n",aux->dato_nodo);
			aux = aux->siguiente;
			i++;
		}
	}
	fflush(lista);
	fclose(lista);
}

bool busqueda_cola_2(nodo *&frente, nodo *&fin, int dato){
	int bandera = false;
	nodo *aux;
	if(frente == NULL){
		printf("\n\n\t\tNo hay valores\n");
	}else{
		aux = frente;
		while(aux  != NULL){
			if(aux->dato_nodo == dato){
				bandera = true;
			}
			aux = aux->siguiente;
		}
	}
	return bandera;
}

void modificar_numero_cola(nodo *&frente, nodo *&fin){
	int dato=0, nvalor=0;
	if(cola_vacia(frente)){
		printf("\n\n\t\tNo hay valores registrados");
	}else{
		printf("\n\n\tIngrese el dato a modificar\n\t");
		scanf("%i",&dato);
		if(busqueda_cola_2(frente,fin,dato)){
			printf("\n\n\tIngrese el nuevo valor del dato [%i]\n\t",dato);
			scanf("%i",&nvalor);
			
			nodo *aux = frente;
			while(aux != NULL){
				if(aux->dato_nodo == dato){
					aux->dato_nodo = nvalor;
				}
				aux= aux->siguiente;
			}
		}else{
			printf("\n\n\t\tEl valor a modificar no esta en la cola");
		}
	}
}

void eliminar_datos_cola_2(nodo *&frente, nodo *&fin){
	if(frente == NULL){
		printf("\n\n\t\tNo hay datos registrados");
	}else{
		
		while(frente != NULL){
		nodo *aux = frente;
		if(frente == fin){
			frente = NULL;
			fin == NULL;
		}else{
			frente = frente->siguiente;
		}
		delete aux;
		}
	}
}

void eliminar_dato_cola(nodo *&frente, nodo *&fin){
	int dato = 0;
	nodo *aux;
	if(frente == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		dato = frente->dato_nodo;
		aux = frente;
	
		if(frente == fin){
			frente = NULL;
			fin = NULL;
		}else{
			frente = frente->siguiente;
		}
		delete aux;
		numero-=1;
	}	
}
/*
void eliminar_dato_cola(nodo *&frente, nodo *&fin){
	int i=0, dato =0;
	if(frente == NULL){
		printf("\n\n\t\tLa cola esta vacia");
	}else{
		printf("\n\n\tIngrese el numero a eliminar\n");
		scanf("%i",&dato);
		nodo *aux = frente;
		nodo *anterior = NULL;
		
		while(i < numero){
			while((aux != NULL) && aux->dato_nodo != dato){
				anterior = aux;
				aux = aux->siguiente;
			}
		}
		if(aux == NULL){
			printf("El elemento no existen en la cola\n");
		}else if(anterior == NULL){
			frente = frente->siguiente;
			printf("El elemento [%i] se ha eliminado correctamente\n", dato);
			delete aux;
		}else{
			anterior->siguiente = aux->siguiente;
			printf("El elemento [%i] se ha eliminado correctamente\n",dato);
			delete aux;
		}
	}
}
*/
void menu_eliminar(nodo *&frente , nodo *&fin){
	if(cola_vacia(frente)){
		printf("\n\n\t\tLa cola esta vacia");
	}else{
		int opc;
		printf("\n\n\tSeleccione la opcion deseada\n\n");
		printf("\t1. Un elemento\n");
		printf("\t2. Todos los elementos\n\t");
		scanf("%i",&opc);
		switch(opc){
		case 1: eliminar_dato_cola(frente,fin);
				printf("\n\n\t\tEl dato de la cola se ha eliminado correctamente");
			break;
		case 2: eliminar_datos_cola_2(frente,fin);
				printf("\n\n\t\tDatos eliminados correctamente de la cola");
			break;
		default: printf("\n\n\t\tDato invalido");
				 menu_eliminar(frente,fin);
			break;
		}	
	}
	
}

void busqueda_cola(nodo *&frente, nodo *&fin){
	int contador_datos=0, i=0, n=0;
	nodo *aux;
	if(frente == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		printf("\n\n\t\tIngrese el numero a buscar\n\t");
		scanf("%i",&n);
		aux = frente;
		while(aux  != NULL){
			if(aux->dato_nodo == n){
				contador_datos++;
				i++;
			}
			aux = aux->siguiente;
		}
		if(contador_datos > 0 ){
			printf("\n\n\t\tEl elemento se encuentra en la cola = [%d] vez (veces)",contador_datos);
		}else{
			printf("\n\n\t\tEl elemento a buscar no se encuentra en la cola");
		}
	}	
}

void menu_cola(nodo *&frente, nodo *&fin){
	int opc=0, dato=0;
	printf("\n\n\t\t\tMenu Colas\n\n");
	printf("\t1. Crear archivo txt con numeros aleatorios\n");
	printf("\t2. Mostrar los datos del txt\n");
	printf("\t3. Asignar los datos del txt a la cola\n");
	printf("\t4. Mostrar los datos de la cola\n");
	printf("\t5. Ordenar los datos de la cola\n");
	printf("\t6. Guardar los datos de la cola en el txt\n");
	printf("\t7. Buscar datos en la cola\n");
	printf("\t8. Eliminar datos de la cola\n");
	printf("\t9. Modificar numeros de la cola\n");
	printf("\t10. Estado de la cola\n");
	printf("\t0. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	system("cls");
	switch(opc){
		case 0: main();
				limpiar();
			break;
		case 1: menu_rango();
				limpiar();
				menu_cola(frente,fin);
			break;
		case 2: mostrar_datos_txt();
				limpiar();
				menu_cola(frente,fin);
			break;
		case 3: eliminar_datos_cola(frente,fin);
				insertar_datos_cola(frente,fin);
				printf("\n\n\t\tDatos asignados correctamente");
				limpiar();
				menu_cola(frente,fin);
			break;
		case 4: mostrar_datos_cola(frente,fin);
				limpiar();
				menu_cola(frente,fin);
			break;
		case 5: ordenar_datos_cola(frente,fin);
				limpiar();
				menu_cola(frente,fin);
			break;
		case 6: guardar_datos_cola_txt(frente,fin);
				printf("\n\n\t\tDatos guardados correctamente");
				limpiar();
				menu_cola(frente,fin);
			break;
		case 7: busqueda_cola(frente,fin);
				limpiar();
				menu_cola(frente,fin);
			break;
		case 8: menu_eliminar(frente,fin);
				limpiar();
				menu_cola(frente,fin);
			break;
		case 9: modificar_numero_cola(frente,fin);
				limpiar();
				menu_cola(frente,fin);
			break;
		case 10:if(cola_vacia(frente)){
					printf("\n\n\t\tLa cola esta vacia");
				}else{
					printf("\n\n\t\tLa cola esta llena");
				}
				limpiar();
				menu_cola(frente,fin);
			break;
		default: printf("\n\n\t\tDato invalido");
				 limpiar();
				 menu_cola(frente,fin);
			break;
	}
}

// 				PILAS 				//

void insertar_datos_pila(nodo *&pila, int dato){
	nodo *nueva_pila = new nodo();
	nueva_pila->dato_nodo = dato;
	nueva_pila->siguiente = pila;
	pila = nueva_pila;
}

void asignar_datos_pila(nodo *&pila){
	int dato=0, i=0;
	lista = fopen("ListaNumeros.txt","r");
	if(lista == NULL){
		printf("\n\n\t\tLa pila esta vacia");
	}else{
		while(i < numero){
			fscanf(lista,"%i",&dato);
			insertar_datos_pila(pila,dato);
			i++;
		}
	}
	fflush(lista);
	fclose(lista);
}

void mostrar_datos_pila(nodo *&pila){
	int i=1, c=0;
	nodo *nueva_pila = pila;
	if(pila == NULL){
		printf("\n\n\t\tLa pila esta vacia");
	}else{
		if(nueva_pila != NULL){
			printf("\n\n\t\tDatos desde la pila\n\n");
			while(c < numero){
				printf("\tDato [%i] = %d\n",i,nueva_pila->dato_nodo);
				nueva_pila = nueva_pila->siguiente;
				i++;
				c++;
			}
		}else{
			printf("\tDato [%i] = %d",i,nueva_pila->dato_nodo);
			i++;
		}
	}
}

void eliminar_datos_pila(nodo *&pila){
	while(pila != NULL){
		nodo *aux = pila;
		pila=aux->siguiente;
		delete aux;
	}
	
}

void asignar_datos_pila_ordenados(nodo *&pila, int v[]){
	int i=0;
	for(i=0;i<numero;i++){
		insertar_datos_pila(pila,v[i]);
	}
}

void ordenar_datos_pila(nodo *&pila){
	int i=0, c=0;
	nodo *aux;
	int vector[numero];
	
	if(pila == NULL){
		printf("No hay valores\n");
	}else{
		aux = pila;
		while(c < numero){
			vector[i] = aux->dato_nodo;
			aux = aux->siguiente;
			i++;
			c++;
		}
		menu_ordenamiento(vector);
		eliminar_datos_pila(pila);
		asignar_datos_pila_ordenados(pila,vector);
	}
}

void guardar_datos_pila_txt(nodo *&pila){
	int c=0;
	lista = fopen("listaNumeros.txt","w");
	nodo *aux;
	
	if(pila == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		aux = pila;
		while(c < numero){
			fprintf(lista,"%i\n",aux->dato_nodo);
			aux = aux->siguiente;
			c++;
		}
	}
	fflush(lista);
	fclose(lista);
}

void busqueda_pila(nodo *&pila){
	int contador_datos=0, c=0, dato=0;
	nodo *aux;
	if(pila == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		printf("\n\n\t\tIngrese el numero a buscar\n\t\t");
		scanf("%i",&dato);
		aux = pila;
		while(c < numero){
			if(aux->dato_nodo == dato){
				contador_datos+=1;
			}
			aux = aux->siguiente;
			c++;
		}
		if(contador_datos > 0 ){
			printf("\n\n\t\tEl elemento se encuentra en la pila = [%d] vez (veces)",contador_datos);
		}else{
			printf("\n\n\t\tEl elemento a buscar no se encuentra en la pila");
		}
	}

}

void eliminar_dato_pila(nodo *&pila){
	int i=0;
	if(pila == NULL){
		printf("\n\n\t\tNo hay valores");
	}else{
		if(i < numero){
			nodo *aux=pila;
			pila = aux->siguiente;
			i++;
			delete aux;
		}
		
	}
}

bool pila_vacia(nodo *&pila){
	return (pila == NULL)?true : false;
}

void menu_eliminar_pila(nodo *&pila){
	
	if(pila_vacia(pila)){
		printf("\n\n\t\tLa pila esta vacia");
	}else{
		int opc;
		printf("\n\n\tSeleccione la opcion deseada\n\n");
		printf("\t1. Un elemento\n");
		printf("\t2. Todos los elementos\n\t");
		scanf("%i",&opc);
		system("cls");
		switch(opc){
		case 1: eliminar_dato_pila(pila);
				printf("\n\n\t\tEl dato de la pila se ha eliminado correctamente");
			break;
		case 2: eliminar_datos_pila(pila);
				printf("\n\n\t\tDatos eliminados correctamente de la pila");
			break;
		default: printf("Dato invalido\n");
				 menu_eliminar_pila(pila);
			break;
		}	
	}
	
}

bool busqueda_pila_2(nodo *&pila, int dato){
	int bandera = false;
	nodo *aux;

	aux = pila;
	while(aux  != NULL){
		if(aux->dato_nodo == dato){
			bandera = true;
		}
		aux = aux->siguiente;
		}
	return bandera;
}

void modificar_numero_pila(nodo *&pila){
	int dato=0, nvalor = 0;
	if(pila_vacia(pila)){
		printf("\n\n\t\tNo hay valores");
	}else{
		printf("\n\n\tIngrese el dato a modificar\n\t");
		scanf("%i",&dato);
		
		if(busqueda_pila_2(pila,dato)){
			printf("\n\n\tIngrese el nuevo valor\n\t");
			scanf("%i",&nvalor);
			nodo *aux = pila;
			
			while(aux != NULL){
			if(aux->dato_nodo == dato){
				aux->dato_nodo = nvalor;
			}
			aux = aux->siguiente;
			}
			printf("\n\n\t\tDato modificado con exito");
		}else{
			printf("\n\n\t\tEl valor a modificar no esta en la pila\n");
		}
	}
}

void limpiar(){
	printf("\n\n\t\t");
	system("pause");
	system("cls");
}

void menu_pila(nodo *&pila){
	int opc=0, dato=0;
	printf("\n\n\t\t\tMenu de pilas");
	printf("\n\n\t1. Crear archivo txt con numeros aleatorios\n");
	printf("\t2. Mostrar los datos del txt\n");
	printf("\t3. Asignar los datos del txt a la pila\n");
	printf("\t4. Mostrar los datos de la pila\n");
	printf("\t5. Ordenar los datos de la pila\n");
	printf("\t6. Guardar los datos de la pila en el txt\n");
	printf("\t7. Buscar datos en la pila\n");
	printf("\t8. Eliminar datos de la pila\n");
	printf("\t9. Modificar numeros de la pila\n");
	printf("\t10. Estado de la pila\n");
	printf("\t0. Volver al menu anterior\n\t");
	scanf("%i",&opc);
	system("cls");
	switch(opc){
		case 0: main();
			break;
		case 1: menu_rango();
				limpiar();
				menu_pila(pila);
			break;
		case 2: mostrar_datos_txt();
				limpiar();
				menu_pila(pila);
			break;
		case 3: eliminar_datos_pila(pila);
				asignar_datos_pila(pila);
				printf("\n\n\t\tDatos asigandos correctamente");
				limpiar();
				menu_pila(pila);
			break;
		case 4:	mostrar_datos_pila(pila);
				limpiar();
				menu_pila(pila);
			break;
		case 5: ordenar_datos_pila(pila);
				limpiar();
				menu_pila(pila);
			break;
		case 6:	guardar_datos_pila_txt(pila);
				printf("\n\n\t\tDatos guardados correctamente");
				limpiar();
				menu_pila(pila);
			break;
		case 7: busqueda_pila(pila);
				limpiar();
				menu_pila(pila);
			break;
		case 8: menu_eliminar_pila(pila);
				limpiar();
				menu_pila(pila);
			break;
		case 9: modificar_numero_pila(pila);
				limpiar();
				menu_pila(pila);
			break;
		case 10:if(pila_vacia(pila)){
					printf("\n\n\t\tLa pila esta vacia");
				}else{
					printf("\n\n\t\tLa pila esta llena");
				}
				limpiar();
				menu_pila(pila);
			break;
		default: printf("\n\n\t\tDato invalido\n");
				 limpiar();
				 menu_pila(pila);
			break;
	}
}

void menu_p(nodo *&frente, nodo *&fin, nodo *&pila){
	system("cls");
	int opc;
	printf("\n\n\t\t\tProyecto segundo corte\n");
	printf("\n\tEjercicios con colas y pilas\n");
	printf("\t1. Procesos con colas\n");
	printf("\t2. Procesos con pilas\n");
	printf("\t3. Salir\n\t");
	scanf("%i",&opc);
	system("cls");
	switch(opc){
		case 1: menu_cola(frente,fin);
			break;
		case 2: menu_pila(pila);
			break;
		case 3: printf("\n\n\t\tHasta luego\n");
				exit(-1);
			break;
		default: printf("\n\n\t\tDato invalido");
				 limpiar();
				 menu_p(frente,fin,pila);
			break;
	}
}

void contar_numeros(){
	int dato=0, i=1, c=0;
	lista = fopen("ListaNumeros.txt","r");
	if(lista == NULL){
		
	}else{
		while(!feof(lista)){
		fscanf(lista,"%i",&dato);
		numero++;
		i++;
		c++;
	}
		fflush(lista);
		fclose(lista);
		numero-=1;
		b=true;
	}
	
}

int main() {
	system("color F5");
	nodo *frente = NULL;
	nodo *fin = NULL;
	nodo *pila = NULL;
	if(b){
		menu_p(frente,fin,pila);
	}else{
		contar_numeros();
		if(numero > 1){
			printf("\n\n\t\tYa hay un archivo txt con datos\n\n\t\t");
			system("pause");
		}
		menu_p(frente,fin,pila);
	}
	return 0;
}
