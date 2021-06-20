<template>
    <v-footer
        dark
        padless
        class="footer"
    >
        <v-card
            class="flex"
            flat
            tile

        >
            <v-card-title class="primary flex justify-center">

                <a
                    v-for="icon in icons"
                    :key="icon.id"
                    class="mx-4"
                    dark
                    icon
                    :href="icon.url"
                    target="_blank"
                >
                    <v-icon size="24px">
                        {{ icon.icon }}
                    </v-icon>
                </a>
            </v-card-title>

            <v-card-text class="py-2 white--text text-center">
                {{ new Date().getFullYear() }} &copy; <strong>Blog FPMOZ</strong>
            </v-card-text>
        </v-card>
    </v-footer>
</template>

<script>
export default {
    data: () => ({
        icons: [
            {
                id:1,
                icon: 'fab fa-facebook',
                url:'https://hr-hr.facebook.com/pg/fpmoz.ba/posts/'
            },
            {
                id:2,
                icon: 'fab fa-instagram',
                url:'https://www.instagram.com/fpmoz.mostar/?hl=hr'
            },


        ],
    }),
}
</script>

<style scoped>

    .footer{
        background-color: #1976d2;
    }

</style>
