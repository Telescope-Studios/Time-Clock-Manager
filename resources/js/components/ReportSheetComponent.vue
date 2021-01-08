<template>
    <table class="table table-striped table-bordered" id="report-sheet-table" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Employee</th>
                <th scope="col">Total Hours</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="report in reportsheet.slice().reverse()">
                <td>{{ report.employee.firstname }} {{ report.employee.lastname }}</td>
                <td>{{ roundTo2Decimals(report.hours) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Employee</th>
                <th scope="col">Total Hours</th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    import * as moment from 'moment'
    export default {
        mounted() {
            this.getReports()
        },
        props: ['reportsheetjson'],
        data(){
            return {
                reportsheet: []
            }
        },
        methods:{

            myTable(){
                let datatableConfig = {
                    responsive: true
                };
                $(function(){
                    $('#report-sheet-table').DataTable(datatableConfig);
                });
            },

            getReports(){
                console.log(this.reportsheet)
                this.reportsheet = JSON.parse(this.reportsheetjson);
                this.myTable();
            },

            roundTo2Decimals(value){
                return value.toFixed(2);
            },
        }
    }
</script>
