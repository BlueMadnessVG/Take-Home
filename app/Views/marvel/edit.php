<h2 class="p-2"> <?= esc($title) ?> </h2>

<!-- form to update data in bd -->
<form action="/hero/update/<?= esc($data->id) ?>" method="post">
    <!-- create CSRF token -->
    <?= csrf_field() ?>

    <div class="container">
        <div class="input-group mb-3">
            <input id="inputName" type="text" class="form-control" placeholder="Marvel's character search" aria-label="Marvel's character search">
            <button id="searchButton" class="btn btn-outline-secondary" type="button"> Search Character </button>
        </div>

        <div class="row">
            <!--Image-->
            <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage" src="<?= old("thumbnail_path", $data->thumbnail_path) ?>" alt="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
                    alt="example placeholder" style="width: 300px;" />
                </div>
                <input type="hidden" name="thumbnail_path" id="thumbnailPath" value=" <?= old("thumbnail_path", $data->thumbnail_path) ?>" " >
            </div>

            <div class="col-md-4">
                <!-- form inputs for heros -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="input" name="name" class="form-control" value=" <?= old("name", $data->name) ?>" >
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="4" name="description"> <?= old("description", $data->description) ?>" </textarea>
                </div>

                <button type="submit" class="btn btn-primary">update new hero</button>
            </div>
            
        </div>
    </div>

</form>

<script>
    // script to search and show information from MARVEL API
    const searchButton = document.getElementById("searchButton");
    if (searchButton) {
        // event click for searchButton
        searchButton.addEventListener("click", async function(event) {
            const name = document.getElementById("inputName").value.replace(/ /g, '%20')
            
            // URL constructor
            const baseUrl = "<?= getenv("MARVEL_BASE_URL")?>/characters"    // api url
            const apikey = "<?= getenv("MARVEL_PUBLIC_KEY")?>"              //api public key
            const hash = "<?= getenv("MARVEL_HASH")?>"                      //api hash in md5
            const timestamp = 1                                             //timestamp for the hash

            const url = `${baseUrl}?name=${name}&apikey=${apikey}&hash=${hash}&ts=${timestamp}`
            
            console.log("Starting the request");
            //try catch for request GET MARVEL CHARACTERS by NAME
            try {
                //  fetch the api
                const response = await fetch(url);
                //  get the data and log it
                const result = await response.json();
                console.log(result.data.results[0]);
                //save the value in the inputs

                //name input
                const nameField = document.querySelector('input[name="name"]');
                nameField.value = result.data.results[0].name;
                //description input
                const textarea = document.getElementById("description");
                textarea.value = result.data.results[0].description;
                //img input
                const img = document.getElementById("selectedImage");
                img.src = result.data.results[0].thumbnail.path + "." + result.data.results[0].thumbnail.extension
                //img thumbnail 
                const img_path = document.getElementById("thumbnailPath");
                img_path.value = result.data.results[0].thumbnail.path + "." + result.data.results[0].thumbnail.extension
            } catch (error) {
                console.error(error);
            }

        })
    }
</script>