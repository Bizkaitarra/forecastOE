<?php

/**
 * Description of forecastTest
 *
 * @author jggarrido
 */
class forecastOETest extends PHPUnit_Framework_TestCase{
    //Test the results with current XML.
    
    public function test() {
        
        require_once 'clasess/forecastOE.php';
       
        $expected = array(
            1 => array('description' => 'Parcialmente nuboso: entre 2/8 y 4/8 de cielo cubierto','max' => 21,'min' => 15,'url' => '/contenidos/recurso_tecnico/tdtrtc/es_rtc/images/02.gif'),
            2 => array('description' => 'Parcialmente nuboso: entre 2/8 y 4/8 de cielo cubierto','max' => 21,'min' => 15,'url' => '/contenidos/recurso_tecnico/tdtrtc/es_rtc/images/02.gif'),
            3 => array('description' => 'Poco nuboso: entre 1/8 y 2/8 de cielo cubierto','max' => 20,'min' => 10,'url' => '/contenidos/recurso_tecnico/tdtrtc/es_rtc/images/01.gif'),
            
        );
        
        unset ($myForecast);
        $myForecast = new forecastOE();                        
        //VACIO (carga Bilbao)        
        $myForecast->getForecastByName('today');
        $expectedindex = 1;
        $this->assertEquals($expected[$expectedindex]['description'], $myForecast->getDescripcion());
        $this->assertEquals($expected[$expectedindex]['max'], $myForecast->getMaxTemp());
        $this->assertEquals($expected[$expectedindex]['min'], $myForecast->getMinTemp());
        $this->assertEquals($expected[$expectedindex]['url'], $myForecast->getUrlImg());
        
        
        //Bilbao                       
        $myForecast->getForecastByName('today', 'Bilbao');
        $expectedindex = 1;
        $this->assertEquals($expected[$expectedindex]['description'], $myForecast->getDescripcion());
        $this->assertEquals($expected[$expectedindex]['max'], $myForecast->getMaxTemp());
        $this->assertEquals($expected[$expectedindex]['min'], $myForecast->getMinTemp());
        $this->assertEquals($expected[$expectedindex]['url'], $myForecast->getUrlImg());
        
        
        
        unset ($myForecast);
        $myForecast = new forecastOE();        
        //San Sebastián
        $myForecast->getForecastByName('today', 'San Sebastián');
        $expectedindex = 2;
        $this->assertEquals($expected[$expectedindex]['description'], $myForecast->getDescripcion());
        $this->assertEquals($expected[$expectedindex]['max'], $myForecast->getMaxTemp());
        $this->assertEquals($expected[$expectedindex]['min'], $myForecast->getMinTemp());
        $this->assertEquals($expected[$expectedindex]['url'], $myForecast->getUrlImg());
        
        unset ($myForecast);
        $myForecast = new forecastOE();    
        $myForecast->getForecastByName('today', 'Donostia');
        //Donostia
        $expectedindex = 2;
        $this->assertEquals($expected[$expectedindex]['description'], $myForecast->getDescripcion());
        $this->assertEquals($expected[$expectedindex]['max'], $myForecast->getMaxTemp());
        $this->assertEquals($expected[$expectedindex]['min'], $myForecast->getMinTemp());
        $this->assertEquals($expected[$expectedindex]['url'], $myForecast->getUrlImg());
        
        unset ($myForecast);
        $myForecast = new forecastOE();    
        $myForecast->getForecastByName('today', 'Vitoria-Gasteiz');
        //Donostia
        $expectedindex = 3;
        $this->assertEquals($expected[$expectedindex]['description'], $myForecast->getDescripcion());
        $this->assertEquals($expected[$expectedindex]['max'], $myForecast->getMaxTemp());
        $this->assertEquals($expected[$expectedindex]['min'], $myForecast->getMinTemp());
        $this->assertEquals($expected[$expectedindex]['url'], $myForecast->getUrlImg());
        
        unset ($myForecast);
        $myForecast = new forecastOE();    
        $myForecast->getForecastByName('today', 'Vitoria');
        //Donostia
        $expectedindex = 3;
        $this->assertEquals($expected[$expectedindex]['description'], $myForecast->getDescripcion());
        $this->assertEquals($expected[$expectedindex]['max'], $myForecast->getMaxTemp());
        $this->assertEquals($expected[$expectedindex]['min'], $myForecast->getMinTemp());
        $this->assertEquals($expected[$expectedindex]['url'], $myForecast->getUrlImg());
        
        unset ($myForecast);
        $myForecast = new forecastOE();    
        $myForecast->getForecastByName('today', 'Gasteiz');
        //Donostia
        $expectedindex = 3;
        $this->assertEquals($expected[$expectedindex]['description'], $myForecast->getDescripcion());
        $this->assertEquals($expected[$expectedindex]['max'], $myForecast->getMaxTemp());
        $this->assertEquals($expected[$expectedindex]['min'], $myForecast->getMinTemp());
        $this->assertEquals($expected[$expectedindex]['url'], $myForecast->getUrlImg());
        
        
        unset ($myForecast);
        $myForecast = new forecastOE();    
        $myForecast->getForecastByName('today', 'nocorrect');
        //No correct value        
        $this->assertEquals('', $myForecast->getDescripcion());
        $this->assertEquals('', $myForecast->getMaxTemp());
        $this->assertEquals('', $myForecast->getMinTemp());
        $this->assertEquals('', $myForecast->getUrlImg());
        
        
    }
    
    
   
    
    
    
    
    
    
    
}
