# Numpy
NumPy（Numerical Python）是 Python 的数值计算库，用于 高效地处理大规模数据。它的核心是 ndarray（N 维数组），支持向量化运算，比 Python 自带的 list 快得多。

## 1. 导入并查看版本
```python
# 导入numpy库
import numpy as np
# 查看numpy版本
np.__version__  # 输出结果 '1.26.4'
```

## 2. 创建数组
NumPy 的 ndarray 具有同质性（Homogeneous），数组中的所有元素必须是相同的数据类型（dtype）。如果传入的列表包含不同的数据类型，NumPy 会自动统一为同一种类型，优先级为：`字符串 > 浮点数 > 整数`。

### 2.1 普通方式
#### 2.1.1 np.array()
```python
arr = np.array([1, 2, 3, 4])
print(arr)  # 输出结果 [1 2 3 4]
```

### 2.2 快捷方式
NumPy 提供了一些快捷创建数组的方法（routines 函数），可以快速初始化特定形状的数组，比如全 1、全 0、特定值、单位矩阵等。
#### 2.2.1 np.ones(shape, dtype=None, order='C')
创建一个所有元素都是 1 的数组。
- `shape`：指定数组的形状，可以是整数或元组
    - shape = (m, n) `m 行 n 列` 二维数组
    - shape = (m, 1) `m 行 1 列` 二维数组 `[[1], [2], [3]]`
    - shape = (1, n) `1 行 m 列` 二维数组 `[[1, 2, 3]]`
- `dtype`：元素的数据类型（默认 `float64`）
- `order`：存储顺序（`C` 代表行优先，`F` 代表列优先）
```python
# 创建一个 3x3 的全 1 数组
arr = np.ones((3, 3))
print(arr)

# 输出结果：
[[1. 1. 1.]
 [1. 1. 1.]
 [1. 1. 1.]]
```

#### 2.2.2 np.zeros(shape, dtype=float, order='C')
创建一个所有元素都是 0 的数组。
```python
# 创建 2x4 的整数 0 数组
arr = np.zeros((2, 4), dtype=int)
print(arr)

# 输出结果：
[[0 0 0 0]
 [0 0 0 0]]
```

#### 2.2.3 np.full(shape, fill_value, dtype=None, order='C')
创建一个所有元素都是 `fill_value` 的数组。
```python
# 创建一个 3x3 的全 7 数组
arr = np.full((3, 3), 7)
print(arr)

# 输出结果：
[[7 7 7]
 [7 7 7]
 [7 7 7]]
```

#### 2.2.4 np.eye(N, M=None, k=0, dtype=float)
创建单位矩阵（对角线为 1，其他位置为 0）。
- `N`：行数
- `M`：列数（可选，默认等于 `N`）
- `k`：对角线偏移（0 是主对角线，+1 上移一行，-1 下移一行）
- `dtype`：数据类型（默认 `float`）
```python
# 3x3 单位矩阵
arr = np.eye(3)
print(arr)

# 输出结果：
[[1. 0. 0.]
 [0. 1. 0.]
 [0. 0. 1.]]

# 对角线向上偏移 1
arr = np.eye(4, k=1)  
print(arr)

# 输出结果：
[[0. 1. 0. 0.]
 [0. 0. 1. 0.]
 [0. 0. 0. 1.]
 [0. 0. 0. 0.]]
```

#### 2.2.5 np.linspace(start, stop, num=50, endpoint=True, retstep=False, dtype=None)
在指定范围 `[start, stop]` 内，生成 `num` 个等间距的数，做等差数列。
- `start`：起始值
- `stop`：终止值
- `num`：生成的元素个数（默认 50）
- `endpoint`：是否包含 `stop`（默认 `True`，包含）
- `retstep`：是否返回步长 step（默认 `False`）
- `dtype`：数据类型
```python
# 在 1 和 10 之间取 5 个数
arr = np.linspace(1, 10, 5)
print(arr)
# 输出结果：[ 1.    3.25  5.5   7.75 10.  ]
```

#### 2.2.6 np.arange(start, stop, step, dtype=None)
在 `[start, stop)` 区间内，以 `step` 为步长生成等间距的数（类似 `range()`）。
- `start`：起始值（默认 0）
- `stop`：终止值（不包含 `stop`）
- `step`：步长（默认 1）
- `dtype`：数据类型（可选）
```python
# 从 1 到 9（不含 10），步长为 2
arr = np.arange(1, 10, 2)
print(arr) # 输出结果：[1 3 5 7 9]
```

#### 2.2.7 np.random.randint(low, high=None, size=None, dtype=int)
生成 `size` 个 `low` 到 `high-1` 之间的随机整数。
- `low`：最小值（包含）
- `high`：最大值（不包含，默认 `None` 时，取 0 到 `low-1`）
- `size`：生成的数组形状（可选，默认 `None`，即返回一个数），和之前其他函数的 `shape` 差不多
- `dtype`：数据类型（默认 `int`）
```python
# 生成一个 1~9 之间的随机整数
rand_num = np.random.randint(1, 10)
print(rand_num) # 输出结果：7  （每次运行结果可能不同）

# 生成多个随机整数，并且是一个3x3 矩阵
arr = np.random.randint(1, 10, size=(3, 3))
print(arr)

# 输出结果（每次运行结果可能不同）
[[2 8 5]
 [3 7 1]
 [6 9 4]]
```

#### 2.2.8 np.random.randn(d0, d1, ..., dn)
生成符合 标准正态分布（均值 0，标准差 1）的随机数。
- `d0, d1, ..., dn`：生成的数组形状（可选）；如果不传参数，则返回一个单独的数；如果传多个参数，则生成对应形状的数组
```python
# 生成一个符合标准正态分布的随机数
num = np.random.randn()
print(num)  # 输出结果：-0.5123  （每次运行可能不同）

# 生成多个随机数，并且是一个 3x3 的矩阵
arr = np.random.randn(3, 3)
print(arr)
# 输出结果（每次运行可能不同）：
[[-0.89  1.23  0.34]
 [-0.56 -0.78  0.12]
 [ 1.45 -0.23  0.98]]
```

#### 2.2.9 np.random.normal(loc=0.0, scale=1.0, size=None)
普通正态分布，可以指定均值和标准差。
- `loc`：均值（默认 0.0）
- `scale`：标准差（默认 1.0）
- `size`：生成的形状（可以是整数或元组，如 `(3, 3)`）
```python
arr = np.random.normal(loc=5, scale=2, size=(3, 3))  # 均值 5，标准差 2
print(arr)
# 输出结果：
[[5.23  2.18  6.45]
 [3.56  5.98  7.12]
 [4.67  6.78  3.89]]
```

#### 2.2.10 np.random.random(size=None)
均匀分布，生成 0 到 1 之间的随机数，所有数的概率相同。
- `size`：生成的形状（可选，默认 `None`，即返回一个数）
```python
# 生成一个 [0,1) 之间的随机数
num = np.random.random()
print(num) # 输出结果：0.7382  （每次不同）

# 生成多个随机数，并且是一个 3x3 的随机数组
arr = np.random.random((3, 3))
print(arr)
# 输出结果（每次运行可能不同）：
[[0.12 0.98 0.45]
 [0.23 0.76 0.34]
 [0.87 0.65 0.89]]
```

## 3. 索引与切片
### 3.1 访问数组元素
在一个 numpy 数组中，你可以使用方括号 `[]` 来访问数组中的元素。如果数组是多维的，可以使用逗号分隔的索引来访问元素。
```python
# 一维数组
arr = np.array([1, 2, 3, 4, 5])
print(arr[2])  # 输出3

# 二维数组
arr2d = np.array([[1, 2, 3], [4, 5, 6], [7, 8, 9]])
print(arr2d[1, 2])  # 输出6
```
- 使用列表作为索引访问，可以进行数据重排。
    - ```python
        arr = np.array([1, 2, 3, 4, 5])
        arr[[0, 1, 2, 0, 1, 2]] # array([1, 2, 3, 1, 2, 3])
        ```
- 使用`bool列表`作为索引访问，`True`对应的值会被返回，可以用于判断（选择性输出）。
    - ```python
        arr = np.array([1, 2, 3, 4, 5])
        bool_list = [True, False, True, False, True]
        arr[bool_list] # 输出 array([1, 3, 5])
        ```
        ```python
            # eg. 获取数组中大于3的数
            arr[arr > 3] # array([4, 5])
        ```

### 3.2 切片
切片用于从数组中提取一个范围的元素。切片的语法是`start:stop:step`，其中`start`是切片开始的位置，`stop`是切片结束的位置（不包括此位置），`step`是步长。
<br>
不论是多少维，每个维度的切片范围都是用 `:` 表示，使用 `,` 分割。

#### 3.2.1 一维数组
```python
arr = np.array([1, 2, 3, 4, 5])
print(arr[1:4])  # 从第二个元素到第四个元素，输出[2 3 4]
print(arr[::2])  # 从第一个元素开始，每隔一个元素取一个，输出[1 3 5] -> [::2]：2表示步长，意味着在数组中每次跳过一个元素来选取下一个元素。
```

#### 3.2.2 二维数组
```python
arr2d = np.array([[1, 2, 3], [4, 5, 6], [7, 8, 9]])
#[[1, 2, 3],
# [4, 5, 6],
# [7, 8, 9]]
print(arr2d[0, :])  # 获取第一行，输出[1 2 3]
print(arr2d[:, 2])  # 获取第三列，输出[3 6 9]
print(arr2d[:2, :2])  # 在两个维度上都取索引从0到1的元素（不包括索引2）
# [[1 2]
#  [4 5]]
print(arr2d[1:3, 1:3]) # 在两个维度上都取索引从1到2的元素（不包括索引3）
# [[5, 6],
#  [8, 9]]
```
#### 3.2.3 反转
```python
arr = np.array([1, 2, 3, 4, 5])
arr[::-1] # array([5, 4, 3, 2, 1])
```

## 4. 数组常用操作
### 4.1 变形
变形是指改变数组的形状而不改变其数据。使用 `reshape()` 可以实现这一操作，你需要提供一个新的形状（shape），该形状的元素总数必须与原始数组相同。
```python
arr = np.arange(10)  # [0 1 2 3 4 5 6 7 8 9]

# 将一维数组变形为2x5的二维数组
reshaped_arr = arr.reshape(2, 5)
print(reshaped_arr)
# [[0 1 2 3 4]
#  [5 6 7 8 9]]
```
### 4.2 级联
级联是将两个或多个数组沿指定轴连接起来。使用 `numpy.concatenate()` 可以实现这一功能，但需要提供数组列表和级联的轴。
```python
arr1 = np.array([[1, 2], [3, 4]])
arr2 = np.array([[5, 6], [7, 8]])
```
沿着第一个轴（行）级联
```python
concatenated_arr1 = np.concatenate([arr1, arr2], axis=0)
print(concatenated_arr1)
# [[1 2]
#  [3 4]
#  [5 6]
#  [7 8]]
```
沿着第二个轴（列）级联
```python
concatenated_arr2 = np.concatenate([arr1, arr2], axis=1)
print(concatenated_arr2)
# [[1 2 5 6]
#  [3 4 7 8]]
```
除了 `concatenate` ，numpy 还提供了 `vstack（垂直堆叠）` 和 `hstack（水平堆叠）` 等便捷函数，这些函数可以更直观地处理常见的堆叠操作。
<br>
垂直堆叠
```python
vstack_arr = np.vstack([arr1, arr2])
print(vstack_arr)
# [[1 2]
#  [3 4]
#  [5 6]
#  [7 8]]
```
水平堆叠
```python
hstack_arr = np.hstack([arr1, arr2])
print(hstack_arr)
# [[1 2 5 6]
#  [3 4 7 8]]
```

### 4.3 切分
数组切分是指将一个数组分成多个小数组。numpy 提供了多种切分方法，如 `np.split`、`np.hsplit（水平切分）` 和 `np.vsplit（垂直切分）`。使用这些函数时，需要指定切分的方式和切分点。
<br>
通用的分割函数，可以在指定轴上分割数组。

```python
arr = np.arange(9)  # [0 1 2 3 4 5 6 7 8]
split_arr = np.split(arr, 3) # 平均切分数组
print(split_arr)  # 输出：[array([0, 1, 2]), array([3, 4, 5]), array([6, 7, 8])]
```
分别沿水平轴和垂直轴切分数组。
```python
arr2d = np.array([[1, 2, 3], [4, 5, 6], [7, 8, 9]])

hsplit_arr = np.hsplit(arr2d, 3) # 水平切分（沿着列切分）
print(hsplit_arr)  # 输出三个一列的数组
# [array([[1],
#         [4],
#         [7]]),
#  array([[2],
#         [5],
#         [8]]),
#  array([[3],
#         [6],
#         [9]])]

vsplit_arr = np.vsplit(arr2d, 3) # 垂直切分（沿着行切分）
print(vsplit_arr)  # 输出三个一行的数组
# [array([[1, 2, 3]]), array([[4, 5, 6]]), array([[7, 8, 9]])]
```

### 4.4 副本
在 numpy 中处理数组时，非常重要的一点是要区分视图（`view`）和副本（`copy`）。默认情况下，当对数组进行操作时，很多情况下生成的是视图，而不是副本。这意味着，修改这个“视图”数组会影响原始数组。
```python
arr = np.array([1, 2, 3, 4, 5])
sub_arr = arr[1:4]  # 切片操作创建视图
sub_arr[1] = 10  # 修改视图
print(arr)  # 原始数组也被修改了: [ 1  2 10  4  5]
```
使用 `copy()` 可以创建一个数组的深拷贝，修改这个副本不会影响原数组。
```python
arr = np.array([1, 2, 3, 4, 5])
arr_copy = arr.copy()  # 创建副本
arr_copy[1] = 10  # 修改副本
print(arr)  # 原始数组不变: [1 2 3 4 5]
print(arr_copy)  # 副本被修改: [ 1 10  3  4  5]
```

## 5. 运算
### 5.1 聚合运算
在 numpy 中，聚合运算是对数据进行汇总的一种有效方式，可以快速计算统计信息。
<br>

numpy 还提供了一些 `nan-safe` 版本的聚合函数，这些函数在处理包含 `NaN` 值的数据时会自动忽略这些值，只对其他有效数据进行计算。这对于处理不完整或损坏的数据非常有用。

| 函数            | NaN-safe 版          | 描述                                  |
|----------------|----------------------|----------------------------------------------|
| `np.sum`       | `np.nansum`          | 计算元素总和，NaN-safe 版本会忽略 NaN          |
| `np.prod`      | `np.nanprod`         | 计算元素乘积，NaN-safe 版本会忽略 NaN          |
| `np.mean`      | `np.nanmean`         | 计算元素平均值，NaN-safe 版本会忽略 NaN        |
| `np.std`       | `np.nanstd`          | 计算标准差，NaN-safe 版本会忽略 NaN            |
| `np.var`       | `np.nanvar`          | 计算方差，NaN-safe 版本会忽略 NaN              |
| `np.min`       | `np.nanmin`          | 找到最小值，NaN-safe 版本会忽略 NaN            |
| `np.max`       | `np.nanmax`          | 找到最大值，NaN-safe 版本会忽略 NaN            |
| `np.argmin`    | `np.nanargmin`       | 找到最小值的索引，NaN-safe 版本会忽略 NaN      |
| `np.argmax`    | `np.nanargmax`       | 找到最大值的索引，NaN-safe 版本会忽略 NaN      |
| `np.median`    | `np.nanmedian`       | 计算中位数，NaN-safe 版本会忽略 NaN            |
| `np.percentile`| `np.nanpercentile`   | 计算数据的百分位数，NaN-safe 版本会忽略 NaN    |
| `np.any`       | -                    | 检查数组中是否至少有一个元素为True            |
| `np.all`       | -                    | 检查数组中所有元素是否都为True                |
| `np.power`     | -                    | 对数组中的元素进行幂运算                      |

### 5.2 广播机制
广播允许 numpy 在执行算术运算时对不同形状的数组进行操作。这让你能够在不显式复制数据的情况下，将运算应用于数组的各个元素。
- 维度匹配：如果两个数组的维度数不相同，那么小维度数组的形状会在最左边补1。
- 形状兼容：在每个维度，数组的大小要么相同，要么其中一个是1。如果在任何维度上大小不匹配且没有维度是1，则会抛出异常。
- 扩展维度：当一个数组的某个维度为1而另一个数组的相应维度大小更大时，首先将较小的数组在这个维度上“扩展”，以匹配较大数组的形状。

示例 1：向量和矩阵
假设有一个 3x3 矩阵和一个长度为 3 的向量，现在想要对矩阵的每一行添加这个向量。
```python
# 创建一个3x3的矩阵
A = np.array([[1, 2, 3],
              [4, 5, 6],
              [7, 8, 9]])

# 创建一个长度为3的向量
v = np.array([1, 0, 1])

# 将向量添加到矩阵的每一行
B = A + v

print(B)

# [[ 2  2  4]
#  [ 5  5  7]
#  [ 8  8 10]]
```
示例 2：两个数组维度都扩展
<br>
假设有一个形状为 (3, 1) 的数组 A ，和一个形状为 (1, 3) 的数组 B 。数组 A 在第二维度（列）上扩展，数组 B 在第一维度（行）上扩展，结果就是一个 3x3 的矩阵。

```python
# 创建一个形状为3x1的数组
A = np.array([[1],
              [2],
              [3]])
# 创建一个形状为1x3的数组
B = np.array([1, 2, 3])

# 相加
C = A + B

print(C)

# [[2 3 4]
#  [3 4 5]
#  [4 5 6]]
```
- ```python
    # 扩展过程：
    # 1. 扩展 A ：使其从 (3, 1) 变成 (3, 3)，每一列的元素都复制原来的列
    [[1, 1, 1],
     [2, 2, 2],
     [3, 3, 3]]

    # 2. 扩展 B ：使其从 (1, 3) 变成 (3, 3)，每一行的元素都复制原来的行
    [[1, 2, 3],
     [1, 2, 3],
     [1, 2, 3]]

    # 3. 执行运算：两个数组都扩展为 (3, 3) 的形状后，对它们执行逐元素的加法
    [[1+1, 1+2, 1+3],
     [2+1, 2+2, 2+3],
     [3+1, 3+2, 3+3]]
    ```

## 6. 排序
### 6.1 快速排序
- `np.sort`：这个函数返回数组的排序副本，不修改原始数组。
- `ndarray.sort`：这是数组对象的方法，它会就地修改数组，不返回副本。

```python
# 创建一个随机数组
arr = np.random.randint(1, 100, size=10)
print("Original array:", arr) # Original array: [51 60  2 90 32 24 56 30 30 73]

# 使用 np.sort，不修改原始数组
sorted_arr = np.sort(arr)
print("Sorted with np.sort:", sorted_arr) # Sorted with np.sort: [ 2 24 30 30 32 51 56 60 73 90]

# 使用 ndarray.sort，修改原始数组
arr.sort()
print("Original array after ndarray.sort:", arr) # Original array after ndarray.sort: [ 2 24 30 30 32 51 56 60 73 90]
```

### 6.2 部分排序
部分排序涉及到对数组中的部分元素进行排序，它会找到数组中第 k 小的值，并将其移动到一个特定的位置，同时确保它左侧的元素都不大于它，右侧的元素都不小于它。
```python
arr = np.array([3, 4, 2, 1, 5, 6])

# 找到数组中第3小的元素并进行分区
partitioned_arr = np.partition(arr, 3)
print("Partitioned array:", partitioned_arr) # Partitioned array: [1 2 3 4 5 6]
```