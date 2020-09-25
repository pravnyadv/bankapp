<style type="text/css">
    .holder {
        background: blue;
        widows: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items:  center;
    }
    .sm-container {
        max-width: 600px;
        margin: 0 auto;
    }
</style>
<div class="holder">
    <div class="">
        <form action="<?=env('APP_URL')?>login" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter username" name='username' id="exampleInputEmail1" aria-describedby="emailHelp" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter Password" name="password" id="exampleInputPassword1" />
            </div>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>

