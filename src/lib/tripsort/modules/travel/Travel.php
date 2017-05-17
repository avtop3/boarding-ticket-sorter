<?php
/**
 * Travel class.
 * Sorts a stack of Cards to make a trip in correct order.
 */

namespace tripsort\modules\travel;

use \tripsort\utils\sorters\ArraySort as TicketSort;
use \tripsort\assets\CardAbstract;
use \Exception;

/**
 * Create more than one Card class and give it to this class.
 * You could able to order the trip cards by calling sortTickets() method.
 * @param array $tickets An array of the Card class.
 */
class Travel
{

    /**
     * An unordered array of Card class.
     */
    public $tickets = null;

    /**
     * Constructor of the Travel
     * @param CardAbstract[] $tickets An array of unsorted boarding cards.
     * @return Travel
     */
    function __construct($tickets)
    {
        $this->setTickets($tickets);

        return $this;
    }


    /**
     * returns an array of boarding cards.
     * @return CardAbstract[]
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Setter for tickets
     * @param CardAbstract[] $tickets an array of unsorted boarding cards.
     * @throws Exception
     * @return Travel
     */
    public function setTickets(array $tickets)
    {

        foreach ($tickets as $ticket) {
            if (!$ticket instanceof CardAbstract) {
                throw new Exception("Cards should be an instance of CardAbstract class");
            }
        }

        $this->tickets = $tickets;

        return $this;
    }

    /**
     * Adds a ticket to the ticket stack.
     *
     * @param CardAbstract $ticket an instance of Card class.
     * @return Travel
     */
    public function addTicket(CardAbstract $ticket)
    {
        if (is_array($this->tickets)) {
            array_push($this->tickets, $ticket);
        }

        if (is_null($this->tickets)) {
            $this->tickets = [$ticket];
        }

        return $this;
    }

    /**
     * Sorts tickets as ascended
     * @return Travel
     */
    public function sortTickets()
    {
        $this->tickets = TicketSort::sort($this->tickets);

        return $this;
    }
}
