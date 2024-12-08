<?php
/**
 * Block Name: Our Team
 * Description: Showcase your team members with photos, names, and roles.
 * Icon: groups
 * Keywords: team, staff, members, people, group
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>
<?php
$team_title = get_field('our_team_title');
$team_members = get_field('team');
?>

<?php if ($team_members): ?>
    <section class="our-team section-md bg-default text-center">
        <div class="container">
            <?php if ($team_title): ?>
                <h4 class="heading-decorated"><?= $team_title; ?></h4>
            <?php endif; ?>
            <div class="row row-70 offset-top-1">
                <div class="our-team__wrapper">
                    <?php foreach ($team_members as $member): ?>
                        <?php
                        $photo_id = $member['our_team_photo'];
                        $name = $member['our_team_name'];
                        $position = $member['our_team_position'];
                        $about = $member['about_team_member'];
                        ?>
                        <div class="our-team__wrapper-item col-md-12">
                            <article class="thumb-flat">
                                <?php if ($photo_id): ?>
                                    <?= get_image_html($photo_id, 'large', 'thumb-flat__image', $name); ?>
                                <?php endif; ?>
                                <div class="thumb-flat__body">
                                    <?php if ($name): ?>
                                        <p class="heading-6"><?= $name; ?></p>
                                    <?php endif; ?>
                                    <?php if ($position): ?>
                                        <p class="thumb-flat__subtitle"><?= $position; ?></p>
                                    <?php endif; ?>
                                    <?php if ($about): ?>
                                        <p><?= $about; ?></p>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

