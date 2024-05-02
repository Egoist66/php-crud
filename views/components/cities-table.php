<div class="cities table-responsive ">

    <?php if (!empty($cities)): ?>

        <table class="table table-hover">
            <thead class="table-dark">
            <tr>
                <th scope="col"># ID</th>
                <th scope="col">Name</th>
                <th scope="col">Population</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($cities as $city) : ?>
                <tr id="city-<?= $city['id'] ?>">
                    <th scope="row"><?= $city['id'] ?></th>
                    <td><?= $city['name'] ?></td>
                    <td><?= $city['population'] ?></td>
                    <td>

                        <button
                            id="<?= $city['id'] ?>"
                            onclick="fetch('/api/cities/show/?id=' + this.id)
                            .then(response => response.json())
                            .then(data => {
                                const editForm = document.querySelector('#editCity form')

                                editForm.cityname.value = data.data.name
                                editForm.citypopulation.value = data.data.population
                                editForm.editCity.value = data.data.id
                                editForm.setAttribute('data-id', data.data.id)
                            })"

                            class="btn btn-outline-info btn-edit"
                            data-bs-toggle="modal"
                            data-bs-target="#editCity"
                        >
                            Edit city
                        </button>

                        <button
                            id="<?= $city['id'] ?>"
                            title="Be careful with this action it can't be undone"
                            onclick="fetch('/api/cities/delete/?id=' + this.id)"
                            class="btn btn-outline-danger btn-delete"
                        >
                            Delete
                        </button>
                    </td>
                </tr>

            <?php endforeach ?>

            </tbody>
        </table>

        <?= $pagination ?>

    <?php else: ?>

        <p>No cities found</p>

    <?php endif ?>


</div>


