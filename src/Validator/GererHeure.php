<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class GererHeure extends Constraint
{
    public $message = 'L\'heure ne peut pas être inférieure à 7h ou supérieure à 22h, et il faut que l\'heure de fin soit supérieure à l\'heure de début.';
    public $message2 = 'L\'heure de fin doit être supérieure à l\'heure de début et inversement.';
    public $maxHour = '22:00';
    public $compareProperty;

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
