<template>
    <table class="table table-striped table-bordered" id="job-table" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Rate</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="job in jobs">
                <td>{{ job.name }}</td>
                <td>{{ job.description}}</td>
                <td>${{ Number(job.rate).toFixed(2).toLocaleString() }}</td>
                <th scope="row">
                    <a v-bind:href="'/job/' + job.id" title="View" data-toggle="tooltip"><!---View-->
                        <i class="far fa-eye"></i>
                    </a>
                    <a v-bind:href="'/job/' + job.id + '/edit'" title="Edit" data-toggle="tooltip"><!---Edit-->
                        <i class="fas fa-edit"></i>
                    </a>
                </th>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Rate</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    import datatables from 'datatables.net-bs4'

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
                $(function(){
                    $('#job-table').DataTable();
                });
            },

            getJobs(){
                this.jobs = JSON.parse(this.jobsjson);
                this.myTable();
            },
        }
    }
</script>
