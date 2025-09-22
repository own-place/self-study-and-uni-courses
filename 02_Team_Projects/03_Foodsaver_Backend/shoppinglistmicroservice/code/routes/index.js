import express from 'express';
import cors from 'cors'; // Import CORS middleware
import { saveShoppingList, getShoppingLists, removeShoppingList } from '../controllers/shoppingListController.js';
import fetch from 'node-fetch';

const app = express();

// Enable CORS with specific configuration (or allow all origins)
const corsOptions = {
  origin: '*', // Allow requests from all origins (use specific domains if needed)
  methods: ['GET', 'POST', 'DELETE', 'PUT'],
  allowedHeaders: ['Content-Type', 'Authorization'],
};

// Apply the CORS middleware
app.use(cors(corsOptions));

// Middleware to parse JSON bodies
app.use(express.json());

// Shopping list routes
app.post('/shopping-lists', saveShoppingList);
app.get('/shopping-lists', getShoppingLists);
app.delete('/shopping-lists/:id', removeShoppingList);

// Proxy route for TheMealDB API
app.get('/proxy/mealdb', async (req, res) => {
  try {
    const response = await fetch(`https://www.themealdb.com/api/json/v1/1/filter.php?i=${req.query.ingredient}`);
    const data = await response.json();
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'Failed to fetch data from MealDB' });
  }
});


// Start the server
app.listen(4052, () => {
  console.log('Server running on http://localhost:4052');
});

export default app;
