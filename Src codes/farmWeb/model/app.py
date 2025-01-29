import numpy as np
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score
import pickle

# load the data from csv file to Pandas DataFrame
dataset= pd.read_csv('D.csv')

target = []
n = dataset.shape[0]
for i in range(n):
  if dataset['meantemp'][i] > 40 or dataset['humidity'][i]  > 80 or dataset['wind_speed'][i]  > 20 or dataset['meanpressure'][i]  > 1100 :
    target.append(1)
  else :
    target.append(0)

dataset['target'] = target
X=dataset.drop(columns=['date','target'],axis=1)
Y=dataset['target']
X_train, X_test, Y_train, Y_test = train_test_split(X, Y, test_size=0.2, stratify=Y, random_state=2)
model = LogisticRegression()
# training the LogisticRegression model with Training data
model.fit(X_train, Y_train)
# training the LogisticRegression model with Training data
model.fit(X_train, Y_train)
# accuracy on training data
X_train_prediction = model.predict(X_train)
training_data_accuracy = accuracy_score(X_train_prediction, Y_train)
# accuracy on test data
X_test_prediction = model.predict(X_test)
test_data_accuracy = accuracy_score(X_test_prediction, Y_test)
pickle.dump(model, open('/var/www/html/projet_sf/farmWeb/model/model.pkl', 'wb'))
