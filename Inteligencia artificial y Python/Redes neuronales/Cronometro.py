#!/usr/bin/env python
# coding: utf-8

# In[20]:


# for python 3.x use 'tkinter' rather than 'Tkinter'
import tkinter as tk
import time

class App():
    def __init__(self):
        self.root = tk.Tk()
        self.label = tk.Label(text="")
        self.label.pack()
        self.update_clock()
        self.root.mainloop()

    def update_clock(self):
        now = time.strftime("%H:%M:%S")
        self.label.configure(text=now)
        self.root.after(1000, self.update_clock)

app=App()


# In[52]:


# for python 3.x use 'tkinter' rather than 'Tkinter'
import tkinter as tk
import time

class App():
    def __init__(self):
        self.root = tk.Tk()
        self.label = tk.Label(text="")
        self.label.pack()
        self.update_clock()
        self.root.mainloop()
    
    def escribir():
        print("Hola mundo")
    
    def update_clock(self):
        inicio_de_tiempo = time.perf_counter()
        #for i in range(10000):
         #   escribir()
        tiempo_final = time.perf_counter () 
        tiempo_transcurrido = tiempo_final - inicio_de_tiempo
        self.label.configure(text=tiempo_transcurrido)
        #print ("\nTomo %d segundos." % (tiempo_transcurrido))

app=App()


# In[3]:


#IMPORTAMOS LIBRERIAS NECESARIAS.
#https://programacionpython80889555.wordpress.com/2019/03/26/insertar-grafica-matplotlib-en-ventana-creada-con-tkinter-ejercicio-en-python/
import tkinter
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg, NavigationToolbar2Tk
from matplotlib.figure import Figure
import numpy as np

#------------------------------CREAR VENTANA---------------------------------
root = tkinter.Tk()
root.wm_title("Grafica insertada en Tkinter")


#------------------------------CREAR GRAFICA---------------------------------
fig = Figure(figsize=(5, 4), dpi=100) #Dimensiones de la grafica
t = np.arange(0, 5, .01) #rango numerico tamaño en x
fig.add_subplot(111).plot(t, 2 * np.sin(2 * np.pi * t))#AÑADIR "subbplot" expresion matematica a representar

canvas = FigureCanvasTkAgg(fig, master=root)  # CREAR AREA DE DIBUJO DE TKINTER.
canvas.draw()
canvas.get_tk_widget().pack(side=tkinter.TOP, fill=tkinter.BOTH, expand=1)

#-----------------------AÑADIR BARRA DE HERRAMIENTAS--------------------------
toolbar = NavigationToolbar2Tk(canvas, root)# barra de iconos
toolbar.update()
canvas.get_tk_widget().pack(side=tkinter.TOP, fill=tkinter.BOTH, expand=1)

#-----------------------------BOTÓN "cerrar"----------------------------------
def cerrar():
    root.quit()     
    root.destroy()

button = tkinter.Button(master=root, text="cerrar", command=cerrar)
button.pack(side=tkinter.BOTTOM)

tkinter.mainloop()


# In[71]:


import tkinter as tk
from tkinter import ttk

import matplotlib
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg
from matplotlib.figure import Figure
import pandas as pd


# DataFrame para ejemplo
df = pd.DataFrame({"Foo": (1, 5, 8, 7, 5, 1, 5),
                   "Bar": (4.25, 5, 6, 1.3, 1, 2.6, 3.7)}
                  )

# Creamos una figura y añadimos algunas gráficas en subplots
fig1 = Figure(figsize=(5, 5), dpi=100)
ax1 = fig1.add_subplot(311)
ax2 = fig1.add_subplot(312)
ax3 = fig1.add_subplot(313)
df.plot(ax=ax1)
df.plot.bar(ax=ax2)
df.plot.area(ax=ax3)


# Ventana principal
root = tk.Tk()

# Canvas  y barras de desplazamiento
canvas = tk.Canvas(root, borderwidth=0, background="#ffffff")
hsb = tk.Scrollbar(root, orient="horizontal", command=canvas.xview)                 
vsb = tk.Scrollbar(root, orient="vertical", command=canvas.yview)
canvas.configure(xscrollcommand=hsb.set)
canvas.configure(yscrollcommand=vsb.set)
hsb.pack(side="bottom", fill="x")
vsb.pack(side="right", fill="y")
canvas.pack(side="left", fill="both", expand=True)

# Vamos a usar un ttk.Labelframe para contener FigureCanvasTkAgg
plot_frame = ttk.Labelframe(canvas, text='Plots')
canvas.create_window((4,4), window=plot_frame, anchor="nw", tags="plot_frame")
plot_frame.bind("<Configure>",
                lambda event: canvas.configure(scrollregion=canvas.bbox("all"))
                )

# Creamos una instancia de FigureCanvas que renderizará la figura
canvas1 = FigureCanvasTkAgg(fig1, master=plot_frame)
canvas1.draw()
canvas1.get_tk_widget().grid(row=0, column=0)

root.mainloop()

