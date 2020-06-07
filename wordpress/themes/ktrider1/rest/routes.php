<?php


define( 'BOOTH2_REST_NAMESPACE', 'booth2' );

function ktrider1_register_rest_endpoints(){

    /**
     * Grabar del Booth
     * GET /wp-json/booth2/new/
     */
    register_rest_route( BOOTH2_REST_NAMESPACE , 'save', [
        'methods'               => 'POST',
        'callback'              => 'ktrider1_rest_booth2_save',
        // 'permission_callback'   => '',
    ]);

    /**
     * Upload video grabado
     * GET /wp-json/booth2/savevid/
     */
    register_rest_route( BOOTH2_REST_NAMESPACE , 'savevid', [
        'methods'               => 'POST',
        'callback'              => 'ktrider1_rest_booth2_savevid',
        // 'permission_callback'   => '',
    ]);


    /**
     * Search Infoitems
     * GET /wp-json/booth2/search_infoitems/
     */
    register_rest_route( BOOTH2_REST_NAMESPACE , 'search_infoitems', [
        'methods'               => 'GET',
        'callback'              => 'ktrider1_rest_booth2_search_infoitems',
        // 'permission_callback'   => '',
    ]);




    /**
     * Synch Infoitems add
     * POST /wp-json/tsynch/add/
     */
    register_rest_route( 'tsynch' , 'add', [
        'methods'               => 'POST',
        'callback'              => 'ktrider1_rest_tsynch_add',
        // 'permission_callback'   => '',
    ]);

    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'rest_booth2.php';
    require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'rest_tsynch.php';



}