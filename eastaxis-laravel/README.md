# EastAxis Research and Consultancy — Laravel Site + Admin Dashboard

Ye aapki static HTML site (`index.html`) ka dynamic Laravel conversion hai, saath mein ek
login-protected admin dashboard jisse aap **Research Articles, Events, Programs, Experts,**
aur **Newsletter Subscribers** manage kar sakte hain.

## Requirements

- PHP >= 8.1
- Composer
- MySQL 5.7+ / MariaDB
- (Optional) Node.js — sirf agar aap frontend build tools add karna chahein; abhi plain CSS use ho raha hai.

## Setup (pehli baar)

```bash
# 1. Dependencies install karo
composer install

# 2. .env file banao
cp .env.example .env

# 3. App key generate karo
php artisan key:generate

# 4. .env mein apna MySQL database set karo
#    DB_DATABASE=eastaxis
#    DB_USERNAME=root
#    DB_PASSWORD=your_password
# (MySQL mein pehle 'eastaxis' naam ka database bana lena: CREATE DATABASE eastaxis;)

# 5. Tables banao + sample data seed karo
php artisan migrate --seed

# 6. Storage symlink banao (uploaded images public dikhne ke liye)
php artisan storage:link

# 7. Server start karo
php artisan serve
```

Ab aapki site `http://localhost:8000` par khulegi.

## Admin Dashboard

- URL: `http://localhost:8000/admin/login`
- Default login (seeder se banaya gaya):
  - **Email:** `admin@eastaxis.test`
  - **Password:** `password`

⚠️ **Production mein daalne se pehle ye password zaroor badal dein** — Tinker se:
```bash
php artisan tinker
>>> $u = App\Models\User::first();
>>> $u->password = Hash::make('naya-strong-password');
>>> $u->save();
```

## Dashboard se kya manage hota hai

| Section | Kya kar sakte hain |
|---|---|
| Research Articles | Add/Edit/Delete — title, type (Paper/Report/Article), image, excerpt, full body, featured/published toggle |
| Events | Add/Edit/Delete — title, date/time, speakers, image |
| Programs | Add/Edit/Delete — title, description, order |
| Experts | Add/Edit/Delete — name, role, photo, bio |
| Newsletter Subscribers | List dekhein, CSV export karein, remove karein |

Public website in sab sections ko database se live fetch karti hai — jaise hi aap dashboard
se koi article/event add karenge, wo turant homepage par dikhega.

## Project Structure (important paths)

```
app/Models/                     -> Article, Event, Program, Expert, Subscriber, User
app/Http/Controllers/            -> Public controllers (Home, Article, Newsletter)
app/Http/Controllers/Admin/      -> Admin CRUD + Auth controllers
resources/views/                 -> Public blade views (uses your original design/CSS)
resources/views/admin/           -> Admin dashboard views
routes/web.php                   -> All routes (public + /admin/*)
database/migrations/             -> Table structures
database/seeders/                -> Sample data + default admin user
public/css/styles.css            -> Your original site design (unchanged)
public/css/admin.css             -> Separate admin dashboard styling
```

## Notes

- Naye images upload karne par wo `storage/app/public/...` mein save hote hain aur
  `storage:link` ke through `public/storage/...` se serve hote hain.
- Newsletter form (`/newsletter`) direct database mein email save karta hai — koi email
  service (Mailchimp etc.) attach nahi hai; chahe to aage add kiya ja sakta hai.
- Agar aap SQLite use karna chahein (MySQL install na karna pade) to `.env` mein:
  ```
  DB_CONNECTION=sqlite
  DB_DATABASE=/full/path/to/database/database.sqlite
  ```
  aur ek empty `database/database.sqlite` file already is project mein maujood hai.
