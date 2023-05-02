<?php

class Lb_Projet_Grand_Module extends Module
{

    //blog (adminController article / frontController affiche les articles)

    //vidéo ficher produit

    //ticket sav

    //galery d'images

    //formulaire intélligent

    //liste de course

    //carte cadeau
    public function __construct()
    {
        $this->name = "lb_projet_grand_module";
        $this->displayName = "Articles de blog";
        $this->version = "1.0.0";
        $this->author = "Lucien";
        $this->description = "article de blog";
        $this->bootstrap = true;

        parent::__construct();
    }

    public function getContent()
    {

        $output = "";

        return $output . $this->displayForm();
    }

    public function displayForm()

    {


        $form_configuration['0']['form'] = [

            'legend' => [
                'title' => $this->l('Configuration')
            ],
            'input' => [

                [
                    'type' => 'textarea',
                    'label' => $this->l('Titre'),
                    'name' => 'LB_TITLE',
                    'required' => true,

                ],

                [
                    'type' => 'textarea',
                    'label' => $this->l('Artticle'),
                    'name' => 'LB_ARTICLE',
                    'autoload_rte' => true,

                ]
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-defult pull-right'
            ]


        ];

        $helper = new HelperForm();

        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->default_form_language = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->title = $this->displayName;
        $helper->submit_action = "submit_" . $this->name;

        $helper->fields_value['LB_ARTICLE'] = Tools::getValue('LB_ARTICLE', Configuration::get('LB_ARTICLE'));
        $helper->fields_value['LB_TITLE'] = Tools::getValue('LB_TITLE', Configuration::get('LB_TITLE'));
        return $helper->generateForm($form_configuration);
    }
}
