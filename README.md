## Install
1. `cp .env.example .env`
2. > <p>Change DB credentials to yours in .env file</p>
3. > <p>Specify xml file default path in .env "XML_AUTO_CATALOG_DEFAULT_PATH"</p>
4. `composer install --no-dev`
5. `php artisan key:generate`
6. `php artisan migrate`

## Usage
`php artisan parser:update-auto-catalog` or `php artisan parser:update-auto-catalog /path/to/file`
