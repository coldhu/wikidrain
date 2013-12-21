<?php
/**
 * Created by PhpStorm.
 * User: abreksa
 * Project: wikdrain
 * Date: 12/19/13
 * Time: 1:07 AM
 */

class wikidrain {

    protected $_string;
    protected $_apiUrl;
    protected $_wikiQuery;
    protected $_searchParams = array(
        'action' => '',
        'params' => array(),
    );
    //Define the structure of the wikipedia page
    protected $_wikiBones = array(
        'title' => '', //This is the actual title
        'sections' => array( //The titles of the sections
            'title' => array(),
        ),
    );
    //Define the data of the wikipedia page
    protected $_wikiData = array(
        'title' => '', //This is the summary
        'sections' => array( //The data in each section
            'text' => array(),
        ),
        'related' => array( //The related pages
            'title' => array(),
        ),
    );

    public function __construct($lang){
        $this->setLang($lang);
    }

    public function setLang($lang){
        $this->_apiUrl = "http://{$lang}.wikipedia.org/w/api.php?";
    }

    public function getApi(){
        return $this->_apiUrl;
    }

    public function setQuery($query){
        $this->_wikiQuery = $query;
    }

    public function getQuery(){
        return $this->_wikiQuery;
    }

    public function queryClean(){
        $this->_wikiQuery = htmlspecialchars($this->_wikiQuery);
    }

    private function callApi($_searchParams){
        $tmp = count($_searchParams['params']);
        /*
        for($i = 0; $i <= $tmp; $i++){
            $_string = '&';
            $_string = "{$_string}&{";
        }
        */
        $url = "{$this->_apiUrl}action={$_searchParams['action']}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'wikidrain/1.0 (http://www.wikidrain.com/)');
        $result = curl_exec($ch);
    }
}