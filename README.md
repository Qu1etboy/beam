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

Run dev server

```sh
sail yarn dev
```

## Contributors

-   Weerawong Vonggatunyu 6410406860
-   Sittipong Hemloun 6410401183
-
-
