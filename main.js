$(document).ready(function () {
    $("#generate").click(function () {
        $.ajax({
            dataType: "JSON",
            type: "GET",
            url: "https://geek-jokes.sameerkumar.website/api?format=json",
            success: function (datas) {
                const jokeContainer = document.getElementById('joke-container');
                const jokeElement = document.getElementById('joke');

                jokeElement.textContent = datas.joke;
                jokeContainer.style.display = 'block';
                $("#generate").hide();
            },
            error: function () {
                alert("Error, server není dostupný");
            }
        });
    });
});


$(document).ready(function () {
    $("#new").click(function () {
        $.ajax({
            dataType: "JSON",
            type: "GET",
            url: "https://geek-jokes.sameerkumar.website/api?format=json",
            success: function (datas) {
                const jokeContainer = document.getElementById('joke-container');
                const jokeElement = document.getElementById('joke');

                jokeElement.textContent = datas.joke;
                jokeContainer.style.display = 'block';
                $("#generate").hide();
            },
            error: function () {
                alert("Error, server není dostupný");
            }
        });
    })
});