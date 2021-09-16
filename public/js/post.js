

//little jQuery code for commenting errors for showing waring
$('.alert').alert();

//selectors for making likes
const heart = document.querySelector(".heart");
const heartCount = document.querySelector("#heart-count");

//like async function is used for making likes for current the post
const like = async (e) => {

e.preventDefault();
const form = e.target;
let path = form.getAttribute('action');


if (!heart.classList.contains("heart-given")) {
  heart.classList.add("heart-given"); 
  heartCount.innerHTML++;

}else{
  heart.classList.remove("heart-given");
  heartCount.innerHTML--;
}

  const send = await fetch(path,{
      method: "POST",
      body: new FormData(form),
  });
  
}


const loginModal = document.querySelector(".login-modal");

const login = (e) => {
  e.preventDefault();
  loginModal.classList.add("modal-visible");
}

const loginRemove = () => {
  loginModal.classList.remove("modal-visible");
}

//copy post link for sharing
const copyForShare = () => {
  const copyPostUrl = document.getElementById("copy-post-url");
  copyPostUrl.select();
  copyPostUrl.setSelectionRange(0, 99999);
  document.execCommand("copy");
  alert("Copied")
}


//for home page

const copyForShareFromHome = (Id) => {
  const copyPostUrl = document.getElementById(Id);
  copyPostUrl.select();
  copyPostUrl.setSelectionRange(0, 99999);
  document.execCommand("copy");
  alert("Copied")
}


//this function is for alert before delete

const deleteConfirmation = (e) => {
  if (!confirm("Are you sure you wanna delete this comment permantly")) {
    e.preventDefault();
  }
}


const edit = (e) => {
  const event = e.target;
  const {editRoute, comment} = event.dataset;

  const commentEditModal = document.getElementById("commentEditModal");
  const editComment = commentEditModal.querySelector("#editComment");

  commentEditModal.setAttribute("action", editRoute);
  editComment.value = comment;

  commentEditModal.classList.add("start-edit");
}


const dontEdit = (e) => {
  e.preventDefault();
  const from = e.target.parentElement.parentElement;
try {
  from.classList.remove("start-edit");
} catch (error) {
  alert(error);
}
}


const createQuickRead = (loader, shortDescription) => {
  
  let Container = document.createElement("div"),
  imgFOrLoader = document.createElement("img"),
  i = document.createElement("i");

  Container.classList.add("nicer"),
  imgFOrLoader.classList.add("loader"),
  i.classList.add("fas", "fa-times", "be-custom-i");

  i.addEventListener("click", (e) => {
    e.target.parentElement.remove();
  });


  imgFOrLoader.setAttribute("src", loader);
  Container.appendChild(imgFOrLoader);
  shortDescription.appendChild(Container);

  return () => {
    Container.innerHTML = null;
    Container.appendChild(i);
    return Container;
  }
}

const quickRead = async (e) => {

  const event = e.target;
  const {loader, route} = event.dataset;

  const shortDescription = document.getElementById("shortDescription");
  shortDescription.innerHTML = null;

  const Container = createQuickRead(loader, shortDescription);

  const request = await fetch(route);
  const getJson = await request.json();

  const {quickread} = getJson;

  const forSep = document.createElement("h3");
  forSep.classList.add("read-quick-des");

  if (quickread == null) {
    forSep.innerHTML = "No quick read for this post";
    Container().appendChild(forSep);
    return;
  }

  forSep.innerHTML = quickread;
  Container().appendChild(forSep);

}


 
const addRevIncDec = ( heart, likeCount) => {
  if (heart.classList.contains('liked')) {
    heart.classList.remove('liked');
    likeCount.innerHTML--;
    return likeCount.innerHTML;
  
  }else{
    heart.classList.add('liked');
    likeCount.innerHTML++;
   
    return likeCount.innerHTML;
  }

}


const handleLikeText = (num, wIns) => {
  if (num > 1 || num == 0) {
    wIns.innerHTML = "likes";
  }else{
    wIns.innerHTML = "like";
  }
}


//comment like frontend work function
const commentLikeFrontend = (Object) => {
  const reachedElement =  Object.children[1].children;

   let likeIcon = reachedElement[0],
       span = reachedElement[1];

  const btnobject = {
    heart: likeIcon,
    likeCount: span.children[0],
    likeText: span.children[1],
  }

  let {heart, likeCount, likeText} = btnobject;

  let getnum = addRevIncDec(heart, likeCount);

  handleLikeText(getnum, likeText);


  return btnobject;
  
}



//comment like backend work function
const commentLikeBackend = async (Data, froObject) => {
  const formData = new FormData(Data);
  const path = Data.getAttribute("action");

  const request = await fetch(path, {
    method: "POST",
    body: formData,
  });

 if (request.status !== 200) {
   alert("something went wrong");

   let {heart, likeCount, likeText} = froObject;
   let getnum = addRevIncDec(heart, likeCount);

   handleLikeText(getnum, likeText);

 }

}


// commentlike() is used for liking the comments
const commentlike = (e) => {
  e.preventDefault();
  const event = e.target;
  //get the button elemt of current targeted form
  $getobjectfro = commentLikeFrontend(event);
  commentLikeBackend(event, $getobjectfro);

//Array.prototype.slice.call(reachedElement)


}







//comment like frontend work function
// const commentLikeFrontend = (Object) => {
//   const reachedElement =  Object.children[1].children;
//   // let heart = reachedElement[0];

//    let span = reachedElement[1];

//   // let likeCount = span.children[0];
//   // let likeText = span.children[1];

//   const btnobject = {
//     heart: reachedElement[0],
//     likeCount: span.children[0],
//     likeText: span.children[1],
//   }

//   let {heart, likeCount, likeText} = btnobject;

//   let getTxt;

//   if (heart.classList.contains('liked')) {
//     heart.classList.remove('liked');
//     likeCount.innerHTML--;
//     getTxt = likeCount.innerHTML;
  
//   }else{
//     heart.classList.add('liked');
//     likeCount.innerHTML++;
   
//     getTxt = likeCount.innerHTML;
//   }

//   if (getTxt > 1 || getTxt == 0) {
//     likeText.innerHTML = "likes";
//   }else{
//     likeText.innerHTML = "like";
//   }

//   return btnobject;
  
// }



// //comment like backend work function
// const commentLikeBackend = async (Data, froObject) => {
//   const formData = new FormData(Data);
//   const path = Data.getAttribute("action");

//   const request = await fetch(path, {
//     method: "POST",
//     body: formData,
//   });

//  if (request.status !== 200) {
//    alert("something went wrong");

//    let {heart, likeCount, likeText} = froObject;

   
// if (heart.classList.contains("liked")) {
//   heart.classList.remove("liked");
//   const getikenum = likeCount.innerHTML--;

//   if (likeCount.innerHTML > 1 || likeCount.innerHTML == 0) {
//    likeText.innerHTML = "likes";
//   }else{
//    likeText.innerHTML = "like";

//   }


// }else{
//   heart.classList.add("liked");
//   const getikenum = likeCount.innerHTML++;

//   if (likeCount.innerHTML > 1 || likeCount.innerHTML == 0) {
//    likeText.innerHTML = "likes";
//   }else{
//    likeText.innerHTML = "like";

//   }
// }




//  }

// }


// // commentlike() is used for liking the comments
// const commentlike = (e) => {
//   e.preventDefault();
//   const event = e.target;
//   //get the button elemt of current targeted form
//   $getobjectfro = commentLikeFrontend(event);
//   commentLikeBackend(event, $getobjectfro);

// //Array.prototype.slice.call(reachedElement)


// }



//get post categories

(async() => {
const categoryManager = document.getElementById("categoryManager");

const {categoryRoute} = categoryManager.dataset;



const http = await fetch(categoryRoute);
const json = await http.json();

let markUp = "";

let {length} = json;


if (length > 0) {
  json.forEach((data, index) => {

    markUp += `<a href='/category/${data.slug}' target='__blank' class='category-name'>${data.category__name} 
    ${length != index+1 ? '<span>,</span>' : ''}
    </a>`;
   
   
   });
   
} else {
  markUp = "<a class='category-name'>Uncategorized</a>"
}


categoryManager.innerHTML = markUp;



})();