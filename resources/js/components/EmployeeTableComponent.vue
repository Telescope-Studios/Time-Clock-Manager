<template>
    <table class="table table-striped table-bordered" id="employee-table" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Active</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Job</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="employee in employees">
                <td v-if="employee.active">Yes</td>
                <td v-else>No</td>
                <td>{{ employee.firstname }}</td>
                <td>{{ employee.lastname }}</td>
                <td>{{ employee.slug }}</td>
                <td>{{ employee.job.name }}</td><!--need to fix this properly maybe on job delete v:-->
                <th scope="row">
                    <a v-bind:href="'/employee/' + employee.slug" title="View" data-toggle="tooltip"><!---View-->
                    <i class="far fa-eye"></i>
                    </a>
                </th>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Active</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Job</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    import datatables from 'datatables.net-bs4'
    export default {
        props: ['employeesjson'],
        mounted() {
            this.getEmployees()
        },

        data(){
            return {
                employees: []
            }
        },
        methods:{
            myTable(){
                $(function(){
                    $('#employee-table').DataTable();
                });
            },

            getEmployees(){
                this.employees = JSON.parse(this.employeesjson);
                this.myTable();
            },
        }
    }
</script>
