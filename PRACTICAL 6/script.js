
let events = [];
let filteredEvents = [];

let currentPage = 1;
let recordsPerPage = 6;

fetch("events.json")
    .then(response => {
        if (!response.ok) {
            throw new Error("Failed to load JSON file");
        }

        return response.json();
    })
    .then(data => {
        events = data;
        filteredEvents = events;

        document.getElementById("loading").style.display = "none";

        displayEvents();
    })
    .catch(error => {
        document.getElementById("loading").style.display = "none";
        document.getElementById("error").innerText = error.message;
    });


function displayEvents() {

    let start = (currentPage - 1) * recordsPerPage;
    let end = start + recordsPerPage;

    let pageEvents = filteredEvents.slice(start, end);

    let output = "";

    pageEvents.map(event => {

        output += `
            <div class="event">
                <h2>${event.name}</h2>
                <p><b>Category:</b> ${event.category}</p>
                <p><b>Date:</b> ${event.date}</p>
                <p><b>Venue:</b> ${event.venue}</p>
            </div>
        `;
    });

    document.getElementById("eventList").innerHTML = output;

    displayPagination();
}


function searchAndFilter() {

    let searchText = document.getElementById("search").value.toLowerCase();
    let category = document.getElementById("category").value;

    filteredEvents = events.filter(event => {

        let matchesSearch = event.name.toLowerCase().includes(searchText);

        let matchesCategory =
            category === "all" || event.category === category;

        return matchesSearch && matchesCategory;
    });

    sortEvents();

    currentPage = 1;

    displayEvents();
}


function sortEvents() {

    let sortValue = document.getElementById("sort").value;

    if (sortValue === "asc") {
        filteredEvents.sort((a, b) =>
            new Date(a.date) - new Date(b.date)
        );
    }

    if (sortValue === "desc") {
        filteredEvents.sort((a, b) =>
            new Date(b.date) - new Date(a.date)
        );
    }
}


function displayPagination() {

    let totalPages = Math.ceil(
        filteredEvents.length / recordsPerPage
    );

    let output = "";

    for (let i = 1; i <= totalPages; i++) {

        output += `
            <button onclick="changePage(${i})">
                ${i}
            </button>
        `;
    }

    document.getElementById("pagination").innerHTML = output;
}


function changePage(page) {

    currentPage = page;

    displayEvents();
}


document.getElementById("search")
    .addEventListener("input", searchAndFilter);

document.getElementById("category")
    .addEventListener("change", searchAndFilter);

document.getElementById("sort")
    .addEventListener("change", searchAndFilter);

