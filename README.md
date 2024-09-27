## Overview
This assignment tests minimum skills and knowledge required to successfully kick start your career at scandiweb.

Website consists of two pages: `Product List` page and `Product Add` page.

Full task description could be found here: [Junior Developer Test Task](https://scandiweb.notion.site/Junior-Developer-Test-Task-1b2184e40dea47df840b7c0cc638e61e)

## Technologies
Backend: `PHP 8.2.12`, `MySQL 8.0+`

Frontend: `React`, `TypeScript`, `SCSS`

Containerization: `Docker`

## Backend
### Key Features
- **OOP Design**: Product types are managed using an abstract `Product` class and concrete subclasses (`DVD`, `Book`, `Furniture`).
- **Database Interaction**: Products are stored in a MySQL database, with logic managed via setters/getters.
- **CORS Handling**: Cross-Origin Resource Sharing (CORS) headers are set to allow API requests from different origins.
- **RESTful Endpoints**:
  - `GET /products`: Retrieve all products.
  - `POST /product/create`: Add a new product.
  - `DELETE /products/delete`: Remove multiple products by ID.
### Backend Project Structure
- **App\Core**: Core components like `App`, `Database`, `Request`, and `Router`.
- **App\Controllers**: Handles product-related HTTP requests (`ProductsController`).
- **App\Services**: Business logic for managing products (`ProductsService`).
- **App\Models**: Product classes (`Product`, `DVD`, `Book`, `Furniture`).

## Frontend
### Key Features

- **React**: the entire frontend application is writtend with modern JavaScript framework - `React`.
- **TypeScript**: using `TypeScript` for better development experience.
- **Zod w/ React Hook Form**: using `Zod` and `React Hook Form` for proper form validation.

