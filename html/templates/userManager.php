<?php?>

<link rel="stylesheet" href="../style/admin.css">

<div class="row" style="margin: 4em;"></div>

<div class="row">
    <div class="col-1"></div>
    <div class="col-10">

        <h1 class="title">Users</h1>

        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

        <div class="row" style="margin: 1em;"></div>

        <!-- search bar -->
        <div class="row">
            <div class="input-group rounded search-container">
                <input type="search" class="form-control rounded searchbar" style=" border-radius: 2rem;color: var(--text-color); background-color: var(--background-color);" id="searchbar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <span class="input-group-text border-0 search-icon">
                    <i class="fas fa-search"></i>
                </span>
            </div>

        </div>

        <div class="row" style="margin: 1em;"></div>

        <!-- Users -->
        <div class="row">
            <?php drawUser(0)?>
        </div>
    </div>
    <div class=" col-1"></div>
</div>


</body>

<?php?>