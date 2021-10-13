const Offer = {
    data() {
      return {
            "students": [],
            "offers": [],
            "selectedStudent": null,
            "offerForm": {}
        }
    },
    computed: {
        // prettyBirthday() {
        //     return dayjs(this.person.dob.date)
        //     .format('D MMM YYYY');
        // }
    },
    methods: {
        selectStudent(s) {
            console.log("Clicked", s);
            if (this.selectedStudent == s) {
                return;
            }

            this.selectedStudent = s;
            this.offers = [];
            this.fetchOfferData(s);
        },
        fetchStudentData() {
            fetch('/api/student/')
            .then(response => response.json())
            .then((parsedJson) => {
                console.log(parsedJson);
                this.students = parsedJson
            })
            .catch( err => {
                console.error(err)
            })
        },
        fetchOfferData(s) {
            console.log("Fetching offers for", s);
            fetch('/api/offer/?student=' + s.id)
            .then(response => response.json())
            .then((parsedJson) => {
                console.log(parsedJson);
                this.offers = parsedJson
            })
            .catch( err => {
                console.error(err)
            })
        },

        postNewOffer(evt) {
            this.offerForm.studentId = this.selectedStudent.id;        
            console.log("Posting:", this.offerForm);

            fetch('api/offer/create.php', {
                method:'POST',
                body: JSON.stringify(this.offerForm),
                headers: {
                  "Content-Type": "application/json; charset=utf-8"
                }
              })
              .then( response => response.json() )
              .then( json => {
                console.log("Returned from post:", json);
                // TODO: test a result was returned!
                this.offers = json;
                
                // reset the form
                this.offerForm = {};
              });

        }



    },
    created() {
        this.fetchStudentData();
    }
  }
  
Vue.createApp(Offer).mount('#offerApp');