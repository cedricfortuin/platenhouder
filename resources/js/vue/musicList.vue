<template>
    <div class="table-responsive mx-auto">
        <table id="recordTable" class="table table-sm">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Naam van plaat</td>
                    <td>Artiest</td>
                    <td>Soort</td>
                    <td>Hoeveel hebben we ervan?</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(record, index) in records" :key="index">
                    <td>{{ record.id }}</td>
                    <td>{{ record.name }}</td>
                    <td>{{ record.artist }}</td>
                    <td>{{ record.type }}</td>
                    <td>{{ record.amount }}</td>
                    <td>
                        <button type="button" class="btn btn-success text-white btn-md">
                            <i class="far fa-edit"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    name: "musicList",
    props: ["records"]
}
</script>

<style scoped>

</style>
