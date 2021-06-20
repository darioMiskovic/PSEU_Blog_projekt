<template>
    <v-app id="inspire">
        <v-app-bar app color="white" flat>
            <v-container class="py-0 fill-height">
                <v-btn
                    v-for="link in links"
                    :key="link.name"
                    text
                    :to="link.route"
                >
                    {{ link.name }}
                </v-btn>
            </v-container>
        </v-app-bar>

        <v-main class="grey lighten-3">
            <v-container>
                <v-row>
                    <v-col>
                        <v-sheet min-height="79vh" rounded="lg">
                            <router-view></router-view>
                        </v-sheet>
                        <Footer />
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Footer from './components/Footer';

export default {
    components: {
        Footer
    },
    data: () => ({
        links: [
            {
                name: "Naslovnica",
                route: "/"
            },
            {
                name: "Nova objava",
                route: "/objava"
            },
            {
                name: "Nova kategorija",
                route: "/kategorija"
            }
        ]
    })
};
</script>
