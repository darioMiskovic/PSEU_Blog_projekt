<template>
    <div>



        <v-card class="mb-6">
            <v-tabs
                background-color="primary"
                center-active
                dark
                centered

            >
                <v-tab @click="getPosts('all')">SVE</v-tab>
                <v-tab v-for="kat in kategorije" @click="getPosts(kat[0])" :key="kat[0]">
                    {{kat[1]}}
                </v-tab>

            </v-tabs>
        </v-card>

        <v-container>
            <v-row>
                <v-col class="col-md-4 col-sm-6" cols="12" v-for="post in objave" :key="post.id">
                    <!--Card-->
                    <v-card class="mx-auto card-style" max-width="344" outlined>
                        <v-list-item three-line>
                            <v-list-item-content>
                                <div class="text-overline mb-4">
                                    {{kategorije.get(post.kategorija_id)}}
                                </div>
                                <v-list-item-title class="text-h5 mb-1">
                                    {{ post.naslov }}
                                </v-list-item-title>
                                <v-list-item-subtitle>
                                    {{ post.tekst.slice(0,40)+" ..." }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>

                        <v-card-actions>
                            <v-btn
                                class="primary"
                                rounded
                                text
                                @click="viewMore(post.id)"
                            >
                                Otvori
                            </v-btn>
                        </v-card-actions>

                    </v-card>

                    <!--///Card-->
                </v-col>
            </v-row>

        </v-container>
    </div>
</template>

<script>



export default {

    data() {
        return {
            kategorije: new Map(),

            objave: [],

            //spinner: true,


        };
    },

    methods: {
        viewMore(id) {
            this.$router.push({ name: "ObjavaInfo", params: { postId: id } });
        },

        getPosts(query){
            this.axios.get("http://localhost:8000/api/posts/" + query).then((response) => {
                //this.spinner =  false;

                this.objave =(response.data)
            }).catch(err=>{
                console.log(err);
            })
        }
    },

    created(){
        //Dohvati kategorije
        this.axios.get("http://localhost:8000/api/categories").then((response) => {

           response.data.forEach(cat=>{
               this.kategorije.set(cat.id, cat.kategorija);
           })

        }).catch(err=>{
            console.log(err);
        })

        //Dohvati objave
        this.getPosts("all");
    }
};
</script>

<style scoped>

.spinner{
    width: 500px;
    min-height: 500px;
}
.card-style::before{
    width: 100%;
    height: 10px;
    content: "";
    position: absolute;
    top: 0;
    left: 0;

    background-color: #1976d28c;
    border: 1px solid rgba(0,0,0, 0.12);
}

</style>
