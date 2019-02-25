# Queue

A PHP queue worker example

### Prerequisites

* docker (>=18)
* docker-compose (>=1.23)

### Installing


#### 1. Init

```
git clone git@github.com:lencse/queue.git
cd queue
cp .env.example .env
```

Fill `.env` file with email settings

#### 1. Start app

```
docker-compose up
```

Open [http://localhost:2006/](http://localhost:2006/)

## Running the tests

Once the app is running, you can run the tests

```
docker-compose run php composer test-all
```
