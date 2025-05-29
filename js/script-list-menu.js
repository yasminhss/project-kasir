// JavaScript for List Menu

const menuData = [
    { id: 1, name: "Nasi Tutug Oncom + Ayam Goreng", category: "makanan", image: "" },
    { id: 2, name: "Nasi Ayam Penyet", category: "makanan", image: "" },
    { id: 3, name: "Nasi Tutug Oncom + Cumi Sambal Ijo", category: "makanan", image: "" },
    { id: 4, name: "Nasi Tutug Oncom + Telur Dadar", category: "makanan", image: "" },
    { id: 5, name: "Nasi Tutug Oncom + Ayam Bakar", category: "makanan", image: "" },
    { id: 6, name: "Nasi Lengko", category: "makanan", image: "" },
    { id: 7, name: "Nasi Soto Ayam", category: "makanan", image: "" },
    { id: 8, name: "Nasi Lengko + Telur Dadar", category: "makanan", image: "" },
    { id: 9, name: "Nasi Tutug Oncom", category: "makanan", image: "" },
    { id: 10, name: "Nasi Puti", category: "makanan", image: "" },
    { id: 11, name: "Es Teh Manis", category: "minuman", image: "" },
    { id: 12, name: "Es Teh Poci", category: "minuman", image: "" },
    { id: 13, name: "Es Susu Bendera", category: "minuman", image: "" },
    { id: 14, name: "Es Nutrisari", category: "minuman", image: "" },
    { id: 15, name: "Es Milo", category: "minuman", image: "" },
    { id: 16, name: "Air Mineral", category: "minuman", image: "" },
    { id: 17, name: "Teh Tawar", category: "minuman", image: "" },
    { id: 18, name: "Cilok original", category: "Cilok", image: "" },
    { id: 19, name: "Cilok Ceker", category: "Cilok", image: "" },
    { id: 20, name: "Cilok Goang Ayam", category: "Cilok", image: "" },
    { id: 21, name: "Cilok Lemak Sapi", category: "Cilok", image: "" },
    { id: 22, name: "Cilok Telur Puyuh", category: "Cilok", image: "" },
    { id: 23, name: "Cilok Keju", category: "Cilok", image: "" },
];

const menuList = document.getElementById("menu-list");
const filterCategory = document.getElementById("filter-category");

// Render menu data
function renderMenu(category = "all") {
    const filteredMenu = menuData.filter(item => category === "all" || item.category === category);
    menuList.innerHTML = filteredMenu
        .map(
            (item, index) => `
        <tr>
            <td>${index + 1}.</td>
            <td>${item.name}</td>
            <td>${item.category}</td>
            <td><div style="width: 50px; height: 50px; background-color: #ddd; border-radius: 5px;"></div></td>
            <td>
                <button class="action-button edit">Edit</button>
                <button class="action-button delete">Hapus</button>
            </td>
        </tr>
        `
        )
        .join("");
}

// Filter menu based on category
filterCategory.addEventListener("change", () => renderMenu(filterCategory.value));

// Initial render
renderMenu();