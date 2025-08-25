# IPython 和 Jupter Notebook
IPython 是一个增强版的 Python 交互式解释器，提供更强大的功能。Jupyter Notebook 是一个基于 Web 的 交互式编程环境，它支持 Python 以及多种其他语言。Jupyter 运行 Python 代码时，实际上是调用了 IPython 内核。Jupyter Notebook 是一个界面，IPython 就是它在后台运行 Python 代码的引擎。

## 1. 单元格（cell）
### 1.1 单元格模式
- 命令模式：按下 `Esc` 进入命令模式（蓝色边框），可对整个单元格进行删除、新增、复制、粘贴、撤销等操作
- 编辑模式：按下 `Enter` 进入编辑模式（绿色边框），可在内部书写文本或代码

### 1.2 命令模式下可使用的快捷键
- `A`：在当前单元格上方插入新单元格
- `B`：在当前单元格下方插入新单元格
- `D（双击）`：删除当前单元格
- `C`：复制当前单元格
- `V`：粘贴当前单元格
- `Z`：撤销上一次的单元格操作
- `M`：将单元格转换为 Markdown 文本
- `Y`：将单元格转换为 代码

### 1.3 运行单元格
- `Shift + Enter`：运行当前单元格，并跳到下一个单元格（如果没有就新建一个）
- `Ctrl + Enter`：运行当前单元格，但不跳转到下一个单元格
- `Option + Enter`：运行当前单元格，并在下方新建一个单元格

## 2. 常用函数
`help()` 是一个内置函数，用于查看对象（函数、类、模块等）的文档。
```python
help(print)  # 查看 print() 函数的文档
help(list.append)  # 查看 list 的 append 方法
```
除了 `help()` 以外，IPython 和 Jupyter Notebook 还支持使用 `?` 查看帮助，以及使用 `??` 查看源码。
```python
print?  # 等价于 help(print)
print??  # 如果可能，会显示 print() 的源码
```
另外，还可以使用 Tab 自动补全。输入 `math.` 然后按 Tab，它会列出 `math模块` 下的所有函数；使用 `Shift + Tab` 可以查看代码提示（悬浮窗）。

# 其他
- 在使用jupter notebook时，不要关闭terminal后台进程