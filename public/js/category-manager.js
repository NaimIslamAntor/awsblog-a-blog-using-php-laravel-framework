


const subCategoryNest = document.getElementById("subCategoryNest");

const subList = document.getElementById("subList");

const loaderSub = document.getElementById("loaderSub");

const inputDeP = (value) => {
   return {
    type: "checkbox",
    // name: "cat_id",
    value: value,
    onclick: "addToSubListing(event)"
   }

}

const addToSubListing = (event) => {

    let subCategoriesListing = document.getElementById("subCategoriesListing");
  
    let getArrOfSubCats = Array.from(subCategoriesListing.children);
// console.log(getArrOfSubCats);
    if(event.target.checked){
        
        // if (getArrOfSubCats.length > 0) {
        //     getArrOfSubCats.filter(sub => sub.value == event.target.value);
        // }

        let filteredArr =  getArrOfSubCats.filter(sub => sub.value == event.target.value);
        
  if (filteredArr.length == 0) {
           const SubHiddenInput = document.createElement("input");
           SubHiddenInput.setAttribute("type", "hidden");

           SubHiddenInput.setAttribute("value", event.target.value);

           SubHiddenInput.setAttribute("name", "subcategory[]");

           subCategoriesListing.appendChild(SubHiddenInput);
           
        }

        //  subCategoriesListing = document.getElementById("subCategoriesListing");
  
        //  getArrOfSubCats = Array.from(subCategoriesListing.children);

        //  console.log(getArrOfSubCats);

      
    }else{
        let filteredArr =  getArrOfSubCats.filter(sub => sub.value == event.target.value);
        // console.log(filteredArr);
        // console.log(getArrOfSubCats);

        filteredArr[0].remove();
    }
}





const inputCheckBox = (getId) => {

    let subCategoriesListing = document.getElementById("subCategoriesListing");
  
    let getArrOfSubCats = Array.from(subCategoriesListing.children);


    const input = document.createElement("input");
    let inputDependency = inputDeP(getId);

    for (const key in inputDependency) {
        if (Object.hasOwnProperty.call(inputDependency, key)) {
            const value = inputDependency[key];
            input.setAttribute(key, value);
        }
    }

    let {value} = input;

    let getExistingAddedSub = getArrOfSubCats.filter(sub => sub.value == value);

    if (getExistingAddedSub.length == 1) {
        input.checked = true;
    }
   

    return input;

}






const subCategoryMarkup = (subName, getId=null, getBool=false) => {
    
    /* An other way to make parameters optional is by using logical operator
    getid = getId || null
    getBool = getBool || null */


    const li = document.createElement("li");
    li.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");



    li.innerHTML = subName;

    if (getBool) {
        li.appendChild(inputCheckBox(getId));
    }
    

    return li;
}



const showSubCategory = async (event) => {
     event.preventDefault();
     
    loaderSub.classList.remove("d-none");

    subList.innerHTML = "";

    const {subcategoryRoute, addOrNot} = event.target.dataset;

    const req = await fetch(subcategoryRoute);

    const json = await req.json();
    
    loaderSub.classList.add("d-none");

    if (json.length === 0) {
        subList.appendChild(subCategoryMarkup("This category has no sub categories"));
        return;
    }

    json.forEach(sub => {
        subList.appendChild(subCategoryMarkup(sub.category__name, sub.id, addOrNot));
    });

   
}




try {
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })
} catch (error) {
    console.warn(`Something wrong with modal jquery even through it's running fine ${error.message}`);

}