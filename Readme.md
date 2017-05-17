***Boarding trip sorter***
==============================================
Description 
----------------------------------------------
Travel class sorts your unordered boarding cards. 

**Each ticket must have destination and source**.

`vehicle, seat, gate members` are optional.

### Dependencies
- PHP 5.6
- Any kind of *nix OS

### Extending class
* You can use ArraySort to sort anything, not only boarding cards.
* You can create new type of cards like plane, train, bus or whatever you want. (Default: CommonCard)
* You can able to create a gift class that you can give a track to the your shipping.
* If you would like you can create another kind of sort algorithm by extending SortInterface. 

Files 
----------------------------------------------
    .
    ├── Readme.md
    ├── src
    │   ├── bootstrap.php
    │   └── lib
    │       └── tripsort
    │           ├── assets
    │           │   ├── CardAbstract.php
    │           │   ├── CardFactory.php
    │           │   └── cards
    │           │       └── CommonCard.php
    │           ├── modules
    │           │   └── travel
    │           │       └── Travel.php
    │           └── utils
    │               ├── interfaces
    │               │   └── SortInterface.php
    │               └── sorters
    │                   └── ArraySort.php
    └── test
        └── index.php



Run test 
----------------------------------------------
$ php test/index.php


Usage 
----------------------------------------------
### Include bootstrap file.
    require_once 'src/bootstrap.php';

### Create two tickets
    $tickets = array(
      CardFactory::create(array(
        'source' => 'Metro Station',
        'destination' => 'Dubai Airport',
        'vehicle' => 'metro',
        'seat' => null,
        'gate' => null
      )),
      CardFactory::create(array(
        'source' => 'Marina',
        'destination' => 'Metro Station',
        'vehicle' => 'taxi',
        'seat' => null,
        'gate' => null
      ))
    );

### Give the correct order of boarding cards
    $travel = new Travel($tickets);
    $route = $travel->sortTickets()->getTickets();
    
$route will be an array of the ordered tickets.
