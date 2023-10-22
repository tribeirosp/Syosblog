<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * A class to create a dropdown for all google fonts
 */
class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
{
    private $fonts = false;
    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->fonts = $this->get_fonts();
        parent::__construct($manager, $id, $args);
    }
    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
    {
        if (!empty($this->fonts)) {?>
			<label>
			   <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			   <select <?php $this->link();?>>
			   		<option value="" ><?php echo esc_html__('Default', 'munfarid'); ?></option>
				    <?php
foreach ($this->fonts as $key => $value) {
            printf('<option value="%s" %s>%s</option>', $value->family, selected($this->value(), $value->family, false), $value->family);
        }
            ?>
			   </select>
			</label>
		<?php }
    }
    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     *
     * @return String
     */
    public function get_fonts($amount = 'all')
    {
        $selectDirectory = get_stylesheet_directory() . '/theme-includes/customizer/customizer-controls/';
        $selectDirectoryInc = get_stylesheet_directory() . '/theme-includes/customizer/customizer-controls/';
        $finalselectDirectory = '';
        if (is_dir($selectDirectory)) {
            $finalselectDirectory = $selectDirectory;
        }
        if (is_dir($selectDirectoryInc)) {
            $finalselectDirectory = $selectDirectoryInc;
		}
		
		global $wp_filesystem;
		require_once ( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();

        $fontFile = $finalselectDirectory . '/cache/google-web-fonts.txt';
        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;
        if (file_exists($fontFile) && $cachetime < filemtime($fontFile)) {
            $content = json_decode($wp_filesystem->get_contents( $fontFile ));
        } else {
			$key = 'AIzaSyCOwUa4jwj2JuOYWIx36y6Ej0sMvmd5AMg';
            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key='.$key;
            $fontContent = wp_remote_get($googleApi, array('sslverify' => true));

            $wp_filesystem->put_contents(
                $fontFile,
                $fontContent['body'],
                FS_CHMOD_FILE// predefined mode settings for WP files
            );
            $content = json_decode($fontContent['body']);
        }
        if ($amount == 'all') {
            return $content->items;
        } else {
            return array_slice($content->items, 0, $amount);
        }
    }
}
