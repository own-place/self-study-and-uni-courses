const database = quirkyVideoDatabaseObject;

/**
 * Window load event handler. Initializes the app when the page is fully loaded. NOTE: Add all initialization code in this function
 */
window.addEventListener('load', loadTheWebPage);

/**
 * This function will load the webpage and call other functions
 */
function loadTheWebPage() {
  // Sort the database list before displaying them
  database.videos.sort(function (indexA, indexB) {
    if (indexA.title < indexB.title) {
      return -1;
    } else if (indexA.title > indexB.title) {
      return 1;
    } else {
      return 0;
    }
  });
  // Display the database playlist
  for (let i = 0; i < database.videos.length; i++) {
    writeStructureToDom(database.videos, i);
  }
  // Calculate and display the total airtime of the playlist
  document.getElementById('airtime').innerHTML = displayAirtime(sum);
  // Add new items and update playlist, then, clear the input box
  document.getElementById('add-button').addEventListener('click', addNewItem);
}

// Initializes variables here
let sum = 0;

// sum the duration of all videos in the playlist
for (let n = 0; n < database.videos.length; n++) {
  sum += database.videos[n].duration;
}

/**
 * Write the required structure to DOM
 * @param {*} arr take 'database.videos' as a array parameter
 * @param {*} i 
 */
function writeStructureToDom(arr, i) {
  // a. add <article> element with a className "card m-2 p-2" (inside #playlist)
  const card = document.createElement("article");
  card.className = 'card m-2 p-2';
  document.getElementById('playlist').appendChild(card);
  // b. add <div> element with a className "media" (inside --> card)
  const media = document.createElement("div");
  media.className = 'media';
  card.appendChild(media);
  // c. add <div> element with a className "media-left" (inside --> media)
  const mediaLeft = document.createElement("div");
  mediaLeft.className = 'media-left';
  media.appendChild(mediaLeft);
  // d. add <p> element with a className "image is-64x64" (inside --> media-left)
  const image64 = document.createElement("p");
  image64.className = 'image is-64x64';
  mediaLeft.appendChild(image64);
  // e1. add <img> element and give it a src which will link to a image (inside --> media-left)
  const imgSrc = document.createElement("img");
  // e2. assign the value to the variable by using setAttribute(type, value)
  imgSrc.setAttribute('src', `https://img.youtube.com/vi/${arr[i].videoId}/0.jpg`);
  image64.appendChild(imgSrc);
  // f. add <div> element with a className "media-content" (inside --> media)
  const mediaContent = document.createElement("div");
  mediaContent.className = 'media-content';
  media.appendChild(mediaContent);
  // g. add <div> element with a className "content" (inside --> mediaContent)
  const content = document.createElement("div");
  content.className = 'content';
  mediaContent.appendChild(content);
  // h1. add <a> element and give it a href which will link to a video (inside --> content)
  const videoHref = document.createElement("a");
  videoHref.setAttribute('href', `https://youtu.be/${arr[i].videoId}`);
  // h2. use innerHTML to write artist name and song title
  videoHref.innerHTML = `<strong>${arr[i].artist}</strong> - ${arr[i].title}`;
  content.appendChild(videoHref);
  // i. add <div> element with a className "media-right" (inside --> media)
  const mediaRight = document.createElement("div");
  mediaRight.className = 'media-right';
  media.appendChild(mediaRight);
  // j1. add <span> element with a className "has-text-grey-light" (inside --> mediaRight)
  const oriTime = document.createElement("span");
  oriTime.className = 'has-text-grey-light';
  // j2. calculate the duration of the video and use innerHTML to write into span
  oriTime.innerHTML = displayAirtime(arr[i].duration);
  mediaRight.appendChild(oriTime);
}

/**
 * This function can calculate the duration of each video or whole playlist.
 * @param {*} theDuration take a duration(time) as parameter for calculating
 * @returns return a duration in format --> Hours:Minutes:Seconds
 */
function displayAirtime(theDuration) {
  // Calculates
  const airtimeSeconds = theDuration % 60;
  const totalMinutes = (theDuration - airtimeSeconds) / 60;
  const airtimeMinutes = totalMinutes % 60;
  const airtimeHours = (totalMinutes - airtimeMinutes) / 60;
  // Conditional statement: if the input is not correct, then it won't be displayed.
  if (airtimeHours >= 1) {
    return `${airtimeHours}:${addZero(airtimeMinutes)}:${addZero(airtimeSeconds)}`;
  } else {
    return `${airtimeMinutes}:${addZero(airtimeSeconds)}`;
  }
}

/**
 * Add a '0' in front of the number when it doesn't have two digits
 * @param {*} aTime send a number(minutes or seconds) as the parameter
 * @returns convert number to a string and put a '0' in front if it doesn't meet the rule
 */
function addZero(aTime) {
  return aTime = aTime.toString().padStart(2, '0');
}

/**
 * When user input something, the new information should be displayed on screen
 */
function addNewItem() {
  // Create a new object for storing new video
  const newVideo = {};
  // When user input something, it will be wrote into html. Use '.value' to get the text
  // Then, write the information about new video into new object
  newVideo.videoId = document.getElementById('video-id').value;
  newVideo.duration = document.getElementById('duration').value;
  newVideo.artist = document.getElementById('artist').value;
  newVideo.title = document.getElementById('title').value;
  if (newVideo.videoId.length == 11 && newVideo.artist.length >= 3 && newVideo.title.length >= 3 && !isNaN(newVideo.duration)) {
    // if user input correctly, the contents can be stored into database playlist array
    database.videos.push(newVideo);
    // sum new video airtime with whole list airtime
    sum += newVideo.duration;
    // erase the element in html
    document.getElementById('playlist').innerHTML = "";
    // call the init function again, then it will:
    // 1. write the new object into dom
    // 2. calculate the airtime of whole list
    // 3. sort the new video in the list
    // 4. re-display the whole list on the screen
    loadTheWebPage();
    // call the function to clear input box
    clearInputBox();
  }
}

/**
 * This function can clear the values of input boxes
 */
function clearInputBox() {
  document.getElementById('video-id').value = '';
  document.getElementById('duration').value = '';
  document.getElementById('artist').value = '';
  document.getElementById('title').value = '';
}
