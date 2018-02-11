import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
import seaborn as sns
from sklearn import linear_model
from sklearn.metrics import mean_squared_error, r2_score
from sklearn.model_selection import train_test_split

df = pd.read_csv('new_data.csv')
df.dropna(axis=0, how='any', inplace=True)
df["int"]=pd.Series([], dtype=object)
df2=df[['Month','Age','Number_of_patients']]
df3= df2.groupby(['Month','Age'], as_index=False, sort=False).agg({'Number_of_patients' : 'sum'})
#binny=[0,10,20,30,40,50,60,70,80,90,100]
#names=['0-9','10-19','20-29','30-39','40-49','50-59','60-69','70-79','80-89','90-100']
#df['Age_groups']=pd.cut(df['Age'],bins=binny,right=False,labels=names)
#binny2=[0,10,20,30,40,50,60,70,80,90,100,110,121]
#names2=['0-9','10-19','20-29','30-39','40-49','50-59','60-69','70-79','80-89','90-99','100-109','110-120']
#df['Weight_groups']=pd.cut(df['Weight'],bins=binny2,right=False,labels=names2)

#X.groupby('Month').agg({'Number_of_patients' : 'sum'})
X = df3[['Month','Age']]
y = df3['Number_of_patients']

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.75, random_state=42)

regr = linear_model.LinearRegression()

regr.fit(X_train, y_train)

y_pred = regr.predict(X_test)

np.savetxt("pred.csv", y_pred, delimiter=",")

df3[['y_pred']]=pd.read_csv("pred.csv")

binny=[0,10,20,30,40,50,60,70,80,90,100]
names=['0-9','10-19','20-29','30-39','40-49','50-59','60-69','70-79','80-89','90-100']
df3['Age_groups']=pd.cut(df3['Age'],bins=binny,right=False,labels=names)
result = pd.pivot_table(df3, index='Month', columns='Age_groups', values='y_pred')
#plt.scatter(X_test['Month'], y_test,  color='black')
#plt.plot(X_test['Month'], y_pred, color='blue', linewidth=3)
f, ax = plt.subplots(figsize=(9, 6))
sns.heatmap(result,  annot=False, linewidths=.5, cmap="PuRd",ax=ax, yticklabels=['Jan','Feb','March','April','May','June','July','Aug','Sept','Oct','Nov','Dec'])


plt.show()

print('Variance score: %.2f' % r2_score(y_test, y_pred))
