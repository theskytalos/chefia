<template>
    <v-card class="ml-auto my-3">
        <v-card-text>
            <div class="text--primary">
                {{ text }}
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: 'UserBubble',
    data: function () {
        return {

        }
    },
    props: {
        text: String
    },
    mounted: function () {
        this.$vuetify.goTo(this);
    }
}
</script>

<style scoped>

</style>