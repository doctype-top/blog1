<?php

    namespace library;
    /**
     * Class Url
     * @package library
     */
    class Url{
        /**
         * @return array
         */
        protected static function getSegmentsFromUrl(){
            $segments = explode('/', $_GET['url']);

            if(empty($segments[count($segments)-1])){
                unset($segments[count($segments)-1]);
            }

            $segments = array_map(function($v){
                return preg_replace('/[\'\\\*]/','',$v);
            }, $segments);

            return $segments;
        }

        /**
         * @param string $paramName
         *
         * @return string
         */
        public static function getParam($paramName){
            return addslashes($_GET[$paramName]);
        }

        /**
         * @param integer $n
         *
         * @return string|null
         */
        public static function getSegment($n){
            $segments = self::getSegmentsFromUrl();
            return $segments[$n];
        }

        /**
         * @return array
         */
        public static function getAllSegments(){
            return self::getSegmentsFromUrl();
        }
    }