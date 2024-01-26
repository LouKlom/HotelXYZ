<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/clients/create' => [[['_route' => 'clients_create', '_controller' => 'App\\Controller\\ClientController::create'], null, ['POST' => 0], null, false, false, null]],
        '/seconnecter' => [[['_route' => 'clients_seconnecter', '_controller' => 'App\\Controller\\ClientController::seConnecter'], null, ['POST' => 0], null, false, false, null]],
        '/chambres/standard' => [[['_route' => 'chambre_standard_create', '_controller' => 'App\\Controller\\ChambreController::creerChambreStandard'], null, ['POST' => 0], null, false, false, null]],
        '/chambres/superieur' => [[['_route' => 'chambre_superieur_create', '_controller' => 'App\\Controller\\ChambreController::creerChambreSuperieur'], null, ['POST' => 0], null, false, false, null]],
        '/chambres/suite' => [[['_route' => 'chambre_suite_create', '_controller' => 'App\\Controller\\ChambreController::creerSuite'], null, ['POST' => 0], null, false, false, null]],
        '/chambres' => [[['_route' => 'chambre_list', '_controller' => 'App\\Controller\\ChambreController::listerChambres'], null, ['GET' => 0], null, false, false, null]],
        '/reservation/creer' => [[['_route' => 'reservation_creer', '_controller' => 'App\\Controller\\ReservationController::creerReservation'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/c(?'
                    .'|lients/(?'
                        .'|([^/]++)(*:65)'
                        .'|update/([^/]++)(*:87)'
                        .'|delete/([^/]++)(*:109)'
                    .')'
                    .'|hambres/supprimer/([^/]++)(*:144)'
                .')'
                .'|/portefeuille/(?'
                    .'|cre(?'
                        .'|diter/([^/]++)(*:190)'
                        .'|er/([^/]++)(*:209)'
                    .')'
                    .'|debiter/([^/]++)(*:234)'
                    .'|afficher/([^/]++)(*:259)'
                .')'
                .'|/reservation/([^/]++)(*:289)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        65 => [[['_route' => 'clients_read', '_controller' => 'App\\Controller\\ClientController::read'], ['clientId'], ['GET' => 0], null, false, true, null]],
        87 => [[['_route' => 'clients_update', '_controller' => 'App\\Controller\\ClientController::update'], ['clientId'], ['PUT' => 0], null, false, true, null]],
        109 => [[['_route' => 'clients_delete', '_controller' => 'App\\Controller\\ClientController::delete'], ['clientId'], ['DELETE' => 0], null, false, true, null]],
        144 => [[['_route' => 'chambre_delete', '_controller' => 'App\\Controller\\ChambreController::deleteChambre'], ['chambre'], ['DELETE' => 0], null, false, true, null]],
        190 => [[['_route' => 'crediter_portefeuille', '_controller' => 'App\\Controller\\PortefeuilleController::crediter'], ['portefeuilleId'], ['POST' => 0], null, false, true, null]],
        209 => [[['_route' => 'creer_portefeuille', '_controller' => 'App\\Controller\\PortefeuilleController::creer'], ['clientId'], ['POST' => 0], null, false, true, null]],
        234 => [[['_route' => 'debiter_portefeuille', '_controller' => 'App\\Controller\\PortefeuilleController::debiter'], ['portefeuilleId'], ['POST' => 0], null, false, true, null]],
        259 => [[['_route' => 'afficher_portefeuille', '_controller' => 'App\\Controller\\PortefeuilleController::getPortefeuille'], ['portefeuilleId'], ['GET' => 0], null, false, true, null]],
        289 => [
            [['_route' => 'reservation_afficher', '_controller' => 'App\\Controller\\ReservationController::getReservationsByClientId'], ['clientId'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
