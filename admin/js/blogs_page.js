$(document).ready(function() {

    function getBlogsAjax() {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/blogs_operations.php",
            dataType: "json",
            data: {type: 'get_all'},
            success: function (response) {
                let blogs = [];
                for (let blog of response.data) {
                    let blogData = {
                        id: blog['id'],
                        title: blog['title'],
                        text: blog['text'],
                        date: blog['date'],
                        image: blog['picture']
                    };

                    blogs.push(blogData);
                }

                showBlogs(blogs);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function editBlogAjax(id, date, title, text, image) {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/blogs_operations.php",
            dataType: "json",
            data: {
                type: 'edit',
                data: {
                    id: id,
                    title: title,
                    date: date,
                    text: text,
                    picture: image 
                }
            },
            success: function (response) {
                let title = response.message;
                let message = `
                    title: ${response.data.title} > ${response.new_data.title} <br>
                    text: ${response.data.text} > ${response.new_data.text} <br>
                    date: ${response.data.date} > ${response.new_data.date} <br>
                    picture: ${response.data.picture} > ${response.new_data.picture} 
                `;

                createLogMessage(title, message);
                getBlogsAjax();
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function addBlogAjax(title, date, text, image) {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/blogs_operations.php",
            dataType: "json",
            data: {
                type: 'add',
                data: {
                    title: title,
                    date: date,
                    text: text,
                    picture: image 
                }
            },
            success: function (response) {
                let title = response.message;
                let message = `
                    title: ${response.data.title} <br>
                    text: ${response.data.text} <br>
                    date: ${response.data.date} <br>
                    picture: ${response.data.picture}  
                `;

                createLogMessage(title, message);
                getBlogsAjax();
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function deleteBlogAjax(id) {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/blogs_operations.php",
            dataType: "json",
            data: {
                type: 'del',
                data: {
                    id: id
                }
            },
            success: function (response) {
                let title = response.message;
                let message = `
                    id: ${response.data.id} <br>
                    title: ${response.data.title} <br>
                    text: ${response.data.text} <br>
                    date: ${response.data.date} <br>
                    picture: ${response.data.picture}  
                `;

                createLogMessage(title, message);
                getBlogsAjax();
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function showBlogs(blogs) {
        $(".blogs-section").html(`
            <div class='cardb bg-white w-full h-fit box-border p-[30px] rounded-[15px]'>
                <div class="edit-section size-full">        
                    <form>
                        <div class='flex flex-col justify-start gap-[15px] mt-[20px]'>
                            <div class='flex flex-row justify-between gap-[10px]'>
                                <span class='text-xl text-black font-bold'>Title:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='title' placeholder='Enter a title...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Date:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='date' name='date' placeholder='Enter a date...' />
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Text:</span>
                                <textarea class='resize-none w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='number' name='text' rows='5' placeholder='Enter a text...'></textarea>
                            </div>

                            <div class='flex flex-row justify-between'>
                                <span class='text-xl text-black font-bold'>Image path:</span>
                                <input class='w-[55%] bg-white border-[1px] border-black rounded-[5px] px-[5px]' type='text' name='image' placeholder='Enter an image path...' />
                            </div>
                        </div>
                    </form>

                    <div class='flex flex-row justify-between mt-[30px]'>
                        <button class='add-button disabled:bg-gray-500 bg-[#CA9960] rounded-[10px] px-[25px] py-[5px] text-white text-xl'>Add</button>
                    </div>
                </div>
            </div>
        `);

        for (let blog of blogs) {
            let card = document.createElement("div");
            card.classList.add('cardb', 'bg-white', 'w-full', 'min-h-[650px]', 'h-fit', 'box-border', 'p-[30px]', 'rounded-[15px]');
            card.innerHTML = `
                <div class="main-section size-full flex flex-col justify-start gap-[15px]">
                    <input name='id' value='${blog.id}' required hidden />
                    <div class='relative w-full h-[350px] overflow-hidden rounded-[10px]'>
                        <img class='absolute w-full top-[50%] -translate-y-[50%] left-0 object-cover rounded-[10px]' src='../assets/${blog.image}' />
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
                    <div class='relative w-full h-[350px] overflow-hidden rounded-[10px]'>
                        <img class='absolute w-full top-[50%] -translate-y-[50%] left-0 object-cover rounded-[10px]' src='../assets/${blog.image}' />
                    </div>

                    <form>
                        <div class='flex flex-col justify-start gap-[15px] mt-[20px]'>
                            <input name='id' value='${blog.id}' required hidden />

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
            `;
            $(".blogs-section").append(card);
        }

        addHandlers();
    }

    function createLogMessage(title, message) {
        let log = document.createElement('div');
        log.classList.add('w-full', 'min-h-[150px]', 'bg-white', 'box-border', 'px-[10px]', 'py-[25px]', 'flex', 'flex-col', 'gap-[25px]', 'rounded-[15px]');
        log.innerHTML = `
            <div class='w-full h-[25%]'>
                <span class='title font-bold text-2xl'>${title}</span>
            </div>
            <div>
                <span class='description text-xl'>${message}</span>
            </div>
        `;

        $('.logs').prepend(log);
    }

    function addHandlers() {
        $('.add-button').attr('disabled', 'disabled');

        $('input').on('change', checkFields);
        $('textarea').on('change', checkFields);

        $('.add-button').on('click', function() {
            let form = $(this).parents('.edit-section').find('form');
    
            let title = $(form).find('input[name="title"]').val();
            let date = $(form).find('input[name="date"]').val();
            let text = $(form).find('textarea[name="text"]').val();
            let imagePath = $(form).find('input[name="image"]').val();
            
            addBlogAjax(title, date, text, imagePath);
        });

        $('.edit-button').on('click', function() {
            let cardParent = $(this).parents('.cardb');
            $(cardParent).find('.main-section').addClass('hidden');
            $(cardParent).find('.edit-section').removeClass('hidden');
        });

        $('.save-button').on('click', function() {
            let form = $(this).parents('.edit-section').find('form');

            let id = $(form).find('input[name="id"]').val();
            let date = $(form).find('input[name="date"').val();
            let title = $(form).find('input[name="title"]').val();
            let text = $(form).find('textarea[name="text"]').val();
            let imagePath = $(form).find('input[name="image"]').val();

            let cardParent = $(this).parents('.cardb');
            $(cardParent).find('.main-section').removeClass('hidden');
            $(cardParent).find('.edit-section').addClass('hidden');

            editBlogAjax(id, date, title, text, imagePath);
        });

        $('.delete-button').on('click', function() {
            let form = $(this).parents('.main-section');

            let id = $(form).find('input[name="id"]').val();
            deleteBlogAjax(id);
        });

        $('.exit-button').on('click', function() {
            let cardParent = $(this).parents('.cardb');
            $(cardParent).find('.main-section').removeClass('hidden');
            $(cardParent).find('.edit-section').addClass('hidden');
        });
    }

    function checkFields(e) {
        let button = $(this).parents('.edit-section').find('.save-button');
        if (button.length == 0) 
            button = $(this).parents('.edit-section').find('.add-button');

        button.attr('disabled','disabled');

        let form = $(this).parents('.edit-section').find('form');
        let otherFields = $(form).find(':input').not('button').not('input[type="button"]');
        for (let i = 0; i < otherFields.length; i++) {
            if (otherFields[i].value == '') return;
        }

        button.removeAttr('disabled');
    }

    getBlogsAjax();

});