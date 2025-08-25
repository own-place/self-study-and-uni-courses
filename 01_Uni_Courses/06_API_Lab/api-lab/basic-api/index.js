import express from 'express'; // imported express from the Express module
import bodyParser from 'body-parser'; // it allows us to take in the incoming POST request body
import userRoutes from './routes/users.js' // import the user routes from user.js

const app = express(); // created an app using the express object
const PORT = 3000 // specified the port for the application, can change the port when it's used by other apps

app.use(bodyParser.json()); // specified that JSON data will be used in the application

app.use('/users', userRoutes); // use the app.use method, and specify the path and router handler

app.get('/', (req, res) => {
    console.log('GET route');
    res.send('hello from homepage');
})

app.listen(PORT, () => console.log(`Server running on port: http://localhost:${PORT}`)); // make our application listen for incoming requests