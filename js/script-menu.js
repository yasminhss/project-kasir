const menuData = [
    { name: "Nasi Tutug Oncom + Ayam Goreng", price: 15000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Ayam Penyet", price: 15000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Tutug Oncom + Cumi Sambal Ijo", price: 14000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Tutug Oncom + Telur Dadar", price: 10000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Tutug Oncom + Ayam Bakar", price: 15000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Lengko", price: 12000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Soto Ayam", price: 12000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Lengko + Telur Dadar", price: 10000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Tutug Oncom", price: 4000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Nasi Putih", price: 3000, category: "Makanan", image: "https://via.placeholder.com/150" },
    { name: "Es Teh Manis", price: 3000, category: "Minuman", image: "https://via.placeholder.com/150" },
    { name: "Es Teh Poci", price: 3000, category: "Minuman", image: "https://via.placeholder.com/150" },
    { name: "Es Susu Bendera", price: 4000, category: "Minuman", image: "https://via.placeholder.com/150" },
    { name: "Es Nutrisari", price: 5000, category: "Minuman", image: "https://via.placeholder.com/150" },
    { name: "Es Milo", price: 4000, category: "Minuman", image: "https://via.placeholder.com/150" },
    { name: "Air Mineral", price: "Gratis", category: "Minuman", image: "https://via.placeholder.com/150" },
    { name: "Teh Tawar", price: "Gratis", category: "Minuman", image: "https://via.placeholder.com/150" },
    { name: "Cilok Original", price: 5000, category: "Camilan", image: "https://via.placeholder.com/150" },
    { name: "Cilok Ceker", price: 7000, category: "Camilan", image: "https://via.placeholder.com/150" },
    { name: "Cilok Goang Ayam", price: 5000, category: "Camilan", image: "https://via.placeholder.com/150" },
    { name: "Cilok Lemak Sapi", price: 5000, category: "Camilan", image: "https://via.placeholder.com/150" },
    { name: "Cilok Telur Puyuh", price: 5000, category: "Camilan", image: "https://via.placeholder.com/150" },
    { name: "Cilok Keju", price: 5000, category: "Camilan", image: "https://via.placeholder.com/150" },
];

const menuGrid = document.getElementById("menu-grid");
const categoryFilter = document.getElementById("category-filter");
const cartItems = document.getElementById("cart-items");
const totalPriceElement = document.getElementById("total-price");
const dineInBtn = document.getElementById("dine-in-btn");
const takeAwayBtn = document.getElementById("take-away-btn");
const cancelOrderBtn = document.getElementById("cancel-order");
const saveBillBtn = document.getElementById("save-bill");
const printBillBtn = document.getElementById("print-bill");
const payButton = document.getElementById("pay-button");
const paymentModal = document.getElementById("payment-modal");
const qrisModal = document.getElementById("qris-modal");
const successModal = document.getElementById("success-modal");
const qrisButton = document.getElementById("qris-button");
const cashButton = document.getElementById("cash-button");
const cancelQrisButton = document.getElementById("cancel-qris");
const finishQrisButton = document.getElementById("finish-qris");
const closeSuccessButton = document.getElementById("close-success");

let cart = [];
let totalPrice = 0;

function renderMenu(category = "all") {
    const filteredMenu = menuData.filter(item => category === "all" || item.category === category);
    menuGrid.innerHTML = filteredMenu.map(item => `
        <div class="menu-item">
            <img src="${item.image}" alt="${item.name}">
            <h4>${item.name}</h4>
            <p>Rp ${item.price}</p>
            <button onclick="addToCart('${item.name}', ${item.price})">Tambah</button>
        </div>
    `).join("");
}

function addToCart(name, price) {
    cart.push({ name, price });
    updateCart();
}

function updateCart() {
    cartItems.innerHTML = cart.map((item, index) => `
        <div class="cart-item">
            <span>${item.name} - Rp ${item.price}</span>
            <button class="remove-btn" onclick="removeFromCart(${index})">✖</button>
        </div>
    `).join("");
    totalPrice = cart.reduce((sum, item) => sum + item.price, 0);
    totalPriceElement.textContent = totalPrice;
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
}

function cancelOrder() {
    cart = [];
    updateCart();
}

function setMode(mode) {
    dineInBtn.classList.remove("active");
    takeAwayBtn.classList.remove("active");
    if (mode === "dine-in") dineInBtn.classList.add("active");
    if (mode === "take-away") takeAwayBtn.classList.add("active");
}

function saveBill() {
    alert("Bill disimpan");
}

function printBill() {
    alert("Bill dicetak");
}

// Function to show the Payment modal
function showPaymentModal() {
    paymentModal.style.display = "flex";
}

// Function to hide the Payment modal
function hidePaymentModal() {
    paymentModal.style.display = "none";
}

// Function to show the QRIS modal
function showQrisModal() {
    qrisModal.style.display = "flex";
    hidePaymentModal();
}

// Function to hide the QRIS modal
function hideQrisModal() {
    qrisModal.style.display = "none";
}

// Function to show the Success modal and set payment method dynamically
function showSuccessModal(paymentMethod) {
    hidePaymentModal(); // Hide Payment modal
    hideQrisModal(); // Hide QRIS modal

    // Update the title in the Success modal based on the payment method
    const successTitle = document.querySelector("#success-modal h2");
    successTitle.textContent = paymentMethod; // Update to QRIS or Tunai

    successModal.style.display = "flex"; // Show Success modal
}

// Function to hide the Success modal
function hideSuccessModal() {
    successModal.style.display = "none";
}

// Attach event listeners
payButton.addEventListener("click", showPaymentModal);
qrisButton.addEventListener("click", showQrisModal);
cashButton.addEventListener("click", () => showSuccessModal("Tunai")); // Show Success modal for Cash
cancelQrisButton.addEventListener("click", hideQrisModal);
finishQrisButton.addEventListener("click", () => showSuccessModal("QRIS")); // Show Success modal for QRIS
closeSuccessButton.addEventListener("click", hideSuccessModal);

categoryFilter.addEventListener("change", () => renderMenu(categoryFilter.value));
dineInBtn.addEventListener("click", () => setMode("dine-in"));
takeAwayBtn.addEventListener("click", () => setMode("take-away"));
cancelOrderBtn.addEventListener("click", cancelOrder);
saveBillBtn.addEventListener("click", saveBill);
printBillBtn.addEventListener("click", printBill);

renderMenu();