"use strict"

const URL = "api/products/";
const URLC = "api/categories/";

let btnProd = document.getElementById("btn-prods");
btnProd.addEventListener('click', listProducts);

async function listProducts(){
    let res = await fetch(URL);
    let products = await res.json();
    let body = document.getElementById("mainBody");
    body.innerHTML = "";
    body.innerHTML = `
    
    <table>
        <thead>
        <tr><td> Product </td><td> Stock </td><td> Price </td><td> Category </td></tr>
        </thead>
        <tbody>`
            for(const prod of products){ 
                body.innerHTML += `
                <tr id="${prod.product_id}">
                    <td>${prod.product_name}</td>
                    <td>${prod.product_stock}</td>
                    <td>${prod.product_price}</td>
                    <td>${prod.category_id}</td>
                    <div><button class='btn' type='button' onClick={edit(${prod.product_id})}>Editar</button>
                        <button class='btn' type='button' onClick={deleteProd(${prod.product_id})}>Borrar</button></div>
                </tr>`  
            }
            body.innerHTML += `
        </tbody>
    </table>
    <a href="./index.html">Home</a>`;
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

let btnCat = document.getElementById("btn-cats");
btnCat.addEventListener('click', listCategories);

async function listCategories(){
    let res = await fetch(URLC);
    let categories = await res.json();
    let body = document.getElementById("mainBody");
    body.innerHTML = "";
    body.innerHTML = `
    <ul>`;
        for(const c of categories){
            body.innerHTML += `
            <li id="${c.category_id}">${c.category_name}<div><button class='btn' type='button' onClick={edit(${c.category_id})}>Editar</button><button class='btn' type='button' onClick={deleteCat(${c.category_id})}>Borrar</button></div></li>`;
        }
        body.innerHTML += `
    </ul>
    <a href="./index.html">Home</a>`;
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
    let body = document.getElementById("mainBody");
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



/*let form = document.querySelector('#add-form');
form.addEventListener('submit',agregarProducto);

async function agregarProducto(e){
    e.preventDefault();

    let data = new FormData(form);
    let producto = {
        nombre : data.get('nombre'),
        descripcion : data.get('descripcion'),
        precio : data.get('precio'),
        marca : data.get('marca'),
        id_categoria : data.get('categoria'),
        imagen : null
    };
    
    try{
        let res = await fetch(URL, {
            method : "POST",
            headers : {'Content-Type' : 'application/json',
                      'Authorization' : 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJub21icmUiOiJ3ZWJhZG1pbiIsImlkIjoyfQ.FuEmPdkiCtPMbloQRASX0IwAou9JdBkYWZz-knSnvp0'},
            body : JSON.stringify(producto)
        });

        if(!res.ok){
            throw new Error("No se logro insertar el producto correctamente"); 
        }

        let nuevo = await res.json();

        localProds.push(nuevo);

        form.reset();

        imprimirProductos();

    }catch(e){
        console.log(e);
    }
}*/


