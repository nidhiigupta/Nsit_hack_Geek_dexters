import numpy as np
import seaborn as sns
import matplotlib.pyplot as plt
import pandas as pd
sns.set(style="darkgrid")
d={'color' :['pink','skyblue']}
df=pd.read_csv("new_data.csv")
g = sns.FacetGrid(df, row="Alcoholism", col="Area", margin_titles=True,hue_kws=d, hue='Alcoholism',aspect=0.6)
binn=np.linspace(0,50,12)
g.map(plt.hist, "Number_of_patients", bins=binn, lw=1, ec="Black")
plt.show()
