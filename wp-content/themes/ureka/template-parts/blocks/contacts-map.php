<?php
/**
 * Block Name: Contacts / Map
 * Description: A block to display contact information and a map for location details.
 * Icon: location-alt
 * Keywords: contacts, map, location, address
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>
<?php
$title = get_field('contacts_map_title');
$contacts = get_field('contacts');
$social_media = get_field('contacts_map_social_media');
$google_map = get_field('contacts_google_map');

$icon_classes = [
    'linkedin' => 'fa fa-linkedin-square',
    'facebook' => 'fa fa-facebook',
    'instagram' => 'fa fa-instagram',
    'youtube' => 'fa fa-youtube',
];
$sm_title = get_field('contacts_map_sm_title');
if ($contacts || $google_map): ?>
    <section class="contacts-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?= $title ? '<h2 class="contacts-block__title">' . esc_html($title) . '</h2>' : ''; ?>
                    <?= $contacts ? '<div class="contacts-block__contacts">' . $contacts . '</div>' : ''; ?>
                    <?php if ($social_media): ?>
                        <div class="contacts-block__social-media">
                            <ul>
                            <?php foreach ($social_media as $item): ?>
                                <?php
                                $icon_class = $item['pick_icon']['value'] ?? '';
                                $social_name = $item['pick_icon']['label'] ?? '';
                                $social_link = $item['link'] ?? '';
                                ?>
                                <?= ($social_link && $icon_class) ? '<li><a href="' . esc_url($social_link) . '" target="_blank" class="social-icon"><i class="' . esc_attr($icon_classes[$icon_class]) . '"></i><span>'.$social_name.'</span></a></li>' : ''; ?>
                            <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <?php if ($google_map): ?>
                        <div class="contacts-block__map">
                            <?= $google_map; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
