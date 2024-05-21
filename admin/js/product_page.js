$(document).ready(function() {

    function getProductsAjax() {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/products_operations.php",
            dataType: "json",
            data: {type: 'get_all'},
            success: function (response) {
                let products = [];
                for (let product of response.data) {
                    let productData = {
                        id: product['id'],
                        type: product['type'],
                        name: product['name'],
                        calories: product['calories'],
                        price: product['price'],
                        image_path: product['picture']
                    }

                    products.push(productData);
                }

                showProducts(products);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function deleteProductAjax(id) {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/products_operations.php",
            dataType: "json",
            data: {type: 'delete', id: id},
            success: function (response) {
                let title = response.message;
                let message = `
                    id: ${response.data.id} <br>
                    name: ${response.data.name} <br>
                    type: ${response.data.type} <br>
                    price: ${response.data.price} <br>
                    calories: ${response.data.calories} <br>
                    picture: ${response.data.picture} 
                `;

                createLogMessage(title, message);
                getProductsAjax();
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function addProductAjax(title, category, price, calories, imagePath) {
        $.ajax({
            type: 'POST',
            url: '/admin/handlers/products_operations.php',
            dataType: 'json',
            data: {
                type: 'add', 
                data: {
                    title: title, 
                    category: category, 
                    price: price, 
                    calories: calories, 
                    imagePath: imagePath,
                }
            },
            success: function(data) {
                createLogMessage('Product added', `
                    id: ${data.data.id},<br /> 
                    name: ${data.data.name},<br /> 
                    type: ${data.data.type},<br /> 
                    price: ${data.data.price},<br />
                    calories: ${data.data.calories},<br /> 
                    picture: ${data.data.picture}
                `);

                getProductsAjax();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function editProductAjax(id, newTitle, newCategory, newPrice, newCalories, newImagePath) {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/products_operations.php",
            dataType: "json",
            data: {
                type: 'edit',
                data: {
                    id: id,
                    name: newTitle,
                    category: newCategory,
                    price: newPrice,
                    calories: newCalories,
                    picture: newImagePath 
                }
            },
            success: function (response) {
                let title = response.message;
                let message = `
                    name: ${response.data.name} > ${response.new_data.name} <br>
                    type: ${response.data.type} > ${response.new_data.category} <br>
                    price: ${response.data.price} > ${response.new_data.price} <br>
                    calories: ${response.data.calories} > ${response.new_data.calories} <br>
                    picture: ${response.data.picture} > ${response.new_data.picture} 
                `;

                createLogMessage(title, message);
                getProductsAjax();
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function createLogMessage(title, content) {
        let log = document.createElement("div");
        log.classList.add('w-full', 'min-h-[150px]', 'bg-white', 'box-border', 'px-[10px]', 'py-[25px]', 'flex', 'flex-col', 'gap-[25px]', 'rounded-[15px]');
        log.innerHTML = `
            <div class='w-full h-[25%]'>
                <span class='title font-bold text-2xl'>${title}</span>
            </div>
            <div>
                <span class='description text-xl'>${content}</span>
            </div>
        `;

        $('.logs').prepend(log);
    }

    function showProducts(products) {
        $(".products-section").html(`
            <div class='rounded-[10px] bg-white py-[20px] px-[15px] w-[32%] h-[600px]'>
                <div class='edit-section size-full flex flex-col'>
                    <div class='w-full h-[30%]'>
                    </div>

                    <form>
                        <div class='flex flex-col justify-start gap-[15px]'>
                            <div class='flex flex-row justify-between mt-[25px] gap-[10px]'>
                                <span class='text-xl text-black font-bold'>Title:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='title' placeholder='Enter a title...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Category:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='category' placeholder='Enter a category...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Price:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='number' name='price' placeholder='Enter a price...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Calories:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='number' name='calories' placeholder='Enter calories amount...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Image path:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='image' placeholder='Enter an image path...' />
                            </div>
                        </div>
                    </form>

                    <div class='flex flex-row justify-between mt-auto'>
                        <button class='new-card-button disabled:bg-gray-500 bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Save</button>
                    </div>
                </div>
            </div>
        `);

        for (let product of products) {
            let card = document.createElement("div");
            card.classList.add('card', 'rounded-[10px]', 'bg-white', 'py-[20px]', 'px-[15px]', 'w-[35%]', 'h-[600px]');
            card.innerHTML = `
                <div class='main-section flex flex-col justify-start gap-[15px] size-full'>
                    <input name='id' value='${product.id}' required hidden />
                    <div class='w-full h-[30%]'>
                        <img class='object-contain size-full' src='../assets/coffee-products/${product.image_path}' />
                    </div>
                    
                    <div class='flex flex-row justify-between mt-[25px]'>
                        <span class='text-xl text-black font-bold'>Title:</span>
                        <span class='text-xl text-black'>${product.name}</span>
                    </div>

                    <div class='flex flex-row justify-between'>
                        <span class='text-xl text-black font-bold'>Category:</span>
                        <span class='text-xl text-black'>${product.type}</span>
                    </div>

                    <div class='flex flex-row justify-between'>
                        <span class='text-xl text-black font-bold'>Price</span>
                        <span class='text-xl text-black'>${product.price}$</span>
                    </div>

                    <div class='flex flex-row justify-between'>
                        <span class='text-xl text-black font-bold'>Calories:</span>
                        <span class='text-xl text-black'>${product.calories}</span>
                    </div>

                    <div class='flex flex-row justify-between mt-auto'>
                        <button class='edit-button bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Edit</button>

                        <button class='delete-button bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Delete</button>
                    </div>
                </div>

                <div class='edit-section size-full flex flex-col hidden'>
                    <div class='w-full h-[30%]'>
                        <img class='object-contain size-full' src='../assets/coffee-products/${product.image_path}' />
                    </div>

                    <form>
                        <div class='flex flex-col justify-start gap-[15px]'>
                            <input name='id' value='${product.id}' required hidden />

                            <div class='flex flex-row justify-between mt-[25px] gap-[10px]'>
                                <span class='text-xl text-black font-bold'>Title:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='title' value='${product.name}' placeholder='Enter a title...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Category:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='category' value='${product.type}' placeholder='Enter a category...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Price</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='number' name='price' value='${product.price}' placeholder='Enter a price...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Calories:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='number' name='calories' value='${product.calories}' placeholder='Enter calories amount...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Image path:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='image' value='${product.image_path}' placeholder='Enter an image path...' />
                            </div>
                        </div>
                    </form>

                    <div class='flex flex-row justify-between mt-auto'>
                        <button class='save-button disabled:bg-gray-500 bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Save</button>

                        <button class='exit-button bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Exit</button>
                    </div>
                </div>
            `;
            $(".products-section").append(card);
        }
        addHandlers();
    }

    function addHandlers() {
        $('.new-card-button').attr('disabled', 'disabled');

        $('input').on('change', function (e) {
            let button = $(this).parents('.edit-section').find('.save-button');
            if (button.length == 0) 
                button = $(this).parents('.edit-section').find('.new-card-button');

            button.attr('disabled','disabled');

            let form = $(this).parents('.edit-section').find('form');
            let otherFields = $(form).find('input');
            for (let i = 0; i < otherFields.length; i++) {
                if (otherFields[i].value == '') return;
            }

            button.removeAttr('disabled');
        });

        $('.new-card-button').on('click', function() {
            let form = $(this).parents('.edit-section').find('form');
    
            let title = $(form).find('input[name="title"]').val();
            let category = $(form).find('input[name="category"]').val();
            let price = $(form).find('input[name="price"]').val();
            let calories = $(form).find('input[name="calories"]').val();
            let imagePath = $(form).find('input[name="image"]').val();
            
            addProductAjax(title, category, price, calories, imagePath);
        });
    
        $('.edit-button').on('click', function() {
            let cardParent = $(this).parents('.card');
            $(cardParent).find('.main-section').addClass('hidden');
            $(cardParent).find('.edit-section').removeClass('hidden');
        });
    
        $('.save-button').on('click', function() {
            let form = $(this).parents('.edit-section').find('form');

            let id = $(form).find('input[name="id"]').val();
            let title = $(form).find('input[name="title"]').val();
            let category = $(form).find('input[name="category"]').val();
            let price = $(form).find('input[name="price"]').val();
            let calories = $(form).find('input[name="calories"]').val();
            let imagePath = $(form).find('input[name="image"]').val();

            let cardParent = $(this).parents('.card');
            $(cardParent).find('.main-section').removeClass('hidden');
            $(cardParent).find('.edit-section').addClass('hidden');
            editProductAjax(id, title, category, price, calories, imagePath);
        });
    
        $('.delete-button').on('click', function() {
            let form = $(this).parents('.main-section');

            let id = $(form).find('input[name="id"]').val();
            deleteProductAjax(id);
        });
        
        $('.exit-button').on('click', function() {
            let cardParent = $(this).parents('.card');
            $(cardParent).find('.main-section').removeClass('hidden');
            $(cardParent).find('.edit-section').addClass('hidden');
        });
    }

    getProductsAjax();
});