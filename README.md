# WordpressApi

This Magento 2 module is a connector for displaying WordPress content in Magento2. By using the REST API, Magento retrieves data from wordpress regarding pages and posts for display either as a blog, block or widget.

Safely install your WordPress in a completely separate location from your Magento install, provide credentials for connection and you can freely display WP data anywhere in your site.

**Existing Features**
- Generic helper for sending API requests
- Custom Router for setting a blog route in store configuration
- Widgets & Blocks for displaying pages and posts

### Installation

To install, add the following to the "repositories" block in your composer json;

    "wpblog": {
        "type": "vcs",
        "url": "https://github.com/karlsminton/WordpressApi.git"
    }

Following that add `"karl/wordpress-api": "1.0"` to the "require" block.

Run `composer update` followed by `php bin/magento setup:upgrade` and installation should be complete.
