<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GererHeureValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\GererHeure $constraint */

        // Récupérer l'objet contenant le champ validé
        $formData = $this->context->getRoot()->getData();

        // Vérifier si l'entité associée au formulaire est bien une instance de Cours
        if ($formData instanceof \App\Entity\Cours) {
            $compareProperty = $constraint->compareProperty;
            $compareValue = $formData->{'get'.$compareProperty}();

            $maxHour = new \DateTime($constraint->maxHour);

            // Vérifier que l'heure est supérieure à 7h et inférieure à 23h
            if ($value !== null && ($value < new \DateTime('7:00') || $value >= new \DateTime('23:00'))) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }

            // Vérifier que l'heure de début est inférieure à l'heure de fin
            if ($compareValue !== null && $value !== null && $compareValue <= $value) {
                $this->context->buildViolation($constraint->message2)
                    ->atPath($constraint->compareProperty)
                    ->addViolation();
            } else return;
        }
    }
}
