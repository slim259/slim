<?php
require_once 'AttackPokemon.php';

class Pokemon {
    protected $name;
    protected $imageUrl;
    protected $hp;
    protected $attackPokemon;
    protected $type = 'Normal';

    public function __construct($name, $imageUrl, $hp, AttackPokemon $attack) {
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->hp = $hp;
        $this->attackPokemon = $attack;
    }

    // Getters
    public function getName() { return $this->name; }
    public function getImage() { return $this->imageUrl; }
    public function getHp() { return $this->hp; }
    public function getType() { return $this->type; }

    // Méthodes de combat
    public function isDead() {
        return $this->hp <= 0;
    }

    public function attack(Pokemon $target) {
        $damage = $this->calculateDamage($target);
        $target->hp -= $damage;

        return [
            'attacker' => $this->name,
            'target' => $target->name,
            'damage' => $damage,
            'special' => $this->wasSpecialAttack,
            'target_hp' => max(0, $target->hp)
        ];
    }

    protected function calculateDamage(Pokemon $target) {
        $baseDamage = $this->attackPokemon->calculateDamage();
        $this->wasSpecialAttack = false;

        if ($this->attackPokemon->isSpecialAttack()) {
            $this->wasSpecialAttack = true;
            return $baseDamage * $this->attackPokemon->getSpecialAttack();
        }

        return $baseDamage;
    }

    public function whoAmI() {
        return sprintf(
            "<div style='border:1px solid #000; padding:10px; margin:10px;'>
                <img src='%s' width='100'><br>
                <strong>%s</strong> (Type: %s)<br>
                HP: %d<br>
                Attaque: %d-%d (Spécial: x%d, %d%% chance)
            </div>",
            $this->imageUrl,
            $this->name,
            $this->type,
            $this->hp,
            $this->attackPokemon->getAttackMinimal(),
            $this->attackPokemon->getAttackMaximal(),
            $this->attackPokemon->getSpecialAttack(),
            $this->attackPokemon->getProbability()
        );
    }
}
?>