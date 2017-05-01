Tic-Tac-Toe
===========

An Symfony 3 project with a self-contained custom development environment on Docker.

Include: 

- php7-fpm
- MySql


Usage
-----

Clone the Project.

Start containers using: 
```
docker-compose up -d --build
```

Access to php-fpm:
```
docker exec -it app_dev_fpm sh
```

Install dependencies:
```
composer install
```

Create database schema:
```
bin/console d:s:c
```

Execute tests:
```
php vendor/bin/phpunit tests/
```


List tic-tac-toe commands:
```
/app # bin/console | grep tictactoe
 tictactoe
  tictactoe:user:create <username>                Create a new user with a username
  tictactoe:user:delete <username>                Delete a user by username
  tictactoe:user:get <username>                   Retrieve a user by username
  tictactoe:game:create <username> <username>     Create a new multiplayer game
  tictactoe:game:move <gameId> <column> <row>     Make a move 
  tictactoe:game:status <gameId>                  Return the game status.
```


How to play
-----------

1. Create player 1
    ```
    bin/console tictactoe:user:create Bart
    
    User created with username: Bart
    ```
2. Create player 2
    ```
    bin/console tictactoe:user:create Lisa
    
    User created with username: Lisa
    ```
3. Create new game
    ```
    bin/console tictactoe:game:create Bart Lisa
    
    Game created with players:
    First player: Bart
    Second player: Lisa
    Game ID: 1
    ```
4. Make a move with the first player (gameId, column, row)
    ```
    bin/console tictactoe:game:move 1 3 3
    
    Cooool!!
    
    ( )( )( )
    ( )( )( )
    ( )( )(O)
    ```
5. Keep doing movements until the game finishes

6. Know the game status
    ```
    bin/console tictactoe:game:status 1
    X -> Lisa won!
    
    (X)( )( )
    (X)(O)(O)
    (X)( )(O)
    ```
