<div class="controls loading">
    <div class="row">
        <div class="col-12">

            <div class="mb-5">
                <button
                    class="btn btn-primary  rounded-1"
                    data-bs-toggle="modal" data-bs-target="#addCityModal"
                    id="add">Add city
                </button>

                <button
                    class="btn btn-dark rounded-1"
                    onclick="window.location.reload()"
                    id="reload">Reload page
                </button>
            </div>


        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="search" class="form-label search-label">Search</label>
                    <input placeholder="Find a city" name="search" type="search" class="form-control" id="search" >
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $cityModal ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $editCityModal ?>
        </div>
    </div>
</div>