<template>

    <div class="new-container">
        <h1 class="mb-10">{{objava.naslov}}</h1>

        <p>Autor: <span class="primaryColor">{{objava.autor}}</span></p>

        <p>Rubrika: <span class="primaryColor">{{kategorije.get(objava.kategorija_id)}}</span></p>

        <small
            >Datum objave: <span class="primaryColor">{{new Date(objava.created_at).toLocaleDateString()}}</span></small
        >

        <p class="mt-9">{{objava.tekst}}</p>

        <hr />

        <v-container  class="d-flex justify-space-between">
            <v-btn to="/" class="primary mt-5">Vrati se nazad</v-btn>

           <v-list class="d-flex">
               <v-list-item>
                       <v-list-item-title v-for="item in links" :key="item.id"   >
                           <v-btn class="btn"  @click="updateDelete(item.route+objava.id)">
                                <i :class=item.icon></i>
                           </v-btn>
                       </v-list-item-title>
               </v-list-item>

           </v-list>
        </v-container>
    </div>
</template>

<script>
export default {
    props: ["postId"],

    data: function() {
        return {
            objava: {},
            kategorije: new Map(),
            links: [
                {
                    id:1,
                    icon: "fas fa-pen",
                    route:"/urediObjavu/"
                },
                {
                    id:2,
                    icon: "fas fa-trash",
                    route:"/obrisiObjavu/"
                }
            ]
        };
    },

    created() {
        //Dohvati kategorije
        this.axios.get("http://localhost:8000/api/categories").then((response) => {
            response.data.forEach(cat=>{
                this.kategorije.set(cat.id, cat.kategorija);
            })
        }).catch(err=>{
            console.log(err);
        })

        //Dohvati objavu
        this.axios.get("http://localhost:8000/api/objavaInfo/" + this.postId).then((response) => {
            this.objava = (response.data[0]);

        }).catch(err=>{
            console.log(err);
        })
    },

    methods:{
        updateDelete(route){
            const path = (route.split("/")[1]);
            const id = (route.split("/")[2]);

            if(path === "obrisiObjavu"){

               const brisiObjavu =  confirm("Želite obrisati objavu?");

                if(brisiObjavu){
                    this.axios.get("http://localhost:8000/api/obrisiObjavu/" + id).then((response) => {
                        alert(response.data);
                        this.$router.push({ name: "Naslovnica" });
                    }).catch(err=>{
                        console.log(err);
                    })
                }
            }

            if(path === "urediObjavu"){

                this.$router.push({ name: "UrediObjavu", params: { postId: id } });

            }

        }
    }
};
</script>

<style >


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

.primaryColor {
    color: #1976d2;
}

.new-container {
    padding: 40px;
}
</style>
