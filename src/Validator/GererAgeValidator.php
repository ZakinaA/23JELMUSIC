<?php

namespace App\Validator;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GererAgeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\GererAge $constraint */

        // Récupérer l'entité du contexte
        $entity = $this->context->getObject();

        if ($entity instanceof \App\Entity\Cours) {
            $compareProperty = $constraint->compareProperty;
            $compareValue = $entity->{'get' . ucfirst($compareProperty)}();

            // Comparer les valeurs directement
            if ($value > $compareValue) {
                $this->context->buildViolation($constraint->message)
                    ->atPath($constraint->compareProperty)
                    ->addViolation();
            }
        }
    }
}