=== Signal Flags ===
Contributors: opensums
Tags: flags, signal flags, code flag, sailing
Requires at least: 4.7
Tested up to: 5.5
Stable tag: 1.1.1
Requires PHP: 7.2
License: MIT
License URI: https://github.com/signal-flags/signal-flags-wp-plugin/blob/master/LICENSE

Display flags from the International Code of Signals (ICS), the Racing Rules of Sailing (RRS) and other nautical flags and pennants on your website.

== Description ==

= Usage =
To insert an image of the flag for Letter A in a post or page, use the shortcode `[signal-flag a]`. You can use the following flags with the corresponding codes:
* Alphabet flags A-Z (codes `a`-`z`)
* Numeral pennants 0-9 (codes `n0` - `n9`)
* Answering pennant (AP) (code `ap`)
* 1st, 2nd and 3rd substitute (codes `s1`-`s3`)
* Various flags defined in the Racing Rules of Sailing (codes `black`, `blackwhite`, `blue`, `green`, `greenwhite`, `red`, `yellow`)

There are different sets of flags selectable from the admin settings page.

= About the flag images =
Images are embedded in the page using the SVG vector format (much quicker than loading a separate image file) and eight sets of flag images are included with the following options:
* with or without outlines for ease of use on white backgrounds (including when printed)
* rectangular (4:3 aspect ratio) and square shapes for letter flags
* in 'natural' or 'primary' colours.

== Frequently Asked Questions ==

= Why don't these flags look like the ones we use at our club? =

There are many variations in the shapes and designs of flags in use around the world. This plugin provides letter flags in square and 4:3 aspect ratios, but all the pennants are 2:1 and the triangle flags 4:3. Designs are a compromise based on experience mainly of flags commonly used in dinghy and yacht racing in the United Kingdom, and those supplied for use on yachts in the UK and Europe.

= Can I change the colours? =

This plugin provides flags in two different colour schemes:
* `natural` which aim to look like real flags
* `primary` which uses primary colours.

We are looking at options for creating custom colour schemes in the plugin, and are also working on a tool to create custom flag files and upload them for use in the plugin.

= Can I change the shapes? =

This plugin provides two different shapes for letter flags:
* `rect` (rectangular) which is normally used in the United Kingdom and elsewhere and is provided here in a 4:3 aspect ratio
* `square` which are normally used in the US

We are working on a tool to create custom flag files and upload them for use in the plugin.

= Can I change the thickness or colour of the outline? =

The plugin does not support this. We are working on a tool to create custom flag files and upload them for use in the plugin.

= Can I change the designs e.g. the size of the circle on numeral pennants 1 and 2? =

Not at the moment, but we are working on a tool to create custom flag files and upload them for use in the plugin.

If you think a design is simply _wrong_ then look at the [support forum](https://wordpress.org/support/plugin/signal-flags/) to see if this has already been discussed or start a new topic.

== Development ==

Development for the Signal Flags plugin is hosted on [GitHub](https://github.com/signal-flags/signal-flags-wp-plugin).

== Screenshots ==

1. A post showing the [signal-flag] shortcode in use.
2. Signal Flags plugin settings.

== Changelog ==

= 1.1.1 _14 August 2020_ =

Tested against WordPress 5.5.

= 1.1.0 _11 July 2020_ =

This is the first release of the Signal Flags plugin.
