<?php

require_once 'AppController.php';
require_once __DIR__ . '/../common/utils/AuthUtil.php';
require_once __DIR__.'/../common/constants/Role.php';

require_once __DIR__ . '/../model/request/AddBookReq.php';
require_once __DIR__.'/../repository/BookRepository.php';

class AddBookController extends AppController {

    private $url;

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];

    const UPLOAD_DIRECTORY = '/../public/img/books/';

    private array $message = [];

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
            if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

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

                    move_uploaded_file(
                        $_FILES['file']['tmp_name'],
                        dirname(__DIR__) . self::UPLOAD_DIRECTORY . $slug . '.png'
                    );

                    return $this->render('add-book', ['messages' => ['Book added!']]);
                } else {
                    return $this->render('add-book', ['messages' => ['Operation failed! Check input data and try again.']]);
                }

                return $this->render('add-book', [
                    'messages' => $this->message
                ]);
            }

            return $this->render('add-book', [
                'messages' => $this->message
            ]);
        }
        die("Wrong URL!");
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}