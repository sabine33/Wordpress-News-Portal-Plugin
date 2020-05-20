<?php


abstract class NewsMetaBox
{
    public static function add()
    {
        $screens = ['news', 'wporg_cpt'];
        foreach ($screens as $screen) {
            add_meta_box(
                'wporg_box_id',          // Unique ID
                'Post Details', // Box title
                [self::class, 'html'],   // Content callback, must be of type callable
                $screen                  // Post type
            );
        }
    }

    public static function save($post_id)
    {
        if (array_key_exists('area', $_POST) && array_key_exists('author', $_POST) && array_key_exists('description', $_POST)) {
            update_post_meta(
                $post_id,
                '_area',
                $_POST['area']
            );
            update_post_meta(
                $post_id,
                '_author',
                $_POST['author']
            );
            update_post_meta(
                $post_id,
                '_description',
                $_POST['description']
            );
        }
    }

    public static function html($post)
    {
        $area = get_post_meta($post->ID, '_area', true);
        $description = get_post_meta($post->ID, '_description', true);

        $author = get_post_meta($post->ID, '_author', true);
        if (!$author) {
            $author  = esc_html(wp_get_current_user()->user_login);
        }

?>
        <!-- <label for="wporg_field">Description for this field</label>
        <select name="wporg_field" id="wporg_field" class="postbox">
            <option value="">Select something...</option>
            <option value="something" <?php //selected($value, 'something'); 
                                        ?>>Something</option>
            <option value="else" <?php //selected($value, 'else'); 
                                    ?>>Else</option>
        </select> -->

        <div class="bootstrapiso">
            <div class="form-group">
                <label for="area">Area</label>
                <input type="text" name="area" id="area" value="<?php echo $area; ?>" class="form-control" />
            </div>
            <!-- <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" value="<?php echo $description; ?>" class="form-control" />
            </div> -->
            <?php

            wp_editor(
                $description,
                'description',
                array(
                    'media_buttons' =>  true,
                )
            );
            ?>


            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" value="<?php echo $author; ?>" readonly class="form-control" />
            </div>
        </div>


<?php
    }
}

add_action('add_meta_boxes', ['NewsMetaBox', 'add']);
add_action('save_post', ['NewsMetaBox', 'save']);
