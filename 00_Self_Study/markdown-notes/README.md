# Markdown Syntax (VSCode Version)
Check the Chinese version (中文版) of my notes [here](https://github.com/Teqden/markdown-notes/tree/main/zh) .

## 1. Preparation
### 1.1 Zen Mode
In `View - Appearance`, you can find `Zen Mode`. Enabling it makes writing more immersive. To exit, double-tap the `Esc` key.

### 1.2 Plugins
Click `Extensions` in the sidebar, type the following plugin names, and click install to use them.
- Markdown All In One - by Yu Zhang
- Markdown Preview Enhanced - by Yiyi Wang
- Paste Image - by mushan
- Code Spell Checker - by Street Side Software
- Markdown PDF - by yzane

### 1.3 Exporting
Right-click in the blank area of the preview interface and select `Chrome (Puppeteer)` to export. The exported file will be saved by default in the same folder as the document. Note: This feature comes from the `Markdown-PDF` plugin.

## 2. Headings
Use the number of `#` symbols followed by a space to indicate the heading level. There are up to six levels.
```
# This is a Level 1 Heading
## This is a Level 2 Heading
### This is a Level 3 Heading
#### This is a Level 4 Heading
##### This is a Level 5 Heading
###### This is a Level 6 Heading
```

## 3. Divider
Use three `-` or `*` symbols and press Enter to create a divider. Sometimes, you may need to switch between these two methods due to differing text formats around it.

## 4. Emphasis
### 4.1 Bold/Italic
This is *italic*, enclosed with one `_` or `*`, with the shortcut `Command+I`.  
This is **bold**, enclosed with two `_` or `*`, with the shortcut `Command+B`.  
This is ___bold italic___, enclosed with three `_` or `*`, with no shortcut.

### 4.2 Strikethrough
This is <S>strikethrough</S>, enclosed with `<S></S>` tags, with no shortcut.

### 4.3 Underline
This is <u>underline</u>, enclosed with `<u></u>` tags, with no shortcut.

### 4.4 Highlighted Text
This is <mark>highlighted text</mark>, enclosed with `<mark></mark>` tags, with no shortcut.

### 4.5 Text Color
Use the format `<font color='colorname'>text</font>` to set text color. Refer to [HTML-Color-Names](https://htmlcolorcodes.com/color-names/) for color names. Usage and effects are shown below:
```
<font color='silver'>Gray</font>
<font color='gray'>Dark Gray</font>
<font color='crimson'>Red</font>
<font color='darkorange'>Orange</font>
<font color='gold'>Yellow</font>
<font color='mediumseagreen'>Green</font>
<font color='dodgerblue'>Blue</font>
<font color='mediumorchid'>Purple</font>
```
**Effect Demonstration:** <font color='silver'>Gray</font> and <font color='gray'>Dark Gray</font> and <font color='crimson'>Red</font> and <font color='darkorange'>Orange</font> and <font color='gold'>Yellow</font> and <font color='mediumseagreen'>Green</font> and <font color='dodgerblue'>Blue</font> and <font color='mediumorchid'>Purple</font>.

## 5. Tables
### 5.1 Creating Tables
Tables may not look great before rendering; use the shortcut `Option+Shift+F` to format them.  
In tables, `|`, `-`, and `:` must be half-width symbols.  
To align text, place `:` on the desired side; for center alignment, use `:` on both sides.
|       | Xiao Hong | Xiao Huang | Xiao Lan |
|-------|-----------|------------|----------|
| Age   | 15        | 17         | 12       |
| Gender| F         | F          | M        |

### 5.2 Inserting Tables
Use the online tool [Tables-Generator](https://www.tablesgenerator.com/markdown_tables#) to convert tables from Word or Excel into Markdown format.

## 6. Lists
### 6.1 Task List (Deprecated)
<S>In English mode, type `- [ ]` with a space between `[]` to create a task list.</S>  
<S>- [ ] This is an incomplete task</S>  
<S>- [x] This is a completed task</S>

### 6.2 Unordered List
- This is an unordered list.
    - This is a sub-item of the unordered list.
- This is a new line in the unordered list.
```
- This is an unordered list.
    - This is a sub-item of the unordered list.
- This is a new line in the unordered list.
```

### 6.3 Ordered List
1. This is ordered list item 1.
    1. First sub-item.
    2. Second sub-item.
2. This is ordered list item 2.
```
1. This is ordered list item 1.
    1. First sub-item.
    2. Second sub-item.
2. This is ordered list item 2.
```

## 7. Images
For online images: Right-click on the web image, select `Copy Image`, then in VSCode, use the shortcut `Option+Command+V` to paste.  
For local images: Copy the image to the document’s folder, then type `[]()` and enter the image path in the `()`.  
```
![img-name](path-to-your-img.png)
```
To add a figure caption: On a new line, type two `*` symbols and write the caption between them.

## 8. Code
### 8.1 Single-Line Code
Enclose `single-line code` with two backticks.
```
`single-line code`
```

### 8.2 Multi-Line Code
Enclose multi-line code with three backticks. Specify the language right after the opening backticks for syntax highlighting in the rendered view.
```
    ```python

        print('Hello, world!')
        print('Hello, world!')
        print('Hello, world!')

    ```
```

## 9. References
### 9.1 Footnotes
In English mode, add `[^footnote-number]` after the text needing a footnote. Then, at the document’s end, type `[^footnote-number]: explanation text`.  
- This is the happy home of little kitties[^1].  
- This is the heart’s desire of little kitties[^2].

### 9.2 Nesting
> Here you can quote some text.
> > Add another `>` for a second-level nesting.
> > > You can even nest a third level.
```
> Here you can quote some text.
> > Add another `>` for a second-level nesting.
> > > You can even nest a third level.
```

### 9.3 Links
Typically, use the syntax `[name](URL)` to create links. However, with the `Markdown-All-In-One` plugin, just select the text and press `Command+V` to embed a copied link.  
For example, here’s a [Bilibili](https://www.bilibili.com/) link you can click to visit.

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

[^1]: A planet full of trees bearing freeze-dried chicken breast as fruit.<br>
[^2]: A big cardboard box worth three dollars and twenty-five cents.