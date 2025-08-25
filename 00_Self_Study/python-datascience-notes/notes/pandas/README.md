# Pandas
NumPy：提供高效的数值计算，适用于数组（ndarray）运算<br>
Pandas：提供数据分析和业务逻辑处理，适用于表格数据（DataFrame）

## 1. 导入
```python
import numpy as np
import pandas as pd
from pandas import Series, DataFrame
```

## 2. Series
Series 是 Pandas 提供的一种数据结构，类似一维数组，但比 NumPy 的 ndarray 更强大，因为它支持索引（index），可以像字典一样存取数据。
- `values`：存储数据（NumPy ndarray 类型）
- `index`：存储索引（可以是数字、字符串等）

### 2.1 创建Series
#### 2.1.1 由列表创建
使用 `pd.Series()` 从列表或 NumPy 数组创建 Series，默认索引是 0 到 n-1 的整数型索引。
- Series 默认的索引是 0, 1, 2, 3，类似 `range(len(data))`
- `values` 存储 NumPy ndarray 数据，但不会影响原列表（因为 list 是可变对象）
```python
names = ["tom", "lucy", "jack". "maria"]
s = Series(names)
print(s) 
# 输出结果：
0 tom
1 lucy
2 jack
3 maria
dtype: object
```

如果需要自定义索引，可以使用 `index` 参数。
- `index` 可以是自定义的标签，类似字典的键
```python
s = pd.Series([10, 20, 30, 40], index=['a', 'b', 'c', 'd'])
print(s)
# 输出结果：
a    10
b    20
c    30
d    40
dtype: int64
```
#### 2.1.2 由numpy数组创建
默认索引仍然是 0, 1, 2, 3。
```python
arr = np.array([1, 2, 3, 4])
s = pd.Series(arr)
print(s)
# 输出结果：
0    1
1    2
2    3
3    4
dtype: int64
```
Series 不会复制 NumPy ndarray 的数据，而是引用原数组的数据。修改 Series 的元素时，原 ndarray 也会改变。
```python
arr = np.array([1, 2, 3, 4])
s = pd.Series(arr)
s[0] = 100 # 修改 Series 中的第一个元素

print(s) 
# 输出结果：
0    100
1      2
2      3
3      4
dtype: int64

print(arr) # 输出结果：[100   2   3   4]
```

#### 2.1.3 由字典创建
使用字典（dict）创建 Series，它会自动使用字典的键作为索引，值作为 Series 的数据（`values`）。
- Series 的索引来自字典的键（'apple', 'banana', 'cherry'）。
- values 直接来自字典的值（5, 10, 15）。
```python
data = {'apple': 5, 'banana': 10, 'cherry': 15}  
s = pd.Series(data)  
print(s)
# 输出结果：
apple      5
banana    10
cherry    15
dtype: int64
```

如果提供 index 参数，Series 会按照 index 指定的顺序排列数据，并且：
- 如果 index 中的某个键不存在于字典中，它的值会是 `NaN`（pandas 使用 `NaN` 表示缺失值）。
- 如果 index 少于字典中的键，Series 只会保留 index 指定的部分。
```python
keys = ['banana', 'apple', 'grape']  # 指定顺序，并加入一个不存在的键 'grape'
s = pd.Series(data, index=keys)
print(s)
# 输出结果：
banana    10.0
apple      5.0 # banana 和 apple 按照 index 指定的顺序排列。
grape      NaN # grape 在原字典中不存在，因此变成 NaN（缺失值）。
dtype: float64 # dtype 变成 float64，因为 NaN 只能和浮点数兼容。
```

### 2.2 访问机制
```python
data = {'apple': 5, 'banana': 10, 'cherry': 15}
s = pd.Series(data)
```
#### 2.2.1 loc[]（使用显式索引）
用 `loc[]` 访问数据时，必须提供 Series 的 index 标签（dict 的 key）。只能使用 index 的值 作为索引，不能用位置索引。
```python
print(s.loc['apple'])  # 获取 'apple' 的值
print(s.loc[['apple', 'cherry']])  # 获取多个值
# 输出结果：
5
apple      5
cherry    15
dtype: int64
```

#### 2.2.2 iloc[]（使用隐式索引）
用 `iloc[]` 访问数据时，只能使用 0, 1, 2, ... 这样的整数索引，类似 numpy 数组的索引。`iloc[]` 对应的是 Series 中元素的位置，与 index 无关。
```python
print(s.iloc[0])  # 获取第 0 个元素
print(s.iloc[[0, 2]])  # 获取第 0 和 第 2 个元素
# 输出结果：
5
apple      5
cherry    15
dtype: int64
```

#### 2.2.3 使用布尔索引访问 Series
使用 `bool` 数组筛选数据
```python
s = pd.Series([10, 20, 30, 40, 50])
print(s[s > 25])  # 选取大于 25 的元素
# 输出结果：
2    30
3    40
4    50
dtype: int64
```

### 2.3 基本属性
```python
s = pd.Series([10, 20, 30, 40, 50])
```
- `shape`：返回 Series 的形状（即 `(n,)`，n 表示元素个数），适用于多维数据。`print(s.shape)`的输出结果为：`(5,)`。
- `size`：返回 Series 的元素总个数，不受 `NaN` 影响。`print(s.size)`的输出结果为：`5`。
- `index`：返回 Series 的索引（类似 list 或 ndarray 的 index）。`print(s.index)`的输出结果为：`RangeIndex(start=0, stop=5, step=1)`；还可以通过调用`s.index = ['a', 'b', 'c', 'd', 'e']`来修改索引。
- `values`：返回 Series 的值，类型是 ndarray。`print(s.values)`的输出结果为：`[10 20 30 40 50]`。
- `name`：Series 可以有自己的名称，用于标识数据的含义。
    - ```python
        s.name = "Sales"
        print(s)
        # 输出结果：
        0    10
        1    20
        2    30
        3    40
        4    50
        Name: Sales, dtype: int64
        ```

### 2.4 预览数据
- `head(n)`：返回前 n 个元素，比如 `s.head(3)` 指取前 3 个。
- `tail(n)`：返回后 n 个元素，比如 `s.tail(2)` 指取后 2 个。

### 2.5 处理缺失值
```python
s = pd.Series([1, 2, None, 4, 5])
```
`pd.isnull(s)` / `s.isnull()`：判断 Series 中哪些值是 `NaN`（缺失值）。
```python
print(pd.isnull(s)) # 也可以用 s.isnull()
# 输出结果：
0    False
1    False
2     True
3    False
4    False
dtype: bool
```

`pd.notnull(s)` / `s.notnull()`：判断 Series 中哪些值不是 `NaN`。
```python
print(pd.notnull(s))  # 也可以用 s.notnull()
# 输出结果：
0     True
1     True
2    False
3     True
4     True
dtype: bool
```

### 2.6 排序数据及统计值出现的次数
#### 2.6.1 按值排序
```python
s = pd.Series([30, 10, 20, 50, 40])
```
升序排序：`s.sort_values()`<br>
降序排序：`s.sort_values(ascending=False)`

#### 2.6.2 按索引排序
```python
s.index = ['c', 'a', 'b', 'e', 'd']
```
按索引升序排序：`s.sort_index()`

#### 2.6.3 统计值出现的次数
`value_counts()`：统计 Series 中各个值的出现次数。
```python
s = pd.Series(['apple', 'banana', 'apple', 'cherry', 'banana', 'banana'])
print(s.value_counts())
# 输出结果：
banana    3
apple     2
cherry    1
dtype: int64
```

### 2.7 运算
#### 2.7.1 算术运算
Series 可以与单一的数值进行算术运算，也可以与其他 Series 进行运算。运算时，它会根据索引对齐数据。
```python
s1 = pd.Series([1, 2, 3])
s2 = pd.Series([4, 5, 6])
```
运算示例：
```python
s1 + s2  # 输出： 0    5
         #       1    7
         #       2    9
         # dtype: int64

s1 - s2  # 输出： 0   -3
         #       1   -3
         #       2   -3
         # dtype: int64

s1 * s2  # 输出： 0     4
         #       1    10
         #       2    18
         # dtype: int64

s1 / s2  # 输出： 0    0.25
         #       1    0.40
         #       2    0.50
         # dtype: float64
```

#### 2.7.2 比较运算
在 pandas 中，Series 支持所有常见的比较操作符，如 `==（等于）`、`!=（不等于）`、`<（小于）`、`>（大于）`、`<=（小于等于）`和 `>=（大于等于）`。比较运算的结果是一个布尔型 Series，其中每个元素都是对应位置上的比较结果。
```python
s1 = pd.Series([1, 2, 3])
s2 = pd.Series([3, 2, 1])
```
运算示例：
```python
s1 == s2
# 输出：
# 0    False
# 1     True
# 2    False
# dtype: bool

s1 != s2
# 输出：
# 0     True
# 1    False
# 2     True
# dtype: bool
```

#### 2.7.3 统计运算
Series 提供了丰富的方法来执行统计分析。
| 方法         | 描述                                                   |
|--------------|--------------------------------------------------------|
| `sum()`      | 返回 Series 中所有数值的总和。                          |
| `mean()`     | 计算 Series 中的平均值。                               |
| `median()`   | 求中位数。                                             |
| `mode()`     | 求众数（出现次数最多的值）。                           |
| `std()`      | 计算标准差，表示数据的离散程度。                        |
| `var()`      | 计算方差，衡量数据的分散程度。                          |
| `min()`      | 找到 Series 中的最小值。                               |
| `max()`      | 找到 Series 中的最大值。                               |
| `count()`    | 计算非空（非 NaN）值的数量。                            |
| `describe()` | 提供 Series 的统计摘要，包括均值、标准差、最小值等。    |

```python
s1 = pd.Series([1, 2, 3])
```
运算示例：
```python
s1.describe()
# 输出：
# count    3.0
# mean     2.0
# std      1.0
# min      1.0
# 25%      1.5
# 50%      2.0
# 75%      2.5
# max      3.0
# dtype: float64
```

## 3. DataFrame
| 数据结构    | 描述                                   | 主要特点                           | 适合场景                                               |
|-------------|--------------------------------------|------------------------------------|-------------------------------------------------------|
| `DataFrame` | 二维标签化数据结构，可含不同数据类型。 | 支持列的异质性；具有行列标签。       | 数据清洗、数据分析、复杂数据操作，如合并、分组和聚合。   |
| `Series`    | 一维标签化数组。                      | 单一数据类型；带索引。              | 单一维度的数据操作，用于时间序列分析或个别数据列操作。   |
| NumPy 数组  | 多维数组。                            | 元素类型统一；高性能数值计算。       | 需要高效数学运算的科学计算，尤其是大规模数值数据。      |

### 3.1 创建DataFrame
#### 3.1.1 从字典创建
字典的键作为列名，值（一个数组或列表）作为数据。
```python
data = {
    'Name': ['Alice', 'Bob', 'Charlie'],
    'Age': [25, 30, 35],
    'City': ['New York', 'Los Angeles', 'Chicago']
}

df = pd.DataFrame(data)
```

#### 3.1.2 从列表的列表创建
每个内部列表作为 DataFrame 的一行。
```python
data = [
    ['Alice', 25, 'New York'],
    ['Bob', 30, 'Los Angeles'],
    ['Charlie', 35, 'Chicago']
]
columns = ['Name', 'Age', 'City']
df = pd.DataFrame(data, columns=columns)
```

#### 3.1.3 直接从文件读取
使用 pandas 的 `read_csv()` 、 `pd.read_table()` 和 `pd.read_excel()` 直接从文件中加载数据，通过 `sep` 参数设置分隔符。
<br>

可以使用 `header` 和 `index_col` 参数设置列标题行，不设置时，默认使用表格的第一行第一列。
- `header`：指定哪一行数据作为数据框的列名。`header=0`，表示将文件的第一行用作列名。
- `index_col`：指定哪一列数据作为 DataFrame 的行索引。`index_col=0`，表示将第一列作为行索引。

```python
df = pd.read_csv('path/to/your/file.csv', header=None, index_col=0, sep='|')
df = pd.read_excel('path/to/your/file.xlsx', header=None, index_col=0)
df = pd.read_table('path/to/your/file.txt', header=None, index_col=0, sep='\t')
```

##### 3.1.3.1 保存文件
- `sep`：指定字段分隔符为竖线 `|`
- `index=False`：表示在保存时不包括行索引
- `columns`：指定要写入文件的列
- `header`：是否写入列名作为文件的头部
- `encoding`：指定文件的编码格式，如 `utf-8`
```python
df.to_csv('path/to/your/new_file.csv', sep='|', index=False) # 保存为 CSV 文件
df.to_excel('path/to/your/new_file.xlsx', index=False) # 保存为 Excel 文件，使用 to_excel 需要先安装 openpyxl 或 xlrd 库。
df.to_csv('path/to/your/new_file.txt', sep='\t', index=False) # 保存为文本文件，使用制表符 '\t' 可以保存为类似于传统表格的文本文件。
```

### 3.2 索引和切片
#### 3.2.1 使用列名访问列
直接使用列名作为索引可以访问特定的列。
```python
df['ColumnName'] # 得到 ColumnName 列的所有数据作为一个 Series
df[['Column1', 'Column2']] # 得到一个包含这些指定列的新 DataFrame
```

#### 3.2.2 使用 loc
`loc`：基于标签的索引，可以使用列名和行标签进行访问。主要用于标签的索引，包括条件筛选。对数据进行切片时，`loc` 包含结束标签，而 `iloc` 不包含结束位置。
```python
df.loc['row_label'] # 单个标签
df.loc[['row_label1', 'row_label2']] # 标签列表
df.loc['row_label1':'row_label3'] # 切片
df.loc[df['column_name'] > value] # 布尔数组
df.loc['row_label', 'column_name'] # 组合行列
df.loc[df['column_name'] > value, ['column1', 'column2']] # 条件和多列
```

#### 3.2.3 使用 iloc
`iloc`：基于整数位置的索引，使用行和列的整数位置进行访问。适用于基于位置的索引，非常类似于在 NumPy/Python 中的用法。对数据进行切片时，`loc` 包含结束标签，而 `iloc` 不包含结束位置。
```python
df.iloc[0]  # 访问第一行
df.iloc[[0, 2, 4]]  # 访问第1、3、5行
df.iloc[1:5]  # 访问第2到第5行
df.iloc[0, 1]  # 访问第一行第二列的元素
df.iloc[1:5, 0:2]  # 访问第2到第5行，前两列
```

### 3.3 运算
#### 3.3.1 算术运算
DataFrame 支持基本的算术运算，如加、减、乘、除等。这些运算可以是两个 DataFrame 之间的运算，也可以是 DataFrame 与一个数值之间的运算。
<br>

两个 DataFrame 之间的运算：在进行运算时，pandas 会根据行索引和列索引对齐数据。如果索引不匹配，结果中的相应位置会产生 `NaN（缺失值）`。
```python
df1 = pd.DataFrame({
    'A': [1, 2, 3],
    'B': [4, 5, 6]
})

df2 = pd.DataFrame({
    'A': [10, 20, 30],
    'B': [40, 50, 60]
})

result = df1 + df2  # 对应元素相加

# 	A	B
# 0	11	44
# 1	22	55
# 2	33	66
```
DataFrame 与数值之间的运算：可以对 DataFrame 中的每个元素进行加、减、乘、除等运算。
```python
result = df1 * 10  # 每个元素乘以 10

#     A   B
# 0  10  40
# 1  20  50
# 2  30  60
```

#### 3.3.2 比较运算
DataFrame 也支持元素级的比较运算，如等于、不等于、大于、小于等，结果是一个布尔型 DataFrame。
```python
df1 = pd.DataFrame({
    'A': [1, 2, 3],
    'B': [4, 5, 6]
})

result = df1 > 2  # 检查 `df1` 中的元素是否大于 2

# 	    A	   B
# 0	False	True
# 1	False	True
# 2	True	True
```

#### 3.3.3 统计运算
统计运算可以直接在整个 DataFrame 或 Series 上使用，不需要事先进行分组。这些运算通常用于快速获取整个数据集或某一列的统计概览，如整个数据集的总和、均值、最大值、最小值等。
| 函数         | 描述                               |
|--------------|------------------------------------|
| `sum()`      | 计算数据的总和。                    |
| `mean()`     | 计算数据的平均值。                  |
| `median()`   | 计算数据的中位数。                  |
| `mode()`     | 计算数据的众数（最常出现的数据）。  |
| `min()`      | 找到每列的最小值。                  |
| `max()`      | 找到每列的最大值。                  |
| `std()`      | 计算数据的标准差。                  |
| `var()`      | 计算数据的方差。                    |
| `count()`    | 计算非空值的数量。                  |
| `describe()` | 生成数据的描述性统计摘要。          |

#### 3.3.4 聚合运算
聚合函数通常在对数据分组（如使用 `groupby()`）之后使用。这些函数被应用于每个分组的数据，以生成每个组的统计摘要。例如，当按某个分类变量对数据进行分组后，可能会对每个组的某个数值列使用 `sum()` 或 `mean()` 来计算总和或平均值。
<br>

`groupby()` 方法可以将 DataFrame 分成多个组，每组包含了相同的值的数据项。这些值可以是一列或多列的数据。分组后，可以对每个组应用聚合函数。

| 函数         | 描述                                   |
|--------------|----------------------------------------|
| `sum()`      | 对组内数据求和。                        |
| `mean()`     | 计算组内数据的平均值。                  |
| `median()`   | 计算组内数据的中位数。                  |
| `min()`      | 找到组内数据的最小值。                  |
| `max()`      | 找到组内数据的最大值。                  |
| `std()`      | 计算组内数据的标准差。                  |
| `var()`      | 计算组内数据的方差。                    |
| `count()`    | 计算组内非空数据的数量。                |
| `first()`    | 返回组内的第一个数据项。                |
| `last()`     | 返回组内的最后一个数据项。              |
| `nunique()`  | 计算组内不同值的数量。                  |
| `size()`     | 获取组内的元素总数。                    |
| `prod()`     | 计算组内数据的乘积。                    |
| `agg()`      | 应用一个或多个操作进行聚合。            |
| `describe()` | 提供组内数据的描述性统计摘要。          |

```python
df = pd.DataFrame({
    'Category': ['A', 'A', 'B', 'B', 'C', 'C', 'A', 'B'],
    'Data': [10, 15, 9, 10, 8, 7, 14, 11]
})

grouped = df.groupby('Category') # 按 Category 列对数据进行分组
result = grouped.sum() # 计算每个组的总和
print(result)

#              Data
# Category      
# A              39
# B              30
# C              15
```

### 3.4 处理缺失值
在 pandas 中，处理缺失值是数据清理和准备工作中的一个重要部分，因为缺失值会影响数据分析和模型的性能。
#### 3.4.1 识别缺失值
`isna()` 或 `isnull()`：这两个函数用于检测 DataFrame 或 Series 中的`缺失值（NaN）`，返回一个相同形状的布尔型对象，其中缺失值位置为 `True`。
```python
df = pd.DataFrame({
    'A': [1, 2, None, 4],
    'B': [None, 2, 3, 4]
})

print(df.isna())
#        A      B
# 0  False   True
# 1  False  False
# 2   True  False
# 3  False  False
```

#### 3.4.2 删除缺失值
使用 `dropna()` 删除包含缺失值的行或列。
- `axis`：用于选择操作的轴，`axis=0` 删除含有缺失值的行，`axis=1` 删除含有缺失值的列。
- `how`：设置为 `any`（任何含有缺失值的行或列都删除）或 `all`（只有全部为缺失值的行或列才删除）。
```python
df = pd.DataFrame({
    'A': [1, None, 3],
    'B': [4, 5, None],
    'C': [None, None, None]
})
```
删除任何含有缺失值的行：
```python
dfx = df.dropna(axis=0, how='any')
print(dfx)
# Empty DataFrame
# Columns: [A, B, C]
# Index: []
```
删除所有值均为缺失的列：
```python
dfx = df.dropna(axis=1, how='all')
print(dfx)
#      A    B
# 0  1.0  4.0
# 1  NaN  5.0
# 2  3.0  NaN
```

#### 3.4.3 填充缺失值
使用 `fillna()` 填充缺失值，可以指定一个固定的值或使用不同的填充策略。可以填充一个固定的值，如 `0`，或者一个计算出的值，如列的`平均值`或`中位数`。`method` 参数可以是 `ffill（前向填充）`或 `bfill（后向填充）`，用于填充方法。
```python
df_filled = df.fillna(0) # 使用0填充所有缺失值
df_filled_ffill = df.fillna(method='ffill') # 使用前一个值填充缺失值
df_filled_mean = df.fillna(df.mean()) # 使用列的平均值填充缺失值
```

#### 3.4.4 使用插值方法
使用 `interpolate()` 填充缺失值，尤其是时间序列数据。默认情况下，`interpolate()` 使用线性插值，但也可以通过 `method` 参数选择不同的插值方法，如 `polynomial`, `time` 等。
```python
df_interpolated = df.interpolate()
```