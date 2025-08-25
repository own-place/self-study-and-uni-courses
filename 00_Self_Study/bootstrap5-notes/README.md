# Bootstrap 5 Study Notes

**Check the Chinese version (中文版) of my notes [here](https://github.com/Teqden/bootstrap5-notes/tree/main/zh) .**<br><br>

These are my study notes from learning Bootstrap with the Bilibili video [Youjixian | 2021 Latest Complete Bootstrap Tutorial](https://www.bilibili.com/video/BV1TU4y1p7zU?spm_id_from=333.788.videopod.episodes&vd_source=1d1e1ee322fb5e86e15f95cb909ee1be). The tutorial uses Bootstrap 3, but I’m using Bootstrap 5, so many classes have been removed or changed. While learning, I also referred to the [Bootstrap Official Documentation](https://getbootstrap.com/docs/5.3/getting-started/introduction/) and [Bootstrap 5 Tutorial | Runoob](https://www.runoob.com/bootstrap5/bootstrap5-tutorial.html) to add some new content to my notes.

## 1. Preparation
### 1.1 Installation and Usage
Copy the entire `dist` folder from the downloaded Bootstrap source code into your project folder. Usually, you should rename this folder.

### 1.2 `<meta>` Attributes
- `viewport`: Controls whether users can zoom the page.
- `width`: Sets the logical width of the viewport. `device-width` matches the viewport width to the device’s screen width.
- `initial-scale`: Sets the initial zoom level of the web page. Setting it to 1.0 shows the web document without scaling.

### 1.3 Import Files
1. Below the `<title>` tag, import Bootstrap’s CSS:
2. At the bottom of the `<body>` tag, import Bootstrap’s JS components:
```html
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
```

## 2. Layout Containers
### 2.1 `.container` Fixed Width (With Padding on Both Sides)
```html
<div class="container" style="background-color: yellowgreen;height: 100px;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
```

### 2.2 `.container-fluid` Full Width (Takes Up Entire Viewport)
```html
<div class="container-fluid" style="background-color: yellowgreen;height: 100px;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
```

## 3. Grid System
### 3.1 Column Elements
Bootstrap divides the visible viewport into 12 columns by default. To achieve different layouts on different screen sizes (e.g., 4-8 split on medium screens, 6-6 on small screens), add the corresponding class names to the elements.
- `col-xs-value` (Extra small screens: phones (<768px))
- `col-sm-value` (Small screens: tablets (>=768px))
- `col-md-value` (Medium screens: computers (>=992px))
- `col-lg-value` (Large screens (>=1200px))

### 3.2 Column Combinations
The total number of columns cannot exceed 12. If it does, the extra columns will wrap to the next line.

### 3.3 Column Offset
When you don’t want two adjacent columns to touch but don’t want to use `margin`, you can use `offset-md-value` to shift columns. The total columns in a row must still be <=12, or they will wrap.
```html
<div class="row">
    <div class="col-md-1" style="background-color: aqua;">1</div>
    <div class="col-md-1 offset-md-1" style="background-color:bisque;">1</div>
    <div class="col-md-1 offset-md-2" style="background-color: aqua;">1</div>
    <div class="col-md-1 offset-md-3" style="background-color:bisque;">1</div>
</div>
```

### 3.4 Column Ordering
Change the direction of columns by floating them left or right with a set distance using `col-md-push-value (left)` and `col-md-push-value (right)`. When column A moves to column B’s position and B already has content, B’s content will be overlapped by A.

### 3.5 Nested Columns
You can add one or more row containers inside a column and then insert column elements into those rows.
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

## 4. Common Styles
### 4.1 Headings
Bootstrap modifies and overrides heading styles and provides `.h1` to `.h6` classes to style non-heading elements.
```html
<h1>Heading 1 <small>Subheading 1</small></h1>
<h2>Heading 2 <span class="small">Subheading 2</span></h2>
<div class="h1">Hello</div>
```

### 4.2 Paragraphs
- `<small>` / `.small`: Smaller text size
- `<b>` / `<strong>`: Bold text
- `<i>` / `<em>`: Italic text
- `.lead`: Highlights content by making text larger and bold, adjusting line height and margins
- `<mark>` / `.mark`: Highlights text
- `<del>` / `<s>` / `.text-decoration-line-through`: Strikethrough
- `<ins>` / `<u>` / `.text-decoration-underline`: Underline
```html
<p class="lead">Lorem <small class="text-decoration-line-through">ipsum</small> <mark>dolor</mark> sit <b class="text-decoration-underline">amet</b> consectetur <i>adipisicing</i> elit. <em>Nulla</em>, <strong>dolores</strong>?</p>
```

### 4.3 Emphasis
- `.text-muted`: Hint, uses light gray (#999)
- `.text-primary`: Primary, uses blue (#428bca)
- `.text-success`: Success, uses light green (#3c763d)
- `.text-info`: Info, uses light blue (#31708f)
- `.text-warning`: Warning, uses yellow (#8a6d3b)
- `.text-danger`: Danger, uses brown (#a94442)
```html
<div class="text-primary">Primary effect</div>
```

### 4.4 Alignment
In CSS, `text-align` is often used for text alignment, but Bootstrap uses four classes to control alignment:
- `.text-left`: Left-aligned
- `.text-center`: Center-aligned
- `.text-end`: Right-aligned
- `.text-justify`: Justified (removed in Bootstrap 5)
```html
<div class="text-center">Center aligned</div>
```

### 4.5 Lists
#### 4.5.1 Basic Lists
- Unordered list (`<ul><li>...</li></ul>`)
- Ordered list (`<ol><li>...</li></ol>`)
- Definition list (`<dl><dt>...</dt><dd>...</dd></dl>`)

#### 4.5.2 List Styles
- `.list-unstyled`: Removes bullets
```html
<ul class="list-unstyled">
    <li>Unstyled list item 1</li>
    <li>Unstyled list item 2</li>
    <li>Unstyled list item 3</li>
</ul>
```
- `.list-inline` and `.list-inline-item`: Inline list
```html
<ul class="list-inline">
    <li class="list-inline-item">Inline list item 1</li>
    <li class="list-inline-item">Inline list item 2</li>
    <li class="list-inline-item">Inline list item 3</li>
</ul>
```

### 4.6 Code
Commonly used on personal blogs to display code styles.
- `<code>`: Displays single-line inline code
- `<pre>`: Displays multi-line code blocks, preserving original formatting like spaces and line breaks
- `<kbd>`: Displays user input code, like shortcuts
```html
<code>This is a line of code</code>
<p>Please use <kbd>ctrl</kbd>+<kbd>s</kbd> to save</p>
```
To display HTML code, use character entities:
```html
<pre>
    <h2>Hello</h2>
</pre>
```
Add a scrollbar when content exceeds a certain length:
```html
<pre class="pre-scrollable">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum asperiores libero ipsa tempora iure, deserunt facere illo suscipit, molestiae beatae numquam in atque minus dicta quasi. Quisquam, accusamus! Minus, doloribus?
</pre>
```

### 4.7 Tables
- `.table`: Default style
- `.table-bordered`: Adds vertical borders
- `.table-striped`: Alternating row colors
- `.table-hover`: Highlights rows on hover

Use these classes on any table element (`table`, `tr`, `th`, `td`) to specify colors:
- `.table-primary`
- `.table-secondary`
- `.table-success`
- `.table-danger`
- `.table-warning`
- `.table-info`
- `.table-light`
- `.table-dark`

### 4.8 Forms
#### 4.8.1 Text Inputs and Textareas
- `.form-control`: Text input style
- `.form-control-lg` and `.form-control-sm`: Control sizes
```html
<input type="text" class="form-control" placeholder="Default input">
<input type="text" class="form-control form-control-lg" placeholder=".form-control-lg">

<textarea class="form-control"></textarea>
```

#### 4.8.2 Dropdowns
- `.form-select`: Dropdown style
- `.form-select-lg` and `.form-select-sm`: Control sizes
```html
<select class="form-select">
    <option selected>Please select a city</option>
    <option>Beijing</option>
    <option>Shanghai</option>
</select>
```

#### 4.8.3 Radio Buttons and Checkboxes
- `.form-check (vertical)` and `.form-check-inline (horizontal)`: Checkbox styles
- `.form-check-input` and `.form-check-label`: Component styles

Radio button example (`type="radio"`):
```html
<div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sex">
        <label class="form-check-label">Male</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sex">
        <label class="form-check-label">Female</label>
    </div>
</div>
```

Checkbox example (`type="checkbox"`):
```html
<div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobby">
        <label class="form-check-label">Singing</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="hobby">
        <label class="form-check-label">Dancing</label>
    </div>
</div>
```

#### 4.8.4 Buttons
Use the `btn` class to give button styles to other elements (like `<a>` or `<span>`).
- Base style: `.btn`
- Additional styles: `.btn-primary (blue)`, `.btn-info (cyan)`, `.btn-success (green)`, `.btn-warning (yellow)`, `.btn-danger (red)`, `.btn-link (link)`
- Button sizes: `.btn-sm (small)`, `.btn-lg (large)`
- Disable buttons: Add the `disabled` attribute
```html
<button class="btn btn-info" onclick="alert('Hello')" disabled>Button</button>
```

## 5. Plugins
### 5.1 Navigation and Navbar
`.nav`: Left-aligned navigation (default)
- Layout
    - `.justify-content-center`: Center-aligned navigation
    - `.justify-content-end`: Right-aligned navigation
    - `.flex-column`: Vertical navigation
    - `.nav-justified`: Makes navigation items equal width
    - `.navbar-expand-xxl|xl|lg|md|sm`: Creates a responsive navbar (horizontal on large screens, stacked on small screens)
    - Create a hamburger menu: Add `class="navbar-toggler"`, `data-bs-toggle="collapse"`, and `data-bs-target="#thetarget"` to a button. Then wrap navigation content (links) in a `div` with `class="collapse navbar-collapse"`, and set the `id` of the `div` to match the button’s `data-bs-target`.
- Styles
    - `.nav-tabs`: Turns navigation into tabs
    - `.nav-pills`: Makes navigation items pill-shaped
- Colors
    - `.bg-primary`, `.bg-success`, `.bg-info`, `.bg-warning`, `.bg-danger`, `.bg-secondary`, `.bg-dark`, `.bg-light`
    - Dark background (black with white text): `<nav class="navbar navbar-expand-sm bg-dark navbar-dark">...</nav>`
    - Light background (white with black text): `<nav class="navbar navbar-expand-sm bg-light navbar-light">...</nav>`
    - `.navbar-brand` highlights the brand/logo and adjusts images to fit the navbar
- Others
    - `.disabled`: Makes an item unselectable; use `.active` to mark selected items
    - `.navbar-text`: Styles non-link text in the navbar, ensuring alignment, color, and padding consistency
    - `.fixed-top` and `.fixed-bottom`: Fixes the navbar to the top or bottom
- Examples
```html
<!-- `.navbar-brand` highlights the brand/logo and adjusts images to fit the navbar.` -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">
        <img src="../img/default-img.jpg" alt="Logo" style="width:40px;">
        Logo
    </a>
    ...
</nav>
```
```html
<!-- Dynamic tabs -->
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
```html
<!-- Dropdown menu -->
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
```html
<!-- Navbar with hamburger menu -->
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

## Additional Tips
1. Type `!` and press `Enter` to auto-generate a basic HTML structure.
2. Type `.test` and press `Enter` to create a `<div>` with the `test` class; `#test` creates a `<div>` with the `id="test"`.
3. Type `lorem` and press `Enter` to generate filler text; `lorem3` generates three words, and `lorem*3` generates three paragraphs.