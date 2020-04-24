<template>
    <table class="table table-striped table-bordered" id="report-table" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Job</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="report in reports.slice().reverse()">
                <td>{{ report.job.name }}</td>
                <td>{{ epochToDateTime(report.from) }}</td>
                <td>{{ epochToDateTime(report.to) }}</td>
                <th scope="row">
                    <a v-bind:href="'/report/' + report._id" title="View" data-toggle="tooltip"><!---View-->
                        <i class="far fa-eye"></i>
                    </a>
                    <a v-bind:href="'/report/' + report._id + '/edit'" title="Edit" data-toggle="tooltip"><!---Edit-->
                        <i class="fas fa-edit"></i>
                    </a>
                </th>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Job</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th></th>
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
        props: ['reportsjson'],
        data(){
            return {
                reports: []
            }
        },
        methods:{

            myTable(){
                let datatableConfig = {
                    responsive: true
                };
                $(function(){
                    $('#report-table').DataTable(datatableConfig);
                });
            },

            getReports(){
                this.reports = JSON.parse(this.reportsjson);
                this.myTable();
            },

            epochToDateTime(epoch){
                return moment.unix(epoch).format('dddd MMMM Do YYYY, h:mm a');
            },
        }
    }
</script>
