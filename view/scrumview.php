
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
              <form action="scrum.php" method="post" class="flex items-center w-[100%]">
                <input type="submit" value="Home" name="members" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
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
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
      <div class="flex-shrink-0">
        <img class="h-10 w-10 rounded-full" src="" alt="">
      </div>
      <div class="flex-1 min-w-0">
        <a href="#" class="focus:outline-none">
          <span class="absolute inset-0" aria-hidden="true"></span>
          <p class="text-sm font-medium text-gray-900"><?php echo $_SESSION['fullname']; ?></p>
          <p class="text-sm text-gray-500 truncate"><?php echo $_SESSION['role']; ?></p>
        </a>
      </div>
    </div>
  </div>
  <br>
  <div class="container flex justify-center mx-auto pt-16">
    <div>
      <p class="text-gray-500 text-lg text-center font-normal pb-3">DATAWRE TEAMS</p>
      <h1 class="xl:text-4xl text-3xl text-center text-gray-800 font-extrabold pb-6 sm:w-4/6 w-5/6 mx-auto">Add a Team</h1>
    </div>
  </div>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <form method="POST" action="scrum.php">
            <div class="mb-4">
              <label class="text-xl text-gray-600">Title <span class="text-red-500">*</span></label></br>
              <input type="text" class="border-2 border-gray-300 p-2 w-full" name="title" id="title" value="" required>
            </div>
            <div class="flex p-1 ">
              <select class="p-2 bg-blue-500 text-white hover:bg-blue-400 cursor-pointer" id="" name="project">
               <?php
               $conn = new Connection();
               $pdo = $conn->pdo;
               $sql = 'SELECT * FROM projects ';
               $stmt = $pdo->prepare($sql);
               $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $name = $result['project_name'];
                    $idpro = $result['project_id'];
                    echo "<option class='placeholder:font-light placeholder:text-xs focus:outline-none' name='idpro' value='$idpro'>$name</option>";
                }
               ?>
               </select>
            </div>
            <div class="flex p-1 ">
              <input type="submit" name="submit" value="Submit" role="submit" id="addproject" class="p-2 bg-blue-500 text-white hover:bg-blue-400 text-center cursor-pointer" required>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container mx-auto bg-gray-50 min-h-screen p-8 antialiased">
    <?php
    $scrum = new scrum();
    $scrumid = $_SESSION['user_id'];
    $scrum->display($scrumid);
    $i = 0;
    
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $teamname = $result['team_name'];
      $teamstaus = $result['team_status'];
      $projectid = $result['pro_id'];
      $teamid = $result['team_id'];
      echo "<div>
      <div class='bg-gray-100 mx-auto border-gray-500 border rounded-sm  text-gray-700 mb-0.5'>
         <div class='flex p-3  border-l-8 border-red-600'>
            <div class='flex-1'>
               <div class='ml-3 space-y-1 border-r-2 pr-3'>
                  <div class='text-base leading-6 font-normal' id='projectname$i'>$teamname</div>
                  <div class='text-sm leading-4 font-normal'><span class='text-xs leading-4 font-normal text-gray-500'> Status : </span>$teamstaus</div>
               </div>
            </div>
            <div class='border-r-2 pr-3'>
               <div >
               <div>
               <form method='post'>
               <input value='$teamid' class='hidden' id='projectdesc$i' >
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



  
</body>

</html>