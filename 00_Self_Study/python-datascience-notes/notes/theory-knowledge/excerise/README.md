## 单选题
1. Which level of measurement includes a true zero point? <br>
    a. Nominal<br>
    b. Ordinal<br>
    <mark>c. Ratio</mark><br>
    d. Interval
> 哪种测量水平包含真正的零点？
>> 测量水平有四种：名义（Nominal）、顺序（Ordinal）、区间（Interval）、比率（Ratio）。<br>
>> 比率（Ratio） 具有“真正的零点”，即 0 代表完全不存在该属性。例如：身高、体重、收入，0 就代表没有这个东西。<br>
>> 区间（Interval） 没有真正的零点，例如温度（0°C 不是完全没有温度）。<br>
>> 名义（Nominal）和顺序（Ordinal） 只是分类，根本没有数值上的运算意义。
---
2. Continuous variables represent measurable qualities that can take any value within a range, including decimals or fractions.<br>
    a. True<br>
    b. False
> 连续变量可以取某个范围内的任何值，包括小数和分数。
>> 连续变量（Continuous Variables） 可以取任何数，包括 小数和分数，例如：身高 1.75m，体重 68.3kg，时间 2.5 小时。<br>
>> 离散变量（Discrete Variables） 只能取有限个数值（整数），例如：学生人数（1, 2, 3…）、骰子点数（1-6）。
---
3. In a positively skewed distribution, which of the following is true?<br>
    a. The mean, median, and mode are equal.<br>
    <mark>b. The mean is always greater than the median.</mark><br>
    c. The mode is always greater than the median.<br>
    d. The standard deviation equals the variance.
> 在正偏态（右偏）分布中，以下哪项正确？
>> 正偏态（Right-Skewed） 分布的特征是右侧尾部较长，即有一些很大的数值拉高了均值（Mean）。<br>
>> 中位数（Median） 是按顺序排列后中间的值，不受极端值影响太大。<br>
>> 众数（Mode） 是出现最多的值，一般在左侧。<br>
>> 关系是：众数 < 中位数 < 均值，所以均值比中位数大。
---
4. The interquartile range (IQR) is affected by extreme values in a dataset.<br>
    a. True<br>
    <mark>b. False</mark>
> 四分位距（IQR）是否受极端值影响？
>> IQR（Interquartile Range，四分位距）= Q3 - Q1，表示中间 50% 数据的范围。<br>
>> IQR 只看 Q1 和 Q3，不考虑最小值和最大值，所以不受极端值影响。<br>
>> 标准差（Standard Deviation）和均值（Mean） 才容易受极端值影响。
---
5. What is primary goal of supervised machine learning? <br>
    a. To evaluate models using benchmark metrics<br>
    <mark>b. To train algorithms using labeled datasets to make accurate predictions</mark><br>
    c. To learn through trial and error by maximizing rewards<br>
    d. To analyze unlabeled datasets and discover hidden patterns
> 监督学习的主要目标是什么？
>> 监督学习（Supervised Learning）是机器学习的一种，核心是用**带标签（labeled）**的数据训练模型，然后让模型学会预测新的数据。例如邮件分类（垃圾邮件 or 正常邮件），房价预测（输入房屋信息，输出房价）。<br>
>> 评估模型（evaluation） 是训练后的步骤，但不是主要目标。<br>
>> 通过试错学习（trial and error） 描述的是强化学习（Reinforcement Learning）。<br>
>> 分析无标签数据（unlabeled data） 描述的是无监督学习（Unsupervised Learning）。
---
6. Which of the following is an example of a regression task?<br>
    a. Grouping customers into clusters based on purchasing behavior<br>
    b. Predicting whether an email is spam or not spam<br>
    c. Classifying customer reviews as positive or negative<br>
    <mark>d. Forecasting next month's revenue for a company</mark>
> 以下哪个是回归（Regression）任务的例子？
>> 回归（Regression）任务 的目标是预测 连续值（Continuous Value），比如房价、收入、温度等。<br>
>> 分类（Classification）任务 预测的是 离散类别（如 Yes/No, 好/坏, A/B/C）。<br>
>> 其他选项：<br>
>> a. 根据购买行为对客户分组 → 这是聚类（Clustering），属于无监督学习。<br>
>> b. 预测邮件是否为垃圾邮件 → 只有两个类别（垃圾 or 非垃圾），属于分类（Classification）。<br>
>> c. 评价是否正面/负面 → 也是分类任务。

## 填空题
1. The CRISP-DM framework begins with <mark>Business</mark> understanding to define project objectives, followed by <mark>Data</mark> understanding to explore initial datasets. The <mark>Data Preparation</mark> phase involves cleaning and organizing data for analysis, while <mark>Modeling</mark> focuses on building predictive models.
> CRISP-DM 框架从 业务（Business） 理解开始，以定义项目目标，然后进行 数据（Data） 理解，探索初始数据集。数据准备（Data Preparation） 阶段涉及清理和整理数据，以便进行分析，而 建模（Modeling） 阶段则专注于构建预测模型。
---
2. A regression model predicts house prices with an MAE of €15000. If one house's true price is €250000, what can be the predicted price if the absolute error equals the MAE? 
    Answer: <mark>€235,000 or €265,000</mark>
> 已知 MAE（平均绝对误差）= €15,000，房屋真实价格 = €250,000，绝对误差 = MAE = €15,000。公式：预测价格=真实价格±误差，计算 250,000−15,000=235,000 和 250,000+15,000=265,000。所以，预测价格为：€235,000 或 €265,000。

## 简答题
1. What are the main differences between qualitative and quantitative data?<br>
    Answer: <mark>Qualitative data is descriptive information, while quantitative data shows numerical values.</mark>定性数据（Qualitative data） 是描述性信息，而 定量数据（Quantitative data） 表示数值信息。
---
2. What are two methods to calculate outliers in a dataset? Briefly describe each.<br>
    Answer: <mark>IQR focuses on the middle 50% of the data and ignores extreme values. Z-Score measures how many standard deviations a data point is from the mean.</mark>IQR（四分位距）方法 关注数据中间 50% 的范围，忽略极端值。Z-score 方法 计算数据点距离均值多少个标准差。
---
3. Define "benchmark model" and explain its purpose in machine learning.<br>
    Answer: <mark>A benchmark model is a simple, baseline model used for comparison in machine learning. It aims to set a performance standard and help evaluate whether more complex models provide meaningful improvements.</mark>基准模型是机器学习中的一个简单基线模型，用于对比更复杂的模型。它的目的是设定一个性能标准，以评估复杂模型是否真正有提升。
---