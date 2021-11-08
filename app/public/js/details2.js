const Offer = {
    data() {
      return {
            "students": [],
            "offers": [],
            "selectedStudent": null,
            "offerForm": {},
            "selectedOffer": null
        }
    },
    computed: {
        // prettyBirthday() {
        //     return dayjs(this.person.dob.date)
        //     .format('D MMM YYYY');
        // }
    },
    methods: {

        prettyData(d) {
            return dayjs(d)
            .format('D MMM YYYY')
        },
        prettyDollar(n) {
            const d = new Intl.NumberFormat("en-US").format(n);
            return "$ " + d;
        },

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
            fetch('/api/games/')
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
            fetch('/api/retail/?student=' + s.gameID)
            .then(response => response.json())
            .then((parsedJson) => {
                console.log(parsedJson);
                this.offers = parsedJson
            })
            .catch( err => {
                console.error(err)
            })
        },



        postOffer(evt) {
            console.log ("Test:", this.selectedOffer);
          if (this.selectedOffer) {
              this.postEditOffer(evt);
          } else {
              this.postNewOffer(evt);
          }
        },
        postEditOffer(evt) {
          this.offerForm.id = this.selectedOffer.id;
          this.offerForm.studentId = this.selectedStudent.id;        
          
          console.log("Editing!", this.offerForm);
  
          fetch('api/detail/update.php', {
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
              this.handleResetEdit();
            });
        },

        postNewOffer(evt) {
            this.offerForm.studentId = this.selectedStudent.id;        
            console.log("Posting:", this.offerForm);

            fetch('api/detail/create.php', {
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
                this.handleResetEdit();
              });

        },



        postDeleteOffer(o) {  
            if ( !confirm("Are you sure you want to delete the offer from " + o.companyName + "?") ) {
                return;
            }  
            
            console.log("Delete!", o);
    
            fetch('api/detail/delete.php', {
                method:'POST',
                body: JSON.stringify(o),
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
                this.handleResetEdit();
              });
          },


        handleEditOffer(offer) {
            this.selectedOffer = offer;
            this.offerForm = Object.assign({}, this.selectedOffer);
        },
        handleResetEdit() {
            this.selectedOffer = null;
            this.offerForm = {};
        }



    },    
    created() {
        this.fetchStudentData();
    }
  }
  
Vue.createApp(Offer).mount('#offerApp');