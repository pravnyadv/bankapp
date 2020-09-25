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
            <h2>IFSC CODE FINDER</h2>
            <form class="searchbranchform" action="<?=env('APP_URL')?>search/branch" method="POST">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Select your bank</label>
                    <div class="col-sm-10">
                        <select required name="bank" class="form-control" id="exampleFormControlSelect1">
                            <option></option>
                            <?php foreach($branches as $branch): ?>
                                <option value="<?=$branch->bank?>"><?=$branch->bank?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">State in which bank is situated</label>
                    <div class="col-sm-10">
                        <select required name="state" class="form-control state" id="exampleFormControlSelect1">
                            <option></option>
                            <?php foreach($stateNames as $key => $value): ?>
                                <option value="<?=$value?>" data-id="<?=$key?>">
                                    <?=$value?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row district">

                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Branch of Bank within District</label>
                    <div class="col-sm-10">
                        <select required name="name" class="form-control" id="exampleFormControlSelect1">
                            <option></option>
                            <?php foreach($branches as $branch): ?>
                                <option value="<?=$branch->name?>"><?=$branch->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Find Now</button>
                </div>
            </form>

            <div class="mt-5">
                <form class="searchbranchform" action="<?=env('APP_URL')?>search/branch" method="POST">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Enter IFSC Code to know Bank details</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter IFSC" name='ifsc' aria-describedby="emailHelp" />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">GET Details</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    let districts = JSON.parse('<?=json_encode($stateDistricts)?>');
    console.log(districts);

    $(document).ready(function() {
        // when state is selected show the district based on state_id
        $("select.state").change(function() {
            let stateId = $(this.options[this.selectedIndex]).data('id');
            let stateDistricts = districts[stateId];
            let html = `
                <label for="staticEmail" class="col-sm-2 col-form-label">District in which bank is situated</label>
                <div class="col-sm-10">
                    <select required name="district" class="form-control state" id="exampleFormControlSelect1">
                        <option></option>
                        ${Object.keys(stateDistricts).map(function (key) {
                            return "<option value='" + key + "'>" + stateDistricts[key] + "</option>"
                        }).join("")}
                    </select>
                </div>
            `;
            $('.district').html(html);
            $('.searchbranchform').change();
        });
    });
</script>
