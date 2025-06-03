<?php

class PokemonFeu extends Pokemon {
    protected $type = 'Feu';

    protected function calculateDamage(Pokemon $target) {
        $baseDamage = parent::calculateDamage($target);

        switch($target->getType()) {
            case 'Plante': return $baseDamage * 2;
            case 'Eau': case 'Feu': return $baseDamage * 0.5;
            default: return $baseDamage;
        }
    }
}