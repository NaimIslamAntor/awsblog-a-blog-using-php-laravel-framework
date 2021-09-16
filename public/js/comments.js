







// const comment = (commentAvatar, nameOfAuthor, time, commentText, likesCount, likedOrNot) => {
//     //Creation Area

//     //main blocks
//     const commentContainer = document.createElement("div"),
//           authorFancyDivider = document.createElement("div"),
//           commentPublic = document.createElement("div");

//     //authorFancyDivider childs
//     const commentAuthorAavatar = document.createElement("img"),
//           commentFancyBox = document.createElement("div");

//     //comment public childs
//     const commentLikingForm = document.createElement("form"),
//           replyingForm = document.createElement("form");

//     //commentFancyBox childs
//     const commentAuthor = document.createElement("div"),
//     comment = document.createElement("div");


//     //commentLikingForm childs
//     const csrfTokenForLike = document.createElement("input"),
//           likeBtn = document.createElement("button");
    
//     //replyingForm childs
//     const  csrfTokenForReply = document.createElement("input"),
//     ReplyBtn = document.createElement("button");

//     //commentAuthor child
//     const nameAndTime = document.createElement("h6");


//     //styling area

//     //main blocks style
//     commentContainer.classList.add("col-lg-8", "col-md-12", "col-12", "mx-auto", "py-4", "show-comment");
//     authorFancyDivider.classList.add("comment-author-fancy-divider", "d-flex");
//     commentPublic.classList.add("comment-public", "d-flex", "mt-2");

//     //authorFancyDivider childs style
//     commentAuthorAavatar.classList.add("author-picture", "mt-2");
//     commentFancyBox.classList.add("comment-fancy-box");


//     //comment public childs style
//     //commentLikingForm has no classes
//     replyingForm.classList.add("ml-2");

//     //commentFancyBox childs
//     commentAuthor.classList.add("comment-author");
//     comment.classList.add("comment");


//      //commentAuthor child style
//      nameAndTime.classList.add("comment-author-name");


//        //commentLikingForm childs style
//        //csrfTokenForLike has no classes
//        likeBtn.classList.add("public-cons-btn");

       
//        //commentLikingForm childs style
//        //csrfTokenForReply has no classes
//        ReplyBtn.classList.add("public-cons-btn");

    
//        //filling them with datas
//        //comment author avatar
//        commentAuthorAavatar.setAttribute("src", commentAvatar);
//        commentAuthorAavatar.setAttribute("alt", nameOfAuthor);
//        commentAuthorAavatar.setAttribute("load", "lazy");
//        commentAuthorAavatar.setAttribute("decoding", "async");


//        csrfTokenForLike.setAttribute("type", "hidden");
//        csrfTokenForReply.setAttribute("type", "hidden");

//        nameAndTime.innerHTML = `${nameOfAuthor} <i class="fas fa-chevron-right right-arrow-fontawesome"></i> ${time}`

//        comment.innerHTML = commentText;


// //like button is reply button here.
// //and
// //reply button is like button here


// ReplyBtn.innerHTML = `<i class="far fa-heart mr-2 ${likedOrNot}"></i> <span>
// <span>${likesCount}</span>
// <span class="public-rere">${(likesCount > 1 || likesCount == 0) ? "likes" : "like"}</span>
// </span>`;

// likeBtn.innerHTML = `<i class="far fa-comment-dots mr-2"></i> <span>5 <span class="public-rere">replies</span></span>`;




//    //appending
   
//    commentAuthor.appendChild(nameAndTime);

//    commentFancyBox.appendChild(commentAuthor);
//    commentFancyBox.appendChild(comment);


//    authorFancyDivider.appendChild(commentAuthorAavatar);
//    authorFancyDivider.appendChild(commentFancyBox);

//    commentLikingForm.appendChild(csrfTokenForLike);
//    commentLikingForm.appendChild(ReplyBtn);

//    replyingForm.appendChild(csrfTokenForReply);
//    replyingForm.appendChild(likeBtn);


//    commentPublic.appendChild(commentLikingForm);
//    commentPublic.appendChild(replyingForm);


//     commentContainer.appendChild(authorFancyDivider);
//     commentContainer.appendChild(commentPublic);
          
//     return commentContainer;
        

// }


// const commentsBoss = document.querySelector("#commentsBoss");
// let showComment = document.querySelectorAll(".show-comment");
// let preLoaderOfComment = document.querySelector("#preLoaderOfComment");


// let {commentCount, postId, userId} = commentsBoss.dataset;

// let insOfIntScObs;
// let lenOfComs = showComment.length;
// let  numOfLCm = 20;
// let lastChild = showComment[lenOfComs - 1];




// async function fetchComments (insOfIntScObs) {

// insOfIntScObs.disconnect();

// const request = await fetch(`/post/comment/load/${postId}/${numOfLCm}`);

// // if (request.status === 404){
// //     alert("404 Not Found");
// //     return false;
// // };

// const json = await request.json();

// // console.log(json);

// let path = 'http://127.0.0.1:8000/storage/img/profile/';

// preLoaderOfComment.classList.remove("d-block");

// for(let x in json[0]){

//     let date = moment(json[0][x].created_at, "YYYY-MM-DDTHH:mm:ss.SSS").format("ll");

//     let nameOfPic = json[0][x].user.user_pic;

//     let UserPic = json[0][x].user.provider == 'awsblog' ? `${path}${nameOfPic}` : nameOfPic;

//     let likes = json[0][x].commentlikes;

//     let likesCount = likes.length;

//     let checkLike = false;

//      likes.filter(like => {
//         checkLike = like.user_id == userId;
//     });

//     let likedOrNot = checkLike ? "liked" : null;

//     commentsBoss.appendChild(
//         comment(UserPic, `${json[0][x].user.fname} ${json[0][x].user.lname}`, date, json[0][x].commentbody, likesCount, likedOrNot));
// }

// //    preLoaderOfComment.classList.remove("d-block");

// showComment = document.querySelectorAll(".show-comment");
// lenOfComs = showComment.length;
// numOfLCm += 20;
// lastChild = showComment[lenOfComs - 1];
// insOfIntScObs.observe(lastChild);


// if (lenOfComs >= commentCount) {
// insOfIntScObs.disconnect();
// }
  




// }


// function getComments(info){
//     preLoaderOfComment.classList.add("d-block");

//    let {isIntersecting} = info[0];
//    if (isIntersecting) {
//        try {
//         fetchComments(insOfIntScObs);
//        } catch (error) {
//            alert(error)
//        }
     

//    }

// }

        
// insOfIntScObs = new IntersectionObserver(getComments, {
//             threshold: 0.1,
//         });
// insOfIntScObs.observe(lastChild);






const dpForEditDelete = (id, comment, csrf) => {
    return `<div class="comment-author-options dropdown">
    <i class="fas fa-ellipsis-h" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i> 
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item">
            <div>
                <button class="btn" data-edit-route="http://127.0.0.1:8000/post/comment/edit/${id}" data-comment="${comment}" onclick="edit(event)">Edit</button>
            </div>
        </a>
        <a class="dropdown-item">
            <form action="http://127.0.0.1:8000/post/comment/delete/${id}" method="POST">
                <input type="hidden" name="_token" value="${csrf}">                                                    
                <input type="hidden" name="_method" value="DELETE">                                                    
                <button class="btn" onclick="deleteConfirmation(event)">Delete</button>
            </form>
        </a>
      </div> 
 </div> `;
}









const formDep = (path) => {

const dep = {
    method: "POST",
    action: path,
    onsubmit: "commentlike(event)",
}
    return dep;

}


const csrfTokenDep = (token) => {
    const dep = {
        type: "hidden",
        name: "_token",
        value: token,
        }
   
    return dep;
}


const addATtribute = (depValue, element, depobject) => {

    for (const attribute in depobject(depValue)) {

        if (Object.hasOwnProperty.call(depobject(depValue), attribute)) {

            const value = depobject(depValue)[attribute];

            element.setAttribute(attribute, value);
        }
    }

}


// comment(commentId, whoseComment, UserPic, `${json[0][x].user.fname} ${json[0][x].user.lname}`, date, json[0][x].commentbody,
// likesCount, likedOrNot, authenticated, csrf)
// );


const comment = (id, whoseComment, commentAvatar, nameOfAuthor, time, commentText, likesCount, likedOrNot, authenticated, csrf) => {
    //Creation Area

    //main blocks
    const commentContainer = document.createElement("div"),
          authorFancyDivider = document.createElement("div"),
          commentPublic = document.createElement("div");

    //authorFancyDivider childs
    const commentAuthorAavatar = document.createElement("img"),
          commentFancyBox = document.createElement("div");

    //comment public childs
    const commentLikingForm = document.createElement("form"),
          replyingForm = document.createElement("form");

    //commentFancyBox childs
    const commentAuthor = document.createElement("div"),
    comment = document.createElement("div");


    //commentLikingForm childs
    const csrfTokenForLike = document.createElement("input"),
          likeBtn = document.createElement("button");
    
    //replyingForm childs
    const  csrfTokenForReply = document.createElement("input"),
    ReplyBtn = document.createElement("button");

    //commentAuthor child
    const nameAndTime = document.createElement("h6");


    //styling area

    //main blocks style
    commentContainer.classList.add("col-lg-8", "col-md-12", "col-12", "mx-auto", "py-4", "show-comment");
    authorFancyDivider.classList.add("comment-author-fancy-divider", "d-flex");
    commentPublic.classList.add("comment-public", "d-flex", "mt-2");

    //authorFancyDivider childs style
    commentAuthorAavatar.classList.add("author-picture", "mt-2");
    commentFancyBox.classList.add("comment-fancy-box");


    //comment public childs style
    //commentLikingForm has no classes
    replyingForm.classList.add("ml-2");

    //commentFancyBox childs
    commentAuthor.classList.add("comment-author");
    comment.classList.add("comment");


     //commentAuthor child style
     nameAndTime.classList.add("comment-author-name");


       //commentLikingForm childs style
       //csrfTokenForLike has no classes
       likeBtn.classList.add("public-cons-btn");

       
       //commentLikingForm childs style
       //csrfTokenForReply has no classes
       ReplyBtn.classList.add("public-cons-btn");

    
       //filling them with datas
       //comment author avatar
       commentAuthorAavatar.setAttribute("src", commentAvatar);
       commentAuthorAavatar.setAttribute("alt", nameOfAuthor);
       commentAuthorAavatar.setAttribute("load", "lazy");
       commentAuthorAavatar.setAttribute("decoding", "async");


    //add form attribute dependency using addATtribute()

    //liking from

   

    if (authenticated) {
        
        //dont add form dependency if user is not authenticated
    
            let likingPath = `http://127.0.0.1:8000/post/comment/like/${id}`;
            addATtribute(likingPath, commentLikingForm, formDep);
        }


    //add likebtn(replyBtn) login(event) if user is not authenticated
    
    if (!authenticated) {
        ReplyBtn.setAttribute('onclick', 'login(event)');
    }


    //add csrf token input dependency using addATtribute()

    addATtribute(csrf, csrfTokenForLike, csrfTokenDep);
    addATtribute(csrf, csrfTokenForReply, csrfTokenDep);
   

      // csrfTokenForReply.setAttribute("type", "hidden");

       nameAndTime.innerHTML = `${nameOfAuthor} <i class="fas fa-chevron-right right-arrow-fontawesome"></i> ${time}`

       comment.innerHTML = commentText;


//like button is reply button here.
//and
//reply button is like button here


ReplyBtn.innerHTML = `<i class="far fa-heart mr-2 ${likedOrNot}"></i> <span>
<span>${likesCount}</span>
<span class="public-rere">${(likesCount > 1 || likesCount == 0) ? "likes" : "like"}</span>
</span>`;

likeBtn.innerHTML = `<i class="far fa-comment-dots mr-2"></i> <span>5 <span class="public-rere">replies</span></span>`;



   //appending
   
   if (whoseComment) {
    commentAuthor.innerHTML = dpForEditDelete(id, commentText, csrf);
   }
  

   commentAuthor.appendChild(nameAndTime);

   commentFancyBox.appendChild(commentAuthor);
   commentFancyBox.appendChild(comment);


   authorFancyDivider.appendChild(commentAuthorAavatar);
   authorFancyDivider.appendChild(commentFancyBox);

   commentLikingForm.appendChild(csrfTokenForLike);
   commentLikingForm.appendChild(ReplyBtn);

   replyingForm.appendChild(csrfTokenForReply);
   replyingForm.appendChild(likeBtn);


   commentPublic.appendChild(commentLikingForm);
   commentPublic.appendChild(replyingForm);


    commentContainer.appendChild(authorFancyDivider);
    commentContainer.appendChild(commentPublic);
          
    return commentContainer;
        

}


const commentsBoss = document.querySelector("#commentsBoss");
let showComment = document.querySelectorAll(".show-comment");
let preLoaderOfComment = document.querySelector("#preLoaderOfComment");


let {commentCount, postId, userId, authenticated, csrf} = commentsBoss.dataset;

let insOfIntScObs;
let lenOfComs = showComment.length;
let  numOfLCm = 20;
let lastChild = showComment[lenOfComs - 1];




async function fetchComments (insOfIntScObs) {

insOfIntScObs.disconnect();

const request = await fetch(`/post/comment/load/${postId}/${numOfLCm}`);

// if (request.status === 404){
//     alert("404 Not Found");
//     return false;
// };

const json = await request.json();

//  console.log(json);

let path = 'http://127.0.0.1:8000/storage/img/profile/';

preLoaderOfComment.classList.remove("d-block");

for(let x in json[0]){

    let date = moment(json[0][x].created_at, "YYYY-MM-DDTHH:mm:ss.SSS").format("ll");

    let commentId = json[0][x].id;

    let userCommentId = json[0][x].user_id;

    let nameOfPic = json[0][x].user.user_pic;

    let UserPic = json[0][x].user.provider == 'awsblog' ? `${path}${nameOfPic}` : nameOfPic;

    let likes = json[0][x].commentlikes;

    let likesCount = likes.length;

    //let checkLike = false;
    let whoseComment = false;

    let likeArray = [];

    if (userId !== undefined) {
        likeArray = likes.filter(like => like.user_id == userId);
      
       whoseComment = userId == userCommentId ? true : false;
    }

    
    //console.log(likeArray);

    // if (userId !== undefined) {
    //     likes.filter(like => {
    //         checkLike = like.user_id == userId;
    //     });

      
    // }

    //console.log(checkLike);
    

    //let likedOrNot = checkLike ? "liked" : null;


    let likedOrNot = likeArray.length === 1 ? "liked" : "";

    commentsBoss.appendChild(
        comment(commentId, whoseComment, UserPic, `${json[0][x].user.fname} ${json[0][x].user.lname}`, date, json[0][x].commentbody,
         likesCount, likedOrNot, authenticated, csrf)
        );
    }


showComment = document.querySelectorAll(".show-comment");
lenOfComs = showComment.length;
numOfLCm += 20;
lastChild = showComment[lenOfComs - 1];
insOfIntScObs.observe(lastChild);


if (lenOfComs >= commentCount) {
insOfIntScObs.disconnect();
}
  




}


function getComments(info){
    preLoaderOfComment.classList.add("d-block");

   let {isIntersecting} = info[0];
   if (isIntersecting) {
       try {
        fetchComments(insOfIntScObs);
       } catch (error) {
           console.log(error);
       }
     

   }

}


if (commentCount > 20) {
    insOfIntScObs = new IntersectionObserver(getComments, {
        threshold: 0.1,
    });
insOfIntScObs.observe(lastChild);

}
        










