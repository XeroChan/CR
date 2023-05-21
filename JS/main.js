/* var ratio;
var left;
resize();

$(window).resize(function () {resize();});

function resize()
{
    ratio = window.innerHeight / $('body').innerHeight();
    if (window.innerWidth / $('body').innerWidth() < ratio) {
        ratio = window.innerWidth / $('body').innerWidth();
    }
    ratio -= .04;
    $('body').css('-ms-zoom', ratio);
    $('body').css('-moz-transform', 'scale(' + ratio + ')');
    $('body').css('-o-transform', 'scale(' + ratio + ')');
    $('body').css('-webkit-transform', 'scale(' + ratio + ')');
    $('body').css('transform', 'scale(' + ratio + ')');
    left = ($(window).innerWidth() - $('body').outerWidth() * ratio) / 2;
    $('body').css('left', left);
} */
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

