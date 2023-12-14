# SCANDIWEB test assigment back

## Initialisation

```bash
git clone https://github.com/kenke11/scandiweb-back.git
```

### Go to project folder

```bash
cd scandiweb-back
```

### Create local env file

```bash
cp .env.example .env
```

### change .env

#### Enter your database information

```dotenv
DB_HOST=localhost
DB_DATABASE=scandiweb
DB_USERNAME=username
DB_PASSWORD=password
```

### Install dependencies

```bash
composer install
```

### Migrate database

```bash
php app/Commands/commands.php migration:run
```

### Seed default data

```bash
php app/Commands/commands.php migration:seed
```

### Start local server

```bash
php -S 127.0.0.1:8000 -t public/
```