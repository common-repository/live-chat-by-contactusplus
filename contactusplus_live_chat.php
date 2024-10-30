<?php
/*
Plugin Name: Live Chat by UserPulse
Plugin URI: http://www.userpulse.com/
Description: Live Chat Software by UserPulse
Author: Adi Ben-Ari
Version: 2.3
Author URI: http://www.userpulse.com/
*/
function getContactUsPlus()
{
  echo "";
  $formid=get_option('contactusplus_data');
  $username=get_option('contactusplus_data_email');
  $lastname=get_option('contactusplus_data_name');
  $website=get_option('contactusplus_data_website');
  echo "<!--  UserPulse Live Chat Toolbar WordPress Plugin 2.3 formid=".get_option('contactusplus_data')." username=".get_option('contactusplus_data_email')." --><script type='text/javascript'>
document.write(unescape('%3Cscript src=\"' + ((document.location.protocol=='https:')?'https://userpulse.com':'http://userpulse.com') + '/toolbar.js?source=2&startForm=".$formid."&username=".$username."&LastName=".$lastname."&website=".$website."\" type=\"text/javascript\"%3E%3C/script%3E'));</script><noscript><a href='http://www.userpulse.com/'>Live Chat Software, Contact Form and Website Toolbar</a></noscript>";
}
function widget_ContactUsPlus($args) {
  extract($args);
  echo $before_widget;
  echo $before_title;
  echo $after_title;
  getContactUsPlus();
  echo $after_widget;
}
/* add widget
/*function ContactUsPlus_init()
{
  register_sidebar_widget(__('ContactUsPlus Widget'), 'widget_ContactUsPlus');
}
add_action("plugins_loaded", "ContactUsPlus_init");*/
function addContactUsPlus()
{
	getContactUsPlus();
}
add_action('wp_footer', 'addContactUsPlus');
?><?php
/* Runs when plugin is activated */
register_activation_hook(__FILE__,'contactusplus_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'contactusplus_remove' );

function contactusplus_install() {
/* get email and website values from blog settings
/* Creates new database field */
add_option("contactusplus_data_email", get_bloginfo('admin_email'), '', 'yes');
add_option("contactusplus_data_name", '', '', 'yes');
add_option("contactusplus_data_website", substr(get_bloginfo('home'),7), '', 'yes');
}

function contactusplus_remove() {
/* Deletes the database field */
delete_option('contactusplus_data_email');
delete_option('contactusplus_data_name');
delete_option('contactusplus_data_website');

}
?><?php
if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'contactusplus_admin_menu');

function contactusplus_admin_menu() {
add_options_page('UserPulse', 'UserPulse', 'administrator',
'contactusplus', 'contactusplus_html_page');
}
}
?><?php
function contactusplus_html_page() {
?><div>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="contactusplus_data_email,contactusplus_data_name,contactusplus_data_website" />

<table width="510" cellpadding=10 cellspacing=10>
<tr><td colspan='3'><a href='http://www.userpulse.com/wordpress-contact-form.jsp'><img src='http://www.userpulse.com/template_index_files/assets/userpulse-logo.jpg' height='125' width='187'/></a></td></tr>
<tr valign="top">
<th width="92" scope="row" NOWRAP align="left">Your Email*</th>
<td width="406">
<input name="contactusplus_data_email" type="text" id="contactusplus_data_email"
value="<?php echo get_option('contactusplus_data_email'); ?>" />
</td>
</tr>

<tr valign="top">
<th width="92" scope="row" NOWRAP align="left">Your Name</th>
<td width="406">
<input name="contactusplus_data_name" type="text" id="contactusplus_data_name"
value="<?php echo get_option('contactusplus_data_name'); ?>" />
</td>
<td width='100%' style='font-size: 8pt;'></td>
</tr>

<tr valign="top">
<th width="92" scope="row" NOWRAP align="left">Your Website</th>
<td width="406" NOWRAP>http://www.
<input name="contactusplus_data_website" type="text" id="contactusplus_data_website"
value="<?php echo get_option('contactusplus_data_website'); ?>" />
</td>
</tr>

<tr><td></td><td colspan='2'><input type="submit" value="<?php _e('Save Changes') ?>" /></td></tr>

<tr valign="top">
<th width="92" scope="row" NOWRAP></th>
<td width='100%' style='font-size: 8pt;'>Provide an email address to receive live chat requests and completed contact forms.<br/>We will NOT pass on your email address, or send spam. <br/>See <a href='http://www.userpulse.com/content/privacy.jsp'>Privacy Policy</a> and <a href='http://www.userpulse.com/content/terms.jsp'>Terms of Use</a>.<br/>
</tr>

<tr valign="top">
<th width="92" scope="row" NOWRAP></th>
<td width='100%' style='font-size: 8pt;'>If you've signed up at <a href='http://www.userpulse.com/wordpress-contact-form.jsp'>userpulse.com</a> enter same username/email.</td><br/>
</tr>

<tr><td></td><td style='font-size: 8pt;' colspan='2'>After saving, the Live Chat toolbar will be added to your site.<br/>We'll also create an account for your at <a href='http://www.userpulse.com/wordpress-contact-form.jsp'>userpulse.com</a>, so that you can manage your settings - you'll receive an email with all the details.</td></tr>
</table>

</form>
</div><?php
}
?>
