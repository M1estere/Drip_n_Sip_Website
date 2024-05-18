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

    function showBlogs(blogs) {
        $(".blogs-section").html(`

        `);

        for (let blog of blogs) {
            let card = document.createElement("div");
            card.classList.add('cardb', 'bg-white', 'w-full', 'h-[650px]', 'box-border', 'p-[30px]', 'rounded-[15px]');
            card.innerHTML = `
                <div class="main-section size-full flex flex-col justify-start gap-[15px]">
                    <input name='id' value='TODO' required hidden />
                    <div class='w-full h-[60%]'>
                        <img class='object-cover size-full rounded-[10px]' src='../assets/${blog.image}' />
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
                        <span class='text-xl text-black'>${blog.text}</span>
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
            `;
            $(".blogs-section").append(card);
        }

        addHandlers();
    }

    function addHandlers() {
        $('.edit-button').on('click', function() {
            let cardParent = $(this).parents('.cardb');
            $(cardParent).find('.main-section').addClass('hidden');
            $(cardParent).find('.edit-section').removeClass('hidden');
        });

        $('.exit-button').on('click', function() {
            let cardParent = $(this).parents('.cardb');
            $(cardParent).find('.main-section').removeClass('hidden');
            $(cardParent).find('.edit-section').addClass('hidden');
        });
    }

    getBlogsAjax();

});