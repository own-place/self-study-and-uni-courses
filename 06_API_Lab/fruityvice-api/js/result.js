document.addEventListener('DOMContentLoaded', (event) => {
    const fruitResult = JSON.parse(localStorage.getItem('fruitResult'));
    if (fruitResult) {
        document.querySelector('#fruitBtn').innerHTML =  fruitResult.name;
    } else {
        console.error('No data can be found!');
    }
});
