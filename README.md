# ENDPOINTS:

### JSON examples for POST and PUT:

 - Products:   

    {
        "product_name": "Pumpkin burgers",
        "product_stock": 20,
        "product_price": 590,
        "category_id": 1
    }

 - Categories: 

    {
        "category_name": "Frozen"
    }

### - GET /categories
Lists all categories

### - GET /categories/:id (ej /categories/1)
Access the category details with the specified id

### - POST /categories
Creates new category

### - PUT /categories/:id (ej /categories/1)
Edits the category with the specified id, replacing its information

### - DELETE /categories/:id (ej /categories/1)
Deletes the category with the specified id

### - GET /products
Lists all products

### - GET /products/:id (ej /products/1)
Access the product details with the specified id

### - GET /products?category_id=id (ej /products?category_id=1)
Lists all products filtering by category with the specified id

### - GET /products?order=boolean (ej /products?order=true)
Lists all products showing in ascending order according to the id

### - GET /products?page=num (ej /products?page=1)
Lists all products starting from the specified page

### - POST /products
Creates new product

### - PUT /products/:id (ej /products/1)
Edits the product with the specified id, replacing its information

### - DELETE /products/:id (ej /products/1)
Deletes the product with the specified id
