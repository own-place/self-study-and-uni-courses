# Pratical Usage
## 1. Basic Knowledge of Python
### 1.1 Comments
**Single-line comments**: Use `#` to add a comment.<br>
**Multi-line comments**: Use triple quotes `'''` or `"""` around the comment.
```python
# This is a single line comment. Use the "pound" sign, or "hashtag"

"""
This is a multiline comment. 
These comments go *in* a function, 
instead of *above* when you use them as function documentation.
"""
```

### 1.2 Variables
A variable name is case-sensitive and starts with a letter or underscore. You can use numbers, as long as you don't start with it.
<br>
The snake case technique is widely used for variable names, where each word is seperated by an underscore.
<br>
It's not possible to use a Python keyword as a variable name, such as `and`, `class`, `else`, `except`, `import`, [and many more](https://www.w3schools.com/python/python_ref_keywords.asp). 

### 1.3 Data Types
```python
x = 1.001
y = -100
text = "Don't worry, this won't raise any errors"
boolean = True

print(type(x)) # <class 'float'>
print(type(y)) # <class 'int'>
print(type(text)) # <class 'str'>
print(type(boolean)) # <class 'bool'>
```

### 1.4 Operators
#### 1.4.1 Arithmetic operators
Here's some basic arithmetic that Python can do:
- **Addition**: `+`
- **Subtraction**: `-`
- **Multiplication**: `*`
- **Division**: `/`
- **Integer Division**: `//`
- **Modulus**: `%`
- **Exponentiation**: `**`

#### 1.4.2 Comparison operators
These help you to compare values. They return a boolean. 
- **Equal to**: `==`
- **Not equal to**: `!=`
- **Greater than**: `>`
- **Less than**: `<`
- **Greater than or equal to**: `>=`
- **Less than or equal to**: `<=`

#### 1.4.3 Logical operators
These are used to combine conditional statements `and`, `or` & `not` 

### 1.5 Conditions & Loops
#### 1.5.1 Conditions
Conditional statements allow your code to take different actions based on certain conditions. 
<br>
The most common are `if`, `elif`, and `else`. 

```python
temperature = 25

if temperature > 30:
    print("Wow, tropical day!")
elif temperature > 20:
    print("It's a nice day.")
elif temperature > 15:
    print("It's not a bad day.")
else:
    print("It's a bit chilly.")

# It's a nice day.
```

#### 1.5.2 Loops
Python understands `for` loops and `while` loops just like any other language. The for-loop in Python tends to be used as a foreach-loop.<br>
The range (start,end) function returns a list of numbers from `start` to `end - 1`.
```python
# for loop
for i in range(10):
    print(i) # 0 1 2 3 4 5 6 7 8 9
```
```python
# while loop
i = 0
while i < 10:
    print(i) # 0 1 2 3 4 5 6 7 8 9
    i += 1
```

### 1.6 Functions
Functions can have default parameter values, which are used if no argument is passed during the function call.
```python
def greet_user(name="stranger", planet="Earth"):
    print(f"Hello, {name}. Welcome to {planet}!")

# Default argument
greet_user() # Hello, stranger. Welcome to Earth!

# Specified argument
greet_user(name="Alice", planet="Mars") # Hello, Alice. Welcome to Mars!
```

### 1.7 Lists and Dictionaries
#### 1.7.1 List
A list is an ordered collection of items stored in a single variable. The order is defined and new items are placed at the end. list can be indexed, starting at `[0]`. While a list allows different datatypes, it's questionable whether this is useful to do. A list is created using `[]`.
```python
flowers = ["Iris", "Poppy", "Rose", "Iris"]
grades = [5, 6.6, 4, 10]
```

#### 1.7.1 Dictionaries
Note that since a dictionary is a hashtable, it is incredibly quick for calculations. Whereas in Php you would use arrays for everything, in Python you should keep in mind that dictionaries are about 1000 times faster compared to lists.<br>
`If order is important and index matters --> list. Any other case --> dictionary.`
```python
flower_info = {
    "Rose": {
        "Common Color": "Red",
        "Texture": "Velvety",
        "Scent": "Fragrant",
        "Cultural Significance": "Love and Romance"
    },
    "Lily": {
        "Common Color": "White",
        "Texture": "Smooth",
        "Scent": "Sweet",
        "Cultural Significance": "Purity and renewal"
    },
    "Lotus": {
        "Common Color": "Pink",
        "Texture": "Waxy",
        "Scent": "Mild",
        "Cultural Significance": "Spiritual Enlightenment"
    }
}
```

## 2. Get Data
Pandas is [well-documented](https://pandas.pydata.org/docs/) and one of Python's most used libraries in the data science field.
```python
import pandas as pd
```
The dataset we will be using is the [Video Games Sales Dataset](https://www.kaggle.com/sidtwr/videogames-sales-dataset), the [.csv file for all video games](https://www.kaggle.com/sidtwr/videogames-sales-dataset?select=Video_Games_Sales_as_at_22_Dec_2016.csv) to be precise.

### 2.1 Load and Read File
```python
df = pd.read_csv('../videogames.csv',sep=';')
```
Use `.head()` (first), `.tail()` (last) and `.sample()` (random) to show 5 rows by standard. Increase the amount by passing an argument, for example: `df.head(10)`. <br><br>
To figure out the size of the dataframe and what kind of attributes you are dealing with, you can use the `info()` function. Every column in your dataset is turned into a row. For every column some information is displayed like the **Dtype** which is the type of values that are in the column.<br><br>
You can find null values (or missing data) based on the amount of non-null cells in each of the columns. Besides that there is some more information displayed like size of the dataset. You can see **RangeIndex: 16719 entries** meaning there are 16719 rows and **Data columns (total 16 columns)** meaning there are 16 columns.<br><br>
Use `help()` to get the explaination of methods, like `help(df.info)` .

### 2.2 Creating Statistic
`describe()` can give you all the statistics in one overview for the **numeric** columns.
```python
df.describe()
```

`unique()` can give you all the unique value in a column.
```python
df['Platform'].unique()
# array(['Wii', 'NES', 'GB', 'DS', 'X360', 'PS3', 'PS2', 'SNES', 'GBA',
#       'PS4', '3DS', 'N64', 'PS', 'XB', 'PC', '2600', 'PSP', 'XOne',
#       'WiiU', 'GC', 'GEN', 'DC', 'PSV', 'SAT', 'SCD', 'WS', 'NG', 'TG16',
#       '3DO', 'GG', 'PCFX'], dtype=object)
```

#### 2.2.1 Mean
The average of all the values in the column. Useful for example if you want to know what the average amount of sales is globally. This can be done by using the `mean()` function on the **Global_Sales** column.
```python
df['Global_Sales'].mean() # 0.5335426759973684
```

#### 2.2.2 Min and max
Getting the lowest value in a column is useful to know because this allows you to get an idea of the range of values together with the maximum value. Use the `min()` adn `max()` functions to get these values.
```python
print(df['Global_Sales'].min()) # 0.01
print(df['Global_Sales'].max()) # 82.53
```

#### 2.2.3 Median
This is the value precisely in at 50% after sorting all value in order from small to large. Meaning about 50% of the data is above and below this value. You can use this to get a better understanding of the average value. Because average might be skewed by extremely high or low values. You can calculate the median by using the `median()` function.
```python
df['Global_Sales'].median() # 0.17
```

#### 2.2.4 Std
The deviation of each value in the column from the mean, taking the square root of those values and save the results in a list. Calculate the mean for that list of deviations and the take the root. Good to get an idea of the dispersion of the values in a column, you can do this by using the `std()` function.
```python
df['Critic_Score'].std() # 13.938164552843201
```

#### 2.2.5 Mode
The mode function gives you the most common value in the column. So for example if we would like to see what the most given score is by critics we can do the `mode()` function on the column **Critic_Score**.
```python
df['Critic_Score'].mode() 
# 0    70.0
# Name: Critic_Score, dtype: float64
```


### 2.3 Histogram
There are hundreds of different graphs available in libraries like **matplotlib**. Here are a few examples: [Matplotlib.org](https://matplotlib.org/stable/plot_types/index) .
```python
import matplotlib.pyplot as plt

plt.hist(df['Year_of_Release'], bins=20)
plt.title('This is the title of the plot')
plt.show()
```

## 3 Select Data
### 3.1 Using loc()
Gather all the Xbox 360 games<br>
`df.loc[df["Platform"] == "X360"]`<br><br>

Find games released on the PS4 and sold more than 1 million copies globally<br>
`df.loc[(df["Platform"] == "PS4") & (df["Global_Sales"] > 1)]`<br><br>

Identify the name and critic score of action games released in 2008 that had a critic score of more than 90<br>
`df.loc[(df["Genre"] == "Action") & (df["Year_of_Release"] ==2008) & (df["Critic_Score"] > 90), ["Name", "Critic_Score"]]`<br><br>

Identify sports games released between 2000 and 2010 that sold at least 1 million copies in Europe with a user score below 7. Display the name and publisher<br>
`df.loc[(df["Year_of_Release"] >= 2000) & (df["Year_of_Release"] <= 2010) & (df["Genre"] == "Sports") & (df["EU_Sales"] >= 2) & (df["User_Score"] < 7), ["Name", "Publisher"]]`<br>

### 3.2 Using iloc()
`iloc[]` is purely used for integer-location based indexing for selecting by position. In other words, rows or columns are selected based on their location in the dataframe.<br><br>

First 4 rows and all the columns<br>
`df.iloc[0:4]` or `df.iloc[0:4,:]`<br><br>

All the rows and first 4 columnsS<br>
`df.iloc[:,0:4]`<br><br>

First 4 rows and first 4 columns<br>
`df.iloc[0:4,0:4]`<br><br>

First 4 rows and third + fourth column<br>
`df.iloc[0:4,2:4]`<br><br>

Second + third row and third + fourth column<br>
`df.iloc[1:3,2:4]`<br><br>

Select the 5th to the 10th row and the last three columns<br>
`df.iloc[4:9,-3:]`

## 4. Benchmark model
The dataset contains taxi trips and their cost and some other factors like distance and time of pick up and drop off. It is from Kaggle and can be found [here](https://www.kaggle.com/datasets/denkuznetz/taxi-price-prediction).
```python
df = pd.read_csv('../taxi_trip_pricing.csv',sep='|')
```

### 4.1 The Data
#### 4.1.1 Business Understanding
在开始分析和准备数据之前，我们首先需要知道我们想要实现什么目标。这个目标就是 创建一个能够根据距离和时间预测行程价格的模型。
- 输入（features）：行程距离、时间、天气、交通状况等
- 输出（target）：行程总费用（Trip_Price）
- 最终目标：让模型学会从输入数据中预测车费

#### 4.1.2 Data Understanding
Take a look at the data to get a better understanding of what we are working with
```python
df.head(1)
df.info()
df.describe()
```
Some context to get a better understanding of what each of the columns mean:
* **Trip_Distance_km**: The total distance of the trip 行程的总距离（公里）
* **Time_of_Day**: The time of day at the point of the trip 行程开始的时间
* **Day_of_Week**: Day of the week the trip was taken 行程的星期几
* **Passenger_Count**: The amount of passengers in the taxi 乘客人数
* **Traffic_Conditions**: The conditions of the traffick during the trip 交通状况
* **Base_Fare**: The base cost of the taxi 出租车的基本费用
* **Weather**: The weather conditions during the trip 天气状况
* **Per_Km_Rate**: The cost per kilometer 每公里收费
* **Per_Minute_Rate**: The cost per minute 每分钟收费
* **Trip_Duration_Minutes**: The total duration of the trip in minutes 行程持续时间（分钟）
* **Trip_Price**: The total price of the trip 目标变量（总价格）

#### 4.1.3 Data Preperation
在本课中，我们将放弃所有包含缺失值的行，而不是进行复杂的估算。为此，我们使用 dropna 函数。在该函数中，调用 inplace 参数并将其设置为 True，这将用不含缺失值的数据覆盖我们现有的名为 df 的数据。
```python
df.dropna(inplace=True) # 先把所有有缺失值的行去掉，以免影响模型训练。
```

### 4.2 Test Design
#### 4.2.1 Splitting data
To split the data we will be using a function called [**train_test_split**](https://scikit-learn.org/stable/modules/generated/sklearn.model_selection.train_test_split.html) from **Sklearn**.<br><br>
在构建模型前，我们需要把数据分成 训练集 和 测试集：
- 训练集（train set）：用于训练模型
- 测试集（test set）：用于评估模型性能
```python
from sklearn.model_selection import train_test_split
```
Split the data into a train and test set
```python
# pop() can be used to extract a column from the dataframe and remove it from the dataframe at the same time

# target is called y a lot in documentation 目标变量（y）：车费
target = dfx.pop('Trip_Price')

# features is called X a lot in documentation 特征（X）：其余所有列
features = dfx

# 拆分数据集（75% 训练集，25% 测试集）; random_state=42：保证每次运行拆分出的数据相同
X_train, X_test, y_train, y_test = train_test_split(features, target, test_size=0.25, random_state=42)

print('The length of y_train is:', len(y_train)) # The length of y_train is: 421 训练集样本数
print('The length of y_test is:', len(y_test)) # The length of y_test is: 141 测试集样本数
```

#### 4.2.2 The Benchmark
为了判断未来的模型是否有效，我们先构造一个最简单的基准模型：
- 思路：让模型 始终预测训练集车费的平均值。
- 目标：后续的模型 必须比这个基准模型更准确。

```python
""" 
len() is used to get the length of an object, if the object is a series/list than it will return the number of elements it contains. If it is a 
string it will give the number of characters
"""
value = y_train.mean() # 计算 y_train（训练集的车费）的平均值

pred_train = [value] * len(y_train) # 让所有样本的预测值都等于这个均值
pred_test = [value] * len(y_test) # 让所有样本的预测值都等于这个均值
```

#### 4.2.3 Metric
MAE（均值绝对误差） 计算预测值与真实值的平均绝对差距，作用是衡量模型预测的误差（值越小越好）。
```python
# Import the Mean Absolute Error from the library
from sklearn.metrics import mean_absolute_error

print('MAE of train set:', mean_absolute_error(pred_train, y_train))
print('MAE of test set:', mean_absolute_error(pred_test, y_test))
```
还可以计算和输出RMSE:
```python
rmse_train = np.sqrt(mean_squared_error(y_train, pred_train))
rmse_test = np.sqrt(mean_squared_error(y_test, pred_test))

print(f"Train MAE: {mae_train:.2f}, Train RMSE: {rmse_train:.2f}")
print(f"Test MAE: {mae_test:.2f}, Test RMSE: {rmse_test:.2f}")
```

## 5. Merging and Visualizing Data
### 5.1 Merging
Load both datasets into separate dataframes, then use `head()` to check the column names
```python
df_games = pd.read_csv('videogames.csv', sep=';')
console_data = pd.read_csv('console-dataset.csv',sep='|')
df_games.head(5)
console_data.head(5)
```
Choose a merging type from `Inner, left, right, full`
```python
df_merged = df_games.merge(console_data, left_on='Platform', right_on='Console Name', how='outer')
```

### 5.2 Visualizing data
#### 5.2.1 Barplot
A bar plot is a graphical representation of categorical data using bars of different heights. Bar plots are used to compare the frequency, count, or any other measurable value across different categories. 条形图是使用不同高度的条形来表示分类数据的图形。条形图用于比较不同类别的频率、计数或任何其他可测量值。<br>
Let's start with using value_counts() on a specific column before we create a bar plot with `.plot.bar()`. 在使用 `.plot.bar()` 创建条形图之前，我们先在特定列上使用 `value_counts()`。
```python
df_merged['Platform'].value_counts()
```
```python
plt.figure(figsize=(10,6))
df_merged['Platform'].value_counts().plot.bar(color='pink')
plt.xlabel('Platform',fontsize=10)
plt.ylabel('Amount of games releases',fontsize=10)
plt.title("Amount of games releasesd per platform")
plt.xticks(ha="right",rotation=60,fontsize=8)
plt.show()
```

#### 5.2.2 Lineplot
```python
df_merged['Year_of_Release'].value_counts().sort_values().sort_index().plot.line()
```

#### 5.2.3 Scatterplot
A scatterplot is a type of graph that displays the relationship between two numerical variables. In a scatterplot, each point on the graph represents a single datapoint. They are particularly useful for identifying correlations between variables, detecting patterns, and visualizing the spread of data. 散点图是一种显示两个数字变量之间关系的图表。在散点图中，图上的每个点代表一个数据点。散点图对于确定变量之间的相关性、发现模式和直观显示数据的分布特别有用。
```python
plt.xlabel('Consoles sold')
plt.ylabel('Global Sales')
plt.title('Global sales of a game compared to the number of consoles sold')
plt.scatter(df_merged['Units sold (million)'], df_merged['Global_Sales'])
```

#### 5.2.4 Seaborn
Seaborn is a Python library built on top of matplotlib, known for its elegant and informative statistical graphics. With seaborn, we can easily create visually appealing plots with minimal code, making complex visualizations accessible to everyone. But ofcourse before we can use the library we need to install it and then import it in out notebook.
```python
import seaborn as sns
```
You can read more about the possibility of seaborn on their website [here](https://seaborn.pydata.org/index.html).<br>
统计 `df_merged` 数据集中每个平台（Platform）上的游戏数量，并用柱状图（barplot）展示。`value_counts()` 计算每个平台的游戏数量。这个图可以帮助观察 不同类型的游戏销量 是否有明显的模式，比如某些类型的游戏是否更畅销。
```python
plt.figure(figsize=(12, 5))
sns.barplot(df_merged['Platform'].value_counts()) # 画出不同游戏平台的游戏数量
plt.xlabel('Platform',fontsize=10)
plt.ylabel('Count',fontsize=10)
plt.title("Diagram")
plt.xticks(ha="right",rotation=60,fontsize=8) # x 轴刻度标签旋转 60 度，靠右对齐
plt.show()
```
画出每款游戏的销量数据，横轴是 "Units sold (million)"（销量），纵轴是 "Global_Sales"（全球总销量）。用不同颜色区分游戏类型（Genre）
```python
sns.scatterplot(data=df_merged, x='Units sold (million)', y='Global_Sales',hue='Genre')
```
画出不同类型游戏（Genre）的平均评分随时间变化的趋势。`estimator='mean'` 计算每年的平均评分。这个图可以帮助观察游戏评分在不同时期是否有下降或上升趋势，不同类型的游戏评分是否有明显差异。
```python
sns.lineplot(data=df_merged, x='Year_of_Release',
            y='Critic_Score', estimator='mean', errorbar=('ci',False),hue='Genre')
```
折线图 总体评分趋势。和上面类似，但没有 `hue='Genre'`，所以它展示的是所有游戏的评分趋势。这有助于了解游戏评分的总体变化，而不关注特定类型。
```python
sns.lineplot(data=df_merged, x='Year_of_Release',
            y='Critic_Score', estimator='mean', errorbar=('ci',False))
```
折线图 体育类 vs 赛车类游戏的评分趋势。只选出 体育类（Sports） 和 赛车类（Racing） 的游戏，画出它们的 平均评分随时间的变化。这个图可以用于比较体育游戏 vs 赛车游戏的评分变化，哪个类型的评分更高；评分是否有 下降或上升趋势。
```python
df_ = df_merged.loc[(df_merged['Genre']=='Sports') | (df_merged['Genre'] == 'Racing')]
sns.lineplot(data=df_, x='Year_of_Release',
            y='Critic_Score', estimator='mean', errorbar=('ci',False),hue='Genre')
``` 
Create a lineplot that shows the amount games sold per year，统计每年的游戏全球销售总额。<br>
`estimator='sum'` 代表每年的销量求和。这个图可以观察游戏行业的销售趋势（比如是否存在巅峰时期），哪些年份的总销售额最高。
```python
sns.lineplot(data=df_merged, x='Year_of_Release',
            y='Global_Sales', estimator='sum', errorbar=('ci',False))
```