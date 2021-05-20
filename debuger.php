<?php

/**
 * Display variables and stop process
 *
 * @param  mixed[] $values
 * @return void
 */
function debug_var(...$values) { // "..." permet de regroupers tous les paramètres en un tableau ($values)
    var_dump(...$values); // "..." permet ici l'inverse, il split le tableau pour tout remonter au même niveau. équivalent de var_dump($values[0], $values[1], $values[2]);
    die(); // Stop le rendu PHP ici. Plus rien ne s'exécutera et le resultat est directement retourné à l'utilisateur
}
