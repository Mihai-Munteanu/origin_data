# Origin Data assignment
## Install

```bash
git clone git@github.com:Mihai-Munteanu/origin_data.git
composer install
npm install
```

Create a DB named `origin_data` and add it to `.env`. Then run `php artisan migrate` and `php artisan db:seed` in order to create 10 companies

No authentication is needed.

Then by accessing the following routes you may use the app as follows:
 - POST request on `/companies` -> create a new company;
 - GET request on `/companies` -> view all companies;
 - GET request on `/companies/{company}` -> view only one company;
 - PUT request on `/companies/{company}` -> update a company;
 - DELETE request on `/companies/{company}` -> delete a company;
