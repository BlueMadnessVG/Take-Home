

<!-- SECTION INFORMATION -->
<section class="jumbotron text-center bg-white pb-0">
    <div class="container">
        <h1> <?= esc($title) ?> </h1>   <!-- TITTLE ($DATA FROM CONTROLLER) -->
        <p class="lead text-muted">
            Comic characters from marvel that you like!
        </p>
        <p>
            <a href="/hero/new" class="btn btn-primary my-2"> Add a new character </a>
        </p>
    </div>
</section>

<!-- Validator for the user & display helper -->
<?= session()->getFlashdata('error') ?>

<!-- if statement to identify if the is items in hero_list -->
<?php if ($hero_list !== []): ?>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- foreach of every item found in hero_list -->
                <?php foreach ($hero_list as $hero_item): ?>
                    <div class="col-md-4">
                        <!-- card container -->
                        <div id="<?= esc($hero_item['name']) ?>" class="card mb-4 box-shadow">
                            <!-- img holder -->
                            <img class="card-img-top"  src="<?= esc($hero_item['thumbnail_path']) ?>" alt="<?= esc($hero_item['name']) ?>" style="height:225px; width: 100%; display: block;">
                            <!-- data holder -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"> <?= esc($hero_item['name']) ?> </h5>
                                <p class="card-text text-truncate"> <?= esc($hero_item['description']) ?> </p>

                                <div class="btn-group btn-group-sm mt-auto" role="group">
                                    <a href="/hero/edit/<?= esc($hero_item['id'], 'url') ?>" class="btn btn-outline-secondary">View</a>
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-id="<?= $hero_item['id'] ?>">delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <!-- paginator for cards -->
            <?= $pager->links();  ?>
            
        </div>
    </div>

<!-- if there is no item show this code -->
<?php else: ?>

    <h3>No News</h3>
    <p> Unable to find any news for you. </p>

<?php endif ?>

    <!-- delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete <span>  </span> </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item? 
            </div>
            <div class="modal-footer">
                <!-- call of delete item -->
                <form id="deleteForm" data-bs-action="hero/delete/" action="" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            </div>
        </div>
    </div>

<script>
    // script to get the id for the modal
    const deleteModal = document.getElementById('deleteModal')
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', event => {
         // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-id attributes
        const id = button.getAttribute('data-bs-id')
          
        // Update the modal's content.
        var deleteForm = deleteModal.querySelector('#deleteForm')
        var action = deleteForm.getAttribute("data-bs-action")

        deleteForm.setAttribute('action', action + id)
        })
    }
</script>



