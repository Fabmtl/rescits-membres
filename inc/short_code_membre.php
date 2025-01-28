<?php

function custom_membre_shortcode($atts){

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

            $output = '<ul class="user-list">';
            
            foreach ($users as $user) {

                $userId         = $user->ID;
                $user_full_name = $user->display_name;
                // $user_type = get_user_meta($userId, 'membre_categorie', true);
                // if (empty($user_type)) {
                    $role = get_role($user->roles[0])->name;
                    $user_type = $role ? wp_roles()->get_names()[ $role ] : '';
                // }
                // echo '<pre>';
                // var_dump(get_role($user->roles[0]));
                // echo '</pre>';
                $user_photo     = false;
                $lien = false;
                $bio = false;
                switch ( $atts['type']) {
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
                        $user_photo = (false != get_user_meta($userId, 'photo_membre', true)) ? get_user_meta($userId, 'photo_membre', true) : false;
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
                        $champ1 = get_user_meta($userId, 'membre_citoyen_regulier_affiliation_1', true);
                        $champ2 = get_user_meta($userId, 'membre_citoyen_regulier_type_membre', true);
                        $bio = get_user_meta($userId, 'membre_citoyen_regulier_bio', true);
                        break;
                    case 'membre_regulier_universitaire':
                        /**
                         * membre_universitaire_collegial_regulier_titre
                         * membre_universitaire_collegial_regulier_affiliation_1
                         * membre_universitaire_collegial_regulier_bio
                         * url
                         */
                        $champ1 = get_user_meta($userId, 'membre_citoyen_regulier_affiliation_1', true);
                        $champ2 = get_user_meta($userId, 'membre_universitaire_collegial_regulier_affiliation_1', true);
                        $bio = get_user_meta($userId, 'membre_universitaire_collegial_regulier_bio', true);
                        $lien = get_user_meta($userId, 'url', true);
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
                    <li class="membre-rescits">
                        <div class="wp-block-group card-membre--inner big-shadow has-white-background-color has-background is-vertical is-content-justification-center is-nowrap is-layout-flex wp-container-core-group-is-layout-9 wp-block-group-is-layout-flex" style="border-radius:27px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
                        	<div class="wp-block-group has-global-padding is-layout-constrained wp-container-core-group-is-layout-7 wp-block-group-is-layout-constrained">
                                <p><?php echo $user_type;?></p>
                        	<?php if($user_photo):?>	
                                <figure class="wp-block-image aligncenter size-full is-resized is-style-rounded" style="margin-bottom:20px">
                        			<img fetchpriority="high" decoding="async" width="400" height="400" src="https://rescits.local/wp-content/uploads/2025/01/Eric-Racine-square.jpg" alt="" class="wp-image-1255" style="aspect-ratio:1;object-fit:cover;width:150px" srcset="https://rescits.local/wp-content/uploads/2025/01/Eric-Racine-square.jpg 400w, https://rescits.local/wp-content/uploads/2025/01/Eric-Racine-square-300x300.jpg 300w, https://rescits.local/wp-content/uploads/2025/01/Eric-Racine-square-150x150.jpg 150w" sizes="(max-width: 400px) 100vw, 400px">
                        		</figure>
                            <?php endif;?>
                        		<h4 class="wp-block-heading has-text-align-center has-primary-color has-text-color has-link-color wp-elements-06cf2ef50f981e790651a3d4c26f778b" style="font-size:clamp(16px, 1rem + ((1vw - 3.2px) * 0.417), 20px);text-transform:none">
                                <?php echo $user_full_name; ?>
                        		</h4>
                        		<p class="has-text-align-center has-small-font-size">
                        			<strong><?php echo $champ1; ?></strong>
                        		</p>
                        		<p class="has-text-align-center has-small-font-size" style="line-height:1.2">
                                <?php echo $champ2; ?>
                        		</p>
                        		<p class="has-text-align-center has-small-font-size" style="line-height:1.2">
                                <?php echo $champ3; ?>
                        		</p>
                        	</div>

                            <?php
                                /**
                                 * Biographgie
                                 * Membres réluier.es
                                */
                            ?>
                            <?php if( $bio ): ?>
                        	    <div class="wp-block-group card-membre--more-content is-layout-flow wp-block-group-is-layout-flow">
                                    <p class="has-text-align-center has-small-font-size">
                                        <?php echo $bio; ?>
                        	    	</p>
                        	    </div>
                        	    <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-1 wp-block-buttons-is-layout-flex">
                                    <div class="wp-block-button voir-plus-membre is-style-outline is-style-outline--4">
                                        <a class="wp-block-button__link has-secondary-color has-text-color has-link-color wp-element-button" style="border-radius:50px"><strong>voir la bio</strong></a>
                        	    	</div>
                        	    </div>
                            <?php endif; #bio?>
                        </div>
                        
                    </li>
                <?php
                $output .= ob_get_clean();
            }

            $output .= '</ul>';

     return $output;
}
add_shortcode('membre', 'custom_membre_shortcode');