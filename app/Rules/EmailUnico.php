<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class EmailUnico implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query = User::where('email', $value)->where('estado', '!=', 'Eliminado');

        // Si tenemos un ID de usuario, aseguramos que no sea el mismo usuario que estamos editando
        if ($this->userId !== null) {
            $query->where('id', '!=', $this->userId);
        }

        // Obtener el primer usuario que cumpla con las condiciones
        $user = $query->first();

        // Si $user es null, significa que no hay conflicto con otro usuario activo
        return !$user;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El email ya está registrado o está en estado "Eliminado".';
    }
}
