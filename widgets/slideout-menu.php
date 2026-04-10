<?php
namespace ElementorSlideoutMenu\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

/**
 * @since 1.1.0
 */
class Elementor_Slideout_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'slideout_menu';
    }

    public function get_title() {
        return __('Slideout Menu', 'slideout-menu-widget');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['menu', 'navigation', 'slideout', 'sidebar'];
    }

    /**
     * Get all registered WordPress menus
     */
    private function get_available_menus() {
        $menus = wp_get_nav_menus();
        $options = ['' => __('Select Menu', 'slideout-menu-widget')];

        foreach ($menus as $menu) {
            $options[$menu->term_id] = $menu->name;
        }

        return $options;
    }

    protected function register_controls() {
        // ==========================================
        // CONTENT TAB - Menu Settings Section
        // ==========================================
        $this->start_controls_section(
                'content_section',
                [
                        'label' => __('Menu Settings', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'menu_button_text',
                [
                        'label' => __('Menu Button Text', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Menu', 'slideout-menu-widget'),
                        'description' => __('Text displayed on mobile/tablet toggle button.', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'selected_menu',
                [
                        'label' => __('Select WordPress Menu', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => $this->get_available_menus(),
                        'default' => '',
                        'description' => __('Choose a WordPress menu to display. Menu must have parent and child items.', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'slide_direction',
                [
                        'label' => __('Slide Direction', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'left' => __('Slide from Left', 'slideout-menu-widget'),
                                'right' => __('Slide from Right', 'slideout-menu-widget'),
                        ],
                        'default' => 'left',
                        'description' => __('Direction for mobile/tablet slideout menu.', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'show_icons',
                [
                        'label' => __('Show Arrow Icons', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'slideout-menu-widget'),
                        'label_off' => __('No', 'slideout-menu-widget'),
                        'return_value' => 'yes',
                        'default' => 'yes',
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - Desktop Menu Settings
        // ==========================================
        $this->start_controls_section(
                'desktop_menu_section',
                [
                        'label' => __('Desktop Menu Settings', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'desktop_menu_layout',
                [
                        'label' => __('Menu Layout', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'horizontal' => __('Horizontal', 'slideout-menu-widget'),
                                'vertical' => __('Vertical', 'slideout-menu-widget'),
                        ],
                        'default' => 'horizontal',
                ]
        );

        $this->add_control(
                'desktop_submenu_behavior',
                [
                        'label' => __('Submenu Display', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'dropdown' => __('Dropdown on Hover', 'slideout-menu-widget'),
                                'dropdown_click' => __('Dropdown on Click', 'slideout-menu-widget'),
                        ],
                        'default' => 'dropdown',
                ]
        );

        $this->add_control(
                'desktop_menu_alignment',
                [
                        'label' => __('Menu Alignment', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'options' => [
                                'flex-start' => [
                                        'title' => __('Left', 'slideout-menu-widget'),
                                        'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                        'title' => __('Center', 'slideout-menu-widget'),
                                        'icon' => 'eicon-text-align-center',
                                ],
                                'flex-end' => [
                                        'title' => __('Right', 'slideout-menu-widget'),
                                        'icon' => 'eicon-text-align-right',
                                ],
                                'space-between' => [
                                        'title' => __('Justify', 'slideout-menu-widget'),
                                        'icon' => 'eicon-text-align-justify',
                                ],
                        ],
                        'default' => 'flex-start',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container' => 'justify-content: {{VALUE}};',
                        ],
                ]
        );

        $this->add_control(
                'desktop_submenu_indicator',
                [
                        'label' => __('Submenu Indicator', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Show', 'slideout-menu-widget'),
                        'label_off' => __('Hide', 'slideout-menu-widget'),
                        'return_value' => 'yes',
                        'default' => 'yes',
                        'description' => __('Show dropdown arrow for items with submenus.', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'desktop_submenu_animation',
                [
                        'label' => __('Submenu Animation', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'none' => __('None', 'slideout-menu-widget'),
                                'fade' => __('Fade', 'slideout-menu-widget'),
                                'slide-up' => __('Slide Up', 'slideout-menu-widget'),
                                'slide-down' => __('Slide Down', 'slideout-menu-widget'),
                        ],
                        'default' => 'fade',
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - Search Settings (Mobile/Tablet)
        // ==========================================
        $this->start_controls_section(
                'search_section',
                [
                        'label' => __('Search (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'show_search',
                [
                        'label' => __('Show Search', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'slideout-menu-widget'),
                        'label_off' => __('No', 'slideout-menu-widget'),
                        'return_value' => 'yes',
                        'default' => 'no',
                        'description' => __('Display search icon and functionality in mobile/tablet view.', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'search_placeholder',
                [
                        'label' => __('Search Placeholder', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Search...', 'slideout-menu-widget'),
                        'condition' => [
                                'show_search' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'search_position',
                [
                        'label' => __('Search Position', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'header' => __('In Header (Next to Toggle)', 'slideout-menu-widget'),
                                'inside_top' => __('Inside Menu (Top)', 'slideout-menu-widget'),
                                'inside_bottom' => __('Inside Menu (Bottom)', 'slideout-menu-widget'),
                        ],
                        'default' => 'header',
                        'condition' => [
                                'show_search' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'search_icon_type',
                [
                        'label' => __('Search Icon Type', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'icon' => __('Icon', 'slideout-menu-widget'),
                                'svg' => __('Custom SVG', 'slideout-menu-widget'),
                                'image' => __('Image', 'slideout-menu-widget'),
                        ],
                        'default' => 'icon',
                        'condition' => [
                                'show_search' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'search_icon',
                [
                        'label' => __('Search Icon', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                                'value' => 'fas fa-search',
                                'library' => 'fa-solid',
                        ],
                        'condition' => [
                                'show_search' => 'yes',
                                'search_icon_type' => 'icon',
                        ],
                ]
        );

        $this->add_control(
                'search_icon_svg',
                [
                        'label' => __('Custom SVG', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'placeholder' => __('Paste your SVG code here', 'slideout-menu-widget'),
                        'condition' => [
                                'show_search' => 'yes',
                                'search_icon_type' => 'svg',
                        ],
                ]
        );

        $this->add_control(
                'search_icon_image',
                [
                        'label' => __('Search Icon Image', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'condition' => [
                                'show_search' => 'yes',
                                'search_icon_type' => 'image',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - Icon Box (Mobile/Tablet Only)
        // ==========================================
        $this->start_controls_section(
                'icon_box_section',
                [
                        'label' => __('Icon Box (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'show_icon_box',
                [
                        'label' => __('Show Icon Box', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'slideout-menu-widget'),
                        'label_off' => __('No', 'slideout-menu-widget'),
                        'return_value' => 'yes',
                        'default' => 'no',
                        'description' => __('Display an icon box with icon, text, and link (visible only on mobile/tablet).', 'slideout-menu-widget'),
                ]
        );

        // Icon Box Repeater for multiple icon boxes
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'icon_box_title',
                [
                        'label' => __('Title', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Icon Box', 'slideout-menu-widget'),
                        'label_block' => true,
                ]
        );

        $repeater->add_control(
                'icon_box_description',
                [
                        'label' => __('Description', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => '',
                        'label_block' => true,
                ]
        );

        $repeater->add_control(
                'icon_box_icon_type',
                [
                        'label' => __('Icon Type', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'icon' => __('Font Awesome Icon', 'slideout-menu-widget'),
                                'svg' => __('Custom SVG', 'slideout-menu-widget'),
                                'image' => __('Image', 'slideout-menu-widget'),
                        ],
                        'default' => 'icon',
                ]
        );

        $repeater->add_control(
                'icon_box_icon',
                [
                        'label' => __('Icon', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                                'value' => 'fas fa-star',
                                'library' => 'fa-solid',
                        ],
                        'condition' => [
                                'icon_box_icon_type' => 'icon',
                        ],
                ]
        );

        $repeater->add_control(
                'icon_box_svg',
                [
                        'label' => __('Custom SVG', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'placeholder' => __('Paste your SVG code here', 'slideout-menu-widget'),
                        'description' => __('Paste the complete SVG code including the <svg> tags.', 'slideout-menu-widget'),
                        'condition' => [
                                'icon_box_icon_type' => 'svg',
                        ],
                ]
        );

        $repeater->add_control(
                'icon_box_image',
                [
                        'label' => __('Image', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'condition' => [
                                'icon_box_icon_type' => 'image',
                        ],
                ]
        );

        $repeater->add_control(
                'icon_box_link',
                [
                        'label' => __('Link', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => __('https://your-link.com', 'slideout-menu-widget'),
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                                'url' => '',
                                'is_external' => false,
                                'nofollow' => false,
                        ],
                        'label_block' => true,
                ]
        );

        $this->add_control(
                'icon_boxes',
                [
                        'label' => __('Icon Boxes', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                                [
                                        'icon_box_title' => __('Contact Us', 'slideout-menu-widget'),
                                        'icon_box_icon' => [
                                                'value' => 'fas fa-phone',
                                                'library' => 'fa-solid',
                                        ],
                                ],
                        ],
                        'title_field' => '{{{ icon_box_title }}}',
                        'condition' => [
                                'show_icon_box' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'icon_box_position',
                [
                        'label' => __('Icon Box Position', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'header' => __('In Header (Next to Toggle)', 'slideout-menu-widget'),
                                'inside_top' => __('Inside Menu (Top)', 'slideout-menu-widget'),
                                'inside_bottom' => __('Inside Menu (Bottom)', 'slideout-menu-widget'),
                        ],
                        'default' => 'inside_bottom',
                        'condition' => [
                                'show_icon_box' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'icon_box_layout',
                [
                        'label' => __('Icon Box Layout', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                                'horizontal' => __('Horizontal (Icon Left)', 'slideout-menu-widget'),
                                'vertical' => __('Vertical (Icon Top)', 'slideout-menu-widget'),
                        ],
                        'default' => 'horizontal',
                        'condition' => [
                                'show_icon_box' => 'yes',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB - Logo Section
        // ==========================================
        $this->start_controls_section(
                'logo_section',
                [
                        'label' => __('Logo', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'show_logo',
                [
                        'label' => __('Show Logo', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'slideout-menu-widget'),
                        'label_off' => __('No', 'slideout-menu-widget'),
                        'return_value' => 'yes',
                        'default' => 'no',
                ]
        );

        $this->add_control(
                'logo_image',
                [
                        'label' => __('Choose Logo', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'condition' => [
                                'show_logo' => 'yes',
                        ],
                ]
        );

        $this->add_responsive_control(
                'logo_width',
                [
                        'label' => __('Logo Width', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range' => [
                                'px' => [
                                        'min' => 50,
                                        'max' => 300,
                                ],
                                '%' => [
                                        'min' => 10,
                                        'max' => 100,
                                ],
                        ],
                        'default' => [
                                'unit' => 'px',
                                'size' => 150,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-logo img' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                                'show_logo' => 'yes',
                        ],
                ]
        );

        $this->add_responsive_control(
                'logo_padding',
                [
                        'label' => __('Logo Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'default' => [
                                'top' => 20,
                                'right' => 20,
                                'bottom' => 20,
                                'left' => 20,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [
                                'show_logo' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'logo_alignment',
                [
                        'label' => __('Logo Alignment', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'options' => [
                                'left' => [
                                        'title' => __('Left', 'slideout-menu-widget'),
                                        'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                        'title' => __('Center', 'slideout-menu-widget'),
                                        'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                        'title' => __('Right', 'slideout-menu-widget'),
                                        'icon' => 'eicon-text-align-right',
                                ],
                        ],
                        'default' => 'center',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-logo' => 'text-align: {{VALUE}};',
                        ],
                        'condition' => [
                                'show_logo' => 'yes',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Menu Button (Mobile/Tablet)
        // ==========================================
        $this->start_controls_section(
                'button_style_section',
                [
                        'label' => __('Menu Button (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'button_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#111',
                        'selectors' => [
                                '{{WRAPPER}} .menu-toggle' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'button_text_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#fff',
                        'selectors' => [
                                '{{WRAPPER}} .menu-toggle' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'button_typography',
                        'selector' => '{{WRAPPER}} .menu-toggle',
                ]
        );

        $this->add_responsive_control(
                'button_padding',
                [
                        'label' => __('Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'default' => [
                                'top' => 12,
                                'right' => 24,
                                'bottom' => 12,
                                'left' => 24,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .menu-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'button_border_radius',
                [
                        'label' => __('Border Radius', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 50,
                                ],
                        ],
                        'default' => [
                                'size' => 4,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .menu-toggle' => 'border-radius: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Desktop Menu Style
        // ==========================================
        $this->start_controls_section(
                'desktop_menu_style_section',
                [
                        'label' => __('Desktop Menu', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'desktop_menu_bg_color',
                [
                        'label' => __('Menu Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => 'transparent',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'desktop_menu_padding',
                [
                        'label' => __('Menu Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em', '%'],
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'desktop_menu_item_heading',
                [
                        'label' => __('Menu Items', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                ]
        );

        $this->start_controls_tabs('desktop_menu_item_tabs');

        $this->start_controls_tab(
                'desktop_menu_item_normal',
                [
                        'label' => __('Normal', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'desktop_menu_item_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#333',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li > a' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'desktop_menu_item_bg',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => 'transparent',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li > a' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'desktop_menu_item_hover',
                [
                        'label' => __('Hover', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'desktop_menu_item_hover_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#000',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li > a:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .desktop-menu-container > ul > li:hover > a' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'desktop_menu_item_hover_bg',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li > a:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .desktop-menu-container > ul > li:hover > a' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'desktop_menu_item_active',
                [
                        'label' => __('Active', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'desktop_menu_item_active_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li.current-menu-item > a' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .desktop-menu-container > ul > li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'desktop_menu_item_active_bg',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li.current-menu-item > a' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .desktop-menu-container > ul > li.current-menu-ancestor > a' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'desktop_menu_item_typography',
                        'label' => __('Typography', 'slideout-menu-widget'),
                        'selector' => '{{WRAPPER}} .desktop-menu-container > ul > li > a',
                        'separator' => 'before',
                ]
        );

        $this->add_responsive_control(
                'desktop_menu_item_padding',
                [
                        'label' => __('Item Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em'],
                        'default' => [
                                'top' => 10,
                                'right' => 15,
                                'bottom' => 10,
                                'left' => 15,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_responsive_control(
                'desktop_menu_item_spacing',
                [
                        'label' => __('Item Spacing', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 50,
                                ],
                        ],
                        'default' => [
                                'size' => 0,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container > ul > li' => 'margin-right: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .desktop-menu-container > ul > li:last-child' => 'margin-right: 0;',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Desktop Dropdown Style
        // ==========================================
        $this->start_controls_section(
                'desktop_dropdown_style_section',
                [
                        'label' => __('Desktop Dropdown', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'desktop_dropdown_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#ffffff',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                        'name' => 'desktop_dropdown_shadow',
                        'label' => __('Box Shadow', 'slideout-menu-widget'),
                        'selector' => '{{WRAPPER}} .desktop-menu-container ul ul',
                ]
        );

        $this->add_control(
                'desktop_dropdown_border_radius',
                [
                        'label' => __('Border Radius', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 20,
                                ],
                        ],
                        'default' => [
                                'size' => 4,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul' => 'border-radius: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_responsive_control(
                'desktop_dropdown_width',
                [
                        'label' => __('Dropdown Width', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 100,
                                        'max' => 400,
                                ],
                        ],
                        'default' => [
                                'size' => 200,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul' => 'min-width: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'desktop_dropdown_item_heading',
                [
                        'label' => __('Dropdown Items', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                ]
        );

        $this->start_controls_tabs('desktop_dropdown_item_tabs');

        $this->start_controls_tab(
                'desktop_dropdown_item_normal',
                [
                        'label' => __('Normal', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'desktop_dropdown_item_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#333',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul li a' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'desktop_dropdown_item_bg',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => 'transparent',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul li a' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
                'desktop_dropdown_item_hover',
                [
                        'label' => __('Hover', 'slideout-menu-widget'),
                ]
        );

        $this->add_control(
                'desktop_dropdown_item_hover_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#000',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul li a:hover' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'desktop_dropdown_item_hover_bg',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#f5f5f5',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul li a:hover' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'desktop_dropdown_item_typography',
                        'label' => __('Typography', 'slideout-menu-widget'),
                        'selector' => '{{WRAPPER}} .desktop-menu-container ul ul li a',
                        'separator' => 'before',
                ]
        );

        $this->add_responsive_control(
                'desktop_dropdown_item_padding',
                [
                        'label' => __('Item Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em'],
                        'default' => [
                                'top' => 10,
                                'right' => 15,
                                'bottom' => 10,
                                'left' => 15,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'desktop_dropdown_divider_color',
                [
                        'label' => __('Divider Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#eee',
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul li' => 'border-bottom-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'desktop_dropdown_divider_width',
                [
                        'label' => __('Divider Width', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 5,
                                ],
                        ],
                        'default' => [
                                'size' => 1,
                        ],
                        'selectors' => [
                                '{{WRAPPER}} .desktop-menu-container ul ul li' => 'border-bottom-width: {{SIZE}}{{UNIT}}; border-bottom-style: solid;',
                                '{{WRAPPER}} .desktop-menu-container ul ul li:last-child' => 'border-bottom-width: 0;',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Search Style
        // ==========================================
        $this->start_controls_section(
                'search_style_section',
                [
                        'label' => __('Search (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'condition' => [
                                'show_search' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'search_icon_color',
                [
                        'label' => __('Icon Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#333',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .search-icon'     => 'color: {{VALUE}}',
                                '#slide-out-menu-{{ID}} .search-icon svg' => 'fill: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'search_icon_size',
                [
                        'label' => __('Icon Size', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 10,
                                        'max' => 50,
                                ],
                        ],
                        'default' => [
                                'size' => 20,
                                'unit' => 'px',
                        ],
                        'selectors' => [
                                // FA icon (<i class="search-icon">)
                                '#slide-out-menu-{{ID}} .search-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                                // SVG icon type wraps in <span class="search-icon"><svg>
                                '#slide-out-menu-{{ID}} .search-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                // Image icon (<img class="search-icon">)
                                '#slide-out-menu-{{ID}} img.search-icon'  => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'search_input_heading',
                [
                        'label' => __('Search Input', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                ]
        );

        $this->add_control(
                'search_input_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#f5f5f5',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-search-form input[type="search"]' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'search_input_text_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#333',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-search-form input[type="search"]' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'search_input_placeholder_color',
                [
                        'label' => __('Placeholder Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#999',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-search-form input[type="search"]::placeholder' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'search_input_border_color',
                [
                        'label' => __('Border Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#ddd',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-search-form input[type="search"]' => 'border-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'search_input_padding',
                [
                        'label' => __('Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em'],
                        'default' => [
                                'top' => 10,
                                'right' => 15,
                                'bottom' => 10,
                                'left' => 15,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-search-form input[type="search"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'search_input_border_radius',
                [
                        'label' => __('Border Radius', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 30,
                                ],
                        ],
                        'default' => [
                                'size' => 4,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-search-form input[type="search"]' => 'border-radius: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Icon Box Style
        // ==========================================
        $this->start_controls_section(
                'icon_box_style_section',
                [
                        'label' => __('Icon Box (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'condition' => [
                                'show_icon_box' => 'yes',
                        ],
                ]
        );

        $this->add_control(
                'icon_box_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => 'transparent',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'icon_box_padding',
                [
                        'label' => __('Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em'],
                        'default' => [
                                'top' => 15,
                                'right' => 15,
                                'bottom' => 15,
                                'left' => 15,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'icon_box_icon_heading',
                [
                        'label' => __('Icon', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                ]
        );

        $this->add_control(
                'icon_box_icon_color',
                [
                        'label' => __('Icon Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#333',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-icon' => 'color: {{VALUE}}',
                                '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-icon svg' => 'fill: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'icon_box_icon_size',
                [
                        'label' => __('Icon Size', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 10,
                                        'max' => 100,
                                ],
                        ],
                        'default' => [
                                'size' => 30,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-icon img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                        ],
                ]
        );

        $this->add_responsive_control(
                'icon_box_icon_spacing',
                [
                        'label' => __('Icon Spacing', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 50,
                                ],
                        ],
                        'default' => [
                                'size' => 10,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box.layout-horizontal .icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                                '#slide-out-menu-{{ID}} .mobile-icon-box.layout-vertical .icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_control(
                'icon_box_title_heading',
                [
                        'label' => __('Title', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                ]
        );

        $this->add_control(
                'icon_box_title_color',
                [
                        'label' => __('Title Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#333',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-title' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'icon_box_title_typography',
                        'label' => __('Title Typography', 'slideout-menu-widget'),
                        'selector' => '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-title',
                ]
        );

        $this->add_control(
                'icon_box_description_heading',
                [
                        'label' => __('Description', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                ]
        );

        $this->add_control(
                'icon_box_description_color',
                [
                        'label' => __('Description Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#666',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-description' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'icon_box_description_typography',
                        'label' => __('Description Typography', 'slideout-menu-widget'),
                        'selector' => '#slide-out-menu-{{ID}} .mobile-icon-box .icon-box-description',
                ]
        );

        $this->add_control(
                'icon_box_hover_heading',
                [
                        'label' => __('Hover Effects', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'separator' => 'before',
                ]
        );

        $this->add_control(
                'icon_box_hover_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box:hover' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'icon_box_hover_icon_color',
                [
                        'label' => __('Icon Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box:hover .icon-box-icon' => 'color: {{VALUE}}',
                                '#slide-out-menu-{{ID}} .mobile-icon-box:hover .icon-box-icon svg' => 'fill: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'icon_box_hover_title_color',
                [
                        'label' => __('Title Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .mobile-icon-box:hover .icon-box-title' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Menu Panel (Mobile/Tablet)
        // ==========================================
        $this->start_controls_section(
                'menu_style_section',
                [
                        'label' => __('Menu Panel (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'menu_width',
                [
                        'label' => __('Menu Width', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 200,
                                        'max' => 500,
                                        'step' => 10,
                                ],
                        ],
                        'default' => [
                                'unit' => 'px',
                                'size' => 290,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}}' => 'width: {{SIZE}}{{UNIT}}',
                        ],
                ]
        );

        $this->add_control(
                'menu_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#fff',
                        'selectors' => [
                                '#slide-out-menu-{{ID}}' => 'background-color: {{VALUE}}',
                                '#slide-out-menu-{{ID}} .menu-panel' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'overlay_color',
                [
                        'label' => __('Overlay Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => 'rgba(0, 0, 0, 0.5)',
                        'selectors' => [
                                '{{WRAPPER}}.active:before' => 'background: {{VALUE}}',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Main Menu Items (Mobile/Tablet)
        // ==========================================
        $this->start_controls_section(
                'main_menu_items_style_section',
                [
                        'label' => __('Main Menu Items (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'main_menu_item_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#f7f7f7',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .primary-menu-panel ul li' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'main_menu_item_text_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#000',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .primary-menu-panel .menu-link' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'main_menu_item_hover_bg_color',
                [
                        'label' => __('Hover Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#e5e5e5',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .primary-menu-panel ul li:hover' => 'background-color: {{VALUE}}',
                                '#slide-out-menu-{{ID}} .primary-menu-panel .menu-link:hover' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'main_menu_item_hover_text_color',
                [
                        'label' => __('Hover Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .primary-menu-panel .menu-link:hover' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'main_menu_border_color',
                [
                        'label' => __('Border Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#e5e5e5',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .primary-menu-panel ul li' => 'border-bottom-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'main_menu_border_width',
                [
                        'label' => __('Border Width', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 10,
                                ],
                        ],
                        'default' => [
                                'size' => 1,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .primary-menu-panel ul li' => 'border-bottom-width: {{SIZE}}{{UNIT}}; border-bottom-style: solid;',
                        ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'main_menu_item_typography',
                        'label' => __('Typography', 'slideout-menu-widget'),
                        'selector' => '#slide-out-menu-{{ID}} .primary-menu-panel .menu-link',
                ]
        );

        $this->add_responsive_control(
                'main_menu_item_padding',
                [
                        'label' => __('Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em'],
                        'default' => [
                                'top' => 14,
                                'right' => 20,
                                'bottom' => 14,
                                'left' => 20,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .primary-menu-panel .menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Submenu Items (Mobile/Tablet)
        // ==========================================
        $this->start_controls_section(
                'submenu_items_style_section',
                [
                        'label' => __('Submenu Items (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'submenu_item_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#ffffff',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-panel ul li' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'submenu_item_text_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#333',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-panel ul li a' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'submenu_item_hover_bg_color',
                [
                        'label' => __('Hover Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#f0f0f0',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-panel ul li:hover' => 'background-color: {{VALUE}}',
                                '#slide-out-menu-{{ID}} .menu-panel ul li a:hover' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'submenu_item_hover_text_color',
                [
                        'label' => __('Hover Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-panel ul li a:hover' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'submenu_border_color',
                [
                        'label' => __('Border Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#e5e5e5',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-panel ul li' => 'border-bottom-color: {{VALUE}}',
                                '#slide-out-menu-{{ID}} .menu-header' => 'border-bottom-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_responsive_control(
                'submenu_border_width',
                [
                        'label' => __('Border Width', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 10,
                                ],
                        ],
                        'default' => [
                                'size' => 1,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-panel ul li' => 'border-bottom-width: {{SIZE}}{{UNIT}}; border-bottom-style: solid;',
                                '#slide-out-menu-{{ID}} .menu-header' => 'border-bottom-width: {{SIZE}}{{UNIT}}; border-bottom-style: solid;',
                        ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'submenu_item_typography',
                        'label' => __('Typography', 'slideout-menu-widget'),
                        'selector' => '#slide-out-menu-{{ID}} .menu-panel ul li a',
                ]
        );

        $this->add_responsive_control(
                'submenu_item_padding',
                [
                        'label' => __('Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em'],
                        'default' => [
                                'top' => 12,
                                'right' => 20,
                                'bottom' => 12,
                                'left' => 20,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-panel ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB - Submenu Header (Mobile/Tablet)
        // ==========================================
        $this->start_controls_section(
                'submenu_header_style_section',
                [
                        'label' => __('Submenu Header (Mobile/Tablet)', 'slideout-menu-widget'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
                'submenu_header_bg_color',
                [
                        'label' => __('Background Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#f7f7f7',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-header' => 'background-color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_control(
                'submenu_header_text_color',
                [
                        'label' => __('Text Color', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '#000',
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-header' => 'color: {{VALUE}}',
                        ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                        'name' => 'submenu_header_typography',
                        'label' => __('Typography', 'slideout-menu-widget'),
                        'selector' => '#slide-out-menu-{{ID}} .menu-header',
                ]
        );

        $this->add_responsive_control(
                'submenu_header_padding',
                [
                        'label' => __('Padding', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', 'em'],
                        'default' => [
                                'top' => 16,
                                'right' => 20,
                                'bottom' => 16,
                                'left' => 20,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                ]
        );

        $this->add_responsive_control(
                'submenu_header_border_width',
                [
                        'label' => __('Border Width', 'slideout-menu-widget'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'range' => [
                                'px' => [
                                        'min' => 0,
                                        'max' => 10,
                                ],
                        ],
                        'default' => [
                                'size' => 1,
                        ],
                        'selectors' => [
                                '#slide-out-menu-{{ID}} .menu-link.menu-header' => 'border-bottom-width: {{SIZE}}{{UNIT}}; border-style: solid;',
                        ],
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Get menu items organized by parent-child relationship
     */
    private function get_menu_structure($menu_id) {
        if (empty($menu_id)) {
            return [];
        }

        $menu_items = wp_get_nav_menu_items($menu_id);

        if (!$menu_items) {
            return [];
        }

        $menu_structure = [];
        $submenu_items = [];

        // Organize items by parent
        foreach ($menu_items as $item) {
            if ($item->menu_item_parent == 0) {
                // Top level item
                $menu_structure[$item->ID] = [
                        'id' => $item->ID,
                        'title' => $item->title,
                        'url' => $item->url,
                        'target' => $item->target,
                        'classes' => implode(' ', array_filter($item->classes)),
                        'current' => $item->current,
                        'current_parent' => $item->current_item_parent,
                        'current_ancestor' => $item->current_item_ancestor,
                        'children' => []
                ];
            } else {
                // Child item
                if (!isset($submenu_items[$item->menu_item_parent])) {
                    $submenu_items[$item->menu_item_parent] = [];
                }
                $submenu_items[$item->menu_item_parent][] = [
                        'id' => $item->ID,
                        'title' => $item->title,
                        'url' => $item->url,
                        'target' => $item->target,
                        'classes' => implode(' ', array_filter($item->classes)),
                        'current' => $item->current
                ];
            }
        }

        // Attach children to parents
        foreach ($submenu_items as $parent_id => $children) {
            if (isset($menu_structure[$parent_id])) {
                $menu_structure[$parent_id]['children'] = $children;
            }
        }

        return $menu_structure;
    }

    /**
     * Render icon based on type (icon, svg, or image)
     */
    private function render_icon($icon_type, $icon, $svg, $image, $class = '') {
        $output = '';

        switch ($icon_type) {
            case 'icon':
                if (!empty($icon['value'])) {
                    ob_start();
                    \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => $class]);
                    $output = ob_get_clean();
                }
                break;
            case 'svg':
                if (!empty($svg)) {
                    $output = '<span class="' . esc_attr($class) . '">' . $svg . '</span>';
                }
                break;
            case 'image':
                if (!empty($image['url'])) {
                    $output = '<img src="' . esc_url($image['url']) . '" alt="" class="' . esc_attr($class) . '">';
                }
                break;
        }

        return $output;
    }

    /**
     * Get breakpoint value
     */
    private function get_breakpoint_value($breakpoint_key) {
        $breakpoints = \Elementor\Plugin::$instance->breakpoints->get_active_breakpoints();

        if (isset($breakpoints[$breakpoint_key])) {
            return $breakpoints[$breakpoint_key]->get_value();
        }

        // Default values
        $defaults = [
                'mobile' => 767,
                'tablet' => 1024,
        ];

        return isset($defaults[$breakpoint_key]) ? $defaults[$breakpoint_key] : 1024;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $menu_structure = $this->get_menu_structure($settings['selected_menu']);
        $slide_direction = isset($settings['slide_direction']) ? $settings['slide_direction'] : 'left';

        if (empty($menu_structure)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<div style="padding: 20px; background: #f0f0f0; border: 1px solid #ddd;">';
                echo '<p><strong>Slideout Menu Widget:</strong> Please select a WordPress menu from the widget settings.</p>';
                echo '<p>Go to Appearance > Menus to create a menu if you haven\'t already.</p>';
                echo '</div>';
            }
            return;
        }

        // Settings
        $show_icons = isset($settings['show_icons']) && $settings['show_icons'] === 'yes';
        $show_logo = isset($settings['show_logo']) && $settings['show_logo'] === 'yes';
        $logo_url = $show_logo && isset($settings['logo_image']['url']) ? $settings['logo_image']['url'] : '';

        // Desktop settings
        $desktop_layout = isset($settings['desktop_menu_layout']) ? $settings['desktop_menu_layout'] : 'horizontal';
        $desktop_submenu_behavior = isset($settings['desktop_submenu_behavior']) ? $settings['desktop_submenu_behavior'] : 'dropdown';
        $desktop_submenu_indicator = isset($settings['desktop_submenu_indicator']) && $settings['desktop_submenu_indicator'] === 'yes';
        $desktop_submenu_animation = isset($settings['desktop_submenu_animation']) ? $settings['desktop_submenu_animation'] : 'fade';

        // Search settings
        $show_search = isset($settings['show_search']) && $settings['show_search'] === 'yes';
        $search_placeholder = isset($settings['search_placeholder']) ? $settings['search_placeholder'] : __('Search...', 'slideout-menu-widget');
        // Note: We ignore $search_position for mobile rendering now to force it inside
        $search_icon_type = isset($settings['search_icon_type']) ? $settings['search_icon_type'] : 'icon';
        $search_icon = isset($settings['search_icon']) ? $settings['search_icon'] : ['value' => 'fas fa-search', 'library' => 'fa-solid'];
        $search_icon_svg = isset($settings['search_icon_svg']) ? $settings['search_icon_svg'] : '';
        $search_icon_image = isset($settings['search_icon_image']) ? $settings['search_icon_image'] : [];

        // Icon box settings
        $show_icon_box = isset($settings['show_icon_box']) && $settings['show_icon_box'] === 'yes';
        $icon_boxes = isset($settings['icon_boxes']) ? $settings['icon_boxes'] : [];
        $icon_box_position = isset($settings['icon_box_position']) ? $settings['icon_box_position'] : 'inside_bottom'; // Default fallback
        $icon_box_layout = isset($settings['icon_box_layout']) ? $settings['icon_box_layout'] : 'horizontal';

        // Icon size settings
        $icon_box_icon_size = isset($settings['icon_box_icon_size']['size']) ? $settings['icon_box_icon_size']['size'] : 24;
        $icon_box_icon_size_unit = isset($settings['icon_box_icon_size']['unit']) ? $settings['icon_box_icon_size']['unit'] : 'px';
        $arrow_icon_size = isset($settings['arrow_icon_size']['size']) ? $settings['arrow_icon_size']['size'] : 14;
        $arrow_icon_size_unit = isset($settings['arrow_icon_size']['unit']) ? $settings['arrow_icon_size']['unit'] : 'px';
        $search_icon_size = isset($settings['search_icon_size']['size']) ? $settings['search_icon_size']['size'] : 18;
        $search_icon_size_unit = isset($settings['search_icon_size']['unit']) ? $settings['search_icon_size']['unit'] : 'px';

        // Breakpoint
        $breakpoint = isset($settings['dropdown']) ? $settings['dropdown'] : 'tablet';
        $breakpoint_value = $this->get_breakpoint_value($breakpoint);

        // Set transform direction for mobile
        $transform_value = $slide_direction === 'right' ? '290px' : '-290px';
        $position_side = $slide_direction === 'right' ? 'right: 0;' : 'left: 0;';
        ?>

        <div class="slideout-menu-wrapper" id="slideout-menu-<?php echo esc_attr($widget_id); ?>" data-direction="<?php echo esc_attr($slide_direction); ?>" data-breakpoint="<?php echo esc_attr($breakpoint_value); ?>">

            <nav class="desktop-menu-container" aria-label="<?php echo esc_attr($settings['menu_name']); ?>">
                <ul class="desktop-menu <?php echo esc_attr($desktop_layout); ?>">
                    <?php foreach ($menu_structure as $item) :
                        $has_children = !empty($item['children']);
                        $item_classes = ['menu-item'];
                        if ($has_children) $item_classes[] = 'menu-item-has-children';
                        if ($item['current']) $item_classes[] = 'current-menu-item';
                        if ($item['current_ancestor']) $item_classes[] = 'current-menu-ancestor';
                        if (!empty($item['classes'])) $item_classes[] = $item['classes'];
                        if($item['id']) $item_classes[] = 'menu-item-'.$item['id'];
                        ?>
                        <li class="<?php echo esc_attr(implode(' ', $item_classes)); ?>">
                            <a href="<?php echo esc_url($item['url']); ?>" class="menu-link menu-link-direct" <?php echo !empty($item['target']) ? 'target="'.esc_attr($item['target']).'"' : ''; ?>>
                                <?php echo esc_html($item['title']); ?>
                                <?php if ($has_children && $desktop_submenu_indicator) : ?>
                                    <span class="submenu-indicator">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor">
                                        <path d="M1 3l4 4 4-4"></path>
                                    </svg>
                                </span>
                                <?php endif; ?>
                            </a>
                            <?php if ($has_children) : ?>
                                <ul class="sub-menu <?php echo esc_attr($desktop_submenu_animation); ?>">
                                    <?php foreach ($item['children'] as $child) :
                                        $child_classes = ['menu-item'];
                                        if ($child['current']) $child_classes[] = 'current-menu-item';
                                        if (!empty($child['classes'])) $child_classes[] = $child['classes'];
                                        if($child_classes['id']) $child_classes[] = 'menu-item-'.$child['id'];
                                        ?>
                                        <li class="<?php echo esc_attr(implode(' ', $child_classes)); ?>">
                                            <a href="<?php echo esc_url($child['url']); ?>" <?php echo !empty($child['target']) ? 'target="'.esc_attr($child['target']).'"' : ''; ?>>
                                                <?php echo esc_html($child['title']); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <nav class="mobile-menu-container navbar">
                <div class="mobile-header">
                    <button type="button" id="menu-toggle-<?php echo esc_attr($widget_id); ?>" class="menu-toggle" aria-label="<?php echo esc_attr($settings['menu_button_text']); ?>">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                        <?php if (!empty($settings['menu_button_text'])) : ?>
                            <span class="menu-toggle-text"><?php echo esc_html($settings['menu_button_text']); ?></span>
                        <?php endif; ?>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Close Icon -->
        <button type="button" id="menu-close-<?php echo esc_attr($widget_id); ?>" class="menu-close-icon" aria-label="Close menu" style="display: none;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <!-- Slide Out Menu (Rendered separately and appended to body via JS) -->
        <nav class="slide-out-menu" id="slide-out-menu-<?php echo esc_attr($widget_id); ?>"
             style="<?php echo esc_attr($position_side); ?> z-index: 10000; position: fixed; top: 0; bottom: 0; max-width: 90vw; opacity: 0; visibility: hidden; overflow-y: auto; overflow-x: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.3); transition: opacity 0.2s, visibility 0ms linear 0.2s, transform 0.5s cubic-bezier(0.23, 1, 0.32, 1); transform: <?php echo $slide_direction === 'right' ? 'translateX(100%)' : 'translateX(-100%)'; ?>;"
             data-widget-id="<?php echo esc_attr($widget_id); ?>"
             data-direction="<?php echo esc_attr($slide_direction); ?>">

            <?php if ($show_logo && $logo_url) : ?>
                <div class="menu-logo">
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </div>
            <?php endif; ?>

            <?php
            // We render icons here if they exist.
            // If you want to strictly separate Top vs Bottom, check $icon_box_position.
            // Currently, this block renders them at the top if position is NOT 'inside_bottom'.
            if ($show_icon_box && !empty($icon_boxes) && $icon_box_position !== 'inside_bottom') : ?>
                <div class="mobile-icon-boxes inside-top">
                <?php foreach ($icon_boxes as $index => $box) :
                    $link_url = isset($box['icon_box_link']['url']) ? $box['icon_box_link']['url'] : '';
                    $link_target = isset($box['icon_box_link']['is_external']) && $box['icon_box_link']['is_external'] ? '_blank' : '_self';
                    $link_nofollow = isset($box['icon_box_link']['nofollow']) && $box['icon_box_link']['nofollow'] ? 'nofollow' : '';
                    ?>
                    <?php if ($link_url) : ?>
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" <?php echo $link_nofollow ? 'rel="nofollow"' : ''; ?> class="mobile-icon-box layout-<?php echo esc_attr($icon_box_layout); ?>">
                <?php else : ?>
                    <div class="mobile-icon-box layout-<?php echo esc_attr($icon_box_layout); ?>">
                <?php endif; ?>
                    <span class="icon-box-icon">
                    <?php
                    $box_icon_type = isset($box['icon_box_icon_type']) ? $box['icon_box_icon_type'] : 'icon';
                    $box_icon = isset($box['icon_box_icon']) ? $box['icon_box_icon'] : [];
                    $box_svg = isset($box['icon_box_svg']) ? $box['icon_box_svg'] : '';
                    $box_image = isset($box['icon_box_image']) ? $box['icon_box_image'] : [];
                    echo $this->render_icon($box_icon_type, $box_icon, $box_svg, $box_image, 'icon-box-icon-inner');
                    ?>
                </span>
                    <span class="icon-box-content">
                    <?php if (!empty($box['icon_box_title'])) : ?>
                        <span class="icon-box-title"><?php echo esc_html($box['icon_box_title']); ?></span>
                    <?php endif; ?>
                        <?php if (!empty($box['icon_box_description'])) : ?>
                            <span class="icon-box-description"><?php echo esc_html($box['icon_box_description']); ?></span>
                        <?php endif; ?>
                </span>
                    <?php if ($link_url) : ?>
                    </a>
                <?php else : ?>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="menu-panels">
                <div class="primary-menu-panel">
                    <ul>
                        <?php foreach ($menu_structure as $item) : ?>
                            <?php if (!empty($item['children'])) : ?>
                                <li>
                                    <button type="button" class="menu-link" data-ref="menu-<?php echo esc_attr($item['id']); ?>">
                                        <?php echo esc_html($item['title']); ?>
                                        <?php if ($show_icons) : ?>
                                            <svg class="arrow-right" fill="currentColor" height="30px" width="30px" viewBox="0 0 185.4 300">
                                                <path d="M7.3 292.7c-9.8-9.8-9.8-25.6 0-35.4L114.6 150 7.3 42.7c-9.8-9.8-9.8-25.6 0-35.4s25.6-9.8 35.4 0L185.4 150 42.7 292.7c-4.9 4.8-11.3 7.3-17.7 7.3-6.4 0-12.7-2.5-17.7-7.3z"></path>
                                            </svg>
                                        <?php endif; ?>
                                    </button>
                                </li>
                            <?php else : ?>
                                <li>
                                    <a href="<?php echo esc_url($item['url']); ?>" class="menu-link menu-link-direct" <?php echo !empty($item['target']) ? 'target="'.esc_attr($item['target']).'"' : ''; ?>>
                                        <?php echo esc_html($item['title']); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php foreach ($menu_structure as $item) : ?>
                    <?php if (!empty($item['children'])) : ?>
                        <div class="menu-panel" data-menu="menu-<?php echo esc_attr($item['id']); ?>">
                            <button type="button" class="menu-link menu-header back-button">
                                <?php if ($show_icons) : ?>
                                    <svg class="arrow-left" fill="currentColor" height="30px" width="30px" viewBox="0 0 185.4 300">
                                        <path d="M160.4 300c-6.4 0-12.7-2.5-17.7-7.3L0 150 142.7 7.3c9.8-9.8 25.6-9.8 35.4 0 9.8 9.8 9.8 25.6 0 35.4L70.7 150 178 257.3c9.8 9.8 9.8 25.6 0 35.4-4.9 4.8-11.3 7.3-17.6 7.3z"></path>
                                    </svg>
                                <?php endif; ?>
                                <?php echo esc_html($item['title']); ?>
                            </button>
                            <ul>
                                <?php foreach ($item['children'] as $child) : ?>
                                    <li>
                                        <a href="<?php echo esc_url($child['url']); ?>" <?php echo !empty($child['target']) ? 'target="'.esc_attr($child['target']).'"' : ''; ?>>
                                            <?php echo esc_html($child['title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php if ($show_search) : ?>
                <div class="mobile-search-inside">
                    <form role="search" method="get" class="mobile-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr($search_placeholder); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="search-submit">
                            <?php echo $this->render_icon($search_icon_type, $search_icon, $search_icon_svg, $search_icon_image, 'search-icon'); ?>
                        </button>
                    </form>
                </div>
            <?php endif; ?>

            <?php if ($show_icon_box && !empty($icon_boxes) && $icon_box_position === 'inside_bottom') : ?>
                <div class="mobile-icon-boxes inside-bottom">
                <?php foreach ($icon_boxes as $index => $box) :
                    $link_url = isset($box['icon_box_link']['url']) ? $box['icon_box_link']['url'] : '';
                    $link_target = isset($box['icon_box_link']['is_external']) && $box['icon_box_link']['is_external'] ? '_blank' : '_self';
                    $link_nofollow = isset($box['icon_box_link']['nofollow']) && $box['icon_box_link']['nofollow'] ? 'nofollow' : '';
                    ?>
                    <?php if ($link_url) : ?>
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" <?php echo $link_nofollow ? 'rel="nofollow"' : ''; ?> class="mobile-icon-box layout-<?php echo esc_attr($icon_box_layout); ?>">
                <?php else : ?>
                    <div class="mobile-icon-box layout-<?php echo esc_attr($icon_box_layout); ?>">
                <?php endif; ?>
                    <span class="icon-box-icon">
                    <?php
                    $box_icon_type = isset($box['icon_box_icon_type']) ? $box['icon_box_icon_type'] : 'icon';
                    $box_icon = isset($box['icon_box_icon']) ? $box['icon_box_icon'] : [];
                    $box_svg = isset($box['icon_box_svg']) ? $box['icon_box_svg'] : '';
                    $box_image = isset($box['icon_box_image']) ? $box['icon_box_image'] : [];
                    echo $this->render_icon($box_icon_type, $box_icon, $box_svg, $box_image, 'icon-box-icon-inner');
                    ?>
                </span>
                    <span class="icon-box-content">
                    <?php if (!empty($box['icon_box_title'])) : ?>
                        <span class="icon-box-title"><?php echo esc_html($box['icon_box_title']); ?></span>
                    <?php endif; ?>
                        <?php if (!empty($box['icon_box_description'])) : ?>
                            <span class="icon-box-description"><?php echo esc_html($box['icon_box_description']); ?></span>
                        <?php endif; ?>
                </span>
                    <?php if ($link_url) : ?>
                    </a>
                <?php else : ?>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </nav>

        <!-- Slide Out Menu Styles (Appended to body with menu) -->
        <style id="slide-out-menu-styles-<?php echo esc_attr($widget_id); ?>">
            /* Critical Menu Styles */
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> {
                z-index: 10000 !important;
                position: fixed !important;
                top: 0 !important;
                bottom: 0 !important;
                max-width: 90vw !important;
                opacity: 0 !important;
                visibility: hidden !important;
                overflow-y: auto !important;
                overflow-x: hidden !important;
                box-shadow: 0 0 20px rgba(0,0,0,0.3) !important;
                transition: opacity 0.2s, visibility 0ms linear 0.2s, transform 0.5s cubic-bezier(0.23, 1, 0.32, 1) !important;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> * {
                box-sizing: border-box;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-logo {
                display: block;
                border-bottom: 1px solid #e5e5e5;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-logo img {
                max-width: 100%;
                height: auto;
                display: inline-block;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panels {
                overflow: hidden;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> ul {
                margin: 0;
                padding: 0;
                list-style: none;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .primary-menu-panel ul li {
                font-size: 14px;
                border-bottom: 1px solid #e5e5e5;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panel ul li {
                font-size: 14px;
                border-bottom: 1px solid #e5e5e5;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link {
                position: relative;
                text-align: left;
                width: 100%;
                display: block;
                background: transparent;
                margin: 0;
                border: none;
                cursor: pointer;
                font-size: 14px;
                text-decoration: none;
                transition: all 0.2s ease;
                padding: 15px 20px;
                color: inherit;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> ul li a {
                width: 100%;
                display: block;
                text-decoration: none;
                transition: all 0.2s ease;
                padding: 15px 20px;
                color: inherit;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link svg {
                position: absolute;
                top: 50%;
                height: <?php echo esc_attr($arrow_icon_size . $arrow_icon_size_unit); ?>;
                width: <?php echo esc_attr($arrow_icon_size . $arrow_icon_size_unit); ?>;
                min-width: <?php echo esc_attr($arrow_icon_size . $arrow_icon_size_unit); ?>;
                margin-top: calc(-<?php echo esc_attr($arrow_icon_size . $arrow_icon_size_unit); ?> / 2);
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link svg.arrow-right {
                right: 20px;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link svg.arrow-left {
                left: 20px;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link.menu-header {
                text-align: center;
                border: none;
                border-bottom: 1px solid #e5e5e5;
                font-weight: 600;
                padding-left: 40px;
                box-shadow: none;
                outline: none;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panel {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
                overflow-y: auto;
                z-index: 0;
                transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1), visibility 0s linear 0.4s;
                visibility: hidden;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?>[data-direction="left"] .menu-panel {
                transform: translateX(-100%);
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?>[data-direction="right"] .menu-panel {
                transform: translateX(100%);
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panel.is-active {
                visibility: visible;
                transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1), visibility 0s;
                transform: translateX(0);
                z-index: 1;
            }

            /* Hide search and icon boxes when submenu is open */
            #slide-out-menu-<?php echo esc_attr($widget_id); ?>.has-active-submenu .mobile-search-inside,
            #slide-out-menu-<?php echo esc_attr($widget_id); ?>.has-active-submenu .mobile-icon-boxes {
                display: none !important;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-inside {
                padding: 15px;
                border-bottom: 1px solid #e5e5e5;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form input[type="search"] {
                flex: 1;
                border: 1px solid #ddd;
                outline: none;
                padding: 8px;
                border-radius: 4px;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit {
                background: none;
                border: none;
                cursor: pointer;
                padding: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit svg,
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit i,
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit img {
                line-height: 1;
            }

            /* Font Awesome icons for search */
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit i[class*="fa-"],
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit i[class*="fas"],
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit i[class*="far"],
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit i[class*="fab"] {
                width: auto;
                height: auto;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-boxes {
                padding: 15px;
                border-bottom: 1px solid #e5e5e5;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-boxes.inside-bottom {
                border-bottom: none;
                border-top: 1px solid #e5e5e5;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box {
                display: flex;
                align-items: center;
                text-decoration: none;
                padding: 10px 0;
                transition: all 0.3s ease;
                color: inherit;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box.layout-vertical {
                flex-direction: column;
                text-align: center;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box.layout-horizontal {
                flex-direction: row;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon svg,
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon i,
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon img {
                max-width: 100%;
                line-height: 1;
            }

            /* Specific styles for Font Awesome icons */
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon i[class*="fa-"],
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon i[class*="fas"],
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon i[class*="far"],
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon i[class*="fab"] {
                width: auto;
                height: auto;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-content {
                display: flex;
                flex-direction: column;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-title {
                font-weight: 600;
            }

            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-description {
                font-size: 0.9em;
            }

            /* Active State */
            body.slideout-menu-active-<?php echo esc_attr($widget_id); ?> #slide-out-menu-<?php echo esc_attr($widget_id); ?> {
                transform: translateZ(0) !important;
                opacity: 1 !important;
                visibility: visible !important;
                transition: opacity 0.2s, visibility 0ms, transform 0.5s cubic-bezier(0.23, 1, 0.32, 1) !important;
            }

            /* Close Button */
            #menu-close-<?php echo esc_attr($widget_id); ?> {
                position: fixed !important;
                z-index: 10001 !important;
                background: #fff !important;
                border: none !important;
                border-radius: 50% !important;
                width: 40px !important;
                height: 40px !important;
                display: none !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
                transition: all 0.3s ease !important;
                top: 15px !important;
            <?php if ($slide_direction === 'left') : ?>
                left: 310px !important;
            <?php else : ?>
                right: 310px !important;
            <?php endif; ?>
            }

            #menu-close-<?php echo esc_attr($widget_id); ?>:hover {
                background: #f0f0f0 !important;
                transform: rotate(90deg) !important;
            }

            body.slideout-menu-active-<?php echo esc_attr($widget_id); ?> #menu-close-<?php echo esc_attr($widget_id); ?> {
                display: flex !important;
            }
            /* ================================================
            /* ========================================
               RESPONSIVE VISIBILITY
            ======================================== */
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu-container {
                display: flex;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .mobile-menu-container {
                display: none;
            }

            @media (max-width: <?php echo esc_attr($breakpoint_value); ?>px) {
                #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu-container {
                    display: none;
                }
                #slideout-menu-<?php echo esc_attr($widget_id); ?> .mobile-menu-container {
                    display: block;
                }
            }

            body.bg-overlay:before {
                content: "";
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 2;
                cursor: pointer;
            }

            /* ========================================
               DESKTOP MENU STYLES
            ======================================== */
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu-container {
                width: 100%;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu {
                display: flex;
                flex-wrap: wrap;
                list-style: none;
                margin: 0;
                padding: 0;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu.vertical {
                flex-direction: column;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu > li {
                position: relative;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu > li > a {
                display: flex;
                align-items: center;
                gap: 5px;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu .submenu-indicator {
                display: inline-flex;
                transition: transform 0.3s ease;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu > li:hover .submenu-indicator {
                transform: rotate(180deg);
            }

            /* Desktop Dropdown/Submenu */
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu .sub-menu {
                position: absolute;
                top: 100%;
                left: 0;
                list-style: none;
                margin: 0;
                padding: 0;
                opacity: 0;
                visibility: hidden;
                transform: translateY(10px);
                transition: all 0.3s ease;
                z-index: 1000;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu .sub-menu.fade {
                transform: translateY(0);
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu .sub-menu.slide-up {
                transform: translateY(10px);
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu .sub-menu.slide-down {
                transform: translateY(-10px);
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu > li:hover > .sub-menu,
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu > li.submenu-open > .sub-menu {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .desktop-menu .sub-menu li a {
                display: block;
                text-decoration: none;
                white-space: nowrap;
                transition: all 0.3s ease;
            }

            /* ========================================
               CLOSE ICON STYLES
            ======================================== */
            #menu-close-<?php echo esc_attr($widget_id); ?> {
                position: fixed;
                z-index: 10001;
                background: #fff;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                top: 15px;
            }

            #menu-close-<?php echo esc_attr($widget_id); ?>:hover {
                background: #f0f0f0;
                transform: rotate(90deg);
            }

            <?php if ($slide_direction === 'left') : ?>
            #menu-close-<?php echo esc_attr($widget_id); ?> {
                left: 300px;
            }
            <?php else : ?>
            #menu-close-<?php echo esc_attr($widget_id); ?> {
                right: 300px;
            }
            <?php endif; ?>

            /* ========================================
               MOBILE/TABLET MENU STYLES
            ======================================== */
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .mobile-header {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .menu-toggle {
                display: flex;
                align-items: center;
                gap: 8px;
                border: none;
                cursor: pointer;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .hamburger-icon {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                width: 20px;
                height: 14px;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .hamburger-icon span {
                display: block;
                height: 2px;
                background-color: currentColor;
                transition: all 0.3s ease;
            }

            /* Search Inside Menu */
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-inside {
                padding: 15px;
                border-bottom: 1px solid #e5e5e5;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-inside.bottom {
                border-bottom: none;
                border-top: 1px solid #e5e5e5;
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form input[type="search"] {
                flex: 1;
                border: 1px solid #ddd;
                outline: none;
                padding: 8px;
                border-radius: 4px;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-search-form .search-submit {
                background: none;
                border: none;
                cursor: pointer;
                padding: 5px;
            }

            /* Icon Boxes */
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-boxes {
                padding: 15px;
                border-bottom: 1px solid #e5e5e5;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-boxes.inside-bottom {
                border-bottom: none;
                border-top: 1px solid #e5e5e5;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box {
                display: flex;
                align-items: center;
                text-decoration: none;
                padding: 10px 0;
                transition: all 0.3s ease;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box.layout-vertical {
                flex-direction: column;
                text-align: center;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box.layout-horizontal {
                flex-direction: row;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-icon {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-content {
                display: flex;
                flex-direction: column;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-title {
                font-weight: 600;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .mobile-icon-box .icon-box-description {
                font-size: 0.9em;
            }

            /* Slideout Menu Overlay */
            #slideout-menu-<?php echo esc_attr($widget_id); ?>.slideout-menu-wrapper:before {
                content: "";
                display: block;
                z-index: -1;
                position: fixed;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s, visibility 0ms linear 0.2s, z-index 0ms linear 0.2s;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?>.slideout-menu-wrapper.active:before {
                transition: opacity 0.2s, visibility 0ms;
                z-index: 9999;
                opacity: 1;
                visibility: visible;
            }
            body.slideout-menu-active-<?php echo esc_attr($widget_id); ?> #slide-out-menu-<?php echo esc_attr($widget_id); ?> {
                transform: translateZ(0);
                opacity: 1;
                visibility: visible;
                transition: opacity 0.2s, visibility 0ms, transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            }
            body.slideout-menu-active-<?php echo esc_attr($widget_id); ?> #menu-close-<?php echo esc_attr($widget_id); ?> {
                display: flex !important;
            }
            #slideout-menu-<?php echo esc_attr($widget_id); ?> .navbar {
                padding: 10px;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-logo {
                display: block;
                border-bottom: 1px solid #e5e5e5;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-logo img {
                max-width: 100%;
                height: auto;
                display: inline-block;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> {
                z-index: 10000;
                position: fixed;
                top: 0;
                bottom: 0;
                max-width: 90vw;
                opacity: 0;
                visibility: hidden;
                overflow-y: auto;
                overflow-x: hidden;
                box-shadow: 0 0 20px rgba(0,0,0,0.3);
                transition: opacity 0.2s, visibility 0ms linear 0.2s, transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?>[data-direction="left"] {
                transform: translateX(-100%);
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?>[data-direction="right"] {
                transform: translateX(100%);
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panels {
                overflow: hidden;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link {
                position: relative;
                text-align: left;
                width: 100%;
                display: block;
                background: transparent;
                margin: 0;
                border: none;
                cursor: pointer;
                font-size: 14px;
                text-decoration: none;
                transition: all 0.2s ease;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link svg {
                position: absolute;
                top: 50%;
                margin-top: -7px;
                height: 14px;
                width: auto;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link svg.arrow-right {
                right: 10px;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link svg.arrow-left {
                left: 10px;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-link.menu-header {
                text-align: center;
                border: none;
                border-bottom-style: solid;
                font-weight: 600;
                box-shadow: none;
                outline: none;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> ul {
                margin: 0;
                padding: 0;
                list-style: none;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .primary-menu-panel ul li {
                font-size: 14px;
                border-bottom-style: solid;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panel ul li {
                font-size: 14px;
                border-bottom-style: solid;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> ul li a {
                width: 100%;
                display: block;
                text-decoration: none;
                transition: all 0.2s ease;
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panel {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
                overflow-y: auto;
                z-index: 0;
                transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1), visibility 0s linear 0.4s;
                visibility: hidden;
                transform: translateX(-100%);
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?>[data-direction="right"] .menu-panel {
                transform: translateX(100%);
            }
            #slide-out-menu-<?php echo esc_attr($widget_id); ?> .menu-panel.is-active {
                visibility: visible;
                transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1), visibility 0s;
                transform: translateX(0);
                z-index: 1;
            }
        </style>

        <script>
            (function($) {
                $(document).ready(function() {
                    var widgetId = '<?php echo esc_js($widget_id); ?>';
                    var $wrapper = $('#slideout-menu-' + widgetId);
                    var $slideOutMenu = $('#slide-out-menu-' + widgetId);
                    var $toggleBtn = $('#menu-toggle-' + widgetId);
                    var $closeBtn = $('#menu-close-' + widgetId);
                    var $menuStyles = $('#slide-out-menu-styles-' + widgetId);
                    var submenuBehavior = '<?php echo esc_js($desktop_submenu_behavior); ?>';
                    var bodyClass = 'slideout-menu-active-' + widgetId;

                    // Move slide-out menu, close button, and styles to body
                    $slideOutMenu.appendTo('body');
                    $closeBtn.appendTo('body');
                    if ($menuStyles.length) {
                        $menuStyles.appendTo('head');
                    }

                    // Desktop menu - click behavior for submenus
                    if (submenuBehavior === 'dropdown_click') {
                        $wrapper.find('.desktop-menu > .menu-item-has-children > a').on('click', function(e) {
                            e.preventDefault();
                            var $parent = $(this).parent();
                            $parent.siblings('.menu-item-has-children').removeClass('submenu-open');
                            $parent.toggleClass('submenu-open');
                        });

                        // Close dropdown when clicking outside
                        $(document).on('click', function(e) {
                            if (!$(e.target).closest('.desktop-menu-container').length) {
                                $wrapper.find('.menu-item-has-children').removeClass('submenu-open');
                            }
                        });
                    }

                    // Open mobile menu
                    $toggleBtn.on('click', function(e) {
                        e.stopPropagation();
                        $wrapper.addClass('active');
                        $('body').css('overflow', 'hidden').addClass('bg-overlay').addClass(bodyClass);
                    });

                    // Close menu via close button
                    $closeBtn.on('click', function(e) {
                        e.stopPropagation();
                        $wrapper.removeClass('active');
                        $slideOutMenu.find('.menu-panel').removeClass('is-active');
                        $slideOutMenu.removeClass('has-active-submenu');
                        $('body').css('overflow', '').removeClass('bg-overlay').removeClass(bodyClass);
                    });

                    // Close menu when clicking outside (overlay)
                    $(document).on('click', function(e) {
                        if (!$(e.target).closest('#slide-out-menu-' + widgetId).length &&
                            !$(e.target).is($toggleBtn) &&
                            !$(e.target).closest('.menu-toggle').length &&
                            !$(e.target).is($closeBtn) &&
                            !$(e.target).closest('.menu-close-icon').length) {
                            $wrapper.removeClass('active');
                            $slideOutMenu.find('.menu-panel').removeClass('is-active');
                            $slideOutMenu.removeClass('has-active-submenu');
                            $('body').css('overflow', '').removeClass('bg-overlay').removeClass(bodyClass);
                        }
                    });

                    // Prevent clicks inside menu from closing it
                    $slideOutMenu.on('click', function(e) {
                        e.stopPropagation();
                    });

                    // Handle submenu navigation
                    $slideOutMenu.find('.menu-link').on('click', function(e) {
                        if ($(this).hasClass('back-button')) {
                            e.preventDefault();
                            $slideOutMenu.find('.menu-panel').removeClass('is-active');
                            $slideOutMenu.removeClass('has-active-submenu');
                        } else if ($(this).data('ref')) {
                            e.preventDefault();
                            var targetRef = $(this).data('ref');
                            $slideOutMenu.find('.menu-panel').removeClass('is-active');
                            $slideOutMenu.find('.menu-panel[data-menu="' + targetRef + '"]').addClass('is-active');
                            $slideOutMenu.addClass('has-active-submenu');
                        }
                    });

                    // Close menu when clicking direct links (items without submenus)
                    $slideOutMenu.find('.menu-link-direct').on('click', function() {
                        setTimeout(function() {
                            $wrapper.removeClass('active');
                            $slideOutMenu.find('.menu-panel').removeClass('is-active');
                            $slideOutMenu.removeClass('has-active-submenu');
                            $('body').css('overflow', '').removeClass('bg-overlay').removeClass(bodyClass);
                        }, 150);
                    });

                    // Close menu when clicking submenu links
                    $slideOutMenu.find('.menu-panel ul li a').on('click', function() {
                        setTimeout(function() {
                            $wrapper.removeClass('active');
                            $slideOutMenu.find('.menu-panel').removeClass('is-active');
                            $slideOutMenu.removeClass('has-active-submenu');
                            $('body').css('overflow', '').removeClass('bg-overlay').removeClass(bodyClass);
                        }, 150);
                    });

                    // Handle window resize
                    var breakpoint = $wrapper.data('breakpoint');
                    $(window).on('resize', function() {
                        if ($(window).width() > breakpoint) {
                            $wrapper.removeClass('active');
                            $slideOutMenu.find('.menu-panel').removeClass('is-active');
                            $slideOutMenu.removeClass('has-active-submenu');
                            $('body').css('overflow', '').removeClass('bg-overlay').removeClass(bodyClass);
                        }
                    });
                });
            })(jQuery);
        </script>
        <?php
    }
}