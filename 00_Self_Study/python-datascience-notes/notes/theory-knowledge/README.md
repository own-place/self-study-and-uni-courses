# Data Science
**Descriptive** and **Diagnostic** analytics describe the **past**. 用**描述性**和**诊断性**的分析描述**过去**。<br>
**Predictive** and **Prescriptive** analytics describe the **future**. 用**预测性**和**规范性**的分析描述**未来**。

## 1. Introduction
### 1.1 Data and Dataset
#### 1.1.1 What is data?
Data are **facts**, **statistics**, or **values** that **convey** information, which can be **structured** (tables, databases) or **unstructured** (slides, documentation).<br>
数据是**事实**、**统计数据**或**数值**，能够传达信息，可以是**结构化的**（表格、数据库）或**非结构化的**（幻灯片、文档）。

#### 1.1.2 What is a dataset?
A dataset consists of **rows** and **columns**:
- Rows represent observations (also known as the **target**). 行代表观察结果（也称为**目标**）。
- Columns represent variables (also known as **features**). 列代表变量（也称为**特征**）。

#### 1.1.3 Types of data
- **Categorical 分类数据**: Data that can be divided into distinct groups or categories. 可以划分为不同组或类别的数据。
- **Numerical 数值数据**: Data that is expressed as a number and can be measured. 以数字表达并可以测量的数据。

#### 1.1.4 Levels of Measurement
![levels-of-measurement](../img/levels-of-measurement.png)
Levels of measurement determine how data can be analyzed and interpreted:
- **Nominal** 名义
- **Ordinal** 序数
- **Interval** 区间
- **Ratio** 比率

### 1.2 CRISP-DM (Cross Industry Standard Process for Data Mining) 跨行业数据挖掘标准过程
CRISP-DM is a framework or model for conducting data science projects, which outlines a step-by-step process(CRISP-DM 是一个执行数据科学项目的框架或模型，概述了一个分步过程)：
1. **Business Understanding 业务理解** (define the 'why' behind the project)
2. **Data Understanding** (get to know your data)
3. **Data Preparation** (prepare the data for analysis)
4. **Modelling** (build models that answer questions 构建回答问题的模型)
5. **Evaluation 评估** (assess if the model meets business needs 评估模型是否满足业务需求)
6. **Deployment 部署** (deliver results that create impact 交付产生影响的结果; optional)

## 2. Business Understanding
- **Business Objective 商业目标**: Understand what the organization aims to achieve.
- **Business Objective Success Criteria 商业目标成功标准**: Know when the objective is successfully met.
- **Data Mining Goal 数据挖掘目标**: Define what we as data scientists can do in this process.
- **Data Mining Success Criteria 数据挖掘成功标准**: Establish when we have been successful as data scientists.

## 3. Data Understanding
In Business Understanding, stakeholders often request an **average (mean)**, but this may not always be the best measure.

### 3.1 Describing Your Data
Characteristics of a numerical variable:
- **Minimum**: The lowest value in the dataset.
- **Maximum**: The highest value in the dataset.

### 3.2 Central Tendency 中心趋势
- **Mean 均值**:
  - The average of a dataset calculated as the sum of all values divided by the total number of values. 数据集的平均值，计算方法是所有值的总和除以值的总数。
  - Uses all data points. 使用所有数据点。
  - Sensitive to outliers. 对异常值敏感。

- **Median 中位数**:
  - The middle value in a dataset ordered from least to greatest. 数据集中从最小到最大排序的中间值。
  - For even datasets, it is the average of the two middle values. 对于偶数个数据的数据集，它是两个中间值的平均值。
  - Robust to outliers. 对异常值有较强的抵抗力。

- **Mode 众数**:
  - The most frequently occurring value in a dataset. 数据集中出现频率最高的值。
  - Particularly useful for categorical data. 对于分类数据特别有用。

### 3.3 Distributions 分布
**Variance (σ²) 方差**: Measures how far a set of data points are spread out. 测量一组数据点的分散程度。
- Calculate the difference between each data point and the mean. 计算每个数据点与均值之间的差异。
- Square all these differences. 将这些差异平方。
- Calculate the average of these squared differences -> Variance (σ²). 计算这些平方差的平均值 -> 方差（σ²）。

#### 3.3.1 Normal Distribution 正态分布
- **Standard Deviation 标准差**:
    - Square root of the variance. 方差的平方根。
    - Indicates the distance between the data points and the mean. 表示数据点与均值之间的距离。
    - Used to determine whether a value is an outlier. 用于确定是否为异常值。
- **Low standard deviation**: Values are close to the mean. 值靠近均值。
- **High standard deviation**: Values are spread out over a wider range. 值在更广泛的范围内分散。
- **Symmetric Distribution**: Mean, Median, and Mode are approximately the same. 均值、中位数和众数大致相同。

#### 3.3.2 Skewed Distribution 偏态分布
- Not symmetric. 不对称。
- **Positive Skew 正偏态** (Right-skewed 右偏): Tail on the right side; Mean > Median. 尾部在右侧；均值 > 中位数。
- **Negative Ske 负偏态w** (Left-skewed 左偏): Tail on the left side; Mean < Median. 尾部在左侧；均值 < 中位数。

### 3.4 Outliers 异常值
- **Values at the extreme ends of the dataset 数据集极端端点的值**. 
- Can be a true value or an error. 可能是真实值也可能是错误。

#### 3.4.1 How to Detect Outliers
If a value is bigger or smaller than 3 times the standard deviation (σ). 如果一个值大于或小于标准差的3倍（σ）。
1. **Z-score** calculation for normal distributions. 适用于正态分布的计算。
2. **Interquartile Range (IQR) 四分位距**:
  - Split your dataset into four equal parts. The quartiles mark these divisions. 将数据集分成四等分。四分位数标记这些划分。
  - **Q1**: 25% of data points are below this value. 25%的数据点低于此值。
  - **Q2**: The median; 50% of data points are below and above. 中位数；50%的数据点低于此值，50%的数据点高于此值。
  - **Q3**: 75% of data points are below this value. 75%的数据点低于此值。
  - **IQR**: Range between Q1 and Q3; encompasses the middle 50% of your data. Q1与Q3之间的范围；包括数据的中间50%。
3. Visually via **histogram** and **boxplot**. 通过**直方图**和**箱形图**直观显示。
  ![可视化箱形图](../img/visualizations-boxplot.png)

#### 3.4.2 Handling Outliers
- **True Value Outliers**: Keep these in your dataset as they represent the variance in your data. 保留在数据集中，因为它们代表了数据的变异性。
- **Error Outliers**: You may remove or change these. 可以移除或更改这些值。

Presence of many true outliers can influence data science decisions. 多个真实异常值的存在可能会影响数据科学决策。<br>
Some machine learning algorithms are more robust to outliers than others. 一些机器学习算法对异常值更为稳健。

### 3.5 Correlation
Measures the strength and direction of relationship between two variables<br>
Values range from -1 to +1：**Positive correlation (+)，Negative correlation (-)，No correlation (≈ 0)**<br>
Correlation ≠ Causation<br>
![Correlation](../img/correlation.png)

#### 3.5.1 Pearson Correlation (r)
Measures linear relationship between continuous variables 测量连续变量之间的线性关系<br><br>

**Assumptions 假设:**<br>
Linear relationship 线性关系<br>
Variables are continuous 变量是连续的<br>
No significant outliers 没有显著的异常值<br>
Normal distribution (for hypothesis testing) 正态分布（用于假设检验）<br><br>

**Strength interpretation guidelines 强度解释指南:**<br>
0.00-0.19: Very weak<br>
0.20-0.39: Weak<br>
0.40-0.59: Moderate 中等<br>
0.60-0.79: Strong<br>
0.80-1.00: Very strong<br>
Same applies for negative values 负值也一样<br>
Statistical significance matters!统计显著性很重要！<br>
p-value determines if correlation is statistically significant p 值确定相关性是否具有统计显著性<br><br>

Statistical significance - How likely is the observed correlation due to random chance? 统计显著性 - 观察到的相关性由于随机因素而产生的可能性有多大？<br>
Represented by p-value - Probability of observing the correlation if no true relationship exists 用 p 值表示 - 如果不存在真实关系，则观察到相关性的概率<br>
p < 0.05: Significant (5% chance of false positive) 显著（假阳性的概率为 5%）<br>
p < 0.01: Highly significant (1% chance of false positive) 高度显著（假阳性的概率为 1%）<br>
p < 0.001: Very highly significant (0.1% chance of false positive) 非常显著（假阳性的概率为 0.1%）<br>
Small samples: even strong correlations may not be significant 即使强相关性也可能不显著<br>
Large samples: even weak correlations may be significant 即使弱相关性也可能显著<br><br>

**Pearson Correlation - downsides**<br>
Only detects linear relationships 仅检测线性关系<br>
Sensitive to outliers 对异常值敏感<br>
Assumes normality for hypothesis testing 假设检验为正态性<br>
May miss important non-linear patterns 可能会错过重要的非线性模式<br><br>

#### 3.5.2 Spearman’s Rank
Measures monotonic relationships (both linear and non-linear). Monotonic: variables change together, but not necessarily at a constant rate 测量单调关系（线性和非线性）。单调：变量一起变化，但不一定以恒定的速率变化<br>
Based on ranks of data rather than absolute values 基于数据的等级而不是绝对值<br><br>
Use when:<br>
Data may have non-linear relationships 数据可能具有非线性关系<br>
Working with ordinal data 使用序数数据<br>
Dealing with outliers 处理异常值<br>
Distribution assumptions are violated 违反分布假设<br><br>

**Pearson vs Spearman**
|Pearson|Spearman|
|--|--|
|Data follows linearrelationship 数据遵循线性关系|Potentially non-linear but monotonic relationships 可能非线性但单调的关系|
|Interval or ratio data 区间或比率数据|Ordinal, interval, or ratio data 序数、区间或比率数据|
|Normally distributed 正态分布|Non-normallydistributeddata 非正态分布数据|
|Few or no outliers 异常值很少或没有|Presenceof outliers 存在异常值|
|Continuous variables 连续变量|Ranked data 排序数据|

#### 3.5.3 Usage
**Correlation Matrices 矩阵**
`pandas.DataFrame.corr`. Uses Pearson, but you can change the method.<br><br>

Tabular representation of pairwise correlations 成对相关性的表格表示<br>
Rows and columns represent variables 行和列代表变量<br>
Each cell shows correlation between two variables 每个单元格显示两个变量之间的相关性<br>
Diagonal always equals 1 (variable with itself) 对角线始终等于 1（变量与自身）<br>
Symmetric matrix 对称矩阵 `(corr(X,Y) = corr(Y,X))`<br><br>

**Correlation Heatmaps 热图**<br>
Visual representation of correlation matrix 相关性矩阵的可视化表示<br>
Colors indicate correlation strength and direction 颜色表示相关性强度和方向<br>
Easy to spot patterns and relationships 易于发现模式和关系<br>
Can be sorted or clustered for better insights 可以进行排序或聚类以获得更好的洞察力<br><br>

Look for bright colors (strong correlations) 寻找明亮的颜色（强相关性）<br>
Identify clusters of correlated features 识别相关特征的聚类<br>
Pay attention to correlations with target variable 注意与目标变量的相关性<br>
Examine both positive and negative correlations 检查正相关和负相关<br>
Consider domain knowledge when interpreting results 解释结果时考虑领域知识<br><br>

**Pairplots** - `seaborn.pairplot`<br>
Shows pairwise relationships between multiple variables 显示多个变量之间的成对关系<br>
Combines scatter plots and histograms/density plots 结合散点图和直方图/密度图<br>
Scatter plots below diagonal, distributions on diagonal 对角线下方的散点图，对角线上的分布<br>
Canuse color points by categorical variable 可以按分类变量使用颜色点<br>
Great for exploratory data analysis in data understanding 非常适合数据理解中的探索性数据分析<br><br>

**Clustered Correlation Matrix 聚类相关矩阵** - `seaborn.clustermap`<br>
Rearranges correlation matrix based on similarity 根据相似性重​​新排列相关矩阵<br>
Brings highly correlated variables together 将高度相关的变量组合在一起<br>
Helps identify feature clusters automatically using the dendogram 帮助使用树状图自动识别特征聚类

#### 3.5.4 Redundancy
**Redundant features 冗余特征:**<br>
Highly correlated with other features 与其他特征高度相关<br>
Provide similar information 提供类似信息<br>
Add complexity without adding value 增加复杂性而不增加价值<br><br>

**Impact on models:**<br>
Increase training time 增加训练时间<br>
Can lead to overfitting 可能导致过度拟合<br>
May cause multicollinearity in regression 可能导致回归中的多重共线性<br>
Reduce model interpretability 降低模型的可解释性<br>
Increase risk of overfitting to noise 增加过度拟合噪声的风险<br><br>

**Redundancy – Identifying redundant features 识别冗余特征**<br>
Use correlation matrix to identify highly correlated pairs 使用相关矩阵识别高度相关的对 - Common thresholds 常见阈值: `|r| > 0.7`, Strong correlation, potential redundancy; `|r| > 0.9`, Very strong correlation, likely redundancy<br>
Look for correlation clusters 寻找相关性簇<br>
Consider correlations with target variable 考虑与目标变量的相关性<br><br>

**Redundancy – How to handle**<br>
Feature selection 特征选择:Keep one feature from each correlated group; Choose based on correlation with target or interpretability 从每个相关组中保留一个特征；根据与目标的相关性或可解释性进行选择<br>
Feature engineering (create new features) 特征工程（创建新特征）: Ratios or differences between correlated features 相关特征之间的比率或差异<br>
Domain knowledge 领域知识: Use subject expertise to select most relevant features 使用主题专业知识来选择最相关的特征

## 4. Data Preparation
### 4.1 Different Errors
- **Typos**: e.g., "Asmterdam" -> "Amsterdam", "1234a" in a numerical column.
- **Duplications**: Multiple entries of the same data. 相同数据的多次条目。
- **Missing values**: Absence of data points.
- **Inconsistent data formats 数据格式不一致**: e.g., MM-DD-YYYY vs. DD-MM-YYYY.
- **Inconsistent values 值不一致**: e.g., "St." vs. "Street".
- **Inconsistent units of measurement 测量单位不一致**: e.g., meters vs kilometers.

Modifying datasets can have significant consequences, such as over-imputing missing values or altering raw data in ways that distort reality. Be aware of the order of the steps you take, as they may influence each other. <br>
修改数据集可能会产生重大后果，如过度插补缺失值或以扭曲现实的方式更改原始数据。请注意你采取的步骤顺序，因为它们可能会相互影响。

#### 4.1.1 Typos
如何找到typos错误：
**Visual inspection 视觉检查** or using `pandas.unique`.
解决方式：
- Using `pandas.Series.str.replace`: `df["City"] = df["City"].str.replace("Asmterdam", "Amsterdam")`

其他调整方式：
- `pandas.Series.str.lower`
- `pandas.Series.str.upper`
- `pandas.Series.str.capitalize`

#### 4.1.2 Inconsistent Data Formats and Values 数据格式和值的不一致
解决方式：
1. Can be fixed using replacements and ensuring the correct data type is maintained (especially important for datetime formats). 可以通过替换确保维持正确的数据类型（特别是日期时间格式）来修正。
2. Recalculate or transform values for consistent units of measurement. 重新计算或转换值以保持测量单位的一致性。

#### 4.1.3 Duplicates
原因：
- Merge errors (e.g., merging without using keys). 合并错误（例如，未使用键进行合并）。
- Data entered multiple times. 数据被多次输入。

如何找到重复项：
- Visual inspection. 视觉检查。
- Using `df.duplicated()` and `df[df.duplicated()]`

解决方式：
- Using `df = df.drop_duplicates()`

#### 4.1.4 Missing Values
原因：
- Human input error during data collection. 在数据收集过程中人为输入错误。
- Failures in systems (e.g., a sensor not recording). 系统故障（例如，传感器未记录）。
- Omissions due to privacy concerns. 由于隐私问题而省略数据。

形式：
- **Missing Completely At Random (MCAR) 完全随机缺失**: No bias introduced. 未引入偏差。
- **Missing At Random (MAR) 随机缺失**: Bias introduced; related to other observed variables. 引入偏差；与其他已观察变量相关。
- **Missing Not At Random (MNAR) 非随机缺失**: Bias introduced; very difficult to adjust for. 引入偏差；非常难以调整。

识别：
- Visual inspection. 视觉检查。
- Using `pandas.DataFrame.isna` or its alias `pandas.DataFrame.isnull`.

解决：
- Removing or correcting errors (imputation). 移除或纠正错误（插补）。
    - If a column has >50% or >70% missing values, consider removing it. 如果某列的缺失值超过50%或70%，考虑移除它。
    - Remove rows with missing values that cannot be imputed using `pandas.DataFrame.dropna`. 移除无法插补的缺失值行
- Filling gaps with logical data: Mean imputation. Median imputation. 用逻辑数据填补空缺：平均数插补、中位数插补。
    - Using `pandas.DataFrame.fillna`, `numpy.median`, `numpy.mean`.

影响：
- Inflated counts. 膨胀计数。
- Incorrect aggregations and statistics. 不正确的汇总和统计。
- Introduced bias. 引入偏见。
- Reduced data size. 减少数据大小。

##### 4.1.4.1 Forward fill & Backward fill
Alternative method for handling missing data. 处理缺失数据的替代方法。<br>
Especially useful for data that has a useful order: Timeseries data, Sequential data 对于具有有用顺序的数据特别有用：时间序列数据、顺序数据<br>
You infer missing data from nearby observations 您从附近的观测值推断缺失数据<br><br>

**Forward Fill 正向填充**<br>
Missing values are replaced with the last observed value in the dataset 缺失值将替换为数据集中的最后一个观测值<br>
Works well when missing values are likely to have the same value as the previous observation. 当缺失值可能与前一个观测值具有相同的值时，这种方法效果很好。<br>
In a time-series dataset of daily temperatures, if one day’s temperature is missing, it can be filled with the previous day’s temperature 在每日温度的时间序列数据集中，如果某一天的温度缺失，可以用前一天的温度填充<br><br>

**Backward Fill 反向填充**<br>
Missing values are replaced with the next observed value in the dataset. 缺失值将替换为数据集中的下一个观测值。<br>
Useful when missing values are assumed to be similar to the next available observation. 当假设缺失值与下一个可用观测值相似时，这种方法很有用。<br>
In a dataset of product prices, if a price is missing for one day, it can be filled with the price from the following day. 在产品价格数据集中，如果某一天的价格缺失，可以用第二天的价格填充。<br><br>

**Forward fill & Backward fill – pros & cons 正向填充和反向填充 - 优点和缺点**<br>
**pros 优点:**<br>
Simple and intuitive to implement 简单直观<br>
Preserves trends and continuity in ordered dataset 保留有序数据集中的趋势和连续性<br>
Avoids introducing artificial averages (as mean/median imputation does) 避免引入人为平均值（如平均值/中位数插补）<br>
**cons 缺点:**<br>
Can propagate incorrect values if the assumption about continuity is invalid 如果连续性假设无效，则可能传播不正确的值<br>
Not suitable for unordered datasets or datasets with large gaps 不适用于无序数据集或具有较大间隙的数据集<br>
May lead to over-representation of certain values in datasets with frequently missing values 可能导致在经常缺失值的数据集中过度表示某些值<br><br>

Using `df.fillna(method='ffill')` for forward fill, can also choose the method from `'backfill', 'bfill', 'ffill' and the default 'None'`.

#### 4.1.5 Independence
Independence means that the outcome of one event is not influenced by the outcome of another event. 独立性意味着一个事件的结果不受另一个事件结果的影响。<br>
Two random variables are independent if the realization of one does not affect the probability distribution of the other. 如果一个随机变量的实现不会影响另一个随机变量的概率分布，则两个随机变量是独立的。<br>
Violations of independence can lead to biased models or overfitting. Some observations might unfairly influence results. 违反独立性可能导致模型有偏差或过度拟合。某些观察结果可能会不公平地影响结果。<br><br>

**Independence in machine learning – features (variables) 机器学习中的独立性 - 特征（变量）**<br>
Independence between features means that one feature does not predict another. 特征之间的独立性意味着一个特征不能预测另一个特征。<br>
When predicting house prices: number of bedrooms and house size are likely dependent. 预测房价时：卧室数量和房屋大小可能相互依赖。<br><br>

**Independence in machine learning – observations (rows) 机器学习中的独立性 - 观察值（行）**<br>
Independence between observations means that one data point does not affect another. 观察值之间的独立性意味着一个数据点不会影响另一个数据点。<br>
For customer churn: each customer's decision to leave or stay should be independent of other customers' decisions. 对于客户流失：每个客户离开或留下的决定应该独立于其他客户的决定。<br><br>

**Violations of independence 违反独立性**<br>
If duplicate rows exist in a dataset, they violate independence because they represent the same data point multiple times. 如果数据集中存在重复的行，则它们违反独立性，因为它们多次表示相同的数据点。<br>
If data points are grouped by a shared factor (e.g., location, family), they may not be independent. 如果数据点按共享因素（例如位置、家庭）分组，则它们可能不独立。

#### 4.1.6 Representativity
Representativity means that your dataset reflects the broader population or phenomenon you’re studying. 代表性意味着您的数据集反映了您正在研究的更广泛的人群或现象。<br>
If your data is not representative, your model won’t be able to generalize to new data (difference trainset-testset) 如果您的数据不具代表性，您的模型将无法推广到新数据（差异训练集-测试集）<br>
For example: voter preference of one city is not representative for the entire country. 例如：一个城市的选民偏好并不代表整个国家。<br><br>

Non-representative datasets can introduce bias, leading to incorrect or unfair conclusions. 非代表性数据集可能会引入偏见，导致不正确或不公平的结论。<br>
Representativity ensures that all relevant subgroups are included and accounted for in the analysis. 代表性确保所有相关子群体都包括在分析中并得到考虑。<br><br>

**Representativity– how to check 代表性——如何检查**<br>
Check for missing sub-groups - Are groups missing or underrepresented? 检查缺失的子群体 - 群体是否缺失或代表性不足？<br>
Compare dataset to population - Do the distributions of key features match? 将数据集与人口进行比较 - 关键特征的分布是否匹配？<br>
Check for selection bias - Was the data collected in a way that excludes certain groups? 检查选择偏差 - 数据收集的方式是否排除了某些群体？<br><br>

**Representativity– how to fix 代表性——如何解决**<br>
A lot of these issues are in the data collection phase that you don’t (always) control 很多这些问题都发生在数据收集阶段，而你（总是）无法控制<br>
Ensure proportional data collection 确保按比例收集数据<br>
Assign weights to underrepresented groups - Be careful with this, though 为代表性不足的群体分配权重 - 但要小心谨慎<br>
Adddata from underrepresented groups 添加代表性不足的群体的数据

## 5. Modeling
Models are representations of reality used to understand, predict, or control real-world phenomena. All models are approximations, usually with a trade-off between **Simplicity** and **Accuracy**. <br>
模型是用于理解、预测或控制现实世界现象的现实表征。所有模型都是近似值，通常在**简单性**与**准确性**之间需要权衡。

### 5.1 Machine Learning
- A machine learning model is a program that finds patterns or makes decisions from data it has never seen before. 机器学习模型是一个从未见过的数据中发现模式或做出决策的程序。
- It learns from historical data (**training**) and applies this knowledge to make predictions on new data (**testing**). 它从历史数据中学习（**训练**），并将这些知识应用于新数据的预测（**测试**）。
  - **Automates decision-making processes**. **自动化决策过程**。
  - Able to handle large and complex datasets. 能够处理大型和复杂的数据集。
  - Can be improved and can improve itself. 可以改进并自我提升。

#### 5.1.1 Types of Machine Learning
- **Supervised Learning 监督学习**: Uses labeled data where the target label is defined. 使用已定义目标标签的标记数据。
- **Unsupervised Learning 非监督学习**: Uses unlabeled data where the target label is not defined. 使用未定义目标标签的非标记数据。
- **Reinforcement Learning 强化学习**: The model rewards and punishes itself, thereby improving. 模型通过自我奖励和惩罚来改进。

#### 5.1.2 Neural Networks
- Inspired by the way our brain works (neurons, synapses). 灵感来源于我们大脑的工作方式（神经元、突触）。
- Input activates the connections in the layers. 输入激活层中的连接。
- Strength of signal is determined by the weight that changes during the training process. 信号的强度由训练过程中改变的权重决定。
- Usually involves multiple layers (-> deep learning). 通常涉及多个层（-> 深度学习）。
- Often considered a **black box model**, not explainable. 经常被视为**黑箱模型**，无法解释。

### 5.2 Regression Models 回归模型
- **Supervised machine learning technique 监督机器学习技术**.
- Predicts a continuous numerical value (target) based on input features. 根据输入特征预测连续的数值（目标）。
- Tries to find the relationship between the features and the target. 尝试找出特征与目标之间的关系。

### 5.3 Benchmark Models 基准模型
- A benchmark provides a baseline for more advanced models. 基准提供了一个给更高级模型的基线。
- Simple. 简单。Interpretable. 可解释。  

### 5.5 Training & Testing 训练与测试
模型的质量取决于在**训练集-测试集划分**（test-train split）后的表现。

- 数据需要分为 **训练集（train set）** 和 **测试集（test set）**（Data needs to be split into a train set and a test set）。  
  - **训练数据**（Train data）用于帮助发现正确的模式（helps discover the right patterns）。  
  - **测试数据**（Test data）用于检查模型是否能泛化到新的、未见过的数据（checks if the model can generalize to new, never-seen-before data）。  

- 常见的**训练-测试集划分比例**（Common splits）：**70%-30%** 或 **80%-20%**（train-test）。  

- **在训练集上测试时，评估指标通常优于测试集**（Evaluation metrics tend to be better when testing the model on the train set than on the test set）。

### 5.6 Correlation Analysis 相关性分析
Correlation analysis: measuring relationships between variables 测量变量之间的关系

#### 5.6.1 相关性基础
Correlation: describes relationships in historical data 描述历史数据中的关系<br>
Correlation $\neq$ Causation 相关性 $\neq$ 因果关系<br>
Visualization techniques for relationships (scatter plot, correlation matrix, heatmap,...) 关系的可视化技术（散点图、相关矩阵、热图等）

#### 5.6.2 相关性类型
Pearson vs. Spearman correlation 皮尔逊与斯皮尔曼相关性<br>
Statistical significance 统计显著性

#### 5.6.3 相关性与预测
Prediction: uses relationships to forecast new outcomes 预测：利用关系预测新结果<br>
Connection between correlation and model performance 相关性与模型性能之间的联系：<br>
Features highly correlated with target $\rightarrow$ potentially good predictors 与目标高度相关的特征 $\rightarrow$ 可能是良好的预测因子<br>
Features with low correlation $\rightarrow$ potentially less useful 低相关性的特征 $\rightarrow$ 可能用处较小<br>
Highly correlated features $\rightarrow$ potential redundancy 高度相关的特征 $\rightarrow$ 可能存在冗余
Redundant features 冗余特征

### 5.7 Linear Regression 线性回归
#### 5.7.1 基本概念
Predicts continuous target variables 预测连续的目标变量<br>
Models linear relationship between features and target 建模特征与目标之间的线性关系<br>
Goal: Find coefficients that minimize prediction error 目标：找到使预测误差最小的系数

#### 5.7.2 普通最小二乘法 (Ordinary Least Squares, OLS)
Minimizes sum of squared differences between actual and predicted values 最小化实际值与预测值之间的平方差之和<br>
Formula 公式: minimize $\Sigma\left(y_i-y_i\right)^2$<br>
LinearRegression fits a linear model with coefficients $w=(w 1, \ldots, w p)$ to minimize the residual sum of squares between the observed targets in the dataset, and the targets predicted by the linear approximation. 线性回归通过系数 $w=(w 1, \ldots, w p)$ 拟合线性模型，以最小化数据集中观测目标与线性近似预测目标之间的残差平方和。

#### 5.7.3 假设 (Assumptions)
Linearity: Relationship between features and target is linear 线性：特征与目标之间的关系是线性的<br>
Independence: Observations are independent of each other 独立性：观测值之间相互独立<br>
No multicollinearity: Features are not highly correlated with each other 无多重共线性：特征之间没有高度相关性<br>
No outliers: Extreme values can disproportionately influence the model 无异常值：极端值不会对模型产生不成比例的影响<br><br>

Additionally: there are more ways to check for these assumptions 另外：有更多方法可以检查这些假设<br><br>

Linear data: points should align closely with the regression line 线性数据：数据点应与回归线密切对齐<br>
Non-linear data: points show a (non-)pattern that the linear model fails to capture 非线性数据：数据点显示线性模型无法捕捉的（非）模式

#### 5.7.4 实现步骤 (How to Implement)
Don't forget the test-train split! 不要忘记测试-训练拆分！<br>
Set the model to the LinearRegression model 将模型设置为线性回归模型<br>
Fit the model to the train data using model.fit 使用 model.fit 将模型拟合到训练数据<br>
Create the predictions for the test set using model.predict 使用 model.predict 为测试集创建预测<br>
Evaluate using appropriate metrics 使用适当的指标进行评估

```python
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error, mean_absolute_error

X_train, X_test, y_train, y_test = train_test_split(x, y, test_size=0.2, random_state=10)
model = LinearRegression()
model.fit(X_train, y_train)
y_pred = model.predict(X_test)

mae = mean_absolute_error(y_test, y_pred)
mse = mean_squared_error(y_test, y_pred)
rmse = np.sqrt(mse)
```

#### 5.7.5 评估指标 - $R^2$ (Coefficient of Determination)
The coefficient of determination $\left(R^2\right)$ 决定系数 $\left(R^2\right)$<br>
Measures how well the model explains the variance in the target 测量模型解释目标方差的程度<br>
Values range from 0 to $1(0%-100%)$ 值范围从0到1（0%-100%）<br>
$\mathrm{R}^2=0.7$ means model explains $70%$ of variance in target 表示模型解释了目标70%的方差<br>
Higher $\mathrm{R}^2$ indicates better fit 更高的 $\mathrm{R}^2$ 表示更好的拟合<br>
In a simple regression with 1 regressor 在只有一个回归变量的简单回归中, $\mathrm{R}^2=$ (Pearson $\mathrm{r})^2$ You can directly compare $\mathrm{R}^2$ between models, however RMSE and MAE may give different information about model quality with regards to the errors that it makes. 你可以直接比较模型之间的 $\mathrm{R}^2$，然而 RMSE 和 MAE 可能会提供关于模型质量的不同信息，涉及它所产生的误差。<br>
$\mathrm{R}^2$ does not tell us anything about significance of coefficients 无法告诉我们关于系数显著性的任何信息<br>
from sklearn.metrics import r2_score 从 sklearn.metrics 导入 r2_score

#### 5.7.6 特征重要性 (Feature Importance)
$\beta_0, \beta_1, \beta_2, \ldots, \beta_n$ : coefficients 系数<br>
positive $=$ feature increases target 正数 $=$ 特征增加目标值<br>
negative $=$ feature decreases target 负数 $=$ 特征减少目标值<br>
larger magnitude $=$ stronger effect 更大的幅度 $=$ 更强的效果<br>
Feature importance: How "important" is each feature in making the prediction? A standardized coefficients for comparison 特征重要性：每个特征在预测中的“重要性”如何？标准化系数用于比较

#### 5.7.7 优化 (Optimization)
Feature selection techniques 特征选择技术：<br>
Based on correlation analysis 基于相关性分析<br>
Forward/backward selection 前向/后向选择<br><br>

Handling multicollinearity 处理多重共线性：<br>
Remove highly correlated features 移除高度相关的特征<br><br>

Feature engineering 特征工程：<br>
Transformations for non-linear relationships 非线性关系的变换

#### 5.7.8 交叉验证 (Cross-validation)
Cross-validation helps assess how well our model generalizes to new data 交叉验证帮助评估我们的模型在新数据上的泛化能力<br>
K-FOLD CROSS VALIDATION K折交叉验证

### 5.8 Decision Tree 决策树
#### 5.8.1 决策树分类器 (Decision Tree Classifier)
Decision Tree Classifier 决策树分类器<br>
Classification trees makes predictions for your output, based on the feature thresholds 分类树根据特征阈值对输出进行预测<br>
Non-linear model that splits the data based on their values 非线性模型，根据数据值分割数据<br>
IF-THEN rules determine the predictions 规则决定预测<br>
Easy to understand and interpret 易于理解和解释<br>
No data distribution assumptions 无需数据分布假设<br>
Features can be numerical and categorical 特征可以是数值型和类别型<br>
Does the feature selection for you 为你进行特征选择<br>
A Decision Tree Regressor can be used for regression problems 决策树回归器可用于回归问题

#### 5.8.2 分类树的工作原理
Classification trees predict categorical outcomes 分类树预测类别结果<br>
Binary classification: Yes/No, True/False decisions 二元分类：是/否、真/假决策<br>
Multi-class classification: more than two categories 多类分类：超过两个类别<br>
The splits happen based on gini impurity (measuring node purity) or entropy (information gain) 分割基于吉尼不纯度（测量节点纯度）或熵（信息增益）<br><br>

Tree growth algorithm 树生长算法：<br>
Select best feature + threshold to split on (maximize information gain) 选择最佳特征和阈值进行分割（最大化信息增益）<br>
Create child nodes based on split 根据分割创建子节点<br>
Recursively repeat for each child node 对每个子节点递归重复<br>
Stop when criteria met (e.g. max depth met) 当满足停止条件时停止（例如达到最大深度）<br><br>

Gini impurity measures how often a randomly chosen element of a set would be incorrectly labeled if it were labeled randomly and independently according to the distribution of labels in the set. 吉尼不纯度测量如果根据集合中标签分布随机且独立地标记，一个随机选择的元素被错误标记的频率。<br>
When all nodes fall into one target category, Gini impurity reaches 0. 当所有节点落入一个目标类别时，吉尼不纯度达到0。<br>
Entropy measures the information gain from a split, based on information theory. 熵根据信息理论测量分割的信息增益。<br>
Both aim to create child nodes with more homogeneous class distributions than the parent, so the node becomes more specific. 两者都旨在创建比父节点更均匀的类别分布的子节点，使节点更具体。

#### 5.8.3 实现步骤 (How to Implement)
```python
from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix
import matplotlib.pyplot as plt
from sklearn.tree import plot_tree

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=11)
model = DecisionTreeClassifier(random_state=10)
model.fit(X_train, y_train)
y_pred = model.predict(X_test)

print(accuracy_score(y_test, y_pred))
print(classification_report(y_test, y_pred))
print(confusion_matrix(y_test, y_pred))

plt.figure(figsize=(15,10))
plot_tree(model, feature_names=COLUMNS, class_names=["Class_A", "Class_B"], filled=True, max_depth=3)
plt.show()
```

#### 5.8.4 过拟合问题 (Overfitting)
Overfitting: model learns training data too well, including noise 过拟合：模型过于学习训练数据，包括噪声<br><br>

Signs of overfitting 过拟合的迹象：<br>
High training accuracy, low test accuracy 高训练准确度，低测试准确度<br>
Excessively complex tree structure 过于复杂的树结构<br>
Perfect predictions on training data 在训练数据上完美预测<br><br>

Consequences 后果：<br>
Poor generalization to new data (train test difference) 对新数据的泛化能力差（训练测试差异）<br>
Unstable predictions (small change in input -> large change in output) 不稳定的预测（输入的小变化 -> 输出的巨大变化）<br>
Lack of model robustness (does not work in real-life) 缺乏模型鲁棒性（在现实生活中不起作用）<br><br>

Why it happens in decision trees 为什么在决策树中发生：<br>
The tree is too deep (too many splits, too many rules) 树太深（太多分割，太多规则）<br>
Leaf nodes have few samples (not enough data for predictions) 叶节点样本太少（预测数据不足）<br>
Data is very noisy (causing random splits, instead of true patterns) 数据噪声很大（导致随机分割，而不是真实模式）

#### 5.8.5 防止过拟合 (Preventing Overfitting)
Stop the tree from growing by setting parameters, such as 通过设置参数阻止树生长，例如：<br>
max_depth 最大深度<br>
min_samples_split 最小分割样本数<br>
max_features 最大特征数<br>
min_samples_leaf 最小叶节点样本数<br><br>

This way, we are preventing splits in order to control model complexity to improve generalization 这样，我们通过防止分割来控制模型复杂性以提高泛化能力<br>
Cross-validation can find you the optimal parameters to balance performance and complexity. 交叉验证可以为你找到平衡性能和复杂性的最佳参数。<br>
This is also called hyper-parameter tuning. 这也称为超参数调优。<br>

```python
from sklearn.tree import DecisionTreeClassifier
from sklearn.model_selection import GridSearchCV
from sklearn.metrics import accuracy_score

param_grid = {
    'max_depth': [3, 5, 10, 12],
    'min_samples_split': [2, 5, 8],
    'min_samples_leaf': [1, 2, 4]
}

model = DecisionTreeClassifier(random_state=10)
grid_search = GridSearchCV(model, param_grid, cv=5, scoring='accuracy', n_jobs=-1)
grid_search.fit(X_train, y_train)

best_params = grid_search.best_params_
best_model = grid_search.best_estimator_
y_pred = best_model.predict(X_test)
test_accuracy = accuracy_score(y_test, y_pred)
```

### 5.9 Model Selection and Optimization 模型选择与优化
#### 5.9.1 选择依据
Choose based on the 'data science question' 根据“数据科学问题”选择<br>
Choose model based on data understanding insights 根据数据理解洞察选择模型<br>
Consider features and parameters based on data understanding insights and business needs 根据数据理解洞察和业务需求考虑特征和参数<br>
Evaluate properly using relevant and different metrics, as they provide different perspectives 使用相关且不同的指标进行适当评估，因为它们提供不同视角

#### 5.9.2 线性回归 vs 决策树
**Linear Regression 线性回归**<br>
When? Continuous data, linear relationship, coefficients are interesting 什么时候用？连续数据、线性关系、系数有意义时<br><br>

Pros 优点<br>
Interpretable & understandable 可解释且易于理解<br>
Efficient 高效<br>
Works fairly well with limited data 在数据有限时表现尚可<br><br>

Cons 缺点<br>
Assumes linearity 假设线性<br>
Cannot properly capture complex patterns 无法正确捕捉复杂模式<br>
Sensitive to outliers 对异常值敏感<br><br>

**Decision Tree 决策树**<br>
When? Non-linear relationship, categorical data, decision rules are interesting 什么时候用？非线性关系、类别数据、决策规则有意义时<br><br>

Pros 优点<br>
Interpretable & understandable 可解释且易于理解<br>
Handles non-linearity 处理非线性<br>
Feature interaction is incorporated 包含特征交互<br><br>

Cons 缺点<br>
Risk of overfitting 过拟合风险<br>
Small changes in data can have big effects 数据的小变化可能产生大影响

## 6. Evaluation 评估
1. **评估模型性能**（Assess model performance）。  
2. **解释结果**（Interpretation of results）。  
3. **识别模型的局限性**（Identify limitations of the model）。  
4. **确定下一步**（Determining next steps）。  

**关键问题**：
- **是否达到了业务目标？**（Did you meet the business objectives?）  
- **模型的结果如何帮助业务目标？**（How does the model (result) add to the business objective?）  
- **是否达到了数据挖掘目标？**（Did you meet the data mining goals?）  
- **模型存在哪些类型的误差？**（What types of errors does the model make?）  
- **误差是否均匀分布，还是存在特定模式？（例如低估高值）**（Are all errors “the same” or are there specific patterns (e.g. underestimating high values)）  
- **哪些因素可能影响模型表现？**（What might be (negatively) influencing the performance of the model?）  
  - 例如：**数据质量问题、缺失数据/特征、模型过于简单**（E.g. data quality issues, missing data/features, simplistic model）。  
- **模型是否能泛化训练数据中的模式到测试数据？**（Was the model able to generalize patterns from training data to test data?）  
- **训练集与测试集的表现是否有较大差异？**（Is there a big difference between train performance and test performance?）  
  - 若是，**可能存在过拟合（overfitting）**（If so… might the model be overfitted?）。  
- **模型结果的主要洞见是什么？**（What are the key insights from the model results?）。  
- **下一步应该做什么？**（What should be done next?）。  
  - **进一步优化**（Further refinement）。  
  - **部署建议**（Recommendations for deployment）。

### 6.1 Metrics 指标
#### 6.1.1 MAE & MSE & RMSE
**Metrics**（指标）用于衡量模型的性能。

- **Mean Absolute Error (MAE) 平均绝对误差**  
  - **适用于回归模型的评估指标**（An metric for regression models）。  
  - 计算方法：实际值与预测值之间**绝对误差的平均值**（The average of the absolute differences between the actual values and the predicted values）。  
  - **特点**：MAE 对所有误差给予相同的权重（MAE treats all errors equally）。

- **Mean Squared Error (MSE) 均方误差**  
  - 与 MAE 不同，MSE 计算的是**误差的平方**（Instead of taking the absolute error, you take the squared error）。  
  - **特点**：较大的误差在平方后变得更大，因此 MSE 会**惩罚较大的误差**（MSE punishes larger errors more when that is important）。

- **Root Mean Squared Error (RMSE) 均方根误差**  
  - RMSE 是 MSE 的平方根，能够更直观地表示误差的实际大小。

#### 6.1.2 Evaluating Classification Models
- True Positive (TP) 真阳性: Correctly predicted the positive class 正确预测了阳性类别
- True Negative (TN) 真阴性: Correctly predicted the negative class 正确预测了阴性类别
- False Positive (FP) 假阳性: Incorrectly predicted the positive class (Type I error) 错误预测了阳性类别（I 类错误）
- False Negative (FN) 假阴性: Incorrectly predicted the negative class (Type II error) 错误预测了阴性类别（II 类错误）

##### 6.1.2.1 Confusion Matrix 混淆矩阵
一般使用错误率（Error Rate）和准确率（Accuracy）作为评估指标（Evaluation Metrics）
|Metric|Description|
|--|--|
|Error Rate (misclassification rate) 错误率（误分类率）|The amount of errors made `(FN+FP) / total` and `1 - accuracy` 错误数量|
|Accuracy 准确率|The amount of times a correct prediction is made `(TP+TN) / total` and `1 - error rate` 正确预测的次数|
|True Positive Rate (TPR) [sensitivity, recall, hit rate] 真阳性率（TPR）[敏感度、召回率、命中率]|How many of the actual positive instances were correctly predicted? `TP / (TP + FN)` 实际正确预测了多少个阳性实例|
|True Negative Rate (TNR) [specificity, selectivity] 真阴性率（TNR）[特异性、选择性]|How many of the actual negative instances were correctly predicted? `TN / (TN + FP)` 实际正确预测了多少个阴性实例|
|Positive Predictive Value (PPV) [precision] 阳性预测值（PPV）[精确度]|How many of the positive predictions were actually positive? `TP / (TP + FP)` 阳性预测中有多少实际上是阳性|

<br>
<br>

**Sensitivity (Recall) 敏感度（召回率）vs Specificity 与特异性 vs Precision 准确率**
- Sensitivity 敏感度: how well do we detect positives (lower false negatives) 我们如何很好地检测阳性（较低的假阴性）
- Specificity 特异性: how well do we detect negatives (lower false positives) 我们如何很好地检测阴性（较低的假阳性）
- Precision 准确率: when the model says 'yes,' how often is it right 当模型说“是”时，它正确的频率是多少

<br>

Scenario 1 – High Precision 准确度高<br>
A fraud detection system flags 10 transactions, 9 of which are fraudulent. Precision = 90%. It misses 50 other fraudulent transactions (low recall).<br>
假设目前有100笔交易，欺诈系统只检测了10笔欺诈交易出来，但实际上有60笔，它漏掉了50笔，说明它是低敏感度，但是10笔中9笔都是真的欺诈交易，说明准确度很高。
<br>

Scenario 2 – High Recall 敏感度高<br>
<br>
癌症检测，100个案例中查出95个有癌症，说明它是高敏感度，但是其中很多误诊（false positives），说明它的准确度不高。
<br>

There is a tradeoff between precision and recall. You can adjust thresholds to favor one over the other. 准确率和召回率之间存在权衡。您可以调整阈值以偏向其中一个。

##### 6.1.2.2 F1 score
harmonic mean of precision and recall. Ranges from 0 to 1.0 (perfect). 准确率和召回率的调和平均值。范围从 0 到 1.0（完美）。<br>
公式：F1 = 2 * (Precision * Recall) / (Precision + Recall)

## 7. Classification & Merging 分类与合并
### 7.1 **Classification 分类**
- **分类（Classification）是一种监督学习（supervised machine learning）方法**。 
  - Binary classification 二元分类: 2 possible classes (spam/not spam, fraud detection, disease detection) 有两个可能的类别（垃圾邮件/非垃圾邮件、欺诈检测、疾病检测）
  - Multi-class classification 多类分类: >2 possible classes (types of fruit)
- **目标变量是分类变量（categorical），即标签类别或分类**（The target is categorical, a labeled class or category） 大于两个可能的类别（水果类型）

Classification algorithms attempt to find decision boundaries in the feature space that separate different classes.分类算法试图在特征空间中找到决策边界来区分不同的类别。<br>
Different algorithms create different types of boundaries, they all try to divide into regions for different classes.不同的算法会创建不同类型的边界，但它们都试图为不同的类别划分成不同类别的区域。<br>
A new data point gets its class predicted based on its position with regards to these boundaries.一个新的数据点会根据它在这些边界中的位置来预测其类别。

### 7.2 Classification vs. Regression
Regression models predict **continuous** values, using metrics like **MAE** and **MSE** for evaluation. 回归模型预测连续值，使用 MAE 和 MSE 等指标进行评估。<br>
Classification models predict **discrete** categories, requiring different evaluation methods. 分类模型预测离散类别，需要不同的评估方法。<br>
Regression: predicting house prices 预测房价<br>
Classification: predicting whether a house will sell above asking price 预测房屋是否会以高于要价的价格出售

### 7.3 **Merging 数据合并**
Pandas 提供类似 SQL 的合并功能。在合并数据集时，需要考虑两个关键点：
1. **要合并的列名**（The column name to merge on）：在两个数据集中必须是相同的标识符。  
2. **合并方式**（The way to merge）：`pandas.DataFrame.merge`。  

**四种常见的合并方式**：
- **Inner Join（内连接）**：仅保留两个数据集中匹配的行。  
- **Full Join（全连接）**：保留两个数据集中的所有行，未匹配的部分填充 NaN。  
- **Left Join（左连接）**：保留左侧数据集的所有行，并匹配右侧数据集中的数据。  
- **Right Join（右连接）**：保留右侧数据集的所有行，并匹配左侧数据集中的数据。

![四种合并方式](../img/four-types-of-merge.png)

### 7.4 Benchmark classification
Rule based model (IF-THEN) 基于规则的模型
- Explicit rules to classify instances 对实例进行分类的明确规则
- Often derived from domain knowledge or data analysis 通常来自领域知识或数据分析
- Follow an “if… then” principle, e.g. determining credit risk: 遵循 “如果......那么 ”原则，例如确定信用风险：
  - IF age < 18 THEN risk = "low“
  - IF age < 18 AND “student” THEN risk = "low“
- Easy to interpret, might not capture nuanced patterns 易于解释，可能无法捕捉到细微的模式

#### 7.4.1 Decision tree
Flowchart structure for decision making 决策流程图结构
- Nodes 节点 = features 特征
- Branches 分支 = feature values 特征值
- Leaves 叶 = predictions 预测
Use nested if-else statements 使用嵌套的 if-else 语句

![Decision Tree](../img/decision-tree.png)

#### 7.4.2 Building rule-based models
1. Identify key predictive features (data understanding!) 确定关键预测特征（了解数据！）
2. Determine thresholds or conditions 确定阈值或条件
3. Create IF-THEN rules 创建 IF-THEN 规则
4. Combine rules (if needed/useful) 合并规则（如需要/有用）
<br><br>

- Ensure data quality issues have been tackled 确保数据质量问题得到解决
- Check for possible rules based on data analysis/business logic (Document them + justification) 检查基于数据分析/业务逻辑的可能规则(记录这些规则并说明理由)
- When trying out different/multiple rules: track improvement using metrics 尝试不同/多个规则时：使用指标跟踪改进情况
- Use if-else statements for rule-based banchmark models 对基于规则的标记模型使用 if-else 语句
- Use nested if-else statements for decision tree benchmark models 对决策树基准模型使用嵌套的 if-else 语句

### 8 **Visualization 可视化**
可视化的作用：
- **揭示模式、趋势和相关性**（Reveal patterns, trends, and correlations）。  
- **对大型数据集进行可视化总结**（Visually summarize large datasets）。  
- **识别异常值或离群点**（Identify outliers or anomalies）。  
- **有效传达研究发现**（Help communicate findings effectively）。  

### 8.1 常见图表
**直方图（Histogram）**
- **用于显示数值数据的分布**（Used to show the distribution of numerical data）。  
- **数据被分到不同的区间（Bins）**（Data is grouped into intervals (bins)）。  
- **每个柱子代表该区间内的数据数量（频率）**（Each bar represents the frequency of data within that range）。  
- **X 轴表示数值区间，Y 轴表示数据点的数量**（X-axis represents value ranges, Y-axis represents the count of data points）。 

**条形图（Bar Plot）**
- **用于比较类别数据的数值大小**（Compare categorical data based on numeric values）。  
- **可视化计数或均值**（Visualizing counts or averages）。  
- **不同于直方图（Histogram）**（Not to be mistaken with a histogram）。  
<br>

**直方图 vs. 条形图**
| 特性        | 直方图（Histogram） | 条形图（Bar Plot） |
|------------|--------------------|-------------------|
| **数据类型** | 数值数据（Numerical Data） | 分类数据（Categorical Data） |
| **X 轴**    | 数值区间（Bins）     | 不同类别（Categories） |
| **柱子间隔** | **无间隔**（连续）    | **有间隔**（分离） |
| **用途**    | 数据分布、频率分析   | 类别数据比较 |

<br>
<br>

**散点图（Scatter Plot）**
- **展示两个数值变量之间的关系**（Shows relationship between 2 numerical variables）。  
- **数据点在网格上绘制**（Plot the data points on a grid）。  
- **用于识别相关性、聚类或趋势**（Identifying correlations, clusters, or trends）。  
- **显示多个变量如何一起变化**（Shows how multiple variables move together）。  
- **每个轴代表一个变量**（Each axis represents a variable）。  
- **适用于成对的数值数据**（Ideal for paired numerical values）。  
- **依赖变量通常放在 Y 轴（目标值）**（Dependent variable on Y-axis (the target)）。  

**折线图（Line Graph）**
- **用于可视化时间趋势或有序类别**（Visualize trends over time or ordered categories）。  
- **适用于跟踪变化**（Used for tracking changes）。  
- **适用于比较不同数据集**（Used for making comparisons）。  
- **类似于散点图，但点是有序的（X 轴）**（Similar to a scatter plot, but the points are ordered (X-axis)）。  
- **通过线连接散点图中的数据点**（Connects the data points in a scatter plot using a line）。  
- **通常用于显示随时间变化的数据（X 轴 = 时间）**（Used to show data over time (X-axis = time)）。  
- **连接数据点，显示模式**（Connects datapoints, showing patterns）。  
- **如果数据点之间的线不代表真实数据，可能会产生误导**（May mislead if the line between datapoints does not represent actual data points）。  
