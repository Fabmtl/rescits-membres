<?php 


// add_action('gform_user_registered', 'set_user_role_gf', 10, 3);
function set_user_role_gf($user_id, $feed, $entry)
{

    $full_members_data = array(
        "Membre de la relève scientifique" => array(
            "role" => "membre_releve_scientifique",
            "titre" => '20',
            "departement" => '55',
            "organisation_ou_etablissement" => '56',
            "champs_de_pratique" => '57'
        ),
        "Membre régulier·ère des milieux citoyens, pratiques et communautaires" => array(
            "role" => "membre_regulier",
            "titre" => '41',
            "departement" => '',
            "champs_de_pratique" => '39',
            "organisation_ou_etablissement" => '40'
        ),
        "Membre régulier·ère universitaire ou collégial·e" => array(
            "role" => "membre_regulier",
            "titre" => '20',
            "departement" => '22',
            "champs_de_pratique" => '23',
            "organisation_ou_etablissement" => '21',
        ),
        "Membre collaborateur·rice des milieux citoyens, pratiques et communautaires" => array(
            "role" => "membre_collaborateur",
            "titre" => '73',
            "departement" => '',
            "champs_de_pratique" => '74',
            "organisation_ou_etablissement" => ''
        ),
        "Membre collaborateur·rice universitaire ou collégial·e" => array(
            "role" => "membre_collaborateur",
            "titre" => '68',
            "departement" => '69',
            "champs_de_pratique" => '',
            "organisation_ou_etablissement" => '70'
        )
    );

    $selected_role = rgar($entry, '18');
    $user = new WP_User( $user_id );
    $user->set_role( $full_members_data[$selected_role]["role"] );

    $nom_complet = rgar($entry, '1.3') . " " . rgar($entry, '1.6');
    $titre =  rgar($entry,$full_members_data[$selected_role]["titre"]);
    $departement = rgar($entry,$full_members_data[$selected_role]["departement"]);
    $champs_de_pratique = rgar($entry,$full_members_data[$selected_role]["champs_de_pratique"]);
    $organisation_ou_etablissement = rgar($entry, $full_members_data[$selected_role]["organisation_ou_etablissement"]);

    update_user_meta($user_id, 'rescits_short_member_profil_milieu', $selected_role);
    update_user_meta($user_id, 'rescits_short_member_profil_nom_complet', $nom_complet);
    update_user_meta($user_id, 'rescits_short_member_profil_departement', $departement);
    update_user_meta($user_id, 'rescits_short_member_profil_titre', $titre);
    update_user_meta($user_id, 'rescits_short_member_profil_champs_de_pratique', $champs_de_pratique);
    update_user_meta($user_id, 'rescits_short_member_profil_organisation_ou_etablissement', $organisation_ou_etablissement);

}
