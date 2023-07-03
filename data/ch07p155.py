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

ebola=pd.read_csv(r"C:\Study\git\adela\country_timeseries.csv")
# print(ebola.columns)
ebola_long = pd.melt(ebola, id_vars=['Date', 'Day'])
# print(ebola_long.head())
# variable_split = ebola_long.variable.str.split('_')
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
# variable_split.columns = ['status', 'country']
# ebola_parsed = pd.concat([ebola_long, variable_split], axis=1)
# print(ebola_parsed.head())

# weather = pd.read_csv(r"C:\Study\git\adela\weather.csv")
# # print(weather.iloc[:5, :])
# weather_melt = pd.melt(weather, id_vars=['id', 'year', 'month', 'element'], var_name='day', value_name='temp')
# # print(weather_melt.head())
# weather_tidy = weather_melt.pivot_table(
#     index = ['id', 'year', 'month', 'day'], columns='element', values='temp')
# # print(weather_tidy.head())
# # print(weather_tidy.tail())
# weather_tidy_flat = weather_tidy.reset_index()
# print(weather_tidy_flat.head())

# billboard = pd.read_csv(r'C:\Study\git\adela\billboard.csv')
# # print(billboard)
# billboard_long = pd.melt(billboard, id_vars=['year', 'artist', 'track', 'time', 'date.entered'], var_name='week', value_name='rating')
# # print(billboard_long.head())

# # print(billboard_long[billboard_long.track=='Loser'].head())
# billboard_songs=billboard_long[['year', 'artist', 'track', 'time']]
# # print(billboard_songs.shape)
# billboard_songs = billboard_songs.drop_duplicates()
# # print(billboard_songs.shape)
# billboard_songs['id'] = range(len(billboard_songs))
# # print(billboard_songs.head(10))
# billboard_ratings = billboard_long.merge(billboard_songs, on=['year', 'artist', 'track', 'time'])
# print(billboard_ratings.shape)
# print(billboard_ratings.head())

# billboard_ratings.to_csv('savetest.csv')

import os
import urllib.request

with open(r"C:\Study\git\adela\raw_data_urls.txt", 'r') as data_urls:
    for line, url in enumerate(data_urls):
        if line == 5:
            break
        fn = url.split('/')[-1].strip()
        fp = os.path.join('', "C:\Study\git\adela\data",fn)
        print(url)
        print(fp)
        urllib.request.urlretrieve(url, fp)
    
    