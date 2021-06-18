# WP AJAX EndPoint

This plugin helps fetch the data in table format from [endpoint](https://miusage.com/v1/challenge/1/) with time intervals of one hour.

Have also added an option to override the one-hour limit and manually fetch the new data by clicking on a single button in the backend.

One can also override the hour limit using the WP CLI command since have also integrated WP CLI as well.

Have also created the facility to add table data in the frontend using shortcode inside any page.

For listing data, I have used **WP List Table** so that we can do further operations such as Sorting, Actions, Bulk Actions, etc.


## Installation

1. Upload the `wp-ajax-endpoint` folder to your `/wp-content/plugins/` directory
2. Activate the plugin via the Plugins menu in WordPress
3. Upon activation it will fetch the data in table format under admin menu **WP Ajax Endpoint**.
4. You can click on **Refresh Data** button to override the hour limit and fetch new data.


## Screenshots

Please do not try to match the content of table these screen was grab on different time intervals :wink:

1. Backend menu page.

  ![Screenshot](https://github.com/upeshv/wp-ajax-endpoint/blob/master/assets/images/backend-table.png?raw=true)
2. Frontend page.

  ![Screenshot](https://github.com/upeshv/wp-ajax-endpoint/blob/master/assets/images/frontend-table.png?raw=true)


## CLI command to refresh data

Using Below command you can override the one-hour limit and manually fetch the new data.
Setps to install [WPCLi](https://wp-cli.org/#installing)

```php
  wp wp-ajax-ept-reset
```


## Shortcode

Below shortcode is used to display table data in frontend.

```php
  [wpajaxept]
```


## Compatibility and security

* Have followed the defined [WordPress coding standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/)
* All the Data is been Sanitized, Escaped, and Validated.
* Also have used Vanilla JS for frontend things to avoid using jQuery
* The plugin is compatible with WordPress version 4.9 and latest and PHP versions 5.6.0 and latest.
* The plugin is translation-ready.
* The plugin is licensed as GPL v2 or later.
* It is not accessible directly by browsing the plugin's directory.


## License
[GPL-2.0+](https://www.gnu.org/licenses/gpl-2.0.html)


<br>
<br>
**Happy Coding :smiley:**