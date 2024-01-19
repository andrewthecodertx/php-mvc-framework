
# Simple MVC Framework

## Overview

This repository provides a basic implementation of the MVC (Model-View-Controller)
design pattern in PHP. The aim is to demonstrate a simple MVC structure without
relying on external Composer libraries, making it suitable for smaller projects
where more extensive frameworks might be overkill.

## Features

- **MVC Design Pattern**: Organizes code into models, views, and controllers,
promoting a structured and maintainable codebase.
- **Composer Autoloading**: Utilizes Composer for autoloading classes and
includes PHPUnit for potential future testing.
- **Dockerized Setup**: The project is containerized with Docker and can
be easily set up using Docker Compose.

## Getting Started

To run the project, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/andrewthecodertx/php-mvc-framework.git
   ```

2. Navigate to the project directory:

   ```bash
   cd php-mvc-framework
   ```

3. Start the project with docker compose:

  ```bash
  docker compose up
  ```

4. Browse to the application at http://localhost:8000

## Project Structure

The project follows a simple directory structure:

- 'app/': this is the actual application that includes the models, views, and controllers.
This is also where any future middleware would reside.
- 'bootstrap/': all of the initialization and constants.
- 'db/': the sqlite database file is here.
- 'public/': entry point and static assets.
- 'src/': this is the core framework!

I also included Faker and some scripts to populate the database for testing
purposes. Please note that the demo app is not styled in any way! And the
content is very minimal. But it is a good starting point.

## Limitations

- NOT PRODUCTION READY: This is the bare bones version of the framework that I use
in some smaller client projects. It is a good starting point, but I am
generally guided further by client specs and requirements.
- NO MIDDLEWARE: There is not currently a mechanism for middleware.
- NO SECURITY: There is no authorization or other such security implemented.

## Contributing

I would love to have some folks come on board and help make this production ready!

## License Information

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file
for details.
