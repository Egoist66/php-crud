<div class="modal fade" id="editCity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit city</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="editCityForm">
                    <div class="mb-3">
                        <label for="city-name" class="form-label">Name</label>
                        <input required name="cityname" placeholder="Change city name" type="text"
                               class="form-control city-fields"
                               id="city-name">
                    </div>
                    <input value="1" type="hidden" name="editCity">

                    <div class="mb-3">
                        <label for="city-population" class="form-label">Population</label>
                        <input required name="citypopulation" placeholder="Change city population" min="0"
                               type="number" class="form-control city-fields" id="city-population">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="edit-city-btn" type="submit" class="btn btn-primary">Edit changes</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>