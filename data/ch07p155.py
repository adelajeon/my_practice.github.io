import pandas as pd
# pew =pd.read_csv(r'C:\Users\MIT05\Desktop\git\data\pew.csv')
# # print(pew.head())
# # print(pew.columns)

# # print(pew.iloc[:, 0:6])
# pew_long = pd.melt(pew, id_vars='religion', var_name='income', value_name='count')
# print(pew_long)

# billboard = pd.read_csv(r"C:\Users\MIT05\Desktop\git\data\billboard.csv")
# print(billboard.iloc[0:5, 0:16])
# billboard_long = pd.melt(billboard, id_vars=['year', 'artist', 'track', 'time', 'date.entered'], var_name='week', value_name='rating')
# print(billboard_long.head())

ebola=pd.read_csv(r"C:\Users\MIT05\Desktop\git\data\country_timeseries.csv")
# print(ebola.columns)
ebola_long = pd.melt(ebola, id_vars=['Date', 'Day'])
# print(ebola_long.head())
variable_split = ebola_long.variable.str.split('_')
# # print(type(variable_split))
# # print(type(variable_split[0]), variable_split[0])
# status_values = variable_split.str.get(0)
# country_values = variable_split.str.get(1)
# # print("status_values[:5] 그리고 [-5:]\n", status_values[:5])
# # print(status_values[-5:])
# # print("country_values[:5] 그리고 [-5:]\n", country_values[:5])
# # print(country_values[-5:])

# ebola_long['status'] = status_values
# ebola_long['country'] = country_values
# print(ebola_long.head())

# variable_split = ebola_long.variable.str.split('_', expand=True)
print(variable_split)