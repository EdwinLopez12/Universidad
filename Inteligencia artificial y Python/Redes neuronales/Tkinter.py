#!/usr/bin/env python
# coding: utf-8

# In[1]:


from tkinter import *


# In[2]:


ventana = Tk()
ventana.title("Hola Mundo")
ventana.mainloop()


# In[3]:


def esconder():
    ventana.iconify()


# In[4]:


ventana = Tk()
ventana.title("Hola Mundo")
boton = Button(ventana,text="Ocultar",command=esconder).pack()
ventana.mainloop()


# In[5]:


def imprimir():
    print("Hola Mundo")


# In[6]:


ventana = Tk()
ventana.title("Hola Mundo")
boton1 = Button(ventana,text="Saludar",fg="green",command=imprimir).pack(side=LEFT)
boton2 = Button(ventana,text="Cerrar",fg="red",command=ventana.destroy).pack(side=RIGHT)
ventana.mainloop()


# In[7]:


ventana = Tk()
ventana.title("Hola Mundo")
boton1 = Button(ventana,text="Saludar",fg="green",command=imprimir).grid(row=0,column=1)
boton2 = Button(ventana,text="Cerrar",fg="red",command=ventana.destroy).grid(row=0,column=0)
ventana.mainloop()


# In[8]:


ventana = Tk()
ventana.title("Hola Mundo")
ventana.geometry("500x500")
boton1 = Button(ventana,text="Saludar",fg="green",command=imprimir).place(x=10,y=10)
boton2 = Button(ventana,text="Cerrar",fg="red",command=ventana.destroy).place(x=80,y=10)
ventana.mainloop()


# In[9]:


def saludo():
    print("Hola "+nombre.get())
    nombre.set("")


# In[10]:


ventana = Tk()
ventana.title("Hola Mundo")
ventana.geometry("500x500")
nombre = StringVar()
etiqueta = Label(ventana,text="Ingrese Nombre: ").place(x=10,y=10)
nombreEntrada = Entry(ventana,textvariable=nombre).place(x=110,y=10)
boton = Button(ventana,text="Saludar",command=saludo).place(x=240,y=30)
ventana.mainloop()


# In[16]:


ventana = Tk()
ventana.title("Hola Mundo")
ventana.geometry("500x500")
opcion = IntVar()
seleccion = Entry(ventana,textvariable=opcion).place(x=10,y=10)
rb1 = Radiobutton(ventana,text="Suma",value=1,variable=opcion).place(x=10,y=30)
rb2 = Radiobutton(ventana,text="Resta",value=2,variable=opcion).place(x=50,y=30)
rb3 = Radiobutton(ventana,text="Multiplicación",value=3,variable=opcion).place(x=100,y=30)
rb4 = Radiobutton(ventana,text="División",value=4,variable=opcion).place(x=150,y=30)
ventana.mainloop()


# In[12]:


def obtener():
    #print("Seleccionaste: "+variable.get())
    #messagebox.showinfo("Mensaje", "Seleccionaste: "+variable.get())
    opcion = messagebox.askquestion("Mensaje", "Estas seguro de eliminar")
    print(opcion)


# In[13]:


from tkinter import messagebox
ventana = Tk()
ventana.title("Hola Mundo")
ventana.geometry("500x500")
variable = StringVar()
opciones = Spinbox(ventana,values=("Uno","Dos","Tres"),textvariable=variable).place(x=10,y=10)
boton = Button(ventana,text="Obtener",command=obtener).place(x=150,y=10)
ventana.mainloop()


# In[14]:


ventana = Tk()
ventana.title("Hola Mundo")
ventana.geometry("500x500")
imagen = PhotoImage(file="logo.png")
fondo = Label(ventana,image=imagen).place(x=0,y=0)
ventana.mainloop()


# In[ ]:


from tkinter import ttk
ventana = Tk()
ventana.title("Hola Mundo")
ventana.geometry("500x500")
notebook = ttk.Notebook(ventana)
notebook.pack(fill='both',expand='yes')
pest0 = ttk.Frame(notebook)
pest1 = ttk.Frame(notebook)
pest2 = ttk.Frame(notebook)
notebook.add(pest0,text="Archivo")
notebook.add(pest1,text="Edición")
notebook.add(pest2,text="Ayuda")
texto1 = Label(pest0,text="Pestaña 0").pack()
texto2 = Label(pest1,text="Pestaña 1").pack()
texto3 = Label(pest2,text="Pestaña 2").pack()
ventana.mainloop()


# In[ ]:


from tkinter import ttk
ventana = Tk()
ventana.title("Hola Mundo")
ventana.geometry("500x500")
combo = ttk.Combobox(ventana)
combo.place(x=10,y=10)
combo['values'] = ('UNO','DOS','TRES')
combo.current(1)
ventana.mainloop()

