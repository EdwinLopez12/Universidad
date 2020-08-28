#!/usr/bin/env python
# coding: utf-8

# In[21]:


import numpy as np
import matplotlib.pyplot as plt
get_ipython().run_line_magic('matplotlib', 'inline')


# # Regresión Lineal
# $$
# y = mx + b
# $$
# 
# $$
# m = \frac{\sum{x} \sum{y} - n\sum(xy)}
# {(\sum{x})^2 - n\sum{x^2}}
# $$
# 
# $$
# b = \overline{y} - m\overline{x}
# $$

# In[22]:


x = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
y = [1,2,2,4,5,4,6,4,6,7,9,10,11,12,10]


# In[23]:


x = np.array(x)
y = np.array(y)


# In[24]:


n = len(x)
sum_x = sum(x)
sum_y = sum(y)
sum_xy = sum(x * y)
sum_x2 = sum(x * x)
sum_y2 = sum(y * y)
prom_x = sum_x / n
prom_y = sum_y / n


# In[25]:


m = (sum_x * sum_y - n * sum_xy) / (sum_x ** 2 - n * sum_x2)
m


# In[26]:


b = prom_y - m * prom_x
b


# In[27]:


plt.plot(x, y, 'o', label='Datos')
plt.plot(x, m * x + b, label='Ajuste')
plt.xlabel('X')
plt.ylabel('Y')
plt.title('Regresión Lineal')
plt.grid()
plt.legend(loc=4)
plt.show()


# In[28]:


sigma_x = np.sqrt(sum_x2 / n - prom_x ** 2)
sigma_y = np.sqrt(sum_y2 / n - prom_y ** 2)
sigma_xy = sum_xy / n - prom_x * prom_y
R = sigma_xy / (sigma_x * sigma_y)
R_2 = R ** 2
R_2

