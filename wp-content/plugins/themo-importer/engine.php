<?php
namespace Ideo;

use DOMDocument;
use IdeoThemoGeneratePageCss;
use WP_Query;

define('JSON_URL', 'http://demos.ideothemes.com/themo/demos_assets/packages/list.json');
define('DEMO_URL', 'http://demos.ideothemes.com/themo/demos_assets/packages/');

/**
 * Removes directory
 *
 * @param string $path Path to delete
 * @return bool True - everything went ok
 */
function deleteDir($path) {
    return is_file($path) ?
        @unlink($path) :
        array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
}



/**
 * Manages directory containing all demos
 */
class Demos {
    public $dir;

    public function __construct($dir) {
        $this->dir = $dir;
    }

    /**
     * Returns list of all available demos
     *
     * @return array List of demos information
     */
    public function fetch() {
        $response = wp_remote_get(JSON_URL, array(
            'timeout' => 60 * 2
        ));

        if (is_array($response)) {
            return json_decode($response['body'], true);
        } else {
            return array();
        }
    }
}

/**
 * Manages single import file
 */
class FileWrapper {

    /** @var string Full path to file */
    public $path;

    /** @var string File directory */
    public $dir;

    /** @var string File name */
    public $name;

    /**
     * @param $dir File directory
     * @param $name File name
     */
    public function __construct($dir, $name) {
        $this->path = implode('/', array($dir, $name));
        $this->dir = $dir;
        $this->name = $name;
    }

    /**
     * Checks if file exists
     *
     * @return boolean True - file exists
     */
    public function exists() {
        return file_exists($this->path);
    }

    /**
     * Returns information about file using finfo_file function
     *
     * @param int|null $type Options that will be passed to finfo_open function
     * @return mixed File info (depending on passed type)
     */
    public function info($type)
    {
        return finfo_file(finfo_open($type), $this->path);
    }
}

/**
 * Manages single zip archive
 */
class TOFile {
    /** @var string Path to zip archive  */
    private $file;

    /** @var string temporary directory  */
    private $tmp;

    /** @var array List of FileWrapper objects */
    private $content;

    /** @var integer Current file index */
    private $pos;

    /**
     * @param string $file Zip archive
     * @param string $tmp Temporary destination to work on
     */
    public function __construct($file, $tmp) {
        $this->file = $file;
        $this->tmp = $tmp;
    }

    /**
     * Unzips archive passed to constractor
     * @return bool True - all ok
     */
    public function unzip() {
        
        if(class_exists('ZipArchive')){
            $zip = new \ZipArchive();

            if($zip->open($this->file)) {
                $zip->extractTo($this->tmp, Import::$ExpectedFiles);
                $zip->close();
                $this->checkContent();
                return true;
            }            
        }else{
            if( unzip_file($this->file, $this->tmp) ){
                $this->checkContent();
                return true;
            };
        }

        return false;
    }

    /**
     * Checks if expected files (specified in Import::$ExpectedFiles) exist in archive.
     */
    private function checkContent() {
        $this->iteratorClear();

        foreach(Import::$ExpectedFiles as $filename) {
            $file = new FileWrapper($this->tmp, $filename);
            if($file->exists()) {
                $this->content[] = $file;
            }
        }

        sort($this->content);
    }

    /**
     * Clears file iterator
     */
    public function iteratorClear() {
        $this->pos = 0;
    }

    /**
     * Returns next files in the archive and moves iterator
     */
    public function iteratorNext() {
        $item = false;

        if($this->pos < count($this->content)) {
            $item = $this->content[$this->pos];
            $this->pos++;
        }

        return $item;
    }

    /**
     * Gets file from the archive by the name.
     *
     * @param $name Name of the file
     * @return object File object
     */
    public function getByFilename($name) {
        $this->iteratorClear();
        while($file = $this->iteratorNext()) {
            if($file->name == $name) {
                return $file;
            }
        }

        return null;
    }

    /**
     * Gets file path from the archive by the name.
     *
     * @param $name Name of the file
     * @return string|null File path or null if file not exists
     */
    public function getPathByFilename($name) {
        $this->iteratorClear();
        while($file = $this->iteratorNext()) {
            if($file->name == $name) {
                return $file->path;
            }
        }

        return null;
    }

}

class Import {
    /** @var string Temporary location for importer */
    private $tempDestination;

    /** @var Path to data.xml file */
    private $dataXmlPath;

    /** @var  TOFile Imported demo zip archive */
    private $file;

    /** @var \WP_IdeoImport */
    private $importer;

    /** @var string Site url in import files */
    private $baseUrl;

    /** @var string Current site url */
    private $newUrl;

    /** @var array Array of files urls mapping */
    private $filesMapping;

    /** @var string Url to pre-generated css files */
    private $stylesUrl;

    /** @var string Url to media archive/archives */
    private $mediaUrl;

    /** @var int Number of parts of media archive */
    private $mediaParts = 0;

    /** @var int Current state in media importing */
    private $mediaRestart = 0;

    /** @var array Simple options that will be copied without change */
    private static $SimpleOptions = array(
        'show_on_front',
    );

    /** @var array Settings that values are post ids and require id mapping */
    private static $PostIdOptions = array(
        'page_on_front',
        'page_for_posts'
    );

    /** @var array List of files that are expected in demo zip archive */
    public static $ExpectedFiles;

    public static function LogMessage($message){
        if (WP_DEBUG)
            error_log('IMP ' . $message);
    }

    /**
     * @param string $tmp Directory that importer can create temporary directory for archive unzipping
     */
    public function __construct($tmp) {
        $this->tempDestination = implode('/', array($tmp, substr(md5(rand()), 0, 16)));
    }

    private function createTempDir() {
        mkdir($this->tempDestination);
    }

    private function getDemoZip($demo_id) {
        // Download pre-generated css files
        $response = wp_remote_get(DEMO_URL . $demo_id . '/demo.zip', array(
            'timeout' => 60 * 2
        ));

        $destinationFileName = $this->tempDestination . '/demo.zip';

        if (is_array($response)) {
            file_put_contents($destinationFileName, $response['body'], FILE_APPEND);
            $this->addFileDoneMessage('Demo archive');
            return $destinationFileName;
        } else {
            addMessage('Could not get demo archive');
            return null;
        }
    }

    /**
     * Imports specified zip archive
     *
     * @param string $demo_id Demo ID
     * @param integer $step Current step (0/1/2)
     * @return array Array with result info ('code' and 'message')
     */
    public function process($demo_id, $step) {
        // Start intercepting output
        ob_start();

        if ($step == 0) {
            if ($this->mediaParts == 0) {
                Import::LogMessage('Start');

                $this->createTempDir();
                $file_path = $this->getDemoZip($demo_id);

                if (empty($file_path)) {
                    $result = array(
                        'code' => 1,
                        'message' => ob_get_contents(),
                    );

                    ob_end_clean();
                    return $result;
                }

                // Create and unzip demo archive
                $this->file = new TOFile($file_path, $this->tempDestination);
                $this->file->unzip();

                // Iterate through all files in the archive
                $this->file->iteratorClear();
            }

            if (!$this->mediaImport()){
                $result = array(
                    'code' => 0,
                    'message' => ob_get_contents(),
                    'continue' => true,
                    'temp_path' => $this->tempDestination,
                    'progress' => $this->mediaRestart / $this->mediaParts
                );
                ob_end_clean();
                return $result;
            } else {
                $result = array(
                    'code' => 0,
                    'message' => ob_get_contents(),
                    'temp_path' => $this->tempDestination
                );

                ob_end_clean();
                return $result;
            }
        } else if ($step == 1) {
            if (!$this->importer || $this->importer->restart_count == 0) {
                // Include wordpress-importer
                require_once(dirname(__FILE__) . '/wordpress-importer/wordpress-importer.php');

                // Import xml data from data.xml (exported by wordpress)
                $import_data = simplexml_load_file($this->file->getByFilename('data.xml')->path);

                // Base url stored in export data
                $this->baseUrl = $this->removeSlash((string)$import_data->channel->link);
                $this->newUrl = $this->removeSlash(get_bloginfo('url'));
            }

            // Block automatic styles generation for import process
            IdeoThemoGeneratePageCss::$BlockAutoGenerate = true;

            $this->switchOptionsCache(false);

            if (!$this->dataImport('data.xml')){
                // Data import is not finished, divided into parts
                $result = array(
                    'code' => 0,
                    'message' => ob_get_contents(),
                    'continue' => true,
                    'temp_path' => $this->tempDestination,
                    'progress' => $this->importer->restart_count / sizeof($this->importer->posts)
                );
                ob_end_clean();
                return $result;
            }

            $this->optionsImport('customizer.json');
            $this->optionsImport('sidebars.json');
            $this->optionsImport('pc.json');
            $this->sliderImport('sliders.json');
            $this->customOptionsImport('options.json');
            $this->switchOptionsCache(true);

            $this->finishImport();

            // Restore automatic style generation
            IdeoThemoGeneratePageCss::$BlockAutoGenerate = false;

            $result = array(
                'code' => 0,
                'message' => ob_get_contents(),
                'temp_path' => $this->tempDestination
            );

            ob_end_clean();
            return $result;
        } else {
            // Do style generations
            $this->generateCss();

            Import::LogMessage('End');
        }

        $result = array(
            'code' => 0,
            'message' => ob_get_contents(),
        );

        ob_end_clean();

        deleteDir($this->tempDestination);

        return $result;
    }

    /**
     * Remove slash from the end of url
     *
     * @param $url Url to change
     * @return string Url without slash at the end
     */
    private function removeSlash($url)
    {
        if (empty($url))
            return $url;

        if ($url[strlen($url) - 1] !== '/')
            return $url;

        return substr($url, 0, strlen($url) - 1);
    }

    /**
     * Prepares url for replace pattern. Escapes dots and puts chosen slash characters.
     *
     * @param $url Url to prepare
     * @param string $slash_characters Slash characters being changed in replace ('/' or '\\\\/')
     * @return string Changed url
     */
    private function prepareUrlForPattern($url, $slash_characters = '/')
    {
        $url = str_replace('.', "\\.", $url);

        if ($slash_characters != '/')
            $url = str_replace('/', $slash_characters, $url);

        return $url;
    }

    /**
     * Prepares url for replace value depending on slash characters
     *
     * @param $url Url to prepare
     * @param string $slash_characters Slash characters being changed in replace ('/' or '\\\\/')
     * @return string Changed url
     */
    private function prepareUrlForReplace($url, $slash_characters = '/')
    {
        if ($slash_characters != '/')
            $url = str_replace('/', $slash_characters, $url);

        return $url;
    }

    /**
     * Normalizes slashes (replaces with standard slash character)
     *
     * @param $url Url to change
     * @param $slash_characters Original slash characters in url
     * @return string Changed url
     */
    private function normalizeSlashes($url, $slash_characters)
    {
        return str_replace($slash_characters, '/', $url);
    }

    /**
     * Gets url from mapping information prepared while data.xml import
     *
     * @param $url Url to map
     * @param string $slash_characters Slash characteres being changed in replace
     * @return string Mapped url
     */
    private function getMappedUrl($url, $slash_characters = '/')
    {
        $url = $this->normalizeSlashes($url, $slash_characters);

        if (empty($this->importer->url_remap[$url]))
            return '';

        $url = $this->importer->url_remap[$url];

        return $this->prepareUrlForReplace($url, $slash_characters);
    }

    /**
     * Replaces url in string with specified slash characters
     *
     * @param $old Old url to replace
     * @param $new New url to put
     * @param $subject Subject of replace
     * @param string $slash_characters Slash characters used used in subject ('/' or '\\\\/')
     * @param bool $use_mapping True for options import, allows importer to use previously prepared url mapping
     * @return string Replaced subject
     */
    private function replaceUrlInString($old, $new, $subject, $slash_characters = '/', $use_mapping = false)
    {
        $old = $this->prepareUrlForPattern($old, $slash_characters);
        $new = $this->prepareUrlForReplace($new, $slash_characters);

        // Replace url in serialized data
        $subject = preg_replace_callback('<([^a-z0-9])s:[0-9]+:"(' . $old . '[^"]*)">i', function($match) use ($old, $new, $slash_characters, $use_mapping){
            if ($use_mapping && ($mapped_url = $this->getMappedUrl($match[2], $slash_characters)))
                $new_url = $mapped_url;
            else
            {
                $new_url = preg_replace('<' . $old . '>i', $new, $match[2]);
                $new_url = preg_replace('<' . $slash_characters . 'sites' . $slash_characters . '(\d+)' . $slash_characters . '>i', $slash_characters, $new_url);
                $this->filesMapping[$new_url] = $match[2];
            }

            return sprintf('%ss:%s:"%s"', $match[1], strlen($new_url), $new_url);
        }, $subject);

        // Replace url in other data
        $subject = preg_replace_callback('<(' . $old . ')([A-Za-z0-9\-\._~:\/\?#\@!$&\'()*+,;=%]*)([^A-Za-z0-9\-\._~:\/\?#\@!$&\'()*+,;=%]|$)>i', function($match) use ($old, $new, $slash_characters, $use_mapping){
            if ($use_mapping && ($mapped_url = $this->getMappedUrl($match[1] . $match[2], $slash_characters)))
                $new_url = $mapped_url;
            else
            {
                $new_url = $new . preg_replace('<' . $slash_characters . 'sites' . $slash_characters . '(\d+)' . $slash_characters . '>i', $slash_characters, $match[2]);
                $this->filesMapping[$new_url] = $match[1] . $match[2];
            }

            return $new_url . $match[3];
        }, $subject);

        return $subject;
    }

    /**
     * Replaces base url from old (url of site that was exported) to new (url of current site) in specified file
     *
     * @param $file_path File path to replace url
     * @param $old Url of site that was exported
     * @param $new Url of current size
     * @return mixed Number of bytes written to the file or false on failure
     */
    private function replaceUrlInFile(&$file_path, $old, $new) {
        $content = file_get_contents($file_path);

        $content = $this->replaceUrlInString($old, $new, $content);
        $content = $this->replaceUrlInString($old, $new, $content, "\\\\/");

        return file_put_contents($file_path, $content);
    }

    /**
     * Does preg_replace on nested arrays or string
     *
     * @param $old Old url to replace
     * @param $new New url to put
     * @param $subject Subject data (any type)
     * @return mixed Subject with replaced urls
     */
    private function replaceUrlInArray($old, $new, $subject, $use_mapping = true)
    {
        if (empty($subject))
            return $subject;

        if (gettype($subject) === 'string')
        {
            // Subject is string, simply replace urls
            $subject = $this->replaceUrlInString($old, $new, $subject, '/', $use_mapping);
            $subject = $this->replaceUrlInString($old, $new, $subject, "\\\\/", $use_mapping);
            return $subject;
        }

        if (gettype($subject) != 'array')
            return $subject;

        // Subject is an array, do work for every element
        foreach($subject as $key => $item)
            $subject[$key] = $this->replaceUrlInArray($old, $new, $item, $use_mapping);

        return $subject;
    }

    /**
     * Turns on/off options cache invalidation
     *
     * @param $state True - cache invalidation will be turned on
     */
    private function switchOptionsCache($state)
    {
        if ($state)
        {
            // Restore cache invalidation and flush cache
            wp_suspend_cache_invalidation(false);
            wp_cache_flush();
        }
        else
        {
            // Clear options cache and stop cache invalidation for options import
            wp_cache_delete ('alloptions', 'options');
            wp_suspend_cache_invalidation(true);
        }
    }

    /**
     * Imports options file to db
     * @param string $file_name Name of .json file
     */
    private function optionsImport($file_name) {

        $file_path = $this->file->getPathByFilename($file_name);

        if (empty($file_path))
            return;

        self::LogMessage($file_name . ' - start');

        $this->switchOptionsCache(false);

        // Get file content and decode options list
        $data = file_get_contents($file_path);
        $data = json_decode($data, true);

        // For each option
        foreach($data as $option_name => $option_value) {

            // Change theme_mods_xx option name to new theme name
            if(substr($option_name, 0, 10)  == 'theme_mods') {
                $option_name = 'theme_mods_'.trim(get_option('template'));
            }

            // Unserialize option value and replace urls
            $option_value = unserialize($option_value);
            $option_value = $this->replaceUrlInArray($this->baseUrl, $this->newUrl, $option_value);

            if ($option_name == 'pc_data')
            {
                // For Parallax Composer settings we need to change page ids

                $new_option_value = array();
                $mapping = $this->importer->get_processed_posts();

                foreach($option_value as $page_id => $animations_data)
                {
                    if (isset($mapping[$page_id]))
                        $new_option_value[$mapping[$page_id]] = $animations_data;
                }

                $option_value = $new_option_value;
            }

            // Save option to db
            update_option($option_name, $option_value, 'yes');
        }
        switch($file_name){
            case 'customizer.json':
                $this->addFileDoneMessage('Customizer');
                break;
            case 'sidebars.json':
                $this->addFileDoneMessage('Sidebars & Widgets');
                break;
            case 'pc.json':
                $this->addFileDoneMessage('Parallax Composer');
                break;
            case 'options.json':
                $this->addFileDoneMessage('Options');
                break;
        }       
        self::LogMessage($file_name . ' - end');
    }
    /**
     * Imports sliders file to db
     * @param string $file_name Name of .json file
     */
    private function sliderImport($file_name) {

        $file_path = $this->file->getPathByFilename($file_name);

        if (empty($file_path))
            return;
               // Get file content and decode options list
        $data = file_get_contents($file_path);
        $data = json_decode($data, true);
        
        if(defined('RS_PLUGIN_PATH')){            
            if(is_array($data['rs']) && count($data['rs']) > 0){
                ob_start();        
                foreach($data['rs'] as $filepath){
                    $slider = new \RevSlider();
                    $response =  $slider->importSliderFromPost(true, true, $this->tempDestination . '/' . $filepath, false, false, true);
                }               
                ob_end_clean();
                $this->addFileDoneMessage('Revslider Sliders');
            }              
        }
        if(class_exists('LS_Sliders') && isset($data['ls']) && isset($data['ls'][0]) && $data['ls'][0] !='') {        
            include LS_ROOT_PATH.'/classes/class.ls.importutil.php';
            $filepath = $data['ls'][0];
            $import = new \LS_ImportUtil($this->tempDestination . '/' . $filepath);    
            $this->addFileDoneMessage('Layerslider Sliders');
        }  
    }

    /**
     * Imports WP data using wordpress-importer
     *
     * @param string $file_name Name of the data file
     * @return bool True - data import finished, false - there is some data that was not imported (division into parts)
     */
    private function dataImport($file_name) {
        if (empty($this->importer) || $this->importer->restart_count == 0) {
            $file_path = $this->file->getPathByFilename($file_name);

            if (empty($file_path))
                return;

            self::LogMessage($file_name . ' - start');

            $this->dataXmlPath = $file_path;

            // Include wordpress-importer and create new instance
            require_once(dirname(__FILE__) . '/wordpress-importer/wordpress-importer.php');
            $this->importer = new \WP_IdeoImport();

            // Replace old site url with new value
            $this->replaceUrlInFile($file_path, $this->baseUrl, $this->newUrl);
        }

        // To make import faster turn off counting of elements
        wp_defer_term_counting(true);
        wp_defer_comment_counting(true);

        if (empty($this->importer) || $this->importer->restart_count == 0) {
            // Adds fileter that check if current meta should be imported
            add_filter('import_post_meta_key', array($this->importer, 'is_valid_meta_key'));

            // Adds filter that will stop import after 60 seconds
            add_filter('http_request_timeout', array(&$this->importer, 'bump_request_timeout'));

            // Set necessary import options
            $this->importer->fetch_attachments = true;
            $this->importer->url_new = $this->newUrl;
            $this->importer->url_old = $this->baseUrl;
            $this->importer->files_mapping = $this->filesMapping;

            // Parses import file and starts import
            $this->importer->import_start($file_path);

            // Maps authors in old db to authors in new db based on logins
            $this->importer->get_author_mapping();
        }

        // Turn off cache invalidtion to make import quicker
        wp_suspend_cache_invalidation(true);

        if (empty($this->importer) || $this->importer->restart_count == 0)
        {
            // Process all necessary elements
            $this->importer->process_categories();
            $this->importer->process_tags();
            $this->importer->process_terms();
        }

        if ($this->importer->process_posts() === false) {
            wp_defer_term_counting(false);
            wp_defer_comment_counting(false);
            return false;
        }

        // Turn on cache invalidation
        wp_suspend_cache_invalidation(false);

        // Update incorrect/missing information in the DB
        $this->importer->backfill_parents();
        $this->importer->backfill_attachment_urls();
        $this->importer->remap_featured_images();

        // Finish import
        $this->importer->import_end();

        // Clean after import
        wp_import_cleanup($this->importer->id);

        wp_cache_flush();

        // Remove children options for all taxonomies
        foreach (get_taxonomies() as $tax) {
            delete_option("{$tax}_children");
            _get_term_hierarchy($tax);
        }

        // Turn on counting elements
        wp_defer_term_counting(false);
        wp_defer_comment_counting(false);

        $this->addFileDoneMessage('Data');
        self::LogMessage($file_name . ' - end');

        return true;
    }

    /**
     * Imports media archives
     * @return bool True - operation finished, false - there are parts left
     */
    private function mediaImport() {
        if ($this->mediaParts == 0) {
            self::LogMessage('media - start');

            // First request, need to get media info from file
            $fileName = 'remote.json';
            $filePath = $this->file->getPathByFilename($fileName);

            if (empty($filePath))
                return true;

            if (!file_exists($filePath))
                return true;

            // Get file content and decode json
            $data = file_get_contents($filePath);
            $data = json_decode($data, true);

            $this->mediaUrl = $data['uploads_url'];
            $this->mediaParts = isset($data['uploads_parts']) ? $data['uploads_parts'] : 1;
            $this->stylesUrl = $data['styles_url'];
            $this->slidersUrl = $data['sliders_url'] ?: false;
            $this->mediaRestart = 0;
        }

        $destination = wp_upload_dir()['basedir'];
        $destination_file_name = $this->tempDestination . '/uploads.zip';

        $this->mediaRestart++;

        if ($this->mediaParts == 1) {
            $remoteFileName = $this->mediaUrl;
        } else {
            $remoteFileName = sprintf('%s.%03d', $this->mediaUrl, $this->mediaRestart);
        }

        // Download part of media archive
        $response = wp_remote_get($remoteFileName, array(
            'timeout' => 60 * 2
        ));       

        if (is_array($response)) {
            file_put_contents($destination_file_name, $response['body'], FILE_APPEND);
        } else {
            addMessage('Could not get media archive part');
            return true;
        }
        
        if($this->slidersUrl){
            $response = wp_remote_get($this->slidersUrl, array(
                'timeout' => 60 * 2
            ));       
            if (is_array($response)) {
                $sliders_zip = $this->tempDestination . '/sliders.zip';
                
                file_put_contents($sliders_zip, $response['body']);
                if(class_exists('ZipArchive')){
                    $zip = new \ZipArchive();
                    $zip->open($sliders_zip);
                    $zip->extractTo(dirname($sliders_zip));
                    $zip->close();
                }else{
                    unzip_file($sliders_zip, dirname($sliders_zip));
                }
            } else {
                addMessage('Could not get sliders archive part');
                return true;
            }
        }

        if ($this->mediaRestart == $this->mediaParts) {
            // That was last part, extract archive to css directory
            if(class_exists('ZipArchive')){
                $zip = new \ZipArchive();
                $zip->open($destination_file_name);
                $zip->extractTo($destination);
                $zip->close();
            }else{
                unzip_file($destination_file_name, $destination);
            }

            self::LogMessage('media - end');
            $this->addMessage('media imported!');

            return true;
        }

        return false;
    }

    /**
     * Imports options that are not written to pc.json, sidebars.json and customizer.json
     *
     * @param $file_name Name of the file to import
     */
    private function customOptionsImport($file_name){
        $file_path = $this->file->getPathByFilename($file_name);

        if (empty($file_path))
            return;

        self::LogMessage($file_name . ' - start');

        // Get and decode options list from file
        $data = file_get_contents($file_path);
        $data = json_decode($data, true);

        // Import simple options (that are imported without changes to db)

        foreach(self::$SimpleOptions as $option_name)
        {
            if (isset($data[$option_name]))
                update_option($option_name, $data[$option_name], 'yes');
        }

        // Import options that values are post ids and require mapping

        // Gets mapping posts mapping information from importer
        $posts_mapping = $this->importer->get_processed_posts();

        // For each options update value to new post id
        foreach (self::$PostIdOptions as $option_name)
        {
            if(isset($data[$option_name]))
                update_option($option_name, (!empty($data[$option_name]) && isset($posts_mapping[$data[$option_name]])) ? $posts_mapping[$data[$option_name]] : $data[$option_name], 'yes');
        }

        $this->addFileDoneMessage('Options');
        self::LogMessage($file_name . ' - end');
    }

    /**
     * Other changes after import proccess
     */
    private function finishImport()
    {
        $this->fixMenuLocations();
        $this->fixGrids();
        $this->fixIds();
    }

    /**
     * Fixes ids of terms used in menu location settings
     */
    private function fixMenuLocations()
    {
        // Gets menu locations that was imported
        $data = get_theme_mod('nav_menu_locations');

        if (empty($data))
            return;

        // Gets mapping information for terms (key = old id, value = new id)
        $terms_mapping = $this->importer->get_processed_terms();

        // For each assigned menu changes old id to new value
        foreach($data as $slug => $termId) {
            if (!empty($terms_mapping[$termId]))
                $data[$slug] = $terms_mapping[$termId];
        }

        // Saves new menu locations
        set_theme_mod('nav_menu_locations', $data);
    }

    /**
     * Fixes the_grid shortcodes
     */
    private function fixGrids()
    {
        if (empty($this->dataXmlPath))
            return;

        $xml = new DOMDocument;
        $xml->loadXML( file_get_contents( $this->dataXmlPath ) );

        $import_data = simplexml_import_dom( $xml );
        unset( $xml );

        // Return the namespaces declared in the root of the XML document
        $namespaces = $import_data->getDocNamespaces();
        // Check for wp namespaces (for later wp:category and wp:terms)
        if (!isset($namespaces['wp'])) {
            $namespaces['wp'] = 'http://wordpress.org/export/1.1/';
        }

        // Loop trough each terms and save it in array
        foreach ($import_data->xpath('/rss/channel/wp:category') as $term_arr) {
            $t = $term_arr->children( $namespaces['wp'] );
            $old_terms[] = array(
                'term_id'       => (int) $t->term_id,
                'term_taxonomy' => 'category',
                'term_slug'     => (string) $t->category_nicename,
                'term_name'     => (string) $t->cat_name,
            );
        }

        foreach ($import_data->xpath('/rss/channel/wp:tag') as $term_arr) {
            $t = $term_arr->children( $namespaces['wp'] );
            $old_terms[] = array(
                'term_id'       => (int) $t->term_id,
                'term_taxonomy' => 'tag',
                'term_slug'     => (string) $t->tag_slug,
                'term_name'     => (string) $t->tag_name,
            );
        }

        foreach ($import_data->xpath('/rss/channel/wp:term') as $term_arr) {
            $t = $term_arr->children( $namespaces['wp'] );
            $old_terms[] = array(
                'term_id'       => (int) $t->term_id,
                'term_taxonomy' => (string) $t->term_taxonomy,
                'term_slug'     => (string) $t->term_slug,
                'term_name'     => (string) $t->term_name,
            );
        }

        // Get terms mapping
        $termsMapping = $this->importer->get_processed_terms();

        // Args for custom wp_query
        $args = array(
            'post_type'      => 'the_grid',
            'posts_per_page' => -1,
        );

        // Build custom wp_query to retrieve all grid post
        $the_grid_query  = new WP_query($args);

        // Check if there is grid
        if ($the_grid_query->have_posts()) {
            // If grid available start loop
            while ($the_grid_query->have_posts()) {
                // Get current grid post
                $the_grid_query->the_post();

                $filter_area = array();
                $meta_keys = get_metadata('post', get_the_ID());

                if ($meta_keys) {

                    // Update categories
                    if (!empty($meta_keys['the_grid_categories']))
                    {
                        // Unserialize meta value
                        $categories = unserialize(is_array($meta_keys['the_grid_categories']) ? $meta_keys['the_grid_categories'][0] : $meta_keys['the_grid_categories']);

                        if (!empty($categories))
                        {
                            // For each assigned category
                            foreach ($categories as $key => $category)
                            {
                                $split = explode(':', $category);

                                // Set new term id
                                if (!empty($termsMapping[intval($split[1])]))
                                    $split[1] = $termsMapping[intval($split[1])];

                                $categories[$key] = implode(':', $split);
                            }

                            // Update meta value
                            update_post_meta(get_the_ID(), 'the_grid_categories', $categories);
                        }
                    }

                    // Get filter area which contains terms ids
                    foreach ($meta_keys as $key => $val) {
                        if (strrpos($key, 'the_grid_filters_') !== false) {
                            $val = (is_array($val)) ? $val[0] : $val;
                            $filter_areas[str_replace('the_grid_', '', $key)] = maybe_unserialize($val);
                        }
                    }
                }

                // Loop trough each filter areas
                $filter_areas_nb  = count(preg_grep('/filters_\d/i', array_keys($filter_areas)));
                for ($i = 1; $i <= $filter_areas_nb; $i++) {
                    $updated_terms = array();
                    if (!empty($filter_areas['filters_'.$i])) {
                        // Get terms array
                        $terms = json_decode($filter_areas['filters_'.$i]);
                        if (isset($terms) && !empty($terms)) {
                            //print_r($terms);
                            foreach ($terms as $term) {
                                // Try to get term data from term ids imported by Wordpress
                                if ($term->id) {
                                    // Serach in import xml terms
                                    foreach ($old_terms as $old_term) {
                                        // If old import xml id term match the curent filter are terms
                                        if ($old_term['term_id'] == $term->id && $old_term['term_taxonomy'] == $term->taxonomy) {
                                            // Then try to get data from imported slug
                                            $new_term_data = get_term_by('slug', $old_term['term_slug'], $old_term['term_taxonomy']);
                                            if ($new_term_data) {
                                                // Store new imported id
                                                $updated_terms[] = (object) array(
                                                    'id' => $new_term_data->term_id,
                                                    'taxonomy' => $new_term_data->taxonomy
                                                );
                                            }
                                        }
                                    }
                                }
                            }
                            // Encode terms
                            $updated_terms = json_encode($updated_terms);
                            // If terms available
                            if ($updated_terms) {
                                // Update grid filter meta data
                                update_post_meta(get_the_ID(), 'the_grid_filters_'.$i, $updated_terms);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Fixes posts and terms ids in single post content
     * @param $content Content to change
     * @param $terms_mapping Array with terms id mapping (old => new)
     * @param $posts_mapping Array with posts id mapping (old => new)
     * @return string Changed content
     */
    private function fixIdsInContent($content, $terms_mapping, $posts_mapping)
    {
        return preg_replace_callback('/ (el_image|image|el_icon_custom|el_custom_marker|el_background_image|el_background_hover_image|nav_menu)="([0-9]+)"/i', function($match) use ($terms_mapping, $posts_mapping) {
            $attribute = $match[1];
            $id = intval($match[2]);

            if ($attribute == 'nav_menu')
                $new_id = isset($terms_mapping[$id]) ? $terms_mapping[$id] : $id;
            else
                $new_id = isset($posts_mapping[$id]) ? $posts_mapping[$id] : $id;

            return sprintf(' %s="%d"', $attribute, $new_id);
        }, $content);
    }

    /**
     * Fixes posts and terms ids in posts contents
     */
    private function fixIds()
    {
        $terms_mapping = $this->importer->get_processed_terms();
        $posts_mapping = $this->importer->get_processed_posts();

        $posts = get_posts(array(
            'numberposts' => -1,
            'posts_per_page' => -1,
            'post_type' => array('page', 'post', 'portfolio', 'team', 'footer-post')
        ));

        foreach($posts as $post) {
            $new_content = $this->fixIdsInContent($post->post_content, $terms_mapping, $posts_mapping);

            if ($post->post_content != $new_content)
            {
                $post->post_content = $new_content;
                wp_update_post($post);
            }
        }
    }

    /**
     * Generates global and page css files after import
     */
    private function generateCss()
    {
        if (empty($this->stylesUrl))
            return;

        // Download pre-generated css files
        $response = wp_remote_get($this->stylesUrl, array(
            'timeout' => 60 * 2
        ));

        $destinationFileName = $this->tempDestination . '/styles.zip';

        if (is_array($response)) {
            file_put_contents($destinationFileName, $response['body'], FILE_APPEND);
        } else {
            addMessage('Could not get media archive part');
        }

        if (!file_exists(IDEOTHEMO_CACHE_DIR)) {
            // Create css cache directory if not exists
            mkdir(IDEOTHEMO_CACHE_DIR, 0777, true);
        }

        // Open archive
        if(class_exists('ZipArchive')){
            $zip = new \ZipArchive();
            $zip->open($destinationFileName);

            // Extract global css file
            $zip->extractTo(IDEOTHEMO_CACHE_DIR, 'style.css');
        

            // Rename all post css files so we can easily map ids before extracting
            for($i = 0; $i < $zip->numFiles; $i++) {
                $fileInfo = $zip->statIndex($i);
                if ($fileInfo['name'] != 'style.css') {
                    $zip->renameIndex($i, $fileInfo['name'] . '.source');
                }
            }
        }
        // Get posts id mapping
        $postMapping = $this->importer->get_processed_posts();
        $generatedIds = array();

        // Extract post css files with mapping
        for($i = 0; $i < $zip->numFiles; $i++) {
            if(class_exists('ZipArchive')){
                $fileInfo = $zip->statIndex($i);
            }
            if ($fileInfo['name'] == 'style.css')
                continue;

                // Get post id from file name
                $match = array();
                preg_match('/post-([0-9]+).css.source/', $fileInfo['name'], $match);
                $postId = intval($match[1]);

                // Get new post id
                $newId = isset($postMapping[$postId]) ? $postMapping[$postId] : $postId;
                $newFileName = sprintf('post-%d.css', $newId);

                // Store post id so it will be omitted during styles generation
                $generatedIds[] = $newId;

            if(class_exists('ZipArchive')){
                // Rename file with new post id and extract it to css cache directory
                $zip->renameIndex($i, $newFileName);
                $zip->extractTo(IDEOTHEMO_CACHE_DIR, $newFileName);
            }
        }
        if(class_exists('ZipArchive')){
            $zip->close();
        }else{
            unzip_file($destinationFileName, IDEOTHEMO_CACHE_DIR);
        }

        // Get posts without those with pre-generated css files
        $posts = get_posts(array(
            'numberposts' => -1,
            'posts_per_page' => -1,
            'post_type' => array('page', 'post', 'portfolio', 'team'),
            'post__not_in' => $generatedIds
        ));

        $ideoGeneratePageCss = new IdeoThemoGeneratePageCss();

        // For each post generate css file
        foreach ($posts as $post) {
            setup_postdata($post);
            $ideoGeneratePageCss->action($post->ID, $post, false);
        }

        $this->addMessage('styles generated!');
    }

    /**
     * Gets temporary import directory
     *
     * @return string Temp dir
     */
    public function getTempDestination()
    {
        return $this->tempDestination;
    }

    /**
     * Adds message to the output
     *
     * @param string $message
     */
    private function addMessage($message)
    {
        echo '<strong>' . $message . '</strong><br>';
    }

    /**
     * Adds message about finishing file import
     *
     * @param string $file_name Name of imported file
     */
    private function addFileDoneMessage($file_name)
    {
        $this->addMessage($file_name . ' OK!');
    }
}
