$(document).ready(function() {
    const searchButton = $('#searchButton');
    const searchBar = $('#searchBar');
    const database = $('#database');

    searchButton.click(function(event) {
        event.preventDefault();
        const query = searchBar.val().trim();

        if (query !== '') {
            event.preventDefault();
            $.ajax({
                url: '../PHP/search.php',
                type: 'GET',
                data: { query: query },
                success: function(result) {
                    database.html(result);
                },
                error: function() {
                    console.log('Wystąpił błąd podczas wyszukiwania');
                }
            });
        }
    });
});

