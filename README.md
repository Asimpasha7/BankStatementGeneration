# Bank Statement Generation
This Laravel project is designed to generate bank statements based on user transactions and send them via email.
# Prerequisites

Make sure you have the following installed on your system:
- PHP
- Composer
- [MailHog](https://github.com/mailhog/MailHog) (for local email testing)
- [Docker](https://www.docker.com/get-started) (optional, for containerized development)

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/bank_statement_generation.git
    cd bank_statement_generation
    ```
2. Install dependencies:
    ```bash
    composer install
    ```
3. Set up your environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Update the `.env` file with your database and email configurations.

4. Migrate the database:
    ```bash
    php artisan migrate
    ``
5. Start MailHog (for local email testing):
    ```bash
    mailhog
    ``
    MailHog will be accessible at http://127.0.0.1:8025.

### Usage

1. Run the development server:
    ```bash
    php artisan serve
    ```
    Your application will be accessible at http://127.0.0.1:8000.
2. Open a new terminal window and run MailHog to catch sent emails:
    ```bash
    mailhog
    ```
    MailHog web interface: http://127.0.0.1:8025
3. Visit your application in the browser, perform actions that trigger email sending, and check MailHog for sent emails.

### Development with Docker (optional)

1. Install Docker and Docker Compose.
2. Copy the example Docker environment file:
    ```bash
    cp docker/.env.example docker/.env
    ```
3. Start the Docker containers:

    ```bash
    cd docker
    docker-compose up -d
    ```
4. Follow the same steps as the "Usage" section but replace `php artisan serve` with Docker's exposed ports.

## Additional Information
- Ensure that your Laravel application has proper permissions for file operations and attachments.
- The `public/data` directory is used to store generated PDFs.
- Troubleshooting: If encountering issues, check the logs and make sure the necessary dependencies are installed.

