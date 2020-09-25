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
            <form class="addbranchform" action="<?=env('APP_URL')?>add/branch" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Branch name" name='name' aria-describedby="emailHelp" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter IFSC Code" name='ifsc' aria-describedby="emailHelp" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Bank" name='bank' aria-describedby="emailHelp" />
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select state</label>
                    <select required name="state" class="form-control state" id="exampleFormControlSelect1">
                        <option>Select State</option>
                        <?php foreach($stateNames as $key => $value): ?>
                            <option value="<?=$value?>" data-id="<?=$key?>"><?=$value?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group district">

                </div>
                <input type="hidden" name="username" value="<?=$username?>">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    let districts = JSON.parse('<?=json_encode($stateDistricts)?>');
    $(document).ready(function() {
        // when state is selected show the district based on state_id
        $("select.state").change(function() {
            let stateId = $(this.options[this.selectedIndex]).data('id');
            let stateDistricts = districts[stateId];
            let html = `
                <label for="exampleFormControlSelect1">Select District</label>
                <select required name="district" class="form-control state" id="exampleFormControlSelect1">
                    <option>Select District</option>
                    ${Object.keys(stateDistricts).map(function (key) {
                        return "<option value='" + key + "'>" + stateDistricts[key] + "</option>"
                    }).join("")}
                </select>
            `;
            $('.district').html(html);
            $('.addbranchform').change();
        });
    });
</script>
