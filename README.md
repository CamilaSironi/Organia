### El Frontend aun no esta terminado mientras que el Backend si, se pueden probar los endpoints con Postman o similar

# ENDPOINTS:

### Ejemplos de JSON para POST y PUT:

 - Productos:   

    {
        "product_name": "Medallones de calabaza",
        "product_stock": 20,
        "product_price": 590,
        "category_id": 1
    }

 - Categorias: 

    {
        "category_name": "Congelados"
    }

### - GET /categories
Accede al listado de categorias

### - GET /categories/:id (ej /categories/1)
Accede al detalle de la categoria con el id especificado

### - POST /categories
Crea una categoria nueva

### - PUT /categories/:id (ej /categories/1)
Edita la categoria con el id especificado, sustituyendo la información enviada

### - DELETE /categories/:id (ej /categories/1)
Elimina la categoria con el id especificado

### - GET /products
Accede al listado de productos

### - GET /products/:id (ej /products/1)
Accede al detalle de el producto con el id especificado

### - GET /products?category_id=id (ej /products?category_id=1)
Accede al listado de los productos filtrando por categoria con el id especificado

### - GET /products?order=boolean (ej /products?order=true)
Accede al listado de los productos mostrando en orden ascendente segun el id 

### - GET /products?page=num (ej /products?page=1)
Accede al listado de los productos mostrando la pagina especificada

### - POST /products
Crea un producto nuevo

### - PUT /products/:id (ej /products/1)
Edita el producto con el id especificado, sustituyendo la información enviada

### - DELETE /products/:id (ej /products/1)
Elimina el producto con el id especificado
