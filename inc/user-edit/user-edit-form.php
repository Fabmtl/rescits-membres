<?php

    function get_gf_user_infos($infos)
    {
        $data = [
            'informations_generales'                  => [
                'first_name'              => 'Prenom',
                'last_name'               => 'Nom',
                'membre_adresse_ligne_1'  => 'Adresse',
                'membre_adresse_ville'    => 'Ville',
                'membre_adresse_zip'      => 'ZIP / Code postal',
                'membre_adresse_province' => 'Province',
                'membre_adresse_pays'     => 'Pays',
                'membre_phone_perso'      => 'Téléphone (cellulaire ou résidence)',
                'membre_phone_buro'       => 'Téléphone (bureau)',
                'email'                   => 'Courriel',
                'url'                     => 'Site Web',
                'membre_categorie' => 'Catégorie de membre'
            ],
            'membre_universitaire_collegial_regulier' => [
                'membre_universitaire_collegial_regulier_titre'               => 'Titre du poste occupé',
                'membre_universitaire_collegial_regulier_etablissement'       => 'Membre Universitaire Collegial Regulier Etablissement',
                'membre_universitaire_collegial_regulier_departement'         => 'Département',
                'membre_universitaire_collegial_regulier_titre_champ_interet' => 'Champ(s) d’intérêt',
                'membre_universitaire_collegial_regulier_affiliation_1'       => 'Affiliation(s) à un institut, centre, chaire ou groupe de recherche 1',
                'membre_universitaire_collegial_regulier_affiliation_2'       => 'Affiliation(s) à un institut, centre, chaire ou groupe de recherche 2',
                'membre_universitaire_collegial_regulier_motivation'          => 'Motivation',
                'membre_universitaire_collegial_regulier_bio'                 => 'Courte biographie',
                'membre_universitaire_collegial_regulier_cv'                  => 'Cv',
            ],
            'membre_citoyen_regulier'                 => [
                'membre_citoyen_regulier_type_membre'         => 'Type Membre',
                'membre_citoyen_regulier_champ_pratique'      => 'Champ(s) de pratique',
                'membre_citoyen_regulier_organisation'        => 'Organisation',
                'membre_citoyen_regulier_titre'               => 'Titre du poste occupé',
                'membre_citoyen_regulier_sitweb_organisation' => 'Page web de l’organisation',
                'membre_citoyen_regulier_activite'            => 'Activité(s) ou thématique(s)',
                'membre_citoyen_regulier_affiliation_1'       => 'Affiliation(s) à un institut, centre, chaire ou groupe de recherche, le cas échéant 1',
                'membre_citoyen_regulier_affiliation_2'       => 'Affiliation(s) à un institut, centre, chaire ou groupe de recherche, le cas échéant 2',
                'membre_citoyen_regulier_motivation'          => 'Motivation',
                'membre_citoyen_regulier_bio'                 => 'Courte biographie',
                'membre_citoyen_regulier_cv'                  => 'Cv',
            ],
            'membre_releve_scientifique'              => [
                'membre_releve_scientifique_programme'        => 'Programme d’études',
                'membre_releve_scientifique_departement'      => 'Département',
                'membre_releve_scientifique_institution'      => 'Institution universitaire',
                'membre_releve_scientifique_sujet_recherche'  => 'Sujet de la recherche ou titre',
                'membre_releve_scientifique_nom_soutien'      => 'Nom de la personne membre soutenant la demande d’adhésion',
                'membre_releve_scientifique_institut_attache' => 'Institut d’attache de la personne membre soutenant la demande d’adhésion',
                'membre_releve_scientifique_lien_soutien'     => 'Lien avec la personne membre soutenant la demande d’adhésion',
                'membre_releve_scientifique_affiliation_1'    => 'Affiliation à un institut, centre, chaire ou groupe de recherche, le cas échéant 1',
                'membre_releve_scientifique_affiliation_2'    => 'Affiliation à un institut, centre, chaire ou groupe de recherche, le cas échéant 2',
                'membre_releve_scientifique_resume_projet'    => 'Résumé du projet de mémoire ou de thèse en mettant de l\'avant la méthodologie',
            ],
            'membre_collaborateur_citoyen'                    => [
                // 'membre_collaborateur_type' => 'Membre collaborateur·rice',
                'membre_collaborateur_milieux_cpc_titre'          => 'Titre et organisme (optionnel)',
                'membre_collaborateur_milieux_cpc_champ_pratique' => 'Champ(s) de pratique',
                'membre_collaborateur_milieux_cpc_affiliation'    => 'Affiliation(s) à un institut, centre, chaire ou groupe de recherche',
                'membre_collaborateur_collaboration'              => 'Collaborez-vous avec un·e ou des membre(s) régulier·ère(s) du Réseau de recherche sur les savoirs citoyens et approches cocréatives?',
                'membre_collaborateur_collaboration_oui'          => 'Si oui, quel est le nom de la personne membre',
                'membre_collaborateur_projet'                     => 'Nom du projet sur lequel vous collaborez?',
                'membre_collaborateur_avec_qui_collaborer'        => 'Avec quelle(s) personne(s) ou sur quelle(s) thématique(s) souhaiteriez-vous collaborer?',
            ],
            'membre_collaborateur_universitaire'                    => [
                // 'membre_collaborateur_type' => 'Membre collaborateur·rice',
                'membre_collaborateur_universitaire_titre'        => 'Titre du poste occupé',
                'membre_collaborateur_universitaire_departement'  => 'Département',
                'membre_collaborateur_universitaire_institution'  => 'Institution universitaire ou collégiale',
                'membre_collaborateur_collaboration'              => 'Collaborez-vous avec un·e ou des membre(s) régulier·ère(s) du Réseau de recherche sur les savoirs citoyens et approches cocréatives?',
                'membre_collaborateur_collaboration_oui'          => 'Si oui, quel est le nom de la personne membre',
                'membre_collaborateur_projet'                     => 'Nom du projet sur lequel vous collaborez?',
                'membre_collaborateur_avec_qui_collaborer'        => 'Avec quelle(s) personne(s) ou sur quelle(s) thématique(s) souhaiteriez-vous collaborer?',
            ],
        ];

        return $data[$infos];
    }

    add_action('gform_user_registered', 'set_user_role', 10, 3);

    /**
     * Définit le rôle de l'utilisateur lors de son inscription via Gravity Forms.
     *
     * @param int $user_id L'ID de l'utilisateur.
     * @param array $feed Les données du feed.
     * @param array $entry Les données de l'entrée du formulaire.
     */
    function set_user_role($user_id, $feed, $entry)
    {
        $roles = [
            'Membre régulier·ère des milieux citoyens, pratiques et communautaires'       => 'membre_regulier_citoyen',
            'Membre régulier·ère universitaire ou collégial·e'                            => 'membre_regulier_universitaire',
            'Membre de la relève scientifique'                                            => 'membre_releve_scientifique',
            'Membre collaborateur·rice des milieux citoyens, pratiques et communautaires' => 'membre_collaborateur_citoyen',
            'Membre collaborateur·rice universitaire ou collégial·e'                      => 'membre_collaborateur_universitaire',
        ];
        // get role from field 5 of the entry.
        $selected_role = rgar($entry, '18');
        $user          = new WP_User($user_id);
        $user->set_role($roles[$selected_role]);
    }

    // Add custom fields to the user edit page in WordPress
    function add_custom_user_meta_fields($user)
    {

        $informations_generales                  = get_gf_user_infos('informations_generales');
        $membre_universitaire_collegial_regulier = get_gf_user_infos('membre_universitaire_collegial_regulier');
        $membre_citoyen_regulier                 = get_gf_user_infos('membre_citoyen_regulier');
        $membre_releve_scientifique              = get_gf_user_infos('membre_releve_scientifique');
        $membre_collaborateur_citoyen            = get_gf_user_infos('membre_collaborateur_citoyen');
        $membre_collaborateur_universitaire      = get_gf_user_infos('membre_collaborateur_universitaire');

        echo '<div id="recits-custom-profile">';

        echo '<h2>Informations du membre</h2>';
        echo '<h2>' . esc_attr(get_user_meta($user->ID, 'membre_categorie', true)) . '</h2>';

        echo '<div id="recits-custom-profile-content">';

        ob_start();
    ?>
            <div>
                <div id="image_preview">
                    <?php
                        $image = get_user_meta($user->ID, 'photo_membre', true);
                            if ($image) {
                                echo '<img src="' . esc_url($image) . '" width="250" />';
                            }
                        ?>
                </div>
                <div id="image-de-profile-du-membre">
                    <input type="button" name="upload_image_button" id="upload_image_button" class="button" value="Télécharger l'image" />
                    <input type="hidden" name="photo_membre" id="photo_membre" value="<?php echo esc_attr(get_user_meta($user->ID, 'photo_membre', true)); ?>" />
                    <input type="button" name="delete_image_button" id="delete_image_button" class="button" value="Effacer l'image" />

                </div>
            </div><div></div>
        <?php
            $photo_membre = ob_get_clean();
            echo $photo_membre;

                foreach ($informations_generales as $slug => $label) {
                    $meta_value = esc_attr(get_user_meta($user->ID, $slug, true));
                    echo "<div class='user-field'><label for='{$slug}'>{$label}</label>
                    <input type='text' name='{$slug}' id='{$slug}' value='{$meta_value}' class='regular-text' /></div>";
                }

                if (in_array('membre_regulier_citoyen', $user->roles)) {

                    foreach ($membre_citoyen_regulier as $slug => $label) {
                        $meta_value = esc_attr(get_user_meta($user->ID, $slug, true));
                        echo "<div class='user-field'><label for='{$slug}'>{$label}</label>
                        <input type='text' name='{$slug}' id='{$slug}' value='{$meta_value}' class='regular-text' /></div>";
                    }
                }

                if (in_array('membre_regulier_universitaire', $user->roles)) {

                    foreach ($membre_universitaire_collegial_regulier as $slug => $label) {
                        $meta_value = esc_attr(get_user_meta($user->ID, $slug, true));
                        echo "<div class='user-field'><label for='{$slug}'>{$label}</label>
                        <input type='text' name='{$slug}' id='{$slug}' value='{$meta_value}' class='regular-text' /></div>";
                    }
                }

                if (in_array('membre_collaborateur_citoyen', $user->roles)) {

                    echo '<h2>' . esc_attr(get_user_meta($user->ID, 'membre_collaborateur_type', true)) . '</h2>';
                    foreach ($membre_collaborateur_citoyen as $slug => $label) {
                        $meta_value = esc_attr(get_user_meta($user->ID, $slug, true));
                        echo "<div class='user-field'><label for='{$slug}'>{$label}</label>
                        <input type='text' name='{$slug}' id='{$slug}' value='{$meta_value}' class='regular-text' /></div>";
                    }
                }
                if (in_array('membre_collaborateur_universitaire', $user->roles)) {

                    echo '<h2>' . esc_attr(get_user_meta($user->ID, 'membre_collaborateur_type', true)) . '</h2>';
                    foreach ($membre_collaborateur_universitaire as $slug => $label) {
                        $meta_value = esc_attr(get_user_meta($user->ID, $slug, true));
                        echo "<div class='user-field'><label for='{$slug}'>{$label}</label>
                        <input type='text' name='{$slug}' id='{$slug}' value='{$meta_value}' class='regular-text' /></div>";
                    }
                }
                if (in_array('membre_releve_scientifique', $user->roles)) {

                    echo '<h2>' . esc_attr(get_user_meta($user->ID, 'membre_collaborateur_type', true)) . '</h2>';
                    foreach ($membre_releve_scientifique as $slug => $label) {
                        $meta_value = esc_attr(get_user_meta($user->ID, $slug, true));
                        echo "<div class='user-field'><label for='{$slug}'>{$label}</label>
                        <input type='text' name='{$slug}' id='{$slug}' value='{$meta_value}' class='regular-text' /></div>";
                    }
                }

                // echo '</table>';
                echo '<div/>';
                echo '<div/>';
            }

            add_action('show_user_profile', 'add_custom_user_meta_fields');
            add_action('edit_user_profile', 'add_custom_user_meta_fields');

            // Save custom fields when user profile is updated
            function save_custom_user_meta_fields($user_id)
            {
                if (! current_user_can('edit_user', $user_id)) {
                    return false;
                }
                // 'membre_nom', 'membre_prenom','membre_email','membre_siteweb'
                $fields = [
                    'first_name', 'last_name', 'photo_membre', 'email', 'membre_adresse_ligne_1', 'membre_adresse_ligne_2',
                    'membre_adresse_ville', 'membre_adresse_zip', 'membre_adresse_province', 'membre_adresse_pays',
                    'membre_phone_perso', 'membre_phone_buro', 'url', 'membre_categorie',
                    'membre_universitaire_collegial_regulier_titre', 'membre_universitaire_collegial_regulier_etablissement',
                    'membre_universitaire_collegial_regulier_departement', 'membre_universitaire_collegial_regulier_titre_champ_interet',
                    'membre_universitaire_collegial_regulier_affiliation_1', 'membre_universitaire_collegial_regulier_affiliation_2',
                    'membre_universitaire_collegial_regulier_motivation', 'membre_universitaire_collegial_regulier_bio',
                    'membre_universitaire_collegial_regulier_cv', 'membre_citoyen_regulier_type_membre',
                    'membre_citoyen_regulier_champ_pratique', 'membre_citoyen_regulier_organisation',
                    'membre_citoyen_regulier_titre', 'membre_citoyen_regulier_sitweb_organisation',
                    'membre_citoyen_regulier_activite', 'membre_citoyen_regulier_affiliation_1',
                    'membre_citoyen_regulier_affiliation_2', 'membre_citoyen_regulier_motivation',
                    'membre_citoyen_regulier_bio', 'membre_citoyen_regulier_cv',
                    'membre_releve_scientifique_programme', 'membre_releve_scientifique_departement',
                    'membre_releve_scientifique_institution', 'membre_releve_scientifique_sujet_recherche',
                    'membre_releve_scientifique_nom_soutien', 'membre_releve_scientifique_institut_attache',
                    'membre_releve_scientifique_lien_soutien', 'membre_releve_scientifique_affiliation_1',
                    'membre_releve_scientifique_affiliation_2', 'membre_releve_scientifique_resume_projet',
                    'membre_collaborateur_type', 'membre_collaborateur_universitaire_titre',
                    'membre_collaborateur_universitaire_departement', 'membre_collaborateur_universitaire_institution',
                    'membre_collaborateur_milieux_cpc_titre', 'membre_collaborateur_milieux_cpc_champ_pratique',
                    'membre_collaborateur_milieux_cpc_affiliation', 'membre_collaborateur_collaboration',
                    'membre_collaborateur_collaboration_oui', 'membre_collaborateur_projet',
                    'membre_collaborateur_avec_qui_collaborer',
                ];

                foreach ($fields as $field) {
                    if (isset($_POST[$field])) {
                        // update_user_meta($user_id, $field, sanitize_text_field($_POST[$field]));
                        update_user_meta($user_id, $field, sanitize_text_field($_POST[$field]));
                    }
                }
            }

            add_action('personal_options_update', 'save_custom_user_meta_fields');
        add_action('edit_user_profile_update', 'save_custom_user_meta_fields');
