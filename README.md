# Wordpress Plugin to use Google Programmable Search Engine on your Website
You can install the **Google Programmable Search Engine** (previously Google CSE) on your Wordpress Website by including these **plugin files** (not mandatory) and **theme files** (mandatory).

## Why do you need this?
The standard Custom Search Engine from Google will show **ads** on your search results. If you are selling products and someone searches for them on your website, ads from your competitors might appear. This of course is annoying for your business.

## What is the solution?
This tool will allow you to run Google's Custom Search API **without ads** on your search results. No ads means you can show only the stuff from your website.

## Can I trust this plugin?
If you want to use Google's Custom Search API without ads, you can just go with the theme files. You can even just take the code and do it your own way.

**If you choose not to install the plugin**, you will need to edit `wp-content/themes/your-theme-name/search-google-cse.php` and insert your own **Search Engine ID** `($searchEngineId)` and **API Key** `($searchEngineApiKey)`.

The **plugin** allows you to configure some **settings** without having to change the code manually, so it is just an easier way to make this work for non-developers.

## Important
You will need to **create a Search Engine on Google Programmable Search Engine**, and **activate an API Key on Google Cloud**. More info below.

## Warning
**This plugin is FREE** but **the Custom Search API from Google is NOT free**. It costs **5 euros per 1000 search queries**, but the first 100 queries of everyday will be free. You might need to activate a **payment method** on Google to use the API Key (Nothing I can do about it).
Info here: https://developers.google.com/custom-search/docs/paid_element

## How to install
1) Download the `wp-content` folder or get the latest release
2) Inside `wp-content/themes` you will find a folder named `your-theme-name`. Open it and upload the `wp-google-cse` folder to your Wordpress Theme Folder (via FTP or File Manager)
3) **The plugin is not mandatory**, if you want you can just edit `wp-content/themes/your-theme-name/search-google-cse.php` and insert your own Search Engine ID `($searchEngineId)` and API Key `($searchEngineApiKey)`
4) In case you decide to **install the plugin**, upload the `wp-content/plugins/wp-google-cse` to your Wordpress plugin folder (via FTP or File Manager) and activate the plugin in your Wordpress Admin Area.
5) After activating the plugin, a **new voice menu** will appear on your Admin Area: WP Google Custom Search Engine. Open it and insert your **Search Engine ID** and **API Key** in the settings.

## How to use
After you have activated and configured the plugin as explained above, you might want to create a **custom Wordpress page**:
1) Create a new page
2) Select the "Google Custom Search Engine" **template** for the new page. If it does not appear, make sure you have uploaded the file `wp-content/themes/{your-theme-name}/search-googlecse.php`. This file is used to configure the search page template
3) Go to your page, a **search form** will appear and when you search something you will see the results, if your websites is indexed by Google. You can find some info on how to index your website below.

## How it works
Basically it will use the API Key to connect to Google's Custom Search API and it will use the Custom Search Engine ID to show search results from the pages of your websites that are indexed by Google.
Note: it will only show pages that have been indexed. Do not expect to see results from your website if it is being "noindexed" or if it is still not on Google.

The **PHP class** will take care of **sending the request to Google** and get a **JSON response**. It will handle this response and output it in your search results page.

See below how to obtain the API Key and the ID.

## How do I index my website on Google?
Have a look at **Google Search Console** (https://search.google.com/search-console/) and add your website there. Make sure your website can be crawled. If it is configured with "noindex" (common mistake on Wordpress websites) it will not be indexed, so no search results will be shown.

## How to get a Search Engine ID
You need to **create a new Search Engine** on https://programmablesearchengine.google.com/. After setting up the engine, you will receive an ID for it (once called CX).

## How to get an API Key
1) Head to https://cloud.google.com/ and create an account
2) Go to the console and create a new project if needed
3) Go to API and Services > Enable APIs and Services and enable the Custom Search API
4) Go to Credentials
5) On the top, click on Create Credentials > API Key. A dialog window will appear with your API Key. Copy it and configure it on the plugin settings page or in the code (read above How to install)
6) You will see a warning triangle near your API Key on Google Cloud, because the key is not restricted. You can protect it by clicking on the API Key's name, and under API Restrictions you will choose "Restrict key" and select only Custom Search API from the dropdown. You can select other APIs if you are using others with the same key. Click on Save.

Google's Custom Search API full documentation can be found here: https://developers.google.com/custom-search/docs/tutorial/introduction

## How to customize HTML and CSS
The front-end stylesheet is in `wp-content/plugins/wp-google-cse/css/cse.css`
HTML views are in `wp-content/themes/{your-theme-name}/wp-google-cse/html/`, you can change them as you like, of course it is your responsibility to use correct HTML tags.

## Promoted results
In Google CSE you can set promoted results to show before your normal results. Basically these are results that you want to highlight and are triggered by some defined keywords.
Let's say you want to show a specific page for the shoes you are selling: you can set some keywords triggers like "shoes", "men shoes", "red shoes" and show a specific URL for those. It will appear like a normal result, but will come out on top.

By default, promoted results are shown on top. In case you want to show promoted results on bottom, just switch the order of `renderNormalResults` and `renderPromoResults`.

You can remove  or comment `renderPromoResults` if you don't plan to use them.

## Pager
The pager works up to 10 pages (the API will show a maximum of 100 results).
In some cases, you might see a different number of results for the same search terms.
This is normal because Google indexes and renders results differently each time, so don't worry about it.
At times you might click page number 8 and when the page reloads you will see there are actually only 5 pages. This still depends on the results from Google, it is not a bug of this library.
