#Operaciones a realizar con matrices = Suma, Resta, Multiplicacion, Determinante, Transpuesta, Multiplicacion por escalar
#Generar la matriz automaticamente y guardar en un txt los resultados

#Importar los paquetes necesarios

import time
#import numpy as np
from random import randint

def archivoU(r):
	archivo = open("resultados.txt", "a")
	with open("resultados.txt", 'a'):
		archivo.write("\n[\n")
		archivo.write('%d' % r)
		archivo.write("\n")
		archivo.write("]\n")
	archivo.close()

def archivo(r, f, c):
	archivo = open("resultados.txt", "a")
	with open("resultados.txt", 'a'):
		archivo.write("\n[\n")
		for i in range(f):
			for j in range(c):
				archivo.write('%d' % r[i][j])
				archivo.write("\t")
			archivo.write("\n")
	archivo.write("]\n")
	archivo.close()

def matriz_ceros(f, c):
	matriz = []
	for i in range(f):
		a = [0] * c
		matriz.append(a) #Agregar al final
	return matriz

def asignacion_matriz(f,c):
	matriz = matriz_ceros(f, c)
	for i in range(f):
		for j in range(c):
			a = randint(0, 50)
			matriz[i][j] = a
	return matriz

def suma_matrices(f, c):
	A = asignacion_matriz(f, c)
	print("\nDatos de la matriz A\n")
	for i in range(f):
		print(A[i])

	B = asignacion_matriz(f, c)
	print("\nDatos de la matriz B\n")
	for i in range(f):
		print(B[i])

	R = matriz_ceros(f, c)
	for i in range(f):
		for j in range(c):
			R[i][j] = A[i][j] + B[i][j]

	print("\nSuma de ambas matrices\n")
	for i in range(f):
		print(R[i])

	archivo(R, f, c)

def suma():
	print("\t.: Info :.")
	print("Se crearan ambas matrices con el mismo orden para poder operarlas")
	columnas = int(input("Numero de columnas ="))
	filas = int(input("Numero de filas = "))
	suma_matrices(filas, columnas)

def resta_matrices(f, c):
	A = asignacion_matriz(f, c)
	print("\nDatos de la matriz A\n")
	for i in range(f):
		print(A[i])

	B = asignacion_matriz(f, c)
	print("\nDatos de la matriz B\n")
	for i in range(f):
		print(B[i])

	R = matriz_ceros(f, c)
	for i in range(f):
		for j in range(c):
			R[i][j] = A[i][j] - B[i][j]

	print("\nResta de ambas matrices\n")
	for i in range(f):
		print(R[i])

	archivo(R, f, c)

def resta():
	print("\t.: Info :.")
	print("Se crearan ambas matrices con el mismo orden para poder operarlas")
	columnas = int(input("Numero de columnas ="))
	filas = int(input("Numero de filas = "))
	resta_matrices(filas, columnas)

def multiplicacion_matrices(f, c):
    A = asignacion_matriz(f, c)
    print("\nDatos de la matriz A\n")
    for i in range(f):
        print(A[i])

    B = asignacion_matriz(f, c)
    print("\nDatos de la matriz B\n")
    for i in range(f):
        print(B[i])

    R = matriz_ceros(f, c)
    for i in range(f):
        for j in range(c):
            temporal = 0
            for k in range(f):
                temporal = temporal + (A[i][k] * B[k][j])
            R[i][j] = temporal

    print("\nMultiplicacion de ambas matrices\n")
    for i in range(f):
        print(R[i])

    archivo(R, f, c)

def multiplicacion():
    print("\t.: Info :.")
    print("Se crearan ambas matrices con el mismo orden para poder operarlas")
    orden = int(input("Orden ="))
    multiplicacion_matrices(orden, orden)

def determinante_matrices(f, c):
	A = asignacion_matriz(f, c)
	for i in range(f):
		print(A[i])

	if f == 1:
		R = A[0][0]
		print("El determinante es: ", R)
		archivoU(R)
		return
	elif f == 2:
		R = (A[0][0] * A[1][1]) - (A[0][1] * A[1][0])
		print("El determinante es: ", R)
		archivoU(R)
		return
	else:
		R = np.linalg.det(A)
		print("El determinante es: ", R)
		archivoU(R)
		return

def determinante():
	print("\t.: Info :.")
	print("Se creará una matriz cuadrada para poder operarla")
	orden = int(input("Numero de Orden = "))
	determinante_matrices(orden, orden)

def transpuesta_matrices(f, c):
	A = asignacion_matriz(f,c)
	print("\nDatos de la matriz A\n")
	for i in range(f):
		print(A[i])

	R = matriz_ceros(f, c)
	for i in range(f):
		for j in range(c):
			R[i][j] = A[j][i]

	print("\nMatriz transpuesta\n")
	for i in range(f):
		print(R[i])

	archivo(R, f, c)

def transpuesta():
	print("\t.: Info :.")
	print("Se creará una matriz cuadrada para poder operarla")
	orden = int(input("Numero de Orden = "))
	transpuesta_matrices(orden, orden)

def escalar_matrices(f, c, e):
	A = asignacion_matriz(f, c)
	print("\nDatos de la matriz A\n")
	for i in range(f):
		print(A[i])

	R = matriz_ceros(f, c)
	for i in range(f):
		for j in range(c):
			R[i][j] = A[i][j] * e

	print("\nMultiplicacion de escalar por matriz\n")
	for i in range(f):
		print(R[i])

	archivo(R, f, c)

def escalar():
	print("\t.: Info :.")
	print("Se creará una matriz de F x C")
	filas = int(input("Numero de filas = "))
	columnas = int(input("Numero de columnas ="))
	elemento = int(input("Escalar ="))
	escalar_matrices(filas, columnas, elemento)


s = 1
while s == 1:
    print()
    print("\t.: Calculadora de matrices :.")
    print("1) Suma")
    print("2) Resta")
    print("3) Multiplicacion")
    print("4) Determinante")
    print("5) Transpuesta")
    print("6) Multiplicacion por escalar")
    print("0) Finalizar")
    print()
    opcion=int(input("Ingrese Opcion: "))

    if opcion == 1:
        suma()
        time.sleep(1)
    elif opcion == 2:
        resta()
        time.sleep(1)
    elif opcion == 3:
        multiplicacion()
        time.sleep(1)
    elif opcion == 4:
        determinante()
        time.sleep(1)
    elif opcion == 5:
        transpuesta()
        time.sleep(1)
    elif opcion == 6:
        escalar()
        time.sleep(1)
    elif opcion == 0:
        break
    else:
        print("Dato invalido")
        time.sleep(2)
