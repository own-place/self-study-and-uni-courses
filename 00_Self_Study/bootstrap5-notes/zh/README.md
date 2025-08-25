<h1>Bootstrap5 学习笔记</h1>

这是我跟着 B 站视频 [优极限|2021最新完整版bootstrap教程](https://www.bilibili.com/video/BV1TU4y1p7zU?spm_id_from=333.788.videopod.episodes&vd_source=1d1e1ee322fb5e86e15f95cb909ee1be) 学习Bootstrap的学习笔记。教程中使用的是Bootstrap3老版本，而我现在使用的是Bootstrap5，因此很多类名都已被移除或修改。在学习过程中，我还参考着 [Bootstrap官方文档](https://getbootstrap.com/docs/5.3/getting-started/introduction/) 以及 [Bootstrap5教程|菜鸟教程](https://www.runoob.com/bootstrap5/bootstrap5-tutorial.html) ，为笔记添加了一些新的内容。

## 1. 准备
### 1.1 安装使用
将下载完毕的bootstrap源代码中的dist文件夹，整个复制到项目文件夹中，但一般需要重新命名此文件夹。

### 1.2 <meta>属性
- viewport：表示用户是否可以缩放页面
- width：视区的逻辑宽度，device-width：设定视区宽度为设备的屏幕宽度
- initial-scale：用于设置web页面的初始化缩放比例，设置其为1.0:显示未经缩放的web文档 

### 1.3 载入引入
1. 在title标签下，载入bootstrap的css：<br/>
```html
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
```
2. 在body标签中最下方，引入bootstrap的js组件：<br/>
```html
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
```

## 2. 布局容器
### 2.1 `.container` 固定宽度（两侧会有留白）
```html
<div class="container" style="background-color: yellowgreen;height: 100px;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
```

### 2.2 `.container-fluid` 100%宽度（占据全部视口）
```html
<div class="container-fluid" style="background-color: yellowgreen;height: 100px;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
```

## 3. 栅格网格系统
### 3.1 列元素
Bootstrap默认已将可见视口分为12列。如果在不同屏幕上需要不同的排列效果（如：中屏四八分，小屏六六分），可以在写元素时就加上对应的类名。
- col-xs-数值(超小屏：手机（<768px）)
- col-sm-数值(小屏：平板（>=768px）)
- col-md-数值(中屏：电脑（>=992px）)
- col-lg-数值(大屏（>=1200px）)

### 3.2 列组合
列的总数不能超过12，当超过12时，超出的部分会转行显示。

### 3.3 列偏移
当不希望相邻两个列紧靠在一起，但又不想使用margin来处理时，可以使用`offset-md-数值` 对列进行偏移，但一行中列的总数依然得<=12，否则将转行显示。<br/>
```html
<div class="row">
    <div class="col-md-1" style="background-color: aqua;">1</div>
    <div class="col-md-1 offset-md-1" style="background-color:bisque;">1</div>
    <div class="col-md-1 offset-md-2" style="background-color: aqua;">1</div>
    <div class="col-md-1 offset-md-3" style="background-color:bisque;">1</div>
</div>
```

### 3.4 列排序
改变列的方向使其左右浮动，并设置浮动距离，可通过 `col-md-push-数值（向左）` 和 `col-md-push-数值（向右）` 实现;当A移动到B列，而B列位置上本身有元素时，B列的元素会被A覆盖掉。

### 3.5 列嵌套
可以在一个列中继续添加一个或多个行容器，然后再在行容器中插入列元素。<br/>
```html
<div class="row">
            <div class="col-md-6" style="background-color: blue;">
                <div class="row">
                    <div class="col-md-1" style="background-color: chocolate;">1</div>
                    <div class="col-md-1" style="background-color:darkgreen;">1</div>
                    <div class="col-md-1" style="background-color: cornflowerblue;">1</div>
                    <div class="col-md-9" style="background-color:darkorchid;">9</div>
                </div>
            </div>
            <div class="col-md-6" style="background-color: brown;">6</div>
        </div>
```

## 4. 常用样式
### 4.1 标题
bootstrap对标题效果进行了修改并覆盖，并提供了.h1-.h6的对应类名，用以给非标题元素设置样式。
```html
<h1>标题1<small>副标题1</small></h1>
<h2>标题2<span class="small">副标题2</span></h2>
<div class="h1">你好</div>
```

### 4.2 段落
- `<small>` / `.small`：小字号
- `<b>` / `<strong>`：加粗
- `<i>` / `<em>`：斜体
- `.lead`：突出强调内容，增大加粗文本，并对其行高及margin作出相应处理 
- `<mark>` / `.mark`：高亮显示
- `<del>` / `<s>` / `.text-decoration-line-through`：删除线
- `<ins>` / `<u>` / `.text-decoration-underline`：下划线
<p class="lead">Lorem <small class=".text-decoration-line-through">ipsum</small> <mark>dolor</mark> sit <b class="text-decoration-underline">amet</b> consectetur <i>adipisicing</i> elit. <em>Nulla</em>, <strong>dolores</strong>?</p>

```html
    <p class="lead">Lorem <small class=".text-decoration-line-through">ipsum</small> <mark>dolor</mark> sit <b class="text-decoration-underline">amet</b> consectetur <i>adipisicing</i> elit. <em>Nulla</em>, <strong>dolores</strong>?</p>
```

### 4.3 强调
- `.text-muted`：提示，使用浅灰色（#999）
- `.text-primary`：主要，使用蓝色（#428bca）
- `.text-success`：成功，使用浅绿色（#3c763d）
- `.text-info`：通知信息，使用浅蓝色（#31708f）
- `.text-warning`：警告，使用黄色（#8a6d3b）
- `.text-danger`：危险，使用褐色（#a94442）
```html
<div class="text-primary">主要效果</div>
```

### 4.4 对齐
在css中常使用`text-align`实现文本的对齐，而bootstrap则通过四个类名控制文本的对齐风格：
- `.text-left`：左对齐
- `.text-center`：居中对齐
- `.text-end`：右对齐
- `.text-justify`：两端对齐（bootstrap5移除了text-justify类）
```html
    <div class="text-center">居中对齐</div>
```

### 4.5 列表
#### 4.5.1 普通列表
- 无序列表（`<ul><li>...</li></ul>`）
- 有序列表（`<ol><li>...</li></ol>`）
- 自定义列表（`<dl><dt>...</dt><dd>...</dd></dl>`）

#### 4.5.2 列表样式
- `.list-unstyled`：去点列表
```html
<ul class="list-unstyled">
    <li>去点列表选项1</li>
    <li>去点列表选项2</li>
    <li>去点列表选项3</li>
</ul>
```
- `.list-inline`和.`list-inline-item`：内联列表
```html
<ul class="list-inline">
    <li class="list-inline-item">内联列表选项1</li>
    <li class="list-inline-item">内联列表选项2</li>
    <li class="list-inline-item">内联列表选项3</li>
</ul>
```

### 4.6 代码
一般在个人博客上使用的比较频繁，用于显示代码风格。
- `<code>`：显示单行内联代码
- `<pre>`：显示多行代码块：代码会保留原本的格式，包括空格和换行
- `<kbd>`：显示用户输入代码，如快捷键
```html
<code>这是一行代码</code>
<p>请使用<kbd>ctrl</kbd>+<kbd>s</kbd>进行保存</p>
```
显示html代码需要使用字符实体
```html
<pre>
    &lt;h2&gt;你好&lt;/h2&gt;
</pre>
```
当长度超过指定值，可以添加滚动条
```html
<pre class="pre-scrollable">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum asperiores libero ipsa tempora iure, deserunt facere illo suscipit, molestiae beatae numquam in atque minus dicta quasi. Quisquam, accusamus! Minus, doloribus?
</pre>
```

### 4.7 表格
- `.table`：默认样式
- `.table-bordered`：加竖直方向的边框
- `.table-striped`：隔行换色
- `.table-hover`：悬浮高亮

对任意表格元素(table、tr、th、td)都可使用以下类来指定颜色：
- `.table-primary`
- `.table-secondary`
- `.table-success`
- `.table-danger`
- `.table-warning`
- `.table-info`
- `.table-light`
- `.table-dark`

### 4.8 表单
#### 4.8.1 文本框和文本域
- `.form-control`：文本框样式
- `.form-control-lg`和`.form-control-sm`：控件大小
```html
<input type="text" class="form-control" placeholder="Default input">
<input type="text" class="form-control form-control-lg" placeholder=".form-control-lg">

<textarea class="form-control"></textarea>
```

#### 4.8.2 下拉框
- `.form-select`：下拉框样式
- `.form-select-lg`和`form-select-sm`：控件大小
```html
<select class="form-select">
    <option selected>请选择城市</option>
    <option>北京</option>
    <option>上海</option>
</select>
```

#### 4.8.3 单选框和多选框
- `.form-check（竖直）`和`.form-check-inline（水平）`：复选框样式
- `.form-check-input`和`.form-check-label`：元件样式

单选框示例(`type="radio"`)：
```html
<div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sex">
        <label class="form-check-label">男</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sex">
        <label class="form-check-label">女</label>
    </div>
</div>
```

复选框示例(`type="checkbox"`)：
```html
<div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobby">
        <label class="form-check-label">唱歌</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobby">
        <label class="form-check-label">跳舞</label>
    </div>
</div>
```

#### 4.8.4 按钮
可通过btn类给其他元素设置按钮效果(如a标签、span标签)。
- 基础样式：`.btn`
- 附加样式：`.btn-primary（蓝）`、`.btn-info（青）`、`.btn-success（绿）`、`.btn-warning（黄）`、`.btn-danger（红）`、`.btn-link（链接）`
- 设置按钮大小：`.btn-sm（小）`、`.btn-lg（大）`
- 按钮禁用：在标签中添加`disabled`属性
```html
<button class="btn btn-info" onclick="alert('Hello')" disabled>按钮</button>
```

## 5. 插件
### 5.1 导航及导航栏
`.nav`：左对齐导航 (默认)
- 布局
    - `.justify-content-center`：居中对齐导航
    - `.justify-content-end`：右对齐导航
    - `.flex-column`：垂直导航
    - `.nav-justified`：设置导航项齐行等宽显示
    - `.navbar-expand-xxl|xl|lg|md|sm`：创建响应式的导航栏 (大屏幕水平铺开，小屏幕垂直堆叠)
    - 创建导航栏汉堡菜单：在按钮上添加 `class="navbar-toggler"`, `data-bs-toggle="collapse"` 与 `data-target="#thetarget"` 类，然后在设置了 `class="collapse navbar-collapse"` 类的 div 上包裹导航内容（链接）, div 元素上的 id 匹配按钮 `data-target` 的上指定的 id
- 样式
    - `.nav-tabs`：将导航转化为选项卡
    - `.nav-pills`：将导航项设置成胶囊形状
- 颜色
    - `.bg-primary`, `.bg-success`, `.bg-info`, `.bg-warning`, `.bg-danger`, `.bg-secondary`, `.bg-dark` 和 `.bg-light`
    - 暗色背景（黑底白字）：`<nav class="navbar navbar-expand-sm bg-dark navbar-dark">...</nav>`
    - 浅色背景（白底黑字）：`<nav class="navbar navbar-expand-sm bg-light navbar-light">...</nav>`
    - `.navbar-brand` 类用于高亮显示品牌/Logo，`.navbar-brand` 类设置图片自适应导航栏
- 其他
    - `.disabled`：设置为不可选；对于选中的选项使用 `.active` 类进行标记
    - `.navbar-text` 类来设置导航栏上非链接文本，可以保证水平对齐，颜色与内边距一样
    - `.fixed-top`和`.fixed-bottom`：使导航栏固定在头部或底部
- 示例
    - ```html
        <!-- .navbar-brand 类用于高亮显示品牌/Logo，.navbar-brand 类设置图片自适应导航栏。 -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="#">
                <img src="../img/default-img.jpg" alt="Logo" style="width:40px;">
                Logo
            </a>
            ...
        </nav>
        ```
    - ```html
        <!-- 动态选项卡 -->
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu1">Menu 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu2">Menu 2</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active container" id="home">1</div>
                <div class="tab-pane container" id="menu1">2</div>
                <div class="tab-pane container" id="menu2">3</div>
            </div>
        </div>
        ```
    - ```html
        <!-- 下拉菜单 -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="#">Logo</a>

            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link 2</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-bs-toggle="dropdown">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>
            </ul>
        </nav>
        ```
    - ```html
        <!-- 导航栏 汉堡菜单 -->
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="#">Navbar</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </nav>
        ```

## 补充：小技巧
1. 输入`!`然后敲击`enter`，可以自动生成基本的 html 结构
2. 直接输入`.test`然后敲击`enter`，可直接创建包含 test 类的 div 元素；`#test` 则是 id 为 test 的 div 元素
3. 直接输入`lorem`然后敲击`enter`，可生成填充性文档；输入`lorem3`可生成三个单词，输入`lorem*3`可生成三段话