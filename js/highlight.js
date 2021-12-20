Prism.plugins.autoloader.languages_path = 'get_template_directory_uri() . '/libs/prism/plugins/components/'
// Add Highlight
jQuery("pre:not([class*='language'])").addClass('language-cpp').addClass('line-numbers');

jQuery("[class*='language']").addClass('line-numbers');
jQuery("pre[class*='language']").addClass('remove-code-backgroud');
jQuery("[class*='language']").removeClass('wp-block-code');
