#!/usr/bin/env python
# coding: utf-8

# In[1]:


import numpy as np
import matplotlib.pyplot as plt


# # Función Sigmoidal
# $$
# f(x) = \frac{1}{1 + e^{-x}}
# $$

# In[10]:


def sigmoidal(x):
    return 1/(1 + np.e ** (-x))


# In[3]:


x = np.linspace(-4,4,100)
x


# plt.plot(x, sigmoidal(x))

# # Función RELU
# $$
# f(x) = max(0, x)
# $$

# In[5]:


def relu(x):
    return np.maximum(0, x)


# In[6]:


plt.plot(x, relu(x))


# # Función Tangente Hiperbólica
# $$
# f(x) = \frac{2}{1 + e ^ {-2x}}
# $$

# In[8]:


def tangente(x):
    return 2 / (1 + np.e ** (-2 * x))


# In[9]:


plt.plot(x, tangente(x))

