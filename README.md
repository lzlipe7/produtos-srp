Exercise 2 - Cadastro e Listagem de Produtos

How it was implemented:
The project is a minimal PHP application using PSR-4 autoload structure.
It separates responsibilities into Contracts, Domain, Infra and Application.
Products are persisted as JSON lines in storage/products.txt.

What was used:
PHP files with strict types.
PSR-4 compatible layout.
No frameworks or database.
Composer autoload configuration present in composer.json.

Clean code and SRP notes:
Contracts define repository and validator interfaces.
Domain implements validation logic.
Infra handles file IO only.
Application orchestrates creation and listing without outputting HTML.
Public contains simple pages for form, create endpoint and listing.

How to run:
Place the folder in your web server document root or configure your server to point to public/.
Run composer dump-autoload in project root to generate autoload files if using composer.
Open public/index.php to create products and public/products.php to view list.

Storage format:
Each line in storage/products.txt is a single JSON object with keys id, name, price.
