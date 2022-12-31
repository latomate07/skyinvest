<?php 

namespace App\Services;

use App\Models\User;
use Stripe\StripeClient;

class Stripe 
{
    /**
     * Get stripe object 
     * 
     * @var mixed
     */
    protected $stripe;

    /**
     * Get stripe keys when this class is instanciate
     * 
     * @param string $secret_key
     * @param string $public_key
     */
    public function __construct(
        protected string $secret_key,
        protected string $public_key
    )
    {
        $this->secret_key = $secret_key;
        $this->public_key = $public_key;

        // Get stripe object
        $this->stripe = new StripeClient($secret_key);
    }

    /**
     * Create new stripe customer
     * @param User $user
     */
    public function customer(User $user)
    {
        try {
            $name = is_investor($user->id) ? $user->name : null;
            // Don't continue if user name is not found
            if (is_null($name)) return;
        
            $stripe = $this->stripe;
            $stripe->customers->create([
                'name' => $name
            ]);

            $return = [
                'message' => 'new customer is created !'
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }
}


