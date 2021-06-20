import Vue from "vue";
import VueRouter from "vue-router";
import Naslovnica from "../views/Naslovnica.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Naslovnica",
        component: Naslovnica
    },
    {
        path: "/objava",
        name: "Objava",
        component: () => import("../views/Objava.vue")
    },
    {
        path: "/kategorija",
        name: "Kategorija",
        component: () => import("../views/Kategorija.vue")
    },
    {
        path: "/objavaInfo",
        name: "ObjavaInfo",
        component: () => import("../views/ObjavaInfo.vue"),
        props: true
    },
    {
        path: "/urediObjavu",
        name: "UrediObjavu",
        component: () => import("../views/UrediObjavu.vue"),
        props: true

    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

export default router;
