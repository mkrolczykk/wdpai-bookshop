<?php

require_once 'AppController.php';

class BestsellersController extends AppController {

    public function bestsellers()
    {
        $this->render('bestsellers');
    }

}