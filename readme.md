# Reviews Plugin

This plugin creates email templates and landing pages for encouraging user reviews.

## Dependencies
Requires IV Form and all of its dependencies.

## Installation

1. Install as a submodule:
> git submodule add https://github.com/ivinteractive/reviews.git [path]/site/plugins/reviews

2. If you do not have the (link: https://github.com/JonasDoebertin/kirby-visual-markdown/ popup: yes text: markdown) and (link: https://github.com/afbora/Kirby-Tabs-Field popup: yes text: tabs) custom fields installed, either install them or set `reviews-blueprint-plain` to true in your config file:
> c::set('reviews-blueprint-plain',true);

3. Log into the Kirby panel and create a Reviews page.

## Usage

Once the plugin and all dependencies are installed, log in to the panel and create a reviews page.

On the reviews page you can define global config values for all of your campaigns. These can all be overwritten in the individual campaign pages.

Campaigns are created as subpages in your reviews directory.

Each campaign will have several pages associated with it:
- Mailer - `[reviews-uri]/[campaign-name]/mailer`
  - Mailers use predefined templates and can be edited in the Email tab of the campaign page
- Rating Page - `[reviews-uri]/[campaign-name]`
  - Landing page values are defined in the Content tab of the campaign page
  - Note: Some mailer templates will bypass the Rating Page
- External Review Page - `[reviews-uri]/[campaign-name]/review`
  - Links to Google, Yelp, or some other third party reviews page, defined in your config
- Feedback Page - `[reviews-uri]/[campaign-name]/feedback`
  - A contact form, for users to contact you with further details

### Config Variables:
- reviews-uri (**string**)
  The top-level URI for all review routes
- reviews-dir (**string**)
  URI of the reviews top-level page
- reviews-blueprint (**string**)
  Name of the Kirby blueprint for the landing page
- reviews-config-blueprint (**string**)
  Name of the Kirby blueprint for the config/defaults page
- reviews-blueprint-plain (**boolean**)
  Setting this value to true switches to a blueprint that uses only standard Kirby fields.
  <small>The default blueprint requires the (link: https://github.com/JonasDoebertin/kirby-visual-markdown/ popup: yes text: markdown) and (link: https://github.com/afbora/Kirby-Tabs-Field popup: yes text: tabs) custom fields.</small>
- reviews-tag (**string**)
  Name of the reviews tag
- reviews-email-snippet (**string**)
  Name of the email snippet
- review-button (**string**)
  Name of the review button tag
- reviews-widget (**string**)
  Name of the reviews widget
