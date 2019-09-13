#Importar los paquetes necesarios
import matplotlib.pyplot as plt
import numpy as np

#declaracion de las variables a usar
entradas_x = [1,1,2,2,-1,-2,-1,-2]
entradas_y = [1,2,-1,0,2,1,-1,-2]

#Graficando las entradas del plano carteciano
'''
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.grid()
'''

#Puntos de la recta (1) (Primeras 4 parejas ordenadas)
x_1 = [-1, 1.5]
y_1 = [-2, 0.5]

#Puntos de la recta (2) (Ultimas 4 parejas ordenadas)
x_2 = [-0.5, -2]
y_2 = [1, -0.5]

#Grafica el plano con los puntos seleccionados
'''
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.plot(x_1, y_1, marker="p")
plt.plot(x_2, y_2, marker="p")
plt.grid()
'''
#Hallar la pendiente de la recta (1)
m = (y_1[1] - y_1[0]) / (x_1[1] - x_1[0])

#Hallar la pendiente de la recta (2)
m2 = (y_2[1] - y_2[0]) / (x_2[1] - x_2[0])

#Hallar el punto de corte con el eje Y
def funcion_corte_y(m,x,y):
    return (m*-x) + (y)

#Punto seleccionado para encontrar el corte con Y (Punto pendiente) de la recta (1)
punto_x1 = -1
punto_y1 = -2

corte1 = funcion_corte_y(m,punto_x1, punto_y1)

#Punto seleccionado para encontrar el corte con Y (Punto pendiente) de la recta (2)
punto_x2 = -0.5
punto_y2 = 1

corte2 = funcion_corte_y(m2, punto_x2, punto_y2)

#Hallar los puntos por donde se trazan las baias
def funcion_y(m,x,c):
    return (m*x)+c

#Valores dados para determinar la recta (1)
lista_x = [1,-1,2,-2]
lista_y_1 = [funcion_y(m,lista_x[0],corte1), funcion_y(m,lista_x[1],corte1), funcion_y(m,lista_x[2],corte1), funcion_y(m,lista_x[3],corte1) ]

#Valores dados para determinar la recta (2)
lista_y_2 = [funcion_y(m2,lista_x[0],corte2), funcion_y(m2,lista_x[1],corte2), funcion_y(m2,lista_x[2],corte2), funcion_y(m2,lista_x[3],corte2) ]


#Trazar la recta
'''
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.plot(lista_x, lista_y_1, marker="*", color="gray")
plt.plot(lista_x, lista_y_2, marker="*", color="gray")
plt.grid()
'''

#Hallar los pesos para la recta
def funcion_w(m):
    return int(m*-1)

#Pesos recta 1
w1 = [1, funcion_w(m)]
#Pesos recta 2
w2 = [1, funcion_w(m2)]


#Hallar el peso neto de las rectas
def funcion_peso(p1,p2,x1,y1,c):
    return (p1*x1)+(p2*y1)+c

#Ns neto de la recta 1 (4 primeras parejas ordenadas)
n1 = funcion_peso(w1[0],w1[1],entradas_x[0],entradas_y[0],corte1)
n2 = funcion_peso(w1[0],w1[1],entradas_x[1],entradas_y[1],corte1)
n3 = funcion_peso(w1[0],w1[1],entradas_x[2],entradas_y[2],corte1)
n4 = funcion_peso(w1[0],w1[1],entradas_x[3],entradas_y[3],corte1)

#Ns neto de la recta 2 (ultimas parejas ordenadas)
n5 = funcion_peso(w2[0],w2[1],entradas_x[4],entradas_y[4],corte2)
n6 = funcion_peso(w2[0],w2[1],entradas_x[5],entradas_y[5],corte2)
n7 = funcion_peso(w2[0],w2[1],entradas_x[6],entradas_y[6],corte2)
n8 = funcion_peso(w2[0],w2[1],entradas_x[7],entradas_y[7],corte2)



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

#Activacion para los Ns de la recta (2)
a5 = fucion_activacion(n5)
a6 = fucion_activacion(n6)
a7 = fucion_activacion(n7)
a8 = fucion_activacion(n8)

#Vector de salidas
salidas = [1,1,2,2,3,3,4,4]

#Calcular el error recta (1)
e1 = salidas[0]-a1
e2 = salidas[1]-a2
e3 = salidas[2]-a3
e4 = salidas[3]-a4

#Calcular el error recta (2)
e5 = salidas[4]-a5
e6 = salidas[5]-a6
e7 = salidas[6]-a7
e8 = salidas[7]-a8

#Mostrar los resultados obtenidos


print("Resultado recta 1")
print("Entradas \n1=",entradas_x[0],entradas_y[0], "\n2=",entradas_x[1],entradas_y[1], "\n3=",entradas_x[2],entradas_y[2], "\n4=",entradas_x[3],entradas_y[3])
print("Pendiente =",m)
print("Punto de corte con Y=",corte1)
print("Pesos =",w1[0],w1[1])
print("Errores: \n1=",e1," \n2=", e2, " \n3=",e3," \n4=",e4)

print("Resultado recta 2")
print("Entradas \n1=",entradas_x[4],entradas_y[4], "\n2=",entradas_x[5],entradas_y[5], "\n3=",entradas_x[6],entradas_y[6], "\n4=",entradas_x[7],entradas_y[7])
print("Pendiente =",m2)
print("Punto de corte con Y=",corte2)
print("Pesos =",w2[0],w2[1])
print("Errores: \n1=",e5," \n2=", e6, " \n3=",e7," \n4=",e8)

plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="blue", label="E1")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="+", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="yellow", label="E2")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="red", label="E3")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.plot(entradas_x[0], entradas_y[0], linestyle="none", marker="*", color="green", label="E4")
plt.plot(lista_x, lista_y_1, marker="*", color="gray")
plt.plot(lista_x, lista_y_2, marker="*", color="gray")
plt.grid()