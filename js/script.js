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
                    <td><button class='btn' type='button' onClick={edit(${prod.product_id})}>Edit</button></td>
                    <td><button class='btn-deleteProd' type='button' onClick={deleteProd(${prod.product_id})}>Delete</button></td>
                </tr>`  
            }
           html += `
        </tbody>
    </table>
    <button class='btn' type='button' onClick={addProductForm()}>Add new product</button>
    <a href="./index.html">Home</a>`;
    body.innerHTML = html;
}

async function addProductForm(){
    let res = await fetch(URLC);
    let categories = await res.json();
    body.innerHTML = "";
    let html = `
        <form id="prodForm" method="POST">
            <div class="">  
                    <label>Nombre del producto: </label>
                    <input required type="text" name="product_name" placeholder="Por ej.: Medallones de calabaza">
            </div>
            <div class="">  
                    <label>Stock disponible: </label>
                    <input required type="number" name="product_quantity" placeholder="50">
            </div>
            <div class="">  
                <label>Precio: </label>
                <input required type="double" name="product_price" placeholder="1000">
            </div>
            <div class="">  
                    <label>Categoría: </label>
                    <select name="category_id" required>`
                        for(const c of categories){
                            html +=
                            `<option value="${c.category_id}">${c.category_name}</option>`
                        }
                        html +=`
                    </select>
            </div>
            <button class='btn' type="button" onClick={createProd()}> Añadir producto </button>
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
            <li id="${c.category_id}"><label>${c.category_name}</label><button class='btn' type='button' onClick={edit(${c.category_id})}>Editar</button><button class='btn' type='button' onClick={deleteCat(${c.category_id})}>Borrar</button></li>`;
        }
        html += `
    </ul>
    <button class='btn' type='button' onClick={addCategoryForm()}>Agregar nueva categoria</button>
    <a href="./index.html">Home</a>`;
    body.innerHTML = html;
}

function addCategoryForm(){
    body.innerHTML = "";
    let html = `
        <form id="catForm" method="POST">
            <div class="">  
                    <label>Nombre de la categoria: </label>
                    <input required type="text" name="category_name" placeholder="Por ej.: Congelados">
            </div>
            <button class='btn' type="submit" onClick={createCat()}> Añadir categoria </button>
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

let btnPanel = document.getElementById("btn-panel");
btnPanel.addEventListener('click', showPanel);

function showPanel(){
    body.innerHTML = "";
    body.innerHTML = `
    <h2>Login</h2>
    <form id= "form" action="loginUser" method="POST">
       <input type="text" name="user" placeholder="Usuario" required>
       <input type="password" name="password" placeholder="Contraseña" required>
       
       <div class='btns'>
          <button type="submit"> Ingresar </button>
       </div>
    </form>
    <a href="./index.html">Home</a>`;
}