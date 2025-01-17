# PHP MVC Framework Example

A lightweight MVC framework built in PHP, designed for educational purposes to
demonstrate MVC architecture principles. This project is not intended for
production use but serves as a learning tool for understanding basic framework
concepts.

## Features

- Basic MVC architecture
- Simple routing with parameter support
- Docker configuration with PHP-FPM, Nginx, and PostgreSQL
- Database seeding scripts for example data
- PSR-4 autoloading
- Basic testing setup with PHPUnit

## Prerequisites

- Docker and Docker Compose
- Composer
- Git

## Installation

1. Clone the repository:

```bash
git clone https://github.com/andrewthecodertx/php-mvc-framework.git
cd php-mvc-framework
```

2. Install dependencies:

```bash
composer install
```

3. Set up environment:

```bash
cp .env.example .env
```

4. Start Docker containers:

```bash
docker compose up -d
```

5. Generate example data:

```bash
./seed
```

```bash
http://localhost:8000
```

## Project Structure

```
├── app/                # Application code
│   ├── Controllers/    # User-defined controllers
│   ├── Models/         # User-defined models
│   └── Views/          # View templates
├── src/                # Framework core
├── bootstrap/          # Framework initialization
├── public/             # Web root
├── scripts/            # Database scripts
└── tests/              # PHPUnit tests
```

## Database Scripts

Two scripts are provided for database setup:

- `scripts/makeusers` - Creates and populates users table
- `scripts/makeposts` - Creates and populates posts table

These scripts can be modified to create custom tables as needed.

## Known Limitations

This framework is intentionally simple and lacks several features that would
be necessary for production use:

- No middleware support
- Basic routing (only GET/POST, limited parameter handling)
- No authentication/authorization system
- No plugin architecture
- Limited build process
- No CSRF protection
- No input validation
- No caching mechanism
- No ORM integration

## Future Improvements

Areas that could be enhanced:

- Add middleware support
- Implement authentication/authorization
- Improve build process
- Add CSRF protection
- Add request validation
- Implement caching
- Add service container
- Enhance routing capabilities
- Add database migrations
- Add configuration management
- Implement error handling and logging

## Contributing

While this is primarily an educational project, suggestions and improvements
are welcome. Please feel free to:

1. Fork the repository
2. Create a feature branch
3. Submit a pull request

## License

MIT License - feel free to use this code for learning purposes.

## Author

Andrew S Erwin

## Acknowledgments

This project is inspired by various PHP frameworks and is designed to help
developers understand MVC principles in a simplified context.
