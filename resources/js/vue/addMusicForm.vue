<template>
    <div class="form">
        <form method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="row">
                <div class="col-md-6">
                    <label for="artist" class="form-label" autofocus>Naam van artiest</label>
                    <input type="text" class="form-control" id="artist" v-model="item.artist" required>
                    <input type="text" class="form-control" id="" hidden>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Naam van plaat</label>
                            <input type="text" class="form-control" id="name" v-model="item.name" required>
                            <small class="text-info" id="showAlert">Check onderaan of de plaat al bestaat</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" value="LP" v-model="item.type" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="owner" class="form-label">Eigenaar</label>
                        <input type="text" class="form-control" id="owner" v-model="item.owner" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Hoeveel hebben we ervan?</label>
                        <input type="number" class="form-control" id="amount" min="1" v-model="item.amount" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success text-white col-md-3 ml-auto" @click="addMusicItem()">Opslaan</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "addMusicForm",
    data: function () {
        return {
            item: {
                artist: "",
                name: "",
                type: "",
                owner: "",
                amount: ""
            },
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    methods: {
        addMusicItem() {
            if (this.item.name != '') {
                axios.post('/api/record/store', {
                    record: this.item
                })
                .then(response => {
                    if (response.status == 201) {
                        this.item.name = "";
                    }

                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
