<template>
    <table class="table table-striped table-bordered" id="job-table" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="job in jobs">
                <td>{{ job.name }}</td>
                <td>{{ job.description}}</td>
                <th scope="row">
                    <a v-bind:href="'/job/' + job._id" title="View" data-toggle="tooltip"><!---View-->
                        <i class="far fa-eye"></i>
                    </a>
                    <a v-bind:href="'/job/' + job._id + '/edit'" title="Edit" data-toggle="tooltip"><!---Edit-->
                        <i class="fas fa-edit"></i>
                    </a>
                </th>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</template>

<script>

    export default {
        mounted() {
            this.getJobs()
        },
        props: ['jobsjson'],
        data(){
            return {
                jobs: []
            }
        },
        methods:{

            myTable(){
                let datatableConfig = {
                    responsive: true
                };
                $(function(){
                    $('#job-table').DataTable(datatableConfig);
                });
            },

            getJobs(){
                this.jobs = JSON.parse(this.jobsjson);
                this.myTable();
            },
        }
    }
</script>
