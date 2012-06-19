Created by Kaspars Dambis [konstruktors.com](http://konstruktors.com/)

## Important:

* 	This is a MU plugin, so you should put it in `/wp-content/mu-plugins/multisite-local-dev.php`
* 	It works only with Networks where sites are in subdomains. However, it should be easy to modify this script to support sites in subdomains.


### Network Setup (Production):

*	**Network home URL (blog_id 1):** `http://example.com/`
*	**Singe site URLs (blog_id 2):** `http://example.com/extranet/`

### Network Setup (Development):

*	**Network home URL (blog_id 1):** `http://localhost/example-dev/public/`
*	**Singe site URLs (blog_id 2):** `http://localhost/example-dev/public/extranet/`

You need to put this into your dev `wp-config.php`:

	// (int) blog_id => (string) blog_path

	$dev_sites = array(
		1 => '', // Network home
		2 => 'extranet',
		3 => 'intranet'
	);

	define('WP_CONTENT_URL', 'http://localhost/site-folder/public/wp-content');

	$current_site = new stdClass;
	$current_site->id = 1;
	$current_site->site_id = 1;
	$current_site->domain = DOMAIN_CURRENT_SITE;
	$current_site->path = PATH_CURRENT_SITE;
	$current_site->cookie_domain = DOMAIN_CURRENT_SITE;

	foreach ( $dev_sites as $site_id => $folder )
		if ( strstr( $_SERVER['REQUEST_URI'], '/' . $folder . '/' ) )
			$current_site->blog_id = $site_id;

	if ( ! $current_site->blog_id )
		$current_site->blog_id = 1;

	$current_blog = $current_site;

