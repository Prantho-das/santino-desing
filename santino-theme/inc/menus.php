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

function santino_primary_nav_fallback() {
    ?>
    <a href="<?php echo esc_url( home_url( '/our-story/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'our-story' ) ? 'active' : ''; ?>">About Us</a>
    
    <div class="nav-item-dropdown">
      <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-link-custom <?php echo is_page( 'machines' ) ? 'active' : ''; ?> d-flex align-items-center gap-1">
        <span>Machine</span>
        <i class="bi bi-chevron-down" style="font-size: 10px;"></i>
      </a>

      <ul class="nav-nested-menu">
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

        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#rex-royal' ) ); ?>" class="nav-nested-link">
            <span>Rex Royal</span>
            <span class="nav-nested-badge">SWISS</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">S500 Premium</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">S300 Office</a></li>
          </ul>
        </li>

        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#mahlkonig' ) ); ?>" class="nav-nested-link">
            <span>Mahlkonig</span>
            <span class="nav-nested-badge">GERMANY</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">EK43 / EK43S</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">E80 Supreme</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">E65S GbW</a></li>
          </ul>
        </li>

        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#dalla-corte' ) ); ?>" class="nav-nested-link">
            <span>Dalla Corte</span>
            <span class="nav-nested-badge">PRO</span>
            <i class="bi bi-chevron-right"></i>
          </a>
          <ul class="nav-nested-submenu">
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Zero Multi-Boiler</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Mina Profiling</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="nav-sub-link">Icon Commercial</a></li>
          </ul>
        </li>

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

        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#bubble-tea' ) ); ?>" class="nav-nested-link">
            <span>Bubble Tea Shop Solutions</span>
          </a>
        </li>

        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#blupura' ) ); ?>" class="nav-nested-link">
            <span>Blupura Water Solutions</span>
          </a>
        </li>

        <li class="nav-nested-item">
          <a href="<?php echo esc_url( home_url( '/machines/#others' ) ); ?>" class="nav-nested-link">
            <span>Others</span>
          </a>
        </li>

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

function santino_footer_quick_fallback() {
    ?>
    <ul class="footer-menu-list">
      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
      <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>">Machines</a></li>
      <li><a href="<?php echo esc_url( home_url( '/beans/' ) ); ?>">Coffee Beans</a></li>
      <li><a href="<?php echo esc_url( home_url( '/training/' ) ); ?>">Barista Academy</a></li>
      <li><a href="<?php echo esc_url( home_url( '/office-cafe/' ) ); ?>">Horeca &amp; Office</a></li>
      <li><a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>">Club Membership</a></li>
    </ul>
    <?php
}

function santino_footer_care_fallback() {
    ?>
    <ul class="footer-menu-list">
      <li><a href="<?php echo esc_url( home_url( '/office-cafe/#contact' ) ); ?>">24/7 AMC Support</a></li>
      <li><a href="<?php echo esc_url( home_url( '/office-cafe/#contact' ) ); ?>">Commercial Consultation</a></li>
      <li><a href="<?php echo esc_url( home_url( '/#availability' ) ); ?>">Find Cafes &amp; Outlets</a></li>
      <li><a href="<?php echo esc_url( home_url( '/our-story/' ) ); ?>">Brand Heritage</a></li>
      <li><a href="tel:+8801613334514">Direct Hotline</a></li>
    </ul>
    <?php
}

function santino_register_elementor_locations( $elementor_theme_manager ) {
    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
}
add_action( 'elementor/theme/register_locations', 'santino_register_elementor_locations' );

function santino_seed_default_menus() {
    $locations = get_theme_mod( 'nav_menu_locations' );
    if ( ! is_array( $locations ) ) {
        $locations = array();
    }

    if ( empty( $locations['primary'] ) ) {
        $menu_id = wp_create_nav_menu( 'Primary Navigation' );
        if ( ! is_wp_error( $menu_id ) ) {
            $items = array(
                array( 'title' => 'About Us', 'url' => home_url( '/our-story/' ) ),
                array( 'title' => 'Machines', 'url' => home_url( '/machines/' ) ),
                array( 'title' => 'Beans', 'url' => home_url( '/beans/' ) ),
                array( 'title' => 'Training', 'url' => home_url( '/training/' ) ),
                array( 'title' => 'Horeca', 'url' => home_url( '/horeca/' ) ),
                array( 'title' => 'Office Cafe', 'url' => home_url( '/office-cafe/' ) ),
                array( 'title' => 'Membership', 'url' => home_url( '/membership/' ) ),
            );
            foreach ( $items as $item ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'  => $item['title'],
                    'menu-item-url'    => $item['url'],
                    'menu-item-status' => 'publish',
                ) );
            }
            $locations['primary'] = $menu_id;
        }
    }

    if ( empty( $locations['footer_quick'] ) ) {
        $menu_id = wp_create_nav_menu( 'Footer Quick Links' );
        if ( ! is_wp_error( $menu_id ) ) {
            $items = array(
                array( 'title' => 'Home', 'url' => home_url( '/' ) ),
                array( 'title' => 'Machines', 'url' => home_url( '/machines/' ) ),
                array( 'title' => 'Coffee Beans', 'url' => home_url( '/beans/' ) ),
                array( 'title' => 'Barista Academy', 'url' => home_url( '/training/' ) ),
                array( 'title' => 'Horeca & Office', 'url' => home_url( '/office-cafe/' ) ),
                array( 'title' => 'Club Membership', 'url' => home_url( '/membership/' ) ),
            );
            foreach ( $items as $item ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'  => $item['title'],
                    'menu-item-url'    => $item['url'],
                    'menu-item-status' => 'publish',
                ) );
            }
            $locations['footer_quick'] = $menu_id;
        }
    }

    if ( empty( $locations['footer_care'] ) ) {
        $menu_id = wp_create_nav_menu( 'Footer Customer Care' );
        if ( ! is_wp_error( $menu_id ) ) {
            $items = array(
                array( 'title' => '24/7 AMC Support', 'url' => home_url( '/office-cafe/#contact' ) ),
                array( 'title' => 'Commercial Consultation', 'url' => home_url( '/office-cafe/#contact' ) ),
                array( 'title' => 'Find Cafes & Outlets', 'url' => home_url( '/#availability' ) ),
                array( 'title' => 'Brand Heritage', 'url' => home_url( '/our-story/' ) ),
                array( 'title' => 'Direct Hotline', 'url' => 'tel:+8801613334514' ),
            );
            foreach ( $items as $item ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'  => $item['title'],
                    'menu-item-url'    => $item['url'],
                    'menu-item-status' => 'publish',
                ) );
            }
            $locations['footer_care'] = $menu_id;
        }
    }

    set_theme_mod( 'nav_menu_locations', $locations );
}
add_action( 'after_switch_theme', 'santino_seed_default_menus' );
