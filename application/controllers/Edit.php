<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Edit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        //$this->load->database();
        $this->load->library('form_validation');
        //load the login library
        $this->load->library('ion_auth');
        //load data query model 
        $this->load->model('data_model');
    }

    /**********************/
    /* Položky účetnictví */
    /**********************/    
    //vstupni stranka
    public function index() 
    {
	if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
	}
        $user = $this->ion_auth->user()->row();

        $data["user"] = $user->email;
        $data["res"] = $this->data_model->get_polozky();
        $data['kate'] = $this->data_model->get_kategorie();
        $data['title'] = 'Seznam účetních položek';
        $this->load->view('header_edit', $data);
        $this->load->view('polozky', $data);
        $this->load->view('footer_edit');
    }

    public function insert_polozka()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	
        //pravidla pro vstup formulare - nak to nefacha ... mohl sem si usetrit dalsi opicarny
/*        $this->form_validation->set_rules('polozka', 'Suma', 'required');
	$this->form_validation->set_rules('datum_vz', 'Datum vzniku', 'required');
	$this->form_validation->set_rules('popis', 'Popis operace', 'required');
        $this->form_validation->set_rules('datum_vl', 'Datum vložení', 'required');
        $this->form_validation->set_rules('id_kat', 'Kategorie', 'required');

        if ($this->form_validation->run() == FALSE)
	{
            $data['err'] = $this->form_validation->run();
            $data['msg'] = validation_errors();
            //neco je spatne - nahrej znovu view a chyba by se mela zobrazit na validation_errors()
            $this->load->view('error', $data);
            //redirect('edit');
            
	}
	else
	{   //vstup je v poradku, posli to do DB
 */
 
        $result = $this->data_model->set_polozka($this->input->get("polozka"), $this->input->get("datum_vz"), $this->input->get("popis"), $this->input->get("id_kat"));
        redirect('edit');
//	}
        
    }     

    public function update_polozka_load_form()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
        $user = $this->ion_auth->user()->row();
        $data['kate'] = $this->data_model->get_kategorie();
        $data["user"] = $user->email;
        $data['id'] = $this->input->get('id');
        $data['kategorie'] = $this->input->get('kategorie');
        $data['title'] = "Editace záznamu kategorie";
        $this->load->view('header_edit', $data);        
        $this->load->view('update_polozka', $data);
        $this->load->view('footer_edit');        
    }     

    public function update_polozka()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->update_polozka($this->input->get("id_pol"), $this->input->get("polozka"), $this->input->get("datum_vz"), $this->input->get("popis"), $this->input->get("id_kat"));
        redirect('edit');
    }     

    public function delete_polozka()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->delete_polozka($this->input->get("id"));
        redirect('edit');
    }     
    
    
    
    /***********/
    /* Skupiny */
    /***********/    
    // obalky jsou skupiny vydaju
    
    // !!! IMPORTANT !!!
    // obalka pro prijmy: Příjmy / Prázdná obálka 0 Nemazat - Úvodní obálka nové
    // kategorie nebo příjmy, musi mit v DB id 0 - nastavuju potom podle toho ve 
    // spojovaci tabulce, ze nema zadnou kategorii protoze je nova
    public function obalky()
    {
	if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
	}
        $user = $this->ion_auth->user()->row();

        $result = $this->data_model->get_skupiny();

        if ( ! $result) { //dotaz se nepovedl
            $data['title'] = "Chyba";
            $data['err'] = $this->db->error();
            $user = $this->ion_auth->user()->row();
            $data["user"] = $user->email;
            $this->load->view('header_edit', $data);            
            $this->load->view('error', $data);
            $this->load->view('footer_edit');
        }
        else //dotaz se povedl, pokracuj
        {       
            $data["user"] = $user->email;
            $data["res"] = $result;
            $data['title'] = 'Editovat obálky';
            $this->load->view('header_edit', $data);
            $this->load->view('skupiny', $data);
            $this->load->view('footer_edit');
        }
    }

    
    public function insert_skupina()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->set_skupina($this->input->get("skupina"), $this->input->get("limit_skup"), $this->input->get("popis"));
        
        if ( ! $result) { //dotaz se nepovedl
            $data['title'] = "Chyba";
            $data['err'] = $this->db->error();
            $user = $this->ion_auth->user()->row();
            $data["user"] = $user->email;
            $this->load->view('header_edit', $data);            
            $this->load->view('error', $data);
            $this->load->view('footer_edit');
        }
        else //dotaz se povedl, pokracuj
        {       
            redirect('edit/obalky');
        }
    }     

    public function update_obalka_load_form()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
        $user = $this->ion_auth->user()->row();
        $data["user"] = $user->email;
        $data['id'] = $this->input->get('id');
        $data['skupina'] = $this->input->get('skupina');
        $data['limit_skup'] = $this->input->get('limit_skup');
        $data['popis'] = $this->input->get('popis');
        $data['title'] = "Editace záznamu obálky";
        $this->load->view('header_edit', $data);        
        $this->load->view('update_skupina', $data);
        $this->load->view('footer_edit');        
    }     

    public function update_skupina()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->update_skupina($this->input->get("id"), $this->input->get("skupina"), $this->input->get("limit_skup"), $this->input->get("popis"));
        if ( ! $result) { //dotaz se nepovedl
            $data['title'] = "Chyba";
            $data['err'] = $this->db->error();
            $user = $this->ion_auth->user()->row();
            $data["user"] = $user->email;
            $this->load->view('header_edit', $data);            
            $this->load->view('error', $data);
            $this->load->view('footer_edit');
        }
        else //dotaz se povedl, pokracuj
        {       
            redirect('edit/obalky');
        }
    }     

    public function delete_skupina()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->delete_skupina($this->input->get("id"));
        redirect('edit/obalky');
    }     

    
    /*************/
    /* Kategorie */
    /*************/

    public function kategorie()
    {
	if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
	}
        $user = $this->ion_auth->user()->row();

        $data["user"] = $user->email;
        $data["res"] = $this->data_model->get_kategorie();
        $data['title'] = 'Editovat kategorie';
        
        $this->load->view('header_edit', $data);
        $this->load->view('kategorie', $data);
        $this->load->view('footer_edit');
    }

    public function insert_kategorie()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->set_kategorie($this->input->get("kategorie"));
        if ( ! $result) { //dotaz se nepovedl
            $data['title'] = "Chyba";
            $data['err'] = $this->db->error();
            $user = $this->ion_auth->user()->row();
            $data["user"] = $user->email;
            $this->load->view('header_edit', $data);            
            $this->load->view('error', $data);
            $this->load->view('footer_edit');
        }
        else //dotaz se povedl, pokracuj
        {
            $result2 = $this->data_model->get_new_id_kat($this->input->get("kategorie"));
            $id_kat = $result2[0]["id_kat"];
            $result3 = $this->data_model->insert_new_kat_kategorie_skupiny($id_kat);

            redirect('edit/kategorie');
        }
    }     

    public function update_kategorie_load_form()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
        $user = $this->ion_auth->user()->row();
        $data["user"] = $user->email;
        $data['id'] = $this->input->get('id');
        $data['kategorie'] = $this->input->get('kategorie');
        $data['title'] = "Editace záznamu kategorie";
        $this->load->view('header_edit', $data);        
        $this->load->view('update_kategorie', $data);
        $this->load->view('footer_edit');        
    }     

    public function update_kategorie()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->update_kategorie($this->input->get("id"), $this->input->get("kategorie"));
        
        if ( ! $result) { //dotaz se nepovedl
            $data['title'] = "Chyba";
            $data['err'] = $this->db->error();
            $user = $this->ion_auth->user()->row();
            $data["user"] = $user->email;
            $this->load->view('header_edit', $data);            
            $this->load->view('error', $data);
            $this->load->view('footer_edit');
        }
        else //dotaz se povedl, pokracuj
        {
            redirect('edit/kategorie');
        }
    }     

    public function delete_kategorie()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	$result = $this->data_model->delete_kategorie($this->input->get("id"));
        $result2 = $this->data_model->delete_kategorie_skupiny($this->input->get("id"));
        redirect('edit/kategorie');
    }     


    /**********/
    /* Limity */
    /**********/

/*    public function limity()
    {
	if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
	}
        $user = $this->ion_auth->user()->row();

        $data["user"] = $user->email;
        $data["res"] = $this->data_model->get_limity();
        $data['title'] = 'Editovat limity obálek';
        $this->load->view('header_edit', $data);
        $this->load->view('limity', $data);
        $this->load->view('footer_edit');
        
    }
*/
    
    /********************************/
    /* Prirazeni kategorii a skupin */
    /********************************/

        public function prirazeni()
    {
	if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
	}

        $user = $this->ion_auth->user()->row();
        $data["user"] = $user->email;
//        $data["res"] = $this->data_model->get_prirazeni();
        $data["kat"] = $this->data_model->get_kategorie();        
        $data["skup"] = $this->data_model->get_skupiny();        
        $data["kat_skup"] = $this->data_model->get_kategorie_skupiny();                
        $data['title'] = 'Editovat přiřazení kategorií k obálkám';
        $this->load->view('header_edit', $data);
        $this->load->view('prirazeni', $data);
        $this->load->view('footer_edit');
    }
    
    public function update_prirazeni()
    {
	if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
	}

        $user = $this->ion_auth->user()->row();
        $data["user"] = $user->email;
        $result = $this->data_model->update_kategorie_skupiny($this->input->get("id_kat"), $this->input->get("id_skup"));
        redirect('edit/prirazeni');
        
    }

    
    //odhlaseni
    public function logout()
    {
	if (!$this->ion_auth->logged_in())
	{
            redirect('auth/login');
	}	  	
	     
	$this->ion_auth->logout();	  	
    }     
    
    //export do excelu - pouzivas library : https://github.com/PHPOffice/PHPExcel
    public function export_xlsx() {
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
/*        $this->excel->getActiveSheet()->setTitle('test worksheet');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Pokus funguje :-)');
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
*/
        $this->excel->getActiveSheet()->setCellValue('A1', 'Suma');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);        
        $this->excel->getActiveSheet()->setCellValue('B1', 'Název operace');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);        
        $this->excel->getActiveSheet()->setCellValue('C1', 'Datum účtování');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);        
        $this->excel->getActiveSheet()->setCellValue('D1', 'Datum vložení');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);        
        $this->excel->getActiveSheet()->setCellValue('E1', 'Název kategorie');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);        
        
        $arrayData = $this->data_model->get_polozky_xlsx();
        $this->excel->getActiveSheet()->fromArray(
                $arrayData,  // The data to set
                NULL,        // Array values with this value will not be set
                'A2'         // Top left coordinate of the worksheet range where we want to set these values (default is A1)
        );
                
        $filename = 'ucetnictvi_komplet.xlsx'; //save our workbook as this file name
//        header('Content-Type: application/vnd.ms-excel'); //mime type pro Excel5
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //pro Excel2007
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
//        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//        $objWriter->save('php://output');
        
//nechapu co ma za problem - hlasi ze nema zip class ... ze bych nemel modul? - ano, nebyl modul php-zip pro apache ...
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}
?>