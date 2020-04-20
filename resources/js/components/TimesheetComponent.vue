<template>
	<table class="table table-striped table-bordered" id="employee-timesheet-table" style="width: 100%">
		<thead>
			<tr>
				<th scope="col">Date</th>
				<th scope="col">Job</th>
				<th scope="col">Status</th>
				<th scope="col">Total Hours</th>
				<th scope="col">Total Earnings</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="date in employee.dates">
				<td>{{date.name}}</td>
				<td>{{date.job.name}}</td>
				<td v-if="date.complete">Completed</td>
				<td v-else>Pending</td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th scope="col">Date</th>
				<th scope="col">Job</th>
				<th scope="col">Status</th>
				<th scope="col">Total Hours</th>
				<th scope="col">Total Earnings</th>
			</tr>
		</tfoot>
	</table>
</template>
<script>
	import datatables from 'datatables.net-bs4'
    export default {
    	props: ['employeejson'],
        mounted() {
            this.getEmployee()
        },

        data(){
            return {
                employee: {}
            }
        },
        methods:{
            myTable(){
                $(function(){
                    $('#employee-timesheet-table').DataTable();
                });
            },

            getEmployee(){
                this.employee = JSON.parse(this.employeejson);
                this.myTable();
            },
        }
    }
</script>
<style>

</style>