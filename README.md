## TickMill MiniCRM backend build with Laravel

### Get Repo
```
git clone https://github.com/harrisnic/tickmill-core.git
```
[GitHub Documentation](https://docs.github.com/en/github/creating-cloning-and-archiving-repositories/cloning-a-repository-from-github/cloning-a-repository)

### Installation instructions
```
composer install
```
```
npm install
```
- Copy and edit .env file from .env.example
```
cp .env.example .env
```
- Generate project key
```
php artisan key:generate
```
- Migrate and seed DB
```
php artisan migrate:fresh --seed
```
```
php artisan serve
```
[Tutorial](https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/)
