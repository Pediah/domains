// JavaScript for toggle menu
var navLinks = document.getElementById("navLinks");

function showMenu() {
    navLinks.style.right = "0";
}

function hideMenu() {
    navLinks.style.right = "-200px";
}

// JavaScript for showing words one after the other
document.addEventListener("DOMContentLoaded", function() {
    const words = document.querySelectorAll('.word');
    let index = 0;

    function showWord() {
        if (index < words.length) {
            words[index].style.opacity = '1';
            index++;
            setTimeout(showWord, 1000); // Adjust the delay as needed (in milliseconds)
        }
    }

    showWord(); // Start the animation
});

//application form

document.getElementById('upload-btn').addEventListener('click', function() {
    document.getElementById('myfile').click(); // Trigger file input click
});

document.getElementById('myfile').addEventListener('change', function() {
    var fileName = this.value.split('\\').pop(); // Extract file name
    if (fileName) {
        document.getElementById('upload-btn').innerHTML = fileName; // Display file name on button
    }
});