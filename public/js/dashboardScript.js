let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

sidebarBtn.onclick = function () {
    sidebar.classList.toggle("active");
    console.log(sidebar.classList);

    if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
};

const imageInput = document.getElementById('ProfilePic');
const imageOutput = document.getElementById('output');
imageInput.onchange = evt => {
    const [file] = imageInput.files;
    if (file) {
        imageOutput.src = URL.createObjectURL(file);
    }

}
