<?php
/**
 * Display Lang switcher WPML
 *
 * This function is output lang switcher wpml
 */
if (!function_exists('ureka_display_lang_switcher')) {
    function ureka_display_lang_switcher()
    {
        if (function_exists('icl_get_languages') && is_singular()) {
            global $post;
            $languages = icl_get_languages('skip_missing=0');

            // Filter out languages that do not have a published translation and the current active language
            $available_languages = [];
            $published_languages_count = 0;
            $current_language = '';

            if (!empty($languages)) {
                foreach ($languages as $lang) {
                    $translated_id = apply_filters('wpml_object_id', $post->ID, 'post', false, $lang['language_code']);
                    $post_status = get_post_status($translated_id);

                    // Count only published translations and filter current active language
                    if ($translated_id && $post_status === 'publish') {
                        $published_languages_count++;
                        if (!$lang['active']) {
                            $available_languages[] = $lang;
                        } else {
                            $current_language = $lang;
                        }
                    }
                }
            }

            // Only show switcher if more than one published language is available
            if ($published_languages_count > 1) {
                echo '<select class="ureka-lang-switcher" id="ureka-lang-switcher" style="opacity: 0;">';
                // Show the current language as selected but not in the options
                if (!empty($current_language)) {
                    echo '<option value="' . $current_language['url'] . '" selected>' . $current_language['code'] . '</option>';
                }
                foreach ($available_languages as $lang) {
                    $lang_code = ($lang['code'] === 'br') ? 'pt' : $lang['code'];
                    echo '<option value="' . $lang['url'] . '">' . $lang_code . '</option>';
                }
                echo '</select>';
                echo "
					<script>
				document.querySelectorAll('.ureka-lang-switcher').forEach(function(switcher) {
					switcher.addEventListener('change', function() {
						window.location.href = this.value;
					});
				});
			</script>
				";
            }
        }
    }
}
