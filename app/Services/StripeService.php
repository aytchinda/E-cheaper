<?php

namespace App\Services;

use App\Models\Method;
use Illuminate\Support\Facades\App;

class StripeService
{
    private $method;

    public function __construct()
    {
        // Vérifie si la méthode Stripe est disponible
        $this->method = Method::where('name', 'Stripe')->first();
    }

    // Implémentez ici la logique de votre service
    public function getPublicKey()
    {
        if ($this->method) {
            return App::environment('production')
                ? $this->method->prod_public_key
                : $this->method->test_public_key;
        }

        return null; // Gérer le cas où la méthode n'est pas trouvée en base de données
    }

    public function getPrivateKey()
    {
        if ($this->method) {
            return App::environment('production')
                ? $this->method->prod_private_key
                : $this->method->test_private_key;
        }

        return null; // Gérer le cas où la méthode n'est pas trouvée en base de données
    }
}