<?php
class AttackPokemon {
    private $attackMinimal;
    private $attackMaximal;
    private $specialAttack;
    private $probabilitySpecialAttack;

    public function __construct($min, $max, $special, $probability) {
        $this->attackMinimal = $min;
        $this->attackMaximal = $max;
        $this->specialAttack = $special;
        $this->probabilitySpecialAttack = $probability;
    }

    // Getters
    public function getAttackMinimal() { return $this->attackMinimal; }
    public function getAttackMaximal() { return $this->attackMaximal; }
    public function getSpecialAttack() { return $this->specialAttack; }
    public function getProbability() { return $this->probabilitySpecialAttack; }

    // Calcul des dégâts
    public function calculateDamage() {
        return rand($this->attackMinimal, $this->attackMaximal);
    }

    public function isSpecialAttack() {
        return rand(1, 100) <= $this->probabilitySpecialAttack;
    }
}
?>