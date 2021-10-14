const Game = {

    data() {

        return {

            "games" : [],
            gameForm: {}

        }

    },

    computed: {

    },

    methods: {
        

        fetchGameData() {
            fetch('/api/games/')

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

        this.fetchGameData();

    }

}

Vue.createApp(Game).mount('#gameApp');