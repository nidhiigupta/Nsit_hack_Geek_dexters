import matplotlib.pyplot as plt
import seaborn as sns
import pandas as pd
import numpy as np
from pylab import savefig
df = pd.read_csv('new_data.csv')
binny=[0,10,20,30,40,50,60,70,80,90,100]
names=['0-9','10-19','20-29','30-39','40-49','50-59','60-69','70-79','80-89','90-100']
df['Age_groups']=pd.cut(df['Age'],bins=binny,right=False,labels=names)
result = pd.pivot_table(df, index='Area', columns='Age_groups', values='Number_of_patients', aggfunc=np.sum)
f, ax = plt.subplots(figsize=(9, 6))
h=sns.heatmap(result,  annot=False, linewidths=.5, cmap="PuRd",ax=ax)
fi= h.get_figure()
fi.savefig("plot_area_age.png")
plt.show()
