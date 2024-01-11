const racedata = fetchFormula1Data();

// 当网页加载时，运行init方法中的代码。 
window.addEventListener('load', init);

/**
 * 当网页加载时，运行这个方法中的代码。
 */
function init() {
  displayRacedata(racedata);
  displayFastest();
  displayOptions(racedata);
  document.getElementById('submit').addEventListener('click', addNewScores);
}

/**
 * 将racedata中的数组展示出来
 * @param {*} arr 将racedata作为参数传入
 */
function displayRacedata(arr) {
  for (let i = 0; i < arr.length; i++) {
    // 向Dom结构中添加一个新元素tr，并使用变量来存储它，以方便后期调用。
    const normalBox = document.createElement('tr');
    document.getElementById('laps').appendChild(normalBox);
    // 向Dom的tr中添加两个新元素th，分别是赛车手名字和每个人的比赛总用时。
    const driverName = document.createElement('th');
    driverName.innerHTML = arr[i].name;
    normalBox.appendChild(driverName);
    const totalRaceTimes = document.createElement('th');
    // 用sum分别累加每位赛车手的成绩，得到总用时。
    const sum = arr[i].laps.reduce(function (total, current) {
      return total + current;
    }, 0);
    // 调用convertTimeFormat方法，将每个赛车手的总用时转换为规定格式。
    totalRaceTimes.innerHTML = convertTimeFormat(sum);
    totalRaceTimes.className = 'time';
    normalBox.appendChild(totalRaceTimes);
  }
}

/**
 * 将可供选择的赛车手显示出来
 * @param {*} arr 将racedata传入
 */
function displayOptions(arr) {
  for (let i = 0; i < arr.length; i++) {
    const options = document.createElement('option');
    options.innerHTML = arr[i].name;
    options.value = arr[i].carNumber;
    document.getElementById('driver').appendChild(options);
  }
}

/**
 * 显示最快的赛车手名字以及他的最好单次成绩。
 */
function displayFastest() {
  // 调用findFastestLap方法可得到一个数组，里面存储着每个赛车手的名字以及他最好的成绩。
  const fastestData = findFastestLap(racedata);
  const theFastestDriver = fastestData[0].name;
  const theFastestLaps = fastestData[0].laps;
  // 向#fastest中添加两个新元素th，分别是目前成绩最好的赛车手名字，和他的单次(最快)用时。
  const fastestDriverName = document.createElement('th');
  document.getElementById('fastest').appendChild(fastestDriverName);
  fastestDriverName.innerHTML = theFastestDriver;
  const fastestTime = document.createElement('th');
  fastestTime.className = 'time';
  fastestTime.innerHTML = convertTimeFormat(theFastestLaps);
  document.getElementById('fastest').appendChild(fastestTime);
}

/**
 * 先依此找到每个选手的最快成绩，再按顺序写入数组，接着对数组重新排序，找到最快的成绩。
 * @param {*} arr 传入racebase作为参数
 * @returns 返回存储着最好成绩的对象
 */
function findFastestLap(arr) {
  // 初始化一个数组，用来存储各位选手的最好成绩。
  const fastestArr = [];
  for (let i = 0; i < arr.length; i++) {
    // 依此sort每个选手的用时数组，按用时多少重新排列。
    sortArr(arr[i].laps);
    // 初始化一个对象，将遍历所得到的结果作为属性写入对象中。
    const fastestObj = {};
    fastestObj.name = arr[i].name;
    fastestObj.laps = arr[i].laps[0];
    // 将写好属性的对象push到数组中。
    fastestArr.push(fastestObj);
  }
  // 将存储着最好成绩的对象返回。
  return sortObj(fastestArr);
}

/**
 * 这个方法能够对对象进行排序，可用它来找到对象中的最快成绩。
 * @param {*} obj 这里应该传入存储着最好成绩的对象
 * @returns 将将重新排好序的对象返回
 */
function sortObj(obj) {
  obj.sort(function (indexA, indexB) {
    return indexA.laps - indexB.laps;
  });
  return obj;
}

/**
 * 这个方法能够对数组进行排序，可用它来找到每个选手的最快成绩。
 * @param {*} arr 这里应该传入每个选手的用时数组racedata[i].laps
 * @returns 将重新排好序的数组返回
 */
function sortArr(arr) {
  arr.sort(function (indexA, indexB) {
    return indexA - indexB;
  });
  return arr;
}

/**
 * 将秒数转换为 m:s.000 的格式
 * @param {*} time 将一个总用时最为参数
 * @returns 直接返回转换好格式的总用时
 * toFixed方法可以让秒数后面再加三位小数
 */
function convertTimeFormat(time) {
  // 给的总时间为秒数
  const seconds = time % 60;
  const minutes = (time - seconds) / 60;
  if (minutes >= 1) {
    return `${minutes}:${addZero(seconds.toFixed(3))}`;
  } else {
    return `${seconds.toFixed(3)}`;
  }
}

/**
 * 传入一个需要辨认是否加0的时间，如果位数不足6位，就会自动加0。
 * @param {*} aTime 传入一个时间作为参数
 * @returns 返回一个补过或不需要补的时间
 */
function addZero(aTime) {
  return aTime = aTime.toString().padStart(6, "0");
}

/**
 * 当用户点击按钮试图提交新成绩，就运行此方法。
 */
function addNewScores() {
  const newScore = getUserInput();
  for (let i = 0; i < racedata.length; i++) {
    if (newScore.carNumber === racedata[i].carNumber) {
      racedata[i].laps.push(newScore.lapTime);
      document.getElementById('laps').innerHTML = '';
      document.getElementById('fastest').innerHTML = '';
      document.getElementById('driver').innerHTML = '';
      init();
      // 调用clearInputBox方法，将输入框全部清空，以待用户再次输入和使用。
      clearInputBox();
    }
  }
}

/**
 * 通过调取value并重新赋值的方式，将输入框全部清空。
 */
function clearInputBox() {
  document.getElementById('lapTime').value = '';
}

/**
 * 快速调取用户输入的值
 * @returns 返回用户输入的值组成的对象
 */
function getUserInput() {
  return {
    carNumber: parseInt(document.getElementById('driver').value),
    lapTime: parseFloat(document.getElementById('lapTime').value)
  };
}
