<?php

    function custom_membre_shortcode($atts)
    {

        // Attributes
        $atts = shortcode_atts(
            [
                'type' => '',
            ],
            $atts,
            'membre'
        );

        $args = [
            'role'    => $atts['type'],
            'orderby' => 'user_nicename',
            'order'   => 'ASC',
        ];

        
        $users = get_users($args);

        // ob_start();
        // $output = ob_get_clean();
        $output = '<ul class="user-list">';

        foreach ($users as $user) {

            $userId         = $user->ID;
            $user_full_name = $user->display_name;

            $role      = get_role($user->roles[0])->name;
            $user_type = $role ? wp_roles()->get_names()[$role] : '';

            $user_photo = false;
            $lien       = false;
            $bio        = false;
            
            switch ($atts['type']) {
                case 'membre_collaborateur_citoyen':
                    /**
                     * membre_collaborateur_milieux_cpc_titre
                     * membre_collaborateur_milieux_cpc_affiliation
                     * membre_collaborateur_milieux_cpc_champ_pratique
                     */
                    $champ1 = get_user_meta($userId, 'membre_collaborateur_milieux_cpc_titre', true);
                    $champ2 = get_user_meta($userId, 'membre_collaborateur_milieux_cpc_affiliation', true);
                    $champ3 = get_user_meta($userId, 'membre_collaborateur_milieux_cpc_champ_pratique', true);
                    break;
                case 'membre_collaborateur_universitaire':
                    /**
                     * membre_collaborateur_universitaire_titre
                     * membre_collaborateur_universitaire_institution
                     * membre_collaborateur_universitaire_departement
                     */

                    $champ1 = get_user_meta($userId, 'membre_collaborateur_universitaire_titre', true);
                    $champ2 = get_user_meta($userId, 'membre_collaborateur_universitaire_institution', true);
                    $champ3 = get_user_meta($userId, 'membre_collaborateur_universitaire_departement', true);
                    break;
                case 'membre_regulier_citoyen':
                    /**
                     * membre_citoyen_regulier_affiliation_1
                     * membre_citoyen_regulier_type_membre
                     * membre_citoyen_regulier_bio
                     */
                    $user_photo = (false != get_user_meta($userId, 'photo_membre', true)) ? get_user_meta($userId, 'photo_membre', true) : false;
                    $champ1     = get_user_meta($userId, 'membre_citoyen_regulier_affiliation_1', true);
                    $champ2     = get_user_meta($userId, 'membre_citoyen_regulier_type_membre', true);
                    $bio        = get_user_meta($userId, 'membre_citoyen_regulier_bio', true);
                    break;
                case 'membre_regulier_universitaire':
                    /**
                     * membre_universitaire_collegial_regulier_titre
                     * membre_universitaire_collegial_regulier_affiliation_1
                     * membre_universitaire_collegial_regulier_bio
                     * url
                     */
                    $user_photo = (false != get_user_meta($userId, 'photo_membre', true)) ? get_user_meta($userId, 'photo_membre', true) : false;
                    $champ1     = get_user_meta($userId, 'membre_citoyen_regulier_affiliation_1', true);
                    $champ2     = get_user_meta($userId, 'membre_universitaire_collegial_regulier_affiliation_1', true);
                    $bio        = get_user_meta($userId, 'membre_universitaire_collegial_regulier_bio', true);
                    $lien       = get_user_meta($userId, 'url', true);
                    break;
                default:
                    /**
                     * membre_releve_scientifique_departement
                     * membre_releve_scientifique_institution
                     * membre_releve_scientifique_programme
                     * */
                    $champ1 = get_user_meta($userId, 'membremembre_releve_scientifique_departement_citoyen_regulier_affiliation_1', true);
                    $champ3 = get_user_meta($userId, 'membre_releve_scientifique_institution', true);
                    $champ2 = get_user_meta($userId, 'membre_releve_scientifique_programme', true);
                    break;
            }

            ob_start();
        ?>
                    <li class="membre-rescits shadow<?php echo $role; ?>">
                        
                            <?php if ($user_photo): ?>
                            <figure class="figure-membre to-up">
                                <img fetchpriority="high" decoding="async" width="180" height="180" src="<?php echo $user_photo ?>" alt="" class="image-membre" />
                            </figure>
                            <?php endif; ?>
                            <p class="type-membre  to-up"><?php echo $user_type; ?></p>
                            <div class="nom-titre-membre to-up">
                                <h4 class="nom-membre"><?php echo $user_full_name; ?></h4>
                                <p class="titre-membre">
                                    <?php echo $champ1; ?>
                                </p>
                            </div>
                            <p class="champ-2  to-up">
                                <?php echo $champ2; ?>
                            </p>
                            <p class="champ-3  to-up">
                                <?php echo $champ3; ?>
                            </p>
                            <?php if ($bio): ?>
                                <p class="bio  to-up"><?php echo $bio; ?></p>
                                <a class="voir-bio">voir la bio</a>
                            <?php endif; ?>
                        
                    </li>
                <?php
                    $output .= ob_get_clean();
                        }

                        $output .= '</ul>';

                        return $output;
                }
                add_shortcode('membre', 'custom_membre_shortcode');