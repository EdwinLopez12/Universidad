#!/usr/bin/env python
# coding: utf-8

# In[5]:


from tkinter import *
 
window = Tk()
 
window.title("Welcome to LikeGeeks app")
 
window.geometry('350x200')
 
lbl = Label(window, text="Hello")
 
lbl.grid(column=0, row=0)
 
def clicked():
 
    lbl.configure(text="Button was clicked !!")
 
btn = Button(window, text="Click Me", command=clicked)
 
btn.grid(column=1, row=0)
 
window.mainloop()


# In[35]:


from tkinter import *
 
window = Tk()
 
window.title("Welcome to LikeGeeks app")
 
window.geometry('350x200')
 
lbl = Label(window, text="Hello")
 
lbl.grid(column=0, row=0)

txt = Entry(window,width=10)

txt.grid(column=1, row=0)
txt.focus() 
 
def clicked():
 
    res = "Welcome to " + txt.get()
 
    lbl.configure(text= res)
 
btn = Button(window, text="Click Me", command=clicked)
 
btn.grid(column=2, row=0)
 
window.mainloop()


# In[ ]:



entrenamiento = ""
#campo de datos de entrenamiento
etiqueta_entrenamiento = Label(pest0,text="Ingrese los datos de entrada: ").place(x=10,y=30)
entrada_entrenamiento = Entry(pest0,textvariable=entrenamiento).place(x=170,y=30)

epocas = ""
#campo de epocas
etiqueta_epocas = Label(pest0,text="Ingrese las epocas: ").place(x=10,y=50)
entrada_epocas = Entry(pest0,textvariable=epocas).place(x=130,y=50)


# In[29]:


from tkinter import *
 
from tkinter.ttk import *
 
window = Tk()
 
window.title("Welcome to LikeGeeks app")
 
selected = IntVar()
 
rad1 = Radiobutton(window,text='First', value=1, variable=selected)
 
rad2 = Radiobutton(window,text='Second', value=2, variable=selected)
 
rad3 = Radiobutton(window,text='Third', value=3, variable=selected)
 
def clicked():
 
   print(selected.get())
 
btn = Button(window, text="Click Me", command=clicked)
 
rad1.grid(column=0, row=0)
 
rad2.grid(column=1, row=0)
 
rad3.grid(column=2, row=0)
 
btn.grid(column=3, row=0)
 
window.mainloop()


# In[28]:


from tkinter import *
 
from tkinter import messagebox
 
window = Tk()
 
window.title("Welcome to LikeGeeks app")
 
window.geometry('350x200')
 
def clicked():
 
    messagebox.showinfo('Message title', 'Message content')
 
btn = Button(window,text='Click here', command=clicked)
 
btn.grid(column=0,row=0)
 
window.mainloop()


# In[5]:


from tkinter import *
 
from tkinter import Menu
 
window = Tk()
 
window.title("Welcome to LikeGeeks app")
 
menu = Menu(window)
 
new_item = Menu(menu)
 
new_item.add_command(label='New')
 
menu.add_cascade(label='File', menu=new_item)
 
window.config(menu=menu)
 
window.mainloop()


# In[9]:


from tkinter import *
from tkinter import ttk

# Calcula coste de viaje con validación y cálculo inmediato

class Aplicacion():
    def __init__(self):
        self.raiz = Tk()
        self.raiz.title("Alta Velocidad")
        
        # Declara variables de control
                                   
        self.num_via = IntVar(value=1)
        self.ida_vue = BooleanVar()        
        self.clase   = StringVar(value='t')
        self.km = IntVar(value=1)        
        self.precio = DoubleVar(value=0.10)
        self.total = DoubleVar(value=0.0)
        
        # Define trazas con variables de control de los widgets Entry()
        # para detectar cambios en los datos. Si se producen cambios
        # se llama a la función 'self.calcular' para validación y para
        # calcular importe a pagar
        
        self.km.trace('w', self.calcular)
        self.precio.trace('w', self.calcular)
        
        # Llama a función para validar y calcular
        
        self.calcular()
        
        # Carga imagen para asociar a widget Label()
                
        tren = PhotoImage(file='tren-128x64.png')  
        
        # Declara widgets de la ventana
        # En los widgets de tipo Spinbox, Checkbutton y Radiobutton
        # se utiliza la opción 'command' para llamar a la función 
        # 'self.calcular' para validar datos y calcular importe a 
        # pagar de forma inmediata
              
        self.imagen1 = ttk.Label(self.raiz, image=tren, 
                                 anchor="center")
        self.etiq1 = ttk.Label(self.raiz, text="Viajeros:")                               
        self.viaje = Spinbox(self.raiz, from_=1, to=20, wrap=True,
                             textvariable=self.num_via, 
                             state='readonly',
                             command=self.calcular)                                                              
        self.idavue = ttk.Checkbutton(self.raiz, text='Ida y vuelta', 
                                      variable=self.ida_vue, 
                                      onvalue=True, offvalue=False, 
                                      command=self.calcular)
        self.etiq2 = ttk.Label(self.raiz, text="Clase:")
        self.clase1 = ttk.Radiobutton(self.raiz, text='Turista', 
                                      variable=self.clase, value='t',
                                      command=self.calcular)
        self.clase2 = ttk.Radiobutton(self.raiz, text='Primera', 
                                      variable=self.clase, value='p',
                                      command=self.calcular)
        self.clase3 = ttk.Radiobutton(self.raiz, text='Lujo', 
                                      variable=self.clase, value='l',
                                      command=self.calcular)        
        self.etiq3 = ttk.Label(self.raiz, 
                               text="Distancia (Kilómetros):")
        self.dist = ttk.Entry(self.raiz, textvariable=self.km, 
                              width=10)                
        self.etiq4 = ttk.Label(self.raiz, text="Precio:")
        self.coste = ttk.Entry(self.raiz, textvariable=self.precio, 
                               width=10)        
        self.etiq5 = ttk.Label(self.raiz, text="A Pagar (euros):")        
        self.etiq6 = ttk.Label(self.raiz, textvariable=self.total,
                               foreground="yellow", background="black",
                               borderwidth=5, anchor="e")                                
        self.separ1 = ttk.Separator(self.raiz, orient=HORIZONTAL)
                
        self.boton1 = ttk.Button(self.raiz, text="Salir", 
                                 command=quit)                                 
                                                     
        self.imagen1.pack(side=TOP, fill=BOTH, expand=True, 
                          padx=10, pady=5)
        self.etiq1.pack(side=TOP, fill=BOTH, expand=True, 
                        padx=10, pady=5)
        self.viaje.pack(side=TOP, fill=X, expand=True, 
                        padx=20, pady=5)
        self.idavue.pack(side=TOP, fill=X, expand=True, 
                         padx=20, pady=5)
        self.etiq2.pack(side=TOP, fill=BOTH, expand=True, 
                        padx=10, pady=5)
        self.clase1.pack(side=TOP, fill=BOTH, expand=True, 
                         padx=20, pady=5)
        self.clase2.pack(side=TOP, fill=BOTH, expand=True, 
                         padx=20, pady=5)
        self.clase3.pack(side=TOP, fill=BOTH, expand=True, 
                         padx=20, pady=5)
        self.etiq3.pack(side=TOP, fill=BOTH, expand=True, 
                        padx=10, pady=5)
        self.dist.pack(side=TOP, fill=X, expand=True, 
                       padx=20, pady=5)
        self.etiq4.pack(side=TOP, fill=BOTH, expand=True, 
                        padx=10, pady=5)
        self.coste.pack(side=TOP, fill=X, expand=True, 
                        padx=20, pady=5)
        self.etiq5.pack(side=TOP, fill=BOTH, expand=True, 
                        padx=10, pady=5)
        self.etiq6.pack(side=TOP, fill=BOTH, expand=True, 
                        padx=20, pady=5)        
        self.separ1.pack(side=TOP, fill=BOTH, expand=True, 
                         padx=5, pady=5)
        self.boton1.pack(side=RIGHT, fill=BOTH, expand=True, 
                         padx=10, pady=10)
        self.raiz.mainloop()
        
    def calcular(self, *args):
        
        # Función para validar datos y calcular importe a pagar
        
        error_dato = False
        total = 0
        try:
            km = int(self.km.get())
            precio = float(self.precio.get())
        except:
            error_dato = True    
        if not error_dato:
            total =  self.num_via.get() * km * precio
            if self.ida_vue.get():
                total = total * 1.5
            if self.clase.get() == 'p':
                total = total * 1.2
            elif self.clase.get() == 'l':
                total = total * 2
            self.total.set(total)                
        else:
            self.total.set("¡ERROR!")
            
def main():
    mi_app = Aplicacion()
    return 0

if __name__ == '__main__':
    main()


# In[12]:


from tkinter import *
from tkinter import ttk

# Crea una clase Python para definir el interfaz de usuario de
# la aplicación. Cuando se cree un objeto del tipo 'Aplicacion'
# se ejecutará automáticamente el método __init__() qué 
# construye y muestra la ventana con todos sus widgets: 

class Aplicacion():
    def __init__(self):
        raiz = Tk()
        raiz.geometry('300x200')
        raiz.configure(bg = 'beige')
        raiz.title('Aplicación')
        ttk.Button(raiz, text='Salir', 
                   command=raiz.destroy).pack(side=BOTTOM)
        raiz.mainloop()

# Define la función main() que es en realidad la que indica 
# el comienzo del programa. Dentro de ella se crea el objeto 
# aplicación 'mi_app' basado en la clase 'Aplicación':

def main():
    mi_app = Aplicacion()
    return 0

# Mediante el atributo __name__ tenemos acceso al nombre de un
# un módulo. Python utiliza este atributo cuando se ejecuta
# un programa para conocer si el módulo es ejecutado de forma
# independiente (en ese caso __name__ = '__main__') o es 
# importado:

if __name__ == '__main__':
    main()


# In[13]:


from tkinter import *
from tkinter import ttk

# La clase 'Aplicacion' ha crecido. En el ejemplo se incluyen
# nuevos widgets en el método constructor __init__(): Uno de
# ellos es el botón 'Info'  que cuando sea presionado llamará 
# al método 'verinfo' para mostrar información en el otro 
# widget, una caja de texto: un evento ejecuta una acción: 

class Aplicacion():
    def __init__(self):
        
        # En el ejemplo se utiliza el prefijo 'self' para
        # declarar algunas variables asociadas al objeto 
        # ('mi_app')  de la clase 'Aplicacion'. Su uso es 
        # imprescindible para que se pueda acceder a sus
        # valores desde otros métodos:
        
        self.raiz = Tk()
        self.raiz.geometry('300x200')
        
        # Impide que los bordes puedan desplazarse para
        # ampliar o reducir el tamaño de la ventana 'self.raiz':
        
        self.raiz.resizable(width=False,height=False)
        self.raiz.title('Ver info')
        
        # Define el widget Text 'self.tinfo ' en el que se
        # pueden introducir varias líneas de texto:
        
        self.tinfo = Text(self.raiz, width=40, height=10)
        
        # Sitúa la caja de texto 'self.tinfo' en la parte
        # superior de la ventana 'self.raiz':
        
        self.tinfo.pack(side=TOP)
        
        # Define el widget Button 'self.binfo' que llamará 
        # al metodo 'self.verinfo' cuando sea presionado
        
        self.binfo = ttk.Button(self.raiz, text='Info', 
                                command=self.verinfo)
        
        # Coloca el botón 'self.binfo' debajo y a la izquierda
        # del widget anterior
                                
        self.binfo.pack(side=LEFT)
        
        # Define el botón 'self.bsalir'. En este caso
        # cuando sea presionado, el método destruirá o
        # terminará la aplicación-ventana 'self.raíz' con 
        # 'self.raiz.destroy'
        
        self.bsalir = ttk.Button(self.raiz, text='Salir', 
                                 command=self.raiz.destroy)
                                 
        # Coloca el botón 'self.bsalir' a la derecha del 
        # objeto anterior.
                                 
        self.bsalir.pack(side=RIGHT)
        
        # El foco de la aplicación se sitúa en el botón
        # 'self.binfo' resaltando su borde. Si se presiona
        # la barra espaciadora el botón que tiene el foco
        # será pulsado. El foco puede cambiar de un widget
        # a otro con la tecla tabulador [tab]
        
        self.binfo.focus_set()
        self.raiz.mainloop()
    
    def verinfo(self):
        
        # Borra el contenido que tenga en un momento dado
        # la caja de texto
        
        self.tinfo.delete("1.0", END)
        
        # Obtiene información de la ventana 'self.raiz':
        
        info1 = self.raiz.winfo_class()
        info2 = self.raiz.winfo_geometry()
        info3 = str(self.raiz.winfo_width())
        info4 = str(self.raiz.winfo_height())
        info5 = str(self.raiz.winfo_rootx())
        info6 = str(self.raiz.winfo_rooty())
        info7 = str(self.raiz.winfo_id())
        info8 = self.raiz.winfo_name()
        info9 = self.raiz.winfo_manager()
        
        # Construye una cadena de texto con toda la
        # información obtenida:
        
        texto_info = "Clase de 'raiz': " + info1 + "\n"
        texto_info += "Resolución y posición: " + info2 + "\n"
        texto_info += "Anchura ventana: " + info3 + "\n"
        texto_info += "Altura ventana: " + info4 + "\n"
        texto_info += "Pos. Ventana X: " + info5 + "\n"
        texto_info += "Pos. Ventana Y: " + info6 + "\n"
        texto_info += "Id. de 'raiz': " + info7 + "\n"
        texto_info += "Nombre objeto: " + info8 + "\n" 
        texto_info += "Gestor ventanas: " + info9 + "\n"
        
        # Inserta la información en la caja de texto:
        
        self.tinfo.insert("1.0", texto_info)

def main():
    mi_app = Aplicacion()
    return 0

if __name__ == '__main__':
    main()


# In[14]:


try:
    # Python 2.x
    from Tkinter import *
    from ttk import *
    from tkMessageBox import *
except ImportError:
    # Python 3.x
    from tkinter import *
    from tkinter.ttk import *
    from tkinter.messagebox import *

# Ver http://www.python-course.eu/tkinter_dialogs.php

dolar = 5080

def cotizar(*args):
    try:
        guaranies.set(int(dolares.get())*dolar)
    except ValueError:
        showerror(title='Error', message='Sólo números arábigos, por favor.')
        dolares.set('')

ventana = Tk()
ventana.title("Dólares a Guaraníes")

marco = Frame(ventana, padding="10 10 10 10")
marco.grid(column=0, row=0, sticky=(N, W, E, S))

dolares = StringVar()
guaranies = StringVar()

entrada = Entry(marco, width=7, textvariable=dolares)
entrada.grid(column=2, row=1, sticky=(W, E))

Label(marco, textvariable=guaranies).grid(column=2, row=2, sticky=(W, E))
Button(marco, text="Cotizar", command=cotizar).grid(column=3, row=3, sticky=W)

Label(marco, text="dólares").grid(column=3, row=1, sticky=W)
Label(marco, text="equivale a").grid(column=1, row=2, sticky=E)
Label(marco, text="guaraníes").grid(column=3, row=2, sticky=W)

#              1                  2                   3
#   -------------------------------------------------------------
# 1 |                   |     [entrada]     | dólares           |
#   -------------------------------------------------------------
# 2 |        equivale a |    {guaranies}    | guaraníes         |
#   -------------------------------------------------------------
# 3 |                   |                   | < Cotizar >       |
#   -------------------------------------------------------------

for hijo in marco.winfo_children(): hijo.grid_configure(padx=5, pady=5)

entrada.focus()

ventana.bind('<Return>', cotizar)
ventana.bind('<Escape>', lambda x: ventana.destroy())

ventana.mainloop()


# In[15]:


#!/usr/bin/env python
# -*- coding: utf-8 -*-

try:
    # Python 2.x
    from Tkinter import *
    from ttk import *
except ImportError:
    # Python 3.x
    from tkinter import *
    from tkinter.ttk import *

import random

premio = random.randint(1, 3)

def apostar(numero):
    if numero == premio:
        etiqueta.configure(text='¡Ganaste!')
    else:
        etiqueta.configure(text='Lo siento, perdiste.')

ventana = Tk()

ventana.title('Premio')

etiqueta = Label(ventana, text='¿Qué botón es el del premio?')
etiqueta.pack()

for boton in range(1, 4):
    Button(text='Botón ' + str(boton), command=lambda x=boton: apostar(x)).pack(side=LEFT)
    # Si pusiéramos 'command=apostar(boton)' se ejecutaría la función.

ventana.mainloop()


# In[37]:


import sys
from tkinter import *
 
def hacer_click():
 try:
  _valor = int(entrada_texto.get())
  _valor = _valor * 5
  etiqueta.config(text=_valor)
 except ValueError:
  etiqueta.config(text="Introduce un numero!")
 
 
app = Tk()
app.title("Mi segunda App Grafica")
 
#Ventana Principal
vp = Frame(app)
vp.grid(column=0, row=0, padx=(50,50), pady=(10,10))
vp.columnconfigure(0, weight=1)
vp.rowconfigure(0, weight=1)
 
    #etiqueta
etiqueta = Label(vp, text="Valor")
etiqueta.grid(column=2, row=2, sticky=(W,E))
 
    #Boton
boton = Button(vp, text="OK!", command=hacer_click)
boton.grid(column=1, row=1)
 
    #Entrada de texto
valor = ""
entrada_texto = Entry(vp, width=10, textvariable=valor)
entrada_texto.grid(column=2, row=1)
 
app.mainloop()


# In[27]:


root = Tk()
 
root.title("PARÁMETROS MORFOMÉTRICOS DE LA CUENCA")
 
root.geometry("450x360")
 
NC_label = Label(root, text = "Número de curva:")
 
NC_label.grid(row = 1, column = 1)
 
NC_Int = IntVar()
 
NC_entry = Entry(root, textvariable = NC_Int)
 
NC_entry.grid(row = 1, column = 2)

etiqueta = Label(root, text="Valor").place(x=10, y=80)
numcur=NC_Int.get()
 
ok = Button(root, text = "OK",  command = root.destroy)
 
ok.grid(row = 2, column = 2)
 
def mostrar():
    numcur= NC_Int.get()
    etiqueta.config(text=numcur)
    print(numcur)
 
ok.config(command=mostrar)
 
root.mainloop()

