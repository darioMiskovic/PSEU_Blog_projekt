<template>
    <div class="new-container d-flex flex-column">
        <h1 class="mt-6 align-self-center">Uredi objavu</h1>

        <v-form class="mt-12">
            <v-text-field
                label="Naslov"
                v-model="form.naslov"
            ></v-text-field>

            <v-text-field
                label="Ime i prezime autora"

                v-model="form.autor"
            ></v-text-field>

            <v-textarea
                name="input-7-1"
                label="Unesi tekst"

                v-model="form.tekst"
            ></v-textarea>

            <v-autocomplete

                label="Odaberi kategoriju"
                :items="kategorije"
                item-text="kategorija"
                item-value="id"
                v-model="form.kategorija_id"
            ></v-autocomplete>

            <v-btn type="submit" @click.prevent="print" class="primary mt-10"
                >Spremi promjene</v-btn
            >
        </v-form>
    </div>
</template>

<script>
export default {
    props: ["postId"],
    data: function() {
        return {
            form: {},

            kategorije: []
        };
    },

    methods: {
       print() {

            this.checkForm();

            this.axios.post("http://localhost:8000/api/urediObjavu", this.form).then((response) => {
                alert(response.data);
                this.$router.push({ name: "Naslovnica" });
            }).catch(err=>{
                console.log(err);
            })

        },

        checkForm() {

            if (
                this.form.kategorija_id === undefined ||
                this.form.naslov === undefined ||
                this.form.autor === undefined ||
                this.form.tekst === undefined ) {
                alert("Unesite sva polja");
                return false;
            }
        },



    },

    created() {
        //Dohvati kategorije
        this.axios.get("http://localhost:8000/api/categories").then((response) => {

            this.kategorije = (response.data)
        }).catch(err=>{
            console.log(err);
        })

        //Dohvati objavu
        this.axios.get("http://localhost:8000/api/objavaInfo/" + this.postId).then((response) => {
            this.form = (response.data[0]);

        }).catch(err=>{
            console.log(err);
        })


    }
};
</script>

<style></style>
