
//This code for admin sidebar in mobile and tablet devices
//selectors
const siderbarToggler = document.querySelector("#toggleSidebar");
const siderbar = document.querySelector(".sidebar__container");

//addevent
siderbarToggler.addEventListener("click", () => {
    siderbar.classList.toggle("unset_margin");
});


const editBtn = document.querySelector("#editBtn");
const postCheck = document.querySelectorAll(".post-check");

const checkPosts = () => {
    postCheck.forEach(post => {
        
        if (!post.checked) {
            post.checked = true;
        } else {
            post.checked = false;
        }
    });
}


const warnBeforeDelete = (e) => {
    
    if (!confirm("Are you sure you wanna delete?")) {
        e.preventDefault();
    }
}