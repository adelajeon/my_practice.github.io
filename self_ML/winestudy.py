import pandas as pd
from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.model_selection import KFold
from sklearn.model_selection import cross_val_score
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns


### ------------------- 데이터 준비 ----------------------
columns=  ['Class', 'Alcohol','Malic acid','Ash', 'Alcalinity of ash  ', 'Magnesium', 'Total phenols', 'Flavanoids','Nonflavanoid phenols','Proanthocyanins','Color intensity','Hue', 'OD280/OD315 of diluted wines','Proline']
wine= pd.read_csv('wine.data.csv', names=columns, header=None)
# wine_d.to_csv('wine2.csv')
# print(wine)

wine.columns = wine.columns.str.replace(' ', '_')
# print(wine.head())

### ------------------- 데이터 탐색 ----------------------
# wine.info()
# print(wine.describe())
# print(wine.Class.value_counts())
# print(wine.groupby('Class').agg(['mean', 'std']).unstack('Class'))

### ------------------- 데이터 모델링/학습 ----------------------
wine_data = wine.iloc[:,1:]
wine_label = wine.iloc[:,0]
# print("wine data 값:", wine_data.iloc[3])
# print("wine target 명:", wine_label.name)

X_train, X_test, y_train, y_test = train_test_split(wine_data, wine_label, test_size=0.3, random_state=11)

# #DecisionTreeClassifier, 의사결정나무 객체 생성
dt_clf = DecisionTreeClassifier(random_state=11)
# #학습
dt_clf.fit(X_train, y_train)
# #학습이 완료된 DecisionTreeClassifier 객체에서 테스트 데이터 세트로 예측 수행
pred = dt_clf.predict(X_test)
# print('예측 정확도: {0:.4f}'.format(accuracy_score(y_test,pred)))

### ------------------- 데이터 모델링/검증 ----------------------
## 검증을 위한 데이터 세트 크기 확인
# print('와인 데이터 세트 크기:', wine_data.shape[0])

## 178개라 K-Fold cross validation 6번에 나눠서 진행
kfold = KFold(6, shuffle=True)
#함수를 썼을 때는 이렇게 진행, 다 풀어서 할때는 56행~71행
results = cross_val_score(dt_clf, wine_data, wine_label, cv=kfold)
# print(results)
print('\n###평균 검증 정확도:', results.mean())


## K-Fold 교차 검증을 하나하나씩 다 풀어서 코드 적어봄
# n =0 
# cv_acc = []
# for train_index, test_index in kfold.split(wine_data):
#     #kfold.split()으로 반환된 인덱스를 이용해 학습용, 검증용 테스트 데이터 추출
#     X_train, X_test = wine_data.iloc[train_index], wine_data.iloc[test_index, :]
#     y_train, y_test = wine_label[train_index], wine_label[test_index]
#     #학습
#     dt_clf.fit(X_train, y_train)
#     pred  = dt_clf.predict(X_test)
#     n +=1
#     #반복할때마다 정확도 측정
#     acc = accuracy_score(y_test,pred)
#     print('\n#{}교차 검증 정확도{:.4f}'.format(n, acc))
#     cv_acc.append(acc)

# print('\n###평균 검증 정확도:', np.mean(cv_acc))

### ------------------- 데이터 모델링/예측 ----------------------

# #가상의 값 2개로 예측해보기
data =  {'Alcohol':[12.23,13.1],'Malic_acid':[2.1,1.35],'Ash':[2.3,2.45], 'Alcalinity_of_ash__':[13,20], 'Magnesium':[102,125], 'Total_phenols':[3.1,2.45], 'Flavanoids':[3.14,3.15],'Nonflavanoid_phenols':[0.3,0.22],'Proanthocyanins':[1.57,1.36],'Color_intensity':[5.5,6],'Hue':[1.11,1.03], 'OD280/OD315_of_diluted_wines':[2.9,3.2],'Proline':[1065,770]}
sample = pd.DataFrame(data)
# # print(sample)

# #샘플의 예측
sample_predict = dt_clf.predict(sample)
print("샘플데이터로 예측", sample_predict)

### ------------------- 데이터 모델링/상관분석 ----------------------

# #상관분석
wine_corr = wine.corr()
# print(wine_corr.loc[wine_corr['Class']>0, 'Class'])

### ------------------- 시각화 ----------------------

##상관계수가 가장 높은 2개의 변수로 산점도 그래프그려보기 (회귀선포함)
scatter = sns.lmplot(x='Alcalinity_of_ash__', y='Nonflavanoid_phenols', data=wine, hue='Class', fit_reg=True)
# plt.show()

## 2개의 변수로 catplot 그래프도 그려보기
sns.catplot(x='Alcalinity_of_ash__', y='Nonflavanoid_phenols', data=wine, hue='Class', kind='point')
# plt.show()

# #상관 분석 시각화
# sns.pairplot(wine, hue='Class')
plt.show()


