$('#close').click(function (e) {
    $('#notification').hide();
});

$('#submit').click(function (e) {
    $('#isClicked').val("true");
});

const accordion = document.getElementsByClassName('container');

for (let i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener('click', function () {
        this.classList.toggle('active')
    })
}

$(function () {
    $('[data-bs-toggle="tooltip"]').tooltip()
})














