<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    
    /****************************/
    /* Polozky / ucetni zaznamy */
    /****************************/
    
    //datum_vl - datum vlozeni zaznamu - generuje se automaticky, datum_vz - datum, kdy doslo k transakci (utraceni/prijmu)
    public function get_polozky()
    {
        $query = $this->db->query('SELECT id_pol, polozka, datum_vz, popis, datum_vl, cis_kategorie.kategorie, cis_kategorie.id_kat FROM polozky JOIN cis_kategorie ON cis_kategorie.id_kat = polozky.id_kat');
        return $query->result_array();
    }
    
    public function get_polozky_xlsx()
    {
        $query = $this->db->query('SELECT polozka, popis, datum_vz, datum_vl, cis_kategorie.kategorie FROM polozky JOIN cis_kategorie ON cis_kategorie.id_kat = polozky.id_kat');
        return $query->result_array();
    }
    
    public function set_polozka($pol, $dat, $pop, $id_kat)
    {
        $query = $this->db->query('INSERT INTO polozky (polozka, datum_vz, popis, id_kat) VALUES ('. $pol . ', "'. $dat . '", "'. $pop . '", '. $id_kat . ')');
        return $query;
    }

    public function delete_polozka($id)
    {
        $query = $this->db->query('DELETE FROM polozky WHERE id_pol = '. $id);
        return $query;
    }

    public function update_polozka($id_pol, $pol, $dat, $pop, $id_kat)
    {
        $query = $this->db->query('UPDATE polozky SET polozka= ' . $pol . ', datum_vz= \'' . $dat . '\', popis= \'' . $pop . '\', id_kat= ' . $id_kat . ' WHERE id_pol = ' . $id_pol);
        return $query;
    }
    
    

    /********************/
    /* Skupiny / obalky */
    /********************/
    // skupiny jsou obalky ... tos mel ale blbej napad
    public function get_skupiny()
    {
        $query = $this->db->query('SELECT id_skup, skupina, limit_skup, popis FROM cis_skupiny');
        return $query->result_array();
    }

    // vkladam do tabulky cis_skupiny novou hodnotu
    public function set_skupina($skupina, $limit_skup, $popis)
    {
        $query = $this->db->query('INSERT INTO cis_skupiny (skupina, limit_skup, popis) VALUES ("'. $skupina . '", '.$limit_skup.', "'.$popis.'")');
        return $query;
    }

    public function delete_skupina($id)
    {
        $query = $this->db->query('DELETE FROM cis_skupiny WHERE id_skup = '. $id);
        return $query;
    }

    public function update_skupina($id, $skupina, $limit_skup, $popis)
    {
        $query = $this->db->query('UPDATE cis_skupiny SET skupina = \'' . $skupina . '\', limit_skup='.$limit_skup.', popis=\''.$popis.'\' WHERE id_skup = ' . $id);
        return $query;
    }

    
    
    /*************/
    /* Kategorie */
    /*************/
    
    public function get_kategorie()
    {
        $query = $this->db->query('SELECT id_kat, kategorie FROM cis_kategorie');
        return $query->result_array();
    }
    
    // vkladam do tabulky cis_kategorie novou hodnotu
    public function set_kategorie($value)
    {
        $query = $this->db->query('INSERT INTO cis_kategorie (kategorie) VALUES ("'. $value . '")');
        return $query;
    }

    public function delete_kategorie($id)
    {
        $query = $this->db->query('DELETE FROM cis_kategorie WHERE id_kat = '. $id);
        return $query;
    }

    public function get_new_id_kat($value)
    {
        $query = $this->db->query('SELECT id_kat FROM cis_kategorie WHERE kategorie = ("'. $value . '")');
        return $query->result_array();
    }
    
    public function update_kategorie($id, $value)
    {
        $query = $this->db->query('UPDATE cis_kategorie SET kategorie = \'' . $value . '\' WHERE id_kat = ' . $id);
        return $query;
    }


    /*********************************/
    /* Prirazeni kategorii k obalkam */
    /*********************************/
    
    public function get_prirazeni()
    {
        $query = $this->db->query('SELECT cis_skupiny.id_skup, cis_kategorie.id_kat FROM cis_kategorie JOIN kategorie_skupiny ON kategorie_skupiny.id_kat = cis_kategorie.id_kat LEFT JOIN cis_skupiny ON cis_skupiny.id_skup = kategorie_skupiny.id_skup ');
        return $query->result_array();
    }
    
    public function get_kategorie_skupiny() {
        $query = $this->db->query('SELECT id_skup, id_kat FROM kategorie_skupiny');
        return $query->result_array();
    }
    
    public function update_kategorie_skupiny($id_kat, $id_skup) {
        $query = $this->db->query('UPDATE kategorie_skupiny SET id_skup=' . $id_skup . ' WHERE id_kat = ' . $id_kat);
        return $query;
    }
    
    public function insert_new_kat_kategorie_skupiny($id_kat) {
        $query = $this->db->query('INSERT INTO kategorie_skupiny (id_skup, id_kat) VALUES (0, ' . $id_kat . ')');
        return $query;
    }

    public function delete_kategorie_skupiny($id_kat) {
        $query = $this->db->query('DELETE FROM kategorie_skupiny WHERE id_kat = ' . $id_kat);
        return $query;
    }
    

    /********************/
    /* Data za 3 mesice */
    /********************/
    
    public function get_3_months() {
        $query = $this->db->query('SELECT sum(polozka) AS CelkoveVydaje, cis_kategorie.kategorie AS Kategorie FROM polozky JOIN cis_kategorie ON cis_kategorie.id_kat = polozky.id_kat GROUP BY Kategorie ORDER BY CelkoveVydaje DESC');
        return $query->result_array();
    }
    public function get_obalky_vydaje_3_months() {
        $query = $this->db->query('SELECT SUM(polozky.polozka) AS vydajeCelkem, cis_skupiny.skupina AS skup, cis_skupiny.limit_skup FROM polozky JOIN kategorie_skupiny ON kategorie_skupiny.id_kat = polozky.id_kat JOIN cis_skupiny ON cis_skupiny.id_skup = kategorie_skupiny.id_skup GROUP BY skup');
        return $query->result_array();
    }
    
    
}
?>