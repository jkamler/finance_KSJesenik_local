<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Overview extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->library('form_validation');
        //load the login library
        $this->load->library('ion_auth');
        //load data query model 
        $this->load->model('data_model');
    }

    public function index()
    {
        
        $data["title"] = "Přehled financí - 3 měsíce";
        
        //zpracovani dat pro graf porovnani prijmu a vydaju a celkovych prijmu a vydaju za jednotlive kategorie
        $celkoveVydaje = '';
        $kategorie = '';
        $counter = 1;
        $sumVydaje = 0;
        $sumPrijmy = 0;
        foreach ($this->data_model->get_3_months() as $value) {
            //spocitam si na zaklade kladneho nebo zaporneho znamenka jestli je to vydaj nebo prijem a celkove to sectu
            //vydaje pak vynasobim -1, aby se daly pomerovat vizualne grafy - data pro graf porovnání příjmů a výdajů
            if ($value['CelkoveVydaje'] < 0) {
                $sumVydaje += $value['CelkoveVydaje'];
            } else {
                $sumPrijmy += $value['CelkoveVydaje'];
            }
            // pripojuju carky za udaji, kdyz mam posledni, tak tam carka nepatri - je to napln pole
            if ($counter <> count($this->data_model->get_3_months())){
                $counter++;
                $celkoveVydaje .= $value['CelkoveVydaje'].',';
                $kategorie .= "'".$value['Kategorie']."' ,";
                continue;
            }
            $celkoveVydaje .= $value['CelkoveVydaje'];
            $kategorie .= "'".$value['Kategorie']."'";
        }
        $data1['sumVydaje'] = $sumVydaje * -1;
        $data1['sumPrijmy'] = $sumPrijmy;
        $data1['vydaje_prijmy'] = "'Celkové příjmy', 'Celkové výdaje'";
        $data1["celkoveVydaje"] = $celkoveVydaje;
        $data1["kategorie"] = $kategorie;

        
        //zpracovani dat pro graf s obalkama - vydaje za obalku a jeji limity
        $counter = 1;
        $vydajeZaObalky = '';
        $obalky = ''; //obalky jsou skupiny - nazvy
        $limity = ''; //limity obalek
        $red = ''; //retezec do grafu porovnani obalek s limity - barvy limitu - 2. serie v grafu
        foreach ($this->data_model->get_obalky_vydaje_3_months() as $value) {
            // pripojuju carky za udaji, kdyz mam posledni, tak tam carka nepatri - je to napln pole
            if ($counter <> count($this->data_model->get_obalky_vydaje_3_months())){
                $counter++;
                $vydajeZaObalky .= abs($value['vydajeCelkem']).',';
                $obalky .= "'".$value['skup']."' ,";
                $limity .= $value['limit_skup'].',';
                $red .= "'red' , ";
                continue;
            }
                $vydajeZaObalky .= abs($value['vydajeCelkem']);
                $obalky .= "'".$value['skup']."'";
                $limity .= $value['limit_skup'];
                $red .= " 'red'";
                
        }
        $data1['vydajeZaObalky'] = $vydajeZaObalky;
        $data1['obalky'] = $obalky;
        $data1['limity'] = $limity;
        $data1['red'] = $red;
        
        $this->load->view("header_overview", $data);
        $this->load->view("overview3m", $data1);
        $this->load->view("footer_overview");
           
    }
     
    public function sestmesicu()
    {
        $data["title"] = "Přehled financí - 6 měsíců";
        
        $this->load->view("header_overview", $data);
        $this->load->view("overview6m");
        $this->load->view("footer_overview");
    }
    
    public function jedenrok()
    {
        $data["title"] = "Přehled financí - 1 rok";
        
        $this->load->view("header_overview", $data);
        $this->load->view("overview1r");
        $this->load->view("footer_overview");
    }
    
    public function dvaroky()
    {
        $data["title"] = "Přehled financí - 2 roky";
        
        $this->load->view("header_overview", $data);
        $this->load->view("overview2r");
        $this->load->view("footer_overview");
    }

}
?>