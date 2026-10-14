<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Primary_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            $output .= '<ul class="nav-nested-menu">';
        } elseif ( $depth === 1 ) {
            $output .= '<ul class="nav-nested-submenu">';
        } else {
            $output .= '<ul class="sub-menu">';
        }
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $has_children = in_array( 'menu-item-has-children', (array) $item->classes );
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $url = ! empty( $item->url ) ? esc_url( $item->url ) : '#';
        $active = ( in_array( 'current-menu-item', (array) $item->classes ) || in_array( 'current-page-ancestor', (array) $item->classes ) ) ? 'active' : '';

        if ( $depth === 0 ) {
            if ( $has_children ) {
                $output .= '<div class="nav-item-dropdown">';
                $output .= '<a href="' . $url . '" class="nav-link-custom ' . $active . ' d-flex align-items-center gap-1">';
                $output .= '<span>' . esc_html( $title ) . '</span>';
                $output .= '<i class="bi bi-chevron-down" style="font-size: 10px;"></i>';
                $output .= '</a>';
            } else {
                $output .= '<a href="' . $url . '" class="nav-link-custom ' . $active . '">';
                $output .= esc_html( $title );
                $output .= '</a>';
            }
        } elseif ( $depth === 1 ) {
            $output .= '<li class="nav-nested-item">';
            $badge = ! empty( $item->attr_title ) ? '<span class="nav-nested-badge">' . esc_html( $item->attr_title ) . '</span>' : '';
            if ( $has_children ) {
                $output .= '<a href="' . $url . '" class="nav-nested-link">';
                $output .= '<span>' . esc_html( $title ) . '</span>';
                $output .= $badge;
                $output .= '<i class="bi bi-chevron-right"></i>';
                $output .= '</a>';
            } else {
                $output .= '<a href="' . $url . '" class="nav-nested-link">';
                $output .= '<span>' . esc_html( $title ) . '</span>';
                $output .= $badge;
                $output .= '</a>';
            }
        } else {
            $output .= '<li><a href="' . $url . '" class="nav-sub-link">' . esc_html( $title ) . '</a>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( $depth === 0 ) {
            $has_children = in_array( 'menu-item-has-children', (array) $item->classes );
            if ( $has_children ) {
                $output .= '</div>';
            }
        } else {
            $output .= '</li>';
        }
    }
}

class Santino_Footer_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $url = ! empty( $item->url ) ? esc_url( $item->url ) : '#';
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $output .= '<li><a href="' . $url . '">' . esc_html( $title ) . '</a></li>';
    }
}

/**
 * Primary Nav Fallback matching html-designs/index.html 100%
 */
function santino_primary_nav_fallback() {
    ?>
    <a href="<?php echo esc_url( home_url( '/our-story/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'our-story' ) ? 'active' : ''; ?>">About Us</a>
    
    <!-- MACHINE WITH NESTED DROPDOWN -->
    <div class="nav-item-dropdown">
      <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'machines' ) ? 'active' : ''; ?> d-flex align-items-center gap-1">
        <span>Machine</span>
        <i class="bi bi-chevron-down" style="font-size: 10px;"></i>
      </a>

      <!-- Level 1 Dropdown List -->
      <ul class="nav-nested-menu">
        
        <!-- 1. Nuova Simonelli -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#nuova-simonelli' ) ); ?>" class="nav-nested-link">
            <span>Nuova Simonelli</span>
            <span class="nav-nested-badge">ITALY</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Appia Life</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Aurelia Wave</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Prontobar Touch</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">MDJ Grinder</a></li>
          </ul>
        </li>

        <!-- 2. Victoria Arduino -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#victoria-arduino' ) ); ?>" class="nav-nested-link">
            <span>Victoria Arduino</span>
            <span class="nav-nested-badge">FLAGSHIP</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">E1 Prima</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Maverick</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Eagle One</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Eagle Tempo</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">MY-Series Grinders</a></li>
          </ul>
        </li>

        <!-- 3. CREM -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#crem' ) ); ?>" class="nav-nested-link">
            <span>CREM</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">EX3</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Diamant Pro</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Megacrem</a></li>
          </ul>
        </li>

        <!-- 4. Kalerm -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#kalerm' ) ); ?>" class="nav-nested-link">
            <span>Kalerm</span>
            <span class="nav-nested-badge">SMART</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Y580C Smart</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">K95L Commercial</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">X580 Automatic</a></li>
          </ul>
        </li>

        <!-- 5. Rex Royal -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#rex-royal' ) ); ?>" class="nav-nested-link">
            <span>Rex Royal</span>
            <span class="nav-nested-badge">SWISS</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">S500 Compact</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">S300 Commercial</a></li>
          </ul>
        </li>

        <!-- 6. 3TEMP -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#3temp' ) ); ?>" class="nav-nested-link">
            <span>3TEMP</span>
            <span class="nav-nested-badge">BREWER</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Hipster Pulse</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Hipster Profile</a></li>
          </ul>
        </li>

        <!-- 7. CAYE Bionic Barista -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#caye' ) ); ?>" class="nav-nested-link">
            <span>CAYE Bionic Barista</span>
            <span class="nav-nested-badge">AI/ROBOT</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Robotic Kiosk System</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Dual-Arm Barista Robot</a></li>
          </ul>
        </li>

        <!-- 8. Grinders -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#grinders' ) ); ?>" class="nav-nested-link">
            <span>Grinders</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Mythos One / Two</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Eureka Helios</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Fiorenzato F64</a></li>
          </ul>
        </li>

        <!-- 9. Bubble Tea Shop Solutions -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#bubble-tea' ) ); ?>" class="nav-nested-link">
            <span>Bubble Tea Shop Solutions</span>
          </a>
        </li>

        <!-- 10. Blupura Water Solutions -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#blupura' ) ); ?>" class="nav-nested-link">
            <span>Blupura Water Solutions</span>
          </a>
        </li>

        <!-- 11. Others -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#others' ) ); ?>" class="nav-nested-link">
            <span>Others</span>
          </a>
        </li>

        <!-- 12. Technical Support -->
        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-nested-link">
            <span>Technical Support</span>
            <span class="nav-nested-badge">24/7 AMC</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Installation & Setup</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Preventive AMC</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Emergency Breakdown</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">100% Genuine Spare Parts</a></li>
            <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Descaling & Filtration</a></li>
          </ul>
        </li>

      </ul>
    </div>

    <a href="<?php echo esc_url( home_url( '/beans/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'beans' ) ? 'active' : ''; ?>">Beans</a>
    <a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'training' ) ? 'active' : ''; ?>">Training</a>
    <a href="<?php echo esc_url( home_url( '/horeca/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'horeca' ) ? 'active' : ''; ?>">Horeca</a>
    <a href="<?php echo esc_url( home_url( '/office-cafe/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'office-cafe' ) ? 'active' : ''; ?>">Office Cafe</a>
    <?php
}

/**
 * Comprehensive Santino Official Navigation Menu Engine
 * Matches frontend design: About Us, Machine (12 Sub-brands), Beans, Training, Horeca, Office Cafe
 */
function santino_setup_official_nav_menus( $force = false ) {
    $menu_name = 'Santino Primary Navigation';
    $menu_obj  = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu_obj ) {
        $primary_id = wp_create_nav_menu( $menu_name );
    } else {
        $primary_id = $menu_obj->term_id;
        if ( $force ) {
            $existing_items = wp_get_nav_menu_items( $primary_id );
            if ( ! empty( $existing_items ) ) {
                foreach ( $existing_items as $ei ) {
                    wp_delete_post( $ei->ID, true );
                }
            }
        }
    }

    if ( ! is_wp_error( $primary_id ) && ( ! $menu_obj || $force ) ) {
        // 1. About Us
        wp_update_nav_menu_item( $primary_id, 0, array(
            'menu-item-title'  => 'About Us',
            'menu-item-url'    => home_url( '/our-story/' ),
            'menu-item-status' => 'publish',
        ) );

        // 2. Machine (Parent with 12 Nested Submenus)
        $mach_id = wp_update_nav_menu_item( $primary_id, 0, array(
            'menu-item-title'  => 'Machine',
            'menu-item-url'    => home_url( '/machines/' ),
            'menu-item-status' => 'publish',
        ) );

        if ( $mach_id && ! is_wp_error( $mach_id ) ) {
            // Nuova Simonelli
            $ns_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Nuova Simonelli',
                'menu-item-url'       => home_url( '/machines/#nuova-simonelli' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-attr-title'=> 'ITALY',
                'menu-item-status'    => 'publish',
            ) );
            if ( $ns_id && ! is_wp_error( $ns_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Appia Life', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $ns_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Aurelia Wave', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $ns_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Prontobar Touch', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $ns_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'MDJ Grinder', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $ns_id, 'menu-item-status' => 'publish' ) );
            }

            // Victoria Arduino
            $va_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Victoria Arduino',
                'menu-item-url'       => home_url( '/machines/#victoria-arduino' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-attr-title'=> 'FLAGSHIP',
                'menu-item-status'    => 'publish',
            ) );
            if ( $va_id && ! is_wp_error( $va_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'E1 Prima', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $va_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Maverick', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $va_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Eagle One', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $va_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Eagle Tempo', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $va_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'MY-Series Grinders', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $va_id, 'menu-item-status' => 'publish' ) );
            }

            // CREM
            $crem_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'CREM',
                'menu-item-url'       => home_url( '/machines/#crem' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-status'    => 'publish',
            ) );
            if ( $crem_id && ! is_wp_error( $crem_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'EX3', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $crem_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Diamant Pro', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $crem_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Megacrem', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $crem_id, 'menu-item-status' => 'publish' ) );
            }

            // Kalerm
            $kal_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Kalerm',
                'menu-item-url'       => home_url( '/machines/#kalerm' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-attr-title'=> 'SMART',
                'menu-item-status'    => 'publish',
            ) );
            if ( $kal_id && ! is_wp_error( $kal_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Y580C Smart', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $kal_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'K95L Commercial', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $kal_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'X580 Automatic', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $kal_id, 'menu-item-status' => 'publish' ) );
            }

            // Rex Royal
            $rex_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Rex Royal',
                'menu-item-url'       => home_url( '/machines/#rex-royal' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-attr-title'=> 'SWISS',
                'menu-item-status'    => 'publish',
            ) );
            if ( $rex_id && ! is_wp_error( $rex_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'S500 Compact', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $rex_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'S300 Commercial', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $rex_id, 'menu-item-status' => 'publish' ) );
            }

            // 3TEMP
            $temp_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => '3TEMP',
                'menu-item-url'       => home_url( '/machines/#3temp' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-attr-title'=> 'BREWER',
                'menu-item-status'    => 'publish',
            ) );
            if ( $temp_id && ! is_wp_error( $temp_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Hipster Pulse', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $temp_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Hipster Profile', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $temp_id, 'menu-item-status' => 'publish' ) );
            }

            // CAYE Bionic Barista
            $caye_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'CAYE Bionic Barista',
                'menu-item-url'       => home_url( '/machines/#caye' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-attr-title'=> 'AI/ROBOT',
                'menu-item-status'    => 'publish',
            ) );
            if ( $caye_id && ! is_wp_error( $caye_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Robotic Kiosk System', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $caye_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Dual-Arm Barista Robot', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $caye_id, 'menu-item-status' => 'publish' ) );
            }

            // Grinders
            $grind_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Grinders',
                'menu-item-url'       => home_url( '/machines/#grinders' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-status'    => 'publish',
            ) );
            if ( $grind_id && ! is_wp_error( $grind_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Mythos One / Two', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $grind_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Eureka Helios', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $grind_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Fiorenzato F64', 'menu-item-url' => home_url( '/machines/' ), 'menu-item-parent-id' => $grind_id, 'menu-item-status' => 'publish' ) );
            }

            // Bubble Tea
            wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Bubble Tea Shop Solutions',
                'menu-item-url'       => home_url( '/machines/#bubble-tea' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-status'    => 'publish',
            ) );

            // Blupura
            wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Blupura Water Solutions',
                'menu-item-url'       => home_url( '/machines/#blupura' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-status'    => 'publish',
            ) );

            // Others
            wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Others',
                'menu-item-url'       => home_url( '/machines/#others' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-status'    => 'publish',
            ) );

            // Technical Support
            $tech_id = wp_update_nav_menu_item( $primary_id, 0, array(
                'menu-item-title'     => 'Technical Support',
                'menu-item-url'       => home_url( '/#machine-services' ),
                'menu-item-parent-id' => $mach_id,
                'menu-item-attr-title'=> '24/7 AMC',
                'menu-item-status'    => 'publish',
            ) );
            if ( $tech_id && ! is_wp_error( $tech_id ) ) {
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Installation & Setup', 'menu-item-url' => home_url( '/#machine-services' ), 'menu-item-parent-id' => $tech_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Preventive AMC', 'menu-item-url' => home_url( '/#machine-services' ), 'menu-item-parent-id' => $tech_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Emergency Breakdown', 'menu-item-url' => home_url( '/#machine-services' ), 'menu-item-parent-id' => $tech_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => '100% Genuine Spare Parts', 'menu-item-url' => home_url( '/#machine-services' ), 'menu-item-parent-id' => $tech_id, 'menu-item-status' => 'publish' ) );
                wp_update_nav_menu_item( $primary_id, 0, array( 'menu-item-title' => 'Descaling & Filtration', 'menu-item-url' => home_url( '/#machine-services' ), 'menu-item-parent-id' => $tech_id, 'menu-item-status' => 'publish' ) );
            }
        }

        // 3. Beans
        wp_update_nav_menu_item( $primary_id, 0, array(
            'menu-item-title'  => 'Beans',
            'menu-item-url'    => home_url( '/beans/' ),
            'menu-item-status' => 'publish',
        ) );

        // 4. Training
        wp_update_nav_menu_item( $primary_id, 0, array(
            'menu-item-title'  => 'Training',
            'menu-item-url'    => home_url( '/training/' ),
            'menu-item-status' => 'publish',
        ) );

        // 5. Horeca
        wp_update_nav_menu_item( $primary_id, 0, array(
            'menu-item-title'  => 'Horeca',
            'menu-item-url'    => home_url( '/horeca/' ),
            'menu-item-status' => 'publish',
        ) );

        // 6. Office Cafe
        wp_update_nav_menu_item( $primary_id, 0, array(
            'menu-item-title'  => 'Office Cafe',
            'menu-item-url'    => home_url( '/office-cafe/' ),
            'menu-item-status' => 'publish',
        ) );
    }

    // 2. Footer Quick Links
    $quick_name = 'Santino Footer Quick Links';
    $quick_obj  = wp_get_nav_menu_object( $quick_name );
    if ( ! $quick_obj ) {
        $quick_id = wp_create_nav_menu( $quick_name );
    } else {
        $quick_id = $quick_obj->term_id;
        if ( $force ) {
            $existing_q = wp_get_nav_menu_items( $quick_id );
            if ( ! empty( $existing_q ) ) {
                foreach ( $existing_q as $eq ) {
                    wp_delete_post( $eq->ID, true );
                }
            }
        }
    }

    if ( ! is_wp_error( $quick_id ) && ( ! $quick_obj || $force ) ) {
        $q_items = array(
            array( 'title' => 'Home', 'url' => home_url( '/' ) ),
            array( 'title' => 'Commercial Machines', 'url' => home_url( '/machines/' ) ),
            array( 'title' => 'Specialty Coffee Beans', 'url' => home_url( '/beans/' ) ),
            array( 'title' => 'Barista Academy & SCA', 'url' => home_url( '/training/' ) ),
            array( 'title' => 'HoReCa & Corporate Office', 'url' => home_url( '/office-cafe/' ) ),
            array( 'title' => 'VIP Club Membership', 'url' => home_url( '/membership/' ) ),
            array( 'title' => 'Cafe Menu & Delivery', 'url' => home_url( '/menu/' ) ),
            array( 'title' => 'Certificate Verification', 'url' => home_url( '/certificate-verification/' ) ),
        );
        foreach ( $q_items as $q ) {
            wp_update_nav_menu_item( $quick_id, 0, array(
                'menu-item-title'  => $q['title'],
                'menu-item-url'    => $q['url'],
                'menu-item-status' => 'publish',
            ) );
        }
    }

    // 3. Footer Customer Care
    $care_name = 'Santino Footer Customer Care';
    $care_obj  = wp_get_nav_menu_object( $care_name );
    if ( ! $care_obj ) {
        $care_id = wp_create_nav_menu( $care_name );
    } else {
        $care_id = $care_obj->term_id;
        if ( $force ) {
            $existing_c = wp_get_nav_menu_items( $care_id );
            if ( ! empty( $existing_c ) ) {
                foreach ( $existing_c as $ec ) {
                    wp_delete_post( $ec->ID, true );
                }
            }
        }
    }

    if ( ! is_wp_error( $care_id ) && ( ! $care_obj || $force ) ) {
        $c_items = array(
            array( 'title' => '24/7 AMC Technical Support', 'url' => home_url( '/office-cafe/#contact' ) ),
            array( 'title' => 'Commercial Coffee Consultation', 'url' => home_url( '/office-cafe/#contact' ) ),
            array( 'title' => 'Retail Shelves at Shwapno', 'url' => home_url( '/swapno/' ) ),
            array( 'title' => 'Our Roastery & Brand Story', 'url' => home_url( '/our-story/' ) ),
            array( 'title' => 'Direct Hotline: +880 1613-334514', 'url' => 'tel:+8801613334514' ),
        );
        foreach ( $c_items as $c ) {
            wp_update_nav_menu_item( $care_id, 0, array(
                'menu-item-title'  => $c['title'],
                'menu-item-url'    => $c['url'],
                'menu-item-status' => 'publish',
            ) );
        }
    }

    // Force map to theme locations
    $locations = get_theme_mod( 'nav_menu_locations', array() );
    if ( ! is_array( $locations ) ) {
        $locations = array();
    }
    if ( ! is_wp_error( $primary_id ) ) {
        $locations['primary'] = $primary_id;
    }
    if ( ! is_wp_error( $quick_id ) ) {
        $locations['footer_quick'] = $quick_id;
    }
    if ( ! is_wp_error( $care_id ) ) {
        $locations['footer_care'] = $care_id;
    }
    set_theme_mod( 'nav_menu_locations', $locations );

    return true;
}

/**
 * Auto-Seed Menus on Theme Switch and First Admin Load
 */
add_action( 'after_switch_theme', function() {
    santino_setup_official_nav_menus( true );
} );

add_action( 'admin_init', function() {
    if ( ! get_option( 'santino_menus_v4_frontend_exact' ) ) {
        santino_setup_official_nav_menus( true );
        update_option( 'santino_menus_v4_frontend_exact', 1 );
    }
} );