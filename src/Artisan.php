<?php

// Artisan Renderer for Timber for Shortcode Inheritance
add_action('plugins_loaded', function () {

    // Code Snippet Code

    class Artisan
    {
        /**
         * Renders a template with component processing and shortcode handling
         *
         * @param string $name Template name
         * @param array $context Context data for Timber
         * @return string Rendered template
         */
        public static function render($name, $context = [])
        {
            // Convert template name to shortcode format
            $template = do_shortcode("[$name]");

            // Process components before second shortcode pass
            $template = self::processComponents($template);

            // Process shortcodes again
            $template = do_shortcode($template);

            // Compile with Timber
            return Timber::compile_string($template, $context);
        }

        /**
         * Process component tags and convert them to shortcodes
         *
         * @param string $content Template content
         * @return string Processed content
         */
        private static function processComponents($content)
        {
            // Match component tags like <Component name="something-here" />
            $pattern = '/<Component\s+name="([^"]+)"\s*\/>/';

            // Replace with shortcode format [something-here]
            return preg_replace($pattern, '[$1]', $content);
        }
    }
    // End Code Snippet Code

}, 10);
