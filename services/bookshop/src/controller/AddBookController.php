<?php

require_once 'AppController.php';
require_once __DIR__ . '/../common/utils/AuthUtil.php';
require_once __DIR__.'/../common/constants/Role.php';

require_once __DIR__ . '/../model/request/AddBookReq.php';
require_once __DIR__.'/../repository/BookRepository.php';

class AddBookController extends AppController {

    private $url;

    private BookRepository $bookRepository;

    public function __construct() {
        parent::__construct();
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->bookRepository = new BookRepository();
    }

    public function addBook() {

        $USER_ROLE = $_SESSION["roleId"];

        if (AuthUtil::checkIfAuthorized($USER_ROLE, Role::ROLE_EMPLOYEE) ||
            AuthUtil::checkIfAuthorized($USER_ROLE, Role::ROLE_ADMIN)
        ) {
            if (!$this->isPost()) {
                return $this->render('add-book');
            }

            $title = $_POST['title'];
            $author = $_POST['author'];
            $summary = $_POST['summary'];
            $description = $_POST['description'];
            $slug = strtolower(str_replace(' ', '-', trim($title)));
            $genre = $_POST['genre'];
            $numPages = $_POST['numPages'];
            $language = $_POST['language'];
            $price = $_POST['price'];
            $currency = $_POST['currency'];
            $publisher = $_POST['publisher'];

            $requiredFields = [
                'title' => 'Title',
                'author' => 'Author',
                'summary' => 'Summary',
                'description' => 'Description',
                'genre' => 'Category',
                'numPages' => 'Number of pages',
                'language' => 'Book language',
                'price' => 'Book price',
                'currency' => 'Price currency',
                'publisher' => 'Book publisher'
            ];

            foreach ($requiredFields as $field => $fieldName) {
                if (empty($$field)) {
                    return $this->render('add-book', ['messages' => [$fieldName . ' is required!']]);
                }
            }

            if ($this->bookRepository->checkIfBookExists($title, $slug)) {
                return $this->render('add-book', ['messages' => ['Book already exists in the system!']]);
            }

            $book = new AddBookReq(
                $title,
                $author,
                $summary,
                $description,
                $slug,
                $genre,
                $numPages,
                $language,
                $price,
                $currency,
                $publisher
            );

            if ($this->bookRepository->addBook($book)) {
                return $this->render('add-book', ['messages' => ['Book added!']]);
            } else {
                return $this->render('add-book', ['messages' => ['Operation failed! Try again later.']]);
            }
        }

        die("Wrong URL!");
    }
}