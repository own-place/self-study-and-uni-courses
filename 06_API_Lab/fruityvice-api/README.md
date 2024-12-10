# Fruityvice

## Project Overview

This project is a school assignment aimed at helping users search for information on various fruits. Users can either input the name of a fruit or click on predefined fruit buttons to get detailed information about the fruit. This project uses the [Fruityvice API](https://www.fruityvice.com/) to fetch the data.

Before you start exploring this project, please acquire temporary access through the link: https://cors-anywhere.herokuapp.com/corsdemo Temporary access is required to bypass CORS limitations. Once you have temporary access, you can use my web application on any device without issues. Here is the hosted link to this project: https://fruityvice01.netlify.app/html/


## Features

1. **Search Functionality**: Users can type the name of a fruit and click the search button to be redirected to a result page displaying the fruit information.
2. **Predefined Fruit Buttons**: Users can click on buttons for popular fruits to directly get the information.
3. **Error Handling**: If a fruit is not found or an invalid input is provided, users will be redirected to an error message page.

## Technologies Used

- **HTML**: For structuring the web pages.
- **CSS**: For styling the web pages.
- **JavaScript**: For adding interactivity and fetching data from the API.
- **Tailwind CSS**: For utility-first CSS framework to style the components.

## CORS Proxy

This project utilizes `https://cors-anywhere.herokuapp.com/` as a CORS proxy to bypass Cross-Origin Resource Sharing (CORS) restrictions when making requests to the Fruityvice API. CORS is a security feature implemented by browsers to prevent unauthorized access to resources on a different origin. The Fruityvice API does not include the necessary CORS headers, so a proxy server is needed to fetch data from it in a web application.

To ensure the stability and security of your application, it's recommended to set up your own CORS proxy server or seek permission from the maintainers of `cors-anywhere` if you plan to use it extensively. 

### How to Set Up Your Own CORS Proxy Server

1. **Choose a Proxy Solution**: There are several open-source CORS proxy solutions available, such as `cors-anywhere`, `cors-proxy-server`, or you can build your own using Node.js or other technologies.
   
2. **Deploy the Proxy Server**: Deploy the chosen CORS proxy solution to a server or a cloud platform like Heroku.

3. **Update Request URLs**: Update the URLs in your application to point to your own CORS proxy server.

For more information on CORS proxy servers and how to set them up, please refer to the [cors-anywhere documentation](https://github.com/Rob--W/cors-anywhere/) and consider hosting your own instance.

## How to Use

1. **Search for a Fruit**: On the homepage, type the name of a fruit in the search bar and click the search button.
2. **View Popular Fruits**: Click on any of the predefined fruit buttons on the homepage to get information about that fruit.
3. **View Results**: If the fruit is found, you will be redirected to a result page.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/Luyue28/fruityvice-api.git
    ```
2. Navigate to your project directory:
    ```bash
    cd path/to/your/project/directory
    ```
3. Open `index.html` in your web browser to start using the application.

## About

This project was created by **Luyue Zhang**, a first-year ICT student at HZ University of Applied Sciences. It is part of a school assignment.

## License

This project is open source and available under the [MIT License](LICENSE).
