const Offer = {

    data() {

        return {

            "referee" : [],
            offerForm: {}

        }

    },

    computed: {

    },

    methods: {
        

        fetchRefereeData() {
            fetch('/api/referee/')

            .then( response => response.json() )

            .then( (responseJson) => {

                console.log(responseJson);

                this.referee = responseJson;

            })

            .catch( (err) => {

                console.error(err);

            })
        }

    },

        


    created(){

        this.fetchRefereeData();

    }

}

Vue.createApp(Offer).mount('#offerApp');