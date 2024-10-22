# Full-Stack GraphQL Application

A modern full-stack application combining PHP/MySQL backend with React/TypeScript frontend, using GraphQL for API communication.

## 🚀 Tech Stack

### Backend

- PHP (>=8.x)
- MySQL
- GraphQL

### Frontend

- React
- TypeScript
- Vite
- Apollo Client

## ⚡ Prerequisites

Make sure you have the following installed:

- PHP (>=8.x)
- Composer
- MySQL
- Node.js (>=20.x)
- npm
- Docker (optional, for containerization)

## 📁 Project Structure

```
project-root/
├── app/                  # Backend application code
│   ├── Config/          # Application configuration
│   ├── Database/        # Database related files
│   ├── ErrorHandling/   # Error handlers and exceptions
│   ├── GraphQL/         # GraphQL schemas and resolvers
│   ├── Models/          # Database models
│   └── Application.php  # Main application file
├── node_modules/        # Node.js dependencies
├── public/             # Static assets
├── src/                # Frontend source code
│   ├── assets/         # Static assets (images, fonts, etc.)
│   ├── Components/     # Reusable React components
│   ├── graphql/        # GraphQL queries and mutations
│   ├── helpers/        # Helper functions and utilities
│   ├── hooks/          # Custom React hooks
│   ├── pages/          # Page components
│   ├── services/       # API services and business logic
│   ├── index.css       # Global CSS styles
│   ├── main.tsx        # Main React entry point
│   ├── routes.tsx      # Application routes
│   └── vite-env.d.ts   # Vite environment declarations
├── vendor/             # PHP dependencies
├── .env               # Environment variables
├── .env.example       # Environment variables template
├── .gitignore        # Git ignore rules
├── composer.json      # PHP dependency management
├── composer.lock      # PHP dependency lock file
├── docker-compose.yml # Docker configuration
├── Dockerfile        # Docker build instructions
├── eslint.config.js  # ESLint configuration
├── index.html        # Entry HTML file
├── package.json      # Node.js dependency management
├── package-lock.json # Node.js dependency lock file
├── README.md         # Project documentation
├── run.php          # PHP runner script
├── schema.json      # GraphQL schema
├── schema.sql       # Database schema
├── tsconfig.app.json # TypeScript config for app
├── tsconfig.json    # Base TypeScript config
├── tsconfig.node.json # TypeScript config for Node
└── vite.config.ts   # Vite configuration
```

## 📦 Installation

### Backend Setup

1. Clone the repository

2. Install PHP dependencies

   ```bash
   composer install
   ```

3. Configure environment

   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

4. Initialize database
   ```bash
   php run.php
   ```

### Frontend Setup

1. Install Node.js dependencies

   ```bash
   npm install
   ```

2. Start development server
   ```bash
   npm run dev
   ```

## 🔧 Configuration

### Backend Configuration (app/Config/)

Configure your application settings including:

- Database connections
- GraphQL settings
- Error handling
- Application-wide constants

### Frontend Configuration

### Environment Variables (.env)

```env
DB_HOST=localhost
DB_NAME=your_database
DB_USER=your_username
DB_PASS=your_password
VITE_BACKEND_URI=http://localhost:8000
```

## 🚗 Development

### Backend

```bash
# Start PHP server
php -S localhost:8000 -t public

# Run database migrations
php run.php
```

### Frontend

```bash
# Start development server
npm run dev

# Build for production
npm run build


### GraphQL Development

The GraphQL schema and resolvers are located in:

- Backend: `app/GraphQL/`
- Frontend: `src/graphql/`
```
