<?php

class KHABAR_SHOW extends WP_REST_Controller
{
    public function register_routes(){
         register_rest_route('post/', 'show/(?P<post_id>\d+)', [
             'methods' => WP_REST_Server::READABLE,
             'callback' => [$this, 'get_post_data_rest']
         ]);

         register_rest_route('allpost/', 'show/', [
             'methods' => WP_REST_Server::READABLE,
             'callback' => [$this, 'get_all_post_data_rest']
         ]);
     }
    public function get_post_data_rest($request){
         $newsID = $request['post_id'];
         $post = get_post($newsID,ARRAY_A);
        $response = new WP_REST_Response([$post]);

        $response->set_status( 200 );

        return $response;
    }
    public function get_all_post_data_rest($request){
         //$newsID = $request['post_id'];
         //$post = get_post($newsID,ARRAY_A);
    $response1 = wp_get_recent_posts(array(
        'numberposts' => 30, // Number of recent posts thumbnails to display
        'post_status' => 'publish', // Show only the published posts
        'post_type' => 'post'
    ));
    $response2=[];
    $i=0;
    foreach($response1 as $key => $value ){
        if($value['post_type']=="post")
            array_push($response2,wp_get_attachment_url( get_post_thumbnail_id($value['ID']) ));
    }

        $response = new WP_REST_Response([$response1,$response2]);

        $response->set_status( 200 );

        return $response;
    }
}
add_action('rest_api_init', function () {
    if (class_exists('KHABAR_SHOW'))
    {
        $controller = new KHABAR_SHOW();
        $controller->register_routes();
    }
});