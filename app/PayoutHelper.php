<?php

namespace App;

class PayoutHelper
{

    /**
     * 1. We hold funds in our Stripe account for at least 7 days or whatever the refund terms are
     * 2. We grab all invoices that are from refund threshold days back until now
     * 3. After the invoice is passed the refund threshold days it will be transferred to
     * the Express users account automatically from the bot
     */

     /**
      * How it needs to be done. Funds are in Express accounts balance
      * We set payout delay to desired amount in .env file
      * They can't pull out any money until payout delay in days is passed
      * Stripe will check daily so they can do daily payouts
      * --------
      * This is way better because it allows Stripe to automatically handle all of this for us.. WAY BETTER.
      */

}
