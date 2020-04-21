<template>
	<table class="table table-striped table-bordered" id="employee-timesheet-table" style="width: 100%">
		<thead>
			<tr>
				<th scope="col">Checkin DateTime</th>
				<th scope="col">Checkout DateTime</th>
				<th scope="col">Status</th>
				<th scope="col">Total Hours</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="date in employee.dates">
				<td>{{ date.checkin == null ? "Not Checked In" : epochToDateTime(date.checkin) }}</td>
				<td>{{ date.checkout == null ? "Not Checked Out" : epochToDateTime(date.checkout) }}</td>
				<td>{{ date.checkin != null && date.checkout != null ? "Completed" : "Pending" }}</td>
				<td>{{ calculateTimeDifference(date.checkin, date.checkout)}}</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th scope="col">Date</th>
				<th scope="col">Job</th>
				<th scope="col">Status</th>
				<th scope="col">Total Hours</th>
			</tr>
		</tfoot>
	</table>
</template>
<script>
	import datatables from 'datatables.net-bs4'
	import * as moment from 'moment'
	import 'moment-duration-format';
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
        	moment: function () {
    			return moment();
  			},
            myTable(){
                $(function(){
                    $('#employee-timesheet-table').DataTable();
                });
            },

            getEmployee(){
                this.employee = JSON.parse(this.employeejson);
                this.myTable();
            },
            epochToDateTime(epoch){
            	return moment.unix(epoch).format('dddd MMMM Do YYYY, h:mm:ss a');
            },
			calculateTimeDifference(checkin, checkout){
				if(checkin == null || checkout == null){
					return 'None';
				}
				var ms = moment.unix(checkout).diff(moment.unix(checkin));
				//moment.duration(ms).format("h:mm")
				return this.msToTime(ms);
			},
			msToTime(duration) {
  				var minutes = Math.ceil((duration / (1000 * 60)) % 60),
    			hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
  				hours = (hours < 10) ? "0" + hours : hours;
  				minutes = (minutes < 10) ? "0" + minutes : minutes;
  				return hours + ":" + minutes;
			}
        }
    }
</script>
<style>

</style>