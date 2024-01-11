// remind user to input a name and use a variable to store it.
const userName = window.prompt("What is your name?");
document.write("Hello " + userName + ", ");

// remind user to input the duration in minutes and use a variable to store it.
const wholeDuration = window.prompt("Give the duration in minutes you want to convert.");
document.write("Your input was " + wholeDuration + " minutes.<br>");

// calculate the wholeDuration to hours and minutes, use two variables to store them.
const minutes = wholeDuration % 60;
const hours = (wholeDuration - minutes) / 60;

// output the converted result.
document.write("Output: " + hours + " hours and " + minutes + " minutes.");
