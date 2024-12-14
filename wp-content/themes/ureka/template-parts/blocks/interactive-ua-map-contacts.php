<?php
/**
 * Block Name: Contacts and interactive Ukraine map
 * Description: A block featuring contact information combined with an interactive map of Ukraine, enabling users to explore regional details.
 * Icon: location-alt
 * Keywords: contacts, interactive map, Ukraine, regions, location
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
$select_contact_regions = get_field('select_contact_regions');
$title = get_field('int_map_title');
?>
<?php if ($select_contact_regions): ?>
    <div class="ua-map">
        <div class="container">
            <?php if ($title): ?>
                <div class="row text-center">
                    <h3 class="heading-decorated"><?= $title; ?></h3>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ua-map__contacts">
                        <section class="accordion-block section-md bg-default">
                            <div class="container">
                                <div id="accordion" role="tablist">
                                    <?php foreach ($select_contact_regions as $index => $id):
                                        $region_id = get_field('ua_region', $id);
                                        $contact_info = get_fields($id);
                                        ?>
                                        <div class="card card-custom">
                                            <div class="card-custom-heading" id="accordionHeading<?= $index; ?>"
                                                 role="tab">
                                                <h5 class="card-custom-title">
                                                    <a class="collapsed"
                                                       data-contact-id="<?= $region_id; ?>"
                                                       role="button"
                                                       data-bs-toggle="collapse"
                                                       data-bs-parent="#accordion"
                                                       href="#accordionCollapse<?= $index; ?>"
                                                       aria-controls="accordionCollapse<?= $index; ?>"><?= get_the_title($id); ?>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div class="card-custom-collapse collapse"
                                                 id="accordionCollapse<?= $index; ?>"
                                                 data-bs-parent="#accordion" role="tabpanel"
                                                 aria-labelledby="accordionHeading<?= $index; ?>">
                                                <div class="card-custom-body">
                                                    <?= ($contact_info['ua_company_name']) ? '<div class="contact-item"><i class="fas fa-building"></i> ' . esc_html($contact_info['ua_company_name']) . '</div>' : ''; ?>
                                                    <?= ($contact_info['ua_contact_person']) ? '<div class="contact-item"><i class="fas fa-user"></i> ' . esc_html($contact_info['ua_contact_person']) . '</div>' : ''; ?>
                                                    <?php if (!empty($contact_info['ua_phone_numbers'])): ?>
                                                        <div class="contact-item">
                                                            <i class="fas fa-phone"></i>
                                                            <ul class="contact-phone-list">
                                                                <?php foreach ($contact_info['ua_phone_numbers'] as $phone): ?>
                                                                    <li>
                                                                        <?= esc_html($phone['phone']); ?>
                                                                        <?= ($phone['show_in_popup']) ? '<span class="popup-indicator">(popup)</span>' : ''; ?>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?= ($contact_info['ua_email']) ? '<div class="contact-item"><i class="fas fa-envelope"></i> <a href="mailto:' . esc_attr($contact_info['ua_email']) . '">' . esc_html($contact_info['ua_email']) . '</a></div>' : ''; ?>
                                                    <?= ($contact_info['ua_website']) ? '<div class="contact-item"><i class="fas fa-globe"></i> <a href="' . esc_url($contact_info['ua_website']) . '" target="_blank">' . esc_html($contact_info['ua_website']) . '</a></div>' : ''; ?>
                                                    <?= ($contact_info['ua_address']) ? '<div class="contact-item"><i class="fas fa-map-marker-alt"></i> ' . esc_html($contact_info['ua_address']) . '</div>' : ''; ?>
                                                    <?= ($contact_info['ua_text_information']) ? '<div class="contact-item"><i class="fas fa-info-circle"></i> ' . wp_kses_post($contact_info['ua_text_information']) . '</div>' : ''; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ua-map__map">
                        <?= get_svg_image('ua-map.svg'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
