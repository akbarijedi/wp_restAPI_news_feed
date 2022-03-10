<?php
// Latest Posts with Restful API = LPRA
/*
 * this file define ajax request.
 * first get the user request and after that check the rewrite route link.
 * finally based on user request, calculate and send appropriate response to the user.
 * */

/*
 * add some route
 * */
function lpra_add_api_posts_endpoint()
{
    /*
     * if user want to get the latest N posts
     * */
    add_rewrite_tag('%latestposts%', '([0-9]+)');
    add_rewrite_rule('api/latestposts/([0-9]+)/?', 'index.php?latestposts=$matches[1]', 'top');

    /*
     * if the user wants to get specific post content with POST_ID
     * */
    add_rewrite_tag('%post_id%', '([0-9]+)');
    add_rewrite_rule('api/getpost/([0-9]+)/?', 'index.php?post_id=$matches[1]', 'top');

    /*
     * if the user want to get custom category called "mobile_app_more"
     * */
    add_rewrite_tag('%moretab%', '([0-9]+)');
    add_rewrite_rule('api/moretab/([0-9]+)/?', 'index.php?moretab=$matches[1]', 'top');

}
add_action('init', 'lpra_add_api_posts_endpoint');

/*
 * Get Posts and send it to the user
 * */
function lpra_get_posts_feed_restapi()
{
    global $wp_query;

    $allcontent = $wp_query->get('latestposts');
    $post_content = $wp_query->get('post_id');
    $metatab = $wp_query->get('moretab');

    /* If user want to get the N latest posts */
    if (!empty($allcontent))
    {
        $args = array(
            'show_option_all'    => '',
            'show_option_none'   => '',
            'orderby'            => 'ID',
            'order'              => 'ASC',
            'show_count'         => 0,
            'hide_empty'         => 1,
            'child_of'           => 0,
            'exclude'            => '',
            'echo'               => 1,
            'selected'           => 0,
            'hierarchical'       => 0,
            'name'               => 'mobile_app_more',
            'id'                 => '',
            'class'              => 'postform',
            'depth'              => 0,
            'tab_index'          => 0,
            'taxonomy'           => 'category',
            'hide_if_empty'      => false
        );
        $categories = get_categories($args);
        $exclude=[];
        $my_META_posts = get_posts( array(
            'category'       => $categories[0]->term_id,
            'orderby'          => 'date',
            'order'            => 'DESC',
        ) );
        foreach ($my_META_posts as $metaKey=>$metaValue){
            array_push($exclude,$metaValue->ID);
        }

        $response1 = wp_get_recent_posts(array(
            'numberposts' => ($allcontent!=1) ? $allcontent : '30', // Number of recent posts thumbnails to display
            'post_status' => 'publish', // Show only the published posts
            'post_type' => 'post',
            'exclude' => $exclude,
        ));

        $i=0;
        foreach($response1 as $key => $value )
        {
            $categories=null;
            if($value['post_type']=="post")
                $response1[$key]['pic_url'] = wp_get_attachment_url(get_post_thumbnail_id($value['ID']));

                $categories = get_the_category($value['ID']);//$post->ID
                $cat_names = [];
                foreach ($categories as $category) {
                    array_push($cat_names, $category->name);
                }
                $response1[$key]['category_name'] = $cat_names;
        }
        wp_send_json_success([$response1]);
    }
    /* If the user wants to get one post with ID */
    elseif(!empty($post_content))
    {
        $news_pic = wp_get_attachment_url( get_post_thumbnail_id($post_content));

        $post_content = get_post($post_content, ARRAY_A);
        $post_content['pic_url'] = $news_pic;
        $categories = get_the_category($post_content);//$post->ID
        $cat_names = [];
        foreach($categories as $category){
            array_push($cat_names,$category->name);
        }
        $post_content['category_name'] = $cat_names;
        wp_send_json_success ([$post_content]);
    }
    /* If the user wants to get custom category called "mobile_app_more" */
    elseif(!empty($metatab))
    {
        $args = array(
            'show_option_all'    => '',
            'show_option_none'   => '',
            'orderby'            => 'ID',
            'order'              => 'ASC',
            'show_count'         => 0,
            'hide_empty'         => 1,
            'child_of'           => 0,
            'exclude'            => '',
            'echo'               => 1,
            'selected'           => 0,
            'hierarchical'       => 0,
            'name'               => 'mobile_app_more',
            'id'                 => '',
            'class'              => 'postform',
            'depth'              => 0,
            'tab_index'          => 0,
            'taxonomy'           => 'category',
            'hide_if_empty'      => false
        );
        $categories = get_categories($args);
        $myposts = get_posts( array(
            'category'       => $categories[0]->term_id,
            'orderby'          => 'date',
            'order'            => 'DESC',
        ) );
       wp_send_json_success($myposts);
    }
}

add_action('template_redirect', 'lpra_get_posts_feed_restapi');


