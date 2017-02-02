<div class="navbar-wrapper">
    <div class="container-fluid">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php" class="">Home</a></li>
                        <li class="active"><a href="accountList.php" class="">Accounts</a></li>
                        <li class="active"><a href="index.php" class="">Upload</a></li>
                    </ul>
                    <form name="logout" method="post" action="controller/controller.php">
                    <ul class="nav navbar-nav pull-right">
                        <li class="active"><a class="">User</a></li>
                        <li class=""><input type="hidden" name="logout" value="logout"><a href="#" onclick="$(this).closest('form').submit()">Logout</a></li>
                    </ul>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>
