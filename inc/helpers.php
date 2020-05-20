<?php

class Helper
 {
    public static function get_field_key( $title )
 {
        return acf_maybe_get_field( $title, false, false )['key'];
    }
    public static function get_component_content( $path ) {
        $content = '';
        ob_start();
        include $path;
        $content = ob_get_clean();
        return $content;
    }
    //making startswith global to be accessible with Helper::
    public static function startsWith( $string, $query )
    {
        return substr( $string, 0, strlen( $query ) ) === $query;
    }
    public static function reArrayFiles( $file )
 {
        $file_ary = array();
        $file_count = count( $file['name'] );

        $file_key = array_keys( $file );

        for ( $i = 0; $i < $file_count; $i++ ) {
            foreach ( $file_key as $val ) {
                $file_ary[$i][$val] = $file[$val][$i];
            }
        }
        return $file_ary;
    }

    public static function upload_files( $files )
 {

        $files_uploaded = array();
        // $files = $_FILES;

        $file_ary = reArrayFiles( $files['file'] );

        $files_extensions = ['image/png', 'image/jpeg', 'image/jpg'];

        $is_files_checked = true;
        // check_upload_files( $files, $files_extensions, 5 );

        if ( $is_files_checked ) {

            foreach ( $file_ary as $file ) {
                // print 'File Name: ' . $file['name'];
                // print 'File Type: ' . $file['type'];
                // print 'File Size: ' . $file['size'];

                $file_name = $file['name'];
                $ext = pathinfo( $file_name, PATHINFO_EXTENSION );

                $upload_file_name = ( $request['fullname'] . '_' . ( !empty( $request['age'] ) ? $request['email'] . '_' : '' ) . '_' . $file_name );
                //. '_' . time() . $ext
                $upload_dir = wp_upload_dir();

                if ( move_uploaded_file( $file['tmp_name'], $upload_dir['path'] . '/' . $upload_file_name ) ) {
                    //registration_FrontDriverLicense || registration_BackDriverLicense
                    //registration_FrontEmirateID || registration_BackEmirateID
                    //Passport || Visa_Stamp
                    $uploaded_file['file_name'] = $file_name;
                    $uploaded_file['upload_url'] = $upload_dir['url'] . '/' . $upload_file_name;

                    $attachment = array(
                        'guid' => $uploaded_file['upload_url'],
                        'post_mime_type' => $file['type'],
                        'post_title' => $upload_file_name,
                        'post_content' => '',
                        'post_status' => 'inherit',
                    );

                    $uploaded_file['attach_id'] = wp_insert_attachment( $attachment, $upload_dir['path'] . '/' . $upload_file_name );
                    require_once ABSPATH . 'wp-admin/includes/image.php';

                    //Generate the metadata for the attachment, and update the database record.
                    $attach_data = wp_generate_attachment_metadata( $uploaded_file['attach_id'], $upload_dir['path'] );
                    wp_update_attachment_metadata( $uploaded_file['attach_id'], $attach_data );

                    $files_uploaded[] = $uploaded_file;
                }
            }
            return $files_uploaded;
        } else {
            //$is_files_checked files error....
            return $is_files_checked;
        }
    }
}

new Helper();