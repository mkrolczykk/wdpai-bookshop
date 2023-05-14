class CartItem {

    increaseAmountEndpoint = "http://localhost:8180/api/v1/cart/increase-amount-of-book.php";

    decreaseAmountEndpoint = "http://localhost:8180/api/v1/cart/decrease-amount-of-book.php";

    removeFromCartEndpoint = "http://localhost:8180/api/v1/cart/remove-from-shopping-cart.php";

    constructor(element) {
        this.element = element;
        this.plusButton = element.querySelector(".plus");
        this.minusButton = element.querySelector(".minus");
        this.removeButton = element.querySelector(".remove-button");
        this.amountElement = element.querySelector(".amount");
        this.priceElement = element.querySelector(".price");
        this.totalElement = element.querySelector(".total");
        this.bookId = parseInt(this.plusButton.dataset.bookId);
        this.amount = parseInt(this.amountElement.innerText);
        this.price = parseFloat(this.priceElement.innerText);

        this.plusButton.addEventListener("click", this.increaseAmount.bind(this));
        this.minusButton.addEventListener("click", this.decreaseAmount.bind(this));
        this.removeButton.addEventListener("click", this.removeFromCart.bind(this));
    }

    increaseAmount() {
        this.callIncreaseAmountEndpoint();
        this.amount++;
        this.amountElement.innerText = this.amount;
        this.updateTotalValue();
        this.updateCartTotalAmount();
    }

    decreaseAmount() {
        if (this.amount > 1) {
            this.callDecreaseAmountEndpoint();
            this.amount--;
            this.amountElement.innerText = this.amount;
            this.updateTotalValue();
            this.updateCartTotalAmount();
        }
    }

    removeFromCart() {
        this.callRemoveFromCartEndpoint();
        this.element.remove();
        this.updateCartTotalAmount();
    }

    updateTotalValue() {
        const total = this.amount * this.price;
        this.totalElement.textContent = total.toFixed(2);
    }

    updateCartTotalAmount() {
        const cartItems = document.querySelectorAll(".cart-row");
        let cartTotalAmount = 0;
        cartItems.forEach((item) => {
            const priceElement = item.querySelector(".price");
            const amountElement = item.querySelector(".amount");
            const price = parseFloat(priceElement.innerText);
            const amount = parseInt(amountElement.innerText);
            const total = price * amount;
            item.querySelector(".total").innerText = total.toFixed(2);
            cartTotalAmount += total;
        });

        const cartTotalAmountElement = document.getElementById("cartTotalAmount");
        cartTotalAmountElement.innerText = cartTotalAmount.toFixed(2);
    }

    callIncreaseAmountEndpoint() {
        fetch(this.increaseAmountEndpoint, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                bookId: this.bookId,
            }),
        })
            .then((response) => response.json())
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    callDecreaseAmountEndpoint() {
        fetch(this.decreaseAmountEndpoint, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                bookId: this.bookId,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }


    callRemoveFromCartEndpoint() {
        fetch(this.removeFromCartEndpoint, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                bookId: this.bookId,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
}

const cartItems = document.querySelectorAll(".cart-row");

cartItems.forEach((item) => new CartItem(item));
