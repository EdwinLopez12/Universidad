#!/usr/bin/env python
# coding: utf-8

# In[1]:


from random import choice
from numpy import array, dot, random, exp, dot
import numpy as np
import matplotlib.pyplot as plt
import time

from tkinter import *
import tkinter as tk
from tkinter import ttk


# In[2]:


#funciones de activacion

def sigmoide(x):
    return 1/(1 + np.exp(-x))

def sigmoide_derivado(x):
    return sigmoide(x) * (1 - sigmoide(x))

def tangente(x):
    return np.tanh(x)

def tangente_derivada(x):
    return 1 - x**2


# In[3]:


class perceptron():
    def __init__(self, activacion, bahias, epocas):
        self.activacion = activacion
        self.bahias = bahias
        self.epocas = epocas
        self.entrenamiento = []
        self.errores = []
        self.esperados = []
        self.activacion = lambda x:0 if x < 0 else 1
    
    def entrena(self):
        w = random.rand(3)
        for i in range(self.epocas):
            x, esperado = choice(self.entrenamiento)
            resultado = dot(w,x)
            self.esperados.append(esperado)
            error = esperado - self.activacion(resultado)
            self.errores.append(error)
            #Ajuste
            w+=self.bahias * error * x
        self.mostrarResultados(x,w)
        
    def mostrarResultados(self, x, w):
        for x, _ in self.entrenamiento:
            resultado = dot(w,x)
            print("{}: {} -> {}".format(x[:3], resultado, self.activacion(resultado)))
        self.graficar()
        
    def graficar(self):
        plt.plot(self.errores,'-',color='red')
        plt.plot(self.esperados,'*', color='green')
        plt.show()
    
    def mostrarDatos(self):
        print(self.activacion)
        print(self.bahias)
        print(self.epocas)
        print(self.entrenamiento)
        
    def agregarEntrenamiento(self, entrenamiento):
         self.entrenamiento.append(entrenamiento)
    


# In[4]:


class RedNeuronal():
    def __init__(self, activacion):
        self.pesos_signaticos = 2 * random.random((3,1)) - 1
        self.errores = []
        if activacion == 'sigmoide':
            self.activacion = sigmoide
            self.activacion_prima = sigmoide_derivado
        elif activacion == 'tangente':
            self.activacion = tangente
            self.activacion_prima = tangente_derivada
            
    def entrenamiento(self,entradas,salidas,numero_iteraciones):
        for i in range(numero_iteraciones):
            salida = self.pensar(entradas)
            error = salidas - salida
            self.errores.append(abs(sum(error)))
            ajuste = dot(entradas.T, error * self.activacion_prima(salida))
            self.pesos_signaticos += ajuste
            
    def pensar(self,entrada):
        return self.activacion(dot(entrada, self.pesos_signaticos)) 
    
    def graficar(self):
        plt.plot(range(len(self.errores)), self.errores, color='b')
        plt.ylim([0, 1])
        plt.tight_layout()
        plt.show()


# In[5]:


class RedNeuronalM():
    def __init__(self, capas, activacion):
        if activacion == 'sigmoide':
            self.activacion = sigmoide
            self.activacion_prima = sigmoide_derivado
        elif activacion == 'tangente':
            self.activacion = tangente
            self.activacion_prima = tangente_derivada
            
        #Iniciarlizar pesos
        self.pesos = []
        self.deltas = []
        # capas = [2,3,2] randon entre 1, -1
        for i in range(1, len(capas) -1):
            r = 2 * np.random.random((capas[i-1] + 1, capas[i] + 1)) -1
            self.pesos.append(r)
        
        #asignar aleatorios a la capa de salida
        r = 2 * np.random.random((capas[i] + 1, capas[i + 1])) - 1
        self.pesos.append(r)
        
    def ajuste(self, X, y, factor_aprendizaje, epocas):
        ones = np.atleast_2d(np.ones(X.shape[0]))
        X = np.concatenate((ones.T, X), axis = 1)
        
        for k in range(epocas):
            i = np.random.randint(X.shape[0])
            a = [X[i]]
            
            for l in range(len(self.pesos)):
                dot_value = np.dot(a[l], self.pesos[l])
                activacion = self.activacion(dot_value)
                a.append(activacion)
                
            #Calculo la diferencia entre la capa de salida y el valor obtenido
            error = y[i] - a[-1]
            deltas = [error * self.activacion_prima(a[-1])]
            
            #Empezamos en la segunda capa hasta la ultima
            for l in range(len(a) - 2, 0, -1):
                deltas.append(deltas[-1].dot(self.pesos[l].T) * self.activacion_prima(a[l]))
            self.deltas.append(deltas)
            
            #invertir
            deltas.reverse()
            
            #Backpropagation
            for i in range(len(self.pesos)):
                capa = np.atleast_2d(a[i])
                delta = np.atleast_2d(deltas[i])
                self.pesos[i] += factor_aprendizaje * capa.T.dot(delta)
            
            #if k % 10000 == 0: print('epocas:', k)
                
    def predecir(self, x):
        unos = np.atleast_2d(np.ones(x.shape[0]))
        a = np.concatenate((np.ones(1).T, np.array(x)), axis = 0)
        for l in range(0, len(self.pesos)):
            a = self.activacion(np.dot(a, self.pesos[l]))
        return a
    
    def imprimir_pesos(self):
        print("Listado de Pesos de Conexiones")
        for i in range(len(self.pesos)):
            print(self.pesos[i])
    
    def obtener_deltas(self):
        return self.deltas    


# In[6]:


#Clase para el manejo de la venta
class Application(tk.Frame):
    def __init__(self, master=None):
        super().__init__(master)
        self.master = master
        self.master.title("Proyecto IA")
        self.master.geometry("600x600")
        self.pack()
        self.create_widgets()

    def create_widgets(self):
        #creacion del notebook y las ventanas a usar
        self.notebook = ttk.Notebook()
        self.notebook.pack(fill='both', expand='yes')
        pest0 = ttk.Frame(self.notebook)

        self.notebook.add(pest0, text="Proyecto")
        
        #Llamado a las funciones de creacion de objetos de cada pestaña
        self.create_widgets_pest0(pest0)
        
    
    def interfaz_general(self, pest0):
        self.bahias = tk.DoubleVar()
        textoBahias = tk.Label(pest0, text="Ingrese las bahias/factor de aprendizaje: ", fg="black").grid(column=0, row=0)
        self.entradaBahias = tk.Entry(pest0)
        self.entradaBahias.grid(column=1, row=0)
        self.entradaBahias["textvariable"] = self.bahias
        self.entradaBahias.bind('<Key -Return>', self.almacenar_bahias)
        
        
        self.epocas = tk.IntVar()
        textoEpocas = tk.Label(pest0, text="Ingrese las epocas: ", fg="black").grid(column=0, row=1)
        self.entradaEpocas = tk.Entry(pest0)
        self.entradaEpocas.grid(column=1, row=1)
        self.entradaEpocas["textvariable"] = self.epocas
        self.entradaEpocas.bind('<Key -Return>', self.almacenar_epocas)
        
        #Capturas los datos, uno por uno
        textoEntrenamiento = tk.Label(pest0, text="Ingrese los datos de entrenamiento: ", fg="black").grid(column=0, row=2)
        
        textoSalidas = tk.Label(pest0, text="Ingrese los salidas: ", fg="black").grid(column=1, row=2)
        
        #declaracion de variables
        self.entrenamiento1 = tk.IntVar()
        self.entrenamiento2 = tk.IntVar()
        self.entrenamiento3 = tk.IntVar()
        self.entrenamiento4 = tk.IntVar() #salida 1
        self.entrenamiento5 = tk.IntVar()
        self.entrenamiento6 = tk.IntVar()
        self.entrenamiento7 = tk.IntVar()
        self.entrenamiento8 = tk.IntVar() #salida 2
        self.entrenamiento9 = tk.IntVar()
        self.entrenamiento10 = tk.IntVar()
        self.entrenamiento11 = tk.IntVar()
        self.entrenamiento12 = tk.IntVar() #salida 3
        self.entrenamiento13 = tk.IntVar()
        self.entrenamiento14 = tk.IntVar()
        self.entrenamiento15 = tk.IntVar()
        self.entrenamiento16 = tk.IntVar() #salida 4
        
        #Entradas RNS
        self.entrenamiento17 = tk.IntVar() 
        self.entrenamiento18 = tk.IntVar() 
        self.entrenamiento19 = tk.IntVar() 
        
        
        #Contenedores 
        #1a
        self.entradaEntrenamiento1 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento1.place(x=89, y=65)
        self.entradaEntrenamiento1["textvariable"] = self.entrenamiento1
        self.entradaEntrenamiento1.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #2a
        self.entradaEntrenamiento2 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento2.place(x=125, y=65)
        self.entradaEntrenamiento2["textvariable"] = self.entrenamiento2
        self.entradaEntrenamiento2.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #3a
        self.entradaEntrenamiento3 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento3.place(x=161, y=65)
        self.entradaEntrenamiento3["textvariable"] = self.entrenamiento3
        self.entradaEntrenamiento3.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        # salida a
        self.entradaEntrenamiento4 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento4.place(x=233, y=65)
        self.entradaEntrenamiento4["textvariable"] = self.entrenamiento4
        self.entradaEntrenamiento4.bind('<Key -Return>', self.almacenar_entrenamiento)
        
         #1b
        self.entradaEntrenamiento5 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento5.place(x=89, y=88)
        self.entradaEntrenamiento5["textvariable"] = self.entrenamiento5
        self.entradaEntrenamiento5.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #2b
        self.entradaEntrenamiento6 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento6.place(x=125, y=88)
        self.entradaEntrenamiento6["textvariable"] = self.entrenamiento6
        self.entradaEntrenamiento6.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #3b
        self.entradaEntrenamiento7 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento7.place(x=161, y=88)
        self.entradaEntrenamiento7["textvariable"] = self.entrenamiento7
        self.entradaEntrenamiento7.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        # salida b
        self.entradaEntrenamiento8 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento8.place(x=233, y=88)
        self.entradaEntrenamiento8["textvariable"] = self.entrenamiento8
        self.entradaEntrenamiento8.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #1c
        self.entradaEntrenamiento9 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento9.place(x=89, y=111)
        self.entradaEntrenamiento9["textvariable"] = self.entrenamiento9
        self.entradaEntrenamiento9.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #2c
        self.entradaEntrenamiento10 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento10.place(x=125, y=111)
        self.entradaEntrenamiento10["textvariable"] = self.entrenamiento10
        self.entradaEntrenamiento10.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #3c
        self.entradaEntrenamiento11 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento11.place(x=161, y=111)
        self.entradaEntrenamiento11["textvariable"] = self.entrenamiento11
        self.entradaEntrenamiento11.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        # salida c
        self.entradaEntrenamiento12 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento12.place(x=233, y=111)
        self.entradaEntrenamiento12["textvariable"] = self.entrenamiento12
        self.entradaEntrenamiento12.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #1d
        self.entradaEntrenamiento13 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento13.place(x=89, y=133)
        self.entradaEntrenamiento13["textvariable"] = self.entrenamiento13
        self.entradaEntrenamiento13.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #2d
        self.entradaEntrenamiento14 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento14.place(x=125, y=133)
        self.entradaEntrenamiento14["textvariable"] = self.entrenamiento14
        self.entradaEntrenamiento14.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #3d
        self.entradaEntrenamiento15 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento15.place(x=161, y=133)
        self.entradaEntrenamiento15["textvariable"] = self.entrenamiento15
        self.entradaEntrenamiento15.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        # salida d
        self.entradaEntrenamiento16 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento16.place(x=233, y=133)
        self.entradaEntrenamiento16["textvariable"] = self.entrenamiento16
        self.entradaEntrenamiento16.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        
        
        
        textoBahias = tk.Label(pest0, text="Ingrese las entradas RNS/Capas: ", fg="black").place(x=350, y=20)
        # entradas Red neuronal simple
        self.entradaEntrenamiento17 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento17.place(x=350, y=42)
        self.entradaEntrenamiento17["textvariable"] = self.entrenamiento17
        self.entradaEntrenamiento17.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        # 
        self.entradaEntrenamiento18 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento18.place(x=386, y=42)
        self.entradaEntrenamiento18["textvariable"] = self.entrenamiento18
        self.entradaEntrenamiento18.bind('<Key -Return>', self.almacenar_entrenamiento)
        
        #
        self.entradaEntrenamiento19 = tk.Entry(pest0, width=5)
        self.entradaEntrenamiento19.place(x=422, y=42)
        self.entradaEntrenamiento19["textvariable"] = self.entrenamiento19
        self.entradaEntrenamiento19.bind('<Key -Return>', self.almacenar_entrenamiento)
        

        # Seleccion de funcion de activacion
        opcion = tk.IntVar()
        self.seleccion = tk.Entry()
        #self.seleccion.place(x=400,y=300)
        self.seleccion["textvariable"] = opcion
        #self.seleccion = Entry(pest0,textvariable=opcion).place(x=400,y=300)
        rb1 = Radiobutton(pest0,text='Tangente',value="tangente",variable=opcion).place(x=350,y=0)
        rb2 = Radiobutton(pest0,text='Sigmoide',value="sigmoide",variable=opcion).place(x=430,y=0)
        
        
        # Boton de ejecucion del perceptron 
        self.ejecutarPerceptron = tk.Button(pest0, text="Perceptron", command=self.ejecutar_perceptron, bg="white").place(x=10, y=170)
        self.tiempoEjecucion = tk.Label(pest0, text="Tiempo Ejecucion")
        self.tiempoEjecucion.place(x=10, y=250)
        
        self.salidas = tk.Label(pest0, text="Salidas")
        self.salidas.place(x=10, y=300)
        
        self.pesos = tk.Label(pest0, text="Pesos")
        self.pesos.place(x=10, y=350)
        

       
        
        # Boton de ejecucion de red neuronal simple 
        self.ejecutarPerceptron = tk.Button(pest0, text="Red Neuronal", command=self.ejecutar_red_neuronal_simple, bg="white").place(x=100, y=170)
        
        
        # Boton de ejecucion de red neuronal multicapa 
        self.ejecutarPerceptronM = tk.Button(pest0, text="Red Neuronal Multicapa", command=self.ejecutar_red_neuronal_multicapa, bg="white").place(x=190, y=170)
        
    
    #Clase para la pestaña 1
    
    
    def create_widgets_pest0(self, pest0):
        self.interfaz_general(pest0)

    def almacenar_bahias(self, event):
        print("Bahias: ", self.bahias.get())
        
    def almacenar_epocas(self, event):
        print("Epocas: ", self.epocas.get())
    
    def almacenar_entrenamiento(self, event):
        print(self.entrenamiento1.get(), " | ", self.entrenamiento2.get(), " | ", self.entrenamiento3.get(), " -> ",self.entrenamiento4.get())
        print(self.entrenamiento5.get(), " | ", self.entrenamiento6.get(), " | ", self.entrenamiento7.get(), " -> ",self.entrenamiento8.get())
        print(self.entrenamiento9.get(), " | ", self.entrenamiento10.get(), " | ", self.entrenamiento11.get(), " -> ",self.entrenamiento12.get())
        print(self.entrenamiento13.get(), " | ", self.entrenamiento14.get(), " | ", self.entrenamiento15.get(), " -> ",self.entrenamiento16.get())
        print("\n", self.entrenamiento17.get(), " | ", self.entrenamiento18.get(), " | ", self.entrenamiento19.get())
        
        
    def ejecutar_red_neuronal_multicapa(self):
        self.salidas.configure(text="Salidas")
        self.pesos.configure(text="Pesos")
        self.tiempoEjecucion.configure(text="Tiempo de Ejecucion")
        
        inicio_de_tiempo = time.perf_counter()
        
        multi = RedNeuronalM([self.entrenamiento17.get(),self.entrenamiento18.get(),self.entrenamiento19.get()], activacion=self.seleccion.get())
        
        X = np.array([
                     [self.entrenamiento1.get(), self.entrenamiento2.get()], # sin obstaculos
                     [self.entrenamiento5.get(),self.entrenamiento6.get()], # sin obstaculos
                     [self.entrenamiento9.get(), self.entrenamiento10.get()], # sin obstaculos
                     [self.entrenamiento13.get(), self.entrenamiento14.get()], #obstaculo detectado a la derecha
                    ]) # demasiado cerca a la izquierda

        y = np.array([
                      [self.entrenamiento3.get(), self.entrenamiento4.get()], #avanzar
                      [self.entrenamiento7.get(), self.entrenamiento8.get()], #avanzar
                      [self.entrenamiento11.get(), self.entrenamiento12.get()], #avanzar
                      [self.entrenamiento15.get(), self.entrenamiento16.get()], #giro izquierda
                    ]) #retroceder
        multi.ajuste(X, y, self.bahias.get(), self.epocas.get())

        
        # fin de ejecucion
        tiempo_final = time.perf_counter () 
        tiempo_transcurrido = tiempo_final - inicio_de_tiempo
        self.tiempoEjecucion.configure(text=tiempo_transcurrido)
        
        resultado = []
        index = 0
        for e in X:
            print(multi.predecir(e))
            resultado.append(multi.predecir(e))
            index = index + 1
        self.salidas.configure(text=resultado)
        
        deltas = multi.obtener_deltas()
        valores = []
        index = 0
        for arreglo in deltas:
            valores.append(arreglo[1][0] + arreglo[1][1])
            index = index + 1

        plt.plot(range(len(valores)), valores, color='b')
        plt.ylim([0, 1])
        plt.ylabel('Costo')
        plt.xlabel('Epocas')
        plt.tight_layout()
        plt.show()
        
        
    def ejecutar_red_neuronal_simple(self):
        self.salidas.configure(text="Salidas")
        self.pesos.configure(text="Pesos")
        self.tiempoEjecucion.configure(text="Tiempo de Ejecucion")
        inicio_de_tiempo = time.perf_counter()
        
        red_neuronal = RedNeuronal(activacion=self.seleccion.get())
        entradas = array([[self.entrenamiento1.get(),self.entrenamiento2.get(),self.entrenamiento3.get()], 
                          [self.entrenamiento5.get(),self.entrenamiento6.get(),self.entrenamiento7.get()], 
                          [self.entrenamiento9.get(),self.entrenamiento10.get(),self.entrenamiento11.get()], 
                          [self.entrenamiento13.get(),self.entrenamiento14.get(),self.entrenamiento15.get()]])
        salidas = array([[self.entrenamiento4.get(),self.entrenamiento8.get(),self.entrenamiento12.get(),self.entrenamiento6.get()]]).T
        red_neuronal.entrenamiento(entradas,salidas,self.epocas.get())

         
        # fin de ejecucion
        tiempo_final = time.perf_counter () 
        tiempo_transcurrido = tiempo_final - inicio_de_tiempo
        resultado = tk.StringVar()
        resultado = red_neuronal.pensar(array([self.entrenamiento17.get(),self.entrenamiento18.get(),self.entrenamiento19.get()]))
        self.salidas.configure(text=resultado)
        self.pesos.configure(text=red_neuronal.pesos_signaticos)
        self.tiempoEjecucion.configure(text=tiempo_transcurrido)
        red_neuronal.graficar()
    
    def ejecutar_perceptron(self):
        self.salidas.configure(text="Salidas")
        self.pesos.configure(text="Pesos")
        self.tiempoEjecucion.configure(text="Tiempo de Ejecucion")
        inicio_de_tiempo = time.perf_counter()
        
        #Ejecucion de la función
        perce = perceptron('escalonada', self.bahias.get(), self.epocas.get())
        perce.agregarEntrenamiento((array([self.entrenamiento1.get(),self.entrenamiento2.get(),self.entrenamiento3.get()]),self.entrenamiento4.get()))
        perce.agregarEntrenamiento((array([self.entrenamiento5.get(),self.entrenamiento6.get(),self.entrenamiento7.get()]),self.entrenamiento8.get()))
        perce.agregarEntrenamiento((array([self.entrenamiento9.get(),self.entrenamiento10.get(),self.entrenamiento11.get()]),self.entrenamiento12.get()))
        perce.agregarEntrenamiento((array([self.entrenamiento13.get(),self.entrenamiento14.get(),self.entrenamiento15.get()]),self.entrenamiento16.get()))
        
        perce.mostrarDatos()
        perce.entrena()
        
        # fin de ejecucion
        tiempo_final = time.perf_counter () 
        tiempo_transcurrido = tiempo_final - inicio_de_tiempo
        self.tiempoEjecucion.configure(text=tiempo_transcurrido)


# In[7]:


root = tk.Tk()
app = Application(master=root)
app.mainloop()

#100

