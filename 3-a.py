import numpy as np 
import time
from numpy.random import rand, randint

#행, 열의 크기
N = 150

#행렬을 초기화합니다.
matA = np.array(rand(N, N))
matB = np.array(rand(N, N))
matC = np.array([[0] * N for _ in range(N)])

#파이썬의 리스트를 사용하여 계산
#시작 시간을 저장
start = time.time()

#for문을 사용하여 행렬 곱셈을 실행합니다.
for i in range(N):
    for j in range(N):
        for k in range(N):
            matC[i][j] = matA[i][k] * matB[k][j]

print("파이썬 기능만으로 계산한 결과: %.2f[sec]"%float(time.time()- start))

#NumPy를 이용해 계산
#시작 시간 저장
start = time.time()

#NumPy를 이용해 행렬 곱셈
matC = np.dot(matA, matB)

#소수점 이하 두 자리까지 표시되므로 NumPy는 0.00[sec]으로 표시됩니다.
print("NumPy를 사용하여 계산한 결과:%.2f[sec]"%float(time.time()-start))