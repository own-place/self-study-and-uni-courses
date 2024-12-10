const baseUrl = 'https://www.fruityvice.com/api/fruit';
const corsProxy = 'https://cors-anywhere.herokuapp.com/';

async function fetchData(url) {
    let response = await fetch(`${corsProxy}${baseUrl}${url}`);
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    let json = await response.json();
    return json;
}

async function fetchFruit(fruitName) {
    return fetchData(`/${fruitName}`);
}

export { fetchFruit };