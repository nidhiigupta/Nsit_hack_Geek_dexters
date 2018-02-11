import numpy as np
import seaborn as sns
import pandas as pd
import matplotlib.pyplot as plt
#sns.set(style="white")

df=pd.read_csv('new_data.csv')
df2=df[['Month','Number_of_patients']]
df3= df2.groupby('Month', as_index=False, sort=False).agg({'Number_of_patients' : 'sum'})
g = sns.factorplot(x='Month', data=df3, y='Number_of_patients', size=6, aspect=1.5)
g.set_xticklabels(step=2)
g.savefig("only_month.png")
plt.show()
