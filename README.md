# Beam - An Event Organizer App

<a href="https://app.clickup.com/9003200262/v/l/7-9003200262-1" target="_blank">
<img src="https://img.shields.io/badge/clickup-%237B68EE.svg?&style=for-the-badge&logo=clickup&logoColor=white" />
</a>

Midterm project for CS442 Web Technology and Web Service

## How to contribute

1. Clone this repo

```
git clone https://github.com/Qu1etboy/beam.git
```

2. Create new branch for new feature

```
git checkout -b <feature_name>
```

3. After you are done with your code, add and commit then push back to GitHub

```
git push origin <feature_name>
```

4. On GitHub open a pull request and write a comment on what you have done.

5. If there are no conflicts click Squash merge or Rebase and merge (this will make our commits history clean)

6. If you encounter merge conflict don't panic, come and ask your teammate to discuss what we should do.

> See all tasks and requirement on [Clickup](https://app.clickup.com/9003200262/v/l/7-9003200262-1)

## Local Development

In `.env` file add google client id and google client secret

```
GOOGLE_CLIENT_ID=<your_google_client_id>
GOOGLE_CLIENT_SECRET=<your_google_client_secret>
GOOGLE_CALLBACK_URL=http://localhost:80/auth/google/callback
```

Which can be found in [Google Cloud Console](https://console.cloud.google.com/apis/credentials)

Install laravel dependencies

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Create sail alias first if you haven't

```sh
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Run all container

```sh
sail up -d
```

Install node dependencies

```sh
sail yarn install
```

Run migration

```sh
sail artisan migrate:fresh --seed
```

Link storage

```sh
sail artisan storage:link
```

For Laravel Scout and Meilisearch

```
sail artisan scout:sync-index-settings
sail artisan scout:flush "App\Models\Event"
sail artisan scout:import "App\Models\Event"
```

Run dev server

```sh
sail yarn dev
```

## Accessing the app

The app is mapped to port 80 on host machine
[http://localhost](http://localhost)

PhpMyAdmin is mapped to port 8080 on host machine
[http://localhost:8080](http://localhost:8080)

## Contributors

-   Weerawong Vonggatunyu 6410406860
-   Sittipong Hemloun 6410401183
-   Urawit Jearrajinda 6410406932
-   Watcharavit Jiracheeppattana 6410401159
