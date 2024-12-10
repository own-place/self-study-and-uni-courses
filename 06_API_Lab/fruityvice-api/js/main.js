import { fetchFruit } from './fetchFruits.js';

document.addEventListener('DOMContentLoaded', (event) => {
    const searchBtn = document.querySelector('#searchBtn');
    const fruitButtons = document.querySelectorAll('.fruit-button');
    
    if (searchBtn) {
        fruitButtons.forEach(button => {
            button.addEventListener('click', handleFindClick);
        });
        searchBtn.addEventListener('click', handleSearchClick);
    } else {
        console.error('Cannot find the button!');
    }
});

async function handleSearchClick(event) {
    event.preventDefault();
    try {
        const fruitInput = document.querySelector('#fruitInput');
        const fruit = fruitInput.value.trim().toLowerCase();
        
        if (!fruit || !isNaN(fruit)) {
            throw new Error('Invalid input');
        }

        const result = await fetchFruit(fruit);
        if (result && result.name) {
            localStorage.setItem('fruitResult', JSON.stringify(result));
            window.location.href = 'result.html';
        } else {
            throw new Error('Fruit not found');
        }
    } catch (error) {
        console.error('Error:', error);
        // window.location.href = 'msg.html';
    }
}

async function handleFindClick(event) {
    event.preventDefault();
    try {
        const fruit = this.innerText.trim().toLowerCase();
        const result = await fetchFruit(fruit);

        if (result && result.name) {
            localStorage.setItem('fruitResult', JSON.stringify(result));
            window.location.href = 'info.html';
        } else {
            throw new Error('Fruit not found');
        }
    } catch (error) {
        console.error('Error:', error);
        // window.location.href = 'msg.html';
    }
}