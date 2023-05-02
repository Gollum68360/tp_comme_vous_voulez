<?php

class Lb_Comme_Vous_Voulez extends Module
{

    public function __construct()
    {
        $this->name = "lb_comme_vous_voulez";
        $this->displayName = "Avis produits";
        $this->version = "1.0.0";
        $this->author = "Lucien";
        $this->description = "Des avis produits";
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
                    'type' => 'switch',
                    'label' => "Obligation d'être connecter pour commenter",
                    'name' => 'LB_CONNEXION',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Oui')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Non')
                        ),
                    )
                ],
                [
                    'type' => 'switch',
                    'label' => 'Pouvoir noter le produit',
                    'name' => 'LB_NOTE',
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Oui')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Non')
                        ),
                    )
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->l('Commentaire'),
                    'name' => 'LB_COMMENTAIRE',
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

        $helper->fields_value['LB_CONNEXION'] = Tools::getValue('LB_CONNEXION', Configuration::get('LB_CONNEXION'));
        $helper->fields_value['LB_NOTE'] = Tools::getValue('LB_NOTE', Configuration::get('LB_NOTE'));
        $helper->fields_value['LB_COMMENTAIRE'] = Tools::getValue('LB_COMMENTAIRE', Configuration::get('LB_COMMENTAIRE'));
        return $helper->generateForm($form_configuration);
    }
}
