import numpy as np
import seaborn as sns
import matplotlib.pyplot as plt
import pandas as pd
sns.set(style="darkgrid")

d={'color':['pink','skyblue']}
df=pd.read_csv("new_data.csv")
g = sns.FacetGrid(df, row="Diabetes", col="Groups", margin_titles=True,hue_kws=d, hue='Diabetes',sharex= True, sharey=True,size=2, aspect=0.9)
binn=np.linspace(0,40,12)
g.map(plt.hist, "Number_of_patients", bins=binn, lw=1, ec="Black")
plt.show()
