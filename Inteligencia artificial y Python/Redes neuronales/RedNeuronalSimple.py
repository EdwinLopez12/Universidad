#!/usr/bin/env python
# coding: utf-8

# In[2]:


from numpy import exp, array, random, dot


# In[3]:


class RedNeuronal():
    def __init__(self):
        self.pesos_signaticos = 2 * random.random((3,1)) - 1
    
    def __sigmoide(self, x):
        return 1 / (1 + exp(-x))
    
    def __sigmoide_derivado(self, x):
        return x * (1 - x)
    
    def entrenamiento(self,entradas,salidas,numero_iteraciones):
        for i in range(numero_iteraciones):
            salida = self.pensar(entradas)
            error = salidas - salida
            ajuste = dot(entradas.T, error * self.__sigmoide_derivado(salida))
            self.pesos_signaticos += ajuste
            
    def pensar(self,entrada):
        return self.__sigmoide(dot(entrada, self.pesos_signaticos))

if __name__ == '__main__':
    red_neuronal = RedNeuronal()
    entradas = array([[0,0,1], [1,1,1], [1,0,1], [0,1,1]])
    salidas = array([[0,1,1,0]]).T
    red_neuronal.entrenamiento(entradas,salidas,1000)
    print(red_neuronal.pesos_signaticos)
    print(red_neuronal.pensar(array([1,0,0])))
    
        

