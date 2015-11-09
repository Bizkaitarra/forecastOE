<?php

/**
 * Class to work with open data euskadi forecast
 *
 * @author Jon Gonzalez Garrido
 * 
 */
class forecastOE {
    private $descripcion = '';
    private $urlImg = '';
    private $maxTemp = '';
    private $minTemp = '';
    private $lang = 'es';
    private $xmlURL = 'http://opendata.euskadi.eus/contenidos/prevision_tiempo/met_forecast/opendata/met_forecast.xml';
    private $xml;
	
    /**
     * Constructor in which the XML is loaded and optionally languaje is loaded.
     * @param type $idioma
     */
    function __construct($idioma = 'es') {			
                    if (in_array($idioma, array('es','eu')) ) {
                            $this->lang = $idioma;
                    }
        $this->xml = simplexml_load_file($this->xmlURL);	   
    }


    /**
     * Gets the description
     * @return String returns the description
     */
    function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Gets the image URL
     * @return String returns the image URL
     */
    function getUrlImg() {
        return $this->urlImg;
    }

    /**
     * Gets the maximum temperature
     * @return String returns the maximum temperature
     */
    function getMaxTemp() {
        return $this->maxTemp;
    }

    /**
     * Gets the minimum temperature
     * @return String returns the minimum temperature
     */
    function getMinTemp() {
        return $this->minTemp;        
    }

    
    
    /**
     * Gets the city name allowing diferent arguments for the same output.
     * With this function you can allow new arguments for city names if you
     * think that the user may write it wrong.
     * @param String $cityName City name
     * @return boolean|string returns false or the city correct name.
     */
    private function getValidCityName($cityName) {
            switch (ucfirst($cityName)) {
                    case 'Bilbao':
                    case 'Bilbo':
                            $cityName = 'Bilbao';
                            break;
                    case 'Donostia':
                    case  'San Sebastián' :
                    case  'San Sebastian' :
                    case  'Donostia-San Sebastián':
                    case  'Donostia-San Sebastian':
                            $cityName = 'Donostia-San Sebastián';
                            break;
                    case 'Vitoria-Gasteiz' :
                    case  'Vitoria' :
                    case  'Gasteiz':
                            $cityName = 'Vitoria-Gasteiz';
                            break;
                    default:                        
                            return false;
                            break;
            }
            return $cityName;
    }   
    
    /**
     * Gets the forecast of the day and city specified
     * @param String $day The day to search
     * @param type $city The city to search
     * @return string returns the forecast in text
     */
    public function getTxtForecast($day = 'today', $city = 'Bilbao') {

        if (!is_numeric($city)) {
                $cityName = $this->getValidCityName($city);
                if ($cityName) {
                        $this->getForecastByName($day, $cityName);
                } else {
                        switch ($this->lang) {
                        case 'es':
                                $msg = 'No se ha especificado una ciudad o codigo correctos.';
                                $msg .= "\n". 'Nombres validos:';
                                $msg .= "\n". 'Bilbao o Bilbo:';
                                $msg .= "\n". 'Donostia-San Sebastian o Donostia o San Sebastian:';
                                $msg .= "\n". 'Vitoria-Gasteiz o Vitoria o Gasteiz';
                                $msg .= "\n". 'Códigos correctos:';
                                $msg .= "\n". 'Bilbao: 2';
                                $msg .= "\n". 'San Sebastián: 18';
                                $msg .= "\n". 'Vitoria-Gasteiz: 19';
                                return $msg;
                                break;
                        case 'eu':
                                $msg = 'Ez da hiri izen edo kode zuzenik eman.';
                                $msg .= "\n". 'Izen zuzenak:';
                                $msg .= "\n". 'Bilbao edo Bilbo:';
                                $msg .= "\n". 'Donostia-San Sebastian edo Donostia edo San Sebastian:';
                                $msg .= "\n". 'Vitoria-Gasteiz edo Vitoria edo Gasteiz';
                                $msg .= "\n". 'Kode zuzenak:';
                                $msg .= "\n". 'Bilbo: 2';
                                $msg .= "\n". 'Donostia: 18';
                                $msg .= "\n". 'Vitoria-Gasteiz: 19';
                                return $msg;
                                break;
                        default:
                                return '';
                                break;
                        }
                }
        } else {
                $this->getForecastByCode($day, $city);
        }

        //We can return the forecast
        switch ($this->lang) {
        case 'es':
                $msg = "La prevision es la siguiente:";
                $msg .= "\n" . $this->getDescripcion();
                $msg .= "\n". "\n" . "Temperatura máxima " . $this->getMaxTemp() . " grados y mínimas de " . $this->getMinTemp()." grados";			
                return $msg;
                break;
        case 'eu':
                $msg = "Eguraldi iragarpena honakoa da:";
                $msg .= "\n" . $this->getDescripcion();
                $msg .= "\n". "\n" . $this->getMaxTemp() . " gradutako tenperatura maximoa eta " . $this->getMinTemp()."gradutako minimoa";	
                return $msg;
                break;
        default:
                return '';
                break;
        }
    }

    /**
     * Gets the forecast by city name.
     * @param Sring $day Day to search
     * @param String $cityName City to search
     */
    public function getForecastByName($day = 'today', $cityName = 'Bilbao') {
            
            $cityName = $this->getValidCityName($cityName);
            if ($cityName ) {
                $xpathBase = "//weatherForecast/forecasts/forecast[@forecastDay='".$day."']/cityForecastDataList/cityForecastData[@cityName='".$cityName."']";		
                $this->getForecast($xpathBase);
            } else {
                return null;
            }
    }

    /**
     * Gets the forecast by city code.
     * @param String $day Day to search
     * @param Integer $cityCode City code to search
     */
    public function getForecastByCode($day = 'today', $cityCode = 2) {
            $cityName = ucfirst($cityName);
            $xpathBase = "//weatherForecast/forecasts/forecast[@forecastDay='".$day."']/cityForecastDataList/cityForecastData[@cityCode='".$cityCode."']";		
            $this->getForecast($xpathBase);
    }

    /**
     * Gets the forecast of the path specified.
     * @param String $xpathBase The path of the XML including city and day.
     */
    private function getForecast ($xpathBase) {					
            $this->descripcion = $this->getXpath($xpathBase."/symbol/descriptions/".$this->lang);

            $this->urlImg = $this->getXpath($xpathBase."/symbol/symbolImage");		
            $this->maxTemp = $this->getXpath($xpathBase."/tempMax");		
            $this->minTemp = $this->getXpath($xpathBase."/tempMin");

    }

    
    /**
     * Gets the value of the Xpath specified.
     * @param String $path
     * @return boolean
     */
    private function getXpath ($path)  {
            $return = $this->xml->xpath($path);
            if (is_array($return)) {
                    if (count($return) == 1) {
                            $result = $return[0];                                                        
                            return (String)$result;
                            
                    } else {
                            return false;
                    }
            } else {
                    return false;
            }
    }
	
}
