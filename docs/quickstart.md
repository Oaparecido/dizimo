# Quickstart

```bash
# 1. Instalar dependencias
composer install

# 2. Configurar .env
cp .env.example .env
php artisan key:generate

# 3. Rodar migrations (cria o banco SQLite + tabelas)
php artisan migrate

# 4. Iniciar servidor
php artisan serve

# 5. Testar
curl http://localhost:8000/hello
# {"message":"Hello World!"}
```
