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
    let assigned = false;

    for (let i = 0; i < assignbtn.length; i++) {
        assignbtn[i].addEventListener('click', assign);

        function assign() {
            location.reload();
            const id = document.getElementById('owner' + i).value;
            if (!assigned) {
                let type = 'assign';
                const xhr = new XMLHttpRequest();
                xhr.open('GET', "config.php?id=" + id + "&type=" + type, true);
                xhr.onload = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                        } else {
                            console.error('Error:', xhr.status, xhr.statusText);
                        }
                    }
                };
                xhr.send();
                assigned = true;
                assignbtn[i].innerHTML = 'Reassign';
            } if(assigned){
                let type = 'Reassign';
                const xhr = new XMLHttpRequest();
                xhr.open('GET', "config.php?id=" + id + "&type=" + type, true);
                xhr.onload = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                        } else {
                            console.error('Error:', xhr.status, xhr.statusText);
                        }
                    }
                };
                xhr.send();
                assigned = false;
                assignbtn[i].innerHTML = 'Assign As Product Owner';
            }
        }
    }
</script>
