/* En el momento de ingresar hay dos tipos de usuarios 'admin' y su contraseña 'admin12', con este se podra crear y editar tanto los productos como los clientes. 
El segundo usuario es 'caja1' y su contraseñ es 'caja12' en la cual se crearan las facturas y demas procesos referentes a las mismas */

/* 			Edwin Lopez Bustamante 			*/
/*			Proyecto del primer corte		*/
/* 				Cotecnova			*/


#include <iostream>
#include <string.h>
#include <windows.h>

int contador_clientes = 2;
int contador_productos = 5;
int contador_facturas=0;

int contador_cantidad_factura=0;
int contador_productos_factura = 0;
int vector_productos;
int vector_cantidad;

int *p_vector_productos = new int[vector_productos];
int *p_vector_cantidad = new int[vector_cantidad];

int posicion_inicial = 0;
int posicion_final = 0;



struct clientes{
	char nombre[30];
	int id;
	char direccion[30];
	long int telefono;
}cliente[100], *p_cliente = &cliente[0];

struct productos{
	char nombre_producto[30];
	int valor;
}producto[100], *p_producto = &producto[0];

struct facturas{
	char cliente[30];
	char producto[30];
	int pos_ini;
	int pos_fin;
	int cantidad;
	int valorunitario;
	int valortotal;
	char estado[30];
}factura[100], *p_factura = &factura[0];

void datos_prestablecidos_productos();
void datos_prestablecidos_clientes();

void menu_principal();
void menu_admin();
void menu_cajero();
void menu_admin_1();
void menu_admin_1_crear_clientes();
void menu_admin_2_listar_clientes();
void menu_admin_3_modificar_clientes();
void modificar_datos();
void modificar_cliente(int numero_cliente);
void eliminar_cliente(int numero_cliente);

void menu_admin_2();
void menu_admin_2_crear_producto();
void menu_admin_2_listar_productos();
void menu_admin_3_modificar_producto();
void modificar_producto(int numero_producto);
void modificar_datos_producto(int numero_producto);

void menu_cajero_1();
void menu_cajero_crear_facturas();
void menu_cajero_2();
void menu_cajero_3();


void datos_prestablecidos_productos(){
	int a=0,b=1,c=2,d=3,e=4;

	strcpy((p_producto+a)->nombre_producto,"Panela");	
	(p_producto+a)->valor = 3500;
	
	strcpy((p_producto+b)->nombre_producto,"Arroz");	
	(p_producto+b)->valor = 1200;
	
	strcpy((p_producto+c)->nombre_producto,"Papa");	
	(p_producto+c)->valor = 1000;
	
	strcpy((p_producto+d)->nombre_producto,"Azucar");	
	(p_producto+d)->valor = 1100;
	
	strcpy((p_producto+e)->nombre_producto,"Galletas");	
	(p_producto+e)->valor = 3100;
	

}

void datos_prestablecidos_clientes(){
	int a=0,b=1;

	strcpy((p_cliente+a)->nombre,"Varios");	
	(p_cliente+a)->id = 1234567890;
	strcpy((p_cliente+a)->direccion,"Cartago");
	(p_cliente+a)->telefono = 2130123;

	strcpy((p_cliente+b)->nombre,"Pedro");	
	(p_cliente+b)->id = 1780570164;
	strcpy((p_cliente+b)->direccion,"Cr 3 #20-30, Pereira");
	(p_cliente+b)->telefono = 3205401;
	
	
}

void menu_admin_1_crear_clientes(){
	system("cls");
	printf("\n\t\t\tIngrese el nombre del cliente\n\t\t\t");
	fflush(stdin);
	gets((p_cliente+contador_clientes)->nombre);
	fflush(stdin);
	printf("\n\t\t\tIngrese la id del cliente\n\t\t\t");
	fflush(stdin);
	scanf("%i",&(p_cliente+contador_clientes)->id);
	printf("\n\t\t\tDireccion\n\t\t\t");
	fflush(stdin);
	gets((p_cliente+contador_clientes)->direccion);
	fflush(stdin);
	printf("\n\t\t\tTelefono\n\t\t\t");
	scanf("%i",&(p_cliente+contador_clientes)->telefono);
	printf("\n\t\t\tCliente creado con exito\n\n\n");
	contador_clientes++;

	system("pause");
	menu_admin_1();
	
}

void menu_admin_2_listar_clientes(){
	system("cls");
	int i;
	for(i=0;i<contador_clientes;i++){
			printf("\n\n\t\t\tNombre = %s",(p_cliente+i)->nombre);
			printf("\n\t\t\tId = %i",(p_cliente+i)->id);
			printf("\n\t\t\tDireccion = %s",(p_cliente+i)->direccion);
			printf("\n\t\t\tTelefono = %i",(p_cliente+i)->telefono);
	}
	printf("\n\n\n");
	system("pause");
	menu_admin_1();
}

void modificar_datos(int numero_cliente){
	system("cls");
	char nombre2[30], direccion2[30];
	int id2, telefono2;
	printf("\n\t\t\tIngrese el nuevo nombre\n\t\t\t");
	fflush(stdin);
	gets(nombre2);
	fflush(stdin);
	strcpy((p_cliente+numero_cliente)->nombre,nombre2);
	printf("\n\t\t\tIngrese la nueva id\n\t\t\t");
	fflush(stdin);
	scanf("%i",&id2);
	fflush(stdin);
	(p_cliente+numero_cliente)->id = id2;
	printf("\n\t\t\tIngrese la nueva direccion\n\t\t\t");
	fflush(stdin);
	gets(direccion2);
	fflush(stdin);
	strcpy((p_cliente+numero_cliente)->direccion,direccion2);
	printf("\n\t\t\tIngrese el nuevo numero telefonico\n\t\t\t");
	fflush(stdin);
	scanf("%i",&telefono2);
	fflush(stdin);
	(p_cliente+numero_cliente)->telefono = telefono2;
	
	printf("\n\n\n");
	system("pause");
}

void modificar_cliente(int numero_cliente){
	
	system("cls");
	
	numero_cliente-=1;
	char nombre2[30], direccion2[30];
	int opc, id2, telefono2;
	printf("\n\n\t\t\tQue desea modificar del cliente?");
	printf("\n\t\t\t1. Nombre");
	printf("\n\t\t\t2. Id");
	printf("\n\t\t\t3. Direccion");
	printf("\n\t\t\t4. Telefono");
	printf("\n\t\t\t5. Todos los datos");
	printf("\n\t\t\t6. Volver al menu anterior\n\t\t\t");
	scanf("%i",&opc);
	 system("cls");
	switch(opc){
		case 1: 
				printf("\n\n\t\t\tIngrese el nuevo nombre\n\t\t\t");
				fflush(stdin);
				gets(nombre2);
				printf("\n\t\t\tEl dato ingresado es: %s",nombre2);
				fflush(stdin);
				strcpy((p_cliente+numero_cliente)->nombre,nombre2);
				printf("\n\t\t\tNombre modificado con exito\n\n\n");
				system("pause");
				menu_admin_1();
			break;
		case 2:
				printf("\n\n\t\t\tIngrese la nueva id\n\t\t\t");
				fflush(stdin);
				scanf("%i",&id2);
				fflush(stdin);
				printf("\n\t\t\tEl dato ingresado es: %i",id2);
				(p_cliente+numero_cliente)->id = id2;
				printf("\n\t\t\tId modificada con exito\n\n\n");
				system("pause");
				menu_admin_1();
			break;
		case 3: printf("\n\n\t\t\tIngrese la nueva direccion\n\t\t\t");
				fflush(stdin);
				gets(direccion2);
				fflush(stdin);
				printf("\n\t\t\tEl dato ingresado es: %s",direccion2);
				strcpy((p_cliente+numero_cliente)->direccion,direccion2);
				printf("\n\t\t\tDireccion modificada con exito\n\n\n");
				system("pause");
				menu_admin_1();
			break;
		case 4: printf("\n\n\t\t\tIngrese el nuevo numero telefonico\n\t\t\t");
				fflush(stdin);
				scanf("%i",&telefono2);
				fflush(stdin);
				printf("\n\t\t\tEl dato ingresado es: %i",telefono2);
				(p_cliente+numero_cliente)->telefono = telefono2;
				printf("\n\t\t\tTelefono modificado con exito\n\n\n");
				system("pause");
				menu_admin_1();
			break;
		case 5: modificar_datos(numero_cliente);
				menu_admin_1();
			break;
		case 6: menu_admin_1();
			break;
		default:
				printf("\n\n\t\t\tHa ingresado un dato invalido\n");
			  	system("pause");
				 modificar_cliente(numero_cliente);
			break;
	}
	

}

void menu_admin_3_modificar_clientes(){
	system("cls");
	int i, numero_cliente;
	printf("\n\n\t\t\tLos clientes ingresados son:\n");
	for(i=0;i<contador_clientes;i++){
		printf("\n\t\t\t[%i] =  %s",i+1,(p_cliente+i)->nombre);	
	}
	printf("\n\n\t\t\tDigite el numero del cliente que desea modificar\n\t\t\t");
	scanf("%i",&numero_cliente);

	printf("\n\n\n");
	system("pause");
	modificar_cliente(numero_cliente);
}

void menu_admin_1(){
	system("cls");
	
	int opc;
	printf("\n\n\t\t\tSeleccion la opcion deseada");
	printf("\n\t\t\t1. Crear clientes");
	printf("\n\t\t\t2. Listar clientes");
	printf("\n\t\t\t3. Modificar clientes");
	printf("\n\t\t\t4. Volver al menu anterior\n\t\t\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: menu_admin_1_crear_clientes();
			break;
		case 2: menu_admin_2_listar_clientes();
			break;
		case 3: menu_admin_3_modificar_clientes();
			break;
		case 4: menu_admin();
			break;
		default: system("cls");
				 printf("\n\n\t\t\tHa ingresado un dato invalido\n");
				 system("pause");
				 menu_admin_1();
			break;
	}
}


void modificar_datos_producto(int numero_producto){
	system("cls");
	char nombre2[30];
	int valor2;
	printf("\n\n\t\t\tIngrese el nuevo nombre\n\t\t\t");
	fflush(stdin);
	gets(nombre2);
	fflush(stdin);
	strcpy((p_producto+numero_producto)->nombre_producto,nombre2);
	printf("\n\t\t\tIngrese el nuevo valor\n\t\t\t");
	fflush(stdin);
	scanf("%i",&valor2);
	(p_producto+numero_producto)->valor = valor2;
	printf("\n\t\t\tDatos modificados con exito\n\n\n");

	system("pause");
	menu_admin_2();
}

void modificar_producto(int numero_producto){
	system("cls");
	numero_producto-=1;
	char nombre2[30];
	int opc, valor2;
	

	printf("\n\n\t\t\tSeleccione la opc deseada");
	printf("\n\t\t\t1. Modificar el nombre");
	printf("\n\t\t\t2. Modificar el valor");
	printf("\n\t\t\t3. Modificar los dos campos");
	printf("\n\t\t\t4. Volver al menu anterior\n\t\t\t");
	scanf("%i",&opc);
	switch(opc){
		case 1:	system("cls");
		
				printf("\n\n\t\t\tIngrese el nuevo nombre\n\t\t\t");
				fflush(stdin);
				gets(nombre2);
				printf("\n\t\t\tEl dato ingresado es: %s",nombre2);
				fflush(stdin);
				strcpy((p_producto+numero_producto)->nombre_producto,nombre2);
				printf("\n\t\t\tNombre modificado con exito\n\n\n");
				system("pause");
				menu_admin_2();
			break;
		case 2: system("cls");
				
				printf("\n\n\t\t\tIngrese el nuevo valor\n\t\t\t");
				fflush(stdin);
				scanf("%i",&valor2);
				printf("\n\t\t\tEl dato ingresado es: %i",valor2);
				(p_producto+numero_producto)->valor = valor2;
				printf("\n\t\t\tValor modificado con exito\n\n\n");
				system("pause");
				menu_admin_2();
			break;
		case 3:	modificar_datos_producto(numero_producto);
			break;
		case 4: menu_admin_2();
			break;
		default: system("cls");
				printf("\n\n\t\t\tHa ingresado un dato invalido\n");
				system("pause");
				modificar_producto(numero_producto);
			break;
	}

}

void menu_admin_3_modificar_producto(){
	system("cls");
	int i, numero_producto;
	printf("\n\n\t\t\tLos productos ingresados son: \n");
	for(i=0;i<contador_productos;i++){
		printf("\n\t\t\t[%i] =  %s",i+1,(p_producto+i)->nombre_producto);	
	}
	printf("\n\n\t\t\tDigite el numero del producto que desea modificar\n\t\t\t");
	scanf("%i",&numero_producto);

	system("pause");
	modificar_producto(numero_producto);
}

void menu_admin_2_crear_producto(){
	system("cls");
	int valor2;
	printf("\n\n\t\t\tIngrese el nombre del producto\n\t\t\t");
	fflush(stdin);
	gets((p_producto+contador_productos)->nombre_producto);
	fflush(stdin);
	printf("\n\t\t\tIngrese el valor del producto\n\t\t\t");
	fflush(stdin);
//	scanf("%d",&(p_producto+contador_productos)->valor);
	scanf("%i",&valor2);
	fflush(stdin);
	(p_producto+contador_productos)->valor = valor2;
	contador_productos++;
	
	printf("\n\n\n");
	system("pause");
	menu_admin_2();
}

void menu_admin_2_listar_productos(){
	system("cls");
	int i;
	
	for(i=0;i<contador_productos;i++){
		printf("\n\n\t\t\tNombre del producto = %s",(p_producto+i)->nombre_producto);
		printf("\n\t\t\tValor del producto = %i",(p_producto+i)->valor);
	}
	
	printf("\n\n\n");
	system("pause");
	menu_admin_2();
}

void menu_admin_2(){
	system("cls");
	int opc;
	printf("\n\n\t\t\tSeleccion la opcion deseada");
	printf("\n\t\t\t1. Crear producto");
	printf("\n\t\t\t2. Listar productos");
	printf("\n\t\t\t3. Modificar producto");
	printf("\n\t\t\t4. Volver al menu anterior\n\t\t\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: menu_admin_2_crear_producto();
			break;
		case 2: menu_admin_2_listar_productos();
			break;
		case 3: menu_admin_3_modificar_producto();
			break;
		case 4: menu_admin();
			break;
		default: system("cls");
				 printf("\n\n\t\t\tHa ingresado un dato invalido\n");
				 system("pause");
				 menu_admin_2();
			break;
	}
}

void menu_admin(){
	system("cls");
	int opc;
	printf("\n\n\t\t\tSeleccion la opcion deseada");
	printf("\n\t\t\t1. Crear, listar y modificar clientes");
	printf("\n\t\t\t2. Crear, listar y modificar productos");
	printf("\n\t\t\t3. Volver al menu principal\n\t\t\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: menu_admin_1();
			break;
		case 2: menu_admin_2();
			break;
		case 3: menu_principal();
			break;
		default: system("cls");
				 printf("\n\n\t\t\tHa ingresado un dato invalido\n");
				 system("pause");
				 menu_admin();
			break;
	}
}


void menu_cajero_crear_facturas(){
	system("cls");
	
	int i, cliente=0, producto=0;
	printf("\n\n\t\t\tLos clientes ingresados son:\n");
	for(i=0;i<contador_clientes;i++){
		printf("\n\t\t\t[%i] =  %s",i+1,(p_cliente+i)->nombre);		
	}
	printf("\n\n\t\t\tLos productos ingresados son: \n");
	for(i=0;i<contador_productos;i++){
		printf("\n\t\t\t[%i] =  %s",i+1,(p_producto+i)->nombre_producto);	
	}
	
	printf("\n\n\t\t\tSeleccione el cliente\n\t\t\t");
	scanf("%i",&cliente);
	strcpy((p_factura+contador_facturas)->cliente,(p_cliente+cliente-1)->nombre);
	
	int bandera = 1, cantidad=0, valor_compra=0, c=1;
	posicion_inicial = contador_productos_factura;
	
	(p_factura+contador_facturas)->pos_ini = posicion_inicial;
	
	printf("\n\t\t\tSeleccione los productos, para finalizar la seleccion presione el 0\n\t\t\t");
	
	while(bandera != 0){
		printf("\n\t\t\tProducto #[%i] \n\t\t\t",c);
		scanf("%i",&producto);
		c++;
		if(producto == 0){
			bandera = 0;
		}else{
			p_vector_productos[contador_productos_factura] = producto-1;
			printf("\n\t\t\tIngrese la cantidad del producto : %s\n\t\t\t",(p_producto+producto-1)->nombre_producto);
			scanf("%i",&cantidad);
			p_vector_cantidad[contador_cantidad_factura]= cantidad;
			
			valor_compra = cantidad * (p_producto+producto-1)->valor;
			(p_factura+contador_facturas)->valortotal += valor_compra;
				
				
			contador_productos_factura++;
			contador_cantidad_factura++;
			
		}
		
	}
	(p_factura+contador_facturas)->pos_fin = contador_productos_factura;
	
	printf("\n\n\t\t\tSi la forma de pago de la factura es de contado escriba 'pagada', de lo contrario escriba 'fiada'\n\t\t\t");
	fflush(stdin);
	gets((p_factura+contador_facturas)->estado);
	fflush(stdin);
	contador_facturas++;
	
	printf("\n\n\n");
	system("pause");
	menu_cajero_1();
}

void menu_cajero_listar_facturas(){
	system("cls");
	
	int i, j, c, valor_compra=0;
	
	if(contador_facturas == 0){
		printf("\n\n\t\t\tHasta el momento no hay facturas registradas\n\n\n");
		system("pause");
		menu_cajero_1();
	}
	
	for(i=0;i<contador_facturas;i++){
		if(contador_facturas == 0){
			printf("\n\n\t\t\tHasta el momento no hay facturas registradas\n\n\n");
				
			}else{
				printf("\n\n\t\t\tFactura #[%i]\n",i+1);
				printf("\n\t\t\tCliente = %s\n",(p_factura+i)->cliente);
		
			c=1;
			for(j=(p_factura+i)->pos_ini;j<(p_factura+i)->pos_fin;j++){
				printf("\n\t\t\tProducto #[%i] = %s\n",c, (p_producto+p_vector_productos[j])->nombre_producto);
				printf("\t\t\tCantidad = %i\n",*(p_vector_cantidad+j));
				printf("\t\t\tPrecio unitario= %i\n",(p_producto+p_vector_productos[j])->valor);
				
				c++;
			}
		
			printf("\n\t\t\tValor total de la compra = %i",(p_factura+i)->valortotal);
			printf("\n\t\t\tEl estado es = %s\n\n",(p_factura+i)->estado);
			}
		}
		
	
	system("pause");
	menu_cajero_1();
}

void menu_cajero_1(){
	system("cls");
	int opc;
	printf("\n\n\t\t\tSeleccion la opcion deseada");
	printf("\n\t\t\t1. Crear factura");
	printf("\n\t\t\t2. Listar factura");
	printf("\n\t\t\t3. Volver al menu anterior\n\t\t\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: menu_cajero_crear_facturas();
			break;
		case 2: menu_cajero_listar_facturas();
			break;
		case 3: menu_cajero();
			break;
		default: printf("\n\n\t\t\tHa ingresado un dato invalido\n");
				 menu_cajero_1();
			break;
	}
}

void menu_cajero_2(){
	system("cls");
	int i, j;
	char cliente[30];
	printf("\n\n\t\t\tLos clientes ingresados son: \n");
	for(i=0;i<contador_clientes;i++){
		printf("\n\t\t\t[%i] =  %s",i+1,(p_cliente+i)->nombre);		
	}
	printf("\n\n\t\t\tA que cliente desea buscarle facturas? (ingrese el nombre)\n\t\t\t");
	fflush(stdin);
	gets(cliente);
	
	if(contador_facturas == 0){
		printf("\n\n\t\t\tHasta el momento no hay facturas registradas\n\n\n");
		system("pause");
		menu_cajero();
	}
	
	for(i=0;i<contador_facturas;i++){
		if(strcmp((p_factura+i)->cliente,cliente)==0){
			printf("\n\n\t\t\tFactura #[%i]\n",i+1);
			printf("\n\t\t\tCliente = %s\n",(p_factura+i)->cliente);
		
			int c=1;
			for(j=(p_factura+i)->pos_ini;j<(p_factura+i)->pos_fin;j++){
				printf("\n\t\t\tProducto #[%i] = %s\n",c, (p_producto+p_vector_productos[j])->nombre_producto);
				printf("\t\t\tCantidad = %i\n",*(p_vector_cantidad+j));
				printf("\t\t\tPrecio unitario= %i\n",(p_producto+p_vector_productos[j])->valor);

				c++;
			}
		printf("\n\t\t\tValor total de la compra = %i",(p_factura+i)->valortotal);
		printf("\n\t\t\tEl estado es = %s\n\n\n",(p_factura+i)->estado);
		}else{
			printf("\n\n\t\t\tEl cliente no tiene facturas\n\n\n");
		}
	}
	system("pause");
	menu_cajero();
}

void menu_cajero_3(){
	system("cls");

	int i, j;
	int c=1;
	
	if(contador_facturas == 0){
		printf("\n\n\t\t\tHasta el momento no hay facturas pagadas\n\n\n");
		system("pause");
		menu_cajero();
	}
	
	for(i=0;i<contador_facturas;i++){
		if(strcmp((p_factura+i)->estado,"pagada")==0){
			printf("\n\n\t\t\tFactura #[%i]\n",i+1);
			printf("\n\t\t\tCliente = %s\n",(p_factura+i)->cliente);
		
			int c=1;
			for(j=(p_factura+i)->pos_ini;j<(p_factura+i)->pos_fin;j++){
				printf("\n\t\t\tProducto #[%i] = %s\n",c, (p_producto+p_vector_productos[j])->nombre_producto);
				printf("\t\t\tCantidad = %i\n",*(p_vector_cantidad+j));
				printf("\t\t\tPrecio unitario= %i\n",(p_producto+p_vector_productos[j])->valor);
				
				c++;
			}
		
		printf("\n\t\t\tValor total de la compra = %i",(p_factura+i)->valortotal);
		printf("\n\t\t\tEl estado es = %s\n\n\n",(p_factura+i)->estado);
		}else{
			printf("\n\n\t\t\tHasta el momento no hay facturas pagadas\n\n\n");
		}
	}
	
	system("pause");
	menu_cajero();
}

void menu_cajero_4(){
	system("cls");
	int i, j;
	
	if(contador_facturas == 0){
		printf("\n\n\t\t\tHasta el momento no hay facturas fiadas\n\n\n");
		system("pause");
		menu_cajero();
	}
	
	for(i=0;i<contador_facturas;i++){
		if(strcmp((p_factura+i)->estado,"fiada")==0){
			printf("\n\n\t\t\tFactura #[%i]\n",i+1);
			printf("\n\t\t\tCliente = %s\n",(p_factura+i)->cliente);
		
			int c=1;
			for(j=(p_factura+i)->pos_ini;j<(p_factura+i)->pos_fin;j++){
				printf("\n\t\t\tProducto #[%i] = %s\n",c, (p_producto+p_vector_productos[j])->nombre_producto);
				printf("\t\t\tCantidad = %i\n",*(p_vector_cantidad+j));
				printf("\t\t\tPrecio unitario= %i\n",(p_producto+p_vector_productos[j])->valor);

				c++;
			}

		printf("\n\t\t\tValor total de la compra = %i",(p_factura+i)->valortotal);
		printf("\n\t\t\tEl estado es = %s\n\n\n",(p_factura+i)->estado);
		}else{
			printf("\n\n\t\t\tHasta el momento no hay facturas fiadas\n\n\n");
		}
	}
	system("pause");
	menu_cajero();
	
}

void menu_cajero(){
	system("cls");
	int opc;
	printf("\n\n\t\t\tSeleccion la opcion deseada");
	printf("\n\t\t\t1. Crear, listar facturas");
	printf("\n\t\t\t2. Mostrar las facturas de un cliente");
	printf("\n\t\t\t3. Mostrar las facturas pagadas");
	printf("\n\t\t\t4. Mostrar las facturas sin pagar");
	printf("\n\t\t\t5. Volver al menu principal\n\t\t\t");
	scanf("%i",&opc);
	switch(opc){
		case 1: menu_cajero_1();
			break;
		case 2: menu_cajero_2();
			break;
		case 3:	menu_cajero_3();
			break;
		case 4: menu_cajero_4();
			break;
		case 5: menu_principal();
			break;
		default: system("cls"); 
				 printf("\n\n\t\t\tHa ingresado un dato invalido\n");
				 system("pause");
			break;
	}
}

void menu_principal(){
	system("cls");
	char contra[]="admin12", usuario[] ="admin", usuario1[30], contra1[30];
	char contra2[]="caja12", usuario2[] ="caja1";
	int opc;
	
	printf("\n\n\t\t\tSeleccion la opc deseada");
	printf("\n\t\t\t1. Ingresar al sistema");
	printf("\n\t\t\t2. Salir\n\t\t\t");
	scanf("%i",&opc);
	system("cls");
	switch(opc){
		case 1: printf("\n\n\t\t\tIngrese el usuario\n\t\t\t");
				fflush(stdin);
				gets(usuario1);
				printf("\n\t\t\tIngrese la contraseña\n\t\t\t");
				fflush(stdin);
				gets(contra1);

				if(strcmp(usuario,usuario1) == 0 && strcmp(contra,contra1) == 0){
					menu_admin();
				}else{
					if(strcmp(usuario2,usuario1) == 0 && strcmp(contra2,contra1) == 0){
					menu_cajero();
					}else{
						system("cls");
						printf("\n\n\t\t\tLa contraseña y/o usuario son incorrectas\n");
						menu_principal();
					}
				}
			break;
		case 2: printf("\n\n\t\t\tHasta luego\n");
				exit(-1);
			break;
		default: printf("\n\n\t\t\tHa ingresado un dato invalido\n");
		 		 menu_principal();
			break;
	}
}

int main() {
	system("color F5");
	datos_prestablecidos_productos();
	datos_prestablecidos_clientes();
	menu_principal();
	
	
	delete [] p_cliente;
	delete [] p_producto;
	delete [] p_factura;
	
	delete [] p_vector_productos;
	delete [] p_vector_cantidad;
	return 0;
}
