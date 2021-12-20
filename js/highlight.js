Prism.plugins.autoloader.languages_path = 'https://cdn.jsdelivr.net.cdn.cloudflare.net/npm/prismjs/components/'
// Add Highlight
jQuery("pre:not([class*='language'])").addClass('language-cpp').addClass('line-numbers');

jQuery("[class*='language']").addClass('line-numbers');
jQuery("pre[class*='language']").addClass('remove-code-backgroud');
jQuery("[class*='language']").removeClass('wp-block-code');
