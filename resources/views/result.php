<style type="text/css">
    .top {
        background:  grey;
    }
    .left-nav {
        min-height: 100vh;
        background: blue;
    }
    .list-group-item {
        color: #fff;
        background: blue;
    }
</style>
<div class="top text-right pb-2 pt-2">
    <div class="container">
        <strong><?=$username?></strong>
    </div>
</div>
<div class="row">
    <div class="col-md-2 left-nav">
        <div class="list-group">
            <a href="#" class="list-group-item  list-group-item-action">Air Index</a>
            <a href="#" class="list-group-item list-group-item-action">Bank IFSC</a>
            <a href="#" class="list-group-item list-group-item-action">Logout</a>
        </div>

    </div>
    <div class="col-md-10 mt-3">
        <div class="container">
            <div class="create-button text-right mt-2 mb-2">
                <a href="<?=env('APP_URL')?>add" class="btn btn-primary">
                    ADD Branch
                </a>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Branch Name</th>
                        <th scope="col">IFSC Code</th>
                        <th scope="col">Bank</th>
                        <th scope="col">District</th>
                        <th scope="col">State</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($branches as $row): ?>
                        <tr>
                            <td><?=$row->name?></td>
                            <td><?=$row->ifsc?></td>
                            <td><?=$row->bank?></td>
                            <td><?=$row->district?></td>
                            <td><?=$row->state?></td>
                            <td>
                                <a href="<?=env('APP_URL')?>branch/delete/<?=$row->id?>" class="btn btn-danger ">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
