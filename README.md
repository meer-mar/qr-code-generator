# Laravel 12 CMS Boilerplate

A modern CMS built with Laravel 12, featuring Tailwind CSS, Vite build system, and Alpine.js.

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL/PostgreSQL database

## Admin Credentials

<p>
email : admin@admin.com<br>
password : admin
</p>

## Test User Credentials

<p>
email : johnconnor2996@gmail.com<br>
password : password
</p>

## Installation Steps

### Step 1
<p>Disable code inside AppServiceProvider file boot method code</p>

### Step 2
<p>Run command: <code>composer install</code></p>

### Step 3
<p>Run command: <code>cp .env.example .env</code></p>

### Step 4
<p>Set database credentials in .env file</p>

### Step 5
<p>Run command: <code>php artisan key:generate</code></p>

### Step 6
<p>Run command: <code>php artisan migrate:fresh --seed</code></p>

### Step 7
<p>Run command: <code>npm install</code></p>

### Step 8
<p>Run command: <code>npm run dev</code> (for development) or <code>npm run build</code> (for production)</p>

### Step 9
<p>Enable code inside AppServiceProvider file boot method code</p>

## Features

- **Laravel 12**: Latest Laravel framework with modern PHP 8.2+ features
- **Tailwind CSS 3**: Utility-first CSS framework for rapid UI development
- **Vite**: Fast build tool for modern frontend development
- **Alpine.js 3**: Lightweight JavaScript framework for interactive components
- **Livewire 3**: Full-stack framework for Laravel
- **Breeze 2**: Lightweight authentication scaffolding

## Development

```bash
# Start development server
npm run dev

# Build for production
npm run build

# Start Laravel development server
php artisan serve
```

## Build System

This project uses **Vite** instead of Laravel Mix for faster builds and better development experience. The build process is configured in `vite.config.js` and includes:

- Tailwind CSS compilation
- JavaScript bundling with Alpine.js
- Hot module replacement during development
- Optimized production builds
