/**
 * 这是一个模拟从远程获取比赛数据的函数服务器，它会生成 2-5 个对象。
 */
function fetchFormula1Data() {
  // 假设生成的随机数为0.1，乘3后为0.9，floor后为0，再加2即是2，此时随机出来的司机数量就是2。
  const numDrivers = 2 + Math.floor(Math.random() * 3);
  // 同上，若最开始生成的随机数为0.1，乘7后为0.7，floor后为0，此时随机出来的成绩就是3。
  const numLaps = 3 + Math.floor(Math.random() * 7);
  const drivers = [
    'M. Verstappen', 'L. Hamilton', 'V. Bottas', 'C. Leclerc', 'D. Ricciardo',
    'S. Perez', 'L. Norris', 'S. Vettel', 'F. Alonso', 'E. Ocon',
  ];

  // 如果随机出来的司机数量大于司机数组的长度，则返回错误。
  if (numDrivers > drivers.length) {
    console.error('Not enough unique driver names available.');
    return [];
  }

  // 创建一个变量，用来存储一个新的方法set。
  const uniqueDriverNames = new Set();
  // 初始化一个数组来存储比赛相关数据。
  const formula1Data = [];

  // 只要赛事数组的长度比司机数量少，就继续循环。
  while (formula1Data.length < numDrivers) {
    // 随机一个索引值。
    const randomIndex = Math.floor(Math.random() * drivers.length);
    // 根据上面随机出来的索引值调取drivers数组中的数据。
    const name = drivers[randomIndex];

    if (!uniqueDriverNames.has(name)) {
      uniqueDriverNames.add(name);
      const carNumber = formula1Data.length + 1;
      const laps = [];

      for (let i = 0; i < numLaps; i++) {
        const lapTime = (Math.random() * 10 + 70).toFixed(3); // Generate random lap time between 70 and 80 seconds
        laps.push(parseFloat(lapTime));
      }

      formula1Data.push({ carNumber, name, laps });
    }
  }

  return formula1Data;
}
