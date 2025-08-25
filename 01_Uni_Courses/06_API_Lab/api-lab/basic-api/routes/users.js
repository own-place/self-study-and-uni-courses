import express from 'express';
import { v4 as uuidv4 } from 'uuid';
const router = express.Router(); // creates a fresh router instance, stored in the variable router

// Mock database
let users = [
    {
        first_name: 'John',
        last_name: 'Doe',
        email: 'johndoe@example.com'
    },
    {
        first_name: 'Alice',
        last_name: 'Smith',
        email: 'alicesmith@example.com'
    },
    {
        first_name: "Bob",
        last_name: "Johnson",
        email: "bobjohnson@example.com"
    },
    {
        first_name: "Catherine",
        last_name: "Williams",
        email: "catherinewilliams@example.com"
    },
    {
        first_name: "David",
        last_name: "Jones",
        email: "davidjones@example.com"
    },
    {
        first_name: "Eva",
        last_name: "Brown",
        email: "evabrown@example.com"
    },
    {
        first_name: "Frank",
        last_name: "Davis",
        email: "frankdavis@example.com"
    }
];

// Getting the list of users from the mock database
router.get('/', (req, res) => {
    res.send(users); // send a response(the 'users' variable) in json format back to the client
})

router.post('/', (req, res) => {
    const user = req.body;

    users.push({ ...user, id: uuidv4() });

    res.send(`${user.first_name} has been added to the Database`);
})

// The :id part is a route parameter, which allows us to capture a dynamic value from the URL.
router.get('/:id', (req, res) => {
    // destructure id from req.params to extract the user ID directly from the URL
    const { id } = req.params;

    // used the .find() method to search the data for a user whose ID matches the one captured from the URL
    const foundUser = users.find((user) => user.id === id);

    res.send(foundUser);
});

router.delete('/:id', (req, res) => {
    const { id } = req.params;

    // create a new array that excludes the user with the matching ID
    users = users.filter((user) => user.id !== id);

    res.send(`${id} deleted successfully from database`);
});

router.patch('/:id', (req, res) => {
    const { id } = req.params;

    const { first_name, last_name, email } = req.body;

    // used .find() to locate the user object with the matching ID
    // once found, modified the user's data based on req.body by updating first_name, last_name, or email properties if they exist
    // allowing for selective changes without affecting other attributes.
    const user = users.find((user) => user.id === id)

    if (first_name) user.first_name = first_name;
    if (last_name) user.last_name = last_name;
    if (email) user.email = email;

    res.send(`User with the ${id} has been updated`)

});

export default router