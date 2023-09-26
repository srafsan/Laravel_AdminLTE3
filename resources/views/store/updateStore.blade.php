<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateStoreModalLabel">Update Store</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="updateStoreForm-{{$store->id}}">
                @csrf
                <div class="mb-3">
                    <label for="inputStoreName" class="form-label">Store Name</label>
                    <input value="{{$store->name}}" type="text" name="name" class="form-control" id="updateStoreName-{{$store->id}}">
                </div>
                <div class="mb-3">
                    <label for="inputContact" class="form-label">Contact Number</label>
                    <input value="{{$store->contact_number}}"  type="number" name="contact_number" class="form-control" id="updateContact-{{$store->id}}">
                </div>
                <div class="mb-3">
                    <label for="inputDesc" class="form-label">Description</label>
                    <input value="{{$store->description}}"  type="text" name="description" class="form-control" id="updateDesc-{{$store->id}}">
                </div>
                <div class="mb-3">
                    <label for="inputRegion" class="form-label">Region</label>
                    <input value="{{$store->region}}"  type="number" name="region" class="form-control" id="updateRegion-{{$store->id}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
    // Update Store
    $('[id^=updateStoreForm]').submit(function (e) {
        e.preventDefault();
        const formID = $(this).attr("id");
        const storeID = formID.replace("updateStoreForm-", "");
        const storeName = $(`#updateStoreName-${storeID}`).val(),
            contactNumber = $(`#updateContact-${storeID}`).val(),
            description = $(`#updateDesc-${storeID}`).val(),
            region = $(`#updateRegion-${storeID}`).val();

        const data = {
            name: storeName,
            contact_number: contactNumber,
            description: description,
            region: region
        }

        $.ajax({
            url: `stores/${storeID}`,
            type: "PUT",
            data: data,
            success: function (data) {
                if (data) {
                    $(`#updateStoreForm-${storeID}`)[0].reset();
                    $(`#updateStoreModal-${storeID}`).modal("hide");
                    $(".table").load(location.href+' .table');
                } else {
                    console.log("Failed to add");
                }
            }
        })
    })
</script>
