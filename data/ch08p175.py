import pandas as pd
import seaborn as sns

tips = sns.load_dataset('tips')
# print(type(tips['sex']))
# tips['sex_str'] = tips['sex'].astype(str)
# print(type('sex_str'))
# print(tips.dtypes)

# tips['total_bill'] = tips['total_bill'].astype(str)
# print(tips.dtypes)
# tips['total_bill'] = tips['total_bill'].astype(float)
# print(tips.dtypes)

tips_sub_miss = tips.head(10)
# tips_sub_miss.loc[[1,3,5,7], 'total_bill'] = 'missing'
# # print(tips_sub_miss.dtypes)
# tips_sub_miss['total_bill'] = pd.to_numeric(tips_sub_miss['total_bill'], errors='coerce')
# print(tips_sub_miss.dtypes)
# print(tips_sub_miss.head(10))

# tips_sub_miss['total_bill'] = pd.to_numeric(tips_sub_miss['total_bill'], errors='coerce', downcast='float')
# print(tips_sub_miss.dtypes)

tips['sex'] = tips['sex'].astype('category')
print(tips.info())