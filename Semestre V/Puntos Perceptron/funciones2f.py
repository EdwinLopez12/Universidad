#!/usr/bin/env python
# coding: utf-8

# In[33]:


# Importacion de librerias
import tensorflow as tf 
import numpy as np 
import math
import matplotlib.pyplot as plt 
from scipy.stats import norm
# si usa una computadora portátil Jupyter, incluya:
get_ipython().run_line_magic('matplotlib', 'inline')

x = [-1, 0, 0, 1]
y = [0, 0, 1, 1]

with tf.Session() as sess: 
    plt.plot(x,y, linestyle="solid", marker="", color="green")  
    plt.title("Funcion Escalonal")  
    plt.xlabel("Eje X")  
    plt.ylabel("Eje Y")  
    plt.show()


# In[45]:


def ReLU(x):
    return np.maximum(0.0, x)
# derivacion funcion relu
def ReLU_derivation(x):
    if x <= 0:
        return 0
    else:
        return 1
X = np.linspace(-5, 5, 100)
plt.plot(X, ReLU(X),'b')
plt.xlabel('Eje X')
plt.ylabel('Eje Y')
plt.title('Funcion Lineal y Mixta')
plt.grid()
plt.grid()
plt.show()


# In[48]:


# crea un vector de tamaño 15 con valores de -5 a 5
a = np.linspace(-5, 5, 15) 
  
# Aplicando la función sigmoidea y
# almacenando el resultado en 'b'
b = tf.nn.sigmoid(a, name ='sigmoid') 
  
# Iniciar una sesión de Tensorflow
with tf.Session() as sess: 
    plt.plot(a, sess.run(b), color = 'red', marker = "")  
    plt.title("Funcion Sigmoide")  
    plt.xlabel("Eje X")  
    plt.ylabel("Eje Y")  
  
    plt.show() 


# In[50]:


#Creo Un vector de tamaño 15 con valores de -5 a 5
a = np.linspace(-5, 5, 20) 
  
# Aplicando la función tanh y
# almacenando el resultado en 'b'
b = tf.nn.tanh(a, name ='tanh') 
  
# Iniciar una sesión de Tensorflow 
with tf.Session() as sess:
    plt.plot(a, sess.run(b), color = 'red', marker = "")  
    plt.title("Funcion Tangente Hiperbolica")  
    plt.xlabel("Eje X")  
    plt.ylabel("Eje Y")  
  
    plt.show() 


# In[56]:


# Definicion de constante 
mu = 998.8 
sigma = 73.10
x1 = 900
x2 = 1100

# calcular la transformación z
z1 = ( x1 - mu ) / sigma
z2 = ( x2 - mu ) / sigma

x = np.arange(z1, z2, 0.001) # rango de x en espec.
x_all = np.arange(-10, 10, 0.001) # rango completo de x, tanto dentro como fuera de especificaciones
# mean = 0, stdev = 1, ya que se calculó la transformación Z
y = norm.pdf(x,0,1)
y2 = norm.pdf(x_all,0,1)

# construir la trama
fig, ax = plt.subplots(figsize=(9,6))
ax.plot(x_all,y2)
ax.set_xlim([-4,4])
ax.set_xlabel('Eje x')
ax.set_ylabel('Eje y')
ax.set_title('Funcion Gauus')
plt.show()


# In[ ]:





# In[ ]:




