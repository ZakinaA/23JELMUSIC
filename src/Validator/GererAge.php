<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class GererAge extends Constraint
{
    public $message = 'L\'âge minimum ne peut pas être supérieur à l\'âge maximum et inversement.';
    public $compareProperty;

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
