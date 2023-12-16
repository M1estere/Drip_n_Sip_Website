<?php
    # echo get_translation("Caramel Brulee Latte", 'ru');

    function get_translation($text_to_translate, $target_language) {
        $token_path = 'support/token.txt';

        $folder_id = 'b1g1q52o6r5ndr1rv3ue';

        $IAM_TOKEN = trim(file_get_contents(realpath($token_path)));
        $url = 'https://translate.api.cloud.yandex.net/translate/v2/translate';

        $headers = [
            'Content-Type: application/json',
            "Authorization: Bearer $IAM_TOKEN"
        ];

        $texts = array();
        $texts[] = $text_to_translate;

        $post_data = [
            "targetLanguageCode" => $target_language,
            "texts" => $texts,
            "folderId" => $folder_id,
        ];
    
        $data_json = json_encode($post_data);
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
    
        $result = curl_exec($curl);
        curl_close($curl);
    
        $result = json_decode($result);
        return $result->translations[0]->text;
    }

    function insert_text_to_translations($key, $value) {
        try {
            $source_file = file_get_contents(realpath('../js/translations.json'));
            $source_arr = json_decode($source_file, true);
    
            $source_arr['en'][$key] = $value;
            $source_arr['ru'][$key] = get_translation($value, 'ru');
    
            $jsonData = json_encode($source_arr, JSON_UNESCAPED_UNICODE);
            file_put_contents(realpath('../js/translations.json'), $jsonData);

            return true;
        } catch (Exception $ex) {
            return false;
        }        
    }

    function delete_text_from_translations($key) {
        try {
            $source_file = file_get_contents(realpath('../js/translations.json'));
            $source_arr = json_decode($source_file, true);
    
            unset($source_arr['en'][$key]);
            unset($source_arr['ru'][$key]);
    
            $jsonData = json_encode($source_arr, JSON_UNESCAPED_UNICODE);
            file_put_contents(realpath('../js/translations.json'), $jsonData);

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
?>