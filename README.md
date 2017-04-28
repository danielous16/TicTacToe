Tic-Tac-Toe
===========

An Symfony 3 project with a self-contained custom development environment on Docker.

Include: 

- php7-fpm
- MySql


Usage
-----

1. Clone the Project.
2. Start containers using: 
```
docker-compose up -d --build
```

Access to php-fpm:
```
docker exec -it app_dev_fpm sh
```

Execute tests:
```
php vendor/bin/phpunit tests/
```


List tic-tac-toe commands:
```
/app # bin/console | grep tictactoe
 tictactoe
  tictactoe:game:create                   Create a new multiplayer game
  tictactoe:game:move                     Make a move
  tictactoe:game:status                   Return the game status.
  tictactoe:user:create                   Create a new user with a username
  tictactoe:user:delete                   Delete a user by username
  tictactoe:user:get                      Retrieve a user by username
```


