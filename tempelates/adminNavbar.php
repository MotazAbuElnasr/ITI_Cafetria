<nav class="navbar navbar-expand-lg navbar-dark navigation">
        <a class="navbar-brand" href="/admin-manual" id="iti">iTi Caffee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/admin" id="home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin-addproduct"> Products </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin-users"> Users </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin-manual">Manual Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin-checks">Checks</a>
            </li>
          </ul>
          <ul class="ml-auto navbar-nav ">

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="nav-user"> <?= $_SESSION['userName'] ?> </span>
<img class="nav-img" src="<?=  $_SESSION['userImg']?$_SESSION['userImg'] != "" : "assets/images/user.jpg"?>" 
width = "50px"/>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="/changePassword">Change Password</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="/logout">Logout</a>
</div>
</li>
</ul>
          </ul>
        </div>
      </nav>
