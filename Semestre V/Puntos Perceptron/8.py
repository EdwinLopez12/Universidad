#Importar los paquetes necesarios
import matplotlib.pyplot as plt
import numpy as np

#Entradas de las variables a usar
entradas_x = [0,-2,-2,-2,0,2,2,2]
entradas_y = [2,2,2,-2,-2,-2,0,2]

#Graficando las entradas del plano carteciano
'''
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[1], entradas_y[1], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[2], entradas_y[2], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[3], entradas_y[3], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[4], entradas_y[4], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[5], entradas_y[5], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[6], entradas_y[6], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[7], entradas_y[7], linestyle="none", marker="+", color="blue", label="E1")
plt.grid()
'''

#Puntos de la recta
x = [2,-1]
y = [1,-2]


#Grafica el plano con los puntos seleccionados
'''
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[1], entradas_y[1], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[2], entradas_y[2], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[3], entradas_y[3], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[4], entradas_y[4], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[5], entradas_y[5], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[6], entradas_y[6], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[7], entradas_y[7], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(x, y, marker="p")
plt.grid()
'''

#Hallar la pendiente 
m = (y[1] - y[0]) / (x[1]-x[0])

#Hallar el punto de corte con el eje Y
def funcion_corte_y(m,x,y):
    return (m*-x) + (y)


#Punto seleccionado para encontrar el corte con Y (Punto pendiente) de la recta (1)
punto_x = 2
punto_y = 1

corte = funcion_corte_y(m,punto_x, punto_y)

#Hallar los puntos por donde se trazan las baias
def funcion_y(m,x,c):
    return (m*x)+c

#Valores dados para determinar la recta (1)
lista_x = [1,-1,2,-2]
lista_y = [funcion_y(m,lista_x[0],corte), funcion_y(m,lista_x[1],corte), funcion_y(m,lista_x[2],corte), funcion_y(m,lista_x[3],corte) ]


#Trazar la recta
'''
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[1], entradas_y[1], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[2], entradas_y[2], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[3], entradas_y[3], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[4], entradas_y[4], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[5], entradas_y[5], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[6], entradas_y[6], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[7], entradas_y[7], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(x, y, marker="p")
plt.plot(lista_x, lista_y, marker="*", color="gray")
plt.grid()
'''

#Hallar los pesos para la recta
def funcion_w(m):
    return int(m*-1)

#Pesos recta 
w = [1, funcion_w(m)]

#Hallar el peso neto de las rectas
def funcion_peso(p1,p2,x1,y1,c):
    return (p1*x1)+(p2*y1)+c

#Ns neto de la recta
n1 = funcion_peso(w[0],w[1],entradas_x[0],entradas_y[0],corte)
n2 = funcion_peso(w[0],w[1],entradas_x[1],entradas_y[1],corte)
n3 = funcion_peso(w[0],w[1],entradas_x[2],entradas_y[2],corte)
n4 = funcion_peso(w[0],w[1],entradas_x[3],entradas_y[3],corte)
n5 = funcion_peso(w[0],w[1],entradas_x[4],entradas_y[4],corte)
n6 = funcion_peso(w[0],w[1],entradas_x[5],entradas_y[5],corte)
n7 = funcion_peso(w[0],w[1],entradas_x[6],entradas_y[6],corte)
n8 = funcion_peso(w[0],w[1],entradas_x[7],entradas_y[7],corte)

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
a4 = fucion_activacion(n4)
a5 = fucion_activacion(n5)
a6 = fucion_activacion(n6)
a7 = fucion_activacion(n7)
a8 = fucion_activacion(n8)
    
#vector de salidas
salidas = [1,1,1,1,0,0,0,1]

#Calcular el error recta (1)
e1 = salidas[0]-a1
e2 = salidas[1]-a2
e3 = salidas[2]-a3
e4 = salidas[3]-a4
e5 = salidas[4]-a5
e6 = salidas[5]-a6
e7 = salidas[6]-a7
e8 = salidas[7]-a8


print("Resultado recta")
print("Entradas \n1=",entradas_x[0],entradas_y[0], "\n2=",entradas_x[1],entradas_y[1], "\n3=",entradas_x[2],entradas_y[2], "\n4=",entradas_x[3],entradas_y[3], "\n5=",entradas_x[4],entradas_y[4], "\n6=",entradas_x[5],entradas_y[5], "\n7=",entradas_x[6],entradas_y[6], "\n8=",entradas_x[7],entradas_y[7])
print("Pendiente =",m)
print("Punto de corte con Y=",corte)
print("Pesos =",w[0],w[1])
print("Errores: \n1=",e1," \n2=", e2, " \n3=",e3," \n4=",e4," \n5=",e5," \n6=",e6," \n7=",e7," \n8=",e8)

plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[1], entradas_y[1], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[2], entradas_y[2], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[3], entradas_y[3], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[4], entradas_y[4], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[5], entradas_y[5], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[6], entradas_y[6], linestyle="none", marker="*", color="red", label="E2")
plt.plot(entradas_x[7], entradas_y[7], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(x, y, marker="p")
plt.plot(lista_x, lista_y, marker="*", color="gray")
plt.grid()
