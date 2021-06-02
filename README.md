# De Gouden Draak
A simple website for our Chinese / Indian restaurant.

## Deployment
To deploy this website to a server, make sure to follow these steps:

Copy the `.env.example` file and rename it to `.env`. Enter your variables as needed.

Run the following commands:

```bash
# Install php modules
composer install

# Generate an encryption key
php artisan key:generate

# Install node modules
npm install

# Compile assets
    # For production:
    npm run prod

    # For development:
    npm run dev

# Migrate the database
php artisan migrate

# (optional) Seed the database with sample data
php artisan db:seed

# (optional) Run a local webserver
php artisan serve
```

*This is a school project for a hypothetical customer.*
