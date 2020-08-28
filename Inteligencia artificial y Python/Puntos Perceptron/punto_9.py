#Importar los paquetes necesarios
import matplotlib.pyplot as plt
import numpy as np


#declaracion de las variables a usar
x1, y1, x2, y2, x3, y3 = [1], [2], [-1], [2], [0], [-1]


#prueba 1 Forma del plano carteciano
plt.plot(x1, y1, linestyle="none", marker="+", color="red", label="E1")
plt.plot(x2, y2, linestyle="none", marker="*", color="blue", label="E2")
plt.plot(x3, y3, linestyle="none", marker="*", color="blue", label="E2")
plt.grid()


#Puntos de la recta
x = [1 , -1]
y = [-1 , 3]


#Prueba con los puntos seleccionados graficados
plt.plot(x1,y1, linestyle="none", marker="+", color="red", label="E1")
plt.plot(x2,y2, linestyle="none", marker="*", color="blue", label="E2")
plt.plot(x3,y3, linestyle="none", marker="*", color="blue", label="E2")
plt.plot(x, y, marker="p")
plt.grid()


#Hallar la pendiente
m = (y[1] - y[0]) / (x[1] - x[0])


#Hallar el punto de corte con el eje Y
def funcion_corte_y(m,x,y):
    #determinar si Y es positivo o negativo para saber la operacion
    if y < 0:
        return (m*-x) - (y*-1)
    else:
        return (m*-x) + (y)


#Punto seleccionado para encontrar el corte con Y
punto_x = 1
punto_y = -1
corte = funcion_corte_y(m,punto_x, punto_y)


#Hallar los puntos por donde se trazan las baias
def funcion_y(m,x,c):
    return (m*x)+corte


#valores dados
lista_x = [1,-2,5]
lista_y = [funcion_y(m,lista_x[0],corte), funcion_y(m,lista_x[1],corte), funcion_y(m,lista_x[2],corte)]


#trazar la recta
plt.plot(x1,y1, linestyle="none", marker="+", color="red", label="E1")
plt.plot(x2,y2, linestyle="none", marker="*", color="blue", label="E2")
plt.plot(x3,y3, linestyle="none", marker="*", color="blue", label="E2")
plt.plot(lista_x, lista_y, marker="*", color="yellow")
plt.grid()


#Hallar los pesos para la recta
def funcion_w(m):
    return int(m*-1)


#Pesos recta 
w = [1, funcion_w(m)]


#Hallar el peso neto de la recta
def funcion_peso(p1,p2,x1,y1,c):
    return (p1*x1)+(p2*y1)+c


#Parejas ordenadas (entradas)
pareja_x = [1,-1,0]
pareja_y = [2,2,-1]


#Ns neto de la recta
n1 = funcion_peso(w[0],w[1],pareja_x[0],pareja_y[0],corte)
n2 = funcion_peso(w[0],w[1],pareja_x[1],pareja_y[1],corte)
n3 = funcion_peso(w[0],w[1],pareja_x[2],pareja_y[2],corte)


#Funcion de activación
def fucion_activacion(v):
    if v < 0:
        return -1
    else:
        return 1


#Activacion para los Ns de la recta (1)
a1 = fucion_activacion(n1)
a2 = fucion_activacion(n2)
a3 = fucion_activacion(n3)


#Vector de salidas
salidas = [1,0,0]


#Calcular el error recta
e1 = salidas[0]-a1
e2 = salidas[1]-a2
e3 = salidas[2]-a3


print("Resultado recta")
print("Entradas 1=",x1,y1, "2=",x2,y2, "3=",x3,y3)
print("Pendiente =",m)
print("Punto de corte con Y=",corte)
print("Pesos =",w[0],w[1])
print("Errores: 1=",e1," 2=", e2, " 3=",e3)