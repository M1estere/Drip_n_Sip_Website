window.onload = () => {

    function getClientsAjax() {
        $.ajax({
            type: "POST",
            url: "/admin/handlers/users_operations.php",
            dataType: "json",
            data: {type: 'get_all'},
            success: function (response) {
                let users = [];
                for (let user of response.data) {
                    let userData = {
                        id: user['id'],
                        username: user['username'],
                        name: user['name'],
                        email: user['email'],
                        password: user['password'],
                        orders: user['orders']
                    };
                    console.log(user);

                    users.push(userData);
                }

                showUsers(users);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus, errorThrown);
            }
        });
    }

    function showUsers(users) {
        for (let user of users) {
            let card = document.createElement('div');
            
            card.classList.add('user-info-block');
            let text = `
                <div class='left'>
                    <p class='title'>Client Info</p>
                    <p class='info'>
                        <span><b>ID:</b> ${user.id}</span><br>
                        <span><b>Username:</b> ${user.username}</span><br>
                        <span><b>Name:</b> ${user.name}</span><br>
                        <span><b>Email:</b> ${user.email}</span><br>
                        <span><b>Password:</b> ${user.password}</span>
                    </p>
                    </div class='right'>
                        <table class='orders-table'>
                            <tr>
                                <td><b>Order Date</b></td>
                                <td><b>Order Size</b></td>
                                <td><b>Order Cost</b></td>
                            </tr>
            `;

            for (let order of user.orders) {
                text += `
                    <tr>
                        <td>${order.creation_date}</td>
                        <td>${order.amount}</td>
                        <td>${order.price}$</td>
                    </tr>
                `;
            }

            text += `
                        </table>
                    </div>
                </div>
            `;

            card.innerHTML = text;
            console.log(card);
            $('#main-block').append(card);
            $('#main-block').append("<hr noshade width='80%' style='margin-bottom: 50px;'>");
        }
    }

    getClientsAjax();

}