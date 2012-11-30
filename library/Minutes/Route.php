<?php
namespace Minutes;
class Route
{
    const PARAM_IDENTIFIER = ':';
    private $name;

    private $patternArr = array();
     /*
     * @param $defaultsArr - assoc array of default values
     */
    private $defaultsArr = null;
    private $countPatternArr;
    public function __construct($name = 'default', $pattern = ':controller/:action', $defaults = array('controller' => 'index', 'action' => 'index')) {
        $this->name = $name;
        $this->patternArr = $this->explodeRequest($pattern);
        $this->countPatternArr = count($this->patternArr);
        $this->defaultsArr = $defaults;
    }
    /*
     * check if given request matches route pattern
     */
    public function match($request) {
        $requestArr = $this->explodeRequest($request);
        /*if (count($requestArr) < $this->countPatternArr) {
            return false;
        }*/
        for ($i = 0; $i < $this->countPatternArr; $i++) {
            if ($this->isParam($this->patternArr[$i])) {
                continue;
            }
            if (0 !== strcasecmp($this->patternArr[$i], $requestArr[$i])) {
                return false;
            }
        }
        return true;
    }
     /*
     * dispatch given request with route
     * 
     * returns assoc array with controller, action and all parameters
     */
    public function dispatch($request) {
        $requestArr = $this->explodeRequest($request);
        $result = $this->defaultsArr;
        for ($i = 0; $i < $this->countPatternArr; $i++) {
            if ($this->isParam($this->patternArr[$i]) && !empty($requestArr[$i])) {
                $result[ltrim($this->patternArr[$i], self::PARAM_IDENTIFIER)] = $requestArr[$i]; //@TODO use $this->cleanParam if its ok
            }
        }
        for ($i = $this->countPatternArr; $i < count($requestArr); $i++) {
            if (isset ($requestArr[$i + 1])) {
                $result[$requestArr[$i]] = $requestArr[$i + 1];
                $i++;
            }
        }
        return $result;
    }
    public function reverse($params) {
        if (!is_array($params)) {
            return false;
        }
        $requestString = '';
        foreach ($this->patternArr as $value) {
            $nextVal = '';
            if ($this->isParam($value)) {
                $key = $this->cleanParam($value);                
                if (isset($params[$key])) {                    
                    $nextVal = $params[$key];
                    $params[$key] = false;
                } else {                    
                    $nextVal = $this->defaultsArr[$key];                   
                }
            } else {                
                $nextVal = $value;
            }
            $requestString .= '/' . urlencode($nextVal);
        }
        foreach ($params as $key => $val) {
            if (isset($this->defaultsArr[$key]) || false === $params[$key]) {
                continue;
            }
            $requestString .= '/' . urlencode($key) . '/' . urlencode($val);
        }
        return $requestString;
    }


    private function isParam($value) {
        if (0 === stripos($value, self::PARAM_IDENTIFIER)) {
            return true;
        }
        return false;
    }
    private function explodeRequest($request) {
        return explode('/', trim($request, '/'));
    }
    private function cleanParam($param) {
        return ltrim($param, self::PARAM_IDENTIFIER);
    }
}
