<?php

class PokemonPlante extends Pokemon {
    protected $type = 'Plante';

    protected function calculateDamage(Pokemon $target) {
        $baseDamage = parent::calculateDamage($target);

        switch($target->getType()) {
            case 'Eau': return $baseDamage * 2;
            case 'Plante': case 'Feu': return $baseDamage * 0.5;
            default: return $baseDamage;
        }
    }
}