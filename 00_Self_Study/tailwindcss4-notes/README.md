Flexbox（一维布局）: flex-direction, flex-wrap, flex-grow, flex-shrink, flex-basis, justify-content（justify-start/center/end/between/around）, align-items, align-self, align-content, order, gap

Grid（二维布局）: grid, grid-template-columns, grid-template-rows, grid-column, grid-row, grid-auto-flow, grid-auto-columns, grid-auto-rows, gap, 对齐：justify-items, justify-content, align-items, align-content, place-items

Position（脱离文档流 / 精确定位）: relative, absolute, fixed, sticky, top / right / bottom / left, z-index

## 1. 文字排版 Typography

| 功能   | 类名示例                                                              |
| ---- | ----------------------------------------------------------------- |
| [字体](https://tailwindcss.com/docs/font-family)  | `font-sans` `font-serif` `font-mono`                              |
| [字重](https://tailwindcss.com/docs/font-weight)   | `font-thin` `font-extralight` `font-light` `font-normal` `font-medium` `font-semibold` `font-bold` `font-extrabold` `font-black`   |
| [字号](https://tailwindcss.com/docs/font-size)   | `text-xs` `text-sm` `text-base` `text-lg` `text-xl` `text-2xl` … `text-9xl` |
| [行高](https://tailwindcss.com/docs/line-height)   | `leading-none` …  |
| [字间距](https://tailwindcss.com/docs/letter-spacing)  | `tracking-tighter` `tracking-tight`  `tracking-normal` `tracking-wide` `tracking-wider` `tracking-widest`       |
| [文字对齐](https://tailwindcss.com/docs/text-align) | `text-left` `text-center` `text-right` `text-justify`             |
| [文字颜色](https://tailwindcss.com/docs/color) | `text-gray-700` `text-red-500`                                    |
| [装饰](https://tailwindcss.com/docs/text-decoration-line)   | `underline` `overline` `line-through`  `decoration-blue-500/100` `decoration-double` `decoration-4` `underline-offset-1` `uppercase` `lowercase` `capitalize`           |
| [列表](https://tailwindcss.com/docs/list-style-type) | `list-image-[url('./img/check.png')]` `list-inside` `list-outside` `list-disc` `list-decimal` `list-none`  |

## 2. 布局 Layout

| 功能  | 类名示例                                          |
| --- | --------------------------------------------- |
| 容器  | `container mx-auto`                           |
| 外边距 | `m-4` `mx-auto` `mt-2`                        |
| 内边距 | `p-4` `px-2` `py-6`                           |
| 宽高  | `w-1/2` `w-full` `w-screen` `h-16` `h-screen` |
| 边框  | `border` `border-2` `border-gray-300`         |
| 圆角  | `rounded` `rounded-lg` `rounded-full`         |

## 3. 布局 Flex

| 功能    | 类名示例                                                                |
| ----- | ------------------------------------------------------------------- |
| 容器    | `flex` `inline-flex`                                                |
| 方向    | `flex-row` `flex-col`                                               |
| 主轴对齐  | `justify-start` `justify-center` `justify-between` `justify-around` |
| 交叉轴对齐 | `items-start` `items-center` `items-end`                            |
| 子项对齐  | `self-start` `self-center`                                          |
| 间距    | `gap-2` `gap-4`                                                     |

## 4. 布局 Grid

| 功能 | 类名示例                                       |
| -- | ------------------------------------------ |
| 容器 | `grid`                                     |
| 列数 | `grid-cols-2` `grid-cols-3` `grid-cols-12` |
| 行数 | `grid-rows-2` `grid-rows-6`                |
| 间距 | `gap-2` `gap-x-4` `gap-y-6`                |
| 对齐 | `place-items-center`                       |

## 5. 响应式 & 伪类 Responsive & Variants

| 功能    | 类名示例                                    |
| ----- | --------------------------------------- |
| 响应式断点 | `sm:` `md:` `lg:` `xl:` `2xl:`          |
| 示例    | `sm:text-sm md:text-base lg:text-lg`    |
| 状态前缀  | `hover:` `focus:` `active:` `disabled:` |
