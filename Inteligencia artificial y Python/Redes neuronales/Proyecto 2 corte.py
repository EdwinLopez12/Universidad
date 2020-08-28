#!/usr/bin/env python
# coding: utf-8

# In[13]:


from tkinter import *
from tkinter import ttk
from random import choice
from numpy import array, dot, random
import matplotlib.pyplot as plt
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg
from matplotlib.figure import Figure


# In[14]:


def perceptron(bahias, epocas):
    
    #Funcion de Activación
    activacion = lambda x:0 if x < 0 else 1

    #Set de Entrenamiento
    entrenamiento = [
        (array([0,0,1]),0),
        (array([0,1,1]),1),
        (array([1,0,1]),1),
        (array([1,1,1]),1),
    ]
    
    w = random.rand(3)
    errores = []
    esperados = []
    #bahias = 0.2
    #n = 100
    
   #Entrenamiento
    for i in range(epocas):
        x, esperado = choice(entrenamiento)
        resultado = dot(w, x)
        esperados.append(esperado)
        error = esperado - activacion(resultado)
        errores.append(error)
        #Ajuste
        w += bahias * error * x
    
    for x, _ in entrenamiento:
        resultado = dot(w, x)
        print("{}: {} -> {}".format(x[:3], resultado, activacion(resultado)))
    
    plt.plot(errores,'-',color='red')
    plt.plot(esperados,'*', color='green')
   


# In[15]:


def hacer_click():
 try:
    # Asignacion de datos
    bahias = float(entrada_bahias.get())
    epocas = int(entrada_epocas.get())
    #entrenamiento = int(entrada_entrenamiento.get())
    
    print("Bahia = ", bahias)
    print("Epocas = ", epocas)
    #print("Entrenamiento = ", entrenamiento)
    
    #Mostrar los datos copturados
    etiqueta_datos_bahias.configure(text=bahias)
    etiqueta_datos_epocas.configure(text=epocas)
    #etiqueta_datos_entrenamiento.configure(text=entrenamiento)
    
    perceptron(bahias, epocas)
    
 except ValueError:
    etiqueta_datos_bahias.configure(text="Introduce un numero!")
    etiqueta_datos_epocas.configure(text="Introduce un numero!")
    #etiqueta_datos_entrenamiento.configure(text="Introduce un numero!")

    
#configuracion inicial de la ventana
ventana = Tk()
ventana.title("Proyecto de 2 corte, Inteligencia Artificial")
ventana.geometry("500x500")
notebook = ttk.Notebook(ventana)
notebook.pack(fill='both',expand='yes')



# In[16]:


#pestaña 1
pest0 = ttk.Frame(notebook)

# Labels
etiqueta_bahias = Label(pest0,text="Ingrese la bahia: ")
etiqueta_bahias.grid(column=0, row=0)

etiqueta_epocas = Label(pest0, text="Ingrese la epoca")
etiqueta_epocas.grid(column=0, row=1)

#etiqueta_entrenamiento = Label(pest0, text="Ingrese las entradas")
#etiqueta_entrenamiento.grid(column=0, row=2)

# Captura de datos
entrada_bahias = Entry(pest0, width=20)
entrada_bahias.grid(column=1, row=0)

entrada_epocas = Entry(pest0, width=20)
entrada_epocas.grid(column=1, row=1)

#entrada_entrenamiento = Entry(pest0, width=20)
#entrada_entrenamiento.grid(column=1, row=2)

# Boton de almacenamiento
botonAlmacenar = Button(pest0, text="Almacenar!", command=hacer_click)
botonAlmacenar.grid(column=0, row=3)


# Labels 2
etiqueta_bahias_show = Label(pest0, text="Bahias")
etiqueta_bahias_show.grid(column=0, row=4)

etiqueta_epocas_show = Label(pest0, text="Epocas")
etiqueta_epocas_show.grid(column=0, row=5)

#etiqueta_entrenamiento_show = Label(pest0, text="Entradas")
#etiqueta_entrenamiento_show.grid(column=0, row=6)

# show datos

etiqueta_datos_bahias = Label(pest0, text="Valor")
etiqueta_datos_bahias.grid(column=1, row=4)

etiqueta_datos_epocas = Label(pest0, text="Valor")
etiqueta_datos_epocas.grid(column=1, row=5)

#etiqueta_datos_entrenamiento = Label(pest0, text="Valor")
#etiqueta_datos_entrenamiento.grid(column=1, row=6)
                                          


# In[17]:


pest1 = ttk.Frame(notebook)
pest2 = ttk.Frame(notebook)
notebook.add(pest0,text="Perceptron")
notebook.add(pest1,text="Red neuronal simple")
notebook.add(pest2,text="Red neuronal multicapa")


ventana.mainloop()

