<?php

class bigfa_widget extends WP_Widget {
    function bigfa_widget() {
        $widget_ops = array('description' => '点赞人数最多的文章，需安装对应插件。');
        $this->WP_Widget('populr_entries', '最赞文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul class="list list-withImage">
            <?php echo lion_post_list( 'popular' , $limit ); ?>
        </ul>
        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'bigfa_widget_init');
function bigfa_widget_init() {
    register_widget('bigfa_widget');
}

class bigfa_widget2 extends WP_Widget {
    function bigfa_widget2() {
        $widget_ops = array('description' => '列出最近编辑的文章');
        $this->WP_Widget('recent_entries', '最近编辑', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul class="list list-withImage">
            <?php echo lion_post_list( 'latest' , $limit ); ?>
        </ul>
        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'bigfa_widget2_init');
function bigfa_widget2_init() {
    register_widget('bigfa_widget2');
}

class bigfa_widget3 extends WP_Widget {
    function bigfa_widget3() {
        $widget_ops = array('description' => '列出站点最近的评论');
        $this->WP_Widget('rencent_comments', '最新评论', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        $email = strip_tags($instance['email']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul class="comment-items">
            <?php
            $comments = get_comments(array(
                'number'=>5,
                'type' => 'comment',
            ));
            global $comment;
            foreach ($comments as $key => $comment) {
                $output .= '<li class="comment-item"><a href="' . get_comment_link() . '">' . get_avatar($comment->comment_author_email,36) . '<div class="comment-item-author">'  . $comment->comment_author . '</div><div class="comment-item-content">' . $comment->comment_content . '</div></a></li>';
            }
            echo $output;
            ?>
        </ul>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['email'] = strip_tags($new_instance['email']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => '', 'email' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        $email = strip_tags($instance['email']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：(最好5个以下) <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'bigfa_widget3_init');
function bigfa_widget3_init() {
    register_widget('bigfa_widget3');
}



class bigfa_widget6 extends WP_Widget {
    function bigfa_widget6() {
        $widget_ops = array('description' => '配合主题样式，字体大小统一');
        $this->WP_Widget('popular_tags', '标签云', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <div class="post-tags">
            <?php
            wp_tag_cloud( array(
                    'unit' => 'px',
                    'smallest' => 12,
                    'largest' => 12,
                    'number' => $limit,
                    'format' => 'flat',
                    'orderby' => 'count',
                    'order' => 'DESC'
                )
            );
            ?>
        </div>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'bigfa_widget6_init');
function bigfa_widget6_init() {
    register_widget('bigfa_widget6');
}


class bigfa_widget16 extends WP_Widget {
    function bigfa_widget16() {
        $widget_ops = array('description' => '列出最近的文章');
        $this->WP_Widget('recent_articles', '最新文章', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        echo $before_widget.$before_title.$title.$after_title;
        ?>
        <ul class="list list-withImage">
            <?php echo lion_post_list( 'latest' , $limit ); ?>
        </ul>

        <?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'bigfa_widget16_init');
function bigfa_widget16_init() {
    register_widget('bigfa_widget16');
}