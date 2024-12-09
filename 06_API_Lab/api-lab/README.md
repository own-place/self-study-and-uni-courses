# API-LAB
A space for exploring and experimenting with various APIs to enhance skills and share insights.

The `basic-api` is a practice project based on the tutorial from [freeCodeCamp](https://www.freecodecamp.org/news/create-crud-api-project/). The original repository for the tutorial can be found at [Aviatorscode2/crud-api-tutorial](https://github.com/Aviatorscode2/crud-api-tutorial).

## Study Notes
## Four primary HTTP methods associated with CRUD operations:
GET: Used for reading or retrieving data from the server.<br>
POST: Used for creating new data on the server.<br>
PUT: Used for updating existing data on the server.<br>
DELETE: Used for removing data from the server.

## Define API routes with app.get(), app.post(), app.put(), and app.delete() methods:
### app.get()
The app.get() function takes two parameters: the first is the path ('/'), and the second is a callback function that handles the GET request. This callback has two parameters: the request object (req), which includes details like the query string and headers, and the response object (res), used to send the response.

## API endpoints
GET /users - find all users<br>
POST /users - creates a user<br>
GET /users/:id - finds a specific user<br>
DELETE /users/:id - deletes a specific user<br>
PATCH /users/:id - updates a specific user

