<?php

//session starts
if (!isset($_SESSION)) {
   session_start();
}

//database connection
include_once("connections/connection.php");
$con = connection();

if (isset($_POST['login'])) {

   $username = $_POST['username'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

   $user = $con->query($sql) or die($con->error);
   $row = $user->fetch_assoc();
   $total = $user->num_rows;

   if ($total > 0) {
      $_SESSION['UserLogin'] = $row['username'];
      $_SESSION['Access'] = $row['access'];
      echo header("Location: dashboard.php");
   } else {
      echo "No users found!";
   }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Student Management System</title>
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<body>
   <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
         <div class="user_card">
            <div class="d-flex justify-content-center">
               <div class="brand_logo_container">
                  <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxIQEhMSEhMVFhUXFRYXFRcWGRUYFxcYFxUWFxoZGBUYHSggGBopHRcYITEhJSkrLi4uGB80OTQsOCgtLisBCgoKDg0OGhAQGismICUuMDMvLS8tLS0tNi8tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAgMBAQEAAAAAAAAAAAAABgcDBAUIAgH/xABLEAABAwICBQcIBgUKBwAAAAABAAIDBBESIQUGMUFRBxMiYXGBsRQjMnKRkqHBQlJigrLRM1RzosIIJUNEU2N0k+HwFRc1g7TD0v/EABoBAQADAQEBAAAAAAAAAAAAAAADBAUCAQb/xAA1EQACAQIEAwYEAwkAAAAAAAAAAQIDEQQhMUESUXEFYYGhsfATMpHRBiLhFBUkMzRCYoLB/9oADAMBAAIRAxEAPwC8UREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBFrVtbHC0vlexjRtc9waPaVH3coOjQ/B5SL8cEuH38OEdt0BKUWGCZsjQ5jg5pF2uaQQRxBGRCzIAi1q+tZBG+WRwaxjS5zibAAda1dGaTE24ZjE0g3BHaopVoRnGDeb0OlBtNrY6aIilOQiLXFUzFgxDFw/14rlyS1Z6lc2ERF0eBFp11fFAMUr2sG7Ecz1AbSeoLjza4wD0GSv7G4R++QoqlelT+eSXVnUYyloiSIozHrjF9KGZvcx3g5dXR2mIKi/NPDiNrcw4drXWNutc08TRqu0Jp9GJQlHVHRREU5yEREARFHtJ656PpZOamqomP2lpN7esRcN77ICQotPR2koalglglZKw3AdG4ObcbRcb+pbiAIiIAiIgCjOuOtkWjo8Tzd7smM49Z6vyXX0tpGOlhknldhjY3E45nuAGZJOQA23VCay1LqmoFZP043AGFlxaRxtZgbtsLi54ADO6jqT4cuZbwtD4l5u1o217+fct99lqZdN6RinkFRUzTymQY2RCwDGnK2Ik4W5ZBtu9aOGGaN5pafzrcyySR77tt6TWOJDje1wfYV80VDI6ptVxEPe5lhICMudLHZEZAYS23Us2tbRBWYIGRRPjdbzIkaDdrHtJbISQbPIO44etcfDbVru/l0JXiIKV1FcLvos+qvvy+neSLk1125kGOchsYtiIAa1uIhodYCwOIi/bdXWDdebdMua6iZM1jWOkm87hv0iMZG3YL5261bXJXp7yilZE83fG1oF9pbs+S6o6Prpr7zI8Z80d3wrPS+bs7c7ajllqCzRjwDbHLC3tHOB5HsaVwNQqp40exwcQWSOa08ACCB2Z2twXX5bmXoIzwqYyfckHzXA5P3X0e8fVnd8Wxn5qPFK6pv/ADX/AEr0383RluQSYmNdxaD7RdZVr0ItHGPsN/CFsKyRmKZ1mk8AT7FXGtelpKWlbMw2dzsd3dWLE72hpHerImbdpHEFVRr/AJ6ON/7VvgVl46PFiKCel2WqGVOfvmWlQVIlja8ZXGzgQbH4qF65cpFNRPNO195bdIhrntj6jhFi/q3b+B7+pkuOlZ/vaA75qrNeNMO0bMIGw844gkFxwtw3IBxHirGLqVYpRpRu3fdK2V901zIIKOsmYBr1RSPu6V7nuNi+Rrt53k+iOrIBdX/jMJ2Txdz2fmozoLWaGumZFLThr7ktIs8XAOWy9rX4qYv1fp3bYI/cZ+S+ZxOEalnTnffSXmkXY1FbVehhhr8wWvaewtK+TMWyCSMlrgbtcNoP+92wr9dqZRu/oIr8QxoPwssFBBgL43kkMNg7aS07LneRmL9Q3lV3BQ/MuJNbNW8Udp3LT0BpIVMLZLWdm144OG3u2EdRC6ahWpUgjmkiBu17A9va02PwcPYpqvsMFX+PRjN679VkzPqR4ZNBF+EqueU3XmahwRU4AMjHHnSL2sbdAbL9ZvtGStHBxNbeVLnI5oYY3MIfIwuLhdwYS3K3o3txOR9leUFJRYRUVtQXPf0uZYNnDFbM9gw8LrkxgkuzvmTxN77b71qy0rr3DSW9ht7QvGgXbyHzslZUOs84Z3sjPosbFhY5odG0hodnttfrVsKpuQd3mJsTSy8pDQ0EMcAxl3O4uvcXPC25WyiAREXoCIiArTl0q8NHDGD6c4JHFrI3n8Raq5qYHeVaPhaAcLaZrQcgS6S5vwudp6lOOXqF5ZRv/ow6Vp9dzWFvwY9QjSEb5YKariJxxsax5b6THRm7XjhY3z3dFRzdpwb7y1Qi5UqiWuT8L5/TIk2lOdfXRBxBJjprFge03LpXEkG7sZdc5DsCjWt89691myEtAj6QAe92EgOIDG2JLhkRfK2a+abWctnE7ogTjDyOceb2Dh6UuM3JcSb3HUtXTuk8D5JwwtlnLnRtOyJjyQSCAATtAsBYZ78us4t9+hxFRmkr5JZvln7sfWsvmqKmiuCS5znWIIBG64yv0/gu7yd15p54h9nMdlsvEd6itNoqTyRr3+iJQ4eqWkE9hcGhdXVh5NRH6w/M+C5oW4Wr3zeZLjU+KOVlwqyexb/KpT89ouZzc8PNSjsbI0k+6SoHyYVGJlTBv6MjfZhPg32q0aSmFVQmF+ySOSM9hxNVF6o17qOrjdJ0bOMUw4XOF1+xwB7lziYSnRlw6rNdVn+hWpytJXPQui5MUMZ+w34CxW4uToF1mvj+q649V1z44l1lJCanFSjozlqzsz4ebAnqVPcpE+GiiZvfIXW6mtd/9BWlp2csgfb0nAMb6zzhHsvfuVPa7y8/X01K3MR4AfvEPf34GhU6sePF0o8rv7E0HalJ87Fqalsw0+Hg63sYwKL8tWhhLReUBmJ0L43EWNsGMBxcRmGhpNzwz3KYasMtAD9Zzj8bfJcDljqHR6Iqyw2JETD6r5o2uHe0kd6vEBVfJXocSc5UFt3CVzImi9hlmRx9LCOw910t1XZYXkde2eQVZ/yfJ8QmY45MeTGOBeOkBw2E+1XaiBHH6tNaC4SHIX2Dd3qBAXllPqfxK26j0HeqfBVNEPOSdjPBywO3HZR6P1iWsLudfV6TDVQHjib7bKx1WmisqinP2/mp/pWubTwyzv8ARjY557Ggm3wVnsR3wq6v1OMR8/giteWHXMwtNDAbPc3zzmnpBrtkbbfScMz1EDet2povKYaeOqiZLMA1zsr2ktYho4bctirXUyifpXSfOym4a81Ep3EhwLW9hcQLfVB4K9dXog58sm0A4GnszPiFrFfci1bqGyQ4n0kLidpAZfvItddGTVWQgEsjOWw2JHVmLKbIh6cnQOjXQNdiIJdbIbBa+V+9dZEQBERAEREBXvLaAaCP/Est/ly/K6p3Rml5KRxLDdptiadh6+oqwOXDToMsNIAegOddwLnAtaO4YveVUEk5o4qUbNHdOpKnLig7MlD9bIh0m0sePjZu3tAWnNrGyoLfKadr7HolpIIzva28dS45pyG43kMbxdv7BvX5R1Qc8NiZlve/IkdQ3X4DNQrC01nbzdy3+8a99rcrK3jkWxRup6ikLS4ATdAXyII2NA4g/JR7U3RbmVMuMfobjtc64FuIw3PeFmodLNnbSRBoa4uxODBkBGXEZfRBw71O9D0Blkazdtcerf8Akq2DU4ykrZFvtPglThJyvN5+D81lZ2ehL9BxYIIwd4J94k/NU1yq6D8mrXSNFo6gc4OAkGUje/J33yr0DbCwUT5S9C+V0MhaPOQ+ej49AdJve3EO2y0IuzMY5fJ9prnoInuN3M8zL12tZx7sJP3lYSq3k90a6Ckc6QEc87GGnIhhaALjcTt7wrE0fU4og5xzaLOJ6t57rFZ+Drwc50ov5Xl0/R3JqsWkpPc5Gsda1ri53oQRuld6xabd4bi98KpNTmPqaqaqeLm5I9eQnIdjbj7wVjaTiNRBOw5GZr7E/aFm+wWHcuXya6FMbYmvbZ36WUcHG1mnrHRH3So8DVjWq1ZrXJLotPud1oOEYr3csahh5uNjODQD27/iofy0i+h6rtg/8iJThQjlnF9D1X/Z4/rEXBaZWIB/J+/STftP4Hq9lRPIAfOzftP4JFey8QMVR6DvVPgqqgb5yT7n4VatR6DvVPgqsY3pvztmy28ehvFxfasDtz+xdz9YlrDbm/o8eeg/aBbnLRXc1o17AbGaSOPuBMhHeI7d61tHttLB+0HitLlylGGijceiZJHnsYGj+MqfsL+l/wBmcYn5/A4nI5ohz4ZpG5OkcRe9rtZ0QCeGJz/Yrj0bSczG1l72vc8STcqE8i9Lg0fG76wv7znvP4lYK2SAIiIAiIgCIiAIiICseVrU59U6KrgF3MLGTtG0w4vTHW27rjgepVadGy08vNvaDfNjrts9u5zSdu0L0zVmzHeqfBQSsp2tNg1thkLDIAXHgAO5Z9bEyhi6VJaST8kTQinTk+RTddRvlmYHsJYbNFi27HX9K2/uvsW/o3Q0vPmERFoYQJDsaL2td/A3FrZm+SuqLVQjpNcwEjPo2OfWNqzS6vMjie6SW1gSXEWa0AG5PjfqC0bkLItq9q41hLYGdI+m8/M7h1eKsDRWjmwNsM3H0ncf9FytT6zHGQYjFmXNxWxvZlZz2/ROezba17EkCSqOnUhUV4O60y7tT1poLHLbCb7LG99llkWnpGN7m2ZbaL34JUk4xbSv3CKu7Eax2Avt3Dh1lc3S+kXxsLGE+dfFGc8+lK0OIPHCXdS/NJzPwS81jcQCQWjM4czZoBOYFuOfFfsDY52RSDMDDJGcxtbkbdjthWT2d2bOlKU6nK1l39/oXK2IjJJRO0C17ctm7q3dy3dXafBzuy5cPZnb5qOyl+M82XZDpAbMtpyFxlbPqC3dF1z+eYG3NyA4cRx7tt0wmFrYbEOKV4Pf08bnNScJ00758iYqD8s5/mip9aDj+sRcFOFB+WX/AKVN1yU/H9Yj4LZKhAeQE+dn/aD8EqvZUVyBjzs5/vbexkh+avVAYp/Qd6p8FWEA6cnaz8AVn1HoO9U+CrGnHSk+5+AL5z8QaR6P1iW8LqzfoP00HrjxXA/lBm3kfqzfihUi0W29RAOu/wC81cn+UDS3p6WT6sj2e+zF/wCtW+wl/CLq/UjxP8wkvJIP5rpvUb8GtCmSgXIpU85ouPix8jD3Oy+FlPVsEAREQBERAEREAREQGlpWUMhle42DWOJPAAZlRLSg6Q2Z32dqlulHhsTidl2jjtcB81Fa3pSsG3MfEhY9dX7To90ZE0cqcvAmrRYBYqyDnGObxCzotaUVJNMhIRVwuF27x+al9DNjjY7i0E9ts/iuLpsYJL29IAjhcZH5LU1a0sfKJqV+VsLmX3hzQSR34hb7PWsPsuXwK9TCN3tdry9VYnq/mipktREW8QHK0xI2lpaiRjQAyKR9tgJDCVX8umKagjY2V5awYGB1nPDLjoh7he2Q37rHepxryP5vrP8ADy/gKqzXDQ5fRVpbmS5s5vu5lkLXD3Yz7V6j3YsrVtzDM8jMlgLSNlsr2/dXfipmMJLWNBO0gAXUG1FjMT4YS7EY4mxk8cMLc/grAXj1PAq95bqlrdGlhIu+eAWvmQJA42G/0firCUE160BT1kzROzEMDd5GxzyNhVbF4qOGp/EnpdL6nUIOTsivuQvSUEcsrZJWMcZnFocQ245s7Cdu/JXHUa0UMeTqunB4c7Hf2A3VW02rFC2UQ8wLOvhsX7QCTfpZ7l24tXKRmyCP3QfxXWPV/EFOGkHn75lhYV8zs6f5QKJsErYZedlcwtYyMPzc4WHStYDO+3suuDQkYnN+kGxkg7bYAPEFb8VJEwjDG0eqGjwC1NJ6OjkcMQvhvhOYOeZzCycb2lHGNcUWkk/Nr7E0KXw9Dq6C6VTFbYL+F/ktnlZoOe0bMQLmMsl7mus/9xzl+6qUt5cQGTG+OQHipXWUzZY3xvF2va5rhxDhY/Ar6jsyi6OFhGWuv1dynWlxTbRVHILWYPLKRxzDmTM6w4YHW6smH7yt5edNFVUmh9JtLwfNOMMv24nG1/ZZw6wF6Fgna9rXtcC1wBaQcnAi4I45LQfcRmZFBdL8ptJTyuiDJZcJs57MGG42gFzgTbjsXOg5aKBxs6KpYPrFsRAHGzZC63cvAWWixxvDgHA3BAIPEHYVkQBERAEREBztMvAj6WwvYNl8y4Wy7c+5Rt3SqYxe/SZn95fXKvUOj0c9zb3EkV8JIcGh4Li1w9EhoJB3WutfQsollp3guIc2NwLvSILMQLrfSttWfLDv9tjWvlwtW8USJ/ka97k7REWgRkT5RJ3QUzalpd5mRjntH0o3HA4W3npAjrAVTx6WfTSBzXFxgkAxX9OKQ44333i5P+eFeOsWjRVUs8H9pG5oPB1uie42K820jiLNlu3my6knvtbG4kxPI+wQ7/JYqlamozVVLPfzttycklu2uSJI5qx6U0JpJtVC2Ru8C467X+d10VWvJNpBwa6nkyfGXRuHBzekO6xNuqyspWk01dEZxtcm3oaof3En4SovFQip8oh3PjqYyO0Pj+YUt1mbekqR/cyfhK4+qjbzPd9gu99wcugcPk9qeddBJ9djHe2marIVf6rUggquZBHm5JG2G4DnAwEccAYe9WAjAUc06y9Qz1B4uX7pvXOhopmwVNQ2KRzMYDg62G5Fy4CwuQbX4KLa667UU9OG0dZGaoywNiwk4rOnY1wvbIYS6/YqeNwzxFLgTtmn9Gmd05cLuc+piLqmOzywgPOIAHdbMHtW66GT9YPut/JRXk101E4zivq42OE7heaRjTha0ABuIjo3vs61ZbtaNCj+tUXvxHwKzaXYVPgiqsm2uVreauSvEO+RHBTyX/Tk9WFov3hq3qWkdI4NYC4/AdZK6Dtc9CN/rVJ3YT4BbuhtctG1EraelqI3yOuQxgduBJPo2GQVqj2RhqU1O12uf2SXnc4lWm1Y7Gi6AQMDRmdrjxP5LdRFpkRXPKhqn5QPKYx0wMLx9YDZ/v8ANUvTQc5hklLnWJ5ppc4hjQ76P1cwTlvzXqt7AQQRcEWIOwqkdY9SnwTSBluaBc5m3EG5usG26XaDe68YK/qq25LW+0nctGR5LMFjkSQb7S4NBvwFmrYr9G2N73aDlb5ha4zvtvcDZkdu+/Z7UB6X1I1mpa2FkcEuN8UbBI0texwytezgLi42i4UoVX8l2p7qGoklLy/FEWXwFjQ0ua7K7jcktHcFaC9AREQBa1Y2QxvETmtkwnA5wxNDrZEtBFxfdcLZRAUrrPp3SLwYZsJfDNHI+JrLB4jdiGZ/SRuA+ib2PcZTqTUiZ1K8MwXiHRzGG0ViLHOwIU2rqFkzcLh2EbR2Faej9BsheHhziRe17WzFl40m0/e32B10RF6Aql161LLq18sbTzVXFIyUgEiOZgEjHutsBc32l3EK2l8PbcWOxRVoOcHFOz2fJ7PweZ7F2dyu9XqLmHU4NjNhibK9ozeWANBPHK4uVY65NLoKKOTnBc/VBzDTx611lzh6PwaShe9t/Fvw102Qk7u5grYecjez6zHN94ELgaoxlt7ixMMJz62KTLCIAHl+8gA9jSSPFTnhFauldDpHnAOhLzT7/aHmXjq6PN+8VMFhngD24XbMvgQR8QsyAims2p0NVKKnmwZsIjJLnAYLk7Adt7KKa0agPjgMtPCx80b4XsDHPLjgmY51muyPRByVrIgKJ1D1CbUMeaqBvPPkkf03PBDCW2uGHI3JPepX/wAp6b+wg73SnxVg0tBHEXFjQC7b+Q4DqW0gK4ZyV0o/oKb2OPiFuaM1BjpZmTQNjjeMiY7s6LrYshkclO0QBERAFjlha8Wc0HtF1kRAVRrByatL3mLGGuuRhs4C/wBnaPbZRWDk7kEjQ6UEYhcCNwcc9gF8ivQKIDFTswsaDuaB7AsqIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiA//2Q==" class="brand_logo" alt="RVDC logo">
               </div>
            </div>
            <div class="d-flex justify-content-center form_container">
               <form action="" method="POST">
                  <div class="input-group mb-4">
                     <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                     </div>
                     <input type="text" name="username" class="form-control input_user" id="username" value="" placeholder="username">
                  </div>
                  <div class="input-group mb-4">
                     <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                     </div>
                     <input type="password" name="password" class="form-control input_pass" id="password" value="" placeholder="password">
                  </div>
                  <div class="d-flex justify-content-center mt-5 login_container">
                     <button type="submit" name="login" class="btn login_btn">Login</button>
                  </div>
               </form>
            </div>

         </div>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>