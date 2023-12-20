<?php
$user = new user();
$user->checklog();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>

<body>
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 ">
        <div class="flex items-center w-[100%] justify-between ">
          <div class="flex-shrink-0">
            <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
            <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
          </div>
          <div class=" sm:block sm:ml-6 w-1/">
            <div class="flex space-x-4 ml-50 ">
              <form action="owner.php" method="post" class="flex w-[100%]">
                <input type="submit" value="Home" name="members" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                <input type="submit" value="Stats" name="stats" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                <input type="submit" value="Log out" name="logout" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
  </nav>
  <h1 class="text-xl mt-10 ml-5">Welcome Back</h1>
  <div class="w-[100%]">
    <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
      <div class="flex-shrink-0">
        <img class="h-10 w-10 rounded-full" src="" alt="..">
      </div>
      <div class="flex-1 min-w-0">
        <a href="#" class="focus:outline-none">
          <span class="absolute inset-0" aria-hidden="true"></span>
          <p class="text-sm font-medium text-gray-900"><?php echo $_SESSION['fullname']; ?></p>
          <p class="text-sm text-gray-500 truncate"><?php echo $_SESSION['role']; ?></p>
          <form method="post" action="owner.php">
            <input class="text-sm text-gray-500 truncate hidden" name="ownerid" value="<?php echo $_SESSION['user_id'];?>" id="ownerid">
          </form>
        </a>
      </div>
    </div>
  </div>
  <br>

  <div class="container flex justify-center mx-auto pt-16">
    <div>
      <p class="text-gray-500 text-lg text-center font-normal pb-3">DATAWRE Projects</p>
      <h1 class="xl:text-4xl text-3xl text-center text-gray-800 font-extrabold pb-6 sm:w-4/6 w-5/6 mx-auto">Add a Project</h1>
    </div>
  </div>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form method="POST">
            <div class="mb-4">
              <label class="text-xl text-gray-600">Title <span class="text-red-500">*</span></label></br>
              <input type="text" class="border-2 border-gray-300 p-2 w-full" name="title" id="title" value="" required>
            </div>

            <div class="mb-4">
              <label class="text-xl text-gray-600">Description</label></br>
              <input type="text" class="border-2 border-gray-300 p-2 w-full" name="description" id="description" placeholder="(Optional)">
            </div>
            <div class="mb-4">
              <label class="text-xl text-gray-600">DeadLine</label></br>
              <input type="date" class="border-2 border-gray-300 p-2 w-full" id="DeadLine" placeholder="(Optional)">
            </div>
            <div class="flex p-1">
              <button role="submit" id="addproject" class="p-3 bg-blue-500 text-white hover:bg-blue-400" required>Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container mx-auto bg-gray-50 min-h-screen p-8 antialiased">
    <?php
    $ownerid = $_SESSION['user_id'];
    $conn = new Connection();

    $pdo = $conn->pdo;
    $sql = 'SELECT * FROM projects WHERE product_owner=?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ownerid]);
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $projectname = $result['project_name'];
      $projectstaus = $result['project_status'];
      $projectdeadline = $result['project_deadline'];
      $projectid = $result['project_id'];
      $projectdesc = $result['project_desc'];
      echo "<div>
      <div class='bg-gray-100 mx-auto border-gray-500 border rounded-sm  text-gray-700 mb-0.5'>
         <div class='flex p-3  border-l-8 border-red-600'>
            <div class='flex-1'>
               <div class='ml-3 space-y-1 border-r-2 pr-3'>
                  <div class='text-base leading-6 font-normal' id='projectname$i'>$projectname</div>
                  <div class='text-sm leading-4 font-normal'><span class='text-xs leading-4 font-normal text-gray-500'> Status : </span>$projectstaus</div>
                  <div class='text-sm leading-4 font-normal'>  DeadLine : <span class='text-xs leading-4 font-normal text-gray-500' id='projectdeadline$i'>$projectdeadline</span></div>
               </div>
            </div>
            <div class='border-r-2 pr-3'>
               <div >
               <div>
               <form method='post'>
               <input value='$projectid' name='projectid$i' class='hidden' id='projectid$i' >
               <input value='$projectdesc' class='hidden' id='projectdesc$i' >
               <div class='ml-3 my-5 bg-blue-600 p-1 w-20 flex flex-col items-center '>
                  <button class='uppercase text-xs leading-4 font-semibold text-center text-red-100 editpro'>Edit</button>
                  <input value='$i' class='hidden' name='index' >
               </div>
            </div>
               </div>
            </div>
            <div>
               <div class='ml-3 my-5 bg-red-600 p-1 w-20 flex flex-col items-center '>
                  <input type='submit' name='delete' value='Delete' class='uppercase text-xs leading-4 font-semibold text-center text-red-100'>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>";
      $i++;
    }

    ?>

    <div id="popup" class="fixed w-full h-full top-0 left-0  items-center flex justify-center hidden z-50">
      <div class="bg-white w-full md:w-7/12 h-fit border-2 border-amber-600 flex flex-col justify-start items-center overflow-y-auto rounded-2xl md:h-fit">
        <div class="bg-amber-600 w-full md:w-7/12 h-8 fixed rounded-tr-2xl rounded-tl-2xl">
          <div class="flex justify-end">
            <span onclick="closePopup()" class="text-2xl font-bold cursor-pointer mr-3">&times;</span>
          </div>
        </div>
        <form method="post" action="owner.php" class="flex flex-col justify-between items-center h-full mt-[10vh]">
          <div class="flex flex-col mb-3">
            <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
              <p class="text-xs">Project Name</p>
              <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="editname" type="text" name="name" placeholder="Name" autocomplete="off">
            </div>
            <div id="categorynameERR" class="text-red-600 text-xs pl-3"></div>
          </div>
          <div class="flex flex-col mb-3">
            <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
              <p class="text-xs">Project Description</p>
              <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="editdesc" type="text" name="desc" placeholder="Name" autocomplete="off">
              <input  class="placeholder:font-light placeholder:text-xs focus:outline-none hidden" id="editid" value="" type="text" name="idproject" placeholder="Name" autocomplete="off">
            </div>
            <div id="categorynameERR" class="text-red-600 text-xs pl-3"></div>
          </div>
          <div class="flex flex-col mb-3">
            <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
              <p class="text-xs">Project DeadLine</p>
              <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="editdeadline" type="Date" name="deadline" placeholder="Name" autocomplete="off">
              <input required class="placeholder:font-light placeholder:text-xs focus:outline-none hidden" id="" value="<?php echo $ownerid; ?>" type="text" name="ownerid" autocomplete="off">
            </div>
            <div id="categorynameERR" class="text-red-600 text-xs pl-3"></div>
          </div>
          <div class="flex flex-col mb-3">
            <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
              <p class="text-xs">Project Manager</p>
              <select class="placeholder:font-light placeholder:text-xs focus:outline-none" id="selectdiv" name="managerid">
               
              </select>
            </div>
            <div id="categorynameERR" class="text-red-600 text-xs pl-3"></div>
          </div>
          <div class="flex justify-end mb-4">
            <input required type="submit" id="modifybtn" name="submit" class="cursor-pointer px-8 py-2 bg-[#9fff30] font-semibold rounded-lg border-2 border-[#6da22f]" value="Edit Project">
          </div>
        </form>
      </div>
    </div>

  </div>
    <div id="storediv" class="hidden">

    </div>



</body>

</html>
<script>
  const editpro = document.querySelectorAll('.editpro');
  editpro.forEach((pro, index) => {
    pro.addEventListener('click', (e) => {
      e.preventDefault(); 
      document.getElementById("popup").classList.remove("hidden");
      let idpro = document.getElementById("projectid" + index).value;
      let proname = document.getElementById("projectname" + index).innerHTML;
      let prodeadline = document.getElementById("projectdeadline" + index).innerText;
      let prodesc = document.getElementById("projectdesc" + index).value;
      /******************************************************************** */
      console.log(idpro);
      let editname = document.getElementById("editname");
      let editdeadline = document.getElementById("editdeadline");
      let editdesc = document.getElementById("editdesc");
      let editid = document.getElementById("editid");
      let storediv = document.getElementById("storediv");
      let selectdiv = document.getElementById("selectdiv");
      editname.value = proname;
      editdeadline.innerText = prodeadline;
      editdesc.value = prodesc;
      editid.value = idpro;
      let output = [];
      let type = 'select';
      const xhr = new XMLHttpRequest();
      xhr.open('GET', "config.php?type=" + type, true);
      xhr.onload = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            output = xhr.response;
            console.log(output);
            for (let i = 0; i < output.length; i++) {
              storediv.innerHTML += output[i];
            }
          }
        }
        selectdiv.innerHTML=storediv.innerText;
      };
      xhr.send();

    });
  });

  function closePopup() {
    document.getElementById("popup").classList.add("hidden");
  }

  window.onclick = function(event) {
    var popup = document.getElementById("popup");
    var popup2 = document.getElementById("popupEdit");
    if (event.target == popup) {
      popup.classList.add("hidden");
    }
  };
  /********************************************** */
  const addproject = document.getElementById('addproject');
  addproject.addEventListener('click', add);

  function add() {
    const id = document.getElementById('ownerid').value;
    const title = document.getElementById('title').value;
    const desc = document.getElementById('description').value;
    const deadline = document.getElementById('DeadLine').value;
    let ownerid = parseInt(id);
    let type = 'addpro';
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "config.php?title=" + title + "&desc=" + desc + "&deadline=" + deadline + "&id=" + ownerid + "&type=" + type, true);
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
</script>