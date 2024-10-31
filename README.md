# Looper - MAW 11
## Description
This is an app designed to create exercices than other people can respond to.

## Getting started
### Prerequisites
- PHP 8.3.11
- MariaDB 11.5.2
- Composer 2.7.8
- Xdebug 3.3.2
- Git 2.46.0
- Git Flow 0.4.1
- **IDE:** PhpStorm 2024.1.6

### Configuration
1. Install PHP
   1. [macOS](https://www.php.net/manual/en/install.macosx.packages.php)
   2. [Windows](https://www.geeksforgeeks.org/how-to-install-php-in-windows-10/)
   3. [On Debian based distros](https://php.watch/articles/php-8.3-install-upgrade-on-debian-ubuntu#php83-debian-quick)
2. [Install MariaDB](https://www.vinchin.com/database-tips/install-mariadb-on-windows-linux-macos.html)
3. [Install Composer](https://getcomposer.org/download/)
4. [Install Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
5. [Install Xdebug](https://xdebug.org/docs/install)

For Git Flow, it depends on which OS you are. If you are using Windows, it's all good, it already comes installed with git. For the others, [follow this tutorial](https://skoch.github.io/Git-Workflow/).

In this project, we have been using PhpStorm as our main IDE. You can use whatever you want but we recommend using this one. All the configuration below will be for it.

### Deployment (On DEV environmnent)

1. Clone the repo and install the required dependencies
```bash
git clone https://github.com/CPNV-ES/MAW_Looper_DDS-GWI.git
cd MAW_Looper_DDS-GWI/
composer install
```

2. Run tests present in *tests/* folder
3. Define PSR-12 in PhpStorm
   1. [CodeSniffer](https://www.jetbrains.com/help/phpstorm/using-php-code-sniffer.html#configure-tool-options)
      > Define "Coding standard:" to PSR-12
   2. [Code Style](https://www.jetbrains.com/help/phpstorm/settings-code-style-php.html#copyLanguageFrameworkCodeStylePHP)
4. Define the environment variables

```bash
vi app/Models/.env

DB_HOST="localhost"
DB_PORT="3306" # Generally 3306
DB_NAME=""
DB_USER=""
DB_PASSWORD=""
```

5. Run DB creation script on your Database (db/db_creation.sql)

5. Run PHP server

```bash
php -S localhost:8080
```

### Deployment (On integration environment)

#### Prerequisites
- **Web Server:** Apache, Nginx, ...
- **PHP:** 8.3.11
- **Database:** MariaDB
- **Composer:** For managing project dependencies

#### Steps
1. Clone the repo
```bash
git clone https://github.com/CPNV-ES/MAW_Looper_DDS-GWI.git
cd MAW_Looper_DDS-GWI/
```

2. Install dependencies
```bash
composer install
```

3. Set-up environment variables
```bash
vi app/Models/.env

DB_HOST="localhost"
DB_PORT="3306" # Generally 3306
DB_NAME=""
DB_USER=""
DB_PASSWORD=""
```

4. Run DB creation script on your Database (db/db_creation.sql)

5. Apache
   1. Enable rewrite mod
   ```bash
   sudo a2enmod rewrite
   sudo systemctl start apache2.service
   ```
   2. Update .htaccess 
   ```bash
   <IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /

    # Redirect all traffic to /public
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]

    # If the file or folder doesn't exists, redirect to /public/index.php
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ public/index.php [QSA,L]
   </IfModule>
   ```

6. Adjust file permissions if necessary
```bash
sudo chown -R www-data:www-data ../MAW_Looper_DDS-GWI/
sudo chmod 755 ../MAW_Looper_DDS-GWI/
```

## Directory Structure
```bash
└── MAW_Looper_DDS-GWI/
    ├── app/
        ├── Controllers
        ├── Models
        ├── Views
        └── Core/
            ├── Router.php
            ├── Model.php       # Base Model class for other Models
            └── Controller.php  # Base Controller class for other Controllers
    ├── config                  # Contains all app configuration files
    ├── db                      # Contains all DB related files
    ├── public/
        ├── css
        ├── img
        ├── js
        └── index.php
    └── tests              # Contains code tests
```

## Collaborate
Collaboration on this project is warmly welcomed.

- If you have an issue concerning the project, please open an issue explaining with the maximum of details and with screens if possible.

- If you want to add new features, correct existing code or anything else, open a new pull request. It will be treated as soon as possible. If your code is accepted, it will be pulled.

Make sure to explain as much as you can the news features or issues that you have !

## Authors
[Diogo (diogof648-dev) da Silva Fernandes - DDS](https://github.com/diogof648-dev)

[Geoffroy (Wildigg) Lothar Wildi - GWI](https://github.com/Wildigg)

## Contact
You can contact us at anytime by email :
- diogo.dasilva2@eduvaud.ch
- geoffroy.wildi@eduvaud.ch
