Elementor Slideout Menu Widget
Version: 1.2
Requires WordPress: 5.0 or higher
Requires PHP: 7.0 or higher
Requires Elementor: 3.0.0 or higher
License: GPL v2 or later
Description
A powerful and customizable slideout menu widget for Elementor that integrates seamlessly with WordPress menus. Create beautiful mobile-friendly navigation with smooth animations, custom styling, and flexible layout options.
Features
Core Features

✅ WordPress Menu Integration - Select any registered WordPress menu from dropdown
✅ Slide Direction - Choose left or right slide animation
✅ Logo Support - Add your logo at the top of the menu
✅ Arrow Icons - Toggle arrow icons on/off
✅ Multi-level Menus - Supports parent-child menu relationships
✅ Smooth Animations - Beautiful cubic-bezier transitions
✅ Overlay Effect - Customizable dark overlay when menu is open

Styling Controls

Menu Button - Background, text color, typography, padding, border radius
Menu Panel - Width, background color, overlay color
Main Menu Items - Background, text color, hover states, borders, typography, padding
Submenu Items - Separate styling for submenus including background, text, hover colors, borders, typography, padding
Submenu Header - Custom styling for back button header
Logo - Width, padding, alignment options

User Experience

Click outside to close menu
Body scroll lock when menu is open
Responsive design
Touch-friendly
Fast performance
Clean code

Installation
Method 1: WordPress Dashboard

Download the plugin files
Create a ZIP file containing:

elementor-slideout-menu.php
uninstall.php
README.txt (optional)


Go to Plugins → Add New → Upload Plugin
Upload the ZIP file
Click Install Now
Click Activate Plugin

Method 2: FTP Upload

Download the plugin files
Upload all files to /wp-content/plugins/elementor-slideout-menu/ directory
Go to Plugins in WordPress admin
Find Elementor Slideout Menu Widget
Click Activate

Method 3: Direct File Upload

Save elementor-slideout-menu.php to /wp-content/plugins/ directory
Save uninstall.php to the same directory
Activate from Plugins page

Usage
1. Create a WordPress Menu

Go to Appearance → Menus
Create a new menu or edit existing
Add menu items with parent-child structure:

   My Account (parent)
     ├─ Profile (child)
     ├─ Settings (child)

   Help (parent)
     ├─ Contact Us (child)
     ├─ FAQ (child)

   About Us (no children - direct link)

Save menu

2. Add Widget to Elementor

Edit any page with Elementor
Search for "Slideout Menu" in widget panel
Drag and drop widget onto your page
In Menu Settings:

Select your WordPress menu from dropdown
Choose slide direction (left/right)
Toggle arrow icons



3. Customize Styling
Navigate through the Style tab sections:

Menu Button - Customize the menu trigger button
Menu Panel - Set menu width and overlay
Main Menu Items - Style top-level menu items
Submenu Items - Style child menu items
Submenu Header - Style the back button

4. Add Logo (Optional)

Go to Logo section in Content tab
Enable Show Logo
Upload your logo image
Adjust width, padding, and alignment

Menu Structure Requirements

Parent items WITH children → Display as buttons that slide to submenu
Parent items WITHOUT children → Display as direct clickable links
Child items → Always display as clickable links in submenu

Activation & Deactivation
On Activation

✅ Checks if Elementor is installed
✅ Verifies Elementor version compatibility
✅ Shows success notice
✅ Saves plugin version to database
✅ Flushes rewrite rules

On Deactivation

✅ Cleans up transients
✅ Flushes rewrite rules
✅ Preserves all settings (settings only deleted on uninstall)

On Uninstall (Delete Plugin)

✅ Removes all plugin options from database
✅ Deletes all transients
✅ Cleans up multisite installations
✅ Clears cached data
✅ Complete cleanup - leaves no trace

Compatibility
Required

WordPress 5.0+
PHP 7.0+
Elementor 3.0.0+
jQuery (included with WordPress)

Tested With

WordPress 6.4+
Elementor 3.20.0+
PHP 8.0+
All modern browsers

Works With

Any WordPress theme
Elementor Free & Pro
Multisite installations
Translation plugins (WPML, Polylang)

Browser Support

✅ Chrome (latest)
✅ Firefox (latest)
✅ Safari (latest)
✅ Edge (latest)
✅ Mobile browsers (iOS Safari, Chrome Mobile)

Troubleshooting
Widget Not Showing in Elementor?

Make sure Elementor is installed and activated
Try deactivating and reactivating the plugin
Clear Elementor cache: Elementor → Tools → Regenerate CSS

Menu Not Appearing in Dropdown?

Go to Appearance → Menus and create a menu
Make sure menu has items assigned to it
Save the menu

Styling Not Applying?

Clear browser cache
Clear WordPress cache (if using caching plugin)
Regenerate Elementor CSS

Menu Not Sliding Smoothly?

Check for JavaScript conflicts with other plugins
Test with default WordPress theme
Disable other plugins temporarily to isolate issue

FAQ
Q: Does this work with Elementor Free?
A: Yes! Works with both Elementor Free and Pro.
Q: Can I use this with any theme?
A: Yes, it's theme-independent and works with any WordPress theme.
Q: Will I lose settings if I deactivate the plugin?
A: No, settings are preserved. They're only deleted when you uninstall (delete) the plugin.
Q: Can I have multiple menus on different pages?
A: Yes, you can add the widget to any page and select different menus for each.
Q: Is it mobile responsive?
A: Yes, fully responsive and touch-friendly.
Q: Does it support RTL languages?
A: The core functionality works, but you may need to adjust slide direction to "right" for better RTL experience.
Q: Can I customize colors?
A: Yes, extensive color customization for all elements including hover states.
Changelog
Version 1.0.0 - 2025-11-26

Initial release
WordPress menu integration
Slide left/right options
Logo support
Full styling controls
Activation/deactivation hooks
Proper uninstall cleanup
Multisite support

Credits
Developed with ❤️ for the WordPress community.
Support
For support, feature requests, or bug reports:

Email: bhanujallandhra@gmail.com
Website: https://atwebforge.com

License
This plugin is licensed under GPL v2 or later.
