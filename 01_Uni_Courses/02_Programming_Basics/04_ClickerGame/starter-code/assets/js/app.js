// 新建一个数组，用来存储奖杯。
const trophies = ['🍓', '🌽', '🧱', '🐴', '🏆'];
// 新建一个数组，用来存储怪兽图片的地址。
const monsterImages = [
  'assets/img/horns_skull.png',
  'assets/img/fire_horns.png',
  'assets/img/green_blob.png',
  'assets/img/pink_monster.png',
  'assets/img/red_zombie.png'
];

/**
 * 当检测到页面加载时，执行function中的代码。
 */
window.addEventListener('load', function () {
  // 获取Dom中属于playfield的元素，并创建一个变量存储它，方便后期调用。
  const playfield = document.getElementById('playfield');

  // 调用下方的addMonster(index)方法，将怪物依次写入Dom中并显示出来。
  for (let i = 0; i < monsterImages.length; i++) {
    addMonster(i);
  }

  // #playfield中的若干img元素，此时还是一些结构片段，按加入的顺序存储在那里，无法直接精确找到并调用；
  // 因为，必须使用children让其成为数组，才可以通过索引值调用它们！
  const monsterArr = playfield.children;

  // 现在有了索引值，就可以用遍历的方式，以此为每一个怪物元素添加event并监听它们的活动。
  // 当怪物元素被用户点击时，就调用下方的changePosition方法，为怪物设定新的坐标。
  for (let j = 0; j < monsterArr.length; j++) {
    monsterArr[j].addEventListener('click', changePosition);
  }

});

/** 
 * 获取给定范围内的随机数。
 * @param {*} lower 随机数的最小值
 * @param {*} upper 随机数的最大值
 * @returns 返回一个范围内随机的整数
 */
function randomIntBetween(lower, upper) {
  return Math.round(lower + (upper - lower) * Math.random());
}

/**
 * 将怪物数组中的数据依次写入Dom里playfield的元素中
 * @param {*} index 以索引值作为参数
 */
function addMonster(index) {
  // 创建一个新的元素img，并使用变量来存储它。
  const monsters = document.createElement("img");
  // 使用setAttribute(type, value)方法，将怪物数组中的图片链接添加到img元素中。
  monsters.setAttribute('src', monsterImages[index]);
  // 为此img元素添加指定的class
  monsters.className = 'playfield_item';
  // 使用style.top和style.left方法设定每只怪物的坐标，坐标是随机生成的。
  monsters.style.top = randomIntBetween(1, 30) + 'rem';
  monsters.style.left = randomIntBetween(1, 60) + 'rem';
  // 通过appendChild方法()，将设置好各种参数的img元素加入到playfield中，成为其子项。
  playfield.appendChild(monsters);
}

// 初始化一个变量，用来统计用户的点击次数。
let count = 0;

/**
 * 此方法可在每一次用户点击怪物元素时，为怪物生成并指定一个新的坐标，并随之累计点击次数。
 * @param {*} event 一般事件监听不需要参数，此处需要是因为必须使用target；当Dom中有多个元素在被监听时，必须使用target才能定位到真正触发事件的元素。
 */
function changePosition(event) {
  // 为被点击的怪物元素重新安排一个新坐标。
  event.target.style.top = randomIntBetween(1, 30) + 'rem';
  event.target.style.left = randomIntBetween(1, 60) + 'rem';
  // 每一次点击都需要被记录下来。
  count++;
  whichTrophie(count);
};

/**
 * 使用条件进行判断，在对应情况下显示奖杯。
 * @param {*} times 用户点击次数
 */
function whichTrophie(times) {
  if (times == 2) {
    // 调取下方的addTrophie方法，将奖杯写入Dom并显示出来。
    addTrophie(0);
  } else if (times == 3) {
    addTrophie(1);
  } else if (times == 4) {
    addTrophie(2);
  } else if (times == 5) {
    addTrophie(3);
  } else if (times == 6) {
    addTrophie(4);
  }
}

/**
 * 此方法的功能为 显示奖杯。
 * @param {*} index 以索引值作为参数
 */
function addTrophie(index) {
  // 在Dom中创建一个新元素span，并使用变量来存储它。
  const trophiesBox = document.createElement('span');
  // 将奖杯数组中对应的奖杯写入span元素中。一旦写入，奖杯便会显示出来。
  trophiesBox.innerHTML = trophies[index];
  // 将写好参数与内容的span元素添加为#trophies的子项，以确保该元素能显示在正确的位置上。
  document.getElementById('trophies').appendChild(trophiesBox);
}