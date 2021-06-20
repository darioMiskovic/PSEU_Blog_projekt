<template>
    <div class="new-container d-flex flex-column">
        <h1 class="mt-6 align-self-center">Unesite novu kategoriju</h1>

        <form class="mt-12"  method="post">
            <v-text-field
                label="Unesite kategoriju"

                v-model="form.kategorija_naziv"

            ></v-text-field>

            <v-btn :disabled="uvjet" type="button" class="primary mt-10" @click.prevent="provjeriDuplikat">Dodaj kategoriju</v-btn>
            <v-btn v-if="uvjet"  type="button" class="primary mt-10" @click.prevent="spremiPromjenu">Spremi promjenu</v-btn>
            <v-btn v-if="uvjet"  type="button" class="error mt-10" @click.prevent="uvjet =!uvjet">Odustani</v-btn>

        </form>

        <v-simple-table class="mt-15">
            <template v-slot:default>
                <thead>
                    <tr>
                        <th class="text-left">
                            ID
                        </th>
                        <th class="text-left">
                            Kategorija
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="kat in kategorije" :key="kat.id">
                        <td>{{ kat.id }}</td>
                        <td>{{ kat.kategorija }}</td>
                        <td>
                            <v-btn class="btn" @click="obrisiKategoriju(kat.id)"><i class="fas fa-trash"></i></v-btn>
                            <v-btn class="btn" @click="urediKategoriju(kat.id, kat.kategorija)"><i class="fas fa-pen"></i></v-btn>

                        </td>


                    </tr>
                </tbody>
            </template>
        </v-simple-table>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            kategorije: [],
            form: {
                kategorija_naziv:"",
                kategorija_id:null
            },
            uvjet:false



        };
    },

    methods:{
        //Provjeri da li postoji već kategorija

        provjeriDuplikat(){
            const novaKategorija =(this.form.kategorija_naziv);

            const checkArr = this.kategorije.map(item=> item.kategorija.toLowerCase()).some(kat => kat === novaKategorija.toLowerCase());

            if(checkArr){
                alert("Kategorija već postoji");
                return false;
            }else{
                this.dodajKategoriju();
            }
        },


        dodajKategoriju(){
            //Dodaj kategoriju

           this.axios.post("http://localhost:8000/api/categories",this.form).then((response) => {

               this.dohvatiKategorije();
               this.form.kategorija_naziv = "";
            }).catch(error=>{
               console.error(error.response.data);
            })
        },

        dohvatiKategorije(){
            //Dohvati kategorije
            this.axios.get("http://localhost:8000/api/categories").then((response) => {
                this.kategorije = (response.data)
            }).catch(err=>{
                console.log(err);
            })
        },

        obrisiKategoriju(id){
            //Obriši kategoriju
            const brisiKat = confirm("Želite obrisati kategoriju ?");

            if(brisiKat){
                this.axios.get("http://localhost:8000/api/obrisiKategoriju/" + id).then((response) => {

                    this.dohvatiKategorije();

                }).catch(err=>{
                    console.log(err);
                })
            }

        },

        urediKategoriju(id_kat,naziv_kat){
            //Uredi kategoriju

            this.form.kategorija_naziv = naziv_kat;
            this.form.kategorija_id = id_kat;
            this.uvjet=true;

        },

        spremiPromjenu(){


          this.axios.post("http://localhost:8000/api/urediKategoriju", this.form).then((response) => {

                this.form.kategorija_naziv = "";
                this.form.kategorija_id = null;

                alert(response.data);

                this.uvjet = false;
               this.dohvatiKategorije();

            }).catch(err=>{
                console.log(err);
            })
        }
    },

    created(){
        this.dohvatiKategorije();
    }
};
</script>

<style>
.btn{
    color: #1e1e1e8a;
    transition: all ease-in 0.2s;
    background-color: transparent;
    border: none;
    box-shadow: none;
}
.btn:hover{
    color: #1976d2;
    background-color: transparent;
}

.new-container {
    padding-left: 10rem;
    padding-right: 10rem;
}
</style>
