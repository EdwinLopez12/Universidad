#!/usr/bin/env python
# coding: utf-8

# In[1]:


from random import choice
from numpy import array, dot, random
import matplotlib.pyplot as plt


# In[2]:


#Funcion de Activación
activacion = lambda x:0 if x < 0 else 1


# In[3]:


#Set de Entrenamiento
entrenamiento = [
    (array([0,0,1]),0),
    (array([0,1,1]),1),
    (array([1,0,1]),1),
    (array([1,1,1]),1),
]

print(entrenamiento)


# In[4]:


w = random.rand(3)
errores = []
esperados = []
bahias = 0.2
n = 1000000


# In[5]:


#Entrenamiento
for i in range(n):
    x, esperado = choice(entrenamiento)
    resultado = dot(w, x)
    esperados.append(esperado)
    error = esperado - activacion(resultado)
    errores.append(error)
    #Ajuste
    w += bahias * error * x


# In[6]:


for x, _ in entrenamiento:
    resultado = dot(w, x)
    print("{}: {} -> {}".format(x[:3], resultado, activacion(resultado)))


# In[7]:


plt.plot(errores,'-',color='red')
plt.plot(esperados,'*', color='green')

