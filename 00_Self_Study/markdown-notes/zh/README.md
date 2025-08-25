# Markdown语法（VSCode版）

## 1. 准备
### 1.1 禅模式
在`视图 - 外观`中可以找到`zen mode`，打开可以让写作更沉浸。如需退出，双击`esc`键。

### 1.2 插件
在侧边栏点击`扩展`，在其中分别键入以下插件名，点击安装即可使用。
- Markdown All In One - by Yu Zhang
- Markdown Preview Enhanced - by Yiyi Wang
- Paste Image - by mushan
- Code Spell Checker - by Street Side Software
- Markdown PDF - by yzane

### 1.3 导出
在渲染界面空白处，`右键 - Chrome(Puppeteer)`即可。导出的文件，默认会存储在该文档所在的文件夹中。注：此功能来源于插件 `Markdown-PDF` 。

## 2. 标题
需要几级标题，就用几个 `#` 并空格。最多有六级。
```
# 这是一级标题
## 这是二级标题
### 这是三级标题
#### 这是四级标题
##### 这是五级标题
###### 这是六级标题
```
## 3. 分割线
使用三个 `-` 或 `*` 并回车，即可创建分割线。因前后文字格式不同，有时需要这两种方式替换使用。

## 4. 强调
### 4.1 粗/斜体
这是 *斜体* ，使用1个 `_` 或 `*` 将文字包起来，快捷键为 `command+i`。<br>
这是 **粗体**，使用2个 `_` 或 `*` 将文字包起来，快捷键为 `command+b`。<br>
这是 ___粗斜体___，使用3个 `_` 或 `*` 将文字包起来，没有快捷键。

### 4.2 删除线
这是 <S>删除线</S> ，使用 `<S></S>` 标签将文字包起来，没有快捷键。

### 4.3 下划线
这是 <u>下划线</u> ，使用` <u>和</u> `将文字包起来，没有快捷键。

### 4.4 高亮文本
这是 <mark>高亮文本</mark> ，使用 `<mark></mark>` 标签将文字包起来，没有快捷键。

### 4.5 文本颜色
按照格式输入 `<font color = 'colorname'>文字</font>`即可，颜色名称可参考 [HTML-Color-Names](https://htmlcolorcodes.com/color-names/)，使用方式与效果如下所示：
```python
<font color = 'silver'>灰色</font>
<font color = 'gray'>深灰色</font>
<font color = 'crimson'>红色</font>
<font color = 'darkorange'>橙色</font>
<font color = 'gold'>黄色</font>
<font color = 'mediumseagreen'>绿色</font>
<font color = 'dodgerblue'>蓝色</font>
<font color = 'mediumorchid'>紫色</font>
```
**效果展示：**<font color = 'silver'>灰色</font> 和 <font color = 'gray'>深灰色</font> 和 <font color = 'crimson'>红色</font> 和 <font color = 'darkorange'>橙色</font> 和 <font color = 'gold'>黄色</font> 和 <font color = 'mediumseagreen'>绿色</font> 和 <font color = 'dodgerblue'>蓝色</font> 和 <font color = 'mediumorchid'>紫色</font>。

## 5. 表格
### 5.1 创建表格
渲染之前表格不太好看，可以用快捷键 `option+shift+f` 对表格进行格式化。<br>
在表格中，`|` 、`-` 和 `:` 都必须是半角符号。<br>
需要文字向哪边对齐，就将 `:` 放在哪边；需要居中对齐时，左右各一个就好。
|       | 小红  | 小黄  | 小蓝  |
| :---: | :---: | :---: | :---: |
| 年龄  |  15   |  17   |  12   |
| 性别  |   F   |   F   |   M   |

### 5.2 插入表格
使用网页工具 [Tables-Generator](https://www.tablesgenerator.com/markdown_tables#)，可以将 word 或 excel 中的表格重新生成对应 Markdown 的表格。

## 6. 列表
### 6.1 项目列表（已失效）
<S> 在英文模式下输入`- [ ] `即可，注意`[]`中间要留一个空格。</S><br>
<S>- [ ] 这是一个未完成的项目</S><br>
<S>- [x] 这是一个已完成的项目</S>

### 6.2 无序列表
```
- 这里是无序列表。
    - 这里是无序列表的子列表。
- 这是一行新的无序列表。
```
- 这里是无序列表。
    - 这里是无序列表的子列表。
- 这是一行新的无序列表。

### 6.3 有序列表
```
1. 这里是一号有序列表。
    1. 第一个子列表。
    2. 第二个子列表。
2. 这里是二号有序列表。
```
1. 这里是一号有序列表。
    1. 第一个子列表。
    2. 第二个子列表。
2. 这里是二号有序列表。

## 7. 图片
网络图片：直接在网页 `右键 - 复制图片`，接着回到 VSCode 使用快捷键 `option+command+v` 进行粘贴。<br>
本地图片：先将本地图片复制到文档所在的文件夹中，接着键入 `![]()`，在 `（）` 中写入图片路径。
```
![img-name](path-to-your-img.png)
```
添加图片标题(Figure Caption)：转行后，输入两个 `*`，再在 `*` 号中间键入内容。

## 8. 代码
### 8.1 单行代码
使用两个点将 `单行代码` 包住。
```html
  `单行代码`
```

### 8.2 多行代码
使用三个点将多行代码包住。在三个点后直接输入名称，即可指定语言。指定语言后，代码块会在渲染时给予该语言特色高亮。
```html
  ``` 多行代码 ```
```
```python
print('Hello, world!')
```

## 9. 引用
### 9.1 脚注
英文输入法下，在需要脚注的文字后输入 `[^脚注序号] `，然后再在文档的末尾处重新输入 `[^脚注序号]: 解释文字`。
- 这是小猫咪的快乐老家[^1]。
- 这是小猫咪的心之所向[^2]。

### 9.2 嵌套
> 在这里可以进行一些文字的引用。
> >再输入一个 > 即可实现二层嵌套。
> > >还可以嵌套第三层喔。

### 9.3 链接
一般会使用语法 `[名称](网站地址)` 实现，但因有插件 `Markdown-All-In-One` 支持，只需将要嵌入链接的文字部分选中，然后 `command+v` 即可。<br>
比如，在这里贴上一个[B站](https://www.bilibili.com/)链接，点击即可访问。

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

[^1]:长满以鸡胸肉冻干为果实的树木的星球。
[^2]:价值三块二毛五的大纸箱。