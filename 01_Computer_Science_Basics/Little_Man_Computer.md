# LMC - Little Man Computer
---
##### *The Little Man Computer (LMC) is an instructional model of a computer, created by Dr. Stuart Madnick in 1965... Check the [WIKI](https://en.wikipedia.org/wiki/Little_man_computer) link to learn more.*
---
## Instruction

Operation codes/ Numeric Code|Mnemonic Code|Instruction|Description
-|-|-|-
1xx|ADD|ADD|Add the contents of address xx to the accumulator.<br>Note: the contents of the address are not changed and the total cannot exceed 999.
2xx|SUB|SUBTRACT|Subtract the contents address xx from the accumulator.<br>Note: the contents of the address are not changed.<br>Note: If a subtract instruction causes negative results then a negative flag will be set so that BRP can be used properly.
3xx|STA|STORE|Store the contents of the accumulator to address xx.<br>Note: the contents of the accumulator are not changed.
5xx|LDA|LOAD|Load the contents of address xx onto the accumulator.<br>Note: the contents of the address are not changed.
6xx|BRA|BRANCH(unconditional)|Branch always: set the program counter to address xx.
7xx|BRZ|BRANCH IF ZERO(conditional)|Branch if zero: if the contents of the accumulator are zero, set the program counter to address xx.
8xx|BRP|BRANCH IF POSITIVE(conditional)|Branch if zero or positive: if the contents of the accumulator are zero or positive (i.e. the negative flag is not set), set the program counter to address xx.
901|INP|INPUT|Input copies the value from the “in box” onto the accumulator.
902|OUT|OUTPUT|Output copies the value from the accumulator to the “out box”.<br>Note: the contents of the accumulator are not changed.
000|HLT|HALT/COFFEE BREAK|Stop the LMC simulator executing the program.
|	|DAT|DATA|Data storage reserves the memory address when this instruction is compiled.<br>Note: a value N can be stored at the memory address by using DAT N
---
## Activities
1. Write a program that accepts one input. The program must then count down from the input to 0.
   ```assembly
            INP
            OUT
    LOOP    BRZ QUIT
            SUB ONE
            OUT
            BRA LOOP
    QUIT    HLT
    ONE     DAT 1
   ```
2. Write a program that accepts two inputs and multiplies them with one another.
   ```assembly
            INP
            STA AD1
            STA AD3
            INP
            SUB ONE
            STA AD2
    LOOP    BRZ QUIT
            LDA AD1
            ADD AD3
            STA AD1
            LDA AD2
            SUB ONE
            STA AD2
            BRA LOOP
    QUIT    LDA AD1
            OUT
            HLT
    ONE     DAT 1
    AD1     FAT 0
    AD2     FAT 0
    AD3     FAT 0
   ```
3. Write a program that accepts two inputs and divides the first input by the second.
   ```assembly
            INP
            STA AD1
            INP
            STA AD2
    LOOP    BRZ QUIT
            LDA AD1
            SUB AD2
            STA AD1
            LDA COUNT
            ADD ONE
            STA COUNT
            LDA AD1
            BRA LOOP
    QUIT    LDA COUNT
            OUT
            HLT
    ONE     DAT 1
    COUNT   DAT 0
    AD1     DAT 0
    AD2     DAT 0
   ```
4. Write a program that accepts three inputs. The program must then count down from the first number to the second number by intervals of the third number.
   ```assembly
            INP
            STA AD1
            INP
            STA AD2
            INP
            STA AD3
    LOOP    LDA AD1
            SUB AD2
            BRP ISP
            HLT
    ISP     LDA AD1
            OUT
            SUB AD3
            STA AD1
            BRA LOOP
    AD1     DAT 0
    AD2     DAT 0
    AD3     DAT 0
    ISP     DAT 0
   ```