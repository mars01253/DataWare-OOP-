    <?php
    require 'user.php';
    include 'admdashview.php';
    $logout = "";
    if (isset($_POST['logout'])) {
        $logout = $_POST['logout'];
    }
    $userlogout->checklog();
    $userlogout->displayadm();
    $userlogout->logout($logout);
    ?>
    <script>
        const assignbtn = document.querySelectorAll('.assignbtn');

        for (let i = 0; i < assignbtn.length; i++) {
            assignbtn[i].addEventListener('click', assign);

            function assign() {
                const id = document.getElementById('owner' + i).value;
                const xhr = new XMLHttpRequest();

                xhr.open('GET', "config.php?id=" + id, true);

                xhr.onload = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                        } else {
                            console.error('Error:', xhr.status, xhr.statusText);
                        }
                    }
                };

                xhr.send();
            }
        }
    </script>