echo "# fenixCorp
Monorepo
- api: Laravel
- web: Vite/Tailwind

## Setup rápido
cd api && copy .env.example .env && composer install && php artisan key:generate
cd ../web && npm ci && npm run dev
" > README.md
git add README.md
git commit -m "docs: README mínimo"
git push