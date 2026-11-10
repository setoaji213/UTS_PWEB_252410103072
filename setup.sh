
set -e
NAME=${1:-UTS_PWEB_NIM}
HERE="$(cd "$(dirname "$0")" && pwd)"
composer create-project laravel/laravel "$NAME"
cp -r "$HERE/routes" "$HERE/app" "$HERE/resources" "$HERE/public" "$NAME"/
cd "$NAME"
sed -i 's/^SESSION_DRIVER=.*/SESSION_DRIVER=file/' .env
echo "Selesai. Jalankan: cd $NAME && php artisan serve"
