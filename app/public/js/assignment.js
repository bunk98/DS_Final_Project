const Offer = {

    data() {

        return {

            "assignments" : [],
            offerForm: {}

        }

    },

    computed: {

    },

    methods: {
        

        fetchAssignmentData() {
            fetch('/api/assignment/')

            .then( response => response.json() )

            .then( (responseJson) => {

                console.log(responseJson);

                this.assignments = responseJson;

            })

            .catch( (err) => {

                console.error(err);

            })
        }

    },

        


    created(){

        this.fetchAssignmentData();

    }

}

Vue.createApp(Offer).mount('#offerApp');