<?php
/**
 * Plugin Name: RealPress
 * Description: An useful real estate plugin
 * Version: 1.0.0
 * Author: ThimPress
 * Author URI: https://thimpress.com/
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Text Domain: realpress
 * Domain Path: /languages
 */

namespace RealPress;

use RealPress\Controllers\CommentController;
use RealPress\Controllers\EnqueueScriptsController;
use RealPress\Controllers\PermalinkController;
use RealPress\Controllers\PropertyController;
use RealPress\Controllers\TemplateController;
use RealPress\Controllers\WishListController;
use RealPress\Controllers\ImageController;
use RealPress\Controllers\EmailController;
use RealPress\Controllers\ContactFormController;
use RealPress\Controllers\UserController;
use RealPress\Controllers\BecomeAgentController;
use RealPress\Controllers\SetupWizardController;
use RealPress\Controllers\PageController;

use RealPress\MetaBoxes\UserProfile;
use RealPress\MetaBoxes\PropertyMeta;
use RealPress\MetaBoxes\CommentMeta;
use RealPress\MetaBoxes\TermMeta;

use RealPress\Register\BlockTemplate\BlockTemplateHandle;
use RealPress\Register\Property;
use RealPress\Register\Setting;
use RealPress\Register\Widgets;

use RealPress\Shortcodes\ContactForm;
use RealPress\Shortcodes\BecomeAgentForm;
use RealPress\Shortcodes\AdvancedSearch;
use RealPress\Shortcodes\SearchWithMap;
use RealPress\Shortcodes\HeaderMap;

use RealPress\Helpers\Template;

/**
 * Class RealPress
 */
class RealPress {
	/**
	 * @var RealPress
	 */
	protected static $instance;
	/**
	 * @var array
	 */
	public static $plugin_info;

	/**
	 * Instance
	 *
	 * @return self
	 */
	public static function instance(): self {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	protected function __construct() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$plugin_info = get_plugin_data( __FILE__ );

		$this->set_constant();
		$this->include();
		$this->hooks();
	}

	/**
	 * Set constant variable
	 *
	 * @return void
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	protected function set_constant() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		//Prefix
		define( 'REALPRESS_VERSION', self::$plugin_info['Version'] );
		define( 'REALPRESS_DB_VERSION', '1.0.0' );
		define( 'REALPRESS_PREFIX', 'realpress' );
		define( 'REALPRESS_REST_VERSION', 'v1' );

		//For class, id
//		define( 'REALPRESS_PREFIX_', 'realpress_' );

		//Dirs and Urls
		define( 'REALPRESS_URL', plugin_dir_url( __FILE__ ) );
		define( 'REALPRESS_DIR', plugin_dir_path( __FILE__ ) );
		define( 'REALPRESS_CONFIG_DIR', REALPRESS_DIR . 'config/' );
		define( 'REALPRESS_IMPORT_DEMO_DIR', REALPRESS_DIR . 'import/' );
		define( 'REALPRESS_VIEWS', REALPRESS_DIR . 'views/' );
		define( 'REALPRESS_ASSETS_URL', REALPRESS_URL . 'assets/' );
		define(
			'REALPRESS_FOLDER_ROOT_NAME',
			str_replace(
				array( '/', basename( __FILE__ ) ),
				'',
				plugin_basename( __FILE__ )
			)
		);
		//Posttypes
		define( 'REALPRESS_PROPERTY_CPT', 'realpress-property' );

		//Agent role
		define( 'REALPRESS_AGENT_ROLE', 'realpress-agent' );

		//Pages
		define( 'REALPRESS_SINGLE_PROPERTY_PAGE', 'single_property_page' );
		define( 'REALPRESS_PROPERTY_ARCHIVE_PAGE', 'property_archive_page' );
		define( 'REALPRESS_AGENT_LIST_PAGE', 'agent_list_page' );
		define( 'REALPRESS_BECOME_AN_AGENT_PAGE', 'become_an_agent_page' );
		define( 'REALPRESS_AGENT_DETAIL_PAGE', 'agent_detail_page' );
		define( 'REALPRESS_WISHLIST_PAGE', 'wishlist_page' );

		define( 'REALPRESS_ADMIN_SINGLE_PROPERTY_PAGE', 'admin_single_property_page' );
		define( 'REALPRESS_ADMIN_PROPERTY_TERM_PAGE', 'admin_property_term_page' );
		define( 'REALPRESS_PROPERTY_EDIT_TAGS_PAGE', 'property_edit_tags_page' );
		define( 'REALPRESS_PROPERTY_SETTING_PAGE', 'property_setting_page' );
		define( 'REALPRESS_IMPORT_DEMO_PAGE', 'import_demo_page' );
		define( 'REALPRESS_USER_PROFILE_PAGE', 'user_profile_page' );
		define( 'REALPRESS_SETUP_PAGE', 'set_up_page' );

		//Keys
		define( 'REALPRESS_OPTION_KEY', 'realpress_option' );
		define( 'REALPRESS_PROPERTY_META_KEY', 'realpress_property_meta_key' );
		define( 'REALPRESS_PROPERTY_REVIEW_META_KEY', 'realpress_property_review_meta_key' );
		define( 'REALPRESS_TERM_META_KEY', 'realpress_term_meta_key' );
		define( 'REALPRESS_USER_META_KEY', 'realpress_user_meta_key' );
	}

	/**
	 * Include files
	 *
	 * @return void
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	protected function include() {
		require_once REALPRESS_DIR . 'vendor/autoload.php';

		if ( is_admin() ) {
			//Metabox
			new PropertyMeta();
			new TermMeta();
			new CommentMeta();

			//Register
			new Setting();
		} else {
			new WishListController();
			new ContactFormController();
		}
		new EnqueueScriptsController();
		new CommentController();
		new PropertyController();
		new PermalinkController();
		new TemplateController();
		new UserController();
		new ImageController();
		new EmailController();
		new BecomeAgentController();
		new PageController();
		new SetupWizardController();

		//Shortcode
		new ContactForm();
		new AdvancedSearch();
		new BecomeAgentForm();
		new SearchWithMap();
		new HeaderMap();

		//Register
		new Property();
		new Widgets();

		//Metabox
		new UserProfile();
		BlockTemplateHandle::instance();
	}

	/**
	 * Hooks to WP
	 *
	 * @return void
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	protected function hooks() {
		add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
		register_activation_hook( __FILE__, array( $this, 'on_activate' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	public function on_activate() {
	}

	/**
	 * Load text domain
	 *
	 * @return void
	 */
	public function load_text_domain() {
		load_plugin_textdomain( 'realpress', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}

	public function admin_notices() {
		if ( ! current_user_can( 'administrator' ) ) {
			return;
		}

		if ( ! get_option( 'realpress_setup_wizard_completed', false ) ) {
			Template::instance()->get_admin_template( 'setup/notice-setup.php' );
		}
	}
}

RealPress::instance();


