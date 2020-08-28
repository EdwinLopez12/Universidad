#Importar los paquetes necesarios
import matplotlib.pyplot as plt
import numpy as np


#declaracion de las variables a usar
x1, y1, z1, x2, y2, z2 = [1], [-1], [-1], [1], [1], [-1]


#Punto seleccionado para encontrar el corte con Y
corte = 0.5


#Pesos recta 
w = [0.5, -1, -0.5]


#Hallar el peso neto de la recta
def funcion_peso(p1,p2,p3,x1,y1,z1,c):
    return (p1*x1)+(p2*y1)+(p3*z1)+c


#Parejas ordenadas (entradas)
pareja_x = [1,1]
pareja_y = [-1,1]
pareja_z = [-1,-1]

#Ns neto de la recta
n1 = funcion_peso(w[0],w[1],w[2],pareja_x[0],pareja_y[0],pareja_z[0],corte)
n2 = funcion_peso(w[0],w[1],w[2],pareja_x[1],pareja_y[1],pareja_z[1],corte)


#Funcion de activación
def fucion_activacion(v):
    if v < 0:
        return -1
    else:
        return 1


#Activacion para los Ns de la recta (1)
a1 = fucion_activacion(n1)
a2 = fucion_activacion(n2)


#Vector de salidas
salidas = [0, 1]


#Calcular el error recta
e1 = salidas[0]-a1
e2 = salidas[1]-a2


print("Resultado recta")
print("Entradas 1=",x1,y1,z1, "2=",x2,y2,z2)
print("Punto de corte con Y=",corte)
print("Pesos =",w[0],w[1],w[2])
print("Errores: 1=",e1," 2=", e2)