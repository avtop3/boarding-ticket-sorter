<?php
/**
 * Test file for the trip sorter.
 * It's initialize an example of the trip sort.
 */

/**
 * Include bootstrap file to initialize trip sorter.
 */
echo PHP_EOL . 'Trip Sort Test Suit' . PHP_EOL;
echo '==============================' . PHP_EOL;

require_once __DIR__ . '/../src/bootstrap.php';

/**
 * Classes to use in this test.
 */
use \tripsort\assets\CardFactory;
use \tripsort\assets\CardAbstract;
use \tripsort\modules\travel\Travel;


/**
 * Tickets an array of Cards.
 * If you dont define 'type' member for the array the tickets will create by CommonCard class.
 */
$test_tickets = [
    [
        'source'      => 'Dubai Airport',
        'destination' => 'Istanbul Airport',
        'vehicle'     => 'plane',
        'seat'        => '43A',
        'gate'        => null,
    ],
    [
        'source'      => 'Marina',
        'destination' => 'Metro Station',
        'vehicle'     => 'taxi',
        'seat'        => null,
        'gate'        => null,
    ],
    [
        'source'      => 'Amsterdam Airport',
        'destination' => 'NewYork Airport',
        'vehicle'     => 'plane',
        'seat'        => '11A',
        'gate'        => null,
    ],
    [
        'source'      => 'Metro Station',
        'destination' => 'Dubai Airport',
        'vehicle'     => 'metro',
        'seat'        => null,
        'gate'        => null,
    ],
    [
        'source'      => 'Istanbul Airport',
        'destination' => 'Amsterdam Airport',
        'vehicle'     => 'plane',
        'seat'        => '9C',
        'gate'        => 'T4',
    ],
];

$tickets = [];
foreach ($test_tickets as $t) {
    array_push($tickets, CardFactory::create($t));
}

echo PHP_EOL . '- Boarding Cards tests:' . PHP_EOL;

if (!is_array($tickets)) {
    throw new Exception("Tickets should be an array which contains a kind of Card object by extending CardAbstract");
}

foreach ($tickets as $key => $ticket) {
    if ($ticket instanceof CardAbstract) {
        echo 'PASS: ' . $ticket->source . ' to ' . $ticket->destination . ' card should extends CardAbstract' . PHP_EOL;
    } else {
        throw new Exception($ticket->source . ' to ' . $ticket->destination . ' card should extends CardAbstract');
    }
}

/**
 * Create a Travel class and sort boarding cards.
 * Boarding cards should be in correct order
 */

$travel = new Travel($tickets);
$route = $travel->sortTickets()->getTickets();

echo PHP_EOL . '- Order test result for boarding cards:' . PHP_EOL;

for ($i = 0; $i < count($route); $i++) {

    $next = isset($route[$i + 1]) ? $route[$i + 1]->source : $route[$i]->destination;

    if ($route[$i]->destination == $next) {
        echo 'PASS: ' . $route[$i]->source . ' to ' . $route[$i]->destination . ' by ' . $route[$i]->vehicle;
        echo ($route[$i]->gate) ? ', gate ' . $route[$i]->gate : '';
        echo ($route[$i]->seat) ? ', seat ' . $route[$i]->seat : '';
        echo PHP_EOL;
    } else {
        echo 'ERROR: ' . $route[$i]->source . ' to ' . $route[$i]->destination . ' by ' . $route[$i]->vehicle;
        echo ($route[$i]->gate) ? ', gate ' . $route[$i]->gate : '';
        echo ($route[$i]->seat) ? ', seat ' . $route[$i]->seat : '';
        echo PHP_EOL;
    }
    if ($i == count($route) - 1) {
        echo 'PASS: You arrived to final destination.' . PHP_EOL;
        break;
    }
}
