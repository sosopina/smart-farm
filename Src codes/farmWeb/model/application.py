import pickle
import sys
import numpy as np

import warnings
warnings.filterwarnings("ignore")
# load the model from disk
loaded_model = pickle.load(open('/var/www/html/projet_sf/farmWeb/model/model.pkl', 'rb'))

x=sys.argv[1]
y=sys.argv[2]
z=sys.argv[3]
t=sys.argv[4]
input_data =[x,y,z,t]

# change the input data to a numpy array
input_data_as_numpy_array= np.asarray(input_data)
# reshape the numpy array as we are predicting for only on instance
input_data_reshaped = input_data_as_numpy_array.reshape(1,-1)
prediction = loaded_model.predict(input_data_reshaped)
print(prediction)
