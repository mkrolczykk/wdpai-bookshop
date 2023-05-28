// Test environment
const HOST = 'localhost';
const PORT = '8180';
const baseURL = 'http://' + HOST + ':' + PORT + '/api/v1/';

// book detail
const addToShoppingCartEndpoint = baseURL + 'cart/add-to-shopping-cart.php';

// menu
const getShoppingCartItemsCountEndpoint = baseURL + 'cart/get-shopping-cart-items-count.php';

// shopping cart
const increaseAmountEndpoint = baseURL + "cart/increase-amount-of-book.php";
const decreaseAmountEndpoint = baseURL + "cart/decrease-amount-of-book.php";
const removeFromCartEndpoint = baseURL + "cart/remove-from-shopping-cart.php";
const submitOrderEndpoint  = baseURL + "cart/submit-order.php";

