document.addEventListener('DOMContentLoaded', (event) => {
    const fruitResult = JSON.parse(localStorage.getItem('fruitResult'));
    if (fruitResult) {
        document.getElementById('fruitName').textContent = fruitResult.name;
        document.getElementById('fruitFamily').textContent = fruitResult.family;
        document.getElementById('fruitOrder').textContent = fruitResult.order;
        document.getElementById('fruitGenus').textContent = fruitResult.genus;
        document.getElementById('fruitCalories').textContent = fruitResult.nutritions.calories;
        document.getElementById('fruitFat').textContent = fruitResult.nutritions.fat;
        document.getElementById('fruitSugar').textContent = fruitResult.nutritions.sugar;
        document.getElementById('fruitProtein').textContent = fruitResult.nutritions.protein;
        document.getElementById('fruitCarbohydrates').textContent = fruitResult.nutritions.carbohydrates;
    } else {
        console.error('No data can be found!');
    }
});
