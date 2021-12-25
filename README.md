#### Installation
- clone project into your working sites directory.
- Go to command line in the project and run `composer install`
- Copy `.env.example`  to `.env` [Make sure you put valid database connection string.]
- Run `yarn` which will install npm dependencies
  - Run `yarn mix` which will compile frtonend.
However i am going to include compiled css & js file so the reviewer doesn't have to rebuild the frontend on their system.
I would prefer not to include compiled files in the project for most cases.
- Run 'php artisan migrate' to orchestrate database table.

Working demo gif

![alt text](![alt text](https://github.com/izshreyansh/nullte/blob/master/demo.gif?raw=true))

