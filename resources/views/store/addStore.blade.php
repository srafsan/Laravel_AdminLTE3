<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="storeModalLabel">Add Store</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="storeForm">
                @csrf
                <div class="mb-3">
                    <label for="inputStoreName" class="form-label">Store Name</label>
                    <input type="text" name="name" class="form-control" id="inputStoreName">
                </div>
                <div class="mb-3">
                    <label for="inputContact" class="form-label">Contact Number</label>
                    <input type="number" name="contact_number" class="form-control" id="inputContact">
                </div>
                <div class="mb-3">
                    <label for="inputDesc" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="inputDesc">
                </div>
                <div class="mb-3">
                    <label for="inputRegion" class="form-label">Region</label>
                    <input type="number" name="region" class="form-control" id="inputRegion">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    // Insert Store
    $("#storeForm").submit(function (e) {
        e.preventDefault();
        const storeName = $("#inputStoreName").val(),
            contactNumber = $("#inputContact").val(),
            description = $("#inputDesc").val(),
            region = $("#inputRegion").val();

        const data = {
            name: storeName,
            contact_number: contactNumber,
            description: description,
            region: region
        }

        $.ajax({
            url: "stores",
            type: "POST",
            data: data,
            success: function (data) {
                if (data) {
                    $("#storeForm")[0].reset();
                    $("#storeModal").modal("hide");
                    $(".table").load(location.href+' .table');
                } else {
                    console.log("Failed to add");
                }
            }
        })
    })
</script>
