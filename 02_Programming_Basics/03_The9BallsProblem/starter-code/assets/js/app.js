// This array represents the weights of the 9 balls
const ballArray = [1, 1, 1, 1, 1, 1, 1, 1, 1];

// Ask for the oddball
const userChoose = window.prompt("Select the oddball [0-8]");

// Assign 1.2 to the oddball to make it be the heaviest
ballArray[userChoose] = 1.2;

// Fill the div with balls and display it on the screen
for(let i = 0; i < ballArray.length; i++){
  const ball = document.createElement("div");
  document.querySelector("#ball-list").appendChild(ball);
  ball.innerHTML = i;
  if(i == userChoose){
    ball.className = "ball column box m-4 has-background-primary";
  }else{
    ball.className = "ball column box m-4 has-background-primary-light";
  }
}

// Divide numbers to three parts and calculate the sum of each part 
const left = ballArray[0] + ballArray[1] + ballArray[2];
const right = ballArray[3] + ballArray[4] + ballArray[5];

// Fill the spans : Weighting 1
document.querySelector("#left-1").innerHTML = "[0, 1, 2]";
document.querySelector("#right-1").innerHTML = "[3, 4, 5]";

// Compare the weights of each part and reassign the value to oddArray
let oddArray = [];
if(left == right){
  document.querySelector("#result-1").innerHTML = "balanced";
  document.querySelector("#conclusion-1").innerHTML = "oddball must be in [6, 7, 8]";
  oddArray = [6, 7, 8];
}else if(left > right){
  document.querySelector("#result-1").innerHTML = "left is heavier";
  document.querySelector("#conclusion-1").innerHTML = "oddball must be in [0, 1, 2]";
  oddArray = [0, 1, 2];
}else{
  document.querySelector("#result-1").innerHTML = "right is heavier";
  document.querySelector("#conclusion-1").innerHTML = "oddball must be in [3, 4, 5]";
  oddArray = [3, 4, 5];
}

// Fill the spans : Weighting 2
document.querySelector("#left-2").innerHTML = "[" + oddArray[0] + "]";
document.querySelector("#right-2").innerHTML = "[" + oddArray[1] + "]";

// Collect all items from ball-list
const ballChildren = document.querySelector("#ball-list").children;

// Compare the weights of each ball
if(ballArray[oddArray[0]] == ballArray[oddArray[1]]){
  document.querySelector("#result-2").innerHTML = "balanced";
  document.querySelector("#conclusion-2").innerHTML = "oddball is [" + oddArray[2] + "]";
  // set a border to the heaviest ball
  ballChildren[oddArray[2]].className += " has-border-primary-dark";
}else if(ballArray[oddArray[0]] > ballArray[oddArray[1]]){
  document.querySelector("#result-2").innerHTML = "left is heavier";
  document.querySelector("#conclusion-2").innerHTML = "oddball is [" + oddArray[0] + "]";
  ballChildren[oddArray[0]].className += " has-border-primary-dark";
}else{
  document.querySelector("#result-2").innerHTML = "right is heavier";
  document.querySelector("#conclusion-2").innerHTML = "oddball is [" + oddArray[1] + "]";
  ballChildren[oddArray[1]].className += " has-border-primary-dark";
}