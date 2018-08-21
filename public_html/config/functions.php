<?php


namespace
{

    use Eva\Core\Configure\Config;
    use Eva\Core\Utility\Request;
    use Eva\Rest\HttpClientRest;


    function get_404()
    {
        status_header( 404 );
        nocache_headers();
        include( get_query_template( '404' ) );
        die();
    }

    function delete_term_api($term_id)
    {
        //$term = get_term_by('id', $term_id, 'post_tag');
        //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/delete_term_api.json',json_encode($term));
    }

    /** Funcao utilitaria para carrega o head definido no template */
    function get_head($name = null)
    {
        do_action( 'get_head', $name );

        $templates = array();
        $name = (string) $name;
        if ( '' !== $name ) {
            $templates[] = "head-{$name}.php";
        }

        $templates[] = 'head.php';

        locate_template( $templates, true );
    }

    function alterar_admin_bar($admin_bar)
    {

        $admin_bar->add_menu(array(
                'id' => 'environment',
                'parent' => 'top-secondary',
                'title' => "<span style=\"background: red;padding: 3px 8px 3px 8px;font-weight: bold;\">AMBIENTE " . ENVIRONMENT . "</span>"
            )
        );

        return $admin_bar;
    }

    function category_edit_term_api($term)
    {
        $envio = (!is_null($term->api_last_update)) ? date('d/m/Y H:i:s',strtotime($term->api_last_update)) : "";
        echo "<div style=\"background: #fff;padding: 5px;\"><label><b>ID:</b> {$term->_id}</label><br /><label><b>Envio:</b> {$envio}</label></div>";
    }

    /**Edit tags form*/
    function edit_tags_api($term_id)
    {
        $taxonomy = 'post_tag';
        save_term_api($term_id, $taxonomy);
    }

    /** Edicao da tag no form*/
    function edit_tag_form($term)
    {
        if($term)
        {
            saveorupdate_term_api($term, '/tags');
        }
    }

    /** Edicao n o grid de tags (Edicao rapida)*/
    function edit_term_taxonomy_api($term_id)
    {
        if(!isset($_REQUEST['post_ID']))
        {
            //No edit post
            if($term_id > 0)
            {
                $term = get_term_by('id', $term_id, 'post_tag');
                if($term)
                {
                    $term->slug = $_REQUEST['slug'];
                    $term->name = $_REQUEST['name'];
                    saveorupdate_term_api($term, '/tags');
                }
            }
        }

    }

    /** Obtem os paths request */
    function get_path_request()
    {
        $pathSegment = explode('/', getenv('REQUEST_URI'));
        $path = array_values(array_filter($pathSegment));
        return $path;
    }

    function save_term_api($term_id, $taxonomy)
    {
        if($taxonomy == 'post_tag')
        {
            $term = get_term_by('id', $term_id, 'post_tag');
            $service = '/sumauma/tags';
        } elseif ($taxonomy == 'category')
        {
            $term = get_category($term_id);
            $service = '/sumauma/categories';
        } else
        {
            wp_die("[Mode save] ... Taxonomia não parametrizada. Operação não efetivada.");
            exit;
        }

        saveorupdate_term_api($term, $service);
    }
    
    /**Save tag do form*/
    function save_term($term_id, $tt_id, $taxonomy)
    {
        save_term_api($term_id, $taxonomy);
    }

    /**Edit tag do form*/
    function edited_term_api($term_id, $taxonomy)
    {
        save_term_api($term_id, $taxonomy);
    }

    /**Metodo responsavel pelo save or update na api*/
    function saveorupdate_term_api($term, $service)
    {
        //Site
        $term->site = new stdClass();
        $term->site->blog_id = WP_SITE_ID;
        $term->site->last_updated = date('Y-m-d H:i:s');
        $term->site->blogname = WP_SITE_BLOGNAME;
        $term->site->siteurl = WP_SITE_URL;
        $term->site->protocol = WP_SITE_PROTOCOL;

        $rest = (new HttpClientRest(new Config('api.hyperion.' . ENVIRONMENT)))
            ->post()
            ->service($service)
            ->setBody(json_encode($term))
            ->execute();

        global $wpdb;
        if($rest->statusCode == 201)
        {
            //post add api
            $response = json_decode($rest->response);
            $data = ['_id' => $response->id,'api_last_update' => date('Y-m-d H:i:s')];
            $wpdb->update( 'wp_terms', $data, ['term_id' => $term->term_id], $format = null, $where_format = null );
        } else if($rest->statusCode == 200)
        {
            $data = ['api_last_update' => date('Y-m-d H:i:s')];
            $wpdb->update( 'wp_terms', $data, ['term_id' => $term->term_id], $format = null, $where_format = null );
        } else
        {
            //Error 500
            wp_die('Houve um error na comunicação com API');
        }
    }

    function save_post_api($id, $post)
    {

        if($post->post_type == 'post' && in_array($post->post_status,['publish','future','pending','private','trash']))
        {
            $home_url = home_url();
            $post->post_content = apply_filters('the_content', $post->post_content);

            //Save os metaboxes
            save_post_all_metaboxes($post->ID);

            //Get categorias
            $post_categories = wp_get_post_categories($post->ID);
            $categories = array();
            foreach($post_categories as $term_id)
            {
                $categories [] = get_category($term_id);
            }
            $post->categories = $categories;
            $post->post_date_gmt = ($post->post_date_gmt == "0000-00-00 00:00:00") ? null : $post->post_date_gmt;
            $post->post_modified_gmt = ($post->post_modified_gmt == "0000-00-00 00:00:00") ? null : $post->post_date_gmt;
            $post->post_permalink = str_replace($home_url, "", get_permalink($post->ID));
            $post->guid = str_replace($home_url, "", $post->guid);

            //Get metatadados
            $metadados = get_post_custom($post->ID);
            $post->post_buscaletra = (isset($metadados['busca_letra'])) ? $metadados['busca_letra'][0] : null;

            //Get Imagem destacada
            $custom = get_post_custom($post->ID);
            //$post->post_thumbnail = str_replace($home_url, "", wp_get_attachment_url($custom['_thumbnail_id'][0]));
            $post_thumbnail = wp_get_attachment_url($custom['_thumbnail_id'][0]);
            $post->post_thumbnail = ($post_thumbnail) ? $post_thumbnail : "";

            //Site
            $post->site = new stdClass();
            $post->site->blog_id = WP_SITE_ID;
            $post->site->last_updated = date('Y-m-d H:i:s');
            $post->site->blogname = WP_SITE_BLOGNAME;
            $post->site->siteurl = WP_SITE_URL;
            $post->site->protocol = WP_SITE_PROTOCOL;

            //Tags
            $post->post_tags = wp_get_post_tags($post->ID);

            $rest = (new HttpClientRest(new Config('api.hyperion.' . ENVIRONMENT)))
                ->post()
                ->service('/sumauma/posts')
                ->setBody(json_encode($post))
                ->execute();

            global $wpdb;
            if($rest->statusCode == 201)
            {
                //post add api
                $response = json_decode($rest->response);
                $data = [
                    '_id' => $response->id,
                    'api_last_update' => date('Y-m-d H:i:s')
                ];
                $wpdb->update( 'wp_posts', $data, ['ID' => $post->ID], $format = null, $where_format = null );
                //file_put_contents(ABSPATH . "/post_{$post->ID}.json",json_encode($wpdb));
            } else if($rest->statusCode == 200) {
                //post update api
                $data = ['api_last_update' => date('Y-m-d H:i:s')];
                $wpdb->update( 'wp_posts', $data, ['ID' => $post->ID], $format = null, $where_format = null );
            } else {
                //Error 500
                wp_die('Houve um error na comunicação com API ...');
            }
        }

    }

    /*function get_post_single_api($post_name = '')
    {
        $post_name = (empty($post_name)) ? Request::getRequestUri(false) : $post_name;
        $service = '/sumauma/posts/single/'.WP_SITE_ID.'/'.$post_name;
        $rest = (new HttpClientRest(new Config('api.hyperion.' . ENVIRONMENT)))
            ->get()
            ->service($service)
            ->execute();

        return json_decode($rest->response);
    }*/

    function get_post_search_api($query)
    {
        $rest = (new HttpClientRest(new Config('api.hyperion.' . ENVIRONMENT)))
            ->get()
            ->service($query)
            ->execute();

        if($rest->statusCode == 200)
        {
            return json_decode($rest->response);
        } else {
            return false;
        }
		
    }

    function get_posts_category_api($query)
    {
        $rest = (new HttpClientRest(new Config('api.hyperion.' . ENVIRONMENT)))
            ->get()
            ->service($query)
            ->execute();

        if($rest->statusCode == 200)
        {
            return json_decode($rest->response);
        } else {
            return false;
        }
    }

    function add_metabox_pesquisa_alfabetica()
    {
        add_meta_box(
            'pesquisa_alfabetica_metabox', // Metabox ID
            'Pesquisa alfabética', // Title to display
            'render_pesquisa_alfabetica_metabox', // Function to call that contains the metabox content
            'post', // Post type to display metabox on
            'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes
        );
    }

    function add_metabox_link_public()
    {
        add_meta_box(
            'link_public_metabox', // Metabox ID
            'Link Público', // Title to display
            'render_link_public_metabox', // Function to call that contains the metabox content
            'post', // Post type to display metabox on
            'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes.
        );
    }

    function render_link_public_metabox($post)
    {
        $alias = str_replace(home_url(), "", get_permalink($post->ID));
        $href = 'http://' . WP_SITE_URL . $alias;
        echo "<label><a href=\"{$href}\">{$href}</a></label>";
    }

    function add_metabox_post_metabox_api()
    {
        add_meta_box(
            'post_metabox_api', // Metabox ID
            'API de Integração', // Title to display
            'render_post_metabox_api', // Function to call that contains the metabox content
            'post', // Post type to display metabox on
            'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
            'default' // Priority relative to other metaboxes
        );
    }

    /** Checa se a data é valida */
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    function render_post_metabox_api($post)
    {
        $envio = (!is_null($post->api_last_update) && validateDate($post->api_last_update)) ? date('d/m/Y H:i:s',strtotime($post->api_last_update)) : "";
        echo "<label><b>ID:</b> {$post->_id}</label><br /><label><b>Envio:</b> {$envio}</label>";
    }

    function render_pesquisa_alfabetica_metabox($post)
    {
        $values = get_post_custom($post->ID);
        $letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $letraSelecionada = (isset($values['busca_letra'][0])) ? $values['busca_letra'][0] : "";

        $metaboxHtml = "";
        $options = "";
        $metaboxHtml .= "<label for=\"id\">Busca por letra</label><br />";
        $metaboxHtml .= "<select id=\"busca_letra\" name=\"busca_letra\">";

        foreach ($letras as $letra)
        {
            if($letraSelecionada == $letra)
            {
                $optionSelected = "<option value=\"{$letra}\">{$letra}</option>";
            } else {
                $options .= "<option value=\"{$letra}\">{$letra}</option>";
            }
        }

        if(empty($letraSelecionada))
        {
            $metaboxHtml .= "<option value=\"\"></option>" . $options;
        } else {
            $metaboxHtml .= $optionSelected . $options . "<option value=\"\"></option>";
        }

        $metaboxHtml .= "</select>";
        echo $metaboxHtml;

    }

    function save_post_all_metaboxes($post_id)
    { 
        $letraSelecionada = (isset($_POST['busca_letra'])) ? $_POST['busca_letra'] : null;
        update_post_meta($post_id, 'busca_letra', wp_kses($letraSelecionada,[]));
    }

    function show_column_head($defaults)
    {
        $defaults['_id'] = 'API Código';
        $defaults['api_last_update'] = 'API Atualizada';
        return $defaults;
    }

    function show_column_id($column_name, $post_ID)
    {
        global $post;
        if($column_name == '_id') echo $post->_id;
        if($column_name == 'api_last_update') echo (!is_null($post->api_last_update)) ? date('d/m/Y H:i:s',strtotime($post->api_last_update)) : "";
    }

}


