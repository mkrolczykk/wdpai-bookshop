<?php


require_once 'AppController.php';

class FindResultsController extends AppController {
    public function findResults()
    {
        $this->render('find-results');
    }

}