<?php

class PokemonEau extends Pokemon {
    protected $type = 'Eau';

    protected function calculateDamage(Pokemon $target) {
        $baseDamage = parent::calculateDamage($target);

        switch($target->getType()) {
            case 'Feu': return $baseDamage * 2;
            case 'Eau': case 'Plante': return $baseDamage * 0.5;
            default: return $baseDamage;
        }
    }
}