<?php
require_once 'Pokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonEau.php';
require_once 'PokemonPlante.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Combat Pokémon Épique</title>
    <style>
        :root {
            --feu: #EE8130;
            --eau: #6390F0;
            --plante: #7AC74C;
            --normal: #A8A77A;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .pokemon-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 20px;
            margin: 20px 0;
            display: flex;
            align-items: center;
        }

        .pokemon-image {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin-right: 20px;
        }

        .pokemon-info {
            flex-grow: 1;
        }

        .health-bar {
            height: 20px;
            background: #e0e0e0;
            border-radius: 10px;
            margin: 10px 0;
            overflow: hidden;
        }

        .health-fill {
            height: 100%;
            background: #4CAF50;
            transition: width 0.5s;
        }

        .battle-log {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            max-height: 300px;
            overflow-y: auto;
        }

        .round {
            background: #f8f9fa;
            border-left: 4px solid #6c757d;
            padding: 10px;
            margin: 10px 0;
            border-radius: 0 5px 5px 0;
        }

        .attack {
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
            animation: fadeIn 0.3s;
        }

        .normal-attack {
            background: #e9ecef;
        }

        .special-attack {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
        }

        .critical-hit {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            animation: pulse 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .winner-banner {
            background: linear-gradient(45deg, #ffc107, #fd7e14);
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 10px;
            font-size: 1.5em;
            margin: 20px 0;
            animation: rainbow 2s infinite;
        }

        @keyframes rainbow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body>
<h1 style="text-align: center; color: #dc3545;">Combat Pokémon Épique</h1>

<div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
    <?php
    // Création des Pokémons
    $dracaufeu = new PokemonFeu(
        'Dracaufeu',
        'https://assets.pokemon.com/assets/cms2/img/pokedex/full/006.png',
        120,
        new AttackPokemon(15, 25, 2, 30)
    );

    $tortank = new PokemonEau(
        'Tortank',
        'https://assets.pokemon.com/assets/cms2/img/pokedex/full/009.png',
        150,
        new AttackPokemon(10, 20, 1.8, 25)
    );

    // Affichage des Pokémons
    displayPokemon($dracaufeu);
    displayPokemon($tortank);

    function displayPokemon($pokemon) {
        $typeColor = '';
        switch($pokemon->getType()) {
            case 'Feu': $typeColor = 'var(--feu)'; break;
            case 'Eau': $typeColor = 'var(--eau)'; break;
            case 'Plante': $typeColor = 'var(--plante)'; break;
            default: $typeColor = 'var(--normal)';
        }

        echo '<div class="pokemon-card" style="border-top: 5px solid '.$typeColor.'">';
        echo '<img src="'.$pokemon->getImage().'" class="pokemon-image">';
        echo '<div class="pokemon-info">';
        echo '<h2 style="margin: 0;">'.$pokemon->getName().' <small style="color: '.$typeColor.'">'.$pokemon->getType().'</small></h2>';
        echo '<div class="health-bar">';
        echo '<div class="health-fill" id="health-'.strtolower($pokemon->getName()).'" style="width: 100%;"></div>';
        echo '</div>';
        echo '<p>PV: <span id="hp-'.strtolower($pokemon->getName()).'">'.$pokemon->getHp().'</span>/'.$pokemon->getHp().'</p>';
        echo '</div></div>';
    }
    ?>
</div>

<div class="battle-log">
    <h2 style="text-align: center; border-bottom: 1px solid #eee; padding-bottom: 10px;">Journal de Combat</h2>
    <div id="battle-content">
        <?php
        // Simulation du combat
        $round = 1;
        $battleHistory = [];

        while (!$dracaufeu->isDead() && !$tortank->isDead()) {
            $roundData = [];

            echo '<div class="round">';
            echo '<h3 style="margin-top: 0;">Tour '.$round.'</h3>';

            // Dracaufeu attaque
            $result = $dracaufeu->attack($tortank);
            $roundData[] = $result;
            displayAttack($result);

            // Tortank contre-attaque s'il survit
            if (!$tortank->isDead()) {
                $result = $tortank->attack($dracaufeu);
                $roundData[] = $result;
                displayAttack($result);
            }

            echo '</div>';
            $battleHistory[] = $roundData;
            $round++;

            // Pause pour l'animation (simulée avec JavaScript plus bas)
            if ($dracaufeu->isDead() || $tortank->isDead()) break;
        }

        function displayAttack($result) {
            $class = 'normal-attack';
            if ($result['special']) $class = 'special-attack';
            if ($result['damage'] > ($result['attacker'] === 'Dracaufeu' ? 22 : 18)) $class = 'critical-hit';

            echo '<div class="attack '.$class.'">';
            echo '<strong>'.$result['attacker'].'</strong> attaque <strong>'.$result['target'].'</strong> ';

            if ($class === 'special-attack') {
                echo 'avec une <em>attaque spéciale</em> ';
            } elseif ($class === 'critical-hit') {
                echo 'avec un <em>coup critique</em> ';
            }

            echo 'et inflige <strong>'.$result['damage'].' dégâts</strong>.<br>';
            echo 'PV restants: <strong>'.$result['target_hp'].'</strong>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<?php if ($dracaufeu->isDead() || $tortank->isDead()): ?>
    <div class="winner-banner">
        <?php
        if ($dracaufeu->isDead() && $tortank->isDead()) {
            echo 'Match nul ! Les deux Pokémons sont K.O.';
        } else {
            $winner = $dracaufeu->isDead() ? $tortank : $dracaufeu;
            echo $winner->getName().' remporte la victoire avec '.$winner->getHp().' PV restants !';
        }
        ?>
    </div>
<?php endif; ?>

<script>
    // Animation des barres de vie
    document.addEventListener('DOMContentLoaded', function() {
        const battleContent = document.getElementById('battle-content');
        const rounds = battleContent.getElementsByClassName('round');

        // Masquer initialement tous les rounds sauf le premier
        for (let i = 1; i < rounds.length; i++) {
            rounds[i].style.display = 'none';
        }

        // Fonction pour afficher progressivement le combat
        let currentRound = 0;
        const showNextRound = () => {
            if (currentRound < rounds.length - 1) {
                currentRound++;
                rounds[currentRound].style.display = 'block';

                // Mise à jour des barres de vie
                const attacks = rounds[currentRound].getElementsByClassName('attack');
                for (let attack of attacks) {
                    const target = attack.textContent.match(/attaque (\w+)/)[1].toLowerCase();
                    const hpText = attack.textContent.match(/PV restants: (\d+)/);
                    if (hpText) {
                        const currentHp = parseInt(hpText[1]);
                        const maxHp = target === 'tortank' ? 150 : 120;
                        const percentage = (currentHp / maxHp) * 100;

                        document.getElementById(`health-${target}`).style.width = `${percentage}%`;
                        document.getElementById(`hp-${target}`).textContent = currentHp;
                    }
                }

                // Défilement automatique
                rounds[currentRound].scrollIntoView({ behavior: 'smooth' });

                // Pause entre les tours
                if (currentRound < rounds.length - 1) {
                    setTimeout(showNextRound, 1500);
                }
            }
        };

        // Démarrer l'animation après un court délai
        setTimeout(showNextRound, 1000);
    });
</script>
</body>
</html>