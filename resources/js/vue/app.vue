<template>
    <div>
        <div class="mb-5">
            <add-music-form/>
        </div>
        <music-list-view
            :records="records"/>
    </div>
</template>

<script>
import addMusicForm from "./addMusicForm";
import musicListView from "./musicList";

export default {
    name: "app",
    components: {
        addMusicForm,
        musicListView
    },
    data: function () {
        return {
            records: []
        }
    },
    methods: {
        getList() {
            axios.get('/api/records')
                .then(response => {
                    this.records = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style scoped>

</style>
