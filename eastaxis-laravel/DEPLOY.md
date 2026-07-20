# Deploying this Laravel app to Vercel

Vercel doesn't run PHP as a normal server — every request spins up a fresh,
read-only, stateless function. This works for Laravel, but with real
consequences you need to know before you deploy:

## What will NOT work like a normal server
1. **SQLite (`database/database.sqlite`) will not persist.** Every function
   invocation is a clean environment; anything the previous request wrote to
   disk is gone. You must use an external database (MySQL or Postgres)
   reachable over the internet. Free options: Railway MySQL, Aiven, Supabase
   (Postgres), Neon (Postgres).
2. **Uploaded images (articles/events/experts) will not persist.** The admin
   panel's `Storage::disk('public')->store(...)` calls write to `/tmp`, which
   is wiped after the request. Files will "upload successfully" then vanish.
   For real persistence you'd swap the `public` disk for an S3-compatible
   bucket (AWS S3, Cloudflare R2, DigitalOcean Spaces) — that's a config
   change in `config/filesystems.php` + a filesystem env var, not covered
   here since you asked for a quick live version first.
3. You cannot SSH in or run `php artisan migrate` on Vercel itself — you run
   migrations locally, pointed at your external database, before/after
   deploying.

## What I already set up in this folder
- `api/index.php` — serverless entrypoint that boots Laravel and redirects
  its cache/session/log/view paths to `/tmp` so it doesn't crash trying to
  write to a read-only filesystem.
- `vercel.json` — routes all requests to `api/index.php` via the
  `vercel-php` runtime, and serves `public/**` as static assets.
- `.vercelignore` — keeps local sqlite/logs/cache out of the deployment.

## Steps

### 1. Get an external database
Create a free MySQL or Postgres instance anywhere (Railway is fastest to set
up). Note the host, port, database name, username, password.

### 2. Point your LOCAL `.env` at that database and migrate
```bash
cd eastaxis-laravel
composer install
cp .env.example .env
php artisan key:generate
```
Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=<your-host>
DB_PORT=3306
DB_DATABASE=<your-db-name>
DB_USERNAME=<your-user>
DB_PASSWORD=<your-password>
```
Then run:
```bash
php artisan migrate
php artisan db:seed   # if you want sample data
```
Optionally create an admin user via tinker:
```bash
php artisan tinker
>>> App\Models\User::create(['name'=>'Admin','email'=>'you@example.com','password'=>bcrypt('choose-a-password'),'is_admin'=>true]);
```

### 3. Deploy to Vercel
Install the Vercel CLI once, then from inside `eastaxis-laravel/`:
```bash
npm i -g vercel
vercel login
vercel
```
Follow the prompts (link/create a project). When it finishes, go to your
project's **Settings → Environment Variables** on vercel.com and add every
variable from your local `.env`, at minimum:
```
APP_NAME=EastAxis
APP_ENV=production
APP_KEY=<paste the key from your local .env, keep the "base64:" prefix>
APP_DEBUG=false
APP_URL=https://<your-vercel-domain>.vercel.app

DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=3306
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=cookie
CACHE_STORE=array
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
FILESYSTEM_DISK=public
```
`SESSION_DRIVER=cookie` matters — the default `file` driver would try to
write session files to disk on every request, which won't survive between
requests on Vercel and will randomly log people out / break CSRF.

Then redeploy so the new env vars are picked up:
```bash
vercel --prod
```

### 4. Verify
- Visit `https://<your-domain>.vercel.app/` — homepage should load with your
  seeded articles/events/programs.
- Visit `/admin/login` and sign in with the admin user you created in step 2.

## If this all feels like a lot
It is — Laravel wants a persistent disk and a long-running process, and
Vercel deliberately doesn't offer either. For a smoother experience with
zero code changes, a normal PHP host (Railway, Render, DigitalOcean App
Platform, Laravel Forge) will run this app as-is, with working file uploads
and a local database, in about the same amount of setup time. Happy to set
that up instead if you'd rather.
