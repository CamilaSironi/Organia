"use strict"

const URL = "api/products/";
const URLC = "api/categories/";

let body = document.getElementById("mainBody");

// PRODUCT FUNCTIONS:

let btnProd = document.getElementById("btn-prods");
btnProd.addEventListener('click', listProducts);

async function listProducts(){
    let res = await fetch(URL);
    let products = await res.json();
    body.innerHTML = "";
    let html =`
    <table>
        <thead>
        <tr><td> Product </td><td> Stock </td><td> Price </td><td> Category </td><td></td><td></td></tr>
        </thead>
        <tbody>`
            for(const prod of products){ 
                html += `
                <tr id="${prod.product_id}">
                    <td>${prod.product_name}</td>
                    <td>${prod.product_quantity}</td>
                    <td>${prod.product_price}</td>
                    <td>${prod.category}</td>
                    <td><button class='btn' type='button' onClick={editProductForm(${prod.product_id})}>Edit</button></td>
                    <td><button class='btn' type='button' onClick={deleteProd(${prod.product_id})}>Delete</button></td>
                </tr>`  
            }
           html += `
        </tbody>
    </table>
    <button class='btn' type='button' onClick={addProductForm()}>Add new product</button>
    <button class='btn' type='button'><a class='btn'  href="./index.html">Home</a></button>`;
    body.innerHTML = html;
}

async function addProductForm(){
    let res = await fetch(URLC);
    let categories = await res.json();
    body.innerHTML = "";
    let html = `
        <form id="prodForm" method="POST">
            <div class="">  
                    <label>Name of the product: </label>
                    <input required type="text" name="product_name" placeholder="For example: Frozen brocoli">
            </div>
            <div class="">  
                    <label>Stock: </label>
                    <input required type="number" name="product_quantity" placeholder="50">
            </div>
            <div class="">  
                <label>Price: </label>
                <input required type="double" name="product_price" placeholder="1000">
            </div>
            <div class="">  
                    <label>Category: </label>
                    <select name="category_id" required>`
                        for(const c of categories){
                            html +=
                            `<option value="${c.category_id}">${c.category_name}</option>`
                        }
                        html +=`
                    </select>
            </div>
            <button class='btn' type="button" onClick={createProd()}> Add product </button>
        </form>`
    body.innerHTML = html;
}

async function createProd(){
    try {
        let form = document.getElementById("prodForm");
        let formData = new FormData(form); 
        let toSend = Object.fromEntries(formData); 
        let res = await fetch(URL, { 
            method: 'POST',
            body: JSON.stringify(toSend), 
            headers: {'Content-Type': 'application/json'}
        })
        console.log(res.status);
        listProducts();
    }
    catch (error) {
        console.log(error);
    }
}

async function editProductForm(id){
    let res = await fetch(URLC);
    let categories = await res.json();
    let res1 = await fetch(URL+id);
    let prod = await res1.json();
    body.innerHTML = "";
    let html = `
        <form id="editProdForm" method="PUT">
            <div class="">  
                    <label>Name of the product: </label>
                    <input required type="text" name="product_name" value="${prod.product_name}">
            </div>
            <div class="">  
                    <label>Stock: </label>
                    <input required type="number" name="product_quantity" value="${prod.product_quantity}">
            </div>
            <div class="">  
                <label>Price: </label>
                <input required type="double" name="product_price" value="${prod.product_price}">
            </div>
            <div class="">  
                    <label>Category: </label>
                    <select name="category_id" value="${prod.category_name}" required>`
                        for(const c of categories){
                            html +=
                            `<option value="${c.category_id}">${c.category_name}</option>`
                        }
                        html +=`
                    </select>
            </div>
            <button class='btn' type="button" onClick={editProd(${id})}> Edit product </button>
        </form>`
    body.innerHTML = html;
}

async function editProd(id){
    try {
        let form = document.getElementById("editProdForm");
        let formData = new FormData(form); 
        let toSend = Object.fromEntries(formData); 
        let res = await fetch(URL+id, { 
            method: 'PUT',
            body: JSON.stringify(toSend), 
            headers: {'Content-Type': 'application/json'}
        })
        console.log(res.status);
        listProducts();
    }
    catch (error) {
        console.log(error);
    }
}

async function deleteProd(id){
    try{
        let res = await fetch(URL+id,{
            method: "DELETE"
        })
        console.log(res.status);
        listProducts();
    }
    catch (error) {
        console.log(error);
    }
}

// CATEGORY FUNCTIONS:

let btnCat = document.getElementById("btn-cats");
btnCat.addEventListener('click', listCategories);

async function listCategories(){
    let res = await fetch(URLC);
    let categories = await res.json();
    body.innerHTML = "";
    let html = `
    <ul>`;
        for(const c of categories){
            html += `
            <li id="${c.category_id}"><label>${c.category_name}</label><button class='btn' type='button' onClick={editCatForm(${c.category_id})}>Edit</button><button class='btn' type='button' onClick={deleteCat(${c.category_id})}>Delete</button></li>`;
        }
        html += `
    </ul>
    <button class='btn' type='button' onClick={addCategoryForm()}>Add new category</button>
    <button class='btn' type='button'><a class='btn' href="./index.html">Home</a></button>`;
    body.innerHTML = html;
}

function addCategoryForm(){
    body.innerHTML = "";
    let html = `
        <form id="catForm" method="POST">
            <div class="">  
                    <label>Name of the category: </label>
                    <input required type="text" name="category_name" placeholder="For example: Frozen">
            </div>
            <button class='btn' type="submit" onClick={createCat()}> Add category </button>
        </form>`
    body.innerHTML = html;
}

async function createCat(){
    let form = document.getElementById("catForm");
    let formData = new FormData(form); 
    let toSend = Object.fromEntries(formData); 
    try {
        let res = await fetch(URLC, { 
                    method: 'POST',
                    body: JSON.stringify(toSend), 
                    headers: {'Content-Type': 'application/json'}
        })
        console.log(res.status);
        listCategories();
    }
    catch (error) {
        console.log(error);
    }
}

async function editCatForm(id){
    let res = await fetch(URLC+id);
    let cat = await res.json();
    body.innerHTML = "";
    let html = `
        <form id="editCatForm" method="PUT">
            <div class="">  
                    <label>Name of the category: </label>
                    <input required type="text" name="category_name" value="${cat.category_name}">
            </div>
            <button class='btn' type="button" onClick={editCat(${id})}> Edit category </button>
        </form>`
    body.innerHTML = html;
}

async function editCat(id){
    try {
        let form = document.getElementById("editCatForm");
        let formData = new FormData(form); 
        let toSend = Object.fromEntries(formData); 
        let res = await fetch(URLC+id, { 
            method: 'PUT',
            body: JSON.stringify(toSend), 
            headers: {'Content-Type': 'application/json'}
        })
        console.log(res.status);
        listCategories();
    }
    catch (error) {
        console.log(error);
    }
}

async function deleteCat(id){
    try{
        let res = await fetch(URLC+id,{
            method: "DELETE"
        })
        console.log(res.status);
        listCategories();
    }
    catch (error) {
        console.log(error);
    }
}
