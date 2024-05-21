<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Blogs Control</title>

    <link rel='stylesheet' href='./css/header.css'>
    <link rel='stylesheet' href='./css/output.css'>
</head>

<body>
    <?php include('templates/header.php'); ?>

    <div class='hidden'>
        <div class='cardb bg-white w-full min-h-[650px] h-fit box-border p-[30px] rounded-[15px]'></div>
        <div class="main-section size-full flex flex-col justify-start gap-[15px]">
            <input name='id' value='TODO' required hidden />
            <div class='relative w-full h-[350px] overflow-hidden rounded-[10px]'>
                <img class='absolute w-full top-[50%] -translate-y-[50%] left-0 object-cover' src='../assets/${blog.image}' />
            </div>
            
            <div class='flex flex-row justify-between mt-[25px]'>
                <span class='text-xl text-black font-bold'>Title:</span>
                <span class='text-xl text-black'>${blog.title}</span>
            </div>

            <div class='flex flex-row justify-between'>
                <span class='text-xl text-black font-bold'>Date:</span>
                <span class='text-xl text-black'>${blog.date}</span>
            </div>

            <div class='flex flex-row justify-between'>
                <span class='text-xl text-black font-bold'>Text</span>
                <span class='text-xl text-black text-end'>${blog.text}</span>
            </div>

            <div class='flex flex-row justify-between'>
                <span class='text-xl text-black font-bold'>Picture:</span>
                <span class='text-xl text-black'>${blog.image}</span>
            </div>

            <div class='flex flex-row justify-between mt-auto'>
                <button class='edit-button bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Edit</button>

                <button class='delete-button bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Delete</button>
            </div>
        </div>

        <div class="edit-section hidden size-full">
            <div class='w-full h-[45%]'>
                <img class='object-cover size-full rounded-[10px]' src='../assets/${blog.image}' />
            </div>

            <form>
                <div class='flex flex-col justify-start gap-[15px] mt-[20px]'>
                    <input name='id' value='TODO' required hidden />

                    <div class='flex flex-row justify-between gap-[10px]'>
                        <span class='text-xl text-black font-bold'>Title:</span>
                        <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='title' value='${blog.title}' placeholder='Enter a title...' />
                    </div>

                    <div class='flex flex-row justify-between'>
                        <span class='text-xl text-black font-bold'>Date:</span>
                        <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='date' name='date' value='${blog.date}' placeholder='Enter a date...' />
                    </div>

                    <div class='flex flex-row justify-between'>
                        <span class='text-xl text-black font-bold'>Text:</span>
                        <textarea class='resize-none w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='number' name='text' rows='5' placeholder='Enter a text...'>${blog.text}</textarea>
                    </div>

                    <div class='flex flex-row justify-between'>
                        <span class='text-xl text-black font-bold'>Image path:</span>
                        <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='image' value='${blog.image}' placeholder='Enter an image path...' />
                    </div>
                </div>
            </form>

            <div class='flex flex-row justify-between mt-[30px]'>
                <button class='save-button disabled:bg-gray-500 bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Save</button>

                <button class='exit-button bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Exit</button>
            </div>
        </div>

        <div class='main-section flex flex-col justify-start gap-[15px] size-full'>
            <input name='id' value='${product.id}' required hidden />
            <div class='w-full h-[30%] resize-none'>
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
                <button class='edit-button bg-gray-500 rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Edit</button>

                <button class='delete-button bg-gray-500 rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Delete</button>
            </div>
        </div>

        <div class='edit-section size-full flex flex-col hidden w-[35%]'>
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
                <button class='save-button bg-gray-500 rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Save</button>

                <button class='exit-button bg-gray-500 rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Exit</button>
            </div>
        </div>
        <div class='card rounded-[10px] py-[20px] px-[15px] w-[35%] h-[600px] bg-[#CA9960]'></div>
        <button class='disabled:bg-gray-500 bg-[#CA9960]'></button>
        <div class='w-full min-h-[150px] bg-white box-border px-[10px] py-[25px] flex flex-col gap-[25px]'>
            <div class='w-full h-[25%]'>
                <span class='title font-bold text-2xl'>${title}</span>
            </div>
            <div>
                <span class='description text-xl'>${content}</span>
            </div>
        </div>
    </div>

    <section>
        <div class='w-[85%] mx-auto mt-[20px]'>
            <div class='top-text'>
                <span class='text-3xl text-black font-bold'>Blogs</span>
            </div>

            <div class='w-full flex flex-row justify-between mt-[20px]'>
                <div class='blogs-section w-[70%] flex justify-start flex-wrap gap-y-[20px] gap-[10px] mb-[50px]'>
                </div>

                <div class='logs w-[25%] flex flex-col gap-[30px] box-border px-[10px]'>
                </div>
            </div> 
        </div>
    </section>

    <script src="./js/jq.js"></script>
    <script src="./js/blogs_page.js"></script>
</body>

</html>