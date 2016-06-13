# Grav JSComments Plugin

`JSComments` is a [Grav](http://github.com/getgrav/grav) plugin which allows Grav to integrate comments into individual pages from Disqus / IntenseDebate / Facebook and Muut comments system.

Enabling the plugin is very simple. Just install the plugin folder to `/user/plugins/` in your Grav install. By default, the plugin is enabled, providing some default values.

# Installation

Installing the plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install jscomments

This will install the plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/jscomments`.

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `jscomments`. You can find these files either on [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/jscomments

> **NOTE:** This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav), the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) plugins, and a theme to be installed in order to operate.

# Usage

### Admin Plugin Setup

If you use the admin plugin you can choice the provider directly on the page edit following the tab "Options" after Taxonomies.

> **NOTE:** Remember you need to setup the provider settings before into the plugin settings page.

### Initial Setup

Place the following line of code in the theme file or page (__you need enabled Twig process in the config before using Twig functions into the page__) you wish to add jscomments for:

```
{{ jscomments() }}
```

This code works best when placed within the content block of the page, just below the main `{{ page.content }}` tag. This will place it at the bottom of the page's content.

>> NOTE: Any time you are making alterations to a theme's files, you will likely want to duplicate the theme folder in the `user/themes/` directory, rename it, and set the new name as your active theme. This will ensure that you don't lose your customizations in the event that a theme is updated.

### Options

You have the ability to set a number of variables that affect the JSComments plugin. These variables include `provider` used for identify the provider you want use. You can also more specifically refine the page ID, URL, and specifically disable comments for a specific page.

These options can exist in two places. Primarily, your user defaults will be set within the **jscomments.yaml** file in the `user/config/plugins/` directory. If you do not have a `user/config/plugins/` already, create the folder as it will enable you to change the default settings of the plugin without losing these updates in the event that the plugin is updated and/or reinstalled later on.

Here are the variables available:

```
enabled: true # Enable / Disable the plugin

provider: "disqus" # (disqus | intensedebate | facebook | muut)

providers:
  disqus:
    shortname: ""
    default_lang: en

  intensedebate:
    acct: ""

  facebook:
    appId: ""
    lang: "en_US"
    num_posts: 5
    colorscheme: "light"
    order_by: social
    width: "100%"

  muut:
    forum: ""
    channel: "General"
    show_online: false
    show_title: false
    upload: false
    share: true
    widget: false
    lang: "en"
```

If you want to change any of these settings for a specific page you can do so via the page's header. Below is an example of how these settings can be used.

```
jscomments:
  provider: disqus
  providers:
    disqus:
      shortname: "disqus_shortname_example"
      default_lang: it
      title: "Different title page"
      id: "page-slug-example"
```

If you wish to set default options that remain static across all pages with comments enabled, you can do so in `/user/config/plugins/jscomments.yaml`. Here is an example:

```
provider: disqus
providers:
  disqus:
    shortname: "disqus_shortname_example"
```

If you want enable the comments in one page you can setup the page headers with this example (_after v1.2.5 jscomments are disabled by default for global, so you need to setup in everyone page header or via template function_):

```
jscomments:
  provider: provider_name
```

Or via twig function:

```
{{ jscomments('provider_name', { param: value }) }}
```

Example for disqus with minimum params:

```
{{ jscomments('disqus', { shortname: example }) }}
```

For most users, only the **provider** option will need to be set (_after v1.2.5 you can't use because the plugin read the global plugin settings_). This will pull the comments settings from your account and pull information (such as the page title) from the page.

>> NOTE: Any time you are making alterations to a theme's files, you will want to duplicate the theme folder in the `user/themes/` directory, rename it, and set the new name as your active theme. This will ensure that you don't lose your customizations in the event that a theme is updated. Once you have tested the change thoroughly, you can delete or back up that folder elsewhere.

# Updating

As development for this plugin continues, new versions may become available that add additional features and functionality, improve compatibility with newer Grav releases, and generally provide a better user experience. Updating this plugin is easy, and can be done through Grav's GPM system, as well as manually.

## GPM Update (Preferred)

The simplest way to update this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm). You can do this with this by navigating to the root directory of your Grav install using your system's Terminal (also called command line) and typing the following:

    bin/gpm update jscomments

This command will check your Grav install to see if your plugin is due for an update. If a newer release is found, you will be asked whether or not you wish to update. To continue, type `y` and hit enter. The plugin will automatically update and clear Grav's cache.

## Manual Update

Manually updating this plugin is pretty simple. Here is what you will need to do to get this done:

* Delete the `your/site/user/plugins/jscomments` directory.
* Download the new version of the plugin from either [GetGrav.org](http://getgrav.org/downloads/plugins#extras).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `jscomments`.
* Clear the Grav cache. The simplest way to do this is by going to the root Grav directory in terminal and typing `bin/grav clear-cache`.

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
