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
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center w-[100%] justify-between">
          <div class="flex-shrink-0">
          <h1 class="text-white">DataWare</h1>
          </div>
          <div class=" sm:block sm:ml-6">
            <div class="flex space-x-4 ml-50 ">
              <form action="memdash.php" method="post" class="flex w-[100%]">
                <input type="submit" value="My Teams" name="teams" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
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
        <img class="h-10 w-10 rounded-full" src="eo.jpg" alt="..">
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
  <div>
      <h1 class="xl:text-4xl text-3xl text-center text-gray-800 font-extrabold pb-6 sm:w-4/6 w-5/6 mx-auto">My Teams</h1>
    </div>
    <?php
    $userid = $_SESSION['user_id'];
    $member = new member();
    $result= $member->displaymem($userid);
    foreach ($result as $row) {
      $teamname = $row['team_name'];
      $projectname = $row['project_name'];
      $projectstatus = $row['project_status'];
      echo "<div>
      <div class='bg-gray-100 mx-auto border-gray-500 border rounded-sm  text-gray-700 mb-0.5'>
         <div class='flex p-3  border-l-8 border-red-600'>
            <div class='flex-1'>
               <div class='ml-3 space-y-1 border-r-2 pr-3'>
                  <div class='text-base leading-6 font-normal' id='teamname'>$teamname</div>
                  <div class='text-sm leading-4 font-normal'><span class='text-xs leading-4 font-normal text-gray-500'> Status : </span>$projectname</div>
               </div>
            </div>
            <div class='border-r-2 pr-3'>
               <div >
               <div>
               <form method='post' action='scrum.php'>
               <div class='ml-3 my-5 bg-blue-600 p-1 w-20 flex flex-col items-center '>
               <div class='text-base leading-6 font-normal' id='teamname'>$projectstatus</div>
                  <input value='' class='hidden' id='index' name='index' >
               </div>
            </div>
               </div>
            </div>
            <div>
               </form>
            </div>
         </div>
      </div>
   </div>";
    }

     ?>
 
  <script src="mt.js"></script>
</body>

</html>
