<?php
    class Public_Controller extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            
            //MODELOS QUE SE CARGAN POR DEFAULT
            $this->load->model("producto_model");
            $this->load->model("web_menu_model");
            $this->load->model("catalogo_model");
            
            $this->data['path'] = base_url()."public/theme/default/index_files/";
            $this->data['css_container'] ="";
            
            //CONFIGURACIONES PARA EL CONTROLLADOR APP
            if($this->web_controller =="app"){
                if($this->web_method=="index"){
                    $this->data['css_container'] = "home";
                    //CARGA LA LISTA PARA REALIZAR LAS BUSQUEDAS. SE ACTUALIZA CADA VEZ QUE SE ACCEDE A LA PAGINA PRINCIPAL 
                    $_SESSION['daltile_mx_busqueda_lista'] = $this->producto_model->get_data_autocomplete();
                }
                if(in_array($this->web_method,array('productos','pdetalle','buscar'))) $this->data['css_container'] = "product-detail";
                if($this->web_method =="pdetalle") $this->data['css'] = link_tag ($this->data['path']."newPages.css");
                
            }
            
            //EN CASO DE NO HABERSE CARGADO LA LISTA DE BUSQUEDA SE CARGA. APLICA CUANDO EL USUARIO ENTRA POR OTRA VIA 
            //QUE NO SE LA PAGINA PRINCIPAL.
            if(!$_SESSION['daltile_mx_busqueda_lista']){
                $_SESSION['daltile_mx_busqueda_lista'] = $this->producto_model->get_data_autocomplete();
            }
            
            //VARIABLES DE SESSION QUE ENVIAN MENSAJES
            if($_SESSION['success']){
                $this->data['success'] = $_SESSION['success'];
                unset($_SESSION['success']);
            }
            if($_SESSION['error']){
                $this->data['error'] = $_SESSION['error'];
                unset($_SESSION['error']);
            }

            if($_SESSION['msg']){
                $this->data['msg'] = $_SESSION['msg'];
                unset($_SESSION['msg']);
            }

            $this->data['webconfig'] = null; //$this->webconfig_model->get_data(1);
            
            //VARIABLES PARA CONTROLLAR EL MENU PRINCIPAL Y SUBMENUS, SEGUN APLIQUEN.
            if($_GET['m']) $_SESSION['daltile_menu_principal_id'] = (int)$_GET['m'];
            if($_GET['op']) $_SESSION['daltile_opcion_id'] = (int)$_GET['op'];
            
            $this->menu_principal_id = $_SESSION['daltile_menu_principal_id'];
            $this->menu_opcion_id = $_SESSION['daltile_opcion_id'];
            
            
            /*
            $this->load->model("web_page_model","WebPagina");
            $this->load->model("web_banner_imagen_model","WebBannerImagen");
            $this->load->model("web_config_model","WebConfig");
            $this->load->model("product_model");

            $pgConfig = $this->WebConfig->get_data();
            
            
            $this->banner_active = $pgConfig['banner_active'];
            $this->pagina_inicio = $pgConfig['initial_page'];//2;
            $this->pagina_contacto = $pgConfig['contact_page']; //9;

            $this->data['arrMenu']  = $this->WebPagina->get_menu();
            $this->data['product_page_id'] = 13;
            $this->data['arrProductMenu'] = $this->product_model->get_menu_list();
            $this->data['arrImage'] = $this->WebBannerImagen->get_list(array('WHERE'=>"web_banner_id = '".$this->banner_active ."'" ));*/
            
            
            
        }
    }