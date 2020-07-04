$(document).ready(function () {
    $('.ui.dropdown').dropdown();

    $('#tableSearch').on('change input', function (e) {
        var searchText = $(this).val().toLowerCase();
        $('#mainTable tbody tr').each(function (data) {
            if ($(this).find('.content.coin').text().trim().toLowerCase().includes(searchText)) {
                $(this).removeAttr('style');
            } else {
                $(this).attr('style', 'display: none !important');
            }
        })
    })

    $('#signInButton').click(function (e) {
        e.preventDefault();
        window.location.href = "login.php";
    });

    $('#signUpButton').click(function (e) {
        e.preventDefault();
        window.location.href = "register.php";
    });

    $('#homeButton').click(function (e) {
        e.preventDefault();
        window.location.href = "index.php";
    });

    $('#portfolioButton').click(function (e) {
        e.preventDefault();
        window.location.href = "portfolio.php";
    });

    $('.ui.form')
        .form({
            fields: {
                firstName: {
                    identifier: 'firstName',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your first name'
                    }]
                },
                lastName: {
                    identifier: 'lastName',
                    rules: [{
                        type: 'empty',
                        prompt: 'Please enter your last name'
                    }]
                },
                email: {
                    identifier: 'email',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter your e-mail'
                        },
                        {
                            type: 'email',
                            prompt: 'Please enter a valid e-mail'
                        }
                    ]
                },
                password: {
                    identifier: 'password',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter your password'
                        },
                        {
                            type: 'length[6]',
                            prompt: 'Your password must be at least 6 characters'
                        }
                    ]
                },
                passwordRepeat: {
                    identifier: 'passwordRepeat',
                    rules: [{
                            type: 'empty',
                            prompt: 'Please enter your password'
                        },
                        {
                            type: 'length[6]',
                            prompt: 'Your password must be at least 6 characters'
                        },
                        {
                            type: 'match[password]',
                            prompt: 'Passwords does not match.'
                        }
                    ]
                }
            }
        });

});